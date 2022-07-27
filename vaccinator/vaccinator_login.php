<?php
session_start();
include '../db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccinator Login</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-color: rgb(0, 140, 255);
        }
        .border-box{
            width:26%;
            height: 400px;
            background-color: white;
            margin: auto;
            margin-top: 100px;
            box-shadow: 2px 2px 10px black;
            border-radius: 2px;
            padding-left: 20px;
            padding-right: 30px;
        }
        .border-box h4{
            font-size: 30px;
            text-align: center;
            padding-top: 20px;
        }
        .form-box{
            width: 100%;
            height: 200px;
            margin-top: 50px;
        }
        .form-col label a{
            width: 100%;
            font-size: 20px;
            text-decoration: none;
            color: black;
            text-align: right;
            display: inline-block;
        }
        input[type="text"]{
            width: 100%;
            height: 30px;
            display: inline-block;
            margin: 10px 0px;
            padding-left: 10px;
        }
        input[type="password"]{
            width: 100%;
            height: 30px;
            display: inline-block;
            margin: 10px 0px;
            padding-left: 10px;
        }
        .btn
        {
            width: 38%;
            height: 40px;
            color: white;
            background-color: rgb(0, 140, 255);
            margin-top: 10px;
            border-radius: 10px;
            border: none;
            transition: all 0.5S ease;
        }
        .btn:hover{
            background-color: rgb(0, 60, 255);
            padding-left: 5PX;
            cursor: pointer;
        }
    </style>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <h1><a class="navbar-brand logo" href="../index.php">Vaccination</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../admin/admin_login.php">ADMIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="vaccinator_login.php">VACCINATOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../user_login.php">LOGIN/REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="border-box">
        <h4>Login as Vaccinator</h4>
        <div class="form-box">
            <form method="post">
                <div class="form-col">
                    <label for="email">Email :</label>
                    <input type="email" name="email" class="form-control" id="email" required>  
                </div>
                <div class="form-col">
                    <label for="pass">Password:</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-col">
                    <input type="submit" class="btn btn-primary" value="Login In" name="login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST["login"]))
{
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $query="SELECT * FROM `vaccinator` where email='$email'";
    $results=mysqli_query($connect,$query);
    $rows=mysqli_num_rows($results);
    $result=mysqli_fetch_assoc($results);

    if($rows==1)
    {
        $cemail=$result['email'];
        $cpass=$result['password'];
        if($email==$cemail)
        {
            if($pass==$cpass)
            { 
                $_SESSION['vaccinator_email']=$cemail;
                $_SESSION['vaccinator_vcid']=$result['vc_id'];
                ?>
                <script>
                    $(document).ready(function() {
                        swal({
                            title: "Login Successfull",
                            icon: "success",
                            timer: 2000,
                            button: false,
                            timerProgressBar:true,
                        });
                    });
                    setTimeout(() => {
                        window.location.replace("vaccinator_dashboard.php");
                    }, 2500);
                </script>
                <?php
            }
            else { ?>
                <script>
                    $(document).ready(function() {
                        swal({
                            title: "Invalid Email or Password",
                            icon: "error",
                            timer: 2000,
                            button: false,
                            timerProgressBar:true,
                        });
                    });
                </script>
                <?php
            }
        }
        else { ?>
            <script>
                $(document).ready(function() {
                    swal({
                        title: "Invalid Email or Password",
                        icon: "error",
                        timer: 2000,
                        button: false,
                        timerProgressBar:true,
                    });
                });
            </script>
            <?php
        }
    }
    // if($_SESSION['loginin']!=TRUE)
    // {
    //     header("Location: admin_login.php");
    // }
}
?>
