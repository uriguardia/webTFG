<?php
require_once 'config.php';
include 'register-upload.php';

if(isset($_POST['btn_upload']))
{        
 $filename = $_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $name = $_POST['name'];
 $groupname = $_POST['group'];
 $desc = $_POST['description'];
 $phase = $_POST['phase'];
 $folder ="uploads/";
  // moves file to directory
 move_uploaded_file($file_loc,$folder.$filename);
 
 $query = "INSERT INTO tbl_upload(file_name,default_name,file_type,group_name,size,description,phase_name,created_by) VALUES('$filename','$name','$file_type','$groupname','$file_size','$desc','$phase','$id')";
 if(mysqli_query($link,$query)){
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