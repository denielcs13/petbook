<?php
session_start();
 require('dbcon.php');
$parent_id=$_SESSION['business_unique_id'];
$last_id=$_GET['last_id'];

$userqry=mysqli_query($conn,"SELECT * FROM business WHERE business_uniqueid='$parent_id'");
$userinfo=mysqli_fetch_assoc($userqry);


$display = "SELECT * FROM post WHERE child_post_id='$parent_id' AND id < '$last_id' ORDER BY id DESC LIMIT 4";


       $disprun=mysqli_query($conn,$display);
   $json = include('bus_postdata.php');
   json_encode($json);
   
?>


