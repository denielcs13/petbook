<?php
session_start();
   
        require 'dbcon.php';
$parent_id = $_SESSION['ngo_unique_id'];
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header_11.php'; ?>
        <?php
        
        $userqry = mysqli_query($conn, "SELECT * FROM ngo_resgitration WHERE ngo_unique_id ='$parent_id'");
        $userinf = mysqli_fetch_assoc($userqry);

        $display = "SELECT * FROM post WHERE child_post_id = '$parent_id' OR child_post_id IN (SELECT group_id FROM business_like WHERE user_id =  '$parent_id' AND STATUS = '1' UNION SELECT ngo_id FROM ngo_like WHERE user_id ='$parent_id' AND STATUS = '1') AND type!='shared' ORDER BY id DESC";
		
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
                position:relative;
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
			span#form-alert {
				position:absolute;
				border:none;
				color:RED;
				
				left:40%;
			}
        </style>


        <div class="main-content user-pro-dtls-page usr-feed-page-nw about-page usr-feed-page  groups-page" id="about-load-ref">
            <div class="main-content-inn col-three main-content-full">
                <div class="col-first-side">
                    <?php require_once 'inc/ngo_profile_sidebar.php'; 
		    ?>
		  </div>
                <div class="main-content-inn-left">
                    <div class="col-first">
                        <div class="two-col-post two-col-post-brdr">
                            <div class="user-pro-dtls">
                                <div class="pro-timeline">
                                    <?php
                                    if ($userinf['bg_image'] == '') {
                                        echo "<img src='images/paw.gif'>";
                                    } else {
                                        ?>
                                        <img src="<?= $userinf['bg_image'] ?>" alt="user image" />
                                    <?php } ?>
                                </div>
 

                                <div class="usr-pro-dtl-r">
                                    <div class="usr-pro-left">
                                        <h2 class="upl-hdng">Upload Photo</h2>
                                        <div class="usr-cnct-l">
                                            <form method="post" action="ngo_postfun.php" id="image-upload-frm" enctype="multipart/form-data">
<div class="usr-cnct-l-brw">
                                                <input type="file" value="Uplaod Photo" name="bgimg"/><span class="brw-t-btn">Change Picture </span></div>
                                                <button type="submit" name="sub"><i class="fa fa-upload"></i>Upload</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="usr-pro-right">
                                        <div class="post-act-ins">
                                           
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="mem-admin-infs">
                                </div>


                            </div>

                            <div class="pst-hld">
                                <div class="divide-line">
                                </div>
                                <div class="two-col-post">
                                    <div id="" class="macy-top masonry-0l">
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
															<div class="loading-post" id="uploading-post"><img src="loadmore.gif"></div>
                                                            <input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="left item demo">
                                            <?php include 'ngo_postdata.php'; ?></div>

                                    </div>
                                </div>
                                <div class="two-col-right">
                                    
                        <?php include 'inc/pet-adopt-mate-sidebar.php'; ?>

                                </div>
                            </div>
                            <script>
                            $(".follow-like-button").on('click',function(){
                            alert($(".post-act-ins").parent().val());
                           
                           
                            });
                            </script>
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
                            <script>
                                $(document).ready(function () {
                                  //$('.img-wrap img:gt(0)').hide();
                                  $(document).on('click', '#box-next', function (e) {
                                        e.preventDefault();

                                        //$('.img-wrap div#media img.selected').hide().next().show().end().appendTo('.img-wrap');
                                        if ($('.img-wrap div#media.selected').next().is('div#media')) {
                                            $('.img-wrap div#media.selected').removeClass('selected').next().addClass('selected');
                                        }


                                    });


                                    $(document).on('click', '#box-prev', function (e) {
                                        e.preventDefault();

                                        if ($('.img-wrap div#media.selected').prev().is('div#media')) {
                                            $('.img-wrap div#media.selected').removeClass('selected').prev().addClass('selected');
                                        }
                                    });
                                });
                            </script>
                            <script type="text/javascript">
                                $(document).ready(function () {


                                    $("#profile-post-form").on('submit', (function (e) {

                                        e.preventDefault();
										if($(this).find("input[name='title']").val()=='' && $(this).find("textarea[name='description']").val()=='' && $(this).find("input[name='files[]']").val()=='') {
						 $(this).append('<span class="frmalert" id="form-alert">Your Post is Blank.Please write something or attach media</span>')
						 $(this).find('.frmalert').fadeOut(2000, function() {
        $(this).remove();
    });
						 return;
					 }
                                        $.ajax({
                                            url: "ngo_post.php",
                                            type: "POST",
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
                                        // $(this).unbind("submit");
                                        //$(this).on('submit',function(){return false;});
                                    }));
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

                        </div>
            <?php require_once 'inc/ads_sidebar_d.php'; ?>
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

<?php require_once 'inc/footer.php'; ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
            <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', '.post-share-btn', function () {
                var pid = $(this).attr('id');
                $('#myModal').show().attr("data-pid", pid);

                //$('#myModal').data("pid",pid);

            }),
                    $('.share-select-frn').on('click', function (e) {
                e.preventDefault();
                $(this).attr('id');
                $(this).parent().parent().toggleClass("marked");
                $(this).parent().parent().find('.check-share').trigger('click');
            }),
                    $('#share-modal-close').click(function () {

                $('#myModal').hide();

            });

        });
            </script>				

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#share-form").on('submit', (function (e) {

                        e.preventDefault();
                        var $form = $(this);
                        $form.find('submit').attr('disabled', true);
                        var pid = $(this).closest('.modal').attr('data-pid');
                        var fd = new FormData(this);
                        fd.append('pid', pid);

                        $.ajax({
                            url: "post-share-tst.php",
                            type: "POST",
                            data: fd,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data)
                            {
                                $('#alert-msg').html(data).show();
                                $('#alert-msg').fadeOut(10000);

                                //alert(data);
                                $('#share-form')[0].reset();
                                $('#myModal').hide();
                                $('#share-form').find('.fr-li-row').removeClass('marked');

                            },
                            error: function ()
                            {

                            }

                        });
                        return false;
                    }));
                });
            </script>	
            <script type="text/javascript">
                var fired = 0;
                $(window).scroll(function () {

                    if ($(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {

                        if ($(window).data('ajax_in_progress') === true)
                            return;

                        if (fired == 0) {
                            var last_id = $(".one-col-post:last").attr("id");
                            loadMoreData(last_id);
                       }
                        fired = 1;
                    }

                });

                function loadMoreData(last_id) {
                    $.ajax(
                            {
                                url: 'bus_loadmoredata.php?last_id=' + last_id,
                                type: "get",
                                beforeSend: function ()
                                {
                                    $('.ajax-load').show();
                                }
                            })
                            .done(function (data)
                            {
                                //alert(last_id);
                                $('.ajax-load').hide();
                                $("#post-display").append(data);
                                fired = 0;
                                if (data.length < 25) {
                                    $(window).data('ajax_in_progress', true);
                                }
                            })

                            .fail(function (jqXHR, ajaxOptions, thrownError)
                            {
                                alert('server not responding...');
                            });

                }
            </script>
            <script type="text/javascript">
             $(document).on('click', '.post-like-button', function () {
                    var post_id = $(this).attr("id");
                    $.ajax({
                        url: "ngo-post-functions.php",
                        type: "POST",
                        data: {id: post_id},
                        cache: false,
                        success: function (data)
                        {
                            var resp=data.split('|');
						
						$('#' + post_id + '.post-like-button').text(resp['0']);
						
                        $('.number-likes' + post_id).html(resp['1']);
                        $('.number-likes' + post_id).prev('#paw-likes').toggleClass('paw-like');
                            
                        },
                        error: function ()
                        {

                        }
                    });
                });
            </script>
               <script>
            $(function () {
                function callAjax() {
//        $('.post-row').load("..post-row");
                    $('.ads-arc').load(document.URL + ' .ads-arc');
                }
                setInterval(callAjax, 5000);
            });

        </script>   

            <script type="text/javascript">
               $(document).on('click', '.post-comment-btn', function () {
                $(this).parent().next().next().find('.post-comment-box').show();
               });
            </script>

            <script>
                $(document).ready(function () {
                    $(document).on('click', '.comment-submit', function () {
                        var post_id = $(this).parent().attr("id");
                        var comment_data = $(this).parent().find('.comment-box').val();
                        //alert(comment_data);

                        $.ajax({
                            url: "ngo-post-functions.php",
                            type: "POST",
                            data: {
                                commentid: post_id, commenttext: comment_data
                            },
                            cache: false,
                            success: function (data)
                            {
                                $('#' + post_id + '.post-comment-box').hide();
                                $('#' + post_id + '.one-col-post').find('.comment-area').html(data);
                                //$('#'+post_id+'.post-comment-box').parent().append("<div class='user-comments'>"+data+"</div>");

                            },
                            error: function ()
                            {

                            }
                        });
                        $(this).attr('disabled', 'disabled');
                    });
                });

            </script>	
            <script>
                $(document).ready(function () {
                    $('.one-col-post').each(function () {
                        if ($(this).find('#post-media').data('count') > 5) {
                            var elcount = $(this).find('#post-media').data('count');
                            $(this).find('#post-media').find('.pb-image-box').slice(5, elcount).hide();
                            //if($(this).find('#show-more-img').html()=='Show More') {
                            $(this).find('#post-media').append("<div class='show-more-img'><a id='show-more-img' href='#'>Show More</a></div>");
                            //}

                        }
                    });
                });
            </script>
            <script>
                $(document).on('click', '#show-more-img', function (e) {
                    e.preventDefault();
                    $(this).parent().parent().find('.pb-image-box:nth-child(6) img').click();
                });
            </script>

            <!--share end-->
    </body>
</html>