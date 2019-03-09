<?php
require_once './dbcon.php';
$otpqry=mysqli_query($conn,"SELECT * FROM otp_verfication");

date_default_timezone_set('Asia/Calcutta');

$curtime= date('Y-m-d H:i:s');
echo $curtime."<br>";
WHILE($otp=mysqli_fetch_assoc($otpqry)) {
$time = $otp['createdOn'];

$te= timeElapsed($time,$curtime);
echo $te->y .' years, '. $te->m .' months, '. $te->d .' days, '. $te->h .' hours, and '. $te->i .' minutes.'. $te->s .' seconds.';
if(($te->y+$te->m+$te->d+$te->h)>0) {
	echo "<h1>Expired</h1>";
}
else {
	if($te->i>22) {
		echo "<h1>Expired</h1>";
	}
	else {
	echo "<h1>Valid</h1>";
	}
	
}
}
function timeElapsed($t1, $t2 = null) {

  $t1 = is_int($t1) ? new DateTime('@'. $t1) : new DateTime($t1);
  $t2 = ($t2 == null) ? new DateTime() : (is_int($t2) ? new DateTime('@'. $t2) : new DateTime($t2));

  $df = $t2->diff($t1);
  $df->w = floor($df->days / 7) - ($df->y * 52) - $df->m * 4;   // weeks
  $df->d2 = $df->d - ($df->w * 7);    // days till the end of week
  return $df;

} 
?>
