import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { HomeSubscriberPage } from './home-subscriber';

@NgModule({
  declarations: [
    HomeSubscriberPage,
  ],
  imports: [
    IonicPageModule.forChild(HomeSubscriberPage),
  ],
  exports: [
    HomeSubscriberPage
  ]
})
export class HomeSubscriberPageModule {}
