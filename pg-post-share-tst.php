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
	$share_name=mysqli_query($conn,"SELECT pet_name FROM user_inf WHERE pet_unique_id='$name'");
	$spet_name=mysqli_fetch_assoc($share_name);
	
$chk_share=mysqli_query($conn,"SELECT * FROM shares WHERE post_id='$_POST[pid]' AND sharer_id='$parent_id' AND share_with_id='$name' AND type='post'");

	if(mysqli_num_rows($chk_share)>0) {
		echo "You Have Already Shared This Post With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
		continue;	
	} 
	$shareqry="INSERT INTO shares(post_id,sharer_id,share_with_id,type,time)VALUES('$_POST[pid]','$parent_id','$name','post','$share_datetime')";
	if(mysqli_query($conn,$shareqry)) {
		echo "Post Shared With ".$spet_name['pet_name']."&nbsp;&nbsp;&nbsp;";
	}
	
	$postqry=mysqli_query($conn,"SELECT * FROM pg_updates WHERE p_update_id='$_POST[pid]'"); 
	$postdata=mysqli_fetch_assoc($postqry);
	
	$postshareqry=mysqli_query($conn,"INSERT INTO post(child_post_id,title,posts,url,image,img_count,video,vid_count, type,share_with,time) VALUES ('$parent_id','$postdata[title]','$postdata[page_data]','$postdata[url]','$postdata[image]','$postdata[img_count]','$postdata[video]','$postdata[vid_count]','shared','$name','$share_datetime')");
	
	
	
	
	}

?>
