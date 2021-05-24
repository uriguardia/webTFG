<?php
require_once 'config.php';

// Define variables and initialize with empty values
$groupname_err = "";

// GET to obtain the id of the group from upload.php
if(empty($_GET['id'])){
    $groupid = $_POST['userid'];
}
else{
    $groupid = $_GET['id'];
}

// Fetch rows from classes database
$stmt = "SELECT * FROM tbl_classes WHERE id ='$groupid'";
$check = mysqli_query($link, $stmt);
$row = mysqli_fetch_array($check);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){   
    // Check if name is empty
    if(empty($_POST['name'])){
        $groupname_err = "Please enter a name";
    } else{
        $groupname = $_POST["name"];
    }   
    
     // Store values in their corresponding variables
     $desc = $_POST['description'];
    
    // Validate that the name field is not empty
    if(empty($groupname_err)){
        
         // Prepare the queries
         $sql = "UPDATE tbl_classes SET group_name='$groupname', description='$desc' WHERE id='$groupid';";
         $sql .= "UPDATE tbl_upload SET group_name='$groupname' WHERE group_id='$groupid'";
            
         // Attempt to execute the prepared statement
         if(mysqli_multi_query($link, $sql)){
            ?>
            <script>
                alert('Successfully edited');
                window.location.href='upload.php?success';
            </script>
            <?php
                
         } else{
            ?>
            <script>
                alert('Something went wrong. Please try again later');
                window.location.href='upload.php?fail';
            </script>
            <?php
        }
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Your Class</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        @import "bourbon";
        body {background: #fee !important;}
        .wrapper {margin-top: 80px;margin-bottom: 80px;}
        .form-signin {max-width: 380px;padding: 15px 35px 45px;margin: 0 auto;background-color: #fff;border: 1px solid rgba(1,0,0,0);}
        .form-signin-heading,
        .checkbox {margin-bottom: 30px;}
        .checkbox {font-weight: normal;}
        .form-control {position: relative;font-size: 16px;height: auto;padding: 10px;@include box-sizing(border-box);&:focus {z-index: 2;}}
        input[type="text"] {margin-bottom: -1px;border-bottom-left-radius: 0;border-bottom-right-radius: 0;}
        input[type="password"] {margin-bottom: 20px;border-top-left-radius: 0;border-top-right-radius: 0;}
    </style>
    <link rel="icon" href="unnamed.ico">
</head>
<body>
    <div class="wrapper">
        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="Form" method="post" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Edit Your Class</h2>
            <div class="form-group <?php echo (!empty($groupname_err)) ? 'has-error' : ''; ?>">
                <input type="hidden" name="userid" class="txtField" value="<?php echo $row['id']; ?>">
                <input type="text" class="form-control" name="name" id="a" placeholder="Name" autofocus="" value="<?php echo $row['group_name']; ?>">
                <span class="help-block"><?php echo $groupname_err; ?></span>
            </div>
            <div class="form-group">
                <textarea name="description" id="description" class="form-control" placeholder="Description" autofocus=""><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-danger" name="btn-class">
                <a href="upload.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>