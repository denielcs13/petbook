<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {   
    header('Location:index.php');
}
?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header.php';  ?>
    <?php
        $parent_id = $_SESSION['pet_unique_id'];
        require 'dbcon.php';
        $userqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $userinf = mysqli_fetch_assoc($userqry);

        $display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND addfriend.status>'0' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND addfriend.status>'0') AS u ORDER BY u.id DESC LIMIT 5";

        $disprun = mysqli_query($conn, $display);
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
				height:30%;
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
.img-wrap li#media {
	height:50%;
	width:100%;
	display:none;
}
.img-wrap li#media:first-child {
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
        </style>


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page" id="about-load-ref">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side">
<div class="pro-right-sec">
<div class="sidebar">
<ul>
<li><a href="#"><span class="icn"><img src="images/create-page-icon.png" alt="icon"></span>Create Page</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon"></span>Create Groups</a></li>
<li><a href="#"><span class="icn"><img src="images/event-icon.png" alt="icon"></span>Events</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon"></span>Create Ads</a></li>
<li><a href="#"><span class="icn"><img src="images/notes-icon.png" alt="icon"></span>Create Notes</a></li>
<li><a href="#"><span class="icn"><img src="images/rec-icon.png" alt="icon"></span>Recommendations</a></li>
</ul>
</div>
</div>
</div>
                               <?php
				$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
				?>
<div class="main-content-inn-left">
<div class="col-first">
<div class="two-col-post two-col-post-brdr">
<div class="user-pro-dtls">
<div class="pro-timeline"><?php if($profileinfo['bg_image']=="") {
							echo "<img src='images/paw.gif'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['bg_image'] ?>" alt="user image" />
							<?php } ?>
							
							
							</div>
							
<div class="usr-pro-img"><?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?></div>
<div class="usr-pro-dtl-r">
<h2><?= $profileinfo['pet_name']; ?></h2>
<p>Choosing a purebred is the best way to know what a dog's looks and personality might be like, but it's never...</p>
<div class="usr-anc-l">
<span>Name : <?= $profileinfo['powner_name']; ?></span>
                                    <span>DOB : <?= $profileinfo['dob']; ?></span>
<!--                                    <span>Breed : <//?= $profileinfo['breed']; ?></span>-->
</div>
<div class="usr-cnct-l"><!--<a href="#">Connect</a>--> <a href="profile-edit1.php" class="edit">Edit</a></div>
</div>
</div>

<div class="pst-hld">
<div class="divide-line">
</div>
<div class="two-col-post">
<div id="macy-container" class="macy-top">
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

</div>
<input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
</div>
</div>
</form>
</div>
</div>
<div id="loading-post"><span class="loading-post">Loading Post</span><img src="loading.gif"></div>

<?php 
$propostqry=mysqli_query($conn,"SELECT * FROM post WHERE child_post_id='$parent_id' ORDER BY id DESC LIMIT 4");
								WHILE($propost=mysqli_fetch_assoc($propostqry)) {
								?>
<div class="left item demo">
<div class="post-in-c" id="<?= $propost['id'] ?>">
<div class="post-content">
<h2><span class="user-icn-img">
<a href="#"><img src="" alt="user image"></a></span><p class="user-nm"><a href="#"><?= $profileinfo['pet_name'] ?></a></p></h2>
<h3><?= $propost['title'] ?></h3>
<p class="pst-text" id="post_desc"><?= $propost['posts'] ?></p>
<a href="<?= $propost['url'] ?>"><?= $propost['url'] ?></a>
</div>
<div class="post-image">

<?php if($propost['img_count']>0) {
												$proimages=explode(",",$propost['image']);
                                                for($i=0;$i<count($proimages);$i++) {   
											?>
<a href="aj_box.php?id=<?= $propost['id'] ?> .ajcontent" data-featherlight="ajax"><img src="<?= $proimages[$i] ?>">
												<?php } }  ?>
</div>

											<?php if($propost['vid_count']>0) {
												$provid=explode(",",$propost['video']);
												for($i=0;$i<count($provid);$i++) { 
												
												?>   
												<div class="videos">
											<video width="230" height="200" controls>
                                            <source src="<?= $provid[$i] ?>" type="video/mp4">
 
                                            </video>
											</div>
											<?php } } ?>
<!--postact-->											
											
<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$propost[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
         
		
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$propost[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												<span class="number-likes<?= $propost['id'] ?>"><?= $likenum ?></span> Likes</p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$propost[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $propost['id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $propost['id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $propost['id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $propost['id'] ?>">Share</button>
													
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$propost[id]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT pet_name FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><?= $cmntr['pet_name'].":-".$commentresult['comment'] ?></div>
													
													<?php
													}	
												}
												
												?>
												<div class="post-comment-box" id="<?= $propost['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												</div>                                     </div>

											
											
											
											
<!--postactend-->											
											
</div>
</div>

								<?php } ?>
<?php include 'shared-post-about.php'; ?>

</div>
</div>
</div>

</div>
</div>

<div class="col-second">
                        <div class="fr-list" id="friends-list">
                            <?php

$id = $_SESSION["pet_unique_id"];

$display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) {

            ?>
                            <h2 class="fr-headnig"><span class="user-icn-img">
                                        <img src="images/fr-li-icon.png" alt="user image">
                                </span><p class="user-nm">Friend List</p></h2>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
           <span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><a href="about3.php?id=<?= $row['pet_unique_id'] ?>" class="frn_profile"><?= $row['pet_name'] ?></a></span></span>
                                    </div>                                   
                                </div>                              
                            </div>
                             <?php
                            }
                        }
                        ?>
                            
                            
                        </div>

                        <div class="fr-list fr-req">
                            <h2 class="fr-headnig"><span class="user-icn-img">
                                        <img src="images/fr-req-icon.png" alt="user image">
                                </span><p class="user-nm">Friend Request</p></h2>
								<?php
								$fr_req="SELECT pet_name,email,parent_id,STATUS,child_id FROM user_inf JOIN addfriend ON addfriend.`parent_id` = user_inf.`pet_unique_id` WHERE (parent_id='$parent_id' OR child_id='$parent_id') AND(parent_id!='$parent_id') AND STATUS=1";
								$frn_req=mysqli_query($conn,$fr_req);
								WHILE($frnd_req=mysqli_fetch_assoc($frn_req)) {
								?>
								
                            <div class="fr-li-cont" id="friend-req-show">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                   
                                        <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?= $frnd_req['pet_name'] ?></span></span></a>
                                    </div>
									
                                    <div class="user-nm"><a href="#" class="frn_req_acc" id="<?=$frnd_req['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?=$frnd_req['parent_id'] ?>">Reject</a></div>
                                </div>
                                
                            </div>
								<?php } ?>
                        </div>

				<script type="text/javascript">
				$(document).ready(function() {
					$('.frn_req_acc').on('click',function(e) {
						e.preventDefault();
						var acc_id=$(this).attr('id');
						
						$.ajax({
        	        url: "friend_req_fun.php",
			type: "POST",
			data: { accept: acc_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("ACCEPTED");
			  
		      $('#friend-req-show').load(document.URL +  ' #friend-req-show');
			  $('#friends-list').load(document.URL +  ' #friends-list');
		    }        
		});
						
					}),
					
					$('.frn_req_rej').on('click',function(e) {
						e.preventDefault();
						var rej_id=$(this).attr('id');
						
						$.ajax({
        	        url: "friend_req_fun.php",
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
    $friendqry="SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
	
$friendrun=mysqli_query($conn,$friendqry);
WHILE($friendlist=mysqli_fetch_assoc($friendrun)) {
	
	
	
	
	

	?>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
									
          <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?= $friendlist['pet_name'] ?></span></span></a>
		  <input type="checkbox" class="check-share" name="<?= $friendlist['powner_name'] ?>" value="<?= $friendlist['pet_unique_id'] ?>"> 
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
$(document).ready(function() {
//$('.img-wrap img:gt(0)').hide();

$(document).on('click','#box-next',function() {

    $('.img-wrap li#media:first-child').hide().next().show().end().appendTo('.img-wrap');
});

$(document).on('click','#box-prev',function() {
    $('.img-wrap li#media:first-child').hide();
    $('.img-wrap li#media:last-child').prependTo('.img-wrap').fadeOut();
    $('.img-wrap li#media:first-child').show();
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
                    $('#loading-post').show();
                },			
			success: function(data)
		    {
	             $('#loading-post').hide();
				//$('#post-display').prepend(data);
				$('#about-load-ref').load(document.URL +  '#about-load-ref');
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
        	url: "post-functions.php",
			type: "POST",
			data: { 
			commentid: post_id , commenttext: comment_data
			},
    	    cache: false,			
			success: function(data)
		    {
	          $('#'+post_id+'.post-comment-box').hide();
			  $('#'+post_id+'.post-comment-box').parent().append("<div class='user-comments'>"+data+"</div>");
		        
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		});
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

<link rel="stylesheet" href="css/macy/macy.css">
<script src="js/macy/macy.js"></script>
    <script>
       var masonry = new Macy({
        container: '#macy-container',
        trueOrder: false,
        waitForImages: true,
        debug: true,
        margin: {
            x: 10,
            y: 10
        },
        columns: 2,
        breakAt: {
          1200: {
            columns: 5,
            margin: {
                x: 23,
                y: 4
            }
          },
          940: {
            margin: {
                y: 23
            }
          },
          520: {
            columns: 3,
            margin: 3,
          },
          400: {
            columns: 2
          }
        }
      });
    </script>


<!--share end-->
<?php require_once 'inc/footer.php';  ?>
</body>
</html>