<?php 
session_start();
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}

?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />	

    <body>
        <?php require_once 'inc/header_11.php'; ?>
        
       
        <div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page usr-feed-page grp-mem-page">
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
				
                <?php 
				if ((isset($_SESSION['pet_unique_id']))) {   
				require_once 'inc/user_profile_sidebar.php';
				require_once 'inc/side-bar.php';
				require_once 'inc/rehome-a-pet-side-bar.php';
				
				}
                if ((isset($_SESSION['business_unique_id']))) {   
				require_once 'inc/business_profile_sidebar.php';
				require_once 'inc/side-bar.php';
				require_once 'inc/rehome-a-pet-side-bar.php';
				}
                if ((isset($_SESSION['ngo_unique_id']))) {   
				require_once 'inc/ngo_profile_sidebar.php';
				}


				?>   
				
                
                </div>
					<div class="main-content-inn-left">
                    <div class="col-first crt-pgs">
								<div class="tp-ntf-list fr-list">
								<div class="grp-top-opt">
												<h2 class="fr-heading">Pending Invites</h2>
												
												</div>
                                                                    
                                                                    <?php                                                    
	

$grpqry=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id, U.profile_pic, G.group_id_fk, G.status, P.group_name,P.group_desc
FROM user_inf U, group_users G, groups P
WHERE U.status =  '1'
AND U.pet_unique_id = G.user_id_fk
AND G.group_id_fk = P.group_id
AND G.user_id_fk =  '$parent_id'
AND G.status =  '0'");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
					$description = $grpres['group_desc'];
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
										<p class="ttl-lks"><a href="about3.php?id=<?= $grpres['pet_unique_id'] ?>"><?= $grpres['group_name'] ?></a></p>
										<p class="dec"><?php echo substr($description, 0, 50) ?></p>
										</div>
										<div class="cls-btn">
               <a href="#" class="frn_req_acc event-edit-button" id="<?= $grpres['group_id_fk'] ?>">Join</a>
               <a href="#" class="frn_req_rej event-edit-button" id="<?= $grpres['group_id_fk'] ?>">Decline</a>
										</div>
										</div>
                                        </div>                              
                                        </div>
                                                                    
  <?php
                            }
                        ?>	
								</div>
								
								<div class="fr-list" id="user-groups">
								
								<div class="two-col-post">
                                                <div class="grp-top-opt">
												<h2 class="fr-heading">Your Groups</h2>
                                                 
                                                 <a class="crt-grp" href="create-groups.php"><i class="fa fa-plus"></i>Create Group</a>
												</div>
                                                    <?php


$grpqry=mysqli_query($conn,"SELECT * FROM groups WHERE user_id_fk='$parent_id'");


					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
					$description = $grpres['group_desc'];
					
						?>
                                        <div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										<a href="groups.php?id=<?= $grpres['group_id'] ?>">
        <?php if($grpres['gr_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['gr_profile_pic'] ?>">
							<?php } ?>
										</div>
										</div>
										<div class="fr-right">
										<div class="fri-name">
										<p class="ttl-lks"><a href="groups.php?id=<?= $grpres['group_id'] ?>"><?= $grpres['group_name'] ?></a></p>
										<p class="dec"><?php echo substr($description, 0, 50) ?></p>
										</div>
<!--										<div class="cls-btn">
										<button class="cls">X</button>
										</div>-->
										</div>
                                        </div>                              
                                        </div>
                                                    <?php
                            }

                        ?>			
					    </div>
						</div>
						<br>
                                <div class="fr-list" id="friends-list">


                                           
                                                <div class="two-col-post">
                                                <div class="grp-top-opt">
												<h2 class="fr-heading">Joined Groups</h2>
                    
												</div> 
                                                    <?php

$grpqry=mysqli_query($conn,"SELECT G.group_id_fk, G.status,G.user_id_fk, P.group_name,P.group_desc,P.gr_profile_pic,P.group_id,P.user_id_fk
FROM group_users G, groups P
WHERE  G.group_id_fk = P.group_id
AND G.user_id_fk =  '$parent_id'
AND G.status =  '1'
AND G.user_id_fk!=P.user_id_fk
");


					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
					$description = $grpres['group_desc'];
						?>
                                        <div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										<a href="groups.php?id=<?= $grpres['group_id'] ?>">
        <?php if($grpres['gr_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['gr_profile_pic'] ?>">
							<?php } ?>
										</div>
										</div>
										<div class="fr-right">
										<div class="fri-name">
										<p class="ttl-lks"><a href="groups1.php?id=<?= $grpres['group_id'] ?>"><?= $grpres['group_name'] ?></a></p>
										<p class="dec"><?php echo substr($description, 0, 50) ?></p>
										</div>
<!--										<div class="cls-btn">
										<button class="cls">X</button>
										</div>-->
										</div>
                                        </div>                              
                                        </div>
                                                    <?php
                            }

                        ?>			
					    </div>
                                            
                                        
                                    </div>
                                   
                            
                        
                    </div>
					<div class="col-third   animated fadeInRight">
					<?php require_once 'inc/ads_sidebar_d.php'; ?>
                    </div>
                </div>
            </div>
        </div> 
                                <?php require_once 'inc/footer.php'; ?>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
			        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
          <script type="text/javascript">
				
					$(document).on('click','.frn_req_acc',function(e) {
						e.preventDefault();
						var acc_id=$(this).attr('id');
						
						$.ajax({
        	        url: "group_join_fun.php",
			type: "POST",
			data: { accept: acc_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("JOIND");
			  
		      //$('#friend-req-show').load(document.URL +  ' #friend-req-show');
			  $('#page-load-ref').load(document.URL +  ' #page-load-ref');
		    }        
		});
						
					}),
					
					$(document).on('click','.frn_req_rej',function(e) {
						e.preventDefault();
						var rej_id=$(this).attr('id');
						
						$.ajax({
        	        url: "group_join_fun.php",
			type: "POST",
			data: { reject: rej_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+rej_id+'.frn_req_rej').parent().html("DECLINED");
			  //$('#friend-req-show').load(document.URL +  ' #friend-req-show');
		      $('#page-load-ref').load(document.URL +  ' #page-load-ref');  
		    }        
		});
						
					});
					
					
				
				</script>
            </body>
            </html>
