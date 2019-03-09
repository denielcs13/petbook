<?php
session_start();
include 'dbcon.php';
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}
$page_id=$_GET['pid'];
?>

<div class="ajcontent">
		<div id="imurl" style="display:none;" ><?= $_GET['im'] ?></div>
		<div id="vidurl" style="display:none;" ><?= $_GET['vid'] ?></div>
		<?php
		$disp_post=mysqli_query($conn,"SELECT * FROM pg_updates WHERE p_update_id='$_GET[id]'");
		$postres=mysqli_fetch_assoc($disp_post);
		$imcount=$postres['img_count']+$postres['vid_count'];
		$usernqry=mysqli_query($conn,"SELECT pet_name,profile_pic FROM user_inf WHERE pet_unique_id='$postres[user_id_fk]' UNION SELECT company_name,profile_image FROM business WHERE business_uniqueid='$postres[user_id_fk]' UNION SELECT ngo_name,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$postres[user_id_fk]'");
		
		$username=mysqli_fetch_assoc($usernqry);
		$elcount=$postres['img_count']+$postres['vid_count'];
		?>
			<div class="one-col-post one-col-post-box" id="<?= $postres['p_update_id'] ?>">
                                    <div class="one-col-inn">
                                        <div class="post-in-c">
										 
<div class="post-image post-video box-left">
<div class="post-mul-image">
<div class="post-mul-image">

<ul id="post-media" data-count="<?= $imcount ?>">
<div class="img-wrap" id="box-image-disp">
<?php if($postres['img_count'] > 0) { 
$post_images=explode(",",$postres['image']); 

for($i=0;$i<count($post_images); $i++) { 
?>
	
<div id="media">

<img class="media-abox" src="<?= $post_images[$i] ?>">

</div>

<?php 

} } ?>

	<?php
if($postres['vid_count']>0) {
	$post_videos=explode(",",$postres['video']);
	for($i=0;$i<count($post_videos);$i++) {
?>

<div id="media">
<video controls>
<source src="<?= $post_videos[$i]?>" type="video/mp4">
</video>
</div>


<?php } } ?>

</div>
<?php if($elcount>1) { ?>
<a href="#" id="box-prev"><img src="images/Arrowhead-Left.png"></a>
<a href="#" id="box-next"><img src="images/Arrowhead-Right.png"></a>
<?php } ?>
</ul>
</div>

</div>
</div>


                                <div class="post-box-right">
											<?php
				$likecount=mysqli_query($conn,"SELECT * FROM page_likes WHERE post_id='$postres[p_update_id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
										 <h2><span class="user-icn-img">
										 <?php if($username['profile_pic']=='') { ?>
										 <img src="images/fr-pro-big-img.jpg" alt="user image" />
										 <?php } else { ?>
										  <img src="<?= $username['profile_pic'] ?>" alt="user image" />
										 <?php } ?>
										 
										 </span><p class="user-nm"><a href="#"><?= $username['pet_name'] ?></a></p></h2>
										 <?php if($postres['url']=='') { ?>
										
		                                <h3><?= $postres['title'] ?></h3>
		                                <p class="pst-text"><?= $postres['posts'] ?><p>
										
										 <?php } else { ?>
										 <a href="http://<?= $postres['url'] ?>" target="blank">
		                                <h3><?= $postres['title'] ?></h3>
		                                <p class="pst-text"><?= $postres['posts'] ?><p>
										</a>
										 
										 <?php } ?>
        
		
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM page_likes WHERE post_id='$postres[p_update_id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												<span class="number-likes<?= $postres['p_update_id'] ?>"><?= $likenum ?></span> Likes</p>
								
										<?php
echo '<iframe class="facebook-shr" src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fpetbooq.com%2Fshowpst.php?pid='.$postres['id'].'&layout=button&size=small&mobile_iframe=true&appId=1369234256522197&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
?>
<!--Pintrest sharing code end here-->
<a href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img src='http://www.brandaiddesignco.com/insights/PinIt.png' style='height:auto;width:auto'></a>
<!--Social sharing code end here-->	
                                            </div>
											
											<?php 
							$likechkqry=mysqli_query($conn,"SELECT * FROM page_users WHERE page_id_fk='$page_id' AND user_id_fk='$parent_id' AND status='1'");
											if(mysqli_num_rows($likechkqry)>0) { ?>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM page_likes WHERE post_id='$postres[p_update_id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $postres['p_update_id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $postres['p_update_id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $postres['p_update_id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $postres['p_update_id'] ?>">Share</button>
													
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM page_comments WHERE post_id='$postres[p_update_id]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
					<div class="user-comments"><span class="user-icn-img"><?php if($cmntr['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg' alt='user image'>";
							}
							else {
							?>
							<img src="<?= $cmntr['profile_pic'] ?>" alt="user image" />
							<?php } ?></span>
						<div class="cmnt-text">
						<a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
															<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div></div>
													
													<?php
													}	
												}
												
												?>
												<div class="post-comment-box" id="<?= $postres['p_update_id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea>
												<button class='comment-submit'>Submit</button>
												</div>
												
												</div> 
												</div>
											<?php } ?>
												
												
												
												</div>
												
                                        </div>
                                    </div>
									
									
									
                                </div> 
			
			
			
		</div>
		