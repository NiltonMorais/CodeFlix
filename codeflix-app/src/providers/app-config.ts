
import {Injectable} from "@angular/core";

@Injectable()
export class AppConfig{
    private off:boolean;

    getOff():boolean{
        return this.off;
    }

    setOff(off:boolean){
        this.off = off;
    }
}