<!DOCTYPE html>
<html>
<body>

<?php
	echo exec('whoami');
?>

<form action="uploadFile.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>


</body>
<html>
