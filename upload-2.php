<?php
require_once 'config.php';
// fetch files
 session_start();
 $id = $_SESSION["id"];
 $sql = "SELECT * FROM tbl_classes WHERE created_by ='$id'";
 $mysql = "SELECT * FROM tbl_classes WHERE created_by ='$id'";
 $result1 = mysqli_query($link, $sql);
 $result2 = mysqli_query($link, $mysql);
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
<div class="page-header">
	<a href="register-class.php" class="btn btn-danger">Register New Class</a>
	<?php if($fil = mysqli_fetch_array($result2)) {?>
		<a href="register-upload.php" class="btn btn-danger">Upload</a>
		<?php
	}?>
	<a href="welcome.php" class="btn btn-default">Return</a>
</div>
<br/>
<div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Description</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($result1)) { ?>
                <tr>
                    <td><?php echo $row['group_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <?php echo"<td><a href=\"delete.php?id=".$row['id']."\">Delete</a></td>"?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
</body>
</html>