<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div id="body">
 <form action="upload-file.php" method="post" enctype="multipart/form-data">
 <input type="file" name="file" />
 <label for="description">Choose a DT fase:</label>
 <select name="description">
  <option value="Emphatize">Emphatize</option>
  <option value="Define">Define</option>
  <option value="Try">Try</option>
  <option value="Prototype">Prototype</option>
  <option value="Test">Test</option>
 </select>
 <button type="submit" name="btn-upload">upload</button>
 </form>
    <br /><br />
    <?php
 if(isset($_GET['success']))
 {
  ?>
        <label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>
        <?php
 }
 else if(isset($_GET['fail']))
 {
  ?>
        <label>Problem While File Uploading !</label>
        <?php
 }
 else
 {
  ?>
        <label>Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
        <?php
 }
 ?>
</div>
<div id="footer">
</div>
<p>
        <a href="welcome.php" class="btn btn-danger">Return</a>
</p>
</body>
</html>