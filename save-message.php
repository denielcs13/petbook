<?php
include("dbcon.php");
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

$reply=mysqli_real_escape_string($conn,$_POST['reply']);
$cid=mysqli_real_escape_string($conn,$_POST['msg_id']);
$uid=mysqli_real_escape_string($conn,$parent_id);
date_default_timezone_set("Asia/Calcutta");
$time=date('Y-m-d H:i:s');
$ip=$_SERVER['REMOTE_ADDR'];
$post_datetime=date('Y-m-d H:i:s');

    $q= mysqli_query($conn,"INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) VALUES ('$uid','$reply','$ip','$time','$cid')") or die(mysqli_error());

	$userinf=mysqli_query($conn,"SELECT pet_name,profile_pic FROM user_inf WHERE pet_unique_id='$parent_id'
                                    UNION SELECT company_name,profile_image
                                    FROM business
                                    WHERE business_uniqueid = '$parent_id'
                                    UNION SELECT ngo_name,profile_image
                                    FROM ngo_resgitration
                                    WHERE ngo_unique_id = '$parent_id'");
	$usrinfo=mysqli_fetch_assoc($userinf);
	
	$date2=date('Y-m-d H:i:s');
$diff = abs(strtotime($date2) - strtotime($time));
$years = floor($diff / (365*60*60*24)); 
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
$minuts = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
        if($diff < 60)
            $time = $seconds." sec ago";
        else if($diff < 60*60 )
            $time = $minuts." min ago";
        else if($diff < 24*60*60)
            $time = $hours." hrs ago";
        else if($diff < 30*24*60*60)
            $time = $days." day ago";
        else if($diff < 12*30*24*60*60)
	    $time = $months." month ago";
        else
            $time = $years." year ago";
	?>

<div class="chat-msg post-in-c">
<div class="chatmsg-box">
<div class="fr-ch-l-img">
    <?php if($usrinfo['profile_pic']=='') { ?>
										
						<img src="images/fr-pro-big-img.jpg" alt="user image">
													<?php } else { ?>
										
										
							<img src="<?= $usrinfo['profile_pic'] ?>" alt="user image" />
							
													<?php } ?>
</div>
    <h2 class="fri-name sender-name"><a class="fri-ch-li-row" href='about-fr.php?id=<?= $parent_id ?>'><?= $usrinfo['pet_name'] ?></a></h2>
<div class="fri-chat-full-desc">
<?= $reply ?>
</div>
<div class="fri-mes-time"><?php echo $time; ?></div>
</div>
</div>



