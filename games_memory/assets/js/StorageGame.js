
class StorageGame{

  constructor(model){
    this.modelStorage = model; //This variable contains the name of the local storge model.
  }

  getStorage(){
    return localStorage.getItem(this.modelStorage);
  }
  setStorage(json){
    return localStorage.setItem(this.modelStorage,json);
  }



}   

