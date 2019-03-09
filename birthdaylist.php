<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}
 $parent_id = $_SESSION['pet_unique_id'];
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>	

    <body>
        <?php require_once 'inc/header_11.php'; ?>
       
        <div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page friend-listing-page">
            <div class="main-content-inn col-three main-content-full">
                    
                <style>

                    /*================== fr =========================*/


                    .friend-list-page .left.friend-box {
                        width: 50%;
                        padding: 0 11px;
                        box-sizing: border-box;
                    }
                    .friend-list-page .left.friend-box .photo {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                    .friend-list-page .left.friend-box .fr-left {
                        width: 32%;
                        display: inline-block;
                        height: 100px;
                        float: left;
                    }
                    .friend-list-page .left.friend-box .fr-right {
                        display: inline-block;
                        vertical-align: top;
                        margin-left: 10px;
                    }
                    .friend-list-page .post-in-c {
                        box-shadow: none;
                        background: none;
                        border: 1px solid #ccc;
                        border-radius: 0;
                    }
                    .two-col-post {
                    }
                    .friend-list-page.usr-feed-page-nw .two-col-post .post-in-c {
                        width: 100%;
                        box-sizing: border-box;
                        padding: 0;
                        margin: 0;
                        display: inline-block;
                    }
                    .friend-list-page .left.friend-box .fr-right a {
                        color: #2c86bf;
                        letter-spacing: 0;
                        font-size: 12px;
                    }
                    .friend-list-page .left.friend-box .fr-right .ttl-lks {
                        margin-bottom: 0;
                    }
                    .friend-list-page.usr-feed-page-nw .two-col-post {
                        width: 100%;
                        display: inline-block;
                        margin: 0;
                        box-shadow: 2px 2px 10px 0 rgba(0,0,0,.1);
                        background: #fff;
                        padding: 0;
                        border-radius: 4px;
                        box-sizing: border-box;padding: 15px 0 0;
                    }
                    .friend-list-page .fr-heading {
                        margin: 0;
                        padding: 0 10px 10px;
                        border-bottom: 1px solid #eee;
                        box-sizing: border-box;
                        margin-bottom: 15px;
                        color: #5785e0;
                    }
                    .friend-list-page .fr-right .fr-btn{
                        background: url(../images/right-checkmark.png);
                        display: inline-block;
                        font-size: 13px;
                        border-radius: 2px;
                        border: 1px solid #6f6f6f;
                        padding: 2px 8px 2px 24px;
                        color: #fff;
                        margin-top: 10px;
                        background-color: #5785e0;
                        background-repeat: no-repeat;
                        background-position: 6px center;
                        background-size: 17%;
                    }
                    .friend-list-page .fr-right .fr-btn h3 {
                        font-size: 12px;
                        margin: 0;
                    }
                    /*================== fr =========================*/
                </style>

                


                <div class="main-content" id="page-load-ref">
                    <div class="col-first-side">
                            <?php require_once 'inc/user_profile_sidebar.php'; ?>   
                            <?php require_once 'inc/side-bar.php'; ?>
                            <?php require_once 'inc/rehome-a-pet-side-bar.php'; ?>
                        </div>
                    <div class="birth-list">

                        
                           <div class="main-content-inn-left">
<div class="col-first">


                                <div class="" id="friends-list">
                                
                                                <div class="two-col-post">
												<h2 class="fr-heading">Birthday List</h2>
										<div class="bday-list bday-list-active">
										<h2 class="fr-heading">Today's Birthdays</h2>
										<?php 
$display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.dob,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.dob,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
                            $frnd_list = mysqli_query($conn, $display2);
							
										WHILE($frnds=mysqli_fetch_assoc($frnd_list)) {
$bday=$frnds['dob'];
	if($bday!='') {
$bday = new DateTime($bday);

	
	$bdate =$bday->format("m/d");
	$cdate=date("m/d");
	if($bdate==$cdate) {
	$cur_date=new DateTime();
	$interval = $cur_date->diff($bday);


?>							
                                        <div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a href="about.php?id=<?= $frnds['pet_unique_id'] ?>"><?php if($frnds['profile_pic']=='') { ?>
												<img class="photo" alt="" src="./images/user_image02.jpg">
												<? } else { ?>
												<img class="photo" alt="" src="<?= $frnds['profile_pic'] ?>">
												<?php } ?></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="about.php?id=<?= $frnds['pet_unique_id'] ?>"><?= $frnds['pet_name'] ?></a></p>
												</div>
												<div class="b-tm">
												<span><b>(Today)</b><?= $frnds['dob'] ?></span>
												<div class="usr-cnct-l">
					 <h3>Turning <?= $interval->format('%y'); ?> years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
										<?php } } } ?>
										
                                        </div>
                                        <div class="bday-list">
										<h2 class="fr-heading">Upcoming Birthdays </h2>
										<?php 
$display3 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.dob,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.dob,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
                            $frn_list = mysqli_query($conn, $display3);
										WHILE($frnd=mysqli_fetch_assoc($frn_list)) {
$bday1=$frnd['dob'];
	if($bday1!='') {
$bday1 = new DateTime($bday1);

	$bdate1 =$bday1->format("m");
	$cdate1=date("m");
	if($bday1->format("m/d")!=date("m/d") && $bdate1==$cdate1 && $bday1->format("d")>date("d")) {
    $cur_date=new DateTime();
	$interval = $cur_date->diff($bday1);
	?>
                                        <div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a href="about.php?id=<?= $frnd['pet_unique_id'] ?>"><?php if($frnd['profile_pic']=='') { ?>
												<img class="photo" alt="" src="./images/user_image02.jpg">
												<?php } else { ?>
												<img class="photo" alt="" src="<?= $frnd['profile_pic'] ?>">
												<?php } ?></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="about.php?id=<?= $frnd['pet_unique_id'] ?>"><?= $frnd['pet_name'] ?></a></p>
												</div>
												<div class="b-tm">
												<span><?= $frnd['dob'] ?></span>
												<div class="usr-cnct-l">
												
												<h3>Turning <?= $interval->format('%y'); ?> years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
										<?php } } } ?>
                                        </div>
										
										
										
                                                    
                                                </div>
                                            
                                        
                                    </div></div>
                                   <?php require_once 'inc/ads_sidebar_d.php'; ?>
                            
                        
                    </div>
                </div>
            </div>
        </div> 
                                <?php require_once 'inc/footer.php'; ?>
          
            </body>
            </html>
