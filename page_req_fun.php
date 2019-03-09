<?php
session_start();
require 'dbcon.php';
print_r($_SESSION);
$pg_id=$_SESSION['pg_id'];
date_default_timezone_set("Asia/Calcutta");
$req_datetime=date('Y-m-d H:i:s');
if(isset($_POST['accept'])) {

$req_acc=mysqli_query($conn,"INSERT INTO `page_users`(`page_id_fk`, `user_id_fk`, `status`,`time`) VALUES ('$pg_id','$_POST[accept]','0','$req_datetime')");
//print_r($req_acc);
echo "ADDED";
}
?>