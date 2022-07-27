<?php
    require_once "db_connect.php";
    $id = $_POST["id"];

    $query = mysqli_query($connect, "SELECT * FROM `vaccine_center` WHERE `distrik`='$id'");
    while ($row = mysqli_fetch_array($query)) {   
        // echo '<pre>',print_r($row);
        ?>   
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['pincode']; ?></td>
            <td><?php echo $row['state'].','.$row['distrik'].','.$row['address']; ?></td>
        </tr>
    <?php
    }
?>