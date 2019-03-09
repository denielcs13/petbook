<?php
session_start();
require 'dbcon.php';
$uniqueid = $_SESSION['pet_unique_id'];
        

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



												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$_POST[commentid]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT * from user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
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

if(isset($_POST['postid']) && isset($_POST['mediaid'])) {
	
	$likechq="SELECT * FROM post_media_likes WHERE post_id='$_POST[postid]' AND media_id='$_POST[mediaid]' AND liker_unique_id='$uniqueid'";
	$likerun=mysqli_query($conn,$likechq);
	$count= mysqli_num_rows($likerun);
	
	

	
if($count>0) {
	
	$unlikeqry="DELETE FROM post_media_likes WHERE post_id='$_POST[postid]' AND media_id='$_POST[mediaid]' AND liker_unique_id='$uniqueid'";
	$unlikerun=mysqli_query($conn,$unlikeqry);
	
}
else {
	
	$likeqry="INSERT INTO post_media_likes(post_id,media_id,liker_unique_id)VALUES('$_POST[postid]','$_POST[mediaid]','$uniqueid')"; 
	$likerun=mysqli_query($conn,$likeqry);
	
}
$totallikes=mysqli_query($conn,"SELECT * FROM post_media_likes WHERE post_id='$_POST[postid]' AND media_id='$_POST[mediaid]'");
$finalcount=mysqli_num_rows($totallikes);
echo $finalcount;
	
}


if(isset($_POST['postmediaid']) && isset($_POST['mediacommentid'])) { 

$cominsqry="INSERT INTO post_media_comments(post_id,media_id,commenter_unique_id,comment)VALUES('$_POST[postmediaid]','$_POST[mediacommentid]','$uniqueid','$_POST[mediacommenttext]')";
$commentinsert=mysqli_query($conn,$cominsqry);	


												
								$commentqry=mysqli_query($conn,"SELECT * FROM post_media_comments WHERE post_id='$_POST[postmediaid]' AND media_id='$_POST[mediacommentid]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT * from user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
														<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
															<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
														</div>
													
													<?php
													}	
												}
												?>
												<div class="post-media-comment-box" id="<?= $_POST['mediacommentid'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='media-comment-submit'>Submit</button>
												</div>
												
												<?php
												
												

}
	
	
?>
