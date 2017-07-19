<?php
$dir    = '/var/www/html/uploads';
$scanned_directory = array_diff(scandir($dir), array('..', '.'));
	foreach ($scanned_directory as $value) {
		echo("<a href=\"/uploads/$value\" download>$value</a> <br>");
	}
?>