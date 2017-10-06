import {VideoAdapter} from "./video.adapter";
import {VideoModel} from "../sqlite/video.model";
import {Observable} from "rxjs/Observable";
import {Injectable} from "@angular/core";
import {Env} from "../../models/env";

declare var ENV: Env;

@Injectable()
export class VideoController implements VideoAdapter{

    constructor(public videoModel: VideoModel){

    }

    latest(page: number, search:string): Observable<any>{
        return Observable.create(observer => {

        });
    }

    get(id: number): Observable<any>{
        return Observable.create(observer => {

        });
    }
}