<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}

$parent_id = $_SESSION["pet_unique_id"];
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />	
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
</style>
    <body>
        <?php require_once 'inc/header_11.php'; ?>
        <div class="main-content user-pro-dtls-page usr-feed-page usr-feed-page-nw friend-list-page grp-mem-page m-pagelist">
            <div class="main-content-inn col-three main-content-full ">
                <div class="col-first-side">
                    <?php require_once 'inc/user_profile_sidebar.php'; ?>
                    <?php require_once 'inc/side-bar.php'; ?>
                </div>
                <div class="main-content" id="page-load-ref">
                    <div class="main-content-inn-left">
                        <div class="col-first crt-pgs">
                            <div class="fr-list" id="friends-list">
                                <div class="two-col-post">
                                    <div class="grp-top-opt">
                                        <h2 class="fr-heading">Gallery</h2>
                                        <br><br>
                                        <?php  
                                        //print_r($parent_id);
                                        require_once './dbcon.php';
                                        $gallery = "select * from post  where child_post_id = '$parent_id'";
                                        $sql = mysqli_query($conn,$gallery);
                                        $count = mysqli_num_rows($sql);
                                        while($row = mysqli_fetch_array($sql))
                                        {
                                        $explode = explode(',',$row['image']);
                                       
                                       foreach($explode as $value)
                                       {
                                      // print_r($value);
                                       ?>
                                       
                                       <a href="gallery_aj_box.php?id=<?= $row['id'] ?>&im=<?= $value ?> .ajcontent" data-featherlight="ajax">
                                        <img src='<?php echo $value ?>' width='150', height='150'>
                                       </a>
                                        <?php
                                        }
                                        }
                                        ?>
                                     </div>
                                   </div>
								   
								   
								    <div class="two-col-post">
                                    <div class="grp-top-opt">
                                        <h2 class="fr-heading">Videos</h2>
                                        <br><br>
                                        <?php  
                                        //print_r($parent_id);
                                        require_once './dbcon.php';
                                        $gallery = "select * from post  where child_post_id = '$parent_id' AND vid_count>'0'";
                                        $sql = mysqli_query($conn,$gallery);
                                        $count = mysqli_num_rows($sql);
                                        while($row = mysqli_fetch_array($sql))
                                        {
                                        $explode = explode(',',$row['video']);
                                      
                                       foreach($explode as $value)
                                       {
                                      //print_r($value);
                                       ?>
                                       
                                       <a href="gallery_aj_box.php?id=<?= $row['id'] ?>&vid=<?= $value ?> .ajcontent" data-featherlight="ajax">
                                        <video controls width="300" height="150">
<source src="<?php echo $value ?>" type="video/mp4">
</video>

                                       </a>
                                        <?php
                                        }
                                        }
                                        ?>
                                     </div>
                                   </div>
                               </div>
                            <br>
                        </div>
                        <div class="col-third   animated fadeInRight">
                            <?php require_once 'inc/ads_sidebar_d.php'; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
        <?php require_once 'inc/footer.php'; ?>
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

    </body>
</html>
