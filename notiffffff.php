<ul class="notification-bar">
            
			<li class="notif_Container" id="noti_Container">
			<?php $frndreqqry=mysqli_query($conn,"SELECT pet_name,email,profile_pic,parent_id,addfriend.status,child_id FROM user_inf JOIN addfriend ON addfriend.parent_id = user_inf.pet_unique_id WHERE child_id='$parent_id' AND parent_id!='$parent_id' AND addfriend.status=1 LIMIT 5");
			$frcount=mysqli_num_rows($frndreqqry);
			
			?>
			<div id="frcount" style="display:none;"><?= $frcount ?></div>
                <div class="notif_Counter" id="noti_Counter"></div>   
                
              
                <div class="notif_Button" id="noti_Button"><img src="images/friend.png"></div>    

               
                <div class="frnd-request" id="notifications">
                    <div class="frq-title">Friend Request</div>
                    <div class="friend-req-area">
					<div class="fr-list">
					<?php WHILE($friendreq=mysqli_fetch_assoc($frndreqqry)) { ?>
					<div class="fr-li-cont" id="friend-req-show">
                                    <div class="fr-li-row">
                                        <div class="fr-t-l">
                                            <a href="about3.php?id=<?= $friendreq['parent_id'] ?>">
											<span class="user-icn-img">
											<?php if($friendreq['profile_pic']=='') { ?>
											<img src="images/pet-icon.png" alt="user image">
											<?php } else { ?>
											<img src="<?= $friendreq['profile_pic'] ?>">
											<?php } ?>
											<span class="fr-nm"><?= $friendreq['pet_name'] ?></span></span>
											</a>
                                        </div>
                                        <div class="user-act"><a href="#" class="frn_req_acc" id="<?= $friendreq['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?= $friendreq['parent_id'] ?>">Reject</a></div>
                                    </div>
                                </div>
								
					<?php } ?>
					</div>
					</div>
                    <div class="seeAll"><a class="see-all" href="#">See All</a></div>
                </div>
            </li>
			
			
			
			
			
            <li class="notif_Container" id="noti_Container2">
			 
                <div class="notif_Counter" id="noti_Counter2"></div>   
                
            
                <div class="notif_Button" id="noti_Button2"><img src="images/notif-icon.png"></div>    

               
                <div class="notif" id="notifications2">
                    <h3>Notifications</h3>
                    <div class="notification-area">
					<?php $notqry=mysqli_query($conn,"SELECT b.id AS tid,liker_unique_id,title,a.id,a.image,b.time,'likes' AS source FROM post a,likes b WHERE a.child_post_id='$parent_id' AND a.id=b.post_id AND liker_unique_id!='$parent_id'
UNION
SELECT c.id AS tid,commenter_unique_id,comment,a.id,a.image,c.time,'comments' AS source FROM post a,comments c WHERE a.child_post_id='$parent_id' AND a.id=c.post_id AND commenter_unique_id!='$parent_id'
UNION 
SELECT id AS tid,child_post_id,title,id,image,time,'post' AS source FROM post WHERE share_with='$parent_id'
UNION
SELECT gu.group_user_id AS tid,g.user_id_fk,g.group_name,gu.group_id_fk,g.gr_profile_pic,gu.time,'group_users' AS source FROM group_users gu,groups g WHERE gu.user_id_fk='$parent_id' AND gu.status='0' AND g.group_id=gu.group_id_fk 
ORDER BY time DESC");
WHILE($not=mysqli_fetch_assoc($notqry)) {
	
	$pnameqry=mysqli_query($conn,"SELECT pet_name,profile_pic,pet_unique_id FROM user_inf WHERE pet_unique_id='$not[liker_unique_id]' UNION SELECT company_name,profile_image,business_uniqueid FROM business WHERE business_uniqueid='$not[liker_unique_id]' UNION SELECT ngo_name,profile_image,ngo_unique_id FROM ngo_resgitration WHERE ngo_unique_id='$not[liker_unique_id]'");
$pname=mysqli_fetch_assoc($pnameqry);
$post_thumb=strtok($not['image'], ',');
	?>
	<div id="notif-count" style="display:none;"><?= mysqli_num_rows($notqry); ?></div>
	<?php if($not['source']=='likes'||'comments'||'post') { ?>
	<a class="notification-links" href="show-post.php?action=<?= $not['source'] ?>&pid=<?= $not['id'] ?>&tid=<?= $not['tid'] ?>">
	<?php } if($not['source']=='group_users') { ?>
	<a class="notification-links" href="group-lists.php">
	<?php } ?>
	<div class="notif-box">
	
	<div class="not-area">
	<div class="post-thumb"> 
	<?php  
if($not['image']!='') {
echo "<img class='post-thumb' src='".$post_thumb."'>";
}
else {
	echo "<img class='post-thumb' src='eimg.jpg'>";
}
echo "</div><p>";
if($not['source']=='likes') {

echo $pname['pet_name']."Liked Your Post";
}
if($not['source']=='comments') {

echo $pname['pet_name']."Commented On Your Post";	
}
if($not['source']=='post') {

echo $pname['pet_name']."Shared a Post With You";	
}
if($not['source']=='group_users') {

echo $pname['pet_name']."Invited You To Join His Group".$not['title'];
}
	?>
	</p>
	</div>
	</div>
	</a>
	
<?php } ?>
					
					</div>
                    <div class="seeAll"><a class="see-all" href="#">See All</a></div>
                </div>
            </li>
            
			
        
<script>
$(document).ready(function() {
	
	
});


</script>


<script>
    $(document).ready(function () {

        
        $('#noti_Counter')
            .css({ opacity: 0 })
            .text($('#frcount').text())          
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button').click(function () {

            
            $('#notifications').fadeToggle('fast', 'linear', function () {
                
            });

            $('#noti_Counter').fadeOut('slow');                

            return false;
        });

        $(document).click(function () {
            $('#notifications').hide();

            
        });

        $('#notifications').click(function () {
            return false;      
        });
		
		
		
		$('#noti_Counter2')
            .css({ opacity: 0 })
            .text($('#notif-count').text())              
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button2').click(function () {

           
            $('#notifications2').fadeToggle('fast', 'linear', function () {
                
            });

            $('#noti_Counter2').fadeOut('slow');                 

            return false;
        });

        
        $(document).click(function () {
            $('#notifications2').hide();

           
        });

        $('#notifications2').click(function () {
            //return false;       
        });
		
    });
</script>