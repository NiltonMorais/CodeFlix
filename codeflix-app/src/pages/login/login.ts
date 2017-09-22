import {Component} from "@angular/core";
import {IonicPage, MenuController, NavController, NavParams, ToastController} from "ionic-angular";
import {Auth} from "../../providers/auth";
import {HomePage} from "../home/home";
import {HomeSubscriberPage} from "../home-subscriber/home-subscriber";
import {AuthOffline} from "../../providers/auth-offline";

/**
 * Generated class for the LoginPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
    selector: 'page-login',
    templateUrl: 'login.html',
})
export class LoginPage {

    user = {
        email: 'admin@user.com',
        password: 'secret'
    };

    constructor(public navCtrl: NavController,
                public menuCtrl: MenuController,
                public navParams: NavParams,
                public toastCtrl: ToastController,
                private auth: Auth,
                private authOffline: AuthOffline) {
        this.menuCtrl.enable(false);
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad LoginPage');
    }

    login() {
        this.auth.login(this.user)
            .then((user) => {
                this.afterLogin(user);
            })
            .catch(() => {
                let toast = this.toastCtrl.create({
                    message: 'Email e/ou senha inválidos.',
                    duration: 3000,
                    position: 'top',
                    cssClass: '.toast-reverse'
                });
                toast.present();
            });
    }

    loginOffline() {
        this.authOffline.login(this.user)
            .then(user => {
                this.afterLogin(user);
            })
            .catch(() => {
                let toast = this.toastCtrl.create({
                    message: 'Email inválido',
                    duration: 3000,
                    position: 'top',
                    cssClass: '.toast-login-error'
                });
                toast.present();
            });
    }

    loginFacebook() {
        this.auth.loginFacebook()
            .then((user) => {
                this.afterLogin(user);
            })
            .catch(() => {
                let toast = this.toastCtrl.create({
                    message: 'Erro ao realizar login no facebook',
                    duration: 3000,
                    position: 'top',
                    cssClass: '.toast-login-error'
                });
                toast.present();
            });
    }

    afterLogin(user) {
        this.menuCtrl.enable(true);
        this.navCtrl.push(user.subscription_valid ? HomeSubscriberPage : HomePage);
    }
}
