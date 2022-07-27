<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "vdrive1";

    $connect = mysqli_connect($servername,$username,$password,$db_name);
    if($connect->connect_error){
        die("Connection Failed".$connect->connect_error);
    }
?>
