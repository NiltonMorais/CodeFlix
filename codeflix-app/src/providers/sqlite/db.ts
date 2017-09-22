import {Injectable} from "@angular/core";
import {SQLitePorter} from "@ionic-native/sqlite-porter";
import {SQLite} from "@ionic-native/sqlite";

/*
 Generated class for the DB provider.

 See https://angular.io/docs/ts/latest/guide/dependency-injection.html
 for more info on providers and Angular DI.
 */
@Injectable()
export class DB {

    constructor(public sqlitePorter: SQLitePorter,
                public sqlite: SQLite) {
    }

}
