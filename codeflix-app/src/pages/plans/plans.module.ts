import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { PlansPage } from './plans';

@NgModule({
  declarations: [
    PlansPage,
  ],
  imports: [
    IonicPageModule.forChild(PlansPage),
  ],
  exports: [
    PlansPage
  ]
})
export class PlansPageModule {}
