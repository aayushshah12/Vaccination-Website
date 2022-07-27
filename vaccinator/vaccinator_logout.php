<!doctype html>
<html lang="en">
<head>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<html>
    
<?php 
session_start();
session_destroy(); 
?>
<script>
    $(document).ready(function() {
        swal({
            title: "Logout Successfull",
            icon: "success",
            timer: 2000,
            button: false,
            timerProgressBar:true,
        });
    });
    setTimeout(() => {
    window.location.replace("vaccinator_login.php");
    }, 2500);
</script>