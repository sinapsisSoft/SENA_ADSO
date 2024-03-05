class Calculator {

  constructor(oneLabel, twoLabel) {

    this.oneLabel = document.getElementById(oneLabel);
    this.twoLabel = document.getElementById(twoLabel);
    this.numOne = "";
    this.numTwo = "";
    this.srtFuntions = "";
    this.result = "";
    this.operation = "";
  }

  /*This methods get and set */

  get getNumOne() {
    return this.numOne;
  }
  get getNumTwo() {
    return this.numTwo;
  }
  get getOperation() {
    return this.operation;
  }

  setNumOne(num) {
    this.numOne = parseFloat(num);
  }
  setNumTwo(num) {
    this.numTwo = parseFloat(num);;
  }
  setOperation(ope) {
    this.operation = ope;
  }
  setSrtFuntions(srtFuntions) {
    this.srtFuntions = srtFuntions;
  }

  /*This method is for addition operations*/
  addition() {
    this.srtFuntions = this.numOne + this.operation + this.numTwo;
    this.result = eval(this.srtFuntions);
  }
  

  subtraction() {

  }
  division() {

  }
  multiplication() {

  }
  operations(srtfuntions) {
    this.srtFuntions = srtfuntions;
    this.result = eval(this.srtFuntions);
  }
  /*This method is for print result */

  print(type) {
    if (type == "f") {
      this.result = parseFloat(this.result);
    } else if (type = "d") {
      this.result = parseInt(this.result);
    }
    return this.result;
  }
  clean() {

  }
  delete() {

  }



}