import {Injectable} from "@angular/core";
import "rxjs/add/operator/toPromise";
import "rxjs/add/operator/map";
import {Env} from "../../models/env";
import {AuthHttp} from "angular2-jwt";
import {Observable} from "rxjs/Observable";
import {RequestOptions, URLSearchParams} from "@angular/http";

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
        let params = new URLSearchParams();
        params.set('page',page+'');
        params.set('include','serie_title,categories_name');

        let requestOptions = new RequestOptions({params});
        return this.authHttp
            .get(`${ENV.API_URL}/videos`,requestOptions)
            .map(response => response.json().data);
    }

    get (id: number): Observable<any> {
        return this.authHttp
            .get(`${ENV.API_URL}/videos/${id}`)
            .map(response => response.json());
    }
}
