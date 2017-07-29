<?php

$invalid_state = False;
$invalid_lamp = False;
$not_set = False;
$lamp_check = False;

$file = file_get_contents("meeuwhuis.nl/lamps.json");
$json = json_decode($file, true);
$lamps = count($json['lamps']);
if ($lamps == 0){
  $lamps = 3;
}

if (isset($_GET['lamp']) && isset($_GET['state'])) {

        $lamp = htmlspecialchars($_GET['lamp']);
        $state = htmlspecialchars($_GET['state']);

	if($state != "on" && $state != "off"){
		$invalid_state = True;
	}

	for($i = 1; $i <= $lamps; $i++) {
		if ($i == $lamp){
			$lamp_check = True;
			break;
		}
	}

	if (!$lamp_check) {
		$invalid_lamp = True;
	}

	if (!$invalid_state && !$invalid_lamp) {
        	shell_exec("sudo kaku $lamp A $state");
	}
}
else {
	$not_set = True;
}

if ($not_set){
	echo "Lamp or state is not set.";
}
elseif ($invalid_state){
	echo "The given state is invalid, choose 'on' or 'off'.";
}
elseif ($invalid_lamp){
	echo "The given lamp number is invalid, choose a value between and including 1 and $lamps.";
}
else {
	echo "Success";
}
?>
