<?php
    include('../db_connect.php');
    session_start();
    $ID = $_GET['ID'];
    $sql1="SELECT * FROM `vaccine_center` where vc_id = $ID";
    $vaccine_list=$connect->query($sql1);
    $result= mysqli_fetch_assoc($vaccine_list)
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Vaccine Center</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/registration.css" />
  </head>
  <style>
    textarea {
        resize: none!important;
    }
  </style>
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
                            <a class="nav-link active" href="vaccine_center.php">Vaccine Center</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vaccine_list.php">Vaccinator list</a>
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

        <div class="container">
            <div class="box" style="background-color:#8076004d">
                <h2>Update Vaccine Center</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-6 inputBox mb-3">
                        <input type="text"  name="name" required onkeyup="this.setAttribute('value', this.value);" value="<?php echo $result['name']; ?>"/>
                        <label>Vaccine Center Name</label>
                    </div>
                    <div class="col-6 inputBox mb-3">
                        <input type="text"  name="type" onkeydown="return /[a-z,A-Z]/i.test(event.key)" required value="<?php echo $result['type']; ?>" onkeyup="this.setAttribute('value', this.value);"/>
                        <label>Vaccine Type</label>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-6 inputBox">
                        <input type="text" name="contact_no" required onkeyup="this.setAttribute('value', this.value);" value="<?php echo $result['contact_no']; ?>" />
                        <label>Phone Number</label>
                    </div>
                    <div class="col-6 inputBox">
                        <input type="text" name="email" required onkeyup="this.setAttribute('value', this.value);" value="<?php echo $result['email']; ?>" />
                        <label>Email</label>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-6 inputBox">
                            <select name="state" id="state" required>
                            <option value="" disabled>States</option>
                            <?php 
                                $sql = "SELECT * FROM state";
                                $results = mysqli_query($connect,$sql);
                                foreach($results as $state) { ?>
                                <option <?php if($result['state'] == $state['id']) {echo "selected";} ?> value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <div class="col-6 inputBox">
                            <select name="district" id="district" required>
                                <option value="" selected disabled>Select District</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 inputBox">
                            <input type="text" name="city" required onkeyup="this.setAttribute('value', this.value);" value="<?php echo $result['city']; ?>"/>
                            <label>City</label>
                        </div>
                        <div class="col-6 inputBox">
                            <input type="text"  name="pincode" required onkeyup="this.setAttribute('value', this.value);" value="<?php echo $result['pincode']; ?>"/>
                            <label>Pincode</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                    <label>Address</label>
                    <div class="col-12 inputBox">
                        <textarea class="form-control" name="address" rows="4" cols="45" resize="none"><?php echo $result['address']; ?></textarea>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12 text-center">
                        <input type="submit" class="btn btn-primary" name="update_center" value="Update Vaccine Center"/>
                    </div>
                    </div>
                </form>
            </div>
        </div>
  </body>
</html>

<?php

    if(isset($_POST["update_center"])){

        $name = $_POST["name"];
        $type = $_POST["type"];
        $contact_no = $_POST["contact_no"];
        $email = $_POST["email"];
        $state = $_POST["state"];
        $district = $_POST["district"];
        $city = $_POST["city"];
        $pincode = $_POST["pincode"];
        $address = $_POST["address"];

        $ID = $_GET['ID'];

        $result = mysqli_query($connect, "UPDATE vaccine_center SET name='$name',type='$type',contact_no='$contact_no',email='$email',state='$state',distrik='$district',city='$city',pincode='$pincode',address='$address' WHERE vc_id = $ID");

       
        if($result == true){ ?>
            <script>
                $(document).ready(function() {
                    swal({
                        title: "Vaccine Center updated Successfully!",
                        icon: "success",
                        timer: 2000,
                        button: false,
                        timerProgressBar:true,
                    });
                });
                setTimeout(() => {
                    window.location.replace("vaccine_center.php");
                }, 2500);
            </script>
            <?php
        }
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            var id = this.value;
            $.ajax({
                url: "../district-by-state.php",
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
    });
</script>
