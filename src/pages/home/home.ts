import { Component } from '@angular/core';
import { NavController,ToastController,App } from 'ionic-angular';
import { AuthServiceProvider } from '../../providers/auth-service';


import { Storage } from '@ionic/storage';

import { RegisPage } from '../regis/regis';
import { MenuPage } from '../menu/menu';
@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  
  resposeData : any;
  userData = {
    "username": "",
    "password": ""
  }; 
  public LoginID:any;
  public profile:any;
  constructor(private storage: Storage,public app: App,public navCtrl: NavController,public authService:AuthServiceProvider,public toastCtrl:ToastController) {

  }
  login(){
    if (this.userData.username && this.userData.password) {
      this
        .authService
        .postData(this.userData, "login")
        .then((result) => {
          this.resposeData = result;
          console.log(this.resposeData);
          if (this.resposeData.Doctor) {
            this.profile=this.resposeData.Doctor;
            this.LoginID=this.profile[0].id_doctor;
            this.storage.set("userData",  this.LoginID);
            //localStorage.setItem('userData', JSON.stringify(this.resposeData))
           this.navCtrl.push(MenuPage);

          } else if(this.resposeData.patient){
            this.profile=this.resposeData.patient;
            this.LoginID=this.profile[0].id_patient;
            this.storage.set("userdata",  this.LoginID);
              //localStorage.setItem('userdata', JSON.stringify(this.resposeData))
              this.navCtrl.push(MenuPage);
           
          }else{
            this.presentToast("กรุณาตรวจสอบชื่อผู้ใช้งานเเละรหัสผ่านให้ถูกต้อง");
          }
        }, (err) => {
          this.presentToast("กรุณาเปิดใช้งานอินเตอร์เน็ตด้วยค่ะ");
        });
    } else {
      this.presentToast("กรุณากรอกอีเมล์เเละรหัสผ่าน");
    }

  }
   presentToast(msg) {
    let toast = this
      .toastCtrl
      .create({message: msg, duration: 2000});
    toast.present();
  }
  
  register(){
    this.navCtrl.push(RegisPage)
  }

}
