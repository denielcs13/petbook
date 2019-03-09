<?php
$shareqry = mysqli_query($conn, "SELECT * FROM shares JOIN user_inf ON shares.sharer_id=user_inf.pet_unique_id WHERE shares.share_with_id = '$parent_id' ORDER BY time DESC ");
WHILE ($shareres = mysqli_fetch_assoc($shareqry)) {

    $sharedisp = mysqli_query($conn, "SELECT * FROM post WHERE id='$shareres[post_id]'");

//    $share_usr = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$shareres[sharer_id]'");
    $share_usr = mysqli_query($conn, "SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$shareres[sharer_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$shareres[sharer_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$shareres[sharer_id]'");
    $share_usrname = mysqli_fetch_assoc($share_usr);

    WHILE ($postres = mysqli_fetch_assoc($sharedisp)) {
        $imcount = $postres['img_count'] + $postres['vid_count'];
        ?>
        <div class="left item">

            <div class="post-in-c" id="<?= $postres['id'] ?>">
                <span class="sharer-post"><b><?= $shareres['pet_name'] ?> Shared A Post With You</b></span>
                <div>
                    <div class="post-image post-video">
                        <div class="post-mul-image">
                            <div class="post-mul-image">
                                <ul id="post-media" data-count="<?= $imcount ?>">
                                    <?php
                                    if ($postres['img_count'] > 0) {
                                        $post_images = explode(",", $postres['image']);
                                        for ($i = 0; $i < count($post_images); $i++) {
                                            ?>
                                            <li class="pb-image-box">
                 <a href="aj_box.php?id=<?= $postres['id'] ?>&im=<?= $post_images[$i] ?> .ajcontent" data-featherlight="ajax"><img alt="" src="<?= $post_images[$i] ?>"></a>
                                            </li>
                                        <?php
                                        }
                                    }


                                    if ($postres['vid_count'] > 0) {
                                        $post_videos = explode(",", $postres['video']);
                                        for ($i = 0; $i < count($post_videos); $i++) {
                                            ?>

                                            <li class="pb-image-box">
											<a href="aj_box.php?id=<?= $postres['id'] ?>&vid=<?= $post_videos[$i] ?> .ajcontent" data-featherlight="ajax">
                                                <video controls>
                                                    <source src="<?= $post_videos[$i] ?>" type="video/mp4">
                                                </video>
												</a>
                                            </li>


            <?php }
        } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php
                    $likecount = mysqli_query($conn, "SELECT * FROM likes WHERE post_id='$postres[id]'");
                    $likenum = mysqli_num_rows($likecount);
                    ?>
                    <div class="post-content">
                        <h2><span class="user-icn-img">
                                <?php
                                if ($share_usrname['profile_pic'] == "") {
                                    echo "<img src='images/fr-pro-big-img.jpg'>";
                                } else {
                                    ?>
                                    <img src="<?= $share_usrname['profile_pic'] ?>" alt="user image" />
        <?php } ?>                                              	

                            </span><p class="user-nm"><a href="about3.php?id=<?= $share_usrname['pet_unique_id'] ?>"><?= $share_usrname['pet_name'] ?></a></p></h2>
                        <p class="pst-text"><?= $postres['posts'] ?><p>

                        <p class="ttl-lks">

                            <?php $user_like = mysqli_query($conn, "SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'");
                            if (mysqli_num_rows($user_like) > 0) {
                                ?>
                                <i class="fa fa-paw paw-like" id="paw-likes"></i>
        <?php } else { ?>
                                <i class="fa fa-paw " id="paw-likes"></i>
        <?php } ?>


                            <span class="number-likes<?= $postres['id'] ?>"><?= $likenum ?></span> Likes</p>
                    </div>
                    <div class="post-act-btn">

                        <div class="post-act-ins">

                            <?php
                            $likeqry = mysqli_query($conn, "SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'");
                            $likecount = mysqli_num_rows($likeqry);

                            if ($likecount > 0) {
                                ?>
                                <button class="post-like-button liked" id="<?= $postres['id'] ?>">Unlike</button>
                            <?php
                            } else {
                                ?>
                                <button class="post-like-button" id="<?= $postres['id'] ?>">Like</button>
        <?php } ?>


                            <button class="post-comment-btn" id="<?= $postres['id'] ?>">Comment</button>

                            <button class="post-share-btn" id="<?= $postres['id'] ?>">Share</button>
                            
                        </div>
		
                        <div class="comment-head"><h3>Comments:</h3></div>

                        <div class="comment-area">
                            <?php
                            $commentqry = mysqli_query($conn, "SELECT * FROM comments WHERE post_id='$postres[id]'");

                            if (mysqli_num_rows($commentqry) > 0) {
                                WHILE ($commentresult = mysqli_fetch_assoc($commentqry)) {
//					$commentr=mysqli_query($conn,"SELECT  * from user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
                                    $commentr=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	                            $cmntr=mysqli_fetch_assoc($commentr);
                                    ?>

                                    <div class="user-comments">
                                        <span class="user-icn-img">
                                            <?php
                                            if ($cmntr['profile_pic'] == "") {
                                                echo "<img src='images/fr-pro-big-img.jpg'>";
                                            } else {
                                                ?>
                                                <img src="<?= $cmntr['profile_pic'] ?>" alt="user image" />
                <?php } ?>

                                        </span>
                                        <div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
                                            <span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
<div class="post-comment-box" id="<?= $postres['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea>
												<button class='comment-submit'>Submit</button>
												</div>

                        </div>  
                          
						</div>
                </div>
            </div>



        </div>


    <?php
    }
}
?>