<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <?php include 'scrsty.php'; ?>
    <title>Masker & Scrunchies</title>

    <style type="text/css">
      .btn-kustom {
        color: #fff;
        background-color: #5d8975;
        border-color: #5d8975;
      }

      .btn-kustom:hover {
        color: #fff;
        background-color: #48695a;
        border-color: #48695a;
      }
    </style>
</head>
<body>
<?php include "navbar.php";?>
<div class="container">
  <form action="#" class="login_design">
    <center><h2>User Login</h2></center><br>
    <div class="form-group justify-content-center">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group justify-content-center">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>

      <p class="text-center"><a href="forgotpassword.php" class="text-info">Forgot your password?</a></p>
    <div class="form-group justify-content-center">
<<<<<<< HEAD
        <center><button type="submit" class="btn btn-primary"> Login  </button></center>
=======
        <button type="submit" class="btn btn-kustom">Login</button>
>>>>>>> adc548c835b2505e62e48f98b055ce280267af4f
    </div> <!-- form-group// -->          
      <p class="text-center"><a href="register.php" class="text-info">Create account</a></p>                                                 
</form>
</article>
</div> <!-- card.// -->
</div>

 <?php include "footer.php";?>