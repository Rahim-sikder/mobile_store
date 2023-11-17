<?php require_once('../config.php'); ?>
<?php
    $apple = new DBConnection();
    $email = $_GET['email'];
    $support_off = "UPDATE clients SET support='0' WHERE email='$email'";
    mysqli_query($apple->conn,$support_off);
    //echo $email;
    header('location:/mobile_store/admin');
?>