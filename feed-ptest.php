<?php
session_start();
 require 'dbcon.php';
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}
$parent_id = $_SESSION['pet_unique_id'];
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>	

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header_11.php'; ?>
        <div class="alert-area">
            <div class="alert-row" id="alert-msg"></div>
        </div>
        <?php

       
        $userqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $userinfo = mysqli_fetch_assoc($userqry);

       /*  $display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.video,post.vid_count,post.wall_post_id,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND (post.wall_post_id='0' OR post.wall_post_id='$parent_id') AND addfriend.status>'0' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.video,post.vid_count,post.wall_post_id,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND (post.wall_post_id='0' OR post.wall_post_id='$parent_id') AND addfriend.status>'0') AS u ORDER BY u.id DESC LIMIT 3"; */
		
		$display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.video,post.vid_count,post.wall_post_id,post.type,post.share_with,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND (post.wall_post_id='0' OR post.wall_post_id='$parent_id') AND (post.type='' OR post.share_with='$parent_id') AND addfriend.status>'0' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.video,post.vid_count,post.wall_post_id,post.type,post.share_with,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND (post.wall_post_id='0' OR post.wall_post_id='$parent_id') AND (post.type='' OR post.share_with='$parent_id') AND addfriend.status>'0') AS u ORDER BY u.id DESC LIMIT 3";
        
        $disprun = mysqli_query($conn, $display); 
        ?>

        <style>

            .upload-img-button {

                display: inline-block;
                position: relative;
                color:#fff;
                opacity: 1;
                height: auto;
                width: auto;
                border: 0;
                background: #2c86bf;
                padding: 10px 15px;
                text-transform: capitalize;

            }
            textarea.comment-box {
                width: 100%;
                height: 14%;
            }
            .check-share {
                display:none;
            }
            .marked{
                background-color:rgba(158, 191, 44, 0.55);
                color:#000000;
                font-weight:500;
            }

            .user-nm a {
                float:left;
                margin-left:4px;
            }
            #paw-likes.fa-paw {
                font-size:18px;
                padding:9px;
            }
            .paw-like {
                color:#2c86bf;
            }
            #myModal .fr-li-cont {
                height:60%;
            }
            #myModal .modal-body {
                overflow-y:auto;
            }
            .share-time, .post-time {
                float:right;
            }
            span.post-link {
                float:right;
            }
            .many_images {
                display: table-cell;
                /* height: 50%; 
                width: 35%;*/
            }
            .postm_images {
                height: 27%;
                display: inline-table;
                width: 24%;		
            }	
            #filediv0, #filediv1, #filediv2, #filediv3 {
                width:80%;
                float:left;
            }
            .frn_req_acc, .frn_req_rej {
                float:left;
            }

            .display_videos {
                display:inline-block;
            }
            #loading-post {

                background:#fff;
                margin-bottom: 10px;
            }
            #loading-post img {

                margin-left: 35%;
            }
            .loading-post {
                
                position:relative;
                left: 6%;
                display:none;
            }	
            .show-more-img {
                position: relative;
                top: 88px;

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
            .fbphotobox img {
                max-height: 220px;
                height: 220px;

            }
            .post-in-c video {
                height:220px;
            }
            .sharer-post {
                color:#2c86bf;
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
            .post-image img {
                height:250px;
                object-fit:cover;
            }
            .img-wrap #media video {
                height:340px;
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
			.wall-post-ttl {
				    
              position: relative;
			  bottom: 8px;
			}
			.dismiss-ps {
				font-size:18px;
				color:#ff8500;
				float:right;
			}
			span#form-alert {
				position:absolute;
				border:none;
				color:RED;
				
				left:40%;
			}
        </style> 

        <?php
        $profileqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo = mysqli_fetch_assoc($profileqry);
        ?>
        <div class="main-content" id="page-load-ref">

            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw usr-feed-pge-new">
                <div class="col-first-side">
                    <?php require_once 'inc/user_profile_sidebar.php'; ?>
                    <?php require_once 'inc/side-bar-new.php'; ?>
                </div>
                <div class="main-content-inn-left" >
                    <div class="col-first" id="load-post-ref">
                        <div class="stat-textarea post-f">
                            <form method="post" id="profile-post-form">
                                <div class="uplbtn-btm">
                                    <h2 class="p-hdng"><span class="p-fsp-img"><img src="images/share-act-img.png" /></span> <span class="p-fsp-t">Share your new activity</span></h2>
                                    <div class="upl-btm-text"><input name="title" placeholder="Experience" type="text"></div>
                                    <div class="upl-btm-text"><textarea name="description" placeholder="Share your pets"></textarea></div>
                                </div>
                                <div class="upload-btn uplbtn-top uplbtn-btm-t">
                                    <div class="upload-btn-hld">
                                        <input name="post-url" placeholder="Type your URL" class="typ-t" type="text">
                                    </div>
                                    <div class="upload-btn-hld upload-btn-hld-top">
                                        <div class="upload-btn-inhld" id="upload-post-img">

                                            <input name="files[]" value="upload" class="fl-img" type="file" multiple>

                                        </div>
										<div class="loading-post" id="uploading-post"><img src="loadmore.gif"></div>
                                        <input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
                                    </div>
                                </div>
                            </form>

                        </div>
                        <?php include 'page_share_disp.php'; ?>
                        <div id="post-display">
                            <div class="container" id="posts-container">
							
                               
                                <?php include 'get_post_data.php'; ?>
								
								</div>
                        </div>
                        <div class="ajax-load text-center" style="display:none">
                            <p><img src="images/loader.gif">Loading More post</p>
                        </div>

                        <script>
                            $(document).ajaxComplete(function () {
                                var img = $('#imurl').text();
                                var vid = $('#vidurl').text();

                                if (img != '') {
                                    $('#box-image-disp div').find('img[src$="' + img + '"]').parent().addClass('selected');
                                }
                                if (vid != '') {
                                    //alert($('#box-image-disp div').find('video source[src$="'+vid+'"]').attr('src'));
                                    $('#box-image-disp div').find('video source[src$="' + vid + '"]').parent().parent().addClass('selected');
                                }


                            });
                        </script>
                 <script type="text/javascript">
                   $("#profile-post-form").on("submit",function(e){
                     e.preventDefault();
 if($(this).find("input[name='title']").val()=='' && $(this).find("textarea[name='description']").val()=='' && $(this).find("input[name='files[]']").val()=='') {
						 $(this).append('<span class="frmalert" id="form-alert">Your Post is Blank.Please write something or attach media</span>')
						 $(this).find('.frmalert').fadeOut(1500, function() {
        $(this).remove();
    });
						 return;
					 }
                     $.ajax({
                     
                     url:"save-post.php",
                     type:"POST",
                     data: new FormData(this),
                     contentType: false,
                     cache: false,
                     processData: false,
                     beforeSend: function ()
                     {
                     $('#uploading-post').show();
                     },
                      success: function (data)
                       {
                       console.log(data);
                       $('#uploading-post').hide();
                        //$('#post-display').prepend(data);
                       //$('#page-load-ref').load(document.URL +  '#page-load-ref');
                       location.reload();
                       $('#profile-post-form')[0].reset();
                       $('#post-submit-btn').removeAttr('disabled');
                       },
                       error: function ()
                       {

                       }
                     }); 
                      $(this).find(':submit').attr('disabled', 'disabled');               
                   });
                </script>
                
                        <script>
                         
//$('.img-wrap img:gt(0)').hide();

                                $(document).on('click', '#box-next', function (e) {
                                    e.preventDefault();

                                    //$('.img-wrap div#media img.selected').hide().next().show().end().appendTo('.img-wrap');
                                    if ($('.img-wrap div#media.selected').next().is('div#media')) {
                                        $('.img-wrap div#media.selected').removeClass('selected').next().addClass('selected');
										var imm=$('.img-wrap div#media.selected').find('img').attr('src');
										$('.fb-xfbml-parse-ignore').attr('href','https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fpetbooqtesting.com%2Fpetbooq.com%2F'+imm+'&amp;src=sdkpreparse');
                                    }
									
                                });


                                $(document).on('click', '#box-prev', function (e) {
                                    e.preventDefault();

                                    if ($('.img-wrap div#media.selected').prev().is('div#media')) {
                                        $('.img-wrap div#media.selected').removeClass('selected').prev().addClass('selected');
										var imm=$('.img-wrap div#media.selected').find('img').attr('src');
										$('.fb-xfbml-parse-ignore').attr('href','https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fpetbooqtesting.com%2Fpetbooq.com%2F'+imm+'&amp;src=sdkpreparse');
                                    }
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
                        				
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
                        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
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
                        <!--share end-->
                    </div>
                    <div class="col-third   animated fadeInRight">
					
                        <div class="ltst-arc">
                        <div class="ltst-arc-inn">
						<div class="fr-list" id="friends-list">
                            

                               <h2 class="fr-headnig">
	<div class="fr-headnig-l">
	<span class="user-icn-img">
	<a href="friend-list.php">
	<!-- <div class="plus-i"><img src="images/pet-mate-icon.png" alt=""></div> -->
	<p class="user-nm">Friend List</p>
	</a>
	</span>
	</div>
	</h2>
                            <?php
                            session_start();
//print_r($_SESSION["pet_unique_id"]);die;
                            $id = $_SESSION["pet_unique_id"];

//$display2="SELECT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id='$parent_id'";
//$display2="SELECT * FROM  `addfriend` JOIN user_inf ON user_inf.pet_unique_id = addfriend.child_id WHERE STATUS =2 AND parent_id ='$parent_id'";
//$display2 = "SELECT DISTINCT * FROM user_inf JOIN addfriend ON addfriend.child_id = user_inf.pet_unique_id WHERE ( addfriend.child_id !='$parent_id' OR addfriend.child_id //t_id')AND (addfriend.status =2) AND addfriend.parent_id ='$parent_id'";
                            $display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1' LIMIT 5";
                            $show_result = mysqli_query($conn, $display2);
                            if (mysqli_num_rows($show_result)) {
                                ?>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                    ?>
                                    <div class="fr-li-cont">
                                        <div class="fr-li-row">
                                            <div class="fr-t-l">
                                                <?php
                                                if (isset($row['profile_pic']) && !empty($row['profile_pic'])) {
echo "<span class='user-icn-img'><img src='" . $row['profile_pic'] . "' alt='user image'><span class='fr-nm'><a href='about-fr.php?id=" . $row['pet_unique_id'] . "' class='frn_profile'>" . $row['pet_name'] . "</a></span></span>";
                                                } else {
                                                    echo "<span class='user-icn-img'><img src='images/pet-icon.png' alt='user image'><span class='fr-nm'><a href='about-fr.php?id=" . $row['pet_unique_id'] . "' class='frn_profile'>" . $row['pet_name'] . "</a></span></span>";
                                                }
                                                ?>
                                            </div>                                   
                                        </div>                              
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
						<div class="fr-list fr-req">
                            

<h2 class="fr-headnig">
	<div class="fr-headnig-l">
	<span class="user-icn-img">
	<a href="javascript:">
	<!-- <div class="plus-i"><img src="images/pet-mate-icon.png" alt=""></div> -->
	<p class="user-nm">Friend Request</p>
	</a>
	</span>
	</div>
	</h2>

                            <?php
//$fr_req="SELECT * FROM addfriend WHERE child_id='$parent_id' AND status='0'";
                            $fr_req = "SELECT pet_name,email,profile_pic,parent_id,addfriend.status,child_id FROM user_inf JOIN addfriend ON addfriend.parent_id = user_inf.pet_unique_id WHERE child_id='$parent_id' AND parent_id!='$parent_id' AND addfriend.status=1 LIMIT 5";
                            $frn_req = mysqli_query($conn, $fr_req);
//print_r($fr_req);die;
                            WHILE ($frnd_req = mysqli_fetch_assoc($frn_req)) {
                                //$frnd_inf=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$frnd_req[parent_id]'");
                                //$frnd_info=mysqli_fetch_assoc($frnd_inf);
                                ?>
                                <div class="fr-li-cont" id="friend-req-show">
                                    <div class="fr-li-row">
                                        <div class="fr-t-l">
                                            <a href="about-fr.php?id=<?= $frnd_req['parent_id'] ?>"><span class="user-icn-img"><?php
    if ($frnd_req['profile_pic'] == "") {
        echo "<img src='images/fr-pro-big-img.jpg'>";
    } else {
        ?>
                                <img src="<?= $frnd_req['profile_pic'] ?>" alt="user image" />
                            <?php } ?><span class="fr-nm"><?= $frnd_req['pet_name'] ?></span></span></a>
                                        </div>
                                        <div class="user-nm"><a href="#" class="frn_req_acc" id="<?= $frnd_req['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?= $frnd_req['parent_id'] ?>">Reject</a></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="ads-arc fr-list">
                            <h2 class="fr-headnig">
	<div class="fr-headnig-l">
	<span class="user-icn-img">
	<a href="javascript:">
	<!-- <div class="plus-i"><img src="images/spn-ads-img.png" alt=""></div> -->
	<p class="user-nm">Sponsored Ads</p>
	                     </a>
	                     </span>
	                     </div>
	                     </h2>
                            <?php
                             $ip_addr=$_SERVER['REMOTE_ADDR'];
			     $qry=file_get_contents('http://freegeoip.net/json/'.$ip_addr);
			     $res=json_decode($qry);
		             $country = $res->country_name;
                            require './dbcon.php';
                            $display_banner = "select * from ads where country = '$country' ORDER BY RAND() LIMIT 3";
                            $results = mysqli_query($conn, $display_banner);
                            while ($row = mysqli_fetch_array($results)) {
                                $description = $row["description"];
                                $link = $row["link"];
                                ?>
                                <div class="post-row ads-arc">
                                <a href="<?php echo $row["link"]?>" target="_blank">
                                    <div class="post-rw-hld">
                                        <div class="post-img"><img src="<?php echo $row["banner_image"] ?>" alt=""></div>
                                        <div class="post-content">
                                            <h2><p class="user-nm"><a href="#"><?php echo $row["heading"] ?></a></p></h2>
                                            <p class="pst-text"><?php echo substr($description, 0, 100) ?></p>
                                        </div>
                                    </div>
                                   </a> 
                                </div>
                                <?php
                            }
                            ?>
                           
                        </div>
                        </div>
                        </div>
                    </div>
                     <script>
                        function loadlink(){
                        $('.ads-arc').load(document.URL + ' .ads-arc');
                         }

                        loadlink(); 
                        setInterval(function(){
                        loadlink() 
                        }, 120000);
                        </script>                     



                    <script type="text/javascript">
                    var jQuery = $; 
                    //jQuery.noConflict();
                        var fired = 0;

                        jQuery(window).scroll(function () {

                            if (jQuery(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {

                                if (jQuery(window).data('ajax_in_progress') === true)
                                    return;

                                if (fired == 0) {
                                    var last_id = $(".one-col-post:last").attr("id");
                                    loadMoreData(last_id);

                                }
                                fired = 1;
                            }

                        });

                        function loadMoreData(last_id) {
                            jQuery.ajax(
                                    {
                                        url: 'loadmoredata.php?last_id=' + last_id,
                                        type: "get",
                                        beforeSend: function ()
                                        {
                                            $('.ajax-load').show();
                                        }

                                    })
                                    .done(function (data)
                                    {

                                        //alert(last_id);
                                        jQuery('.ajax-load').hide();
                                        jQuery("#post-display").append(data);
                                        fired = 0;
                                        if (data.length < 25) {
                                            jQuery(window).data('ajax_in_progress', true);
                                        }
                                    })

                                    .fail(function (jqXHR, ajaxOptions, thrownError)
                                    {
                                        alert('server not responding...');
                                    });

                        }
                    </script>
                    <div class="col-second">
				<!--pet mate and adopt -->
                                <?php require_once 'inc/pet-adopt-mate-sidebar.php'; ?>                      
                        

 


                        <script type="text/javascript">
                        var jQuery =$;
                        //jQuery.noConflict();
                            jQuery(document).ready(function () {
                                jQuery('.frn_req_acc').on('click', function (e) {
                                    e.preventDefault();
                                    var acc_id = jQuery(this).attr('id');

                                    jQuery.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {accept: acc_id},
                                        cache: false,
                                        success: function (data) {

                                            jQuery('#' + acc_id + '.frn_req_acc').parent().html("ACCEPTED");
                                            jQuery('#friend-req-show').load(document.URL + ' #friend-req-show');
                                            jQuery('#friends-list').load(document.URL + ' #friends-list');
                                        }
                                    });
                                }),
                                        jQuery('.frn_req_rej').on('click', function (e) {
                                    e.preventDefault();
                                    var rej_id = $(this).attr('id');
                                    jQuery.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {reject: rej_id},
                                        cache: false,
                                        success: function (data) {
                                            jQuery('#' + rej_id + '.frn_req_rej').parent().html("REJECTED");
                                            jQuery('#friend-req-show').load(document.URL + ' #friend-req-show');
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>





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
       var jQuery = $;
            jQuery(document).ready(function () {
				jQuery(document).ajaxComplete(function () {
                jQuery('.one-col-post').each(function () {
                    if (jQuery(this).find('#post-media').data('count') > 5) {
                        var elcount = jQuery(this).find('#post-media').data('count');
                        jQuery(this).find('#post-media').find('.pb-image-box').slice(5, elcount).hide();
                        if($(this).find('#show-more-img').length==0) {
                        jQuery(this).find('#post-media').append("<div class='show-more-img'><a id='show-more-img' href='#'>Show More</a></div>");
                        }
                    }
                });
				});
								
            });
			jQuery(document).one('ready',function () {
			jQuery('.one-col-post').each(function () {
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
		
         
        <?php require_once 'inc/footer.php'; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
    </body>

</html>
