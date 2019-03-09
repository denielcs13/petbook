<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>	

    <body>
        <?php require_once 'inc/header_11.php'; ?>
        <?php
        $parent_id = $_SESSION['pet_unique_id'];
        ?>
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
                        </div>
                    <div class="birth-list">

                        
                           <div class="main-content-inn-left">
<div class="col-first">

<div class="">
                                <div class="" id="friends-list">
                                        
                                            <div class="">
                                                <div class="two-col-post">
												<h2 class="fr-heading">Birthday List</h2>
										<div class="bday-list bday-list-active">
										<h2 class="fr-heading">Today's Birthday</h2>
                                        <div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a><img class="photo" alt="" src="./images/user_image02.jpg"></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="#">Rajesh Kumar</a></p>
												</div>
												<div class="b-tm">
												<div class="usr-cnct-l">
												<h3>Turning 12 years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
										<div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a><img class="photo" alt="" src="./images/user_image04.jpg"></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="#">Rajesh Kumar</a></p>
												</div>
												<div class="b-tm">
												<div class="usr-cnct-l">
												<h3>Turning 09 years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
                                        </div>
                                        <div class="bday-list">
										<h2 class="fr-heading">Upcoming Birthdays </h2>
                                        <div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a><img class="photo" alt="" src="./images/user_image02.jpg"></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="#">Rajesh Kumar</a></p>
												</div>
												<div class="b-tm">
												<div class="usr-cnct-l">
												<h3>Turning 12 years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
										<div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a><img class="photo" alt="" src="./images/user_image04.jpg"></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="#">Rajesh Kumar</a></p>
												</div>
												<div class="b-tm">
												<div class="usr-cnct-l">
												<h3>Turning 09 years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
                                        </div>
										
										<div class="bday-list">
										<h2 class="fr-heading">November </h2>
                                        <div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a><img class="photo" alt="" src="./images/user_image09.jpg"></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="#">Jhon Kumar</a></p>
												</div>
												<div class="b-tm">
												<div class="usr-cnct-l">
												<h3>04 years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
										<div class="fr-li-cont  left friend-box ">
                                            <div class="post-in-c">
											<div class="fr-li-cont left friend-box">
											<div class="post-in-c">
												<div class="fr-left">
												<div class="fri-image">
												<a><img class="photo" alt="" src="./images/user_image03.jpg"></a>
												</div>
												</div>
												<div class="fr-right">
												<div class="fri-name">
												<p class="ttl-lks"><a href="#">Roger Sharma</a></p>
												</div>
												<div class="b-tm">
												<div class="usr-cnct-l">
												<h3>13 years old</h3>
												</div>
												</div>
												</div>
												</div>
											</div>
                                                                              
                                            </div>                              
                                        </div>
                                        </div>
										
                                                    
                                                </div>
                                            </div>
                                        
                                    </div></div></div>
                                   <?php require_once 'inc/ads_sidebar_d.php'; ?>
                            
                        
                    </div>
                </div>
            </div>
        </div> 
                                <?php require_once 'inc/footer.php'; ?>
          
            </body>
            </html>
