<?php
    require_once "../db_connect.php";

    $query = mysqli_query($connect, "SELECT * FROM `appoinment`");
    while ($row = mysqli_fetch_array($query)) {   
        ?>   
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['aadhaar_no']; ?></td>
            <td><img src="<?php echo $row['aadhaar_img']; ?>" alt="<?php echo $row['name']; ?>"/></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['vaccine_name']; ?></td>
            <td><?php echo $row['appo_time']; ?></td>
            <td><?php echo $row['appo_date']; ?></td>
            <td><?php echo $row['appo_status']; ?></td>
        </tr>
    <?php
    }
?>