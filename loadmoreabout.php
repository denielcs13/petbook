<?php 
session_start();
require 'dbcon.php';
$parent_id = $_SESSION['pet_unique_id'];
$lastid=$_POST['lastid'];
$propostqry=mysqli_query($conn,"SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.video,post.vid_count, post.wall_post_id,post.type,post.share_with,user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic FROM post JOIN user_inf on user_inf.pet_unique_id=post.child_post_id WHERE post.id < '$lastid' AND ((child_post_id='$parent_id' AND type!='shared') OR share_with='$parent_id') ORDER BY post.id DESC LIMIT 6");

								WHILE($propost=mysqli_fetch_assoc($propostqry)) {
									$imcount=$propost['img_count'] + $propost['vid_count'];
								?>
<div class="left item demo">
<div class="post-in-c" id="<?= $propost['id'] ?>">
<div class="post-content">
<h2><span class="user-icn-img">
<a href="#">
	<?php if($propost['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $propost['profile_pic'] ?>" alt="user image" />
							<?php } ?>

</a></span><p class="user-nm"><a href="about3.php?id=<?= $propost['pet_unique_id'] ?>"><?= $propost['pet_name'] ?></a></p></h2>
<?php if($propost['type']=='shared') {
	echo "<span class='share-heading'><b>Shared a post with you</b></span>";
} ?>
<?php if($propost['url']=='') { ?>

<h3><?= $propost['title'] ?></h3>
<p class="pst-text" id="post_desc"><?= $propost['posts'] ?></p>

<?php } else { ?>

<a href="http://<?= $propost['url'] ?>">
<h3><?= $propost['title'] ?></h3>
<p class="pst-text" id="post_desc"><?= $propost['posts'] ?></p>
</a>

<?php } ?>
</div>

<div class="post-image">
<ul id="post-media" data-count="<?= $imcount ?>">

<?php if($propost['img_count']>0) {
												$proimages=explode(",",$propost['image']);
                                                for($i=0;$i<count($proimages);$i++) {   
											?>
											<li class="pb-image-box">
<a href="aj_about.php?id=<?= $propost['id'] ?>&im=<?= $proimages[$i] ?> .ajcontent" data-featherlight="ajax">
<img src="<?= $proimages[$i] ?>"></a>
</li>
												<?php } }  ?>


											<?php if($propost['vid_count']>0) {
												$provid=explode(",",$propost['video']);
												for($i=0;$i<count($provid);$i++) { 
												
												?>   
												<li class="pb-image-box">
											<a href="aj_about.php?id=<?= $propost['id'] ?>&vid=<?= $provid[$i] ?> .ajcontent" data-featherlight="ajax"><video width="230" height="200" controls>
                                            <source src="<?= $provid[$i] ?>" type="video/mp4">
 
                                            </video></a>
											</li>
											<?php } } ?>
<!--postact-->								
</ul>			
		</div>									
<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$propost[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
         
		
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$propost[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												<span class="number-likes<?= $propost['id'] ?>"><?= $likenum ?></span> Likes</p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$propost[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $propost['id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $propost['id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $propost['id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $propost['id'] ?>">Share</button>
													
                                                </div>
												
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$propost[id]' LIMIT 6");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img">
														<?php if($cmntr['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $cmntr['profile_pic'] ?>" alt="user image" />
							<?php } ?>
														
													</span>
														<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a><span class="cmmnt-t"><?=$commentresult['comment'] ?></span></div></div>
													
													<?php
													}	
												}
								$commentcount=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$propost[id]'");
											if(mysqli_num_rows($commentcount)>6) {
											?>
											<div class="id-hidden" id="<?= $propost['id'] ?>"></div>
											<a href="#" id="comment-load">More</a>
											<?php
											}
												
												?>
												<div class="post-comment-box" id="<?= $propost['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												</div>  
											  
												</div>

											
											
											
											
<!--postactend-->											
											
</div>
</div>

								<?php } ?>