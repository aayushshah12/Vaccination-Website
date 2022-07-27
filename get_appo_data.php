<?php
    require_once "db_connect.php";
    $aadhar_no = $_POST["aadhar_no"];

    $query = mysqli_query($connect, "SELECT appo_date,appo_time,vaccine_name,appo_user_id FROM appoinment where aadhaar_no = $aadhar_no");

    while ($row1 = mysqli_fetch_assoc($query)) { 
        // echo '<pre>',print_r($row1);    
    ?>   
        <li class="tag__item"><i class="fa fa-calendar mr-2"></i> <?php echo date('j F, Y', strtotime($row1['appo_date'])) ?></li>

        <li class="tag__item"><i class="fa fa-clock mr-2"></i> <?php echo $row1['appo_time'] ?></li>

        <li class="tag__item"><i class="fa fa-shield-virus mr-2"></i> <?php echo $row1['vaccine_name'] ?></li>

        <li class="tag__item">Appointment Id. :- <?php echo $row1['appo_user_id'] ?></li>
        
    <?php
    }
?>