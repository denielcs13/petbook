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
date_default_timezone_set("Asia/Calcutta");
$cur_datetime=date('Y-m-d H:i:s');
?>
<?php
$uniqueid = $parent_id;
//$uniqueid = $_SESSION['pet_unique_id'];
        

if(isset($_POST['id'])) {
	$likechq="SELECT * FROM likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$likerun=mysqli_query($conn,$likechq);
	$count= mysqli_num_rows($likerun);	

	
if($count>0) {
	
	$unlikeqry="DELETE FROM likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$unlikerun=mysqli_query($conn,$unlikeqry);
	echo "Like|";
}
else {
	
	$likeqry="INSERT INTO likes(post_id,liker_unique_id,time)VALUES('$_POST[id]','$uniqueid','$cur_datetime')"; 
	$likerun=mysqli_query($conn,$likeqry);
	echo "Unlike|";
}
$totallikes=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$_POST[id]'");
$finalcount=mysqli_num_rows($totallikes);
echo $finalcount;
	
}


if(isset($_POST['commentid'])) {
	
$cominsqry="INSERT INTO comments(post_id,commenter_unique_id,comment,time)VALUES('$_POST[commentid]','$uniqueid','$_POST[commenttext]','$cur_datetime')";
$commentinsert=mysqli_query($conn,$cominsqry);	
?>
<?php
$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$_POST[commentid]'");
if(mysqli_num_rows($commentqry)>0) {
WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	
//$commentr=mysqli_query($conn,"SELECT * from user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");

$commentr=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");

$cmntr=mysqli_fetch_assoc($commentr);
?>
 
<div class="user-comments">
<?php if($cmntr['profile_pic']=='') { ?>
										
						<span class="user-icn-img"><img src="images/fr-pro-big-img.jpg" alt="user image"></span>
													<?php } else { ?>
										
<span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
													<?php } ?>
<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
</div>
<?php
}	
}
?>
<div class="post-comment-box" id="<?= $_POST[commentid] ?>" style="display:none;">
<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
</div>
<?php
}	
if(isset($_POST['unfriend'])) {
$unfriend=mysqli_query($conn,"DELETE FROM addfriend WHERE (parent_id='$_POST[unfriend]' AND child_id='$uniqueid') OR (parent_id='$uniqueid' AND child_id='$_POST[unfriend]') AND status='1'");
echo "unf";
} 
?>
