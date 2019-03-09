<?php
session_start();
require './dbcon.php';
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}
if(!(isset($_SESSION['pet_unique_id'])) && !(isset($_SESSION['business_unique_id'])) && !(isset($_SESSION['ngo_unique_id']))) {
header('Location:index.php');
}
?>
<html>
<?php require_once 'inc/head-content-ngoa.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
        <style>
            #filediv0, #filediv1, #filediv2, #filediv3 {
                width:80%;
                float:left;
            }
            .frn_req_acc, .frn_req_rej {
                float:left;
            }
            #add-more-img {
                display:none;
            }
            input[id="video_upload"] {
                display:none;
            }
            .vid-upl {
                -webkit-appearance: button;
                padding: 6px;
                background: #2c86bf;
                color: WHITE;
            }
            .post-video-upl {
                float:left;
            }
			.post-row .pro-post-content {
				height:64%;
			}
			.two-col-post-brdr .left .post-row .post-img {
				width:96%;
			}
			.post-row .post-img img {
				width:45%;
				float:left;
			}
			.post-image .photo {
				width:100%;
				
			}
			.videos {
				height:250px;
			}
			.one-col-post {
				width:50%;
			}
			
			#loading-post img {

	margin-left: 35%;
}
.loading-post {
                
                position:relative;
                left: 6%;
                display:none;
            }	
.box-left {
	float:left;
	width:50%;
}
.post-box-right {
	float:right;
	width:40%;
}	
.one-col-post-box {
	height: -webkit-fill-available;
}
.img-wrap div#media {
	//height:50%;
	width:100%;
	display:none;
}

.img-wrap div#media.selected {
	display:block;
}
li.box-image-pb {
	width:100%;
}
.img-wrap {
	position:relative;
	top:17%;
}
.img-wrap li img, .img-wrap li video {
	height:80%;
}
#box-prev {
	position:relative;
	bottom:150px;
	width:10%;
	float:left;
}
#box-next {
	position:relative;
	bottom:150px;
	width:10%;
	float:right;
	
}
.img-wrap #media video {
	height:340px;
}
ul {
   padding:2px;
    overflow:hidden;
	list-style:none;
}
li {
   float:left;
    //outline:1px solid gray;
    text-align:center;
    
}
li:first-child:nth-last-child(1) {
    width: 100%;
}
li:nth-last-child(2),
li:nth-last-child(2) ~ li {
    width: 50%;
}
/* three items */
li:nth-last-child(3),
li:nth-last-child(3) ~ li {
    width: 50%;
	
}

/* four items */
li:first-child:nth-last-child(4),
li:nth-last-child(4) ~ li {
    width: 50%;
}
li:first-child:nth-last-child(5),
li:nth-last-child(5) ~ li {
    width: 50%;
}
li:first-child:nth-last-child(6),
li:nth-last-child(6) ~ li {
    width: 50%;
}
li:first-child:nth-last-child(7),
li:nth-last-child(7) ~ li {
    width: 50%;
}
li:first-child:nth-last-child(8),
li:nth-last-child(8) ~ li {
    width: 50%;
}
li:first-child:nth-last-child(9),
li:nth-last-child(9) ~ li {
    width: 50%;
}
li:first-child:nth-last-child(10),
li:nth-last-child(10) ~ li {
    width: 50%;
}
.post-image img {
    height:200px;
	object-fit:cover;
}
.about-page .pb-image-box {
	margin:auto;
}

.pb-image-box img {
	padding-right:3px;
}
ul#post-media {
	padding:0;
}
        </style>


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page fav-page" id="about-load-ref">
<div class="main-content-inn col-three main-content-full">
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
<div class="col-first">
<div class="two-col-post two-col-post-brdr">
<div class="left-p">
<h3 class="tp-h">My Favorite</h3>
<div class="fav-li-ttl">
<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Groups</h4></div>
<div class="sec-h-btm"><strong>Joined</strong></div></div>
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
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
    <a href="groups.php?id=<?= $grpres['group_id'] ?>">
        <?php if($grpres['gr_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['gr_profile_pic'] ?>">
							<?php } ?></a>
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $grpres['group_name'] ?>" href="groups.php?id=<?= $grpres['group_id'] ?>"><?= $grpres['group_name'] ?></a></p>
<p class="dec"><?php echo substr($description, 0, 30) ?></p>
</div>
</div>                        
</div>
     <?php
                            }

                        ?>			


</div>

<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Pages</h4></div>
<div class="sec-h-btm"><strong>liked</strong></div></div>
<?php

$grpqry=mysqli_query($conn,"SELECT G.page_id_fk,G.user_id_fk, G.status, P.page_name,P.page_desc,P.pg_profile_pic,P.page_id
FROM  page_users G, pages P
WHERE G.page_id_fk = P.page_id
AND G.user_id_fk =  '$parent_id'
AND P.user_id_fk!='$parent_id'
AND G.status = '1'");
		    WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
                    $description = $grpres["page_desc"];
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="pages1.php?id=<?= $grpres['page_id'] ?>&name=<?= $grpres['page_name'] ?>">
        <?php if($grpres['pg_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['pg_profile_pic'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $grpres['page_name'] ?>" href="pages1.php?id=<?= $grpres['page_id'] ?>&name=<?= $grpres['page_name'] ?>"><?= $grpres['page_name'] ?></a></p>
<p class="dec"><?php echo substr($description, 0, 30) ?></p>
</div>
</div>                        
</div>
<?php
                            }
                        ?>			



</div>
    
<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Events</h4></div>
<div class="sec-h-btm"><strong>Joined</strong></div></div>
<?php

$grpqry=mysqli_query($conn,"SELECT G.event_id_fk,G.user_id_fk, G.status, P.event_name,P.event_by,P.event_date,P.event_desc,P.e_profile_pic,P.event_id
FROM  event_users G, events P
WHERE G.event_id_fk = P.event_id
AND G.user_id_fk =  '$parent_id'
AND P.user_id_fk!='$parent_id'
AND G.status = '1'");
		    WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
                    $description = $grpres["event_desc"];
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>">
        <?php if($grpres['e_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['e_profile_pic'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $grpres['event_name'] ?>" href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>"><?= $grpres['event_name'] ?></a></p>
<p class="dec"><?php echo substr($description, 0, 30) ?></p>
</div>
</div>                        
</div>
<?php
                            }
                        ?>			



</div>

<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">NGO</h4></div>
<div class="sec-h-btm"><strong>Following</strong></div></div>
<?php
$commentqry=mysqli_query($conn,"SELECT * FROM  `ngo_like` WHERE  `user_id` ='$parent_id'");
if(mysqli_num_rows($commentqry)>0) {
WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	
//$commentr=mysqli_query($conn,"SELECT * from user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");

$commentr=mysqli_query($conn,"SELECT * FROM `ngo_resgitration` WHERE `ngo_unique_id`='$commentresult[ngo_id]]'");
$cmntr=mysqli_fetch_assoc($commentr);
$description = $cmntr["ngo_desc"];
?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href='ngo-page-new-user.php?id=<?= $cmntr['ngo_unique_id'] ?>'><?php if($cmntr['profile_image']=='') { ?>
										
						<span class="user-icn-img"><img src="images/fr-pro-big-img.jpg" alt="user image"></span>
													<?php } else { ?>
										
<span class="user-icn-img"><img src="<?= $cmntr['profile_image'] ?>" alt="user image" /></span>
													<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $cmntr['ngo_name']?>" href='ngo-page-new-user.php?id=<?= $cmntr['ngo_unique_id'] ?>'><?= $cmntr['ngo_name']?></a></p>
<p class="dec"><?php echo substr($description, 0, 30) ?></p>
</div>
</div>                        
</div>
    <?php
}	
}
?>

</div>


<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Business</h4></div>
<div class="sec-h-btm"><strong>Following</strong></div></div>
<?php
$commentqry=mysqli_query($conn,"SELECT * FROM  `business_like` WHERE  `user_id` ='$parent_id'");
if(mysqli_num_rows($commentqry)>0) {
WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {	
//$commentr=mysqli_query($conn,"SELECT * from user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
$commentr=mysqli_query($conn,"SELECT * FROM `business` WHERE `business_uniqueid`='$commentresult[group_id]]'");
$cmntr=mysqli_fetch_assoc($commentr);
$description = $cmntr["description"];
?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href='business-page-new-user.php?id=<?= $cmntr['business_uniqueid'] ?>'><?php if($cmntr['profile_image']=='') { ?>
										
						<span class="user-icn-img"><img src="images/fr-pro-big-img.jpg" alt="user image"></span>
													<?php } else { ?>
										
<span class="user-icn-img"><img src="<?= $cmntr['profile_image'] ?>" alt="user image" /></span>
													<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $cmntr['company_name']?>" href='business-page-new-user.php?id=<?= $cmntr['business_uniqueid'] ?>'><?= $cmntr['company_name']?></a></p>
<p class="dec"><?php echo substr($description, 0, 30) ?></p>
</div>
</div>                        
</div>
    <?php
}	
}
?>

</div>

</div>

</div>

<div class="right-p">
<h3 class="tp-h">My Personal</h3>
<div class="fav-li-ttl">
<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Groups</h4></div>
<div class="sec-h-btm"><strong>Created</strong></div>
</div>
 <?php
$grpqry=mysqli_query($conn,"SELECT * FROM groups WHERE user_id_fk='$parent_id'");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
					$description = $grpres['group_desc'];					
						?>   
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="groups.php?id=<?= $grpres['group_id'] ?>">
        <?php if($grpres['gr_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['gr_profile_pic'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $grpres['group_name'] ?>" href="groups.php?id=<?= $grpres['group_id'] ?>"><?= $grpres['group_name'] ?></a></p>
<p class="dec"><?php echo substr($description, 0, 30) ?></p>
</div>
</div>                        
</div>
<?php
                            }

                        ?>	

</div>

<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Pages</h4></div>
<div class="sec-h-btm"><strong>Created</strong></div>
</div>
    <?php

$cpagesqry=mysqli_query($conn,"SELECT page_id,page_name,page_desc,pg_profile_pic FROM pages WHERE user_id_fk='$parent_id'");
					WHILE($cpages=mysqli_fetch_assoc($cpagesqry)) {                                            
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="pages1.php?id=<?= $cpages['page_id'] ?>&name=<?= $cpages['page_name'] ?>">
        <?php if($cpages['pg_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $cpages['pg_profile_pic'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $cpages['page_name'] ?>" href="pages1.php?id=<?= $cpages['page_id'] ?>&name=<?= $cpages['page_name'] ?>"><?= $cpages['page_name'] ?></a></p>
<p class="dec"><?php echo substr($cpages['page_desc'], 0, 30) ?></p>
</div>
</div>                        
</div>
     <?php
                            }
                   ?>		 	

</div>
    
<div class="fav-li-row">
<div class="fav-sec-h">
<div class="sec-h-d"><h4 class="sec-hd">Events</h4></div>
<div class="sec-h-btm"><strong>Created</strong></div>
</div>
    <?php

$cpagesqry=mysqli_query($conn,"SELECT * FROM `events` WHERE `user_id_fk`='$parent_id'");
					WHILE($cpages=mysqli_fetch_assoc($cpagesqry)) {                                            
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="event-test.php?id=<?= $cpages['event_id'] ?>&name=<?= $cpages['event_name'] ?>">
        <?php if($cpages['e_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $cpages['e_profile_pic'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $cpages['event_name'] ?>" href="event-test.php?id=<?= $cpages['event_id'] ?>&name=<?= $cpages['event_name'] ?>"><?= $cpages['event_name'] ?></a></p>
<p class="dec"><?php echo substr($cpages['event_desc'], 0, 30) ?></p>
</div>
</div>                        
</div>
     <?php
                            }
                   ?>		 	

</div>

<div class="fav-li-row">
<div class="sec-h-d"><h4 class="sec-hd">Sponsored Ads</h4></div>
<?php

$cpagesqry=mysqli_query($conn,"SELECT * FROM `ads` WHERE `user_id_fk`='$parent_id'");
					WHILE($cpages=mysqli_fetch_assoc($cpagesqry)) {
                                            
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="<?= $cpages['link'] ?>" target="_blank">
        <?php if($cpages['banner_image']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $cpages['banner_image'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a href="<?= $cpages['link'] ?>" title="<?= $cpages['heading'] ?>" target="_blank"><?= $cpages['heading'] ?></a></p>
<p class="dec"><a href="<?= $cpages['link'] ?>" target="_blank"><?php echo substr($cpages['description'], 0, 30) ?></a></p>
</div>
</div>                        
</div>
<?php
                            }
                   ?>
</div>

<div class="fav-li-row">
<div class="sec-h-d"><h4 class="sec-hd">ReHome</h4></div>
<?php

$cpagesqry=mysqli_query($conn,"SELECT * FROM `pet_rehome` WHERE `user_id_fk`='$parent_id'");
					WHILE($cpages=mysqli_fetch_assoc($cpagesqry)) {
                                            
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<a href="rehome-about.php?id=<?= $cpages['id'] ?>&name=<?= $cpages['pet_name'] ?>">
        <?php if($cpages['pet_photo']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $cpages['pet_photo'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $cpages['pet_name'] ?>" href="rehome-about.php?id=<?= $cpages['id'] ?>&name=<?= $cpages['pet_name'] ?>"><?= $cpages['pet_name'] ?></a></p>
<p class="dec"><?php echo substr($cpages['about_pet'], 0, 30) ?></p>
</div>
</div>                        
</div>
 <?php
                            }
                        ?>	 	

</div>


<div class="fav-li-row">
<div class="sec-h-d"><h4 class="sec-hd">Pet Mate</h4></div>
<?php

$cpagesqry=mysqli_query($conn,"SELECT * FROM `pet_meet` WHERE `pet_met_unique_id`='$parent_id'");
					WHILE($cpages=mysqli_fetch_assoc($cpagesqry)) {
                                            
						?>
<div class="g-p-li">
<div class="fav-listing">
<div class="fav-p-image">
<!--<a href="#">
<img class="photo" alt="" src="7705898/Pages/Pet Day/profile_pic/animal-dog-pet-brown.jpg">
</a>-->
<a href="mate-about.php?id=<?= $cpages['id'] ?>&name=<?= $cpages['pet_name'] ?>">
        <?php if($cpages['pet_photo']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $cpages['pet_photo'] ?>">
							<?php } ?></a>
</div>
<div class="fav-p-text">
<p class="ttl-lks"><a title="<?= $cpages['pet_name'] ?>" href="mate-about.php?id=<?= $cpages['id'] ?>&name=<?= $cpages['pet_name'] ?>"><?= $cpages['pet_name'] ?></a></p>
<p class="dec"><?php echo substr($cpages['about_pet'], 0, 30) ?></p>
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
    
<div class="col-second col-second-right">
<div class="col-third   animated fadeInRight">                                       		
<?php require_once 'inc/ads_sidebar_d.php'; ?>
</div>	                     
</div>
</div>



</div>
</div>
<!--share-->

	<link rel="stylesheet" href="css/modal.css">	
		
				
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
					 
					
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-pid="123" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <h3 class="modal-title" id="exampleModalLabel">Select Friends To Share This Post</h3>
        <button type="button" class="close" id="share-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="fr-li-cont">
	  <form method="post" id="share-form">
	  <?php
    $friendqry="SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
	
$friendrun=mysqli_query($conn,$friendqry);
WHILE($friendlist=mysqli_fetch_assoc($friendrun)) {
	
	
	
	
	

	?>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
									
          <a href="#"><span class="user-icn-img">
                  <?php if($friendlist['profile_pic']=="") {
							echo "<img src='images/pet-icon.png' alt='user image'>";
							}
							else {
							?>
							<img src="<?= $friendlist['profile_pic']  ?>" alt="user image" />
							<?php } ?>
                  <span class="fr-nm"><?= $friendlist['pet_name'] ?></span></span></a>
		  <input type="checkbox" style="display:none" class="check-share" name="<?= $friendlist['pet_name'] ?>" value="<?= $friendlist['pet_unique_id'] ?>"> 
                                    </div>
                                    <div class="user-nm" id="<?= $friendlist['pet_unique_id']?>"><a href="#" class="share-select-frn">SELECT</a></div>
                                </div>
							
<?php } ?>

								</div>
	  
        
      </div>
      <div class="modal-footer">
        
        <input type="submit" id="share-btn" value="Share">
		
      </div>
	  
</form>
    </div>
  </div>
</div>	

<script>
$(document).ajaxComplete(function() {
	var img=$('#imurl').text();
	var vid=$('#vidurl').text();
	
	if(img!='') {
	$('#box-image-disp div').find('img[src$="'+img+'"]').parent().addClass('selected');
	}
	if(vid!='') {
		//alert($('#box-image-disp div').find('video source[src$="'+vid+'"]').attr('src'));
		$('#box-image-disp div').find('video source[src$="'+vid+'"]').parent().parent().addClass('selected');
	}
	
	
});
</script>
			<script>
$(document).ready(function() {
//$('.img-wrap img:gt(0)').hide();

$(document).on('click','#box-next',function() {

    //$('.img-wrap div#media img.selected').hide().next().show().end().appendTo('.img-wrap');
	if($('.img-wrap div#media.selected').next().is('div#media')) {
	$('.img-wrap div#media.selected').removeClass('selected').next().addClass('selected');
	}

	
});


$(document).on('click','#box-prev',function() {
 if($('.img-wrap div#media.selected').prev().is('div#media')) {
	$('.img-wrap div#media.selected').removeClass('selected').prev().addClass('selected');
 }
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	
		 
	$("#profile-post-form").on('submit',(function(e)  {
		
           e.preventDefault();
		$.ajax({
        	url: "save-post-about.php", 
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,	
beforeSend: function()
                {
                    $('#uploading-post').show();
                },			
			success: function(data)
		    {
	             $('#uploading-post').hide();
				//$('#post-display').prepend(data);
				
				
				location.reload();
				$('#profile-post-form')[0].reset();
		$('#post-submit-btn').removeAttr('disabled');
		    },
		  	error: function() 
	    	{
				
	    	} 
	       
	   });
	   $(this).find(':submit').attr( 'disabled','disabled' );
	  // $(this).unbind("submit");
    //$(this).on('submit',function(){return false;});

	}));
	
	
});
</script>


			<script>
			
			//$(document).ready(function(){
			//$(".post-comment-btn").click(function(){
			//alert();
			//});
			//});
			</script>

			<script type="text/javascript">

$(document).on('click', '.post-like-button', function() {
 
	var post_id=$(this).attr("id");
	
		$.ajax({
        	url: "post-functions.php",
			type: "POST",
			data: { id: post_id },
    	                cache: false,			
			success: function(data)
		    {
	         
			var resp=data.split('|');
				$('#'+post_id+'.post-like-button').text(resp['0'])
			
				$('.number-likes'+post_id).html(resp['1']);
				$('.number-likes'+post_id).prev('#paw-likes').toggleClass('paw-like');
				
		        
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
});

</script>

			
			<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
			<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
	<script type="text/javascript">
    $(document).ready(function () {
      
        $(document).on('click','.post-share-btn', function() {
			 var pid=$(this).attr('id');
           $('#myModal').show().attr("data-pid",pid);
		 
		   //$('#myModal').data("pid",pid);
		   
        }),
		$('.share-select-frn').click(function() {
			 $(this).attr('id');
			$(this).parent().parent().toggleClass("marked");
			$(this).parent().parent().find('.check-share').trigger('click');
		}),
$('#share-modal-close').click(function() {

$('#myModal').hide();

});
		
    });
</script>				
		
<script type="text/javascript">
$(document).ready(function() {
$("#share-form").on('submit',(function(e)  {
		
           e.preventDefault();
		   var pid=$(this).closest('.modal').attr('data-pid');
		   var fd=new FormData(this);
		   fd.append('pid',pid);
		$.ajax({
        	url: "post-share-fun.php",
			type: "POST",
			data: fd,
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
	
				alert(data);
				$('#share-form')[0].reset();
				$('#myModal').hide();
		
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
	}));
});
</script>	

<style>
div.about-page .two-col-post .left.item{width: 100% !important;}
.masonry-0l {
    margin: 1em 0;
    padding: 0;
    -moz-column-gap: 1em;
    -webkit-column-gap: 1em;
    column-gap: 1em;
}

.item {
    display: inline-block;
    background: #fff;
    padding: 1em;
    margin: 0 0 1em;
    width: 100%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-shadow: 2px 2px 4px 0 #ccc;
}

@media only screen and (min-width: 400px) {
    .masonry-0l  {
        -moz-column-count: 2; 
        -webkit-column-count: 2;
        column-count: 2;
    }
}

@media only screen and (min-width: 700px) {
    .masonry-0l  {
        -moz-column-count: 2;
        -webkit-column-count: 2;
        column-count: 2;
    }
}

@media only screen and (min-width: 900px) {
    .masonry-0l  {
        -moz-column-count: 2;
        -webkit-column-count: 2;
        column-count: 2;
    }
}

@media only screen and (min-width: 1100px) {
    .masonry-0l  {
        -moz-column-count: 2;
        -webkit-column-count: 2;
        column-count: 2;
    }
}


</style>


<!--share end-->
<script type="text/javascript">

$(document).on('click', '.post-comment-btn', function() {
 
 $(this).parent().next().next().find('.post-comment-box').show();
 
 });
 </script>
 <script>
  
 $(document).ready(function() {
	
 $(document).on('click', '.comment-submit', function() {
	var post_id=$(this).parent().attr("id");
	var comment_data=$(this).parent().find('.comment-box').val();
	//alert(comment_data);
	
		$.ajax({
        	url: "post-functions.php",
			type: "POST",
			data: { 
			commentid: post_id , commenttext: comment_data
			},
    	    cache: false,			
			success: function(data)
		    {
	          $('#'+post_id+'.post-comment-box').hide();
			  //$('#'+post_id+'.post-comment-box').parent().append("<div class='user-comments'>"+data+"</div>");
		        $('#'+post_id+'.post-in-c').find('.comment-area').html(data); 
				 $('#'+post_id+'.one-col-post').find('.comment-area').html(data);
				 
		    },
			
		  	error: function() 
	    	{
				
	    	} 
	        
		});
		

 });
});

</script>
<?php require_once 'inc/footer.php';  ?>
</body>
</html>