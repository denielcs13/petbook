<?php
session_start();
include 'dbcon.php';
$parent_id = $_SESSION['pet_unique_id'];  
?>

<div class="ajcontent">
		<div id="imurl" style="display:none;" ><?= $_GET['im'] ?></div>
		<div id="vidurl" style="display:none;" ><?= $_GET['vid'] ?></div>
		<?php
		$disp_post=mysqli_query($conn,"SELECT * FROM post WHERE id='$_GET[id]'");
		$postres=mysqli_fetch_assoc($disp_post);
		$imcount=$postres['img_count']+$postres['vid_count'];
		$usernqry=mysqli_query($conn,"SELECT pet_name,profile_pic FROM user_inf WHERE pet_unique_id='$postres[child_post_id]' UNION SELECT company_name,bg_image FROM business WHERE business_uniqueid='$postres[child_post_id]' UNION SELECT ngo_name,bg_image FROM ngo_resgitration WHERE ngo_unique_id='$postres[child_post_id]'");
		$username=mysqli_fetch_assoc($usernqry);
		$elcount=$postres['img_count']+$postres['vid_count'];
		?>
			<div class="one-col-post one-col-post-box" id="<?= $postres['id'] ?>">
                                    <div class="one-col-inn">
                                        <div class="post-in-c">
										     	
                                    
<div class="post-image post-video box-left">
<div class="post-mul-image">
<div class="post-mul-image">

<ul id="post-media" data-count="<?= $imcount ?>">
<div class="img-wrap" id="box-image-disp">
<?php
if(isset($_GET['im'])) {
?>
<div id="media">

<img class="media-abox" src="<?= $_GET['im'] ?>">

</div>
<?php } else if(isset($_GET['vid'])) { ?>
<div id="media">
<video controls>
<source src="<?= $_GET['vid'] ?>" type="video/mp4">
</video>
</div>
<?php } ?>
</div>

</ul>
</div>

</div>
</div>


                                <div class="post-box-right">
											<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
										 <h2><span class="user-icn-img">
										 <?php if($username['profile_pic']=='') { ?>
										 <img src="images/pet-icon.png" alt="user image" />
										 <?php } else { ?>
										  <img src="<?= $username['profile_pic'] ?>" alt="user image" />
										 <?php } ?>
										 
										 </span><p class="user-nm"><a href="#"><?= $username['pet_name'] ?></a></p></h2>
		 <h3><?= $postres['title'] ?></h3>
		 <span class="post-link"><a href="<?= $postres['url'] ?>" target="blank"><?= $postres['url'] ?></a></span>
                                                <p class="pst-text"><?= $postres['posts'] ?><p>
										
										
        
		
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												<span class="number-likes<?= $postres['id'] ?>"><?= $likenum ?></span> Likes</p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $postres['id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $postres['id'] ?>">Like</button>
												<?php } ?>
									
                                                    <button class="post-comment-btn" id="<?= $postres['id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $postres['id'] ?>">Share</button>
													
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postres[id]' LIMIT 6");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,bg_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,bg_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
					<div class="user-comments"><span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
														<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
															<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div></div>
													
													<?php
													}	
												}
						$commentcount=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postres[id]'");
											if(mysqli_num_rows($commentcount)>6) {
											?>
											
											<a href="#" id="comment-load">More</a>
											<?php
											}
												
												?>
												<div class="post-comment-box" id="<?= $postres['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												</div>                                     </div>
												
												
												
												</div>
												
                                        </div>
                                    </div>
									
									
									
                                </div> 
			
			
			
		</div>