
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Login</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/login.css" />
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
</head>

<body >
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <h1><a class="navbar-brand logo" href="index.php">Vaccination</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin/admin_login.php">ADMIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="vaccinator/vaccinator_login.php">VACCINATOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="user_login.php">LOGIN/REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container ">
        <div class="row">
            <div class="box" style='background-color:white; opacity: 100%; color: black;'>
               
                <h2 style="color: black;">Login</h2>
                <form method="post">
                    <div class="inputBox mb-1">
                        <input type="email" name="email" required onkeyup="this.setAttribute('value', this.value);" value="" />
                        <label class="form-label">Enter Email Address</label>
                    </div>
                    <div class="mb-3">
                        <input class="otpbutton" id="login" type="submit" value="SEND OTP" name="login">
                    </div>
                    <p style="text-align: center; margin: 20px 0px;">OR</p>
                    <div class="icon">
                        <i class="fa-brands fa-google bg-primary"></i>
                        <i class="fa-brands fa-facebook-f bg-primary"></i>
                        <i class="fa-brands fa-twitter bg-primary"></i>
                    </div>
                    <p style=" font-size: 0.8rem; text-align: center;">New User Sign Up Now? <a href="user_signup.php">SignUp Now</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
    session_start();
    require_once 'db_connect.php';
    if(isset($_POST["login"])){
        $email = $_POST["email"];

        $sql1="SELECT * FROM user_login where email='$email'";
        $results=mysqli_query($connect,$sql1);
        $rows=mysqli_num_rows($results);

        if($rows === 0)
        { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    swal({
                        title: "This Email Id. is not registered..",
                        icon: "error",
                        timer: 2000,
                        button: false,
                        timerProgressBar:true,
                    });
                });
            </script>
            <?php
        }
        else
        {
            $result = mysqli_query($connect, "INSERT INTO `user_login` (`email`, `status`) VALUES ('$email', 0)");

            if($result){
                $otp = rand(100000,999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                require "Mail/phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';

                $mail->Username='vaccination12@gmail.com';
                $mail->Password='vaccination@123';

                $mail->setFrom('vaccination12@gmail.com', 'OTP Verification');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject="CoWIN Application";
                $mail->Body="<p>Dear Vaccine taker, </p> <h3>Your verify OTP code is $otp <br></h3>
                <br><br>
                <p>OTP will expire in 2 Minutes</p>
                <p>With regrads,</p><br><br>
                <b>Team CoWIN Application</b>";
                
                if(!$mail->send()){
            ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        swal({
                            title: "Invalid Email",
                            icon: "error",
                            timer: 2000,
                            button: false,
                            timerProgressBar:true,
                        });
                    });
                </script>
                <?php } else { ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            swal({
                                title: "OTP sent to entered Email Id",
                                icon: "success",
                                timer: 2000,
                                button: false,
                                timerProgressBar:true,
                            });
                        });
                        setTimeout(() => {
                            window.location.replace('login_verification.php');
                        }, 2500);
                    </script>
                <?php
                }
            }
        }
    }

?>
