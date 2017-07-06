import {Injector} from "@angular/core";

let localInjector:Injector;
export const appContainer = (injector?:Injector):Injector =>{
    if(injector){
        localInjector = injector;
    }
    return localInjector;
};