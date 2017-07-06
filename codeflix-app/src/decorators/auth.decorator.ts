import {appContainer} from "../app/app.container";
import {Auth as AuthService} from "../providers/auth";
import {Nav} from "ionic-angular";
import {LoginPage} from "../pages/login/login";
export const Auth = () => {
  return (target: any) => {
        target.prototype.ionViewCanEnter = function(){
            let property = Object.keys(this)
                .find(value => this[value] instanceof Nav);
            if(typeof property === "undefined"){
                setTimeout(()=>{
                    throw new TypeError("Auth decorator needs NavController instance.");
                });
                return false;
            }
            let authService = appContainer().get(AuthService);
            return authService.check().then(isLogged => {
                if(!isLogged){
                    setTimeout(()=>{
                        let navCtrl = this[property];
                        navCtrl.setRoot(LoginPage);
                    });
                    return false;
                }
                return true;
            })
        }
  }
};