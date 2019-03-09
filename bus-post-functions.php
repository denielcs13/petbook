<?php
session_start();
require 'dbcon.php';
$uniqueid = $_SESSION['business_unique_id'];
        

if(isset($_POST['id'])) {
	
	
	$likechq="SELECT * FROM likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$likerun=mysqli_query($conn,$likechq);
	$count= mysqli_num_rows($likerun);
	
	

	
if($count>0) {
	
	$unlikeqry="DELETE FROM likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$unlikerun=mysqli_query($conn,$unlikeqry);
	
}
else {
	
	$likeqry="INSERT INTO likes(post_id,liker_unique_id)VALUES('$_POST[id]','$uniqueid')"; 
	$likerun=mysqli_query($conn,$likeqry);
	
}
$totallikes=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$_POST[id]'");
$finalcount=mysqli_num_rows($totallikes);
echo $finalcount;
	
}


if(isset($_POST['commentid'])) {
	
$cominsqry="INSERT INTO comments(post_id,commenter_unique_id,comment)VALUES('$_POST[commentid]','$uniqueid','$_POST[commenttext]')";
$commentinsert=mysqli_query($conn,$cominsqry);	
?>
<?php
$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$_POST[commentid]'");
if(mysqli_num_rows($commentqry)>0) {
WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
$commentr=mysqli_query($conn,"SELECT pet_name,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,bg_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]'");
$cmntr=mysqli_fetch_assoc($commentr);
?>
<div class="user-comments"><span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
<div class="cmnt-text"><a href='about3.php?id=<?= $commentresult['commenter_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
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
?>
