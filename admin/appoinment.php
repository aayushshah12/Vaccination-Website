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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/appoinment.css">
    <title>Appointment</title>
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
                        <a class="nav-link active" href="appoinment.php">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccine_center.php">Vaccine Center</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccinator_list.php">Vaccinator list</a>
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

    <div class="box1">
        <div class="info1">
            <p style="margin-top: 15px;">Number Of Appoinment :
                <?php 
                $query = mysqli_query($connect, "SELECT * FROM appoinment");
                $row1=mysqli_num_rows($query);
                echo $row1 ;?>
            </p>
            <!-- <button class="btn1" id="refresh_btn">Refresh</button> -->
        </div>
    </div>

    <div class="box2">
        <table class="table table-bordered table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>Aadhar no.</th>
                    <th>Aadhar Image</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Vaccine Name</th>
                    <th>Appo. Time</th>
                    <th>Appo. Date</th>
                    <th>Appo. Status</th>
                </tr>
            </thead>
            <tbody id="appointment_data">
            <?php
                $query = mysqli_query($connect, "SELECT * FROM appoinment");
                $counter = 0;
                $row1=mysqli_num_rows($query);
                while ($row = mysqli_fetch_array($query)) {  
                ?>
                    
                    <tr>
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['aadhaar_no']; ?></td>
                        <td><img src="../<?php echo $row['aadhaar_img'];?>" alt="<?php echo $row['name']; ?>" style: width="100%;" height="100px"></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['vaccine_name']; ?></td>
                        <td><?php echo $row['appo_time']; ?></td>
                        <td><?php echo $row['appo_date']; ?></td>
                        <td><?php echo $row['appo_status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        // $('#refresh_btn').on('click', function() {
        //     $.ajax({
        //         url: "appointment_data.php",
        //         type: "POST",
        //         cache: false,
        //         success: function(result) {
        //             $("#appointment_data").html(result);
        //         },
        //     });
        // });

        $('#myTable').DataTable({
            "paging":true,
            "ordering": false,
        });
    });
</script>
<script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
</body>
</html>