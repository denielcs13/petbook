<?php 
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {   
    header('Location:index.php');
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />	

    <body>
        <?php require_once 'inc/header_11.php'; ?>
        
       
        <div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page grp-mem-page">
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

                    <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw">
								<div class="tp-ntf-list fr-list">
								<div class="grp-top-opt">
												<h2 class="fr-heading">Pending Invites</h2>
												
												</div>
                                                                    
                                                                    <?php                                                    
	

session_start();
$pg_id=$_GET['id'];
$parent_id = $_SESSION["pet_unique_id"];
$grpqry=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id, U.profile_pic, G.page_id_fk,G.user_id_fk, G.status, P.page_name
FROM user_inf U, page_users G, pages P
WHERE U.status =  '1'
AND U.pet_unique_id = G.user_id_fk
AND G.page_id_fk = P.page_id
AND G.user_id_fk =  '$parent_id'
AND G.status =  '0'");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
						?>
								<div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										 <?php if($grpres['profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['profile_pic'] ?>">
							<?php } ?>
										</div>
										</div>
										<div class="fr-right">
										<div class="fri-name">
										<p class="ttl-lks"><a href="about3.php?id=<?= $grpres['pet_unique_id'] ?>"><?= $grpres['page_name'] ?></a></p>
										<p class="dec">The #dog is the most faithful of...</p>
										</div>
										<div class="cls-btn">
                                                                                    <button class="cls"><a href="#" class="frn_req_acc" id="<?= $grpres['page_id_fk'] ?>">Join</a></button>
                                                                                <button class="cls cln"><a href="#" class="frn_req_rej" id="<?=$grpres['page_id_fk'] ?>">Decline</a></button>
										</div>
										</div>
                                        </div>                              
                                        </div>
                                                                    
  <?php
                            }
                        ?>	
								</div>
								
                                <div class="fr-list" id="friends-list">


                                            <div class="">
                                                <div class="two-col-post">
                                                <div class="grp-top-opt">
												<h2 class="fr-heading">Your Pages</h2>
                                                                                                <button class="crt-grp"><i class="fa fa-plus"></i><a href="create-page.php">Create Page</a></button>
												</div>
                                                    <?php
session_start();
$parent_id = $_SESSION["pet_unique_id"];
//$pg_id=$_GET['id'];
$grpqry=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id, U.profile_pic, G.page_id_fk,G.user_id_fk, G.status, P.page_name,P.page_desc,P.pg_profile_pic,P.page_id
FROM user_inf U, page_users G, pages P
WHERE U.status =  '1'
AND U.pet_unique_id = G.user_id_fk
AND G.page_id_fk = P.page_id
AND G.user_id_fk =  '$parent_id '
AND G.status =  '1'");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
						?>
                                        <div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										<a href="groups.php?id=<?= $grpres['group_id'] ?>">
        <?php if($grpres['pg_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['pg_profile_pic'] ?>">
							<?php } ?>
										</div>
										</div>
										<div class="fr-right">
										<div class="fri-name">
										<p class="ttl-lks"><a href="pages1.php?id=<?= $grpres['page_id'] ?>&name=<?= $grpres['page_name'] ?>"><?= $grpres['page_name'] ?></a></p>
										<p class="dec"><?= $grpres['page_desc'] ?></p>
										</div>
										<div class="cls-btn">
										<button class="cls">X</button>
										</div>
										</div>
                                        </div>                              
                                        </div>
                                                    <?php
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
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
			<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
          <script type="text/javascript">
				$(document).ready(function() {
					$('.frn_req_acc').on('click',function(e) {
						e.preventDefault();
						var acc_id=$(this).attr('id');
						
						$.ajax({
        	        url: "page_join_fun.php",
			type: "POST",
			data: { accept: acc_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("JOIND");
			  
		      $('#friend-req-show').load(document.URL +  ' #friend-req-show');
			  $('#friends-list').load(document.URL +  ' #friends-list');
		    }        
		});
						
					}),
					
					$('.frn_req_rej').on('click',function(e) {
						e.preventDefault();
						var rej_id=$(this).attr('id');
						
						$.ajax({
        	        url: "page_join_fun.php",
			type: "POST",
			data: { reject: rej_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+rej_id+'.frn_req_rej').parent().html("DECLINED");
			  $('#friend-req-show').load(document.URL +  ' #friend-req-show');
		        
		    }        
		});
						
					});
					
					
				});
				</script>
            </body>
            </html>
