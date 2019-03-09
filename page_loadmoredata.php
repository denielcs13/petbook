<?php
session_start();
  $parent_id=$_SESSION['pet_unique_id'];
   require('dbcon.php');
$last_id=$_GET['last_id'];

$userqry=mysqli_query($conn,"SELECT * FROM pages WHERE user_id_fk='$parent_id'");
$userinfo=mysqli_fetch_assoc($userqry);


$display = "SELECT * FROM pg_updates WHERE user_id_fk='$parent_id' AND page_id_fk='$_GET['id']' AND p_update_id< $last_id ORDER BY p_update_id DESC";

//$display = "SELECT * FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id JOIN post ON post.child_post_id = addfriend.child_id WHERE addfriend.parent_id = '$parent_id' AND post.id<'$last_id' AND addfriend.status > '0' ORDER BY post.id DESC LIMIT 3";

       $disprun=mysqli_query($conn,$display);
	
 
   $json = include('page-post-data.php');
   json_encode($json);
   
?>


