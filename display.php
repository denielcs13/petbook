<?php
session_start();
include("dbcon.php");
$i=0;
$get_vid=mysqli_query($conn,"SELECT video FROM post");
WHILE($vid=mysqli_fetch_assoc($get_vid)) {
	if($vid['video']!="") {
		
	$videos=explode(',',$vid['video']);
	foreach($videos as $video) {
	
$i+=1;
	echo $i.")".$video."<br>";
		$vid_arr[]=$video;
	}
		
	}
}
//print_r($vid_arr);
echo rand(0,count($vid_arr)-1);

?>
<video width="230" height="200" controls>
  <source src="<?= $vid_arr[rand(0,count($vid_arr)-1)] ?>" type="video/mp4">
 
</video>
<video width="230" height="200" controls>
  <source src="<?= $vid_arr[rand(0,count($vid_arr)-1)] ?>" type="video/mp4">
 
</video>
<video width="230" height="200" controls>
  <source src="<?= $vid_arr[rand(0,count($vid_arr)-1)] ?>" type="video/mp4">
 
</video>
