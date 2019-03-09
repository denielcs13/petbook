<?php


                       WHILE($postres=mysqli_fetch_assoc($disprun))  {
								
     $par_name=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$postres[user_id_fk]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$postres[user_id_fk]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$postres[user_id_fk]'");
								$pname_res=mysqli_fetch_assoc($par_name);
								$imcount=$postres['img_count'] + $postres['vid_count'];
								
								?>
								
								
                                <div class="one-col-post" id="<?= $postres['update_id'] ?>">
                                    <div class="one-col-inn">
                                        <div class="post-in-c">
										<div class="post-content">
										<h2><span class="user-icn-img"><?php if($pname_res['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $pname_res['profile_pic']  ?>" alt="user image" />
							<?php } ?></span><p class="user-nm"><a href="about3.php?id=<?= $pname_res['pet_unique_id'] ?>"><?= $pname_res['pet_name']  ?></a></p></h2>
							<?php if($postres['url']=='') { ?>
							
		                      <h3><?= $postres['title'] ?></h3>
		                      <p class="pst-text"><?= $postres['post_data'] ?></p>
												
							<?php } else { ?>
							
                               <a href="http://<?= $postres['url'] ?>" target="_blank">
		                      <h3><?= $postres['title'] ?></h3>
		                      <p class="pst-text"><?= $postres['post_data'] ?></p>
												</a>

							<?php } ?>							
												
										</div>
                 	
                                          
<div class="post-image post-video">
<div class="post-mul-image">
<div class="post-mul-image">

<ul id="post-media" data-count="<?= $imcount ?>">
<?php if($postres['img_count'] > 0) { 
$post_images=explode(",",$postres['image']); 

for($i=0;$i<count($post_images); $i++) { 
?>
	
<li class="pb-image-box">
<a href="aj_group.php?id=<?= $postres['update_id'] ?>&im=<?= urlencode($post_images[$i]) ?> .ajcontent" data-featherlight="ajax">
<img class="photo" src="<?= $post_images[$i] ?>">
</a>
</li>


<?php 

} } ?>


<?php
if($postres['vid_count']>0) {
	$post_videos=explode(",",$postres['video']);
	for($i=0;$i<count($post_videos);$i++) {
?>

<li class="pb-image-box">
<a href="aj_group.php?id=<?= $postres['update_id'] ?>&vid=<?= urlencode($post_videos[$i]) ?> .ajcontent" data-featherlight="ajax">
<video controls>
<source src="<?= $post_videos[$i] ?>" type="video/mp4">
</video>
</a>
</li>


<?php } } ?>
	

</ul>
</div>

</div>
</div>

<script>
$(document).ready(function() {
$('video').removeAttr('autoplay');
});
</script>                                 
											<?php
					$likecount=mysqli_query($conn,"SELECT * FROM group_likes WHERE post_id='$postres[update_id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
         
		
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM group_likes WHERE post_id='$postres[update_id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												<span class="number-likes<?= $postres['update_id'] ?>"><?= $likenum ?></span> Likes</p>
<!--Social sharing code start here-->
<!--Facebook-->
<?php
   $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
?>
<?php
echo '<iframe class="facebook-shr" src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fpetbooq.com%2Ffeed-page-copy.php&layout=button&size=small&mobile_iframe=true&appId=1369234256522197&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
?>
<!--Facebook sharing code end here-->
<!--Pintrest sharing code end here-->
<a href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img src='http://www.brandaiddesignco.com/insights/PinIt.png'/></a>
<!--Social sharing code end here-->
                                            </div>
											
											
											
											
											
											
											
											<?php 
							$mem_chk=mysqli_query($conn,"SELECT * FROM group_users WHERE group_id_fk='$group_id' AND user_id_fk='$parent_id' AND status='1'");			
										if(mysqli_num_rows($mem_chk)>0 || $postres['user_id_fk']==$parent_id) { ?>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
			$likeqry=mysqli_query($conn,"SELECT * FROM group_likes WHERE post_id='$postres[update_id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $postres['update_id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $postres['update_id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $postres['update_id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $postres['update_id'] ?>">Share</button>
													
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
		$commentqry=mysqli_query($conn,"SELECT * FROM group_comments WHERE post_id='$postres[update_id]' LIMIT 6");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img">
                                           <?php if($cmntr['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $cmntr['profile_pic'] ?>" alt="user image">
							<?php } ?>
                                                                                                                
                            </span>
						<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
									<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
														</div>
													
													<?php
													}	
												}
						$commentcount=mysqli_query($conn,"SELECT * FROM group_comments WHERE post_id='$postres[update_id]'");
											if(mysqli_num_rows($commentcount)>6) {
											?>
											
											<a href="#" id="comment-load">More</a>
											<?php
											}
												
												?>
												<div class="post-comment-box" id="<?= $postres['update_id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea>
												<button class='comment-submit'>Submit</button>
												</div>
												
												</div>                                     </div>
											<?php } ?>
                                        </div>
                                    </div>
									
									
									
                                </div> 
								
                                <?php
                           
                        }
						 //mysql_close($conn);
                        ?>
						
					
