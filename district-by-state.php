<?php
    require_once "db_connect.php";
    $id = $_POST["id"];
    $result = mysqli_query($connect,"SELECT * FROM district where state_id = $id");
?>
    <option value="" selected disabled>Select District</option>
<?php
    while($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["district_name"];?></option>
<?php
    }
?>