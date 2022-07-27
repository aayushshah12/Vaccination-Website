<?php
  include('db_connect.php');
  session_start();
  $email = $_SESSION['mail'];
  $query_user_details = mysqli_query($connect, "SELECT email FROM user_details where email = '$email'");
  $result = mysqli_fetch_assoc($query_user_details);
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
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="https://kit.fontawesome.com/a30b25137e.js" crossorigin="anonymous"></script>
    <title>Add Member</title>
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
                        <a class="nav-link" aria-current="page" href="user_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation  End-->
    <div class="box">
        <h2>Add Member</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col mb">
                    <label for="Name" class="form-label">Full Name</label>
                    <input type="text" class="form-control " id="Name" placeholder="Enter Your Full Name" name="full_name">
                </div>
                <div class="col mb">
                    <label for="AdhaarCard_No" class="form-label">Adhaar Card No</label>
                    <input type="text" class="form-control" id="AdhaarCard_No" placeholder="Enter the Adhaar Card No" name="adhaar_no">
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="img" class="form-label">Upload Adhaar Card Image (File Type: jpg,png,jpeg) and Size must be 2MB</label>
                    <input class="form-control" type="file" id="id_proof" name="image">
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
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" disabled>
                </div>
                <div class="col mb">
                    <label for="phone" class="form-label">Phone no</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone Number" name="cnumber">
                </div>
                <div class="col mb">
                    <label for="exampleFormControlInput1" class="form-label">Pincode</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter Your Pincode" name="pincode">
                </div>
            </div>
            <div class="row">
                <div class="col mb">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" rows="3" placeholder="Enter Address as per Your Adhaar Card.." name="address"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" name="signin" class="btn btn-primary btn-lg" value="Add Member">
            </div>
        </form>
    </div>
</body>
</html>

<?php
  include('db_connect.php');

    if(isset($_POST["signin"])){

      $full_name = $_POST["full_name"];
      $adhaar_no = $_POST["adhaar_no"];
      $age = $_POST["age"];
      $gender = $_POST["gender"];
      $email = $result['email'];
      $cnumber = $_POST["cnumber"];
      $pincode = $_POST["pincode"];
      $address = $_POST["address"];

      $sql1="SELECT adhaar_no FROM user_details where adhaar_no='$adhaar_no'";
      $result=$connect->query($sql1);
      $rows=mysqli_num_rows($result);
      $result_data=mysqli_fetch_array($result);

      if($rows==1)
      {
        if($adhaar_no == $result_data['adhaar_no'])
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
        $result = mysqli_query($connect,"INSERT INTO user_details(`full_name`, `adhaar_no`,`age`, `gender`, `email`, `cnumber`, `pincode`, `address`,`account_status`) VALUES ('$full_name','$adhaar_no','$age','$gender','$email','$cnumber','$pincode','$address','Member')");

        // if ($result) {
        //   echo "success";
        // } else {
        //     echo ("Could not insert data : " . mysqli_error($connect));
        // }

        $last_insert_id = mysqli_insert_id($connect);
    
        $target_dir = "uploads/user/";
        
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

        // // Check if file already exists
        // if (file_exists($target_file)) {
        //   echo "Sorry, file already exists.";
        //   $uploadOk = 0;
        // }

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
            $path = './uploads/user/';
            $file_name = $_FILES["image"]["name"];
            $fileNameWithExtension = $path . $file_name;
            $result_file = mysqli_query($connect, "UPDATE user_details SET id_proof = '$fileNameWithExtension' WHERE id='$last_insert_id'");
            
            if($result_file = TRUE) { ?>
                  <script type="text/javascript">
                    $(document).ready(function() {
                        swal({
                            title: "Member added Successfully!",
                            icon: "success",
                            timer: 2000,
                            button: false,
                            timerProgressBar:true,
                        });
                    });
                    setTimeout(() => {
                      window.location.replace("user_dashboard.php");
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
    }
?>