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
$share_datetime=date('Y-m-d H:i:s');
	//print_r($_POST);
	$count=count($_POST); 
	foreach($_POST as $name) {
	if(!next($_POST)) {
        continue;
    } 
	$share_name=mysqli_query($conn,"SELECT pet_name FROM user_inf WHERE pet_unique_id='$name' UNION SELECT company_name FROM business WHERE business_uniqueid='$name' UNION SELECT ngo_name FROM ngo_resgitration WHERE ngo_unique_id='$name'");
	$spet_name=mysqli_fetch_assoc($share_name);
	
$chk_share=mysqli_query($conn,"SELECT * FROM page_shares WHERE page_id='$_POST[pid]' AND sharer_id='$parent_id' AND share_with='$name'");

	if(mysqli_num_rows($chk_share)>0) {
		echo "You Have Already Shared This Page With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
		continue;	
	} 
	$shareqry="INSERT INTO page_shares(page_id,sharer_id,share_with,time)VALUES('$_POST[pid]','$parent_id','$name','$share_datetime')";
	if(mysqli_query($conn,$shareqry)) {
		echo "Page Shared With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
	}
	
	}

?>
