<?php

echo "<div>";

$livingroom=1;
$kitchen=2;
$table=3;

echo "<div class=\"lightcontainer\">";

$json = file_get_contents('/var/www/html/lamps.json');
$obj = json_decode($json);
foreach ($obj->lamps as $lamp) {
	$name = $lamp->name;
	$id = $lamp->id;
	echo "<div class=\"lightswitchunit\">";
	
	//echo "<div><a id=\"lamp_on\" href=\"?lamp=$id&state=on\" class=\"lightswitch\">$name on</a></div>";
	//echo "<div><a id=\"lamp_off\" href=\"?lamp=$id&state=off\" class=\"lightswitch\">$name off</a></div>";
	echo "<div><button onClick='setLight($id, \"on\")'>$name on</button></div>";
	echo "<div><button onClick='setLight($id, \"off\")'>$name off</button></div>";
	echo "</div>";
}

echo "</div>";
echo "</div>";

if (isset($_POST['lamp']) && isset($_POST['state'])) {

	$lamp = htmlspecialchars($_POST['lamp']);
	$state = htmlspecialchars($_POST['state']);
	print_r($lamp);
	shell_exec("sudo kaku $lamp A $state");   
}

?>
