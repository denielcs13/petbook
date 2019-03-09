<?php
session_start();
$ngo_id=$_POST["id"];
$user_id = $_POST["userid"];
require 'dbcon.php';
$follow_check = "SELECT * FROM ngo_like WHERE ngo_id='$ngo_id' AND user_id='$user_id'";
$result_check = mysqli_query($conn,$follow_check);
if(mysqli_num_rows($result_check)>0)
{
 while($row = mysqli_fetch_assoc($result_check))
 {
	
	$users = $row["user_id"];
	$business_id = $row["group_id"];
	$delete_follow = "DELETE FROM ngo_like WHERE user_id = '$users' and ngo_id = '$ngo_id'";
	$delete_addfriend="DELETE FROM addfriend WHERE parent_id='$ngo_id' AND child_id='$user_id' AND status='4'";
	mysqli_query($conn,$delete_follow);
	mysqli_query($conn,$delete_addfriend); 
	echo "Follow";
 }  
}
else {

$follow_ngo = "INSERT INTO ngo_like(ngo_id,user_id,status) VALUES ('$ngo_id','$user_id','1')";
mysqli_query($conn,$follow_ngo);
$follow_ngo_addfriend = "INSERT INTO addfriend(parent_id,child_id,status) VALUES ('$ngo_id','$user_id','4')";
mysqli_query($conn,$follow_ngo_addfriend);
echo "UnFollow";
}
?>
