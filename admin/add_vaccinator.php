<?php
  include('../db_connect.php');
  session_start();
  if(isset($_SESSION['email']) == ''){ ?>
    <script>                     
        window.location.replace('admin_login.php');
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
    <title>Add Vaccinator</title>
</head>

<body>
    <!-- Navigation  start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="admindash.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="admindash.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appoinment.php">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="vaccine_center.php">Vaccine Center</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="vaccinator_list.php">Vaccinator list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccination_list.php">Vaccination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->

    <!-- Design A form for add vaccinator  -->
    <div class="box1">
        <h2 class="text-center">Add New Vaccinator</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row" style="flex-wrap: nowrap;">
                <div class="col mb">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="Name" placeholder="Enter Full Name" name="name" required>
                </div>
                <div class="col mb">
                    <label for="adhaar_no" class="form-label">Aadhar No.</label>
                    <input type="number" class="form-control " id="adhaar_no" placeholder="Enter Adhaar No."
                    name="adhaar_no" required>
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password"
                    name="password" required>
                </div>
                <div class="col mb">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password"
                        placeholder="Enter Confirm Password" name="confirm_password" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="vaccine_center_id" class="form-label">Selcet Vaccine Center</label>
                    <select class="form-select" for="vaccine_center_id" aria-label="Default select example"
                        name="vaccine_center_id" required>
                        <option value="" selected disabled>Vaccine Center Name</option>
                        <?php 
                            $sql = "SELECT * FROM vaccine_center";
                            $result = mysqli_query($connect,$sql);
                            foreach($result as $user) { ?>
                                <option value="<?php echo $user['vc_id']; ?>"><?php echo $user['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col mb">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter Phone" name="phone_no" required>
                </div>
                <div class="col mb">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" placeholder="Enter your Age" name="age">
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
                <input type="submit" class="btn btn-primary" value="Create a new Vaccinator" name="submit"/>
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
    $aadhaar_no=$_POST['adhaar_no'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone_no=$_POST['phone_no'];
    $address=$_POST['address'];
    $vc_id=$_POST['vaccine_center_id']; 

    // check aadhar no is exist or not
    $sql1="SELECT * FROM vaccinator where aadhaar_no='$aadhaar_no'";
    $result=$connect->query($sql1);
    $rows=mysqli_num_rows($result);
    $result_data=mysqli_fetch_array($result);

    if($rows==1)
    {
        if($aadhaar_no == $result_data['aadhaar_no'])
        { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    swal({
                        title: "This Adhaar No. is already registered..",
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
    else
    {
        if($password == $_POST['confirm_password'])
        {
            $result = mysqli_query($connect,"INSERT INTO `vaccinator`(`name`, `aadhaar_no`, `age`, `gender`, `email`, `password`, `phone_no`, `address`, `vc_id`) VALUES ('$name','$aadhaar_no','$age','$gender','$email','$password','$phone_no','$address','$vc_id')");

            // if ($result) {
            //   echo "success";
            // } else {
            //     echo ("Could not insert data : " . mysqli_error($connect));
            // }
    
            $last_insert_id = mysqli_insert_id($connect);
    
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
                // if everything is ok, try to upload file
            } 
            else 
            {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
                {
                    $path = '../uploads/vaccinator/';
                    $file_name = $_FILES["image"]["name"];
                    $fileNameWithExtension = $path . $file_name;
                    $result_file = mysqli_query($connect, "UPDATE vaccinator SET aadhaar_img = '$fileNameWithExtension' WHERE id='$last_insert_id'");
                
                    if($result_file = TRUE) { ?>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                swal({
                                    title: "Vacinator Registration done Successfully!",
                                    icon: "success",
                                    timer: 2000,
                                    button: false,
                                    timerProgressBar:true,
                                });
                            });
                            setTimeout(() => {
                                window.location.replace("vaccinator_list.php");
                            }, 2500);
                        </script>
                        <?php
                    }
                } 
                else { ?>
                    <script type="text/javascript">
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
            <script type="text/javascript">
                $(document).ready(function() {
                    swal({
                        title: "Password and Confirm Password does not match",
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
?>