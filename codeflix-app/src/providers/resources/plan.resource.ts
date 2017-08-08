import {Injectable} from "@angular/core";
import "rxjs/add/operator/map";
import {AuthHttp} from "angular2-jwt";
import {Env} from "../../models/env";
import {Observable} from "rxjs/Observable";

declare var ENV: Env;
/*
 Generated class for the PlanResource provider.

 See https://angular.io/docs/ts/latest/guide/dependency-injection.html
 for more info on providers and Angular DI.
 */
@Injectable()
export class PlanResource {

    constructor(public http: AuthHttp) {
        console.log('Hello PlanResource Provider');
    }

    all(): Observable<Array<Object>> {
        return this.http.get(`${ENV.API_URL}/plans`)
            .map(response => response.json().plans);
    }

}
