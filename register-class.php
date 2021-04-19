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
    <title>Register New Class</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Register New Class</h2>
        <form action="upload-class.php" name="Form" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">*Name</label>
                <input type="text" class="form-control" name="name" id="a">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Register Class" class="btn btn-danger" name="btn-class">
                <a href="upload-2.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>