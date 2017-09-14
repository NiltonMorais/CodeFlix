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

  videos = {
      data: []
  };

  page = 1;
  canLoadingMoreVideos = true;

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
      this.canLoadingMoreVideos = true;
      this.getVideos()
          .subscribe((videos) => {
              this.videos = videos;
              refresher.complete();
          },() => refresher.complete());
  }

  doInfinite(infiniteScroll){
    this.page++;
      this.getVideos()
          .subscribe((videos) => {
              this.videos.data = this.videos.data.concat(videos.data);
              if(videos.data.length == 0){
                  this.canLoadingMoreVideos = false;
              }
              infiniteScroll.complete();
          },() => infiniteScroll.complete());
  }

  getVideos(){
      return this.videoResource.latest(this.page);
  }
}
