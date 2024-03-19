//let objUser= '{"'+modelStorage+'":["user":"'+getData+'","points":"0"]}';

class StorageGame{

  constructor(){
    this.modelStorage = "User"; //This variable contains the name of the local storge model.
  }

  getStorage(){
    return localStorage.getItem(this.modelStorage);
  }
  setStorage(json){
    return localStorage.setItem(this.modelStorage,json);
  }

}

