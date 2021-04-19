<?php
//delete.php
require_once 'config.php';
include 'upload-2.php';

$id = $_GET['id']; //this needs to be sanitized

$del = "DELETE FROM tbl_classes WHERE id='$id'";
$result = mysqli_query($link, $del);

header("Location: upload-2.php");
?>