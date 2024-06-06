/**
 * Author:DIEGO CASALLAS
 * Date:23/05/2024
 * Descriptions:This is controller class for managing alerts
 * **/

class Alert {

  constructor(alertIds) {
    this.arrayTypeAlerts = ['primary','secondary','success','danger','warning','info','light','dark'];
    this.position ;
    this.message;
    this.type;
    this.arrayAlerts=[];
    if (Array.isArray(alertIds)) {
      for (let i = 0; i < alertIds.length; i++) {
        this.arrayAlerts.push(document.getElementById(alertIds[i]));
      }
    } else {
      this.arrayAlerts.push(document.getElementById(alertIds[i]));
    }
    
  }

  createAlert(parameters) {

    if(parameters['position']===undefined){
      this.position = 0;
    }else{
      this.position=parameters['position'];
    }
    if(parameters['message']===undefined){
      this.message = "Default";
    }else{
      this.message=parameters['message'];
    }
    if(parameters['type']===undefined){
      this.type = this.arrayTypeAlerts[0];
    }else{
      this.type=this.arrayTypeAlerts[parameters['type']];
    }
    this.arrayAlerts[this.position].innerHTML = [
      `<div class="alert alert-${this.type} alert-dismissible" show role="alert">`,
      `   <div>${this.message}</div>`,
      '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
      '</div>'
    ].join('');
    
  }


}