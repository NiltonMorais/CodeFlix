import {Component} from "@angular/core";
import {IonicPage, LoadingController, NavController, NavParams} from "ionic-angular";
import {PlanResource} from "../../providers/resources/plan.resource";
import {Observable} from "rxjs/Observable";
import "rxjs/add/operator/map";

/**
 * Generated class for the PlansPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
    selector: 'page-plans',
    templateUrl: 'plans.html',
})
export class PlansPage {
    plans: Observable<Array<Object>>;

    constructor(public navCtrl: NavController,
                public planResource: PlanResource,
                public loadingCtrl: LoadingController,
                public navParams: NavParams) {
    }

    ionViewDidLoad() {
        let loading = this.loadingCtrl.create({
            content: 'Carregando...'
        });
        loading.present();
        this.plans = this.planResource.all()
            .map(plans => {
                loading.dismiss();
                return plans;
            });
    }

}
