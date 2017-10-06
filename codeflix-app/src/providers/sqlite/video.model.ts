import {DBModel} from "./db-model";
import {DB} from "./db";
import {Auth} from "../auth";
import {Injectable} from "@angular/core";

@Injectable()
export class VideoModel extends DBModel{

    protected table = "videos";

    constructor(public db: DB,
                public auth: Auth){
        super(db);
    }

    insert(params: Object): Promise<any>{
       return this.auth.user().then(user => {
           (<any>params).user_id = (<any>user).id;
           return super.insert(params);
       })
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