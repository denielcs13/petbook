<?php


                       WHILE($postres=mysqli_fetch_assoc($disprun))  {
								
                                $par_name=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$postres[user_id_fk]'");
								$pname_res=mysqli_fetch_assoc($par_name);
								$imcount=$postres['img_count'] + $postres['vid_count'];
								
								?>								

<div class="one-col-post rec-post-c" id="<?= $postres['e_update_id'] ?>">
    <div class="rel-eve-hdg"><h2>Recent Posts</h2></div>
<div class="sug-mem-row">
<div class="user-icn-img">
    <?php if($userinf['e_profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $userinf['e_profile_pic']  ?>" alt="user image" />
							<?php } ?>
</div>
<div class="fr-nm fr-nm-dec">
<a href="about3.php?id=<?= $pname_res['pet_unique_id'] ?>"><?= $pname_res['pet_name']  ?></a> - </span>
<p class="rec-dec"><?= $postres['event_data'] ?><p>
</div>
</div>
<div class="s-al-p"><a href="#">See all posts</a></div>
</div>

<?php
                           
                        }
						 //mysql_close($conn);
                        ?>