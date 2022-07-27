<?php 
session_start(); 
include('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Verification</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/login.css" />
  </head>
  <body class="bg-primary">
      <div class="container">
          <div class="box">
            <h2>Login Verification</h2>
            <form method="post">
              <div class="inputBox mb-3">
                <input type="text" id="otp" name="otp_code" required onkeyup="this.setAttribute('value', this.value);" value=""/>
                <label>Enter OTP</label>
              </div>
              <div class="mb-3">
                <input class="otpbutton" type="submit" value="Verify" name="verify">
              </div>
              <div class="text-center forPass">
                <a href="recover_psw.php" class="btn btn-link">Forgot Your Password?</a> 
              </div>
            </form>
          </div>
      </div>
  </body>
</html>



<?php 
    include('db_connect.php');

    if(isset($_POST["verify"]))
    {
      $otp = $_SESSION['otp'];
      $email = $_SESSION['mail'];
      $otp_code = $_POST['otp_code'];

      if($otp != $otp_code) { ?>
        <script type="text/javascript">
          $(document).ready(function() {
            swal({
              title: "Invalid OTP code",
              icon: "error",
              timer: 2000,
              button: false,
              timerProgressBar:true,
            });
          });
        </script>

      <?php } else {
            mysqli_query($connect, "UPDATE user_login SET status = 1 WHERE email = '$email'");
      ?>
      <script type="text/javascript">
          $(document).ready(function() {
            swal({
              title: "Login Verfication Completed Successfully",
              icon: "success",
              timer: 2000,
              button: false,
              timerProgressBar:true,
            });
          });
          setTimeout(() => {
            window.location.replace("user_dashboard.php");
          }, 2500);
        </script>
      <?php } 
    } 
?>