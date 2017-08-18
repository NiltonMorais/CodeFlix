import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import "rxjs/add/operator/map";
import {Observable} from "rxjs/Observable";
import {AuthHttp} from "angular2-jwt";
import {Env} from "../../models/env";

declare var ENV: Env;
/*
 Generated class for the PaymentResourceProvider provider.

 See https://angular.io/docs/ts/latest/guide/dependency-injection.html
 for more info on providers and Angular DI.
 */
@Injectable()
export class PaymentResource {

    constructor(public http: Http,
                public authHttp: AuthHttp) {
    }

    get(planId: number): Observable<Object> {
        return this.authHttp
            .post(`${ENV.API_URL}/plans/${planId}/payments`, {})
            .map(response => response.json());
    }

    doPayment(planId:number,paymentId:string,payerId:string):Observable<Object>{
        return this.authHttp
            .patch(`${ENV.API_URL}/plans/${planId}/payments`, {
                payment_id: paymentId,
                payer_id: payerId,
            })
            .map(response => response.json());
    }
}
