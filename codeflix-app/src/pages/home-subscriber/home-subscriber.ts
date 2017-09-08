import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {VideoResource} from "../../providers/resources/video.resource";

/**
 * Generated class for the HomeSubscriberPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-home-subscriber',
  templateUrl: 'home-subscriber.html',
})
export class HomeSubscriberPage {

  videos = [];
  constructor(
              public navCtrl: NavController,
              public videoResource: VideoResource,
              public navParams: NavParams) {
  }

  ionViewDidLoad() {
    this.videoResource.latest(1)
        .subscribe((videos) => {
          this.videos = videos;
        });
  }

}
