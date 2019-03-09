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

if(isset($_POST['accept'])) {

$reqchk=mysqli_query($conn,"SELECT * FROM page_users WHERE page_id_fk='$_POST[accept]' AND user_id_fk='$parent_id' AND status='0'");
if(mysqli_num_rows($reqchk)>0) {
$req_acc=mysqli_query($conn,"UPDATE page_users SET status='1' WHERE user_id_fk='$parent_id' AND page_id_fk='$_POST[accept]'");

$profileqry=mysqli_query($conn,"SELECT * FROM pages WHERE page_id='$_POST[accept]'");
$profileinfo=mysqli_fetch_assoc($profileqry);	
	                           mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/Photos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/post_images", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/profile_pic", 0777, true);	
echo "LIKED";
}
else {
	$req_acc=mysqli_query($conn,"INSERT INTO page_users(page_id_fk,user_id_fk,status)VALUES('$_POST[accept]','$parent_id','1')");

$profileqry=mysqli_query($conn,"SELECT * FROM pages WHERE page_id='$_POST[accept]'");
$profileinfo=mysqli_fetch_assoc($profileqry);	
	                           mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/Photos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/post_images", 0777, true);
                                   mkdir($parent_id . "/Pages/".$profileinfo[page_name]."/profile_pic", 0777, true);	
echo "LIKED";
}

}
else if(isset($_POST['reject'])) {
	
$req_rej=mysqli_query($conn,"DELETE FROM page_users WHERE user_id_fk='$parent_id' AND page_id_fk='$_POST[reject]'");

echo "UNLIKED";
}
?>