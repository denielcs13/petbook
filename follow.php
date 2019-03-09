<?php
session_start();
$business_id=$_POST["id"];
$user_id = $_POST["userid"];
require 'dbcon.php';
$follow_check = "SELECT * FROM business_like WHERE group_id = '$business_id' AND user_id='$user_id'";
$result_check = mysqli_query($conn,$follow_check);
if(mysqli_num_rows($result_check)>0)
{
 while($row = mysqli_fetch_assoc($result_check))
 {
	
	$users = $row["user_id"];
	$business_id = $row["group_id"];
	$delete_follow = "DELETE FROM business_like WHERE group_id = '$business_id' AND user_id = '$users'";
	mysqli_query($conn,$delete_follow);
	$addfriend_follow = "DELETE FROM addfriend where parent_id ='$business_id' and child_id = '$users' AND status='4'";
	mysqli_query($conn,$addfriend_follow);
	echo "Follow";
 }  
}
else{

$follow_business = "INSERT INTO business_like(group_id,user_id,status) VALUES ('$business_id','$user_id','1')";
mysqli_query($conn,$follow_business);
mysqli_query($conn,"INSERT INTO addfriend(parent_id,child_id,status)VALUES('$business_id','$user_id','4')");
echo "UnFollow";
}
?>
