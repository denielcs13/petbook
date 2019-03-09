<?php
session_start();
require 'dbcon.php';

if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}


$display = "SELECT * FROM post WHERE id='$_GET[pid]'";
        $disprun = mysqli_query($conn, $display);
         $postres=mysqli_fetch_assoc($disprun);
$simg=explode(",",$postres['image']); 
$svid=explode(",",$postres['video']);
?> 
<html>
<?php require_once 'inc/head-content11.php';  ?>	
<head>

<meta property="og:url" content="http://www.petbooq.com/showpst.php?pid=<?= $_GET['pid'] ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Petbooq" />
<meta property="og:description" content="A Social Network For Pets" />
<meta property="og:image" content="http://petbooq.com/<?= $simg[0] ?>">
<meta property="og:video" content="http://petbooq.com/<?= $svid[0] ?>">
<meta property="og:video:type" content="video/mp4">
<meta property="fb:app_id" content="1369234256522197" />
 	
		 
</head>
  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--<script>
$(document).ready(function() {
	
$('head').append('<meta property="og:image" id="fb-shr-img" content="http://www.petbooq.com/2660679/post_images/f2b342360cbfc31bcf293cb55e4e5f67.jpg">');
});

</script>-->

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
        </style>


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page show-post" id="about-load-ref">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side">
   
</div>
                               <?php
							   
				
				
				$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
				$par_name=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic,'user_inf' as source FROM user_inf WHERE pet_unique_id='$postres[child_post_id]' UNION SELECT company_name,business_uniqueid,profile_image,'business' as source FROM business WHERE business_uniqueid='$postres[child_post_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image,'ngo_resgitration' as source FROM ngo_resgitration WHERE ngo_unique_id='$postres[child_post_id]'");
								$pname_res=mysqli_fetch_assoc($par_name);
								$imcount=$postres['img_count'] + $postres['vid_count'];
				?>


<div class="main-content-inn-left">
<div class="col-first">
	
  <div class="one-col-post" id="<?= $postres['id'] ?>">
                                    <div class="one-col-inn">
                                        <div class="post-in-c">
										<div class="post-content">
										<h2>
										<span class="user-icn-img">
										<?php if($pname_res['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							} 
							else {
							?>
							<img src="<?= $pname_res['profile_pic']  ?>" alt="user image" />
							<?php } ?>
							</span>
							
							<p class="user-nm">
							<?php if($pname_res['source']=='user_inf') { ?>
							<a href="about3.php?id=<?= $pname_res['pet_unique_id'] ?>">
							<?= $pname_res['pet_name']  ?>
							</a>
							<?php } if($pname_res['source']=='business') { ?>
							<a href="business-page-new-user.php?id=<?= $pname_res['pet_unique_id'] ?>">
							<?= $pname_res['pet_name']  ?>
							</a>
							<?php } if($pname_res['source']=='ngo_resgitration') { ?>
							
							<a href="ngo-page-new-user.php?id=<?= $pname_res['pet_unique_id'] ?>">
							<?= $pname_res['pet_name']  ?>
							</a>
							
							<?php } ?>
							</p>
							</h2>
							
							<?php if($postres['wall_post_id']==$parent_id) {
								echo "<span class='wall-post-ttl'>Posted on Your Wall</span>";
							}
							if($postres['type']=='shared') {
								echo "<span class='share-heading'><b>Shared a post with you</b></span>";
							}
							
							          
								?>
							
			<?php if($postres['url']=='') { ?>				
		 
		 
		 <h3><?= $postres['title'] ?></h3>
		 <p class="pst-text"><?= $postres['posts'] ?><p>
		
		
			<?php } else { ?>
			<a href="http://<?= $postres['url'] ?>" target="_blank">
		 
		 <h3><?= $postres['title'] ?></h3>
		 <p class="pst-text"><?= $postres['posts'] ?><p>
		
		</a>
			<?php } ?>
										</div>
                 	
                                          
<div class="post-image post-video">
<div class="post-mul-image">
<div class="post-mul-image">

<ul id="post-media" data-count="<?= $imcount ?>">
<?php if($postres['img_count'] > 0) { 
$post_images=explode(",",$postres['image']); 

for($i=0;$i<count($post_images); $i++) { 
?>
	
<li class="pb-image-box">
<a href="aj_box.php?id=<?= $postres['id'] ?>&im=<?= urlencode($post_images[$i]) ?> .ajcontent" data-featherlight="ajax">
<img class="photo" src="<?= $post_images[$i] ?>">
</a>
</li>


<?php 

} } ?>


<?php
if($postres['vid_count']>0) {
	$post_videos=explode(",",$postres['video']);
	for($i=0;$i<count($post_videos);$i++) { 
?>

<li class="pb-image-box">
<a href="aj_box.php?id=<?= $postres['id'] ?>&vid=<?= urlencode($post_videos[$i]) ?> .ajcontent" data-featherlight="ajax">
<video controls>
<source src="<?= $post_videos[$i] ?>" type="video/mp4">
</video>
</a>
</li>


<?php } } ?>
	

</ul>
</div>

</div>
</div>


<script>
$(document).ready(function() {
$('video').removeAttr('autoplay');
});
</script>                                 
											<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
         
		
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<img src='images/pet-like-icon.png' alt='' />
										<?php } else { ?>
										
										<?php } ?>
												
												<span class="number-likes<?= $postres['id'] ?>"><?= $likenum ?></span> Likes</p>
<!--Social sharing code start here-->
<!--Facebook-->



<?php
   $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
?>
<?php
echo '<iframe class="facebook-shr" src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fpetbooq.com%2Fshowpst.php?pid='.$_GET['pid'].'&layout=button&size=small&mobile_iframe=true&appId=1369234256522197&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
?>
<!--Facebook sharing code end here-->
<!--Pintrest sharing code end here-->
<a href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img src='http://www.brandaiddesignco.com/insights/PinIt.png'/></a>
<!--Social sharing code end here-->



                                            </div>

 


                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
					<button class="post-like-button liked" id="<?= $postres['id'] ?>"><span class='p-act-bt'>Unlike</span></button>
												<?php }
												else {
													?>
					<button class="post-like-button" id="<?= $postres['id'] ?>"> <span class='p-act-bt'>Like</span></button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $postres['id'] ?>">
<img src='images/comment-img.png' alt='' /> <span class='p-act-bt'>Comment</span></button>
													
                                                    <button class="post-share-btn" id="<?= $postres['id'] ?>">
<img src='images/post-share-icon.png' alt='' /> <span class='p-act-bt'>Share</span></button>
													
                                                </div>
												
												<div class="comment-head"><h3><img src="images/comment-img.png" alt=""> Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postres[id]' LIMIT 6");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name,profile_pic,pet_unique_id FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,profile_image,business_uniqueid FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,profile_image,ngo_unique_id FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");
	
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments">
													<span class="user-icn-img">
													<?php if($cmntr['profile_pic']=='') { ?>
										
						<img src="images/fr-pro-big-img.jpg" alt="user image">
													<?php } else { ?>
										
										
							<span class="user-icn-img"><img src="<?= $cmntr['profile_pic'] ?>" alt="user image" /></span>
							
													<?php } ?>
													</span>
						<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
							<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
														</div>
													
													<?php
													}	
												}
					$commentcount=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postres[id]'");
											if(mysqli_num_rows($commentcount)>6) {
											?>
											
											<a href="#" id="comment-load">More</a>
											<?php
											}
												
												?>
												
												<div class="post-comment-box" id="<?= $postres['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												</div>                                     </div>
                                        </div>
                                    </div>
									
									
									
                                </div> 	


</div>

<div class="col-second col-second-right">
    			

				
                           <script>
		$(document).on('click','#comment-load',function(e) {
			e.preventDefault();
			var postid=$(this).closest('.one-col-post').attr('id');
			
			$.ajax({
        	url: "get-comment-data.php",
			type: "POST",
			data: { 
			pid: postid 
			},
    	    cache: false,			
			success: function(data)
		    {
	         
			  $('#'+postid+'.post-in-c').find('.comment-area').html(data);
			  $('#'+postid+'.one-col-post').find('.comment-area').html(data);
			  
			
		      
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		});
		});
		</script>  
                        
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
                          $("#share-form").on('submit',(function(e)  {
	                  e.preventDefault();
		          var $form = $(this);
                          $form.find('submit').attr('disabled', true);
		          var pid=$(this).closest('.modal').attr('data-pid');
		          var fd=new FormData(this);
                	  fd.append('pid',pid);
	                  $.ajax({
        	          url: "post-share-tst.php",
			  type: "POST",
			  data: fd,
			  contentType: false,
    	                  cache: false,
			  processData:false,			
			  success: function(data)
		          {
		           console.log(data);
		           $('#alert-msg').html(data).show();
                           $('#alert-msg').fadeOut(10000);
                           
                            $('#share-form')[0].reset();
                            $('#myModal').hide();
                            $('#share-form').find('.fr-li-row').removeClass('marked');
		          },
	                  });
	                  return false;
	                  }));
                       
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