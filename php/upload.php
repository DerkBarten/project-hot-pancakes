<?php
echo '<form method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>';

// This part handles the file uploading of the site
if (isset($_POST['submit'])){
	echo "Ik doe toch nog wel wat";
	$target_dir = "uploads/";
	$name =  basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir . $name;
	$uploadOk = 1;

	if ($name == "") {
		 echo '<div><p class="notification warning">No file selected.</p></div>';
		$uploadOk = 0;
	}

	if(file_exists($target_file) &&  $name != "") {
		unlink($target_file);
	}
	
	$max =  1024 * 1024 *(int)ini_get("upload_max_filesize" );
	$size = $_FILES["fileToUpload"]["size"];

	if ($size> $max) {
		echo "<div><p id=\"failure\" class=\"notification\">Sorry, your file is too large. The maximum is $max.</p></div>";	
		$uploadOk = 0;
	}
if ($uploadOk == 1) {
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
		echo "<div><p class=\"notification success\"> File uploaded successfully</p></div>";
	    } else {
		echo "<div><p class=\"notification failure\">Sorry, there was an error uploading your file.</p></div>";
	    }
	}
}
?>
