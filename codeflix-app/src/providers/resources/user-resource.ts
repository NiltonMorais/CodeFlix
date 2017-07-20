import {Injectable} from "@angular/core";
import {Headers, Http, RequestOptions} from "@angular/http";
import "rxjs/add/operator/toPromise";
import {Env} from "../../models/env";
import {AuthHttp} from "angular2-jwt";

declare var ENV: Env;
/*
 Generated class for the UserResource provider.

 See https://angular.io/docs/ts/latest/guide/dependency-injection.html
 for more info on providers and Angular DI.
 */
@Injectable()
export class UserResource {

    constructor(public http: Http,
                public authHttp: AuthHttp) {
    }

    register(accessToken: string): Promise<string> {
        let headers = new Headers();
        headers.set('Authorization', `Bearer ${accessToken}`);
        return this.http.post(`${ENV.API_URL}/register`, {}, new RequestOptions({headers}))
            .toPromise()
            .then(response => response.json().token);
    }

    updatePassword({password, password_confirmation}): Promise<Object> {
        return this.authHttp
            .patch(`${ENV.API_URL}/user/settings`, {password, password_confirmation})
            .toPromise()
            .then(response => response.json().user);
    }

}
