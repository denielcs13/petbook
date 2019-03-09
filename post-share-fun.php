<?php
session_start();
 require 'dbcon.php';
 $parent_id = $_SESSION['pet_unique_id'];
     date_default_timezone_set("Asia/Calcutta"); 
$share_datetime=date('Y-m-d H:i:s');
	//print_r($_POST);
	$count=count($_POST);
	foreach($_POST as $name) {
	if(!next($_POST)) {
        continue;
    }
	$share_name=mysqli_query($conn,"SELECT pet_name FROM user_inf WHERE pet_unique_id='$name'");
	$spet_name=mysqli_fetch_assoc($share_name);
	
$chk_share=mysqli_query($conn,"SELECT * FROM shares WHERE post_id='$_POST[pid]' AND sharer_id='$parent_id' AND share_with_id='$name'");

	if(mysqli_num_rows($chk_share)>0) {
		echo "You Have Already Shared This Post With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
		continue;	
	} 
	$shareqry="INSERT INTO shares(post_id,sharer_id,share_with_id,time)VALUES('$_POST[pid]','$parent_id','$name','$share_datetime')";
	if(mysqli_query($conn,$shareqry)) {
		echo "Post Shared With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
	}
	
	}

?>
