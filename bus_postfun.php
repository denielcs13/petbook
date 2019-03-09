<?php
session_start();
$parent_id=$_SESSION['business_unique_id'];
  require './dbcon.php';
if (isset($_POST['id'])) {

    //Business likes code start here
    $like_id = $_POST['id'];
    $pet_unique_id = $_SESSION['business_unique_id'];
  
    $like_select = "select * from likes where post_id = '" . $like_id . "' AND liker_unique_id = '" . $pet_unique_id . "'";
    $query_like = mysqli_query($conn, $like_select);
    if (mysqli_num_rows($query_like) > 0) {
      
        $like_delete = "delete from likes where post_id = '$like_id' AND liker_unique_id = '$pet_unique_id'";
        mysqli_query($conn, $like_delete);
		echo "Like|";
		
        
    } else {
       
        $like_insert = "INSERT INTO `likes`(`post_id`, `liker_unique_id`) VALUES ('$like_id','$pet_unique_id')";
        mysqli_query($conn, $like_insert);
		echo "Unlike|";
    }
	$like_count = mysqli_query($conn,"select * from likes where post_id = '$like_id'");
        echo mysqli_num_rows($like_count);
   
}

if(isset($_POST['commentid'])) {
	
$cominsqry="INSERT INTO comments(post_id,commenter_unique_id,comment)VALUES('$_POST[commentid]','$parent_id','$_POST[commenttext]')";
$commentinsert=mysqli_query($conn,$cominsqry);	
?>
<?php
$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$_POST[commentid]'");
if(mysqli_num_rows($commentqry)>0) {
WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {

$commentr=mysqli_query($conn,"SELECT pet_name,profile_pic FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]' UNION SELECT company_name,profile_image FROM business WHERE business_uniqueid='$commentresult[commenter_unique_id]' UNION SELECT ngo_name,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$commentresult[commenter_unique_id]'");

$cmntr=mysqli_fetch_assoc($commentr);
?>
<div class="user-comments">
<span class="user-icn-img">
			<?php if($cmntr['profile_pic']=='') {
				echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
			
			<img src="<?= $cmntr['profile_pic'] ?>" alt="user image" />
							<?php } ?>
			</span>
<div class="cmnt-text"><a href='about3.php?id=<?= $commentresult['commenter_unique_id'] ?>'><?= $cmntr['pet_name']?></a>
<span class="cmmnt-t"><?= $commentresult['comment'] ?></span></div>
</div>
<?php
}	
}
?>
<div class="post-comment-box" id="<?= $_POST[commentid] ?>" style="display:none;">
<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
</div>
<?php
}	

if (isset($_POST['sub'])) {

    $filetmp = $_FILES["bgimg"]["tmp_name"];
    $filname = $_FILES["bgimg"]["name"];
    $filetype = $_FILES["bgimg"]["type"];
	$parent_id=$_SESSION['business_unique_id'];
     $result = mkdir($parent_id . "/bgImage", 0777, TRUE);
     $target_path = $parent_id . "/bgImage/" . basename($_FILES['bgimg']['name']);
     if (move_uploaded_file($_FILES['bgimg']['tmp_name'], $target_path)) {
   
     $files = $parent_id . "/bgImage/" . $_FILES['bgimg']['name'];
     $updatebgimage = "UPDATE `business` SET `bg_image`='$files' WHERE business_uniqueid = '$parent_id'";
    // print_r($updatebgimage);die;
    mysqli_query($conn,$updatebgimage);
    }
    	header('Location:bus_page.php');
}
?>

