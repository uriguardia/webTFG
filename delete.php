<?php
require_once 'config.php';

// We fetch the class id
$groupid = $_GET['id'];

// Prepare the query and execute
$sql = "SELECT * FROM tbl_upload WHERE group_id='$groupid'";
$result = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($result)){
	// Unlink the file from the /upload file
	$filename = $row['file_name'];
	$path = "uploads/$filename";
	unlink($path);
}

// We prepare the multiple queries
$del = "DELETE FROM tbl_classes WHERE id='$groupid';";

$del .= "DELETE FROM tbl_upload WHERE group_id='$groupid'";

// We execute the queries
$result = mysqli_multi_query($link, $del);

header("Location: upload.php");
?>