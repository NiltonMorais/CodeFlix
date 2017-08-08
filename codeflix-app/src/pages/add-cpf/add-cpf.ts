import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams, ToastController} from "ionic-angular";
import {UserResource} from "../../providers/resources/user.resource";
import {PlansPage} from "../plans/plans";

/**
 * Generated class for the AddCpfPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
    selector: 'page-add-cpf',
    templateUrl: 'add-cpf.html',
})
export class AddCpfPage {
    cpf = null;
    mask = [
      /\d/,/\d/,/\d/,'.',
      /\d/,/\d/,/\d/,'.',
      /\d/,/\d/,/\d/,'-',
      /\d/,/\d/
    ];
    constructor(public userResource: UserResource,
                public navCtrl: NavController,
                public toastCtrl: ToastController,
                public navParams: NavParams) {
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad AddCpfPage');
    }

    submit() {
        this.userResource.addCpf(this.cpf)
            .then(() => this.navCtrl.push(PlansPage))
            .catch(()=>{
                let toast = this.toastCtrl.create({
                    message: 'CPF inválido!',
                    duration: 3000,
                    position: 'top',
                    cssClass: '.toast-reverse'
                });
                toast.present();
            })
    }

}
