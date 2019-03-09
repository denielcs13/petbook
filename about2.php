<?php
require_once './dbcon.php';
$qry=mysqli_query($conn,"SELECT pet_name,profile_pic,pet_unique_id,'user_inf' as source FROM user_inf WHERE pet_unique_id='1925873' UNION SELECT company_name,profile_image,business_uniqueid,'business' as source FROM business WHERE business_uniqueid='1925873' UNION SELECT ngo_name,profile_image,ngo_unique_id,'ngo_resgitration' as source FROM ngo_resgitration WHERE ngo_unique_id='1925873'");
$res=mysqli_fetch_assoc($qry);
print_r($res);
?>