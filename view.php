<?php
require_once 'config.php';

// start session
session_start();

// Prepare queries
$userid = $_SESSION["id"];
$queryy = "SELECT * FROM tbl_upload WHERE created_by ='$userid' ORDER BY creation_date DESC, default_name;";
$result = mysqli_query($link, $queryy);
$query = "SELECT * FROM tbl_classes WHERE created_by ='$userid' ORDER BY created_at";
$result1 = mysqli_query($link, $query);
$sql = "SELECT * FROM tbl_upload WHERE created_by ='$userid' ORDER BY creation_date DESC, default_name;";
$users = mysqli_query($link, $sql);

// Post process of the upload queries when the filter is used
if(isset($_POST['btn_upload'])){
    $group_name = $_POST['class'];
    $compare = "Show all";
    if ($group_name == "Show all"){
        $sql = "SELECT * FROM tbl_upload WHERE created_by ='$userid'
        ORDER BY creation_date DESC, default_name;";
    }
    else {
        $sql = "SELECT * FROM tbl_upload WHERE created_by ='$userid'
        AND group_name ='$group_name' ORDER BY creation_date DESC, default_name;";
    }
    $users = mysqli_query($link, $sql);
}
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
function myFunction(x) {
  alert("here"+ x);
}
</script>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualize</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{font: 14px sans-serif; text-align: center; background: #fee !important; min-height: 100vh;}
        .center {width: 90%;margin-left: auto;margin-right: auto;}
        .dropdown {position: relative;display: inline-block;}
        .dropdown-content {display: none;position: absolute;background-color: #f9f9f9;min-width: 160px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);padding: 12px 16px;z-index: 1;}
        .dropdown-content a {padding: 12px 16px;display: block;}
        .dropdown:hover .dropdown-content {display: block;}
        table{background-color: fff;}
        .bg-cover {background-size: cover !important;}
        .table-hover > tbody > tr:hover {background-color: #fee;}
        .page-header {padding-bottom: 15px;margin-left: auto;margin-right: auto; width: 95%; border-bottom: 9px solid #fff; border-bottom-style: double;}
        nav li{display:inline-block;list-style-type: none;width:140px;padding:5px 10px;background-color:#CD5C5C;border:3px solid #fff;color:#fff;text-align:center;vertical-align:baseline;transform:translate(-50%, 0);}
        nav li.signout {background-color: #fff;color: black;width:45px;}
        nav li.signout:hover:not(.active){background-color: #e6e6e6;} 
        nav li:hover{background-color:#F08080;color:black;}
        nav a:hover, nav a:focus {color: black;text-decoration: none;}
        nav a{display: block;color:inherit;}
    </style>
    <link rel="icon" href="unnamed.ico">
</head>
<body>
    <div class="page-header">
        <div style="background: url(https://i.postimg.cc/cL2hV0dp/classroom-evening-b-by-icephei-d9q64s5.jpg)" class="jumbotron bg-cover text-white">
            <nav><ul>
                    <li class="signout"><a href="welcome.php"><i class="fa fa-fw fa-home"></i></a></li>
            </ul></nav>
            <form action="view.php" name="Form" method="post" enctype="multipart/form-data"> 
            <?php if($fil = mysqli_fetch_array($result)) {?>
            <div>
                <br>
                <label for="description" style="color:white"><mark>Choose the group:</mark></label>
                <select name="class" id ="class">
                    <option>Show all</option>
                        <?php
                        while($row = mysqli_fetch_array($result1)) { ?>
                            <option><?php echo $row['group_name']; ?></option>
                        <?php } ?>
                </select>
                <input type="submit" value="Search" class="btn btn-danger" name="btn_upload">
            </div>
            <?php
            }
            else {?>
            <div>
                <br>
                <h5><mark><b>*No documents uploaded*</b></mark></h5>
            </div>
            <?php
            }?>
        </div>
    </div>
    <br/>
        <div class="row">
            <div class="center">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Evidence Name</th>
                            <th>Creation Date</th>
                            <th>Phase</th>
                            <th>Description</th>
                            <th>File Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($roww = mysqli_fetch_array($users)) { ?>
                    <tr>
                        <td><?php echo $roww['default_name']." (<i>".$roww['group_name']."</i>)"; ?></td>
                        <td><?php echo $roww['creation_date']; ?></td>
                        <td><?php echo $roww['phase_name']; ?></td>
                        <?php if(empty($roww['description'])) {?>
                            <td>*No description added*</td>
                        <?php
                        } else {?>
                               <?php echo '<td><a href="#" onClick="alert(\''.$roww['description'].'\')">Click to show</a></td>'; ?>
                        <?php
                        }?>
                        <td>
                        <div class="dropdown">
                            <a href="#services"><i class="fa fa-fw fa-wrench"></i></a>
                            <div class="dropdown-content">
                                <a href="uploads/<?php echo $roww['file_name']; ?>" download>Download</a>
                                <?php echo"<a href=\"delete-2.php?id=".$roww['id']."\"onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>"?>
                                <?php echo "<a href=\"edit-file.php?id=".$roww['id']."\"onclick=\"return confirm('Do you want to edit this evidence?');\">Edit</a>"?>
                            </div>
                        </div>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
</form>
</body>
</html>