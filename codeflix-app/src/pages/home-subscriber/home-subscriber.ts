import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from 'ionic-angular';
import {VideoResource} from "../../providers/resources/video.resource";
import {FormControl} from "@angular/forms";
import "rxjs/add/operator/debounceTime";
import {Auth} from "../../decorators/auth.decorator";
import {VideoFactory} from "../../providers/video/video.factory";
import {VideoDownload} from "../../providers/video/video.download";
import {VideoAdapter} from "../../providers/video/video.adapter";

/**
 * Generated class for the HomeSubscriberPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@Auth()
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
    showSearchBar = false;
    search = "";
    formSearchControl = new FormControl();
    videoAdapter: VideoAdapter;

    constructor(public navCtrl: NavController,
                public navParams: NavParams,
                public videoFactory: VideoFactory,
                public videoDownload: VideoDownload) {
        this.videoAdapter = this.videoFactory.get();
    }

    getVideos() {
        return this.videoAdapter.latest(this.page, this.search);
    }

    ionViewDidLoad() {
        this.searchVideos();
        this.getVideos()
            .subscribe((videos) => {
                this.videos = videos;
            });
    }

    searchVideos() {
        this.formSearchControl
            .valueChanges
            .debounceTime(1500)
            .subscribe(() => {
                if(this.search=="" || !this.search){
                    return;
                }
                this.reset();
                this.getVideos()
                    .subscribe((videos) => {
                        this.videos = videos;
                    });
            });
    }

    doRefresh(refresher) {
        this.reset();
        this.getVideos()
            .subscribe((videos) => {
                this.videos = videos;
                refresher.complete();
            }, () => refresher.complete());
    }

    doInfinite(infiniteScroll) {
        this.page++;
        this.getVideos()
            .subscribe((videos) => {
                this.videos.data = this.videos.data.concat(videos.data);
                if (videos.data.length == 0) {
                    this.canLoadingMoreVideos = false;
                }
                infiniteScroll.complete();
            }, () => infiniteScroll.complete());
    }

    reset() {
        this.page = 1;
        this.canLoadingMoreVideos = true;
    }
}
