<?php
session_start();
$email = $_SESSION["owner_email"];
$random = rand(11111, 99999);
$random_number = $random;
print_r($random_number);
require_once './dbcon.php';
$update_otp = "update otp_verfication set otp = '$random_number' where 	email = '$email'";
mysqli_query($conn, $update_otp);
header("Location:opt-verification.php");
?>
