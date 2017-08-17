import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams} from "ionic-angular";
import scriptjs from "scriptjs";
import {UserResource} from "../../providers/resources/user.resource";
import {PaymentResource} from "../../providers/resources/payment.resource";

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

    user = null;
    payment = null;
    planId = null;
    ppplusLoaded = false;
    ppp = null;

    constructor(public navCtrl: NavController,
                public navParams: NavParams,
                public userResource: UserResource,
                public paymentResource: PaymentResource) {
        this.planId = +this.navParams.get('plan');
    }

    ionViewDidLoad() {
        scriptjs('https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js', () => {

        });
        this.userResource.get().subscribe(user => this.user = user);
        this.paymentResource.get(this.planId).subscribe(payment => this.payment = payment);
    }

    makePayPalPlus(){
        if(this.ppplusLoaded && this.payment != null && this.user != null){
            this.ppp = PAYPAL.apps.PPP({
                approvalUrl: this.payment.approvalUrl,
                placeholder: 'ppplus',
                mode: 'sandbox',
                country: 'BR',
                language: 'pt_BR',
                payerFirstName: this.user.name.split(" ")[0],
                payerLastName: this.user.name.split(" ")[1],
                payerEmail: this.user.email,
                payerTaxId: this.user.cpf,
                payerTaxIdType: 'BR_CPF',
            });
        }
    }

}
