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
  page = 1;
  constructor(
              public navCtrl: NavController,
              public videoResource: VideoResource,
              public navParams: NavParams) {
  }

  ionViewDidLoad() {
      this.getVideos()
        .subscribe((videos) => {
          this.videos = videos;
        });
  }

  doRefresh(refresher){
      this.page = 1;
      this.getVideos()
          .subscribe((videos) => {
              this.videos = videos;
              refresher.complete();
          },() => refresher.complete());
  }

  getVideos(){
      return this.videoResource.latest(this.page);
  }
}
