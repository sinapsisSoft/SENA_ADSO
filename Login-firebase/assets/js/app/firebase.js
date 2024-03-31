// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDceiKbOhgcjndd_VqsqDDJ7GFTET2TrQQ",
  authDomain: "login-firebase-4499b.firebaseapp.com",
  projectId: "login-firebase-4499b",
  storageBucket: "login-firebase-4499b.appspot.com",
  messagingSenderId: "353165650009",
  appId: "1:353165650009:web:d9ea274bca8b768d65a948"
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);


