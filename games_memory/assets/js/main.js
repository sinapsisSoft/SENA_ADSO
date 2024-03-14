var objClass;
const contId="containerGame";
const progress="progressbarId";
const chronometer="chronometerId";
const speed=100;
const maxMilliseconds=2000;

function setLevel(value){

    objClass=new Game(contId,value,progress,chronometer,speed,maxMilliseconds);  
    
}



