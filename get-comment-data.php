<?php
session_start();
require 'dbcon.php';
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$_POST[pid]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name,profile_pic,pet_unique_id FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,profile_image,business_uniqueid FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,profile_image,ngo_unique_id FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img">
													<?php if($cmntr['profile_pic']=='') { ?>
										
						<img src="images/fr-pro-big-img.jpg" alt="user image">
													<?php } else { ?>
										
										
							<span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
							
													<?php } ?>
													</span>
														<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
															<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
														</div>
													
													<?php
													}	
												}
					
											?>
											<div class="post-comment-box" id="<?= $_POST[pid] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>