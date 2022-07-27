<?php
    include '../db_connect.php';
    session_start();
    $ID = $_GET['ID'];
    $sql1="SELECT * FROM `appoinment` where appo_no = $ID";
    $vaccinator_list=$connect->query($sql1);
    $result= mysqli_fetch_assoc($vaccinator_list);
    if(isset($_SESSION['vaccinator_email']) == ''){ ?>
        <script>                     
            window.location.replace('vaccinator_login.php');
        </script>
        <?php
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
    <title>Verify Vaccination</title>
</head>
<body>

    <!-- Navigation  start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="vaccinator_dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="vaccinator_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="appointment_list.php">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccine_stock_list.php">Vaccine Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccinator_logout.php">Logout</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->

    <div class="container box1">
        <h2 class="text-center m-4">Verify Vaccination</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row" style="flex-wrap: nowrap;">
                <div class="col mb">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name']; ?>" readonly>
                </div>
                <div class="col mb">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $result['age']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mt-3">
                    <label for="adhaar_no" class="form-label">Aadhar No.</label>
                    <input type="number" class="form-control " id="adhaar_no"
                    name="adhaar_no" value="<?php echo $result['aadhaar_no']; ?>" readonly>
                </div>
                <div class="col mt-3">
                    <label for="vaccine_name" class="form-label">Vaccine Name</label>
                    <input type="vaccine_name" class="form-control" id="vaccine_name" name="vaccine_name" value="<?php echo $result['vaccine_name']; ?>" readonly>
                </div>
                <div class="col mt-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" readonly>
                </div>
                <input type="hidden" name="vc_id" value="<?php echo $result['vc_id']; ?>"/>
                <input type="hidden" name="appo_no" value="<?php echo $result['appo_no']; ?>"/>
            </div>
            <div class="col text-center mt-4">
                <input type="submit" class="btn btn-primary" value="Verify Vaccination" name="submit"/>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
    $query = mysqli_query($connect,"UPDATE `appoinment` SET `appo_status`= 'visited' WHERE appo_no = $ID");

    $name=$_POST['name'];
    $age=$_POST['age'];
    $aadhaar_no=$_POST['adhaar_no'];
    $vaccine_name=$_POST['vaccine_name'];
    $email=$_POST['email'];
    $vc_id=$_POST['vc_id'];
    $appo_no=$_POST['appo_no'];
    $vaccination_status='completed';


    $query = mysqli_query($connect,"INSERT INTO `vaccination`(`vc_id`, `appo_no`, `name`, `age`, `aadhaar_no`, `email`, `vaccine_name`, `vaccination_status`) VALUES ('$vc_id','$appo_no','$name','$age','$aadhaar_no','$email','$vaccine_name','$vaccination_status')");

    if($query = TRUE) 
    { 
        require "../Mail/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='vaccination12@gmail.com';
        $mail->Password='vaccination@123';

        $mail->setFrom('vaccination12@gmail.com', 'Your Vaccination is done successfully.
        ');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject="CoWIN Application";
        $mail->Body="
            Congratulations! </br></br>
            Your Vaccination is done successfully.</br></br>
            Thanks & Regards,</br></br>
            </br></br>
            Teams CoWIN Application
        ";

        if(!$mail->send()) 
        { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    swal({
                        title: "There is some problem sending mail.",
                        icon: "error",
                        timer: 2000,
                        button: false,
                        timerProgressBar:true,
                    });
                });
            </script>
            <?php 
        } else { ?>
            <script>
                $(document).ready(function() {
                    swal({
                        title: "Verify Vaccination done Successfully!",
                        icon: "success",
                        timer: 2000,
                        button: false,
                        timerProgressBar:true,
                    });
                });
                setTimeout(() => {
                    window.location.replace("appointment_list.php");
                }, 2500);
            </script>
            <?php
        }
    }
}
?>
