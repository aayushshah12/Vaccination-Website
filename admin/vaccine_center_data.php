<?php
    require_once "../db_connect.php";

    $query = mysqli_query($connect, "SELECT * FROM `vaccine_center`");
    while ($row = mysqli_fetch_array($query)) {   
        ?>   
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['contact_no']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['distrik']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['pincode']; ?></td>
            <td><?php echo $row['address']; ?></td>
        </tr>
    <?php
    }
?>