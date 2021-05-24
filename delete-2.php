<?php
//delete.php
require_once 'config.php';

// Fetch the upload id
$uploadid = $_GET['id']; 

// Prepare the query and execute
$sql = "SELECT * FROM tbl_upload WHERE id='$uploadid'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
	
// Unlink the file from the /upload file
$filename = $row['file_name'];
$path = "uploads/$filename";
unlink($path);

// Prepare the query to delete
$del = "DELETE FROM tbl_upload WHERE id='$uploadid'";
$result = mysqli_query($link, $del);

header("Location: view.php");
?>