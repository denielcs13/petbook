<?php 
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

require 'dbcon.php';
 
if (isset($_POST['puns'])) {
	
$shrdelqry=mysqli_query($conn,"DELETE FROM page_shares WHERE page_id='$_POST[puns]' AND sharer_id='$_POST[shr]' AND share_with='$parent_id'");
}
	?>