/*
Author:ING. DIEGO CASALLAS
Date:13/04/2024
Description: 
*/
class Chronometer {

  constructor(chronometerId, speed, maxMilliseconds) {
    this.objChronometer = document.getElementById(chronometerId);
    this.getElementsLabel = this.objChronometer.querySelectorAll('label');
    this.conT = 0;
    this.seconds = "00";
    this.minutes = "00";
    this.hourd = "00";
    this.secondsAux = 0;
    this.minutesAux = 0;
    this.hourdAux = 0;
    this.speed = speed;
    this.maxMilliseconds = maxMilliseconds;
    this.intervalID;
  }

  startChronometer() {
    this.intervalID = setInterval(() => {
      this.seconds = this.secondsAux.toString().length == 1 ? "0" + this.secondsAux.toString() : this.secondsAux;
      this.getElementsLabel[2].innerHTML = this.seconds;
      this.secondsAux++;
      this.minutes = this.minutesAux.toString().length == 1 ? "0" + this.minutesAux.toString() : this.minutesAux;
      this.getElementsLabel[1].innerHTML = this.minutes;
      this.hourd = this.hourdAux.toString().length == 1 ? "0" + this.hourdAux.toString() : this.hourdAux;
      this.getElementsLabel[0].innerHTML = this.hourd;

      if (this.secondsAux == 60) {
        this.minutesAux++;
        this.secondsAux = 0;
      }
      if (this.minutesAux == 60) {
        this.hourdAux++;
        this.minutesAux = 0;
      }
      if (this.conT == this.maxMilliseconds) {
        this.conT = 0;
        this.clearChronometer();
      }
      this.conT++;

    }, this.speed);
  }
  clearChronometer() {
    clearInterval(this.intervalID);
    this.getElementsLabel[0].innerHTML = "00";
    this.getElementsLabel[1].innerHTML = "00";
    this.getElementsLabel[2].innerHTML = "00";

  }

  getSeconds() {
    return this.seconds;
  }
  getMinutes() {
    return this.minutes;
  }
  getHourd() {
    return this.hourd;
  }
}