<?php
  include('../db_connect.php');
  session_start();
  if(isset($_SESSION['vaccinator_email']) == ''){ ?>
    <script>                     
        window.location.replace('vaccinator_login.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Add Appointment</title>
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

    <div class="box1">
        <h2 class="text-center">Add New Appointment</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row" style="flex-wrap: nowrap;">
                <div class="col mb">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="Name" placeholder="Enter Full Name" name="name" required>
                </div>
                <div class="col mb">
                    <label for="aadhar_no" class="form-label">Aadhar No.</label>
                    <input type="number" class="form-control " id="aadhar_no" placeholder="Enter Adhaar No."
                    name="aadhar_no" required>
                </div>
                <div class="col mb">
                    <label for="img" class="form-label">Upload Aadhar Card Image </label>
                    <input class="form-control" type="file" id="img" name="image" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required>
                </div>
                <div class="col mb">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" placeholder="Enter your Age" name="age">
                </div>
                <div class="col mb">
                    <label for="appo_time" class="form-label">Select Appointment Time</label>
                    <select class="form-select" for="appo_time" aria-label="Default select example"
                        name="appo_time" required>
                        <option value="" selected disabled>Appointment Time</option>
                        <option value="9 AM">9 AM</option>
                        <option value="12 PM">12 PM</option>
                        <option value="3 PM">3 PM</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="vaccine_name" class="form-label">Select Vaccine Name</label>
                    <select class="form-select" for="vaccine_name" aria-label="Default select example"
                        name="vaccine_name" required>
                        <option value="" selected disabled>Vaccine  Name</option>
                        <option value="covidshield">Covid Shield</option>
                        <option value="covaccine">Co Vaccine</option>
                    </select>
                </div>
                <div class="col mb">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter Phone" name="phone_no" required>
                </div>
                <div class="col mb">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="text" class="form-control" id="pincode" placeholder="Enter your pincode" name="pincode">
                </div>
                <div class="col mb">
                    <label for="age" class="form-label">Gender</label><br>
                      <input type="radio" name="gender" id="male" value="male" class="radiobtn" checked>
                      <label for="male">Male</label>
                      
                      <input type="radio" name="gender" id="female" value="female" class="radiobtn">
                      <label for="male">Female</label>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" rows="3"
                        placeholder="Enter Address as per Your Adhaar Card.." name="address" required></textarea>
                </div>
            </div>
            <div class="col text-center">
                <input type="submit" class="btn btn-primary" value="Create new Appointment" name="submit"/>
            </div>
        </form>
    </div>
</body>
</html>

<?php

//Insert Data when Request a occured
if(isset($_POST['submit']))
{

    $name=$_POST['name'];
    $aadhaar_no=$_POST['aadhar_no'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $appo_time=$_POST['appo_time'];
    $vaccine_name = $_POST['vaccine_name'];
    $phone_no=$_POST['phone_no'];
    $pincode=$_POST['pincode'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];

    //check stock quantity and then insert data and book appointment
    $email = $_SESSION['vaccinator_email'];
    $query="SELECT ID FROM `vaccinator` where email='$email'";
    $results = mysqli_query($connect,$query);
    $result1_vaccinator = mysqli_fetch_assoc($results);
    $id = $result1_vaccinator['ID'];

    $fetch_data = mysqli_query($connect,"SELECT `vaccinator_id`, `vaccine_name`, `remain_quantity` FROM `schedule` where vaccine_name = '$vaccine_name' AND vaccinator_id = $id");
    $result_schedule = mysqli_fetch_assoc($fetch_data);

    if($result_schedule['vaccinator_id'] == $id && $result_schedule['vaccine_name'] == $vaccine_name && $result_schedule['remain_quantity'] > 0)
    {
        $result = mysqli_query($connect,"INSERT INTO `user_details`(`full_name`, `adhaar_no`, `age`, `gender`, `email`, `cnumber`, `pincode`, `address`, `account_status`) VALUES ('$name','$aadhaar_no','$age','$gender','$email','$phone_no','$pincode','$address','created-by-vaccinator')");

        $date = date("Y/m/d");
        $vc_id = $_SESSION['vaccinator_vcid'];
        $appo_user_id = rand(100000,999999);

        $result1 = mysqli_query($connect,"INSERT INTO `appoinment`(`name`, `age`, `aadhaar_no`, `email`, `phone`, `vc_id`, `vaccine_name`,`appo_user_id`, `appo_time`, `appo_date`, `appo_status`) VALUES ('$name','$age','$aadhaar_no','$email','$phone_no','$vc_id','$vaccine_name','$appo_user_id','$appo_time','$date','not-visited')");

        $remain_quantity = $result_schedule['remain_quantity'] - 1;
        $update_schedule_qty = mysqli_query($connect,"UPDATE `schedule` SET `remain_quantity`= $remain_quantity WHERE vaccinator_id = $id");

        // if ($result && $result1 && $update_schedule_qty) {
        //   echo "success";
        // } else {
        //     echo ("Could not insert data : " . mysqli_error($connect));
        // }

        // $last_insert_id = mysqli_insert_id($connect);

        $target_dir = "../uploads/vaccinator/";
        
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } 
        else 
        {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
            {
                $path = '../uploads/vaccinator/';
                $file_name = $_FILES["image"]["name"];
                $fileNameWithExtension = $path . $file_name;
                $result_file = mysqli_query($connect, "UPDATE user_details SET id_proof = '$fileNameWithExtension' WHERE adhaar_no = $aadhaar_no");

                $result_file1 = mysqli_query($connect, "UPDATE appoinment SET aadhaar_img = '$fileNameWithExtension' WHERE aadhaar_no=$aadhaar_no");

                if($result_file && $result_file1 = TRUE) { ?>
                    <script>
                        $(document).ready(function() {
                            swal({
                                title: "Appointment Registration done Successfully!",
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
            else { ?>
                <script>
                    $(document).ready(function() {
                        swal({
                            title: "Sorry, there was an error while saving your data.",
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
    }
    else{ ?>
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