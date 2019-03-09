<?php
session_start();
require 'dbcon.php';
$parent_id=$_SESSION['pet_unique_id'];
$frid='6230533';

chkfrnd($frid);
function chkfrnd($fid) {
	$chkfrnqry=mysqli_query($conn,"SELECT * FROM addfriend WHERE (parent_id='$parent_id' AND child_id='$fid') OR (parent_id='$fid' AND child_id='$parent_id') AND status='1'");
	$res=mysqli_num_rows($chkfrnqry);
	echo "NA".$fid.$res;
	
}
 

?>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
	 window.open(
    'https://www.facebook.com/dialog/feed?app_id=1369234256522197&link=http://petbooq.com&description=This%20is%20the%20caption'); 
    return false;
});
</script>






