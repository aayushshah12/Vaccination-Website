<?php
    require_once "db_connect.php";
    $id = $_POST["id"];
    $query = mysqli_query($connect, "SELECT * FROM `vaccine_center` WHERE `distrik`='$id'");
?>
    <option value="" selected disabled>Select Vaccine Center</option>
<?php
    while($row = mysqli_fetch_array($query)) {
?>
    <option value="<?php echo $row["vc_id"];?>"><?php echo $row["name"];?> - <?php echo $row["address"];?></option>
<?php
    }
?>