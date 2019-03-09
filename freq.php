<div class="fr-list fr-req">
                            

<h2 class="fr-headnig">
	<div class="fr-headnig-l">
	<span class="user-icn-img">
	<a href="javascript:">
	<!-- <div class="plus-i"><img src="images/pet-mate-icon.png" alt=""></div> -->
	<p class="user-nm">Friend Request</p>
	</a>
	</span>
	</div>
	</h2>

                            <?php
//$fr_req="SELECT * FROM addfriend WHERE child_id='$parent_id' AND status='0'";
                            $fr_req = "SELECT pet_name,email,profile_pic,parent_id,addfriend.status,child_id FROM user_inf JOIN addfriend ON addfriend.parent_id = user_inf.pet_unique_id WHERE child_id='$parent_id' AND parent_id!='$parent_id' AND addfriend.status=1 LIMIT 5";
                            $frn_req = mysqli_query($conn, $fr_req);
//print_r($fr_req);die;
                            WHILE ($frnd_req = mysqli_fetch_assoc($frn_req)) {
                                //$frnd_inf=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$frnd_req[parent_id]'");
                                //$frnd_info=mysqli_fetch_assoc($frnd_inf);
                                ?>
                                <div class="fr-li-cont" id="friend-req-show">
                                    <div class="fr-li-row">
                                        <div class="fr-t-l">
                                            <a href="about-fr.php?id=<?= $frnd_req['parent_id'] ?>"><span class="user-icn-img"><?php
    if ($frnd_req['profile_pic'] == "") {
        echo "<img src='images/fr-pro-big-img.jpg'>";
    } else {
        ?>
                                <img src="<?= $frnd_req['profile_pic'] ?>" alt="user image" />
                            <?php } ?><span class="fr-nm"><?= $frnd_req['pet_name'] ?></span></span></a>
                                        </div>
                                        <div class="user-nm"><a href="#" class="frn_req_acc" id="<?= $frnd_req['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?= $frnd_req['parent_id'] ?>">Reject</a></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>