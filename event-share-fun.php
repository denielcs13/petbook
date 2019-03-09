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
	
$chk_share=mysqli_query($conn,"SELECT * FROM event_users WHERE event_id_fk='$_POST[event_id]' AND user_id_fk='$name'");

	if(mysqli_num_rows($chk_share)>0) {
		echo "You Have Already Invite This Events With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
		continue;	
	} 
	$shareqry="INSERT INTO event_users(event_id_fk,user_id_fk,status,time)VALUES('$_POST[event_id]','$name','0','$share_datetime')";
	if(mysqli_query($conn,$shareqry)) {
		echo "Events Invited With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
	}
	
	}

?>
