var config = {
    apiKey: "AIzaSyAr-ed-t124wXCRQ16dXbhLKYobf_3OxFw",
    authDomain: "huisapp-23e14.firebaseapp.com",
    databaseURL: "https://huisapp-23e14.firebaseio.com",
    projectId: "huisapp-23e14",
    storageBucket: "huisapp-23e14.appspot.com",
    messagingSenderId: "406121599985"
	};
  
firebase.initializeApp(config);

var provider = new firebase.auth.GoogleAuthProvider();

	firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Google Access Token. You can use it to access the Google API.
  var token = result.credential.accessToken;
  // The signed-in user info.
  var user = result.user;
  var name = user.displayName;
  document.getElementById("welcome").innerHTML = "Welcome " + name + " to our website.";

  $("#lights").load("php/light.php");
  $("#upload_files").load("php/upload.php");
  $("#uploaded_files").load("php/uploaded_files.php");
  // ...
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  document.getElementById("welcome").innerHTML = "ERROR: " + errorMessage;
});