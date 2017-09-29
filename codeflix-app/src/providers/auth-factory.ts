import {Auth} from "./auth";
import {AuthOffline} from "./auth-offline";
import {Injectable} from "@angular/core";
import {AppConfig} from "./app-config";
import {AuthGuard} from "./auth-guard";

@Injectable()
export class AuthFactory {
    constructor(public auth: Auth, public authOffline: AuthOffline, public appConfig:AppConfig){

    }

   get():AuthGuard{
        return this.appConfig.getOff() ? this.authOffline : this.auth;
   }
}
