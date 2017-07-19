<?php
header("Content-Type: text/html");

if (isset($_POST['lamp']) && isset($_POST['state'])) {

	$lamp = htmlspecialchars($_POST['lamp']);
	$state = htmlspecialchars($_POST['state']);

	$execute = "sudo kaku $lamp A $state";
	shell_exec($execute);
}
?>
