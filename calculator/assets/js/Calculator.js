class Calculator {

  constructor(oneLabel, twoLabel) {
    /*This label operations*/
    this.oneLabel = document.getElementById(oneLabel);
    /*This label shows the adata entered */
    this.twoLabel = document.getElementById(twoLabel);
    this.numOne = "0";
    this.numTwo = "";
    this.srtFuntions = "";
    this.result = "";
    this.operation = "";
    this.selected = true;
    this.arrayOperations = ['+/-', '/', '*', '+', '-', 'Enter', '%', 'CE', 'C', '=', '⪡'];
    this.arrayNumber = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ','];
    this.arrayKeyboard = this.arrayNumber.concat(this.arrayNumber, this.arrayOperations);

    this.getDataKeyBoard = "";
    this.getDataKeyButton = "";

  }

  /*This methods get and set */
  getNumOne() {
    return this.numOne;
  }
  getNumTwo() {
    return this.numTwo;
  }
  getOperation() {
    return this.operation;
  }
  /*This method is for addition operations*/
  getSrtFuntions() {
    if (this.numOne != "" && this.numTwo != "" && this.operation != "") {
      this.srtFuntions = this.numOne + this.operation + this.numTwo;
    }
    return this.srtFuntions;
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
  setTagData(data) {

    if (this.arrayOperations.includes(data)) {

      switch (data) {
        case this.arrayOperations[1]:
          this.operation = data;
          this.selected = false;
          break;
        case this.arrayOperations[2]:
          this.operation = data;
          this.selected = false;
          break;
        case this.arrayOperations[3]:
          this.operation = data;
          this.selected = false;
          break;
        case this.arrayOperations[4]:
          this.operation = data;
          this.selected = false;
          break;
        case this.arrayOperations[7]:
          this.clean();
          break;
        case this.arrayOperations[8]:
          this.delete();
          break;
        case this.arrayOperations[9]:
          this.setResult();
          break;
        case this.arrayOperations[10]:
          this.textBack();
          break;
      }


    } else {

      this.numOne=(this.numOne=="0"?"":this.numOne)+data;
      this.setTwoLabel(this.numOne);
    
    }

    if (!this.selected) {
      this.numTwo = this.getTwoLabel();
      this.numOne="";
      let newText = this.numTwo + this.operation + this.numOne;
      
    
      this.setOneLabel(newText);
      console.log(data);
      this.selected=true;
      debugger;
    }

  }
  setResult() {
    let newText = this.numOne + this.operation + this.numTwo + "=";
    this.srtFuntions=this.numOne + this.operation + this.numTwo;
    this.setOneLabel(newText);
    this.setTwoLabel(this.operate());
 
  }
  setTwoLabel(data) {
    this.twoLabel.firstChild.nodeValue = "";
    this.twoLabel.firstChild.nodeValue = data;
  }
  setOneLabel(data) {
    this.oneLabel.firstChild.nodeValue = "";
    this.oneLabel.firstChild.nodeValue = data;
  }
  getTwoLabel() {
    return this.twoLabel.firstChild.nodeValue;
  }
  setTagDataOperations() {
    //this.twoLabel.firstChild.nodeValue = aux + data;
    console.log(this.getSrtFuntions());
  }
  /*This method is for operated return result or result =0*/
  operate() {
    if (this.srtFuntions != "") {
      this.result = eval(this.srtFuntions);
    } else {
      this.result = "0";
    }
   return this.result;
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
  /*This method is to clean the label value of the data entered for the operation*/
  clean() {
    this.twoLabel.innerHTML = "0";
    this.numOne = "";
  }
  /*This method consists of removing the label form the entered data and resenting the value of the response variables,as well as the operations label*/

  delete() {
    this.oneLabel.innerHTML = "0";
    this.twoLabel.innerHTML = "0";
    this.numTwo = "";
    this.numOne = "";
  }
  /*This method is text back <-*/
  textBack() {
    let textLabel = this.twoLabel.firstChild.nodeValue;
    if (textLabel.length > 1) {
      this.twoLabel.firstChild.nodeValue = textLabel.substring(0, textLabel.length - 1);
    }

  }


}