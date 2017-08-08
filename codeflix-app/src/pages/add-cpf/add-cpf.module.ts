import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AddCpfPage } from './add-cpf';

@NgModule({
  declarations: [
    AddCpfPage,
  ],
  imports: [
    IonicPageModule.forChild(AddCpfPage),
  ],
  exports: [
    AddCpfPage
  ]
})
export class AddCpfPageModule {}
