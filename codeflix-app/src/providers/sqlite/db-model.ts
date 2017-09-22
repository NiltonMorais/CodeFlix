import {Injectable} from "@angular/core";
import objectValues from 'object.values';
import {DB} from "./db";

@Injectable()
export abstract class DBModel {

    protected abstract table;

    constructor(public db: DB) {
    }

    insert(params: Object): Promise<any>{
        let columns = Object.keys(params);
        columns.map((value) => {
            return `\`${value}\``;
        });
        let tokens = "?,".repeat(columns.length);
        tokens = tokens.substring(0,tokens.length-1);
        let sql = `INSERT INTO \`${this.table}\` (${columns.join(',')}) VALUES(${tokens})`;
        return this.db.executeSql(sql,objectValues(params));
    }

    find(id):Promise<any>{
        let sql = `SELECT * FROM ${this.table} WHERE id = ?`;
        return this.db.executeSql(sql,[id])
            .then(resultset => {
                return resultset.rows.length ? resultset.rows.item(0) : null;
            });
    }

    findByField(field, value){
        let sql = `SELECT * FROM ${this.table} WHERE \`${field}\` = ?`;
        return this.db.executeSql(sql,[value]);
    }
}
