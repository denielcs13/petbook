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
?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
    <?php
        //$parent_id = $_SESSION['pet_unique_id'];
        $event_id=$_GET[id];
        $e_name=$_GET[name];
        //print_r($_SESSION);die;
        require 'dbcon.php';
        $userqry = mysqli_query($conn, "SELECT * FROM events WHERE event_id='$events_id' AND user_id_fk='$parent_id'");
        $userinf = mysqli_fetch_assoc($userqry);
        $display = "SELECT * FROM event_updates WHERE event_id_fk ='$event_id' ORDER BY e_update_id DESC ";
        $disprun = mysqli_query($conn,$display);    
        ?>
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
			#loading-post {
	display:none;
	background:#fff;
}
			#loading-post img {

	margin-left: 35%;
}
.loading-post {
	position: absolute;
    text-align: center;
    left: 46%;
    top: 2.5%;
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


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page usr-feed-page rel-event-page groups-page create-mem-pages event-page event-join-page" id="about-load-ref">
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
                               <?php
    session_start();
    $alrt='';
    $user_id=$parent_id;
    $id = $parent_id;
    //$user_id=$_SESSION['pet_unique_id'];
    //$id = $_SESSION["pet_unique_id"];
    if (isset($_POST["file"])) {
//    $pg_name=$_GET[name];
//    $page_id=$_GET[id];
        //$name=$profileinfo['group_name'];
        $image_name =$_FILES['file']['name'];
	$image_type=$_FILES['file']['type'];
	$image_size=$_FILES['file']['size'];
	$image_tmpname=$_FILES['file']['tmp_name'];
        $target_path = $id ."/Events/".$e_name."/profile_pic/" . basename($_FILES['file']['name']);
        $brk_path = $id . "/Events/".$e_name."/profile_pic/";
        if($image_type=='application/msword' or $image_type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type=='application/pdf' or 
        $image_type=='image/png' or $image_type=='image/jpeg' or $image_type=='image/jpg' or $image_type=='application/msword'){
		move_uploaded_file($image_tmpname,$target_path);
                $target_path = $id ."/Events/".$e_name."/profile_pic/" . basename($_FILES['file']['name']);
		}
                //else{
			
		//	echo "<script>alert('uploade file formate not supported')</script>";
		//	}
            if($brk_path!=$target_path){
            require './dbcon.php';
            $insert = "update  events set  e_profile_pic = '$target_path' where event_id = $event_id";
           // print_r($insert);die;
            $sqll=mysqli_query($conn, $insert);
            //print_r($sqll);die;
            if ($sqll>0) {
               $alrt= "Your record Updated Successfully";
            }
            else{
			echo "<script>alert('Record not updated')</script>";
			
			}
                        
        }
 else { 
            //echo 'choose a file';
 }
    }
    ?>
                               <?php
				$profileqry=mysqli_query($conn,"SELECT * FROM `events` WHERE event_id='$event_id'");
				$profileinfo1=mysqli_fetch_assoc($profileqry);
                                $display_company_name1 = "SELECT pet_name, pet_unique_id, profile_pic, powner_name
FROM user_inf
WHERE pet_unique_id =  '$profileinfo1[user_id_fk]'
UNION SELECT company_name, business_uniqueid, profile_image, company_name
FROM business
WHERE business_uniqueid =  '$profileinfo1[user_id_fk]'
UNION SELECT ngo_name, ngo_unique_id, profile_image, ngo_name
FROM ngo_resgitration
WHERE ngo_unique_id =  '$profileinfo1[user_id_fk]'";
//				$display_company_name1 = "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'";
                                $res1 = mysqli_query($conn,$display_company_name1);
                                $display1 = mysqli_fetch_assoc($res1);                                
				?>
<div class="main-content-inn-left">
<div class="col-first">
<div class="two-col-post two-col-post-brdr">
<div class="user-pro-dtls">
<div class="pro-timeline">
                       <?php if($profileinfo1['e_profile_pic']=="") {
							echo "<img src='images/paw.gif'>";
							}
							else {
							?>
							<img src="<?= $profileinfo1['e_profile_pic'] ?>" alt="user image" />
							<?php } ?>
							</div>
							
							<?php
$grp_name=mysqli_query($conn,"SELECT event_date FROM events WHERE event_id='$_GET[id]' AND user_id_fk='$parent_id'");
$groupname=mysqli_fetch_assoc($grp_name);

?>				
<div class="usr-pro-dtl-r">
<form method="post" enctype="multipart/form-data">  
<div class="usr-pro-left">
<h2 class="upl-hdng">Upload Photo</h2>
<div class="usr-cnct-l"><input type="file"  name="file" value="Uplaod Photo" /><button type="submit" name="file"><i class="fa fa-upload"></i>Upload</button></div>
</div>
  </form>
</div>

<div class="mem-admin-infs">
</div>
</div>

<div class="pst-hld">
<div class="two-col-post">
<div class="stat-textarea post-f left item demo">
<div class="post-in-c">
<div class="shdl-date">
<div class="left"><span class="mnth"><?php
$event_date = DateTime::createFromFormat("Y-m-d", $profileinfo1['event_date'] );
$emonth= $event_date->format("m");
$evm=date("F", strtotime($profileinfo1['event_date']));
$ev_month=substr($evm, 0, 3);
echo $ev_month."<br>".$event_date->format("d");
 ?></span><span class="dt"></span></div>
<div class="right">
<h3 class="ev-hding"><?= $profileinfo1['event_name'] ?></h3>
<div class="pbl-b"><span><i class="fa fa-globe"></i> Published by</span> <a href="#"><?= $display1['powner_name'] ?></a></div>
<div class="usr-pro-right">
<div class="post-act-ins">
<button class="post-share-btn" id=""><i class="fa fa-user-plus"></i> Invite</button>
<?php
$blikeqry=mysqli_query($conn,"SELECT * FROM event_users WHERE event_id_fk='$_GET[id]' AND user_id_fk='$user_id'");

if(mysqli_num_rows($blikeqry)>0) { ?>
<button class="going-button" id="<?= $_GET['id'] ?>"><i class="fa fa-check"></i> Going</button>
<?php }
else { ?>

<button class="going-button" id="<?= $_GET['id'] ?>"><i class="fa fa-check"></i> Not Going</button>
<?php } ?>
<span class="hiddenclass" style="display:none" id=<?= $user_id ?> ></span>

</div>
</div>
</div>
</div>

<div class="lcn-shd time-shd">
<div class="left"><i class="fa fa-clock-o"></i></div>
<div class="right">
<p><?= $profileinfo1['event_date'] ?> at <?= $profileinfo1['event_time'] ?></p>
</div>
</div>

<div class="lcn-shd">
<div class="left"><i class="fa fa-map-marker"></i></div>
<div class="right">
<!--<p class="vnu">Vasant Kunj Square Mall</p>-->
<div class="adr"><?= $profileinfo1['event_loc'] ?></div>
<a href="#" class="map">View Map</a>
</div>
</div>
</div>
</div>

<div class="one-col-post">
<div class="rel-eve-hdg"><h2>Details</h2></div>
<div class="inv-shd rel-eve-dec">
<p><?= $profileinfo1['event_desc'] ?></p>
</div>
</div>

<div class="one-col-post">
<div class="inv-shd">
  <?php                                              
session_start();
//$gp_id=$_GET['id'];
//$parent_id = $_SESSION["pet_unique_id"];
//$grpqry1=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id,U.profile_pic
//FROM user_inf U, event_users G WHERE U.status =  '1'
//AND U.pet_unique_id = G.user_id_fk
//AND G.event_id_fk =  '$event_id'
//AND G.status='1'
//ORDER BY G.event_user_id DESC ");
$grpqry1=mysqli_query($conn,"SELECT * FROM `event_users` WHERE `event_id_fk`='$event_id'");
$count = mysqli_num_rows($grpqry1);
//print_r($count);
?>  
<div class="left"><?php echo $count;?> Going, 0 Maybe, 0 Invited</div>
<div class="right">
<div class="post-share-btn"><a href="#"><i class="fa fa-envelope"></i> Invite</a></div>
</div>
</div>
</div>
<div class="">
<div class="one-col-post">    
<div id="" class="macy-top masonry-0l">
<div class="stat-textarea post-f left item demo"  macy-complete="1">
<div class="post-in-c ">
<form method="post" id="profile-post-form">
<div class="uplbtn-btm">
<h2 class="p-hdng"><i class="fa fa-envelope"></i> Share In Messenger</h2>
<div class="upl-btm-text"><span class="s-t-txt">To : </span><input name="title" placeholder="Choose friend" type="text"></div>
<div class="upl-btm-text"><textarea name="description" placeholder="Add Message"></textarea></div>
</div>
</form>
</div>
</div>

</div>

</div>
</div>

<div class="one-col-post rec-post-c">
<div class="rel-eve-hdg"><h2>Recent Posts</h2></div>
<?php


                       WHILE($postres=mysqli_fetch_assoc($disprun))  {
								
                                $par_name=mysqli_query($conn,"SELECT pet_name, profile_pic, pet_unique_id
FROM user_inf
WHERE pet_unique_id =  '$postres[user_id_fk]'
UNION SELECT company_name, profile_image, business_uniqueid
FROM business
WHERE business_uniqueid =  '$postres[user_id_fk]'
UNION SELECT ngo_name, profile_image, ngo_unique_id
FROM ngo_resgitration
WHERE ngo_unique_id =  '$postres[user_id_fk]'");
								$pname_res=mysqli_fetch_assoc($par_name);
								$imcount=$postres['img_count'] + $postres['vid_count'];
								
								?>
<div class="sug-mem-row">
<div class="user-icn-img">
    <?php if($pname_res['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $pname_res['profile_pic']  ?>" alt="user image" />
							<?php } ?>
</div>
<div class="fr-nm fr-nm-dec">
<a href="about3.php?id=<?= $pname_res['pet_unique_id'] ?>"><?= $pname_res['pet_name']  ?></a> - </span>
<p class="rec-dec"><a href="event-test.php?id=<?php echo $event_id;?>&name=<?php echo $e_name;?>"><?= $postres['event_data'] ?></a><p>
</div>
</div>
<?php
                           
                        }
						 //mysql_close($conn);
                        ?>

<div class="s-al-p"><a href="#">See all posts</a></div>
</div>

    <?php // include 'event-post-data.php'; ?>
</div>
   <?php require_once 'inc/ads_sidebar_d.php'; ?>
    
    <script type="text/javascript">

$(document).on('click', '.going-button', function() {
      
      var post_id=$(this).attr("id");
      var hidden = $(".hiddenclass").attr("id");
      //alert(hidden);
	
		$.ajax({
        	url: "going.php",
		type: "POST",
		data: { id: post_id,userid:hidden},
    	        success: function(data)
		{
	        $('#'+post_id+'.going-button').text(data);
			location.reload();
	        
		},
	 });
});

</script>

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

$(document).on('click','#box-next',function(e) {
	e.preventDefault();

    //$('.img-wrap div#media img.selected').hide().next().show().end().appendTo('.img-wrap');
	if($('.img-wrap div#media.selected').next().is('div#media')) {
	$('.img-wrap div#media.selected').removeClass('selected').next().addClass('selected');
	}

	
});


$(document).on('click','#box-prev',function(e) {
	e.preventDefault();

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
        	url: "save-post-events.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,	
beforeSend: function()
                {
                    $('#loading-post').show();
                },			
			success: function(data)
		    {
	             $('#loading-post').hide();
				//$('#post-display').prepend(data);
				//$('#page-load-ref').load(document.URL +  '#page-load-ref');
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


</div>
    

</div>

<div class="two-col-right">
<div class="fr-list" id="friends-list rel-events">
	<h2 class="fr-headnig">
	<p class="user-nm">Related Events</p>
	</h2>
    
	<div class="fr-li-cont">
            <?php
session_start();
$parent_id = $_SESSION["pet_unique_id"];
$grpqry=mysqli_query($conn,"SELECT * FROM  `events` ORDER BY RAND() LIMIT 3");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
//                                            $description=$grpres['event_desc'];
						?>   
	<div class="fr-li-row">         
	<div class="fr-t-l">
	<div class="fr-left">
	<span class="user-icn-img">
            <a href="rel-event-page.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>">
        <?php if($grpres['e_profile_pic']=="") {
							echo "<img src='images/user_image04.jpg'>";
							}
							else {
							?>
							<img alt="" src="<?= $grpres['e_profile_pic'] ?>">
							<?php } ?></a>
	</span>
	</div> 
	<div class="fr-right">
	<span class="fr-nm"><a href="rel-event-page.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>" class="frn_profile"><?= $grpres['event_name'] ?></a></span>
	<p class="tm-ad"><span class=""><?php
$event_date = DateTime::createFromFormat("Y-m-d", $grpres['event_date'] );
$emonth= $event_date->format("m");
$evm=date("F", strtotime($grpres['event_date']));
$ev_month=substr($evm, 0, 3);
echo $ev_month." ".$event_date->format("d");
 ?> at</span><a href="#"><?= $grpres['event_loc'] ?></a></p>
<!--	<div class="g-btm">2,895 guests</div>-->
	<div class="int-g">
	<a href="#">Interested</a>
	<a href="#">Going</a>
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
<!--share-->

	<link rel="stylesheet" href="css/modal.css">	
		
				
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
					 
					
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-pid="123" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <h3 class="modal-title" id="exampleModalLabel">Select Friends To Invite</h3>
        <button type="button" class="close" id="share-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="fr-li-cont">
	  <form method="post" id="share-form">
	  <?php
	  //$pg_id=$_GET['id'];
    $friendqry="SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1' LIMIT 10";
	
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
                                    <div class="user-nm" id="<?= $friendlist['pet_unique_id'] ?>"><a href="#" class="share-select-frn">SELECT</a></div>
                                </div>
							
<?php } ?>
              
              <input type="hidden" name="event_id" value="<?= $_GET['id'] ?>">
								</div>
	  
        
      </div>
      <div class="modal-footer">
        
        <input type="submit" id="share-btn" value="Invite">
		
      </div>
	  
</form>
    </div>
  </div>
</div>	

 	

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
        -moz-column-count: 1; 
        -webkit-column-count: 1;
        column-count: 1;
    }
}

@media only screen and (min-width: 700px) {
    .masonry-0l  {
        -moz-column-count: 1;
        -webkit-column-count: 1;
        column-count: 1;
    }
}

@media only screen and (min-width: 900px) {
    .masonry-0l  {
        -moz-column-count: 1;
        -webkit-column-count: 1;
        column-count: 1;
    }
}

@media only screen and (min-width: 1100px) {
    .masonry-0l  {
        -moz-column-count: 1;
        -webkit-column-count: 1;
        column-count: 1;
    }
}


</style>

<div id="loading-post"><span class="loading-post">Loading Post</span><img src="loading.gif"></div>
<!--share end-->
<script type="text/javascript">
				$(document).ready(function() {
					$('.frn_req_acc').on('click',function(e) {
						e.preventDefault();
						var acc_id=$(this).attr('id');
						
						$.ajax({
        	        url: "page_req_fun.php",
			type: "POST",
			data: { accept: acc_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("ADDED");
			  
		      $('#friend-req-show').load(document.URL +  ' #friend-req-show');
			  $('#friends-list').load(document.URL +  ' #friends-list');
		    }        
		});
						
					}),
					
					$('.frn_req_rej').on('click',function(e) {
						e.preventDefault();
						var rej_id=$(this).attr('id');
						
						$.ajax({
        	        url: "page_req_fun.php",
			type: "POST",
			data: { reject: rej_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+rej_id+'.frn_req_rej').parent().html("REJECTED");
			  $('#friend-req-show').load(document.URL +  ' #friend-req-show');
		        
		    }        
		});
						
					});
					
					
				});
				</script>
<?php require_once 'inc/footer.php';  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
			<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
	<script type="text/javascript">
    $(document).ready(function () {
      
        $(document).on('click','.post-share-btn', function() {
			 var pid=$(this).attr('id');
           $('#myModal').show().attr("data-pid",pid);
		 
		   //$('#myModal').data("pid",pid);
		   
        }),
		$('.share-select-frn').on('click',function(e) {
			e.preventDefault();
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
		   var $form = $(this);
            $form.find('submit').attr('disabled', true);
		   var pid=$(this).closest('.modal').attr('data-pid');
		   var fd=new FormData(this);
		   fd.append('pid',pid);
		   
		$.ajax({
        	url: "event-share-fun.php",
			type: "POST",
			data: fd,
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
	          $('#alert-msg').html(data).show();
			  $('#alert-msg').fadeOut(10000);
			  
				//alert(data);
				$('#share-form')[0].reset();
				$('#myModal').hide();
				$('#share-form').find('.fr-li-row').removeClass('marked');
		
		    },
		  	error: function() 
	    	{
				
	    	} 	
		
	   });
	   return false;
	}));
});
</script>	
<script type="text/javascript">
	var fired=0;

    $(window).scroll(function() {

        if($(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {
			
			if ($(window).data('ajax_in_progress') === true)
            return;
			
			if(fired==0) {
            var last_id = $(".one-col-post:last").attr("id");
            loadMoreData(last_id);
			
			}
			fired=1;
        }
		
    });

    function loadMoreData(last_id){
      $.ajax(
            {
                url: 'bus_loadmoredata.php?last_id=' + last_id,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
				
            })
            .done(function(data)
            {
				
				//alert(last_id);
                $('.ajax-load').hide();
                $("#post-display").append(data);
				fired=0;
				if(data.length<25) {
					$(window).data('ajax_in_progress', true);
				}
            })
			
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
			
    }
</script>
<script type="text/javascript">

$(document).on('click', '.post-like-button', function() {
 
	var post_id=$(this).attr("id");
	
		$.ajax({
        	url: "event-functions.php",
			type: "POST",
			data: { id: post_id },
    	                cache: false,			
			success: function(data)
		    {
	        
			if($('#'+post_id+'.post-like-button').text()=='Like') {
				$('#'+post_id+'.post-like-button').text('Unlike');
			}
			else if($('#'+post_id+'.post-like-button').text()=='Unlike'){
				$('#'+post_id+'.post-like-button').text('Like');
			}
				
			
			
				//alert(parseInt($('#number-likes').html()));
				$('.number-likes'+post_id).html(data);
				$('.number-likes'+post_id).prev('#paw-likes').toggleClass('paw-like');
				
		        
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
});

</script>

	
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
        	url: "event-functions.php",
			type: "POST",
			data: { 
			commentid: post_id , commenttext: comment_data
			},
    	    cache: false,			
			success: function(data)
		    {
	          $('#'+post_id+'.post-comment-box').hide();
			  $('#'+post_id+'.one-col-post').find('.comment-area').html(data);
			  //$('#'+post_id+'.post-comment-box').parent().append("<div class='user-comments'>"+data+"</div>");
		      
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		});
		$(this).attr( 'disabled','disabled' );
 });
});

</script>	
<script>
$(document).ready(function() {
	$('.one-col-post').each(function() {
	if($(this).find('#post-media').data('count')>5) {
		var elcount=$(this).find('#post-media').data('count');
		$(this).find('#post-media').find('.pb-image-box').slice(5,elcount).hide();
		//if($(this).find('#show-more-img').html()=='Show More') {
		$(this).find('#post-media').append("<div class='show-more-img'><a id='show-more-img' href='#'>Show More</a></div>");
		//}
		
	}
	});
});
</script>
<script>
$(document).on('click','#show-more-img',function(e) {
	e.preventDefault();
	$(this).parent().parent().find('.pb-image-box:nth-child(6) img').click();
});              
</script>

<!--share end-->
</body>
</html>