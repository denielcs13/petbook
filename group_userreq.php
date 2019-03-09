<?php
session_start();
include("dbcon.php");

if(isset($_POST['acceptid'])) {
$addqry=mysqli_query($conn,"UPDATE group_users SET status='1' WHERE group_id_fk='$_POST[grpid]' AND user_id_fk='$_POST[acceptid]' AND status='2'");

$profileqry=mysqli_query($conn,"SELECT * FROM groups WHERE group_id='$_POST[grpid]'");
$profileinfo=mysqli_fetch_assoc($profileqry);	

                                   mkdir($_POST['acceptid'] . "/Groups/".$profileinfo['group_name']."/Photos", 0777, true);
                                   mkdir($_POST['acceptid'] . "/Groups/".$profileinfo['group_name']."/Videos", 0777, true);
                                   mkdir($_POST['acceptid'] . "/Groups/".$profileinfo['group_name']."/Shared_Videos", 0777, true);
                                   mkdir($_POST['acceptid'] . "/Groups/".$profileinfo['group_name']."/post_images", 0777, true);
                                   mkdir($_POST['acceptid'] . "/Groups/".$profileinfo['group_name']."/profile_pic", 0777, true);
echo "Accepted";
}
if(isset($_POST['rejectid'])) {
$rejqry=mysqli_query($conn,"DELETE FROM group_users WHERE group_id_fk='$_POST[grpid]' AND user_id_fk='$_POST[rejectid]' AND status='2'");
echo "Rejected";
	
}
?> 