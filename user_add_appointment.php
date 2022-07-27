<?php
  include('db_connect.php');
  session_start();
  $ID = $_GET['ID'];
  $sql1="SELECT * FROM `user_details` where id = $ID";
  $user_details_data=$connect->query($sql1);
  $result= mysqli_fetch_assoc($user_details_data);

  if(isset($_SESSION['mail']) == ''){ ?>
    <script>                     
        window.location.replace('user_login.php');
    </script>
<?php } ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
    <title>Book Appointment</title>
</head>

<body>
    <!-- Navigation  start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="user_dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="user_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->
    <div class="box">
        <h2>Book Appointment</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="aadhaar_img" value="<?php echo $result['id_proof']; ?>" readonly/>
            <div class="row">
                <div class="col mb">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name"  name="full_name" value="<?php echo $result['full_name']; ?>" readonly>
                </div>
                <div class="col mb">
                    <label for="adhaar_no" class="form-label">Adhaar Card No</label>
                    <input type="text" class="form-control" id="adhaar_no"  name="adhaar_no" value="<?php echo $result['adhaar_no']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $result['age']; ?>" readonly>
                </div>
                <div class="col mb">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" readonly>
                </div>
                <div class="col mb">
                    <label for="cnumber" class="form-label">Phone no</label>
                    <input type="text" class="form-control" id="cnumber"  name="cnumber" value="<?php echo $result['cnumber']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <select name="state" id="state" class="form-select" required>
                        <option value="" selected disabled>Select State</option>
                        <?php 
                            $sql = "SELECT * FROM state";
                            $result = mysqli_query($connect,$sql);
                            foreach($result as $state) { ?>
                                <option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col mb">
                    <select name="district" id="district" class="form-select" required>
                        <option value="" selected disabled>Select District</option>
                    </select>
                </div>
                <div class="col mb">
                    <select name="vc_id" id="vc_id" class="form-select" required>
                        <option value="" selected disabled>Select Vaccine Center</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="vaccine_name" class="form-label">Select Vaccine Name</label>
                    <select class="form-select" for="vaccine_name" name="vaccine_name" required>
                        <option value="" selected disabled>Vaccine  Name</option>
                        <option value="covidshield">Covid Shield</option>
                        <option value="covaccine">Co Vaccine</option>
                    </select>
                </div>
                <div class="col mb">
                    <label for="appo_date" class="form-label">Select Appointment Date</label>
                    <input type="date" class="form-control" id="appo_date"  name="appo_date" >
                </div>
                <div class="col mb">
                    <label for="appo_time" class="form-label">Select Appointment Time</label>
                    <input type="time" class="form-control" id="appo_time"  name="appo_time" >

                    <!-- <select class="form-select" for="appo_time" name="appo_time" required>
                        <option value="" selected disabled>Appointment Time</option>
                        <option value="9 AM">9 AM</option>
                        <option value="12 PM">12 PM</option>
                        <option value="3 PM">3 PM</option>
                    </select> -->
                </div>

            </div>
            <div class="row">
                <input type="submit" name="signin" class="btn btn-primary btn-lg" value="Book Appointment">
            </div>
        </form>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("appo_date")[0].setAttribute('min', today);

    $(document).ready(function() {
        $('#state').on('change', function() {
            var id = this.value;
            $.ajax({
                url: "district-by-state.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                    $("#district").html(result);
                },
            });
        });
        $('#district').on('change', function() {
            var id = this.value;
            $.ajax({
                url: "district-by-center.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                    $('#vc_id').html(result);
                },
            });
        });
    });
</script>

<?php
  include('db_connect.php');

    if(isset($_POST["signin"]))
    {
        $full_name = $_POST['full_name'];
        $adhaar_no = $_POST['adhaar_no'];
        $aadhaar_img = $_POST['aadhaar_img'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $cnumber = $_POST['cnumber'];
        $state = $_POST["state"];
        $district = $_POST["district"];
        $vc_id = $_POST["vc_id"];
        $vaccine_name = $_POST["vaccine_name"];
        $appo_date = $_POST["appo_date"];
        $appo_time = $_POST["appo_time"];
        $appo_user_id = rand(100000,999999);

        $fetch_data = mysqli_query($connect,"SELECT `vc_id`,`vaccine_name`,`remain_quantity` FROM `schedule` where vaccine_name = '$vaccine_name' AND vc_id = $vc_id");
        $result_schedule = mysqli_fetch_assoc($fetch_data);

        if($result_schedule['vc_id'] == $vc_id && $result_schedule['vaccine_name'] == $vaccine_name && $result_schedule['remain_quantity'] > 0)
        {
            $result = mysqli_query($connect,"INSERT INTO `appoinment`(`name`, `age`, `aadhaar_no`,`aadhaar_img`,`email`, `phone`, `vc_id`, `vaccine_name`, `appo_user_id`, `appo_time`, `appo_date`, `appo_status`) VALUES ('$full_name','$age','$adhaar_no','$aadhaar_img','$email','$cnumber','$vc_id','$vaccine_name','$appo_user_id','$appo_time','$appo_date','not-visited')");

            
            $remain_quantity = $result_schedule['remain_quantity'] - 1;
            $update_schedule_qty = mysqli_query($connect,"UPDATE `schedule` SET `remain_quantity`= $remain_quantity WHERE vc_id = $vc_id");
            // if ($result) {
            //   echo "success";
            // } else {
            //     echo ("Could not insert data : " . mysqli_error($connect));
            // }

            if($result = TRUE) 
            { 
                
                require "Mail/phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';

                $mail->Username='vaccination12@gmail.com';
                $mail->Password='vaccination@123';

                $mail->setFrom('vaccination12@gmail.com', 'Your Appointment for '.$full_name.' is booked successfully.');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject="CoWIN Application";
                $mail->Body="
                    Your Appointment for $full_name is booked successfully. And Aadhar No. is $adhaar_no
                    and appointment details is as below. Please go through.

                    <ul>
                        <li>Vaccine Name: $vaccine_name</li>
                        <li>Appointment Date: $appo_date</li>
                        <li>Appointment Time: $appo_time</li>
                        <li>Appointment Id: $appo_user_id</li>
                    </ul>

                    Thanks & Regards,
                    </br>
                    Teams CoWIN Application
                ";

                if(!$mail->send()) 
                { ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            swal({
                                title: "There is some problem sending mail with appointment details. Please write these appointment details",
                                icon: "error",
                                timer: 2000,
                                button: false,
                                timerProgressBar:true,
                            });
                        });
                    </script>
                    <?php 
                } else { ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            swal({
                                title: "Vaccine Appointment done Successfully!",
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
                    <?php
                }
            }
        }
        else { ?>
            <script>
                $(document).ready(function() {
                    swal({
                        title: "There is no stock available for this Vaccine",
                        icon: "error",
                        timer: 2000,
                        button: false,
                        timerProgressBar:true,
                    });
                });
                setTimeout(() => {
                    window.location.replace('add_appointment.php');
                }, 2500);
            </script>
        <?php
        }
    } 
?>