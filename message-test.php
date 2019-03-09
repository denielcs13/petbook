<?php
require 'dbcon.php';
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
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
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
.load-more-btn {
	background: #fff;
    border-radius: 7px;
    padding: 4px;
	color:#ff8500;
}
.msg-del {
    float: right;
    position: relative;
    left: 7px;
    top: -59px;
}
        </style>

<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page friend-message" id="about-load-ref">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side">
<?php require_once 'inc/user_profile_sidebar.php'; ?>
<?php require_once 'inc/side-bar.php'; ?>
<?php require_once 'inc/rehome-a-pet-side-bar.php'; ?>    
</div>
<div class="main-content-inn-left">
<div class="col-first">
<div class="two-col-post two-col-post-brdr">

<div class="pst-hld">
<div class="divide-line">
</div>
<div class="two-col-post">
<div id="" class="fr-message-box">
<div class="fr-chat-left post-in-c">
<ul>
<?php
$query= mysqli_query($conn,"SELECT u.pet_unique_id,c.c_id,u.pet_name,u.profile_pic,u.email
 FROM conversation c, user_inf u
 WHERE CASE 
 WHEN c.user_one = '$parent_id'
 THEN c.user_two = u.pet_unique_id
 WHEN c.user_two = '$parent_id'
 THEN c.user_one= u.pet_unique_id
 END 
 AND (
 c.user_one ='$parent_id'
 OR c.user_two ='$parent_id'
 )
 ORDER BY c.c_id DESC LIMIT 20") or die(mysql_error());

while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$c_id=$row['c_id'];
$user_id=$row['pet_unique_id'];
$username=$row['pet_name'];
$email=$row['email'];
$cquery= mysqli_query($conn,"SELECT R.cr_id,R.time,R.reply FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysql_error());
$crow=mysqli_fetch_array($cquery,MYSQLI_ASSOC);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time1=$crow['time'];
//$datetime1 = Time();
//$datetime2 = new Time($row['time']);
//$interval = ($datetime1-$time)/(60*60);
//echo "<a href='text-msg.php?id=" . $row['c_id'] . "'>".$username."</a></br> ".$reply."</br> ".$interval."</br>";
date_default_timezone_set("Asia/Calcutta");
//$time=date('Y-m-d H:i:s');
//$seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($time1);
////echo "$seconds";
//        $months = floor($seconds / (3600*24*30));
//        $day = floor($seconds / (3600*24));
//        $hours = floor($seconds / 3600);
//        $mins = floor(($seconds - ($hours*3600)) / 60);
//        $secs = floor($seconds % 60);
$date2=date('Y-m-d H:i:s');
$diff = abs(strtotime($date2) - strtotime($time1));
$years = floor($diff / (365*60*60*24)); 
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
$minuts = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
        if($diff < 60)
            $time = $seconds." sec ago";
        else if($diff < 60*60 )
            $time = $minuts." min ago";
        else if($diff < 24*60*60)
            $time = $hours." hrs ago";
        else if($diff < 30*24*60*60)
            $time = $days." day ago";
        else if($diff < 12*30*24*60*60)
	    $time = $months." month ago";
        else
            $time = $years." year ago";
?>
<li class="msg-listing-cls">	
<a class="fri-ch-li-row" href='message-list.php?id=<?= $row['c_id'] ?>&user_id=<?= $row['pet_unique_id'] ?>'>
<div class="fr-ch-l-img">
	<?php if($row['profile_pic']=='') { ?>
										
						<img src="images/user_image05.jpg" alt="user image">
													<?php } else { ?>
										
										
							<img src="<?= $row['profile_pic'] ?>" alt="user image" />
							
													<?php } ?>
</div>
<div class="fr-ch-r-content">
    <h2 class="fri-name"><?= $row['pet_name'] ?></h2>
<div class="fri-mes"><i class="fa fa-share"></i><span><?= $crow['reply']?></span></div>
<div class="fri-mes-time">    
    <?php echo $time; ?>
</div>
</a>
<div class="msg-del" id="<?= $row['c_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
</div>

</li>
<?php
}
?>

</ul>
</div>
    <script type="text/javascript">
        
           $(document).on('click', '.msg-del', function () {
                var ms_id = $(this).attr("id");
              $.ajax({
                    url: "delete-functions.php",
                    type: "POST",
                    data: {delmsg: ms_id},
                    cache: false,
                    success: function (data)
                    {

                      $('#'+ms_id+'.msg-del').closest('.msg-listing-cls').fadeOut(1000);
						
						
                    },
                    error: function ()
                    {

                    }
                });
            });
        </script>
                              <?php
                             	$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$_GET[id]'");
				$profileinfo=mysqli_fetch_assoc($profileqry);	
		             ?>
<div class="fr-chat-right" id="fr-chat-area">
<h2 class="fri-name">Start conversation with <?= $profileinfo['pet_name'] ?></h2>
<div class="chat-msg-outer" >
 <?php
$q=mysqli_query($conn,"SELECT c_id 
FROM conversation 
WHERE 
(user_one='$parent_id' AND user_two='$_GET[id]') 
OR
(user_one='$_GET[id]' AND user_two='$parent_id') ORDER BY c_id DESC limit 1");
$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
$query= mysqli_query($conn,"SELECT
    R.cr_id,
    R.time,
    R.reply,
    U.pet_unique_id,
    U.pet_name,
    U.profile_pic,
    U.email
FROM
    user_inf U,
    conversation_reply R
WHERE
    R.user_id_fk = U.pet_unique_id AND R.c_id_fk = '$v[c_id]'
ORDER BY
    R.cr_id ASC
LIMIT 200") or die(mysql_error());
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
        $time1=$row['time'];
        date_default_timezone_set("Asia/Calcutta");
        $date2=date('Y-m-d H:i:s');
$diff = abs(strtotime($date2) - strtotime($time1));
$years = floor($diff / (365*60*60*24)); 
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
$minuts = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
        if($diff < 60)
            $time = $seconds." sec ago";
        else if($diff < 60*60 )
            $time = $minuts." min ago";
        else if($diff < 24*60*60)
            $time = $hours." hrs ago";
        else if($diff < 30*24*60*60)
            $time = $days." day ago";
        else if($diff < 12*30*24*60*60)
	    $time = $months." month ago";
        else
            $time = $years." year ago";
  ?>   
<div class="chat-msg post-in-c" >
<div class="chatmsg-box">
<div class="fr-ch-l-img">
    <?php if($row['profile_pic']=='') { ?>
										
						<img src="images/user_image05.jpg" alt="user image">
													<?php } else { ?>
										
										
							<img src="<?= $row['profile_pic'] ?>" alt="user image" />
							
													<?php } ?>
</div>
    <h2 class="fri-name sender-name"><a class="fri-ch-li-row" href='about-fr.php?id=<?= $row['pet_unique_id'] ?>'><?= $row['pet_name'] ?></a></h2>
<div class="fri-chat-full-desc">
<?= $row['reply'] ?>
</div>
<div class="fri-mes-time"><?php echo $time; ?></div>
</div>
</div>
    <?php } ?>
</div>
<form method="post" id="profile-post-form">
<div class="chat-msngr post-in-c">
   <textarea name="reply" placeholder="Send your message"></textarea>
   <input type="hidden" value="<?= $_GET['id'] ?>" name="msg_id">
   <div class="sub-inp"><input value="Send" id="" name="submit" class="fl-subm" type="submit"></div>
</div>
</form>

</div>
</div>
</div>

</div>

</div>
</div>
<!--    <script type="text/javascript">
        
           $(document).on('click', '.unfriend-btn', function () {
                var fr_id = $(this).attr("id");
              $.ajax({
                    url: "post-functions.php",
                    type: "POST",
                    data: {unfriend: fr_id},
                    cache: false,
                    success: function (data)
                    {

                      $('#'+fr_id+'.unfriend-btn').closest('.friend-box').fadeOut(1000);
						
						
                    },
                    error: function ()
                    {

                    }
                });
            });
        </script>-->
    <script type="text/javascript">
$(document).ready(function() {
	
		 
	$("#profile-post-form").on('submit',(function(e)  {
		
           e.preventDefault();
		$.ajax({
        	url: "msg-friend1.php", 
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
				$( "#fr-chat-area" ).load(window.location.href + " #fr-chat-area" );
				//$('#fr-chat-area').load(document.URL +  '#fr-chat-area');
				//location.reload();
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

<div class="col-second col-second-right">
<?php require_once 'inc/ads_sidebar_d.php'; ?>
</div>
</div>
</div>
</div>
<!--share-->

	<link rel="stylesheet" href="css/modal.css">				
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
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
<script>
       var jQuery = $;
            jQuery(document).ready(function () {
                jQuery('.post-in-c').each(function () {
                    if (jQuery(this).find('#post-media').data('count') > 5) {
                        var elcount = jQuery(this).find('#post-media').data('count');
                        jQuery(this).find('#post-media').find('.pb-image-box').slice(5, elcount).hide();
                        //if($(this).find('#show-more-img').html()=='Show More') {
                        jQuery(this).find('#post-media').append("<div class='show-more-img'><a id='show-more-img' href='#'>Show More</a></div>");
                        //}
                    }
                });
            });
        </script>
        <script>
        var jQuery = $;
            jQuery(document).on('click', '#show-more-img', function (e) {
                e.preventDefault();
                jQuery(this).parent().parent().find('.pb-image-box:nth-child(6) img').click();
            });
        </script>

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