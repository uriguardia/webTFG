<?php
require_once 'config.php';

// Define variables and initialize with empty values
$name_err = $image_err = "";

// Initialize the session and get user id
session_start();
$userid = $_SESSION["id"];

// Query in order to obtain the classes
$sql = "SELECT * FROM tbl_classes WHERE created_by ='$userid' ORDER BY created_at";
$result = mysqli_query($link, $sql);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    // Store values in their corresponding variables
    $file_array = array_filter($_FILES['files']['name']);
    $groupname = $_POST['group'];
    $description = $_POST['description'];
    $phase = $_POST['phase'];

    // Query in order to obtain the id from the group that uploaded the evidence
    $idstmt = "SELECT id FROM tbl_classes WHERE group_name='$groupname'";
    $idquery = mysqli_query($link, $idstmt);
    $row = mysqli_fetch_array($idquery);
    
    // Define the folder path where images are stored
    $folder ="uploads/";
    
    // Check if name is empty
    if(empty($_POST['name'])){
        $name_err = "Please enter a name";
    } else{
        $name = $_POST["name"];
    }
    
    // Check if the file field is empty
    if(empty($file_array))
    {
        $image_err = "Please select your files";
    }
    
    // Validate that neither the name and image fields are empty
    if(empty($name_err) && empty($image_err)){
        
        // Loop in order to manage the multiple image uploading
        foreach($_FILES['files']['name'] as $key=>$val){
            
           // Store values in their corresponding variables
           $filename = $_FILES['files']['name'][$key];
           $file_loc = $_FILES['files']['tmp_name'][$key];
           $file_size = $_FILES['files']['size'][$key];
           $file_type = $_FILES['files']['type'][$key];
            
           // Move the files inside the upload path
           move_uploaded_file($file_loc,$folder.$filename);
           
           // Prepare an insert statement
           $query = "INSERT INTO tbl_upload(file_name,default_name,file_type,group_name,group_id,size,description,phase_name,created_by) VALUES(?,?,?,?,?,?,?,?,?)";
           if($stmt = mysqli_prepare($link, $query)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssiissi", $param_filename,$param_name,$param_file_type,$param_groupname,$param_group_id,$param_file_size,$param_description,$param_phase,$param_userid);
               
                // Check if more than one file was uploaded
               if(count($_FILES['files']['name']) >= 2){ 
                    $count = $key + 1;
                    $string = ' #';
                    $param_name = $name.$string.$count;
                }
                else{
                    $param_name = $name;
                }

                // Set parameters
                $param_filename = $filename;
                $param_file_type = $file_type;
                $param_groupname = $groupname;
                $param_group_id = $row['id'];
                $param_file_size = $file_size;
                $param_description = $description;
                $param_phase = $phase;
                $param_userid = $userid;
               
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to upload page
                    ?>
                    <script>
                        alert('All evidences were successfully uploaded.');
                        window.location.href='upload.php?success';
                    </script>
                    <?php
                } else{
                    ?>
                    <script>
                        alert('Something went wrong. One of the files was not uploaded.');
                        window.location.href='upload.php?fail';
                    </script>
                    <?php
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Files</title>
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
            <h2 class="form-signin-heading">Upload Evidences</h2>
            <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                <label for="image">Choose files (*pdf,*xls,*jpg,*png,*mp4)</label>
                <input type="file" name="files[]" multiple>
                <span class="help-block"><?php echo $image_err; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Choose the DT fase:</label>
                <select name="phase">
                    <option value="Emphatize">Emphatize</option>
                    <option value="Define">Define</option>
                    <option value="Ideate">Ideate</option>
                    <option value="Prototype">Prototype</option>
                    <option value="Test">Test</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Choose the group:</label>
                <select name="group">
                <?php
                while($row = mysqli_fetch_array($result)) { ?>
                    <option><?php echo $row['group_name']; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <input type="text" class="form-control" name="name" placeholder="Name" autofocus="">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <textarea name="description" id="description" class="form-control" placeholder="Description" autofocus=""></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-danger" name="btn_upload">
                <a href="upload.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>