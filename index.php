<?php
require_once 'db_connect.php';

//Fetch all data in database
$sql="SELECT * FROM `vaccination`";
$result=mysqli_query($connect,$sql);
$total_vaccination=mysqli_num_rows($result);

$sql="SELECT * FROM `vaccine_center`";
$result1=mysqli_query($connect,$sql);
$vaccine_center=mysqli_num_rows($result1);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
    <title>CoWIN Application</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <h1><a class="navbar-brand logo" href="index.php">Vaccination</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="admin/admin_login.php">ADMIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="vaccinator/vaccinator_login.php">VACCINATOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="user_login.php">LOGIN/REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="start_box" class=" bg-primary">
        <img src="assets/images/1.png" alt="starting image">
        <h2>Welcome to our Vaccination Website</h2>
    </div>
    <div class="count_section">
        <div class="c1">
            <i class='fas fa-syringe' style='font-size:100px'></i>
            <p class="number"><?php echo $total_vaccination; ?></p>
            <p class="text">Total Vaccination</p>
        </div>
        <div class="c1">
            <i class='fas fa-clinic-medical' style='font-size:100px'></i>
            <p class="number"><?php echo $vaccine_center;?></p>
            <p class="text">Total Vaccine Center</p>
        </div>
    </div>
    <hr>
    <div id="search_box" style="margin-top: 50px;">
        <h1 class="ms-5 pt-4 pb-4" style="text-align: center;">Search a Vaccine Center Near By you</h1>
        <div class="container ">
            <form>
                <div class="row" style="justify-content: center;">
                    <div class="col-4">
                        <label for="state" class="form-label">Select State:</label>
                        <select name="state" id="state" class="arrow form-select" required>
                            <option value="" selected disabled>States</option>
                            <?php 
                                $sql = "SELECT * FROM state";
                                $result = mysqli_query($connect,$sql);
                                foreach($result as $state) { ?>
                                <option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="city" class="form-label">Select District:</label>
                        <select name="city" id="city" class="arrow form-select" required>
                            <option value="" selected disabled>Select District</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="container mb-5 mt-5">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Country</th>
                            <th>PinCode</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody id="display_center"></tbody>
                </table>

            </div>
        </div>
    </div>


    </div>
    <!-- Footer section Start -->

    <!-- Footer section End -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
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
                    $("#city").html(result);
                },
            });
        });

        $('#city').on('change', function() {
            var id = this.value;
            $.ajax({
                url: "city-by-center.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                    if (result.length > 0) {
                        $('#display_center').html(result);
                    } else {
                        $('#display_center').html("<tr><td>No Center Found</td></tr>");
                    }
                },
            });
        });
    });
    </script>
</body>
</html>