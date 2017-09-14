import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from 'ionic-angular';
import {Observable} from "rxjs/Observable";
import {VideoResource} from "../../providers/resources/video.resource";
import {StreamingMedia, StreamingVideoOptions} from "@ionic-native/streaming-media";

/**
 * Generated class for the VideoPlayPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
    selector: 'page-video-play',
    templateUrl: 'video-play.html',
})
export class VideoPlayPage {

    videoId;
    video: Observable<any>;

    constructor(public navCtrl: NavController,
                public navParams: NavParams,
                public videoResource: VideoResource,
                public streamingMedia: StreamingMedia) {
        this.videoId = this.navParams.get('video');
    }

    ionViewDidLoad() {
        this.video = this.videoResource.get(this.videoId);
    }

    play() {
        this.video.subscribe((video) => {
            let options: StreamingVideoOptions = {
                errorCallback: (e) => {console.log(e)},
                orientation: 'landscape'
            };
            this.streamingMedia.playVideo(video.file_url, options);
        });
    }

}
