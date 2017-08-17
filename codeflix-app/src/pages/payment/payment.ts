import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams} from "ionic-angular";
import scriptjs from "scriptjs";

declare var PAYPAL;

/**
 * Generated class for the PaymentPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
    selector: 'page-payment',
    templateUrl: 'payment.html',
})
export class PaymentPage {

    constructor(public navCtrl: NavController, public navParams: NavParams) {
    }

    ionViewDidLoad() {
        scriptjs('https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js', () => {
            let ppp = PAYPAL.apps.PPP({
                approvalUrl: '',
                placeholder: 'ppplus',
                mode: 'sandbox',
                country: 'BR',
                language: 'pt_BR',
                payerFirstName: 'Nilton',
                payerLastName: 'Morais',
                payerEmail: 'admin@user.com',
                payerTaxId: '34298482456',
                payerTaxIdType: 'BR_CPF',
            });
        });
    }

}
