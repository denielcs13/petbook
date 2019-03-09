<?php
session_start();
require 'dbcon.php';
$parent_id=$_SESSION['pet_unique_id'];

if(isset($_POST['accept'])) {
$req_acc=mysqli_query($conn,"UPDATE group_users SET status='1' WHERE user_id_fk='$parent_id' AND group_id_fk='$_POST[accept]'");	

$profileqry=mysqli_query($conn,"SELECT * FROM groups WHERE group_id='$_POST[accept]'");
$profileinfo=mysqli_fetch_assoc($profileqry);	
	                           mkdir($parent_id . "/Groups/".$profileinfo[group_name]."/Photos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$profileinfo[group_name]."/Videos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$profileinfo[group_name]."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$profileinfo[group_name]."/post_images", 0777, true);
                                   mkdir($parent_id . "/Groups/".$profileinfo[group_name]."/profile_pic", 0777, true);
     echo "JOIND";                              
}
else if(isset($_POST['reject'])) {
	
$req_rej=mysqli_query($conn,"DELETE FROM group_users WHERE user_id_fk='$parent_id' AND group_id_fk='$_POST[reject]'");

echo "DECLINED";
}
?>