<?php
  include('../db_connect.php');
  session_start();
  $email = $_SESSION['vaccinator_email'];
  $query="SELECT ID FROM `vaccinator` where email='$email'";
  $results = mysqli_query($connect,$query);
  $result1 = mysqli_fetch_assoc($results);

  if(isset($email) == ''){ ?>
    <script>                     
        window.location.replace('vaccinator_login.php');
    </script>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vaccine Stock</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/registration.css" />
  </head>
  <style>
    textarea {
        resize: none !important;
    }
  </style>
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
                        <a class="nav-link" href="appointment_list.php">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="vaccine_stock_list.php">Vaccine Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccinator_logout.php">Logout</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->
      <div class="container">
          <div class="box" style="background-color:#e24c008c">
            <h2>Vaccine Stock</h2>

            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-6 inputBox mb-3">
                    <select class="arrow" for="vaccine_name" name="vaccine_name" required>
                        <option value="" selected disabled>Vaccine Name</option>
                        <option value="covidshield">Covid Shield</option>
                        <option value="covaccine">Co Vaccine</option>
                    </select>
                </div>
                <div class="col-6 inputBox">
                  <input
                    type="text"
                    name="quantity"
                    required
                    value=""
                    onkeyup="this.setAttribute('value', this.value);"
                  />
                  <label>Quantity</label>
                </div>
              </div>
              <div class="row">
                <div class="col-6 inputBox">
                  <input
                    type="text"
                    name="company_name"
                    onkeydown="return /[a-z,A-Z]/i.test(event.key)"
                    required
                    onkeyup="this.setAttribute('value', this.value);"
                    value=""
                  />
                  <label>Company Name</label>
                </div>
                <div class="col-6 inputBox">
                  <input
                    type="text"
                    name="supplier_name"
                    onkeydown="return /[a-z,A-Z]/i.test(event.key)"
                    required
                    onkeyup="this.setAttribute('value', this.value);"
                    value=""
                  />
                  <label>Supplier Name</label>
                </div>
              </div>
              <div class="row">
                <div class="col-6 inputBox">
                  <input
                    type="text"
                    name="phone_number"
                    required
                    onkeyup="this.setAttribute('value', this.value);"
                    value=""
                  />
                  <label>Phone Number</label>
                </div>
                <div class="col-6 inputBox">
                  <input
                    type="text"
                    name="comp_pnumber"
                    required
                    onkeyup="this.setAttribute('value', this.value);"
                    value=""
                  />
                  <label>Company Phone Number</label>
                </div>
              </div>
              <div class="row">
                <div class="col-6 inputBox">
                  <select name="comp_state" id="comp_state" class="arrow" required>
                    <option value="" selected disabled>Select States</option>
                    <?php 
                        $state_query = "SELECT * FROM state";
                        $results = mysqli_query($connect,$state_query);
                        foreach($results as $state) { ?>
                        <option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col-6 inputBox">
                  <select name="comp_district" id="comp_district" class="arrow" required>
                      <option value="" selected disabled>Select Districts</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-6 inputBox mb-3">
                  <select name="vaccine_center_id" id="vaccine_center_id" class="arrow" required>
                    <option value="" selected disabled>Select Vaccine Center</option>
                  </select>
                </div>
                <div class="col-6 inputBox">
                  <input
                    type="text"
                    name="comp_pincode"
                    onkeydown="return /[a-z,A-Z]/i.test(event.key)"
                    required
                    onkeyup="this.setAttribute('value', this.value);"
                    value=""
                  />
                  <label>Pincode</label>
                </div>
              </div>
              <div class="row mb-3">
                <label>Address</label>
                <div class="col-12 inputBox">
                    <textarea class="form-control" name="comp_address" rows="5" resize="none"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-center">
                  <input type="submit" class="btn btn-primary" name="add_stock" value="Add Stock"/>
                </div>
              </div>
            </form>
          </div>
      </div>
  </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('#comp_state').on('change', function() {
          var id = this.value;
          $.ajax({
              url: "../district-by-state.php",
              type: "POST",
              data: {
                  id: id
              },
              cache: false,
              success: function(result) {
                  $("#comp_district").html(result);
              },
          });
      });
      $('#comp_district').on('change', function() {
            var id = this.value;
            $.ajax({
                url: "../district-by-center.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                  if (result.length > 0) {
                     $('#vaccine_center_id').html(result);
                  }
                },
            });
        });
    });
</script>


<?php

    if(isset($_POST["add_stock"])){

      $vaccine_center_id = $_POST["vaccine_center_id"];
      $vaccine_name = $_POST["vaccine_name"];
      $quantity = $_POST["quantity"];
      $company_name = $_POST["company_name"];
      $supplier_name = $_POST["supplier_name"];
      $phone_number = $_POST["phone_number"];
      $comp_pnumber = $_POST["comp_pnumber"];
      $comp_state = $_POST["comp_state"];
      $comp_district = $_POST["comp_district"];
      $comp_pincode = $_POST["comp_pincode"];
      $comp_address = $_POST["comp_address"];

      $result = mysqli_query($connect, "INSERT INTO `vaccine_stock`(`vaccine_center_id`, `vaccine_name`, `quantity`, `company_name`, `supplier_name`, `phone_number`, `comp_pnumber`, `comp_state`, `comp_district`, `comp_pincode`, `comp_address`) VALUES ('$vaccine_center_id','$vaccine_name','$quantity','$company_name','$supplier_name','$phone_number','$comp_pnumber','$comp_state','$comp_district','$comp_pincode','$comp_address')");

      $last_insert_id = mysqli_insert_id($connect); 
      $schedule_date = date("Y/m/d");
      $vaccinator_id = $result1['ID'];

      $result1 = mysqli_query($connect, "INSERT INTO `schedule`(`stock_no`, `vc_id`, `vaccinator_id`, `vaccine_name`, `schedule_date`, `quantity`, `remain_quantity`) VALUES ('$last_insert_id','$vaccine_center_id','$vaccinator_id','$vaccine_name','$schedule_date','$quantity','$quantity')");

      if ($result && $result1) {
      echo "success";
    } else {
        echo ("Could not insert data : " . mysqli_error($connect));
    }
      if($result && $result1 == true){ ?>
        <script>
          $(document).ready(function() {
              swal({
                  title: "Vaccine Stock inserted Successfully!",
                  icon: "success",
                  timer: 2000,
                  button: false,
                  timerProgressBar:true,
              });
          });
          setTimeout(() => {
            window.location.replace("vaccine_stock_list.php");
          }, 2500);
        </script>
    <?php
      }
    }
?>