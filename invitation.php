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
if(isset($_GET['id'])) {
	$profile_uid=$_GET['id'];
}
if(!(isset($_SESSION['pet_unique_id'])) && !(isset($_SESSION['business_unique_id'])) && !(isset($_SESSION['ngo_unique_id']))) {
header('Location:index.php');
}
?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header_11.php';  ?>
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
        </style> 

        <?php
        $profileqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo = mysqli_fetch_assoc($profileqry);
        ?>
        <div class="main-content" id="page-load-ref">

            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw usr-feed-pge-new invite-page">
                <div class="col-first-side">
                    <?php require_once 'inc/user_profile_sidebar.php'; ?>
                    <?php require_once 'inc/side-bar-new.php'; ?>
                </div>

<?php
$pet_id = $_SESSION['pet_unique_id'];
$error_invite = $error_invite_from="";
if($_POST["btn-invitation"])
{
         //print_r($_POST);
	$email = $_POST["invitation"];
        $f_email=$_POST['sender'];
        if(empty($_POST['invitation']))
	{
	$error_invite = "Enter email";
	}
        if(empty($_POST['sender']))
	{
	$error_invite_from = "Please Enter Email";
	}
	else{
          require './dbcon.php';
          $email_user = "select * from user_inf where pet_unique_id = '$pet_id'";
          $sql = mysqli_query($conn,$email_user);
          $results = mysqli_fetch_assoc($sql);
          foreach($email as $emails){
          
         // $to = $emails;
        //  $subject = "Petbooq Invitation";
       //   $txt = "<a href=\"http://petbooq.com/registration.php?id=" . urlencode($pet_id) . "\">Invitation link</a>";
          
       //   $headers  = 'MIME-Version: 1.0' . "\r\n";
       //   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           $to = $emails;
           $subject='Petbooq Invitation ';
           $message="<body style='width:100%;background-color:#b5b5b5;margin:0;padding:0;'>
<div style='width: 680px;margin:0 auto;font-family:arial;box-sizing: border-box;'>
<div style='width:100%;background-color:#fff;padding: 15px;box-sizing: border-box;border: 20px solid #b5b5b5;box-sizing: border-box;'>
<div style='display:inline-block;width:100%;box-sizing:border-box;border-bottom:1px solid #ccccce;margin-bottom: 12px;'>
<div style='float:left;'><img src='http://petbooq.com/images/logo.jpg'/></div>
<div style='float:right;'>
<a href='http://www.petbooq.com' style='display:inline-block;margin-top:15px;text-decoration:none;color:#000;font-size:13px;text-transform:uppercase;font-weight:bold;'>petbooq.com</a>
</div>
</div>
<div style='display:inline-block;width:100%;text-align:center;'>
<div style='float:left;width:100%;'><img src='http://petbooq.com/images/invite-mailer-banner.jpg' style=''/></div>
</div>
<div style='width:100%;display:inline-block;'>
<div style='display:inline-block;padding: 0px;width:100%;background:#fff;margin-bottom:0px;box-sizing: border-box;'>
<div style='display:inline-block;width:100%;box-sizing:border-box;padding: 0 150px'>
<div style='display:inline-block;width:100%;font-size:17px;color:#6e6f73;line-height:34px;font-weight:bold;margin-top:10px;'>
You recently registred for Petbooq.$owner_name
</div>
<p style='display:inline-block;width:100%;font-size:12px;color:#6e6f73;line-height: 25px;margin: 10px 0 15px;'>
To complete your petbooq regisitration enter your OTP.
</p>
<p style='display:inline-block;width:100%;font-size: 12px;color:#6e6f73;line-height:25px;margin: 0px 0 15px;'>
<div style='color: #6e6f73;'>Thanks</div>
<div style='color: #6e6f73;'>The Petbooq Team.</div>
</p>
<div style='display:inline-block;width:100%;'>
<a href=\"http://petbooq.com/registration.php?id=" . urlencode($pet_id) . "\" style='display:inline-block;width:100%;padding:5px 0;background-color:#6d6e72;color:#fff;text-transform:uppercase;font-size:23px;text-decoration:none;text-align:center;font-weight:bold;'>Invitation link</a>
</div>
</div>
</div>
</div>
<div style='display:inline-block;width:100%;border-top:1px solid #ccc;padding-top:15px;margin-top:15px;'>
<div style='float:left;'>
<a href='http://www.petbooq.com' style='display:inline-block;font-size:12px;text-decoration:none;color:#000;'>petbooq.com</a>
<span style='display:inline-block;margin: 0 5px;font-size:12px;color:#000;'>|</span>
<a href='mailto:pets@petbooq.com' style='display:inline-block;font-size:12px;text-decoration:none;color:#000;'>pets@petbooq.com  </a>
</div>
<div style='float:right;'>
<ul style='display:inline-block;padding: 0px;width:100%;margin:0;'>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.facebook.com/petbooq'><img src='http://petbooq.com/images/social-icon1.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.instagram.com/petbooq/'><img src='http://petbooq.com/images/social-icon2.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://twitter.com/petbooq'><img src='http://petbooq.com/images/social-icon3.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://in.pinterest.com/petbooq/'><img src='http://petbooq.com/images/social-icon4.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://plus.google.com/u/1/113913416342083840664'><img src='http://petbooq.com/images/social-icon5.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.tumblr.com/blog/petbooq1'><img src='http://petbooq.com/images/social-icon6.png' style=''/></a></li>
</ul>
</div>
</div>
</div>
</div>
</body>";
           $headers  = 'MIME-Version: 1.0' . "\r\n";
           $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           //$headers .= 'From:'.$results['email'] . "\r\n";
           $headers .= 'From:'.$_POST['sender'] . "\r\n";
           mail($to,$subject,$message,$headers);
          echo "<script>alert('Send mail sucessfully')</script>";
          echo "<script>window.location='feed-page-copy.php'</script>";
    }
  }
}
?>
<div class="main-content-inn-left">
<div class="">
<div class="col-first">
<div class="main-content-ins">
<div class="mailer-image-s">
<div class="mailer-image-l"><h4>Email Picture One</h4><div class="mailer-image"><img src="images/mailer1-img.jpg" alt=""></div></div>
<div class="mailer-image-r"><h4>Email Picture Two</h4><div class="mailer-image"><img src="images/mailer1-img.jpg" alt=""></div></div>
</div>
<div class="inv-t-hd">
<p>Welcome on PetbooQ, What are you waiting for?<br> Invite your friends.</p>
</div>
<div class="col-r">
<div class="pro-right-sec">
<!-- <div class="form-ri-img"><img src="images/form-l-img.jpg" alt=""></div> -->
<div class="sidebar">
<!-- <h3>Add Friends</h3> -->
<?php
//print_r($_SESSION['pet_unique_id']);
?>
<form method="post">
<div class="iv-f-row">
<div class="iv-f-l"><input type="radio" name="select mailer" /> <span>Choose the mailer</span></div>
<div class="iv-f-r"><input type="radio" name="select mailer" /> <span>Choose the mailer</span></div>
</div>

<div class="iv-f-row-btm">
    <div class="iv-f-row-top"><label>From</label> 
<div class="form-row">
<input type="text" name="sender" id="sender"/>
<?php
if (empty($_POST["sender"])) {
    echo "<p style='color:red'>" . $error_invite_from . "</p>";
}
?>
</div>

</div>
<div class="iv-f-row-t-btm"><label>Invite</label> 
<div class="mul-inps" >
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<div class="form-row"><input type="text" name="invitation[]" /></div>
<?php
if (empty($_POST["invitation"])) {
    echo "<p style='color:red'>" . $error_invite . "</p>";
}
?>
</div>
</div>
</div>
<div class="iv-f-btn">
<input type="submit" name="btn-invitation">
</div>
</form>
</div>
</div>
</div>

</div>
</div>
<div class="col-third   animated fadeInRight">
	                <div class="ltst-arc">
                        <div class="ltst-arc-inn">
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
<script type="text/javascript">
                            function validate()
                            {
                                var petname = document.getElementById("sender");
                                if (petname.value == "")
                                {
                                    alert("Enter email");
                                    return false;
                                }
                            }
                                
</script>
<?php require_once 'inc/footer.php';  ?>
</body>
</html>