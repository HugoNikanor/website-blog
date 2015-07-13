<!DOCTYPE html>
<html>
<body>

<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	require 'password.php';

	//echo exec('whoami');

	if(isset($_GET['pass'])) {
		if(getPass() === $_GET['pass']) : ?>
			<form action="uploadFile.php" method="post" enctype="multipart/form-data">
				Select file to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload File" name="submit">
			</form>
		<?php else : ?>
			<p>Good try</p>
		<?php endif; ?>
<?php
	} else {
		echo('<p>Are you even trying?</p>');
	}

?>



</body>
<html>
