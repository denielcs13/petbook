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
if(isset($_POST['clear'])) {
$notqry=mysqli_query($conn,"SELECT b.id AS tid,'likes' AS source FROM post a,likes b WHERE a.child_post_id='$parent_id' AND a.id=b.post_id AND liker_unique_id!='$parent_id'
UNION
SELECT c.id AS tid,'comments' AS source FROM post a,comments c WHERE a.child_post_id='$parent_id' AND a.id=c.post_id AND commenter_unique_id!='$parent_id'
UNION
SELECT id AS tid,'post' AS source FROM post WHERE share_with='$parent_id'
UNION
SELECT gu.group_user_id AS tid,'group_users' AS source FROM group_users gu,groups g WHERE gu.user_id_fk='$parent_id' AND gu.status='0' AND g.group_id=gu.group_id_fk
UNION
SELECT eu.event_user_id AS tid,'event_users' AS source FROM event_users eu,events e WHERE eu.user_id_fk='$parent_id' AND eu.status='0' AND e.event_id=eu.event_id_fk");

WHILE($not=mysqli_fetch_assoc($notqry)) {
	if($not['source']=='group_users') {
	$notcntqry="UPDATE $not[source] SET notified='1' WHERE group_user_id='$not[tid]'";	
	}
	else if($not['source']=='event_users') {
	$notcntqry="UPDATE $not[source] SET notified='1' WHERE event_user_id='$not[tid]'";	
	}
	else {
	$notcntqry="UPDATE $not[source] SET notified='1' WHERE id='$not[tid]'";
	}
	mysqli_query($conn,$notcntqry);
	
}
}

?>