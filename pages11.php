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
require 'dbcon.php'; 
?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  
          
         //print_r($_GET['id']); 
         
        if(isset($_GET['id'])) {
		$page_id=$_GET['id'];
	}
	else {
        $page_id= $_SESSION['last_id'];
        }
      
        //$pg_name=$_GET[name];
       
         
        $userqry = mysqli_query($conn, "SELECT * FROM pages WHERE page_id='$page_id' AND user_id_fk='$parent_id'");
        $userinf = mysqli_fetch_assoc($userqry);
        $grpqry=mysqli_query($conn,"SELECT * FROM pages WHERE page_id ='$page_id'");
        $grpres=mysqli_fetch_assoc($grpqry);        
        $display = "SELECT * FROM pg_updates WHERE page_id_fk='$page_id' ORDER BY p_update_id DESC";       
        $disprun = mysqli_query($conn,$display);
        ?>
<div class="alert-area">
            <div class="alert-row" id="alert-msg"></div>
        </div>

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
.col-page {
	width:15%;
}
.alert-area {
                position: relative;
                top: 8%;
            }
            .alert-row {

                position: fixed;
                top:8%;
                width: auto;
                left: 25%;
                z-index: 1000;
                opacity: 0.8;
                height: auto;
                padding:4px;
                border-radius: 6px;
                background: #0e83e2;
                color:#FFF;
                display:none;
            }
        </style>


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page usr-feed-page  groups-page create-mem-pages" id="about-load-ref">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side col-page">

<?php

$display_company_name = "SELECT * FROM pages WHERE page_id='$page_id'";
$res = mysqli_query($conn,$display_company_name);
$display = mysqli_fetch_assoc($res);
?>

<?php 
include 'inc/pages_sidebar.php'; 
include 'inc/side-bar.php'; ?>
</div>
    <?php
     $alrt='';
     $display_company_name1 = "SELECT * FROM pages WHERE page_id='$page_id'";
    $res1 = mysqli_query($conn,$display_company_name1);
    $display1 = mysqli_fetch_assoc($res1);     
    
    if (isset($_POST["file"])) {
    $pg_name=$display1['page_name'];
    $page_id=$page_id;
    
    $image_name =$_FILES['file']['name'];
	$image_type=$_FILES['file']['type'];
	$image_size=$_FILES['file']['size'];
	$image_tmpname=$_FILES['file']['tmp_name'];
        $target_path = $parent_id ."/Pages/".$pg_name."/profile_pic/" . basename($_FILES['file']['name']);
        $brk_path = $parent_id . "/Pages/".$pg_name."/profile_pic/";
        if($image_type=='application/msword' or $image_type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type=='application/pdf' or 
        $image_type=='image/png' or $image_type=='image/jpeg' or $image_type=='image/jpg' or $image_type=='application/msword'){
		move_uploaded_file($image_tmpname,$target_path);
                $target_path = $parent_id ."/Pages/".$pg_name."/profile_pic/" . basename($_FILES['file']['name']);
		}
                
            if($brk_path!=$target_path){
         
            $insert = "update  pages set  pg_profile_pic = '$target_path' where page_id = $page_id";
           
            $sqll=mysqli_query($conn, $insert);
            
                   
        }
		echo "<script>window.location.href='pages1.php?id=".$page_id."'</script>";
 
    }
	
    ?>
                               <?php
				$profileqry=mysqli_query($conn,"SELECT * FROM pages WHERE page_id='$page_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
                                //print_r($profileinfo);
				?>
<div class="main-content-inn-left">
<div class="col-first">
<div class="two-col-post two-col-post-brdr">
<div class="user-pro-dtls" id="<?php echo $_GET['id']?>">
<div class="grp-name"><h2><span class="grp-name-t"><?php echo $display['page_name']?></span></h2></div>
<div class="pro-timeline">

                       <?php if($profileinfo['pg_profile_pic']=="") {
							echo "<img src='images/paw.gif'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['pg_profile_pic'] ?>" alt="user image" />
							<?php } ?>
							</div>
							
							<?php
$grp_name=mysqli_query($conn,"SELECT page_name FROM pages WHERE page_id='$page_id' AND user_id_fk='$parent_id'");
$groupname=mysqli_fetch_assoc($grp_name);
?>				
<div class="usr-pro-dtl-r">
    <div class="usr-pro-right">
	<?php if($profileinfo['user_id_fk']!=$parent_id) { ?>
<div class="post-act-ins">
    <?php
$blikeqry=mysqli_query($conn,"SELECT * FROM page_users WHERE page_id_fk='$page_id' AND user_id_fk='$parent_id' AND status='1'");

if(mysqli_num_rows($blikeqry)>0) { ?>
<button class="like-button page-unlike-btn" id="<?= $page_id ?>">Unlike Page</button>
<?php }
else { ?>
<button class="page-like-button like-button" id="<?= $page_id ?>">Like Page</button>
<?php } ?>

</div>
	<?php } ?>
</div>
<?php $pgowner=mysqli_query($conn,"SELECT * FROM pages WHERE page_id='$page_id'");
$powner=mysqli_fetch_assoc($pgowner);
if($powner['user_id_fk']==$parent_id) { ?>
<form method="post" enctype="multipart/form-data">  
<div class="usr-pro-left">
<h2 class="upl-hdng">Upload Photo</h2>
<div class="usr-cnct-l">
<div class="usr-cnct-l-brw">
<input type="file"  name="file" value="Uplaod Photo" />
<span class="brw-t-btn">Change Picture </span>
</div>
<button type="submit" name="file"><i class="fa fa-upload"></i>Upload</button>
</div>
</div>
</form>
<?php } ?>

</div>
<div class="share-btn-btm"><button class="page-share-btn">Share</button></div>
<div class="mem-admin-infs">
</div>


</div>

<div class="pst-hld">
<div class="divide-line">
</div>
<div class="two-col-post">
<div id="" class="macy-top masonry-0l">
<?php 
$clikeqry=mysqli_query($conn,"SELECT * FROM page_users WHERE page_id_fk='$page_id' AND user_id_fk='$parent_id' AND status='1'");
if(mysqli_num_rows($clikeqry)>0) { ?>
<div class="stat-textarea post-f left item demo"  macy-complete="1">
<div class="post-in-c ">
<form method="post" id="profile-post-form">
<div class="uplbtn-btm">
<h2 class="p-hdng">Share your new activity</h2>
<div class="upl-btm-text"><input name="title" placeholder="Experience" type="text"></div>
<div class="upl-btm-text"><textarea name="description" placeholder="Share your pets"></textarea></div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld">
<input name="post-url" placeholder="Type your URL" class="typ-t" type="text">
</div>
<div class="upload-btn-hld upload-btn-hld-top">
<div class="upload-btn-inhld" id="upload-post-img">

<input name="files[]" value="upload" class="fl-img" type="file" multiple/>
<input type="hidden" value="<?php echo $page_id ?>" name="page-id">
<input type="hidden" value="<?php echo $profileinfo['page_name']?>" name="page-name">
</div>
<input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
</div>
</div>
</form>
</div>
</div>
<?php } ?>
<?php include 'page-post-data.php'; ?>
</div>
</div>
<div class="two-col-right">
<div class="two-col-right-box">
<?php 
if($profileinfo['user_id_fk']==$parent_id && (isset($_SESSION['pet_unique_id']))) { ?>
<div class="box-top">
<strong class="page-rght-top-h">Know friends who might like your Page?</strong>
<div class="ad-mem"><input type="" name="" placeholder="Enter name or email address" /></div>
</div>

<div class="sug-mem-box">
<h4>INVITE FRIENDS</h4>
<?php                                                    

$pg_id=$page_id;
$_SESSION['pg_id']=$page_id;


$grpqry=mysqli_query($conn,"SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'");
WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
$mem_chk=mysqli_query($conn,"SELECT * FROM page_users WHERE page_id_fk='$page_id' AND user_id_fk='$grpres[pet_unique_id]'");
if(mysqli_num_rows($mem_chk)<1) {
						?>
<div class="sug-mem-row">
<span class="user-icn-img"><?php if($grpres['profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['profile_pic'] ?>">
							<?php } ?><span class="fr-nm">
                                                            <a href="about3.php?id=<?= $grpres['pet_unique_id'] ?>"><?= $grpres['pet_name'] ?></a></span></span>
<span class="ad-mem-btn">
<!--    <button class="cls"><a href="#" class="frn_req_rej" id="<//?=$frnd_req['parent_id'] ?>">X</a></button>-->
    <a href="#" class="frn_req_acc event-edit-button" id="<?= $grpres['pet_unique_id'] ?>">Invite Friend</a></span>
</div>
<?php }
                            }
                        ?>
<div class="s-all"><a href="#">See More > </a></div>

</div>
<?php } ?>

<div class="photo-box">
<h4>Page Photos</h4>
  <div class="usr-pro-photoglr">
      <?php

//$parent_id = $_SESSION["pet_unique_id"];
$grpqry=mysqli_query($conn,"SELECT * FROM pages WHERE user_id_fk='$parent_id' and status='1' LIMIT 5");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
						?>
<div class="usr-photo-img">
    
    <?php if($grpres['pg_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
    <img class="photo"  alt="" src="<?= $grpres['pg_profile_pic'] ?>">
    <?php } ?>

</div>

<?php
                            }
                        ?>	


<div class="s-all"><a href="#">See More > </a></div>
</div></div>


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
		
		$('#box-image-disp div').find('video source[src$="'+vid+'"]').parent().parent().addClass('selected');
	}
	
	
});
</script>
			<script>
$(document).ready(function() {


$(document).on('click','#box-next',function(e) {
	e.preventDefault();

   
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
        	url: "save-post-page1.php",
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
			
				location.reload();
				$('#profile-post-form')[0].reset();
		$('#post-submit-btn').removeAttr('disabled');
		    },
		  	error: function() 
	    	{
				
	    	} 
	       
	   });
	   $(this).find(':submit').attr( 'disabled','disabled' );
	

	}));
	
	
});
</script>

<script type="text/javascript">
				
					$(document).on('click','.page-like-button',function(e) {
						e.preventDefault();
						var pageid=$(this).attr('id');
						
						$.ajax({
        	        url: "page_join_fun.php",
			        type: "POST",
			        data: { accept: pageid },
                    cache: false,
			        success: function(data) {
	          
			  $('#'+pageid+'.page-like-button').text("LIKED");
			  location.reload();
			  //$('#page-act-disp').load(document.URL +  ' #page-act-disp');
		     
			  
		    }        
		});
		});
		
		$(document).on('click','.page-unlike-btn',function(e) {
						e.preventDefault();
						var pageid=$(this).attr('id');
						
						$.ajax({
        	        url: "page_join_fun.php",
			        type: "POST",
			        data: { reject: pageid },
                    cache: false,
			        success: function(data) {
	          
			  $('#'+pageid+'.page-unlike-btn').text("LIKED");
			  location.reload();
			  
		    }        
		});
		});
		</script>
</div>



<?php require_once 'inc/ads_sidebar_d.php'; ?>
</div>



</div>
</div>
<!--share-->

	<link rel="stylesheet" href="css/modal.css">	
		
				
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
					 
					
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-pid="<?php echo $_GET['id'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	  $pg_id=$page_id;
    $friendqry = "SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
	
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

								</div>
	  
        
      </div>
      <div class="modal-footer">
        
        <input type="submit" id="share-btn" value="Share">
		
      </div>
	  
</form>
    </div>
  </div>
</div>	



<div class="modal fade" id="myModalps" tabindex="-1" role="dialog" data-pid="<?php echo $_GET['id'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <h3 class="modal-title" id="exampleModalLabel">Select Friends To Share This Page</h3>
        <button type="button" class="close" id="page-share-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="fr-li-cont">
	  <form method="post" id="page-share-form">
	  <?php
	  $pg_id=$page_id;
    $friendqry = "SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
	
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
                                    <div class="user-nm" id="<?= $friendlist['pet_unique_id'] ?>"><a href="#" class="page-share-frn">SELECT</a></div>
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
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("Invitation Send");
			  
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
		 
		  
		   
        }),
		$('.share-select-frn').on('click',function(e) {
			e.preventDefault();
			 $(this).attr('id');
			$(this).parent().parent().toggleClass("marked");
			$(this).parent().parent().find('.check-share').trigger('click');
		}),
$('#share-modal-close').click(function() {

$('#myModal').hide();

}),


$(document).on('click','.page-share-btn', function() {
			 //var pid=$(this).attr('id');
           $('#myModalps').show();
		   //.attr("data-pid",pid);
		 
		  
		   
        }),
		$('.page-share-frn').on('click',function(e) {
			e.preventDefault();
			 $(this).attr('id');
			$(this).parent().parent().toggleClass("marked");
			$(this).parent().parent().find('.check-share').trigger('click');
		}),
$('#page-share-close').click(function() {

$('#myModalps').hide();

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
        	url: "page-share-fun.php",
			type: "POST",
			data: fd,
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
				
	           $('#alert-msg').html(data).show();
			  $('#alert-msg').fadeOut(10000);			
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
$(document).ready(function() {
$("#page-share-form").on('submit',(function(e)  {
		
           e.preventDefault();
		   var $form = $(this);
           $form.find('submit').attr('disabled', true);
		   var pid=$(this).closest('.modal').attr('data-pid');
		   var fd=new FormData(this);
		   fd.append('pid',pid);
		   
		$.ajax({
        	url: "page_shares.php",
			type: "POST",
			data: fd,
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
				
	          $('#alert-msg').html(data).show();
			  $('#alert-msg').fadeOut(10000);			
				$('#page-share-form')[0].reset();
				$('#myModalps').hide();
				$('#page-share-form').find('.fr-li-row').removeClass('marked'); 
		
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
        	url: "page-functions.php",
			type: "POST",
			data: { id: post_id },
    	                cache: false,			
			success: function(data)
		        {
	        
			var resp=data.split('|');
						
						$('#' + post_id + '.post-like-button').text(resp['0']);
						
                        $('.number-likes' + post_id).html(resp['1']);
                        $('.number-likes' + post_id).prev('#paw-likes').toggleClass('paw-like');
			
				
		        
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
        	url: "page-functions.php",
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