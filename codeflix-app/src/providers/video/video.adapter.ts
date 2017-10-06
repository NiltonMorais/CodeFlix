import {Observable} from "rxjs/Observable";

export interface VideoAdapter {

    latest(page: number, search: string): Observable<any>;

    get(id: number): Observable<any>;
}