<?php
require_once 'config.php';

// Define variables and initialize with empty values
$name_err = $image_err = "";
$phase_name = ['Emphatize', 'Define', 'Ideate', 'Prototype', 'Test'];

// GET to obtain the id of the group from upload.php
if(empty($_GET['id'])){
    $uploadid = $_POST['userid'];
}
else{
    $uploadid = $_GET['id'];
}

// Fetch upload rows from upload database
$group_sql = "SELECT * FROM tbl_upload WHERE id ='$uploadid'";
$check = mysqli_query($link, $group_sql);
$group_row = mysqli_fetch_array($check);

// Unlink the file from the /upload file
$filename = $group_row['file_name'];
$path = "uploads/$filename";
unlink($path);

// Initialize the session and get user id
session_start();
$userid = $_SESSION["id"];

// Prepare the query from the classes database
$sql = "SELECT * FROM tbl_classes WHERE created_by ='$userid' AND group_name != '".$group_row['group_name']."' ORDER BY created_at";
$result = mysqli_query($link, $sql);

if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    // Check if name is empty
    if(empty($_POST['name'])){
        $name_err = "Please enter a name";
    } else{
        $name = $_POST["name"];
    }
    if(empty($_FILES['file']['name']))
    {
        $image_err = "Please select your files";
    }
    else{
        $filename = $_FILES['file']['name'];
    }
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $groupname = $_POST['group'];
    $desc = $_POST['description'];
    $phase = $_POST['phase'];
    $folder ="uploads/";
    $q = "SELECT id FROM tbl_classes WHERE group_name='$groupname'";
    $queryy = mysqli_query($link, $q);
    $row = mysqli_fetch_array($queryy);
    // Check if files is empty
    
    if(empty($name_err) && empty($image_err))
     {
        move_uploaded_file($file_loc,$folder.$filename);
        $query = "UPDATE tbl_upload SET file_name='$filename', default_name='$name', file_type='$file_type', group_name='$groupname', group_id='$row[id]', size='$file_size', description='$desc', phase_name='$phase', created_by='$userid' WHERE id='$uploadid'";  
        if(mysqli_query($link,$query))
        {
        ?>
            <script>
            alert('Successfully edited');
            window.location.href='view.php?success';
            </script>
        <?php
        }
        else
        {
        ?>
            <script>
            alert('Something went wrong. Please try again later');
            window.location.href='view.php?fail';
            </script>
        <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Evidences</title>
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
            <h2 class="form-signin-heading">Edit Evidences</h2>
            <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                <label for="image">Choose files (*pdf,*xls,*jpg,*png,*mp4)</label>
                <input type="hidden" name="userid" class="txtField" value="<?php echo $group_row['id']; ?>">
                <input type="file" name="file">
                <span class="help-block"><?php echo $image_err; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Choose the DT fase:</label>
                <select name="phase">
                    <option><?php echo $group_row['phase_name']; ?></option>
                    <?php for($i=0 ; $i<count($phase_name); $i++){
                        if($phase_name[$i] != $group_row['phase_name']){
                            ?><option><?php echo $phase_name[$i]; ?></option><?php
                        }
                    }?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Choose the group:</label>
                <select name="group">
                    <option><?php echo $group_row['group_name']; ?></option>
                <?php
                while($row = mysqli_fetch_array($result)) { ?>
                    <option><?php echo $row['group_name']; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <input type="text" class="form-control" name="name" placeholder="Name" autofocus="" value="<?php echo $group_row['default_name']; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <textarea name="description" id="description" class="form-control" placeholder="Description" autofocus=""><?php echo $group_row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-danger" name="btn_upload">
                <a href="view.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>