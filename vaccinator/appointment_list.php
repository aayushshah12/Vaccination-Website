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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
    <title>Vaccinator Appointment List</title>
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

    <div class="container mt-5">
        <div class="row">
            <div class="box1 d-flex justify-content-between align-items-center">
                <div class="info1">
                    <p style="margin-top: 15px;">Number Of Appointment :
                        <?php 
                        $vc_id = $_SESSION['vaccinator_vcid'];
                        $query = mysqli_query($connect, "SELECT * FROM appoinment where vc_id = $vc_id");
                        $row1 = mysqli_num_rows($query);
                        echo $row1 ;?>
                    </p>
                </div>
                <div class="info2">
                    <a class="btn btn-warning" href="add_appointment.php">Add Appointment</a>
                </div>
            </div>
            
            <div class="box2 mt-5">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Aadhar No.</th>
                            <th>Aadhar Image</th>
                            <th>Phone No.</th>
                            <th>Appointment Time</th>
                            <th>Appointment Date</th>
                            <th>Appointment Status</th>
                            <th>Verify Appointment</th>
                        </tr>
                    </thead>
                    <tbody id="appointment_data">
                    <?php
                        $query = mysqli_query($connect, "SELECT * FROM appoinment where vc_id = $vc_id");
                        $counter = 0;
                        $row1 = mysqli_num_rows($query);
                        while ($row = mysqli_fetch_array($query)) {  
                        ?>
                            
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['aadhaar_no']; ?></td>
                                <td><a href="<?php echo $row['aadhaar_img']; ?>" target="_blank"><?php echo $row['aadhaar_img']; ?></a></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['appo_time']; ?></td>
                                <td><?php echo $row['appo_date']; ?></td>
                                <td><?php echo $row['appo_status']; ?></td>
                                <td>
                                    <?php 
                                    if($row['appo_status'] == 'not-visited'){ 
                                        echo '<a href="add_vaccination.php?ID='.$row['appo_no'].'" class="btn btn-danger status"><i class="fa fa-xmark fa-lg"></i></a>';
                                    } else {
                                        echo '<button class="btn btn-success status"><i class="fa fa-check fa-lg"></i></button>';
                                    } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>