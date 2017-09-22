import {Injectable} from "@angular/core";
import {DBModel} from "./db-model";

@Injectable()
export class UserModel extends DBModel {

    protected table = "users";
}
