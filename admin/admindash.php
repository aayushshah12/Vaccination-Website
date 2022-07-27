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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/admindash.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <!-- <h1>Hello, Welcome to Dashboard</h1> -->
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
                        <a class="nav-link active" aria-current="page" href="admindash.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appoinment.php">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccine_center.php">Vaccine Center</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccinator_list.php">Vaccinator list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vaccination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccine_stock.php">Vaccine Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php">Logout</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->

    <!-- php coding start -->
    <?php
    $sql="SELECT * from vaccination"; // Fetch data from Vaccination Table
    $vaccination=$connect->query($sql);
    $row1=mysqli_num_rows($vaccination);

    $sql="SELECT * from vaccinator"; //Fetch  data from vaccinator table
    $va=$connect->query($sql);
    $row2=mysqli_num_rows($va);

    $sql="SELECT * from vaccine_center";// Fetch data from vaccine_center table
    $vc=$connect->query($sql);
    $row3=mysqli_num_rows($vc);

    ?>

    <h2 class="h2">Hii, Admin</h2>
    <p class="p2">Welcome to over Vaccination site..</p>
    <div class="box1">
        <div class="card1"><i class='fas fa-syringe i1'></i><p class="p1"><?php echo $row1;?></p><p class="text1">Total Vaccination</p></div>
        <div class="card1"><i class='fas fa-user-tie i1'></i><p class="p1"><?php echo $row2;?></p><p class="text1">Total Vaccinator</p></div>
        <div class="card1"><i class='fas fa-clinic-medical i1'></i><p class="p1"><?php echo $row3;?></p><p class="text1">Total Vaccine Center</p></div>
    </div>
    <footer class="bg-light text-center text-white">
        <div class="container p-4 pb-0">
            <section class="mb-4">
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #3b5998;"
                href="#!"
                role="button"
                ><i class="fab fa-facebook-f"></i
            ></a>
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #55acee;"
                href="#!"
                role="button"
                ><i class="fab fa-twitter"></i
            ></a>
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #dd4b39;"
                href="#!"
                role="button"
                ><i class="fab fa-google"></i
            ></a>
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #ac2bac;"
                href="#!"
                role="button"
                ><i class="fab fa-instagram"></i
            ></a>
            </section>
        </div>
        <div class="text-center p-3 bg-primary">
            © 2020 Copyright:
            <a class="text-white" href="http://localhost/vaccination">CoWin Application</a>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
</body>
</html>