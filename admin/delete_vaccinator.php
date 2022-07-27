<?php 

include('../db_connect.php');

$id=$_GET['id'];

mysqli_query($connect,"DELETE from vaccinator where ID='$id'");

header('location:vaccinator_list.php');

?>