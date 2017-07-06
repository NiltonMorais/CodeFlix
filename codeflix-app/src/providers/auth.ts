import {Injectable} from '@angular/core';
import 'rxjs/add/operator/map';
import {JwtClient} from "./jwt-client";
import {JwtPayload} from "../models/jwt-payload";

/*
 Generated class for the Auth provider.

 See https://angular.io/docs/ts/latest/guide/dependency-injection.html
 for more info on providers and Angular DI.
 */
@Injectable()
export class Auth {

    private _user = null;

    constructor(public jwtClient: JwtClient) {
    }

    user(): Promise<Object> {
        return new Promise((resolve) => {
            if (this._user) {
                resolve(this._user);
            }
            this.jwtClient.getPayload().then((payload: JwtPayload) => {
                if(payload){
                    this._user = payload.user;
                }
                resolve(this._user);
            })
        });
    }

    check():Promise<boolean>{
        return this.user().then(user=>{
            return user !== null;
        });
    }

    login({email, password}):Promise<Object>{
        return this.jwtClient.accessToken({email,password})
            .then(()=>{
                return this.user();
            });
    }

    logout(){
        return this.jwtClient.revokeToken()
            .then(()=>{
                this._user = null;
            })
    }

}
