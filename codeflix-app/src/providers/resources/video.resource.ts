import {Injectable} from "@angular/core";
import "rxjs/add/operator/toPromise";
import "rxjs/add/operator/map";
import {Env} from "../../models/env";
import {AuthHttp} from "angular2-jwt";
import {Observable} from "rxjs/Observable";

declare var ENV: Env;

/*
 Generated class for the UserResource provider.

 See https://angular.io/docs/ts/latest/guide/dependency-injection.html
 for more info on providers and Angular DI.
 */
@Injectable()
export class VideoResource {

    constructor(public authHttp: AuthHttp) {
    }

    latest(page: number): Observable<any> {
        return this.authHttp
            .get(`${ENV.API_URL}/videos`)
            .map(response => response.json().data);
    }

    get (id: number): Observable<any> {
        return this.authHttp
            .get(`${ENV.API_URL}/videos/${id}`)
            .map(response => response.json());
    }
}
