import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams, ToastController} from "ionic-angular";
import {Auth} from "../../decorators/auth.decorator";
import {UserResource} from "../../providers/resources/user.resource";

/**
 * Generated class for the MySettingsPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@Auth()
@IonicPage()
@Component({
    selector: 'page-my-settings',
    templateUrl: 'my-settings.html',
})
export class MySettingsPage {

    user = {
        password: '',
        password_confirmation: ''
    };

    constructor(public navCtrl: NavController,
                public navParams: NavParams,
                public toastCtrl: ToastController,
                public userResource: UserResource) {
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad MySettingsPage');
    }

    submit() {
        let toast = this.toastCtrl.create({
            duration: 3000,
            position: 'top',
            cssClass: '.toast-reverse'
        });
        this.userResource
            .updatePassword(this.user)
            .then(() => {
                toast.setMessage('Dados salvos com sucesso');
                toast.present();
            })
            .catch(() => {
                toast.setMessage('Dados inválidos! Tente novamente');
                toast.present();
            })
    }

}
