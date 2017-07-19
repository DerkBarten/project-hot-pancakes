<?php
	$ip = array("192.168.178.157", "192.168.178.24", "192.168.178.1"); 
	$people = array("Derk", "Jimmy", "Routertje");
	
	
	$length = count($ip);
	echo '<div id="presence_container">';
	
	for($x = 0; $x < $length; $x+=2) {
		echo '<div>';
		$r1 = shell_exec("ping -c1 -w 2 $ip[$x] > /dev/null 2>&1; echo $?");
		$y = $x + 1;
		if ($y < $length) {
			$r2 = shell_exec("ping -c1 -w 2 $ip[$y] > /dev/null 2>&1; echo $?");
		}
		if ($r1 == 0) {
			echo "<div class='notification success presence_unit style='float: left'>$people[$x] ($ip[$x]): Connected </div>";
		}
		else {
                        echo "<div class='notification failure presence_unit' style='float: left'>$people[$x] ($ip[$x]): Disconnected </div>";
                }

		if ($y < $length && $r2 == 0) {
	 		echo "<div class='notification success presence_unit' style='float: right'>$people[$y] ($ip[$y]): Connected </div>";
		}
		else if($y < $length) {
			echo "<div class='notification failure presence_unit' style='float: right'>$people[$y] ($ip[$y]): Disconnected </div>";
		}
		
		echo '</div>';
	}
	echo '</div>';
?>
