<?php
  include('db_connect.php');
  session_start();
  if(isset($_SESSION['mail']) == ''){ ?>
    <script>                     
        window.location.replace('user_login.php');
    </script>
<?php } ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/userdash.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <title>User Dashboard</title>
</head>

<body>

    <!-- Navigation  start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="user_dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="user_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->

    <div class="container-fluid pe-5 d-flex justify-content-end">
        <a href="add_member.php" class="btn btn-success mt-5"><i class="fa fa-plus"></i> Add Member</a>
    </div>

    <?php
        $email = $_SESSION['mail'];
        $query_user_details = mysqli_query($connect, "SELECT id,full_name,adhaar_no,email,cnumber FROM user_details where email = '$email'");
        while($row = mysqli_fetch_assoc($query_user_details)) {
    ?>
        <section>
            <div class="container py-4">
                <article class="postcard dark blue">
                    <a class="postcard__img_link">
                        <img class="postcard__img" src="https://www.pngitem.com/pimgs/m/22-220721_circled-user-male-type-user-colorful-icon-png.png" alt="Image Title" />
                    </a>
                    <div class="postcard__text">
                        <h1 class="postcard__title blue"><?php echo strtoupper($row['full_name']) ?></h1>
                        <ul class="postcard__tagbox">
                            <li class="tag__item"><h4><i class="fa fa-address-card mr-2"></i> <?php echo $row['adhaar_no'] ?></h4></li>
                            <li class="tag__item"><h4><i class="fa fa-envelope mr-2"></i> <?php echo $row['email'] ?></h4></li>
                            <li class="tag__item"><h4><i class="fa fa-mobile mr-2"></i> <?php echo $row['cnumber'] ?></h4></li>
                        </ul>
                        <div class="postcard__bar"></div>

                        <?php
                            $aadhaar_no = $row['adhaar_no'];
                            $query = mysqli_query($connect,"SELECT aadhaar_no from appoinment where aadhaar_no = $aadhaar_no");
                            $num_rows = mysqli_num_rows($query);
                            while($result = mysqli_fetch_assoc($query)){
                                if($result['aadhaar_no'] == $aadhaar_no){ ?>
                                    <button class="btn btn-warning col-sm-4 get_appo_data" value="<?php echo $row['adhaar_no'] ?>">Get Appointment Details</button>
                                    <?php 
                                }
                            }
                        ?>    
                        <ul class="postcard__tagbox get_appo_data_List">
                        <?php
                            $aadhaar_no = $row['adhaar_no'];
                            $query = mysqli_query($connect,"SELECT aadhaar_no from appoinment where aadhaar_no = $aadhaar_no");
                            $num_rows = mysqli_num_rows($query); 
                                if($num_rows == 0) { ?>
                                        <li class="tag__item play blue book_slot">
                                            <i class="fa fa-plus mr-2"></i>
                                            <a href="user_add_appointment.php?ID=<?php echo $row['id'];?>" style="color:#fff"> Book Slot</a>
                                        </li>
                                    <?php 
                                }
                        ?>
                        </ul>
                        <hr/>
                        <?php
                            $aadhaar_no = $row['adhaar_no'];
                            $query = mysqli_query($connect,"SELECT appo_status from appoinment where aadhaar_no = '$aadhaar_no'");
                            while($result = mysqli_fetch_assoc($query)){ 
                                if($result['appo_status'] == 'visited'){ ?>
                                    <form method="post">
                                        <button type="submit" name="generate" class="btn btn-success">Generate Certificate</button>
                                    </form>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </article>
            </div>
        </section>

        <?php
            require_once('fpdf.php');
            if(isset($_POST['generate'])){
                $name_len = strlen($row['full_name']);
                $aadhaar_no = $row['adhaar_no'];
                if ($aadhaar_no) {
                    $font_size_occupation = 10;
                }
                //designed certificate picture
                $image = "certi.png";

                $createimage = imagecreatefrompng($image);

                //this is going to be created once the generate button is clicked
                $output = "certificate.png";

                //then we make use of the imagecolorallocate inbuilt php function which i used to set color to the text we are displaying on the image in RGB format
                $white = imagecolorallocate($createimage, 205, 245, 255);
                $black = imagecolorallocate($createimage, 0, 0, 0);

                //Then we make use of the angle since we will also make use of it when calling the imagettftext function below
                $rotation = 0;

                //we then set the x and y axis to fix the position of our text name
                $origin_x = 200;
                $origin_y=260;

                //we then set the x and y axis to fix the position of our text occupation
                $origin1_x = 120;
                $origin1_y=90;

                //we then set the differnet size range based on the lenght of the text which we have declared when we called values from the form
                if($name_len<=7){
                    $font_size = 25;
                    $origin_x = 190;
                }
                elseif($name_len<=12){
                    $font_size = 30;
                }
                elseif($name_len<=15){
                    $font_size = 26;
                }
                elseif($name_len<=20){
                    $font_size = 18;
                }
                elseif($name_len<=22){
                    $font_size = 15;
                }
                elseif($name_len<=33){
                    $font_size=11;
                }
                else {
                    $font_size =10;
                }

                $certificate_text = $row['full_name'];

                //font directory for name
                $drFont = dirname(__FILE__)."/developer.ttf";

                // font directory for occupation name
                $drFont1 = dirname(__FILE__)."/Gotham-black.otf";

                //function to display name on certificate picture
                $text1 = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black,$drFont, $certificate_text);

                //function to display occupation name on certificate picture
                $text2 = imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x+2, $origin1_y, $black, $drFont1, $aadhaar_no);

                imagepng($createimage,$output,3);

                $pdf = new FPDF('L','in',[11.7,8.27]);
                $pdf->AddPage();
                $pdf->Image("certificate.png",0,0,11.7,8.27);
                $pdf->Output("certificate.pdf","F");

            }
        }
    ?>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // if($(document).hasClass('get_appo_data')){
        //     $(document).removeClass('book_slot');
        // }

        $(document).on("click",".get_appo_data" ,function() {
            var aadhar_no = this.value;
            var button_this = $(this);
            $.ajax({
                url: "get_appo_data.php",
                type: "POST",
                data: {
                    aadhar_no: aadhar_no
                },
                cache: false,
                success: function(result) {
                    button_this.next().html(result);
                },
            });
        });
    });
</script>
</body>
</html>