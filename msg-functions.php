<?php
session_start();
require './dbcon.php';
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

if (isset($_POST['msg_data'])) {
$user_one=$parent_id;
$user_two=$_POST['id'];
echo '$user_one';
echo '$user_two';
if($user_one!=$user_two)
{
$q= mysqli_query($conn,"SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysql_error());
$time=time();
$ip=$_SERVER['REMOTE_ADDR'];
if(mysql_num_rows($q)==0) 
{ 
$query = mysqli_query($conn,"INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysql_error());
$q=mysqli_query($conn,"SELECT c_id FROM conversation WHERE user_one='$user_one' ORDER BY c_id DESC limit 1");
$v=mysql_fetch_array($q,MYSQLI_ASSOC);
return $v['c_id'];
}
else
{
$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
return $v['c_id'];
}
}

}
?>