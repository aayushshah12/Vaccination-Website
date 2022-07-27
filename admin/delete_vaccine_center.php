<?php 

include('../db_connect.php');

$id=$_GET['id'];

mysqli_query($connect,"DELETE from vaccine_center where vc_id='$id'");

header('location:vaccine_center.php');

?>