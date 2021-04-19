<?php
require_once 'config.php';
// fetch files
 session_start();
 $id = $_SESSION["id"];
 $sql = "SELECT * FROM tbl_classes WHERE created_by ='$id'";
 $result = mysqli_query($link, $sql);
?>
<script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["name"].value;
    if (a == null || a == "") {
      alert("Please fill the *Name field");
      return false;
    }
  }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Files</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Upload New File</h2>
        <form action="upload-image.php" name="Form" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Choose Image</label>
                <input type="file" name="file">
            </div>
            <div class="form-group">
                <label for="description">Choose the DT fase:</label>
                <select name="phase">
                    <option value="Emphatize">Emphatize</option>
                    <option value="Define">Define</option>
                    <option value="Try">Try</option>
                    <option value="Prototype">Prototype</option>
                    <option value="Test">Test</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Choose the group:</label>
                <select name="group">
                <?php
                while($row = mysqli_fetch_array($result)) { ?>
                    <option><?php echo $row['group_name']; ?></td>
                <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">*Name</label>
                <input type="text" class="form-control" name="name" id="a">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-danger" name="btn_upload">
                <a href="upload-2.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>