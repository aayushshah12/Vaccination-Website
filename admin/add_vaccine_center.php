<?php
  include('../db_connect.php');
  session_start();
  if(isset($_SESSION['email']) == ''){ ?>
    <script>                     
        window.location.replace('admin_login.php');
    </script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Vaccine Center</title>
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
                        <a class="nav-link" href="vaccinator_list.php">Vaccinator list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccination_list.php">Vaccination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccine_stock.php">Vaccine Stock</a>
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
        <div class="box mb-4" style="background-color:#8076004d">
          <h2>Add Vaccine Center</h2>

          <form method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-6 inputBox mb-3">
                <input type="text"  name="name" required onkeyup="this.setAttribute('value', this.value);" value=""/>
                <label>Vaccine Center Name</label>
              </div>
              <div class="col-6 inputBox mb-3">
                <input type="text"  name="type" onkeydown="return /[a-z,A-Z]/i.test(event.key)" required value="" onkeyup="this.setAttribute('value', this.value);"/>
                <label>Vaccine Type</label>
              </div>
            </div>
            <div class="row">
              <div class="col-6 inputBox">
                <input type="text" name="contact_no" required onkeyup="this.setAttribute('value', this.value);" value="" />
                <label>Phone Number</label>
              </div>
              <div class="col-6 inputBox">
                <input type="text" name="email" required onkeyup="this.setAttribute('value', this.value);" value="" />
                <label>Email</label>
              </div>
            </div>
            <div class="row">
              <div class="col-6 inputBox">
                <select name="state" id="state" class="arrow" required>
                  <option value="" selected disabled>States</option>
                  <?php 
                      $sql = "SELECT * FROM state";
                      $result = mysqli_query($connect,$sql);
                      foreach($result as $state) { ?>
                        <option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-6 inputBox">
                <select name="district" id="district" class="arrow" required>
                    <option value="" selected disabled>Select District</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-6 inputBox">
                <input type="text" name="city" required onkeyup="this.setAttribute('value', this.value);" value=""/>
                <label>City</label>
              </div>
              <div class="col-6 inputBox">
                <input type="text" name="pincode" required onkeyup="this.setAttribute('value', this.value);" value=""/>
                <label>Pincode</label>
              </div>
            </div>
            <div class="row mb-3">
              <label>Address</label>
              <div class="col-12 inputBox">
                  <textarea class="form-control" name="address" rows="4" cols="45" resize="none"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <input type="submit" class="btn btn-primary" name="add_center" value="Add Vaccine Center"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </body>
</html>

<?php

    if(isset($_POST["add_center"])){
      $email = $_POST["email"];
      $query = mysqli_query($connect,"SELECT `email` FROM `vaccine_center` WHERE email = '$email'");
      $count = mysqli_num_rows($query);

      if($count == 0)
      {
        if(isset($_POST["add_center"]))
        {
          $name = $_POST["name"];
          $type = $_POST["type"];
          $contact_no = $_POST["contact_no"];
          $email = $_POST["email"];
          $state = $_POST["state"];
          $district = $_POST["district"];
          $city = $_POST["city"];
          $pincode = $_POST["pincode"];
          $address = $_POST["address"];
  
          $result = mysqli_query($connect, "INSERT INTO `vaccine_center`(`name`, `type`, `contact_no`, `email`,`state`, `distrik`,`city`, `pincode`, `address`) VALUES ('$name','$type','$contact_no','$email','$state','$district','$city','$pincode','$address')");
  
          if($result == true){ ?>
            <script>
              $(document).ready(function() {
                  swal({
                      title: "Vaccine Center inserted Successfully!",
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
      }
      else { ?>
        <script>
          $(document).ready(function() {
              swal({
                  title: "Email Id which you have inserted for vaccine center is already there",
                  icon: "error",
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
