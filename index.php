<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Meeuwhuis</title>
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script>
		$( document ).ready(function() {

			check_moisture();
			var auto_refresh = window.setInterval( (function() {
				$("#presence_container").load("php/presence.php");
			}), 5000);

		});

		function check_moisture() {
			update_moisture();
			var halfHour = 1000 * 60 * 30;
			var statusIntervalId = window.setInterval(update_moisture, halfHour);
		}


		function update_moisture() {
		    $.ajax({
			url: 'php/check_moisture.php',
			dataType: 'text',
			success: function(data) {
				if(data == 0) {
			   		$("#moisture").text("The ground is moist.").addClass("success");
				}
				else if(data == 1) {
					$("#moisture").text("The ground is dry.").addClass("failure");
				}
				else {
					$("#moisture").text("No data available").addClass("failure");
				}
				}
			});
		}

	</script>
</head>
<body style="margin: 35px auto 25px;">


<?php //var_dump(shell_exec("sudo kaku 1 A $(rm test)")); ?>

<script src="https://www.gstatic.com/firebasejs/4.1.2/firebase.js"></script>
<script type="text/javascript">var config = {
    apiKey: "AIzaSyAr-ed-t124wXCRQ16dXbhLKYobf_3OxFw",
    authDomain: "huisapp-23e14.firebaseapp.com",
    databaseURL: "https://huisapp-23e14.firebaseio.com",
    projectId: "huisapp-23e14",
    storageBucket: "huisapp-23e14.appspot.com",
    messagingSenderId: "406121599985"
	};

firebase.initializeApp(config);

var provider = new firebase.auth.GoogleAuthProvider();

var user = firebase.auth().currentUser;

firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
  console.log("There is a user")
  setPageLoggedIn(user);
  } else {
    // No user is signed in.
  console.log("There is no user")
  }
});

function login(){
	firebase.auth().signInWithRedirect(provider);
}

function logout(){
	firebase.auth().signOut().then(function() {
  setPageLoggedOut();
}).catch(function(error) {
  // An error happened.
});
}


firebase.auth().getRedirectResult().then(function(result) {
  if (result.user) {
    var user = result.user;

    setPageLoggedIn(user);

  }

}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});

function setPageLoggedIn(user){
	var displayName = user.displayName;

    document.getElementById("welcome").innerHTML = "Welcome " + displayName + " to our website.";

    $("#lights").load("php/light.php");
    $("#upload_files").load("php/upload.php");
    $("#uploaded_files").load("php/uploaded_files.php");
    //$("#who_is_home").load("php/presence.php");
}

function setPageLoggedOut(){
	document.getElementById("welcome").innerHTML = "Welcome to our website.";

	document.getElementById("lights").innerHTML = "Log in to control the lights"
	document.getElementById("upload_files").innerHTML = "Log in to upload files"
	document.getElementById("uploaded_files").innerHTML = "Log in to see the uploaded files"
	document.getElementById("who_is_home").innerHTML = "Log in to see who's home"
}

</script>


<h1 id="logo">
<img src="/images/logo.jpg" style="box-shadow: 0px 2px 10px 0.5px; align: center; border-radius: 50%; height: 190px; width: 190px;"/>
</h1>
<p style="text-align: center">Bow for the mighty Gull</p>

<h2>Welcome</h2>
<p id="welcome">Welcome to our website.<p>
<button onClick="login()">Log in</button>
<button onClick="logout()">Log out</button>
<p style="text-align: right">&#8212; Derk Barten & Jimmy van der Schalk</p>

<h2>Lights</h2>
<div id="lights">Log in to control the lights</div>

<script>
function setLight(id, state){
    $.ajax({
        url: '/php/lights_state.php',
        type:'POST',
        data:
        {
        	'lamp': id,
            'state': state
        }
    });
}
</script>

<h2>Whats Up With The Plant?</h2>
<img src="http://meeuwhuis.tk:8080/?action=stream" style="width: 100%"/>
<p id="moisture" class="notification">No Data</p>
<?php
$planted = strtotime('2017-5-11 00:00:00');
$now = strtotime(date('Y-m-d H:i:s'));

$diff = $now - $planted;
$days_diff = floor(abs($diff) / 60 / 60 / 24);
echo "<p>Seeds planted $days_diff days ago </p>";
?>
<h2>Who's Home</h2>
<!-- <?php include "php/presence.php"; ?> -->
<div id="who_is_home">Log in to see who's home</div>

<h2>File Upload</h2>
<div id="upload_files">Log in to upload files</div>

<h2>Uploaded files</h2>
<div id="uploaded_files">Log in to see the uploaded files</div>

</html>
