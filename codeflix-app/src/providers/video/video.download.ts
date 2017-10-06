import {Http} from "@angular/http";
import {Injectable} from "@angular/core";

@Injectable()
export class VideoDownload{
    constructor(public http: Http){
        console.log('VideoDownload Provider');
    }
}