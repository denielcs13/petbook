<div class="col-second">
                        <div class="fr-list" id="friends-list">
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-li-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="friend-list.php">Friend List</a></p></h2>
                            <?php
                            session_start();
//print_r($_SESSION["pet_unique_id"]);die;
                            $parent_id = $_SESSION["pet_unique_id"];
                            require_once './dbcon.php';

//$display2="SELECT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id='$parent_id'";
//$display2="SELECT * FROM  `addfriend` JOIN user_inf ON user_inf.pet_unique_id = addfriend.child_id WHERE STATUS =2 AND parent_id ='$parent_id'";
//$display2 = "SELECT DISTINCT * FROM user_inf JOIN addfriend ON addfriend.child_id = user_inf.pet_unique_id WHERE ( addfriend.child_id !='$parent_id' OR addfriend.child_id //t_id')AND (addfriend.status =2) AND addfriend.parent_id ='$parent_id'";
                            $display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1' LIMIT 5";
                            $show_result = mysqli_query($conn, $display2);
                            if (mysqli_num_rows($show_result)) {
                                ?>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                    ?>
                                    <div class="fr-li-cont">
                                        <div class="fr-li-row">
                                            <div class="fr-t-l">
                                                <?php
                                                if (isset($row['profile_pic']) && !empty($row['profile_pic'])) {
echo "<span class='user-icn-img'><img src='" . $row['profile_pic'] . "' alt='user image'><span class='fr-nm'><a href='about3.php?id=" . $row['pet_unique_id'] . "' class='frn_profile'>" . $row['pet_name'] . "</a></span></span>";
                                                } else {
                                                    echo "<span class='user-icn-img'><img src='images/pet-icon.png' alt='user image'><span class='fr-nm'><a href='about3.php?id=" . $row['pet_unique_id'] . "' class='frn_profile'>" . $row['pet_name'] . "</a></span></span>";
                                                }
                                                ?>
                                            </div>                                   
                                        </div>                              
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="fr-list fr-req">
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-req-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend Request</a></p></h2>
                            <?php
//$fr_req="SELECT * FROM addfriend WHERE child_id='$parent_id' AND status='0'";
                            $fr_req = "SELECT pet_name,email,parent_id,addfriend.status,child_id FROM user_inf JOIN addfriend ON addfriend.parent_id = user_inf.pet_unique_id WHERE child_id='$parent_id' AND parent_id!='$parent_id' AND addfriend.status=1 LIMIT 5";
                            $frn_req = mysqli_query($conn, $fr_req);
//print_r($fr_req);die;
                            WHILE ($frnd_req = mysqli_fetch_assoc($frn_req)) {
                                //$frnd_inf=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$frnd_req[parent_id]'");
                                //$frnd_info=mysqli_fetch_assoc($frnd_inf);
                                ?>
                                <div class="fr-li-cont" id="friend-req-show">
                                    <div class="fr-li-row">
                                        <div class="fr-t-l">
                                            <a href="about3.php?id=<?= $frnd_req['parent_id'] ?>"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?= $frnd_req['pet_name'] ?></span></span></a>
                                        </div>
                                        <div class="user-nm"><a href="#" class="frn_req_acc" id="<?= $frnd_req['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?= $frnd_req['parent_id'] ?>">Reject</a></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

 


                        <script type="text/javascript">
                        var jQuery =$;
                        //jQuery.noConflict();
                            jQuery(document).ready(function () {
                                jQuery('.frn_req_acc').on('click', function (e) {
                                    e.preventDefault();
                                    var acc_id = jQuery(this).attr('id');

                                    jQuery.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {accept: acc_id},
                                        cache: false,
                                        success: function (data) {

                                            jQuery('#' + acc_id + '.frn_req_acc').parent().html("ACCEPTED");
                                            jQuery('#friend-req-show').load(document.URL + ' #friend-req-show');
                                            jQuery('#friends-list').load(document.URL + ' #friends-list');
                                        }
                                    });
                                }),
                                        jQuery('.frn_req_rej').on('click', function (e) {
                                    e.preventDefault();
                                    var rej_id = $(this).attr('id');
                                    jQuery.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {reject: rej_id},
                                        cache: false,
                                        success: function (data) {
                                            jQuery('#' + rej_id + '.frn_req_rej').parent().html("REJECTED");
                                            jQuery('#friend-req-show').load(document.URL + ' #friend-req-show');
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>