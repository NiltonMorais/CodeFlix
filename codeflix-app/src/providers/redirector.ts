import { Injectable } from '@angular/core';
import {Subject} from "rxjs/Subject";
import {NavController} from "ionic-angular";

/*
  Generated class for the Redirector provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular DI.
*/
@Injectable()
export class Redirector {
  subject = new Subject;
  link;

  config(navCtrl:NavController){
    this.subject.subscribe(()=>{
      setTimeout(()=>{
        navCtrl.setRoot(this.link);
      });
    })
  }

  redirector(link = 'LoginPage'){
    this.link = link;
    this.subject.next();
  }
}
