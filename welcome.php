<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <style type="text/css">
        body{font: 14px sans-serif; text-align: center; background: #fee !important; min-height: 100vh;}
        .bg-cover {background-repeat: no-repeat; background-size: auto !important;}
        h1{color:white;}
        a:hover,a:focus {color: #23527c;text-decoration: none;}
        div.uppercase{text-transform: uppercase;}
        ul {list-style-type: none;margin-left: auto;margin-right: auto;padding: 0;border: 0;width: 300px;vertical-align: baseline;background-color: #CD5C5C;border: 3px solid #fff;}
        li a {display: block;color: white;padding: 20px 16px;text-decoration: none;}
        li {text-align: center;border-bottom: 3px solid #fff;}
        li:last-child {border-bottom: none;}
        li a.signout {background-color: #fff;color: black;}
        li a.signout:hover:not(.active){background-color: #e6e6e6;}
        li a:hover:not(.active) {background-color: #F08080;color: black;} 
        table{background-color: fff;}
        .table-hover > tbody > tr:hover {background-color: #fee;}
        .page-header {padding-bottom: 15px; margin-left: auto;margin-right: auto; width: 95%; border-bottom: 9px solid #fff; border-bottom-style: double;}
        
    </style>
    <link rel="icon" href="unnamed.ico">
</head>
<body>
    <div class="page-header">
        <div style="background: url(https://i.postimg.cc/cL2hV0dp/classroom-evening-b-by-icephei-d9q64s5.jpg)" class="jumbotron bg-cover text-white">
            <div class="uppercase">
                <h1 class="display-4 font-weight-bold text-white">Hi <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
            </div>
                <p class="font-italic mb-0">This web application is a tool to help you gather evidences while implementing Design Thinking.</p> 
        </div>
    </div>
    <br>
    <ul>
        <li><a href="upload.php" ><h4><b>Upload Evidences</b></h4></a></li>
        <li><a href="view.php" ><h4><b>Visualize Your Contents</b></h4></a></li>
        <li><a class="signout" href="logout.php"><h4><b>Sign Out</b></h4></a></li>
    </ul>   
</body>
</html>