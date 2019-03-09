<?php
session_start();
require 'dbcon.php';

if ((isset($_SESSION['pet_unique_id']))) {   
   $uniqueid=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $uniqueid=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $uniqueid=$_SESSION['ngo_unique_id'];
}
        
if(isset($_POST['id'])) {
	
	
	$likechq="SELECT * FROM page_likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$likerun=mysqli_query($conn,$likechq);
	$count= mysqli_num_rows($likerun);

	
if($count>0) {
	
	$unlikeqry="DELETE FROM page_likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$unlikerun=mysqli_query($conn,$unlikeqry);
	echo "Like|";
}
else {
	
	$likeqry="INSERT INTO page_likes(post_id,liker_unique_id)VALUES('$_POST[id]','$uniqueid')"; 
	$likerun=mysqli_query($conn,$likeqry);
	echo "Unlike|";
}
$totallikes=mysqli_query($conn,"SELECT * FROM page_likes WHERE post_id='$_POST[id]'");
$finalcount=mysqli_num_rows($totallikes);
echo $finalcount;
	
}


if(isset($_POST['commentid'])) {
	
$cominsqry="INSERT INTO page_comments(post_id,commenter_unique_id,comment)VALUES('$_POST[commentid]','$uniqueid','$_POST[commenttext]')";
$commentinsert=mysqli_query($conn,$cominsqry);	



												
								$commentqry=mysqli_query($conn,"SELECT * FROM page_comments WHERE post_id='$_POST[commentid]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img">
                                   <?php if($cmntr['profile_pic']=="") {
							echo "<img src='images/pet-icon.png' alt='user image'>";
							}
							else {
							?>
							<img src="<?= $cmntr['profile_pic'] ?>" alt="user image" />
							<?php } ?></span>
								<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
															<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
														</div>
													
													<?php
													}	
												}
												
												?>
												<div class="post-comment-box" id="<?= $_POST['commentid'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												
												<?php
}	

	
	
?>
