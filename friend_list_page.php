<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>	

    <body>
        <?php require_once 'inc/header.php'; ?>
        <?php
        $parent_id = $_SESSION['pet_unique_id'];
        ?>
        <div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page">
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

                <?php
                $profileqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
                $profileinfo = mysqli_fetch_assoc($profileqry);
                ?>


                <div class="main-content" id="page-load-ref">

                    <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw">

                        

                           
                                <div class="fr-list" id="friends-list">
<?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$id = $_SESSION["pet_unique_id"];

//$display2="SELECT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id='$parent_id'";
//$display2="SELECT * FROM  `addfriend` JOIN user_inf ON user_inf.pet_unique_id = addfriend.child_id WHERE STATUS =2 AND parent_id ='$parent_id'";
//$display2 = "SELECT DISTINCT * FROM user_inf JOIN addfriend ON addfriend.child_id = user_inf.pet_unique_id WHERE ( addfriend.child_id !='$parent_id' OR addfriend.child_id //t_id')AND (addfriend.status =2) AND addfriend.parent_id ='$parent_id'";
$display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) {
    ?>
                                        
                                            <div class="">
                                                <div class="two-col-post">
												<h2 class="fr-heading">Friends</h2>
										<?php while ($row = mysqli_fetch_assoc($show_result)) {
											?>
                                        <div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
                                                
                                        <?php
                                        if (isset($row['profile_pic']) && !empty($row['profile_pic'])) {
                                            echo "<span class='user-icn-img fr-left'><img src='" . $row['profile_pic'] . "' alt='user image' class='photo'></span>
											<span class='fr-nm fr-right'><span class='fri-name ttl-lks'><a href='about3.php?id=" . $row['pet_unique_id'] . "' class='frn_profile'>" . $row['pet_name'] . "</a></span>
											
											<div class='usr-cnct-l'>
											<h3>Friend</h3>
											</div>
											
											</span>";
                                        } else {
                                            echo "<span class='user-icn-img fr-left'><img src='images/pet-icon.png' alt='user image' class='photo'>'</span><span class='fr-nm fr-right'><span class='fri-name ttl-lks'><a href='about3.php?id=" . $row['pet_unique_id'] . "class='frn_profile'>" . $row['pet_name'] . "</a></span>
											
											<div class='usr-cnct-l'>
											<h3>Friend</h3>
											</div>
											
											</span>";
                                        }
                                        ?>
                                                                              
                                            </div>                              
                                        </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                                </div>
                                            </div>
                                        
                                    </div>
                                   
                            
                        
                    </div>
                </div>
            </div>
        </div> 
                                <?php require_once 'inc/footer.php'; ?>
          
            </body>
            </html>
