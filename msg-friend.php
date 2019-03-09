<?php
require 'dbcon.php';
session_start();
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
if(isset($_POST["usr_id"])){
$user_one=mysqli_real_escape_string($conn,$_SESSION['pet_unique_id']);
$user_two=mysqli_real_escape_string($conn,$_POST['usr_id']);
if($user_one!=$user_two)
{
$q= mysqli_query($conn,"SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysql_error());
date_default_timezone_set("Asia/Calcutta");
$time=date('Y-m-d H:i:s');
$ip=$_SERVER["REMOTE_ADDR"];
if(mysqli_num_rows($q)==0) 
{ 
$query = mysqli_query($conn,"INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysql_error());
//print_r($v['c_id']);
}
else
{
$q=mysqli_query($conn,"SELECT c_id FROM conversation WHERE user_one='$user_one' or user_two='$user_one' ORDER BY c_id DESC limit 1");
$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
return $v['c_id'];
// $v=mysqli_fetch_array($q,MYSQLI_ASSOC);
// return $v['c_id'];
//print_r($v['c_id']);
}
}
}
?>