<html>
    <?php
    session_start();
    require_once 'inc/head-content.php';
    ?>
    <body>
        <?php require_once 'inc/header.php'; ?>

        <div class="main-content user-pro-dtls-page usr-feed-page-nw">
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
                        display:none;
                        background:#fff;
                        margin-bottom: 10px;
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
                </style>
                <div class="main-content-inn-left" id="main-container">
                    <div class="col-first">
                        <div class="pst-hld">
                            <div class="divide-line">
                            </div>
                            <div class="two-col-post ">
                                <div class="stat-textarea post-f left item">
                                    <form method="post" id="business-post-form">
                                        <div class="uplbtn-btm">
                                            <?php
                                            $business_id = $_SESSION["business_uniqueid"];
                                            print_r($business_id);
                                            ?>
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
                                                    <input type="hidden" name="business_id" value="<?php $businessid; ?>">
                                                </div>
                                                <input value="Post" id="post-submit-butn" class="fl-subm" type="submit" />
                                            </div>
                                        </div>
                                    </form>       
                                </div>
                                <div id="response" class="container">
                                    <?php
                                    require './dbcon.php';
                                    $display_post = "SELECT * FROM `post` WHERE child_post_id = '$business_id' ORDER BY id DESC";
                                    $query = mysqli_query($conn, $display_post);
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        ?>


                                        <div class="one-col-post" id="<?php echo $row['id'] ?>">
                                            <div class="one-col-inn">
                                                <div class="post-in-c">
                                                    <div class="post-content">
                                                        <h2></h2>
                                                        <h3><?php echo $row['title'] ?></h3>
                                                        <span class="post-link"><a href="http://<?php echo ['url'] ?>" target="_blank"><?php echo ['url'] ?></a></span>
                                                        <p class="pst-text"><?php echo ['posts'] ?><p>
                                                    </div>


                                                    <div class="post-image post-video">
                                                        <div class="post-mul-image">
                                                            <div class="post-mul-image">

                                                                <ul id="post-media" data-count="<?php $image_count ?>">
                                                                    <?php
                                                                    if ($row['img_count'] > 0) {
                                                                        $post_images = explode(",", $row['image']);

                                                                        for ($i = 0; $i < count($post_images); $i++) {
                                                                            ?>

                                                                            <li class="pb-image-box">
                                                                                <a href="aj_box.php?id=<?php echo $row['id'] ?>&im=<?php echo $post_images[$i] ?> .ajcontent" data-featherlight="ajax">
                                                                                    <img class="photo" src="<?php echo $post_images[$i] ?>">
                                                                                </a>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                    if ($row['vid_count'] > 0) {
                                                                        $post_videos = explode(",", $row['video']);
                                                                        for ($i = 0; $i < count($post_videos); $i++) {
                                                                            ?>

                                                                            <li class="pb-image-box">
                                                                                <a href="aj_box.php?id=<?php echo $row['id'] ?>&vid=<?php echo $post_videos[$i] ?> .ajcontent" data-featherlight="ajax">
                                                                                    <video controls>
                                                                                        <source src="<?php echo $post_videos[$i] ?>" type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            </li>
                                                                       <?php }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function () {
                                                            $('video').removeAttr('autoplay');
                                                        });
                                                    </script>                                 

                                                    <div class="post-content">
                                                        
                                                        <?php
								$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$row[id]'");
								$likenum=mysqli_num_rows($likecount);
												?>
                                                       <p class="ttl-lks">
                                                           <span><?= $likenum ?>Likes</span>
                                                       </p>
                                                    </div>
                                                    <div class="post-act-btn">
                                                        <div class="post-act-ins">
                                                            <button class="post-like-button" id="<?php echo $row['id']?>">Like</button>
                                                            <button class="post-comment-btn" id="<?php echo $row['id']?>">Comment</button>
                                                            <button class="post-share-btn" id="<?php echo $row['id']?>">Share</button>
                                                        </div>

                                                        <div class="comment-head"><h3>Comments:</h3></div>
                                                          <div class="comment-area">
                                                            <div class="user-comments"><span class="user-icn-img"></span>
                                                                <div class="cmnt-text">
                                                                    <a href='#'></a>
                                                                    <span class="cmmnt-t"></span>
                                                                </div>
                                                            </div>
                                                            <div class="post-comment-box">
                                                                <textarea class='comment-box' placeholder='Enter your comments'></textarea>
                                                                <button type="button" class='comment-submit'>Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id='post_comments'>
                                                 <div class="user-comments">   
                                                  <?php
                                                    // display comments and user profile details coded start here
                                                   require './dbcon.php';
                                                   $commnets = "select * from comments join business on business.business_uniqueid = comments.commenter_unique_id where commenter_unique_id= '$business_id'";
                                                   $display_comments = mysqli_query($conn, $commnets);
                                                   while ($row = mysqli_fetch_array($display_comments)){
                                                   ?>
                                                    
                                                    <span class="user-icn-img">
                                                      <img src="1128486/profile_pic/photo-1447969025943-8219c41ea47a.jpg" alt="user image">
						    </span> 
                                                    <div class="cmnt-text">
                                                    <a href="#"><?php echo $row['company_name']?></a>
                                                    <span class="cmmnt-t"><?php echo $row['comment']?></span></div>    
                                                    <!--<span class="comments_section"><?php// echo $row['comment']?></span>-->
                                                    
                                                   <?php
                                                    }
                                                  ?>
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

                    <script>
                        $(document).ready(function () {
                            $('video').removeAttr('autoplay');
                        });
                    </script>                                 
                </div>
            </div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
                        $(document).ready(function () {
                            $("#business-post-form").on("submit", function (e) {
                                e.preventDefault();
                                $.ajax({
                                    url: "business-post.php",
                                    type: 'POST',
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function (data) {
                                        $("#response").html(data);
                                        $('#response').load(document.URL + ' #response');
                                        $('#business-post-form').load(document.URL + ' #business-post-form');
                                    }
                                });
                            });
                            
                            $(".post-like-button").on('click',function(e){
                                e.preventDefault();
                                var id = $(this).attr('id');
                                $.ajax({
                                    url: "bus_postfun.php",
                                    type: 'POST',
                                    data: {id:id},
                                    success: function(data){
                                        if($('#'+id+'.post-like-button').text()=='Like') {
				$('#'+id+'.post-like-button').text('Unlike');
			}
			else if($('#'+id+'.post-like-button').text()=='Unlike'){
				$('#'+id+'.post-like-button').text('Like');
			}
				
                                    $('#'+id+'.post-like-button').html(data);
                                    }
                                });
                            });
                        });
                        
                         $(".post-comment-box").hide()
                         $(".post-comment-btn").on('click',function(){
                               $(".post-comment-box").show(); 
                            });
                           
                        $(document).ready(function(){
                           $(document).on('click','.comment-submit',function(e){
                               e.preventDefault();
                              var post_id=$(this).parent().parent().parent().find(".post-comment-btn").attr("id");
                              console.log(post_id);
	                       var comment_data = $(this).parent().find(".comment-box").val();
                               var company=$('#'+post_id+'.one-col-post').find('.cmnt-text:first').find('a').text();
//                                console.log(comment_data);
                               $.ajax({
                                   url: "bus_postfun.php",
                                   type: "POST",
                                   data: { commentid: post_id , commenttext: comment_data },
                                   cache: false,
                                   success: function (data) {
//                                      $('#'+post_id+'.one-col-post').find('.comment-area').hide();
                                        $(".post-comment-box").hide();
                                      $('#'+post_id+'.one-col-post').find('#post_comments').append(company+data);
//                                    $('#response').load(document.URL + ' #response');
                                   }
                               });
                           }); 
                        });
        </script>
<?php require_once 'inc/footer.php'; ?>
    </body>
</html>