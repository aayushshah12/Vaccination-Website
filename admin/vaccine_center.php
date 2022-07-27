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

    <link rel="stylesheet" type="text/css" href="../css/vaccine_center.css">
    <title>Vaccine Center</title>
    <style>
        i{
            font-size: 20px;
            background-color: #0264b9;
            padding: 10px;
            border-radius: 50px;
        }
        i.fa.fa-pencil{
            color: #26f500;
        }
        i.fa.fa-trash{
            color: #00f5f5;
        }
    </style>
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
                        <a class="nav-link active" href="vaccine_center.php">Vaccine Center</a>
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
                    $query = mysqli_query($connect, "SELECT * FROM vaccine_center");
                    $row1=mysqli_num_rows($query);
                    echo $row1;
                ?>
            </p>
        </div>
        <div class="info2">
            <a class="btn1" href="add_vaccine_center.php">Add Vaccine Center</a>
            <!-- <button class="btn2" id="refresh_btn"> Refresh</button> -->
        </div>
    </div>

    <div class="box2">
        <table class="table table-bordered table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Vaccine Name</th>
                    <th>Vaccine Hospital Type</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Pincode</th>
                    <th>Address</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="vaccine_center_data">
            <?php
                $query = mysqli_query($connect, "SELECT vaccine_center.*,state.state_name,district.district_name FROM vaccine_center JOIN `state` on vaccine_center.state = `state`.id JOIN `district` on vaccine_center.distrik = `district`.id ORDER By vc_id desc");
                $counter = 0;
                $row1=mysqli_num_rows($query);
                while ($row = mysqli_fetch_array($query)) {  
                ?>
                    
                    <tr>
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['contact_no']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['state_name']; ?></td>
                        <td><?php echo $row['district_name']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['pincode']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><a href="update_vaccine_center.php?ID=<?php echo $row['vc_id'];?>"><i class="fa fa-pencil"></i></a></td>
                        <td><a href="javascript:vaccine_deletes(<?php echo $row['vc_id']; ?>)"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
<script>
    function vaccine_deletes(id)
    {
        $(document).ready(function() {
            swal({
                title: 'Confirmation',
                text: "Are you sure?",
                icon: 'warning',
                buttons: true,
                buttonsText1: 'Cancel',
                buttonsText2: 'Ok',
                }).then((result) => {
                if (result == true) {
                    window.location.href='delete_vaccine_center.php?id='+id;
                    swal('Deleted!','Your data has been deleted.','success')
                }
            })
        });
    }
    $(document).ready(function() {
        // $('#refresh_btn').on('click', function() {
        //     $.ajax({
        //         url: "vaccine_center_data.php",
        //         type: "POST",
        //         cache: false,
        //         success: function(result) {
        //             $("#vaccine_center_data").html(result);
        //         },
        //     });
        // });
        $('#myTable').DataTable({
            "search":true,
            "paging":true,
            "ordering": false,
        });
    });
</script>
</body>
</html>