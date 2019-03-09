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

if(isset($_GET['lastid'])) {
	$lid=$_GET['lastid'];
}
$link_id=$lid+1;
$notqry=mysqli_query($conn,"SELECT b.id AS tid,liker_unique_id,title,a.id,a.image,b.time,'likes' AS source FROM post a,likes b WHERE a.child_post_id='$parent_id' AND a.id=b.post_id AND liker_unique_id!='$parent_id'
UNION
SELECT c.id AS tid,commenter_unique_id,comment,a.id,a.image,c.time,'comments' AS source FROM post a,comments c WHERE a.child_post_id='$parent_id' AND a.id=c.post_id AND commenter_unique_id!='$parent_id'
UNION 
SELECT id AS tid,child_post_id,title,id,image,time,'post' AS source FROM post WHERE share_with='$parent_id'
UNION
SELECT gu.group_user_id AS tid,g.user_id_fk,g.group_name,gu.group_id_fk,g.gr_profile_pic,gu.time,'group_users' AS source FROM group_users gu,groups g WHERE gu.user_id_fk='$parent_id' AND gu.status='0' AND g.group_id=gu.group_id_fk
UNION
SELECT eu.event_user_id AS tid,e.user_id_fk,e.event_name,eu.event_id_fk,e.e_profile_pic,eu.time,'event_users' AS source FROM event_users eu,events e WHERE eu.user_id_fk='$parent_id' AND eu.status='0' AND e.event_id=eu.event_id_fk 
ORDER BY time DESC LIMIT 10 OFFSET $lid");


WHILE($not=mysqli_fetch_assoc($notqry)) {
	
	
	$pnameqry=mysqli_query($conn,"SELECT pet_name,profile_pic,pet_unique_id FROM user_inf WHERE pet_unique_id='$not[liker_unique_id]' UNION SELECT company_name,profile_image,business_uniqueid FROM business WHERE business_uniqueid='$not[liker_unique_id]' UNION SELECT ngo_name,profile_image,ngo_unique_id FROM ngo_resgitration WHERE ngo_unique_id='$not[liker_unique_id]'");
$pname=mysqli_fetch_assoc($pnameqry);
$post_thumb=$pname['profile_pic'];
	?>
	
	<?php if($not['source']=='likes'||'comments'||'post') { ?>
	<a class="notification-links" id="<?= $link_id ?>" href="show-post.php?pid=<?= $not['id'] ?>">
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
	
<?php $link_id+=1;
 } ?>

