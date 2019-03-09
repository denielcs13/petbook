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
echo $parent_id."||||".$_GET['id']."<hr>";
$cidallqry=mysqli_query($conn,"SELECT c_id FROM conversation WHERE user_one='$parent_id' or user_two='$parent_id'") or die(mysql_error());
WHILE($cidall=mysqli_fetch_assoc($cidallqry)) {
$messagesqry=mysqli_query($conn,"SELECT * FROM conversation_reply WHERE c_id_fk='$cidall[c_id]'");
echo $cidall['c_id'];
WHILE($messages=mysqli_fetch_assoc($messagesqry)) {

echo $cidall['c_id']."---".$messages['reply']."--".$messages['notified']."<br>";

}
}
echo "<hr>";
$snum=1;
$cidqry= mysqli_query($conn,"SELECT c_id FROM conversation WHERE (user_one='$parent_id' and user_two='$_GET[id]') or (user_one='$_GET[id]' and user_two='$parent_id') ") or die(mysql_error());
if(mysqli_num_rows($cidqry)>0) {
$cidfetch=mysqli_fetch_assoc($cidqry);
$convr_id=$cidfetch['c_id'];
echo $convr_id."<br>";
$msgqry=mysqli_query($conn,"SELECT * FROM conversation_reply WHERE c_id_fk='$convr_id'");
$msg_num=mysqli_num_rows($msgqry);
echo $msg_num."<br>";
WHILE($msg=mysqli_fetch_assoc($msgqry)) { ?>
<?= $snum ?>)<div id="<?= $msg['cr_id']; ?>">
<?php
	echo $msg['reply']."--".$msg['time']."</div>";
	$snum+=1;
}
}
else {
	echo "No cid";
}



?>

