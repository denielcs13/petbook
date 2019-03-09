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
if(!(isset($_SESSION['pet_unique_id'])) && !(isset($_SESSION['business_unique_id'])) && !(isset($_SESSION['ngo_unique_id']))) {
header('Location:index.php');
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />	
<style>
.notif-all {
	height:11%;
	padding:10px;
	
}
.notif-all:hover {
	background:#0037ff17;
}
.notif-all-area {
	height: 100%;
    padding: 6px;
}
.notif-all-area .post-thumb {
	margin: 0px;
    padding: 0px;
    border-width: 0px;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% auto;
    background-color: black;
}
.notif-all-area .notif-content {
	height: 100%;
    padding: 4px;
}

.notif-all p {
font-size:13px;
font-weight:600;
padding:7px;
vertical-align: middle;
}
.load-more-img {
	display:none;
}
</style>
    <body>
        <?php require_once 'inc/header_11.php'; ?>
        
       
        <div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page usr-feed-page grp-mem-page grp-mem-listing-page m-pagelist">
            <div class="main-content-inn col-three main-content-full">
                    
               
               


                <div class="main-content" id="page-load-ref">
				<div class="col-first-side">       
				
                <?php 
				if ((isset($_SESSION['pet_unique_id']))) {   
				require_once 'inc/user_profile_sidebar.php';
				require_once 'inc/side-bar.php';
				require_once 'inc/rehome-a-pet-side-bar.php';
				
				}
                if ((isset($_SESSION['business_unique_id']))) {   
				require_once 'inc/business_profile_sidebar.php';
				require_once 'inc/side-bar.php';
				require_once 'inc/rehome-a-pet-side-bar.php';
				}
                if ((isset($_SESSION['ngo_unique_id']))) {   
				require_once 'inc/ngo_profile_sidebar.php';
				}


				?>   
				
                
                </div>
					<div class="main-content-inn-left">
                    <div class="col-first crt-pgs">
								
								
								<div class="fr-list" id="user-groups">
								
								<div class="two-col-post" id="col-notifications">
                                 <h2>Notifications</h2>
								 
<?php 
$serialnum=1;
//mysqli_query($conn,"SET @count:=0");
$notqry=mysqli_query($conn,"SELECT b.id AS tid,liker_unique_id,title,a.id,a.image,b.time,'likes' AS source FROM post a,likes b WHERE a.child_post_id='$parent_id' AND a.id=b.post_id AND liker_unique_id!='$parent_id'
UNION
SELECT c.id AS tid,commenter_unique_id,comment,a.id,a.image,c.time,'comments' AS source FROM post a,comments c WHERE a.child_post_id='$parent_id' AND a.id=c.post_id AND commenter_unique_id!='$parent_id'
UNION 
SELECT id AS tid,child_post_id,title,id,image,time,'post' AS source FROM post WHERE share_with='$parent_id'
UNION
SELECT gu.group_user_id AS tid,g.user_id_fk,g.group_name,gu.group_id_fk,g.gr_profile_pic,gu.time,'group_users' AS source FROM group_users gu,groups g WHERE gu.user_id_fk='$parent_id' AND gu.status='0' AND g.group_id=gu.group_id_fk
UNION
SELECT eu.event_user_id AS tid,e.user_id_fk,e.event_name,eu.event_id_fk,e.e_profile_pic,eu.time,'event_users' AS source FROM event_users eu,events e WHERE eu.user_id_fk='$parent_id' AND eu.status='0' AND e.event_id=eu.event_id_fk 
ORDER BY time DESC LIMIT 10");


WHILE($not=mysqli_fetch_assoc($notqry)) {
	
	$pnameqry=mysqli_query($conn,"SELECT pet_name,profile_pic,pet_unique_id FROM user_inf WHERE pet_unique_id='$not[liker_unique_id]' UNION SELECT company_name,profile_image,business_uniqueid FROM business WHERE business_uniqueid='$not[liker_unique_id]' UNION SELECT ngo_name,profile_image,ngo_unique_id FROM ngo_resgitration WHERE ngo_unique_id='$not[liker_unique_id]'");
$pname=mysqli_fetch_assoc($pnameqry);
$post_thumb=$pname['profile_pic'];
	?>
	
	<?php if($not['source']=='likes'||'comments'||'post') { ?>
	<a class="notification-links" id="<?= $serialnum ?>" href="show-post.php?pid=<?= $not['id'] ?>">
	<?php } if($not['source']=='group_users') { ?>
	<a class="notification-links" href="group-lists.php">
	<?php } if($not['source']=='event_users') { ?>
	<a class="notification-links" href="event-lists.php">
	<?php } ?>
	<div class="notif-box notif-all">
	<div class="not-area notif-all-area">
	<div class="post-thumb"> 
	<?php  
if($pname['profile_pic']!='') {
echo "<img class='post-thumb' src='".$post_thumb."'>";
}
else {
	echo "<img class='post-thumb' src='eimg.jpg'>";
}
echo "</div><div class='notif-content'><p>";
if($not['source']=='likes') {

echo $pname['pet_name']." Liked Your Post";
}
if($not['source']=='comments') {

echo $pname['pet_name']." Commented On Your Post";	
}
if($not['source']=='post') {

echo $pname['pet_name']." Shared a Post With You";	
}
if($not['source']=='group_users') {

echo $pname['pet_name']." Invited You To Join His Group".$not['title'];
}
if($not['source']=='event_users') {

echo $pname['pet_name']." Invited You To Attend His Event ".$not['title'];
}
	?>
	</p>
	</div>
	</div>
	</div>
	</a> 
	
<?php $serialnum+=1; } ?>
<a href="#" id="notif-load">Load More</a>
<img class="load-more-img" src="loadmore.gif">
                        </div>
						</div>
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
                        var fired = 0;

                        jQuery(window).scroll(function () {

                   if (jQuery(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {

                                if (jQuery(window).data('ajax_in_progress') === true)
                                    return;

                                if (fired == 0) {
                                    var last_id = jQuery('.notification-links:last').attr('id');
                                    loadMoreData(last_id);

                                }
                                fired = 1;
                            }

                        });

                        function loadMoreData(last_id) {
                            jQuery.ajax({
                                        url: 'notif-load-more.php?lastid='+last_id,
                                        type: "GET",
			                            
                                    beforeSend: function ()
                                        {
                                           jQuery('#notif-load').remove();
                                           jQuery('.load-more-img').show(); 
                                        },
                                    
                                    success: function(data)
                                    {
										//alert(data);
                                      if(!data.length) {
				 
				                 jQuery('#col-notifications').append("<span id='nomorealert'>No more posts to show!</span>");
				                 $('#nomorealert').fadeOut(1000, function() {
                                 $(this).remove();
                                       
									   });
	                                   return;
			                           }
                                        jQuery('.load-more-img').hide();
                                        jQuery('#col-notifications').append(data);
                                        fired = 0;
                                        if (data.length < 25) {
                                            jQuery(window).data('ajax_in_progress', true);
                                        }
                                    },

                                    error: function() 
	    	                         {
				                      alert('Server Not Responding');
	    	                         } 

                        });
						}
                    </script>
					
                               
			<!--<script type="text/javascript">
			
		$(document).on('click','#notif-load',function(e) {
			e.preventDefault();
			
			var lid=$('.notification-links:last').attr('id');
			
			 $.ajax({ 
        	url: "notif-load-more.php",
			type: "POST",
			data: { lastid: lid },
    	    cache: false,
			beforeSend: function ()
                     { 
				     $('#notif-load').remove();
                     $('.load-more-img').show();
                     },
			success: function(data)
		    {
				 $('.load-more-img').hide();
	         if(!data.length) { 
				 
				 $("#col-notifications").append("<span id='nomorealert'>No more posts to show!</span>");
				 $('#nomorealert').fadeOut(1000, function() {
        $(this).remove();
    });
	return;
			 } 
			  $('#col-notifications').append(data);
			  //$('#aboutload').appendTo('#post-load-about');
			
		      
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		}); 
		});
		
</script>--> 
                                
            </body>
            </html>
