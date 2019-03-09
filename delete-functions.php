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
?>
<?php
//$uniqueid = $_SESSION['pet_unique_id'];
$uniqueid = $parent_id;
if(isset($_POST['delete_f'])) {
//$user=  mysqli_query($conn,"SELECT user_id_fk from events WHERE event_id='$_POST[delete_f]'");
//$u_info=  mysqli_fetch_assoc($user);
mysqli_query($conn, "DELETE FROM  `event_users` WHERE `event_id_fk` =  '$_POST[delete_f]' AND `user_id_fk` = '$uniqueid' AND `status` =  '1'");
echo $_POST['delete_f'].$u_info['user_id_fk'];
}
if(isset($_POST['delete_f_u'])) {
//$user=  mysqli_query($conn,"SELECT user_id_fk from events WHERE event_id='$_POST[delete_f]'");
//$u_info=  mysqli_fetch_assoc($user);
mysqli_query($conn, "DELETE FROM  `events` WHERE `event_id` =  '$_POST[delete_f_u]' AND `user_id_fk` = '$uniqueid' AND `status` =  '1'");
echo $_POST['delete_f_u'].$u_info['user_id_fk'];
} 
if(isset($_POST['delete_p'])) {
//$user=  mysqli_query($conn,"SELECT user_id_fk from events WHERE event_id='$_POST[delete_f]'");
//$u_info=  mysqli_fetch_assoc($user);
mysqli_query($conn, "DELETE FROM  `page_users` WHERE `page_id_fk` =  '$_POST[delete_p]' AND `user_id_fk` = '$uniqueid' AND `status` =  '0'");
echo $_POST['delete_f_u'].$u_info['user_id_fk'];
}

if(isset($_POST['delmsg'])) {
//$user=  mysqli_query($conn,"SELECT user_id_fk from events WHERE event_id='$_POST[delete_f]'");
//$u_info=  mysqli_fetch_assoc($user);
mysqli_query($conn, "DELETE FROM  `conversation` WHERE `c_id` = '$_POST[delmsg]'");
//echo $_POST['delete_f_u'].$u_info['user_id_fk'];
}

?>