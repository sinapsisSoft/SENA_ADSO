import {createUserWithEmailAndPassword} from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";
import { auth } from "./firebase.js";

const objForm=document.getElementById('formUser');

objForm.addEventListener("submit",async (e)=>{
  e.preventDefault();
  const pass=objForm.querySelector('input[type="password"]').value;
  const user=objForm.querySelector('input[type="email"]').value;

  console.log(user,pass);

  try{
    const userCredentials=await createUserWithEmailAndPassword(auth,user,pass);
    console.log(userCredentials);
  }
  catch(error){
    console.error(error);

  }
})