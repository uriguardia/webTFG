<?php
require_once 'config.php';
// fetch files
 session_start();
 $id = $_SESSION["id"];
 $query = "SELECT * FROM tbl_classes WHERE created_by ='$id'";
 $sql = "SELECT * FROM tbl_upload WHERE created_by ='$id'";
 $result1 = mysqli_query($link, $sql);
 $result2 = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualize</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div class="page-header">
    <a href="welcome.php" class="btn btn-default">Return</a>
    <label for="description">Choose the group:</label>
    <select name="group">
    <?php
        while($row = mysqli_fetch_array($result2)) { ?>
            <option><?php echo $row['group_name']; ?></td>
        <?php } ?>
    </select>
</div>
<br/>
<div class="row">
        <div class="col-xs-8 col-xs-offset-1">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Phase</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Download</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($result1)) { ?>
                <tr>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['file_name']; ?></td>
                    <td><?php echo $row['creation_date']; ?></td>
                    <td><a href="uploads/<?php echo $row['file_name']; ?>" download>Download</a></td>
                    <?php echo"<td><a href=\"delete.php?id=".$row['id']."\">Delete</a></td>"?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
</body>
</html>