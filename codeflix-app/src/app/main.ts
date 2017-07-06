import {platformBrowserDynamic} from '@angular/platform-browser-dynamic';

import {AppModule} from './app.module';
import {NgModuleRef} from "@angular/core";
import {appContainer} from "./app.container";

platformBrowserDynamic().bootstrapModule(AppModule)
    .then((module: NgModuleRef<AppModule>) => {
        appContainer(module.injector);
    });
