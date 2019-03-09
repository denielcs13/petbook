<?php
include("dbcon.php");
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

$reply=mysqli_real_escape_string($conn,$_POST['reply']);
$uid=mysqli_real_escape_string($conn,$parent_id);
date_default_timezone_set("Asia/Calcutta");
$post_datetime=date('Y-m-d H:i:s');

$user_one=mysqli_real_escape_string($conn,$parent_id);
$user_two=mysqli_real_escape_string($conn,$_POST['msg_id']);
echo $user_one;
echo $user_two;
if($user_one!=$user_two)
{
$q= mysqli_query($conn,"SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysql_error());
//date_default_timezone_set("Asia/Calcutta");
$time=date('Y-m-d H:i:s');
$ip=$_SERVER["REMOTE_ADDR"];
if(mysqli_num_rows($q)==0) 
{ 
$q1 = "INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')";
//print_r($v['c_id']);
if ($conn->query($q1) === TRUE) 
    {
                    $last_id = $conn->insert_id;
                    echo $last_id;
                    $q= mysqli_query($conn,"INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) VALUES ('$uid','$reply','$ip','$time','$last_id')") or die(mysqli_error());
    }

}
else
{
$q=mysqli_query($conn,"SELECT c_id FROM conversation WHERE user_one='$user_one' or user_two='$user_one' ORDER BY c_id DESC limit 1");
$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
//return $v['c_id'];
$q= mysqli_query($conn,"INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) VALUES ('$uid','$reply','$ip','$time','$v[c_id]')") or die(mysqli_error());
}
}





