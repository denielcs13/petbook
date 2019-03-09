<?php
session_start();
$business_id=$_POST["id"];
$user_id = $_POST["userid"];
require 'dbcon.php';
$follow_check = "SELECT * FROM event_users WHERE event_id_fk = '$business_id' AND user_id_fk='$user_id'";
$result_check = mysqli_query($conn,$follow_check);
if(mysqli_num_rows($result_check)>0)
{
 while($row = mysqli_fetch_assoc($result_check)) {
	
	$users = $row["user_id_fk"];
	$business_id = $row["event_id_fk"];
	$delete_follow = "DELETE FROM event_users WHERE event_id_fk = '$business_id' AND user_id_fk = '$users'";
	mysqli_query($conn,$delete_follow);
//	$addfriend_follow = "DELETE FROM addfriend where parent_id ='$business_id' and child_id = '$users' AND status='4'";
//	mysqli_query($conn,$addfriend_follow);
	echo "Going";
 }  
}
else{

$follow_business = "INSERT INTO event_users(event_id_fk,user_id_fk,status) VALUES ('$business_id','$user_id','1')";
mysqli_query($conn,$follow_business);
$profileqry=mysqli_query($conn,"SELECT * FROM events WHERE event_id='$business_id'");
$profileinfo=mysqli_fetch_assoc($profileqry);
                                   mkdir($user_id . "/Events/".$profileinfo[event_name]."/Photos", 0777, true);
                                   mkdir($user_id . "/Events/".$profileinfo[event_name]."/Videos", 0777, true);
                                   mkdir($user_id . "/Events/".$profileinfo[event_name]."/Shared_Videos", 0777, true);
                                   mkdir($user_id . "/Events/".$profileinfo[event_name]."/post_images", 0777, true);
                                   mkdir($user_id . "/Events/".$profileinfo[event_name]."/profile_pic", 0777, true);
//mysqli_query($conn,"INSERT INTO addfriend(parent_id,child_id,status)VALUES('$business_id','$user_id','4')");
echo "Not Going";
}
?>
