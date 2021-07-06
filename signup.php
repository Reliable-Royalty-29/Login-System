<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){

include 'partials/_db.php';
$username = $_POST['usename'];
$password =  $_POST['password'];
$cpassword =  $_POST['cpassword'];
//$exists = false;

// Check whether this username exists
  $existSql = "SELECT * FROM `users` WHERE username = '$username'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if($numExistRows > 0){
      // $exists = true;
      $showError = "Username Already Exists";
  }
else{
  //$exists = false;


    if(($password == $cpassword)){
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $res = mysqli_query($conn,$query);

   if($result){
      $showAlert = "True";
   }
}
else{
      $showError = "Password do not match";
    }

  }
}




?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>SignUp</title>
    <link rel="stylesheet" href="Login System/css/style.css">
  </head>
  <body>
      <?php require 'partials/_nav.php'  ?>
      <?php
      if($showAlert){
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> Your account is now created and you can login
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
       </button>
   </div> ';
   }

   if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
  }
    ?>




      <div class="container">
        <h1 class="text-center">SignUp To Our Website</h1>
        <form action="/Login System/signup.php" method="POST">
          <div class="form-group col-md-6">
            <label for="usename">Usename</label>
            <input type="text" class="form-control" maxlength="11" id="usename" name="usename" aria-describedby="emailHelp" placeholder="Enter your usename">

          </div>
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" maxlength="100" id="password" name="password" placeholder="Password">
            <small id="emailHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
          </div>

          <div class="form-group col-md-6">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" maxlength="100" id="cpassword" name="cpassword" placeholder="Password">
            <small id="emailHelp" class="form-text text-muted">Make sure you type the same password</small>
          </div>
          <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
