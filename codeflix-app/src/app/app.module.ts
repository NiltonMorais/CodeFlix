import {BrowserModule} from '@angular/platform-browser';
import {ErrorHandler, NgModule} from '@angular/core';
import {IonicApp, IonicErrorHandler, IonicModule} from 'ionic-angular';

import {MyApp} from './app.component';
import {HomePage} from '../pages/home/home';
import {ListPage} from '../pages/list/list';

import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {LoginPage} from "../pages/login/login";
import {HttpModule} from "@angular/http";
import {JwtClient} from "../providers/jwt-client";
import {IonicStorageModule} from "@ionic/storage";
import {JwtHelper} from "angular2-jwt";

@NgModule({
    declarations: [
        MyApp,
        HomePage,
        ListPage,
        LoginPage
    ],
    imports: [
        IonicStorageModule.forRoot({
            driverOrder: ['localstorage']
        }),
        HttpModule,
        BrowserModule,
        IonicModule.forRoot(MyApp),
    ],
    bootstrap: [IonicApp],
    entryComponents: [
        MyApp,
        HomePage,
        ListPage,
        LoginPage
    ],
    providers: [
        JwtHelper,
        JwtClient,
        StatusBar,
        SplashScreen,
        {provide: ErrorHandler, useClass: IonicErrorHandler}
    ]
})
export class AppModule {
}
