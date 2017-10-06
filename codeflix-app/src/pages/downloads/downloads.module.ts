import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { DownloadsPage } from './downloads';

@NgModule({
  declarations: [
    DownloadsPage,
  ],
  imports: [
    IonicPageModule.forChild(DownloadsPage),
  ],
  exports: [
    DownloadsPage
  ]
})
export class DownloadsPageModule {}
