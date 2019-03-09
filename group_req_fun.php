<?php
session_start(); 
require 'dbcon.php';
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}
date_default_timezone_set("Asia/Calcutta");
$req_datetime=date('Y-m-d H:i:s');
if(isset($_POST['accept'])) {
$gp_id=$_POST['grpid'];
$req_chk=mysqli_query($conn,"SELECT * FROM group_users WHERE group_id_fk='$gp_id' AND user_id_fk='$_POST[accept]' AND status='0'");
if(mysqli_num_rows($req_chk)<1) {
$req_acc=mysqli_query($conn,"INSERT INTO group_users(group_id_fk,user_id_fk,status,time)VALUES('$gp_id','$_POST[accept]','0','$req_datetime')");
	echo "Request Sent";
}
}
if(isset($_POST['joinid'])) {
	$req_chk=mysqli_query($conn,"SELECT * FROM group_users WHERE group_id_fk='$_POST[joinid]' AND user_id_fk='$parent_id' AND status='2'");
	if(mysqli_num_rows($req_chk)<1) {
	$req_join=mysqli_query($conn,"INSERT INTO group_users(group_id_fk,user_id_fk,status,time)VALUES('$_POST[joinid]','$parent_id','2','$req_datetime')");
	//echo "<span class='join-message'>Request Sent</span>";
}
}

if(isset($_POST['leaveid'])) {
	
	$req_join=mysqli_query($conn,"DELETE FROM group_users WHERE group_id_fk='$_POST[leaveid]' AND user_id_fk='$parent_id' AND status='1'");

}
?>