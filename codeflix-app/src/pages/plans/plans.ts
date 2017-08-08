import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {PlanResource} from "../../providers/resources/plan.resource";

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
  plans = [];
  constructor(
      public navCtrl: NavController,
      public planResource: PlanResource,
      public navParams: NavParams) {
  }

  ionViewDidLoad() {
    this.planResource.all().then(plans => this.plans = plans);
  }

}
