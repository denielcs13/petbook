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
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
<div class="alert-area">
            <div class="alert-row" id="alert-msg"></div>
        </div>
    <?php
    	
        require 'dbcon.php';

        $display = "SELECT * FROM post WHERE id='$_GET[pid]'";
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
				height:250px;
			}
			
			
			#loading-post img {

	margin-left: 35%;
}
.check-share {
                display:none;
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

.load-more-btn {
	background: #fff;
    border-radius: 7px;
    padding: 4px;
	color:#ff8500;
}
ul.photo-album li,ul.video-album li {
    width: 33%;
    padding: 5px;
	float:left;
}
ul.photo-album li img,.post-in-c ul.video-album li video {
	height:30%;
}
        </style>


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page show-post" id="about-load-ref">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side">
<?php require_once 'inc/user_profile_sidebar.php'; ?>
<?php require_once 'inc/side-bar.php'; ?>
<?php require_once 'inc/rehome-a-pet-side-bar.php'; ?>    
</div>
                               <?php
							   
				 $postres=mysqli_fetch_assoc($disprun);
				
				$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
				$par_name=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic,'user_inf' as source FROM user_inf WHERE pet_unique_id='$postres[child_post_id]' UNION SELECT company_name,business_uniqueid,profile_image,'business' as source FROM business WHERE business_uniqueid='$postres[child_post_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image,'ngo_resgitration' as source FROM ngo_resgitration WHERE ngo_unique_id='$postres[child_post_id]'");
								$pname_res=mysqli_fetch_assoc($par_name);
								$imcount=$postres['img_count'] + $postres['vid_count'];
				?>
<div class="main-content-inn-left">
<div class="col-first">
<div class="post-in-c">
<ul class="photo-album">
<h3 style="font-size: 16px;padding: 6px 0 10px;">Your Images</h3>
<?php

$impath=$parent_id."/post_images/*.*";
$files = glob($impath);

for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array('gif','jpg','jpeg','png');

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
		  if (in_array($ext, $supported_file)) {
			  
            $pidqry=mysqli_query($conn,"SELECT * FROM post WHERE image LIKE '%$image%' AND type!='shared'");
			$postid=mysqli_fetch_assoc($pidqry);
			$pid=$postid['id'];
			?>
			<li id="postim<?= $pid ?>"> 
<div class="two-col-post">
			<a href="aj_photo.php?id=<?= $pid ?>&im=<?= $image ?> .ajcontent" data-featherlight="ajax">
			<img src="<?= $image ?>">
			</a>
			
			</div>
</li>

            <?php } else {
                continue;
            }
          }
?>

</ul>

<ul class="video-album">
<h3 style="font-size: 16px;padding: 6px 0 10px;">Your Videos</h3>
<?php

$vidpath=$parent_id."/Videos/*.*";
$vfiles = glob($vidpath);

for ($i=0; $i<count($vfiles); $i++)
      {
        $video = $vfiles[$i];
        $supported_file = array('mp4','avi','mov','flv');

         $ext = strtolower(pathinfo($video, PATHINFO_EXTENSION));
		  if (in_array($ext, $supported_file)) {
			  
            $pidqry=mysqli_query($conn,"SELECT * FROM post WHERE video LIKE '%$video%' AND type!='shared'");
			$postid=mysqli_fetch_assoc($pidqry);
			$pid=$postid['id'];
			?>
			<li id="postvid<?= $pid ?>"> 
<div class="two-col-post">
			<a href="aj_photo.php?id=<?= $pid ?>&vid=<?= $video ?> .ajcontent" data-featherlight="ajax">
			
			<video controls><source src="<?= $video ?>"></video>
			
			</a>
			
			</div>
</li>

            <?php } else {
                continue;
            }
          }
?>
</ul>
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
                                                $friendqry = "SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.powner_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";

                                                $friendrun = mysqli_query($conn, $friendqry);
                                                WHILE ($friendlist = mysqli_fetch_assoc($friendrun)) {
                                                    ?>
                                                    <div class="fr-li-row">
                                                        <div class="fr-t-l">

                                                            <a href="#"><span class="user-icn-img">
                                                                    <?php
                                                                    if ($friendlist['profile_pic'] == "") {
                                                                        echo "<img src='images/pet-icon.png' alt='user image'>";
                                                                    } else {
                                                                        ?>
                                                                        <img src="<?= $friendlist['profile_pic'] ?>" alt="user image" />
                                                                    <?php } ?>
                                                                    <span class="fr-nm"><?= $friendlist['pet_name'] ?></span></span></a>
                                                            <input type="checkbox" class="check-share" name="<?= $friendlist['powner_name'] ?>" value="<?= 
                                                                 $friendlist['pet_unique_id'] ?>"> 
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
<div class="col-second col-second-right">
                        
						
						<?php require_once 'inc/ads_sidebar_d.php'; ?>

				
                          
                        
                    </div>
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
        var jQuery = $;
         //jQuery.noConflict();
            jQuery(document).on('click', '.post-like-button', function () {
                var post_id = $(this).attr("id");
                jQuery.ajax({
                    url: "post-functions.php",
                    type: "POST",
                    data: {id: post_id},
                    cache: false,
                    success: function (data)
                    {

                        var resp=data.split('|');
						
						jQuery('#' + post_id + '.post-like-button').text(resp['0']);
						
                        jQuery('.number-likes' + post_id).html(resp['1']);
                        jQuery('.number-likes' + post_id).prev('#paw-likes').toggleClass('paw-like');
                    },
                    error: function ()
                    {

                    }
                });
            });
        </script>
    
   
        <script>
        
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
			  $('#'+post_id+'.one-col-post').find('.comment-area').html(data);
			  //$('#'+post_id+'.post-comment-box').parent().append("<div class='user-comments'>"+data+"</div>");
		      
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		});
		$(this).attr( 'disabled','disabled' );
 });

        </script> 
        <script type="text/javascript">
         $(document).on('click', '.post-comment-btn', function () {
         //alert();
               $(this).parent().next().next().find('.post-comment-box').show();
            });
        </script>
		
<script>

$(document).on('click', '#next-img-post', function () {
var pid=$(this).closest('.one-col-post').attr('id');

//$(this).closest('.featherlight-close').trigger('click');
$('li#postim'+pid).next().find('a').trigger('click');
});

</script>
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
	         
			  $('#'+postid+'.one-col-post').find('.comment-area').html(data);
			
		      
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		});
		});
		</script>
<script type="text/javascript">
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
<?php require_once 'inc/footer.php';  ?>
</body>
</html>