<?php
require_once 'config.php';
// fetch files
 session_start();
 $id = $_SESSION["id"];
 $sql = "SELECT * FROM tbl_classes WHERE created_by ='$id' ORDER BY created_at";
 $mysql = "SELECT * FROM tbl_classes WHERE created_by ='$id' ORDER BY created_at";
 $upload = "SELECT * FROM tbl_upload WHERE created_by ='$id'";
 $result1 = mysqli_query($link, $sql);
 $result2 = mysqli_query($link, $mysql);
 $result3 = mysqli_query($link, $upload);
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
function myFunction(x) {
  alert(x);
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<!--<<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">//-->
    <style type="text/css">
        body{font: 14px sans-serif; text-align: center; background: #fee !important; min-height: 100vh;}
        .dropdown {position: relative;display: inline-block;}
        .dropdown-content {display: none;position: absolute;background-color: #f9f9f9;min-width: 160px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);padding: 12px 16px;z-index: 1;}
        .dropdown-content a {padding: 12px 16px;display: block;}
        .dropdown:hover .dropdown-content {display: block;}
		table{background-color: fff; text-align: center;}
		th{text-align: center;}
		h5{color: white;}
		.bg-cover {background-size: cover !important;}
		.table-hover > tbody > tr:hover {background-color: #fee;}
		.page-header {padding-bottom: 15px; margin-left: auto;margin-right: auto; width: 95%; border-bottom: 9px solid #fff; border-bottom-style: double;}
		nav li{display:inline-block;list-style-type: none;width:140px;padding:5px 10px;background-color:#CD5C5C;border:3px solid #fff;text-align:center;color:#fff;vertical-align:baseline;}
		nav li.signout {background-color: #fff;color: black; width:45px;}
        nav li.signout:hover:not(.active){background-color: #e6e6e6;} 
		nav li:hover{background-color:#F08080;color:black;}
		nav a:hover, nav a:focus {color: black;text-decoration: none;}
		nav a{display:block;color:inherit;}
		#a{text-decoration: none;}
		#a:hover{text-decoration: underline;}
    </style>
    <link rel="icon" href="unnamed.ico">
</head>
<body>
<div class="page-header">
	<div style="background: url(https://i.postimg.cc/cL2hV0dp/classroom-evening-b-by-icephei-d9q64s5.jpg)" class="jumbotron bg-cover text-white">
		<nav><ul>
			<li class="signout"><a href="welcome.php"><i class="fa fa-fw fa-home"></i></a></li>
			<li><a href="register-class.php"><b>Register Class</b></a></li>
			<?php if($fil = mysqli_fetch_array($result2)) {?>
				<li><a href="register-upload.php"><b>Upload Evidence</b></a></li>
				<?php
			}
			 else {?>
				<div>
					<br>
					<h5><mark><b>*No classes registered*</b></mark></h5>
				</div>
				<?php
			}?>
			<?php if($fill = mysqli_fetch_array($result3)) {?>
				<div>
					<br>
					<a href="view.php" style="color:white" id="a"><mark><b>Click to Check Evidences</b></mark></a>
				</div>
				<?php
			}?>
		</ul></nav>
	</div>
</div>
<br/>
<div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Description</th>
                        <th>Class Options</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($result1)) { ?>
                <tr>
                    <td><?php echo $row['group_name']; ?></td>
                    <?php if(empty($row['description'])) {?>
                    	<td>*No description added*</td>
					<?php
					} else {?>
							<?php echo '<td><a href="#" onClick="alert(\''.$row['description'].'\')">Click to show</a></td>'; ?>
					<?php
					}?>
                    <td>
                    	<div class="dropdown">
                    		<a href="#services"><i class="fa fa-fw fa-wrench"></i></a>
                  			<div class="dropdown-content">
                    			<?php echo"<a href=\"delete.php?id=".$row['id']."\"onclick=\"return confirm('If you delete this class, all the evidences will be deleted as well. Are you sure you want to delete this item?');\">Delete</a>"?>
                    			<?php echo "<a href=\"edit-class.php?id=".$row['id']."\"onclick=\"return confirm('Do you want to edit this class?');\">Edit</a>"?>
                    		</div>
                    	</div>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
</body>
</html>