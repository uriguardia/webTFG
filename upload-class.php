<?php
require_once 'config.php';
include 'register-class.php';
// get user id
session_start();
$id = $_SESSION["id"]; 

if(isset($_POST['btn-class']))
{  
 $groupname = $_POST['name'];
 $desc = $_POST['description']; 
 $sql = "INSERT INTO tbl_classes(group_name,description,created_by) VALUES('$groupname','$desc','$id')";
 if(mysqli_query($link,$sql)){
  ?>
    <script>
  alert('successfully uploaded');
        window.location.href='upload-2.php?success';
        </script>
  <?php
 }
 else{
    ?>
  <script>
  alert('error while uploading file');
        window.location.href='upload-2.php?fail';
        </script>
  <?php
 }
}
?>