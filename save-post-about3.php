<?php
include("dbcon.php");
session_start();
$parent_id=$_SESSION['pet_unique_id'];
$title=mysqli_real_escape_string($conn,$_POST['title']);
$description=mysqli_real_escape_string($conn,$_POST['description']);
$addlink=mysqli_real_escape_string($conn,$_POST['post-url']);
$uniqueid=$_SESSION['pet_unique_id'];
date_default_timezone_set("Asia/Calcutta");
$post_datetime=date('Y-m-d H:i:s');
$profile_uid=$_POST['profile-uid'];
$im_path="";
$vid_path="";
    
$im_count=0;
$vid_count=0;
$loc_path = $_SESSION['pet_unique_id']."/post_images/";   
$vid_loc_path =  $_SESSION['pet_unique_id']."/Videos/";


for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");      // Extensions which are allowed.
$videoextensions = array("mp4","avi","mpeg","MP4","AVI","MPEG");
$ext = explode('.', basename($_FILES['files']['name'][$i]));   // Explode file name from dot(.)
$file_extension = end($ext); // Store extensions in the variable.

if(in_array($file_extension, $validextensions)) {
	ob_start(); 
	$im_count+=1;
$file_name=$_FILES['files']['name'][$i];
$img_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$target_path = $loc_path . md5(uniqid(rand(), true)) . "." . $img_ext;     
$tmp_name=$_FILES['files']['tmp_name'][$i];
$im_type = exif_imagetype($tmp_name); 
resizeImage($tmp_name,NULL,2000,1500,$im_type);
$rawImageBytes = ob_get_clean();

$tempsrc="data:image/jpeg;base64," . base64_encode( $rawImageBytes );
$str = imgProcess($tempsrc, 100, $target_path,$im_type);
$all_images[$i]=$target_path;

/* if (in_array($file_extension, $validextensions) && ($_FILES["files"]["size"][$i] < 10000000)) {
if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_path)) {

//echo  ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
$all_images[$i]=$target_path;

} 
}  */
}


	if(in_array($file_extension, $videoextensions)) {
	$vid_count+=1;
	$file_name=$_FILES['files']['name'][$i];
	$vid_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$target_path = $vid_loc_path . md5(uniqid(rand(), true)) . "." . $vid_ext; 

if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_path)) {

//echo ').<span id="noerror">Video uploaded successfully!.</span><br/><br/>';
$all_videos[$i]=$target_path;
mysqli_query($conn,"INSERT INTO videoupload(uniqueid,video_name,video_type,image_path)VALUES('$uniqueid','$file_name','$vid_type','$target_path')");
}	 
}


}

if($im_count>0) {
$im_path=implode(',',$all_images);
}
if($vid_count>0) {
$vid_path=implode(',',$all_videos);
}

if($im_count==0 && $vid_count==0) {
	$savepost="INSERT INTO post(child_post_id,title,posts,url,wall_post_id,time)VALUES('$uniqueid','$title','$description','$addlink','$profile_uid','$post_datetime')";
}
else {
	$savepost="INSERT INTO post(child_post_id,title,posts,url,image,img_count,video,vid_count,wall_post_id,time)VALUES('$uniqueid','$title','$description','$addlink','$im_path','$im_count','$vid_path','$vid_count','$profile_uid','$post_datetime')";
}

if ($conn->query($savepost) === TRUE) {
    $posted_id = $conn->insert_id;
    
}
$disp_post=mysqli_query($conn,"SELECT * FROM post WHERE id='$posted_id'");
$display_post=mysqli_fetch_assoc($disp_post);

$profileqry=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$parent_id' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$parent_id' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$parent_id'");
$profileinfo=mysqli_fetch_assoc($profileqry);


//img process
function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight,$imagetype, $quality = 80)
{
	
   switch($imagetype) {
	case '2':
	if (!$image = @imagecreatefromjpeg($sourceImage))
    {
        return false;
    }	
	break;
	
	case '3':
	if (!$image = @imagecreatefrompng($sourceImage))
    {
        return false;
    }	
	break;
	
	default:
	break;
	
	}

    // Get dimensions of source image.
    list($origWidth, $origHeight) = getimagesize($sourceImage);

    if ($maxWidth == 0)
    {
        $maxWidth  = $origWidth;
    }

    if ($maxHeight == 0)
    {
        $maxHeight = $origHeight;
    }

    // Calculate ratio of desired maximum sizes and original sizes.
    $widthRatio = $maxWidth / $origWidth;
    $heightRatio = $maxHeight / $origHeight;

    // Ratio used for calculating new image dimensions.
    $ratio = min($widthRatio, $heightRatio);

    // Calculate new image dimensions.
    $newWidth  = (int)$origWidth  * $ratio;
    $newHeight = (int)$origHeight * $ratio;

    // Create final image with new dimensions.
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
	
	if($imagetype == '3' or $imagetype == '1'){
		
    imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
    imagealphablending($newImage, false);
    imagesavealpha($newImage, true);
	
  }
  
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
	
	switch($imagetype) {
	  
	case '2':
	imagejpeg($newImage, $targetImage, $quality);
	break;
	
	case '3':
	imagepng($newImage);
	break;
	
	default:
	break;
	
	}

    

    // Free up the memory.
    imagedestroy($image);
    imagedestroy($newImage);

    return true;
}

function imgProcess($srcFile, $quality,$imgpath,$imagetype) {

        $watermark = imagecreatefrompng("images/watermark.png");
        switch($imagetype) {
	   
	case '2':
	 $img = imagecreatefromjpeg($srcFile);	
	break;
	
	case '3':
	 $img = imagecreatefrompng($srcFile);
	break;
	
    default:
	break;
	
	}
       

        if ($img && $watermark) {

            $src_width = imagesx($img);

            $src_height = imagesy($img);

            $wmk_width = imagesx($watermark);

            $wmk_height = imagesy($watermark);

            $dst_image = imagecreatetruecolor($src_width, $wmk_height);

            imagealphablending($dst_image, false);

            $dest_x = ($src_width - $wmk_width) - 5;

            $dest_y = ($src_height - $wmk_height) - 5;

            $insertWidth = imagesx($watermark);

            $insertHeight = imagesy($watermark);

            $imageWidth = imagesx($img);

            $imageHeight = imagesy($img);

            $overlapX = ($imageWidth-$wmk_width)-20;

            $overlapY = ($imageHeight - $insertHeight) - 10;

            imagecopy($img, $watermark, $overlapX, 20, 0, 0, $insertWidth, $insertHeight);

            imagesavealpha($img, true);

            //$outputFilename = "1155933/".basename($srcFile);
			
           switch($imagetype) {
	case '2':
	 $saved = imagejpeg($img, $imgpath, $quality);	
	break;
	
	case '3':
	 $saved = imagepng($img, $imgpath);
	break;
	
	default:
	break;
	
	
	}
           

            if ($saved) {

                $str = "Image '".$imgpath."' was saved.";

            } else {

                $str = "Unable to save '".$imgpath."'!";

            }

            imagedestroy($img);

            imagedestroy($watermark);

            return $str;

        }

    }


?>


<div class="left item demo">
<div class="post-in-c" id="<?= $display_post['id'] ?>">
<div class="post-content">
<h2><span class="user-icn-img">
<a href="#">  
	<?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?>
 
</a></span><p class="user-nm"><a href="about3.php?id=<?= $profileinfo['pet_unique_id'] ?>"><?= $profileinfo['pet_name'] ?></a></p></h2>
<h3><?= $display_post['title'] ?></h3>
<p class="pst-text" id="post_desc"><?= $display_post['posts'] ?></p>
<a href="<?= $display_post['url'] ?>"><?= $display_post['url'] ?></a>
</div>
<div class="post-image">
<ul id="post-media" data-count="<?= $imcount ?>">
<?php if($display_post['img_count']>0) {
												$proimages=explode(",",$display_post['image']);
                                                for($i=0;$i<count($proimages);$i++) {   
											?>
											<li class="pb-image-box">
<a href="aj_box.php?id=<?= $display_post['id'] ?>&im=<?= $proimages[$i] ?> .ajcontent" data-featherlight="ajax"><img src="<?= $proimages[$i] ?>"></a>
</li>
												<?php } }  ?>


											<?php if($display_post['vid_count']>0) {
												$provid=explode(",",$display_post['video']);
												for($i=0;$i<count($provid);$i++) { 
												
												?>   
												<li class="pb-image-box">
											<a href="aj_box.php?id=<?= $display_post['id'] ?>&vid=<?= $provid[$i] ?> .ajcontent" data-featherlight="ajax"><video width="230" height="200" controls>
                                            <source src="<?= $provid[$i] ?>" type="video/mp4">
 
                                            </video></a>
											</li>
											<?php } } ?>
<!--postact-->								
</ul>
</div>			
											
<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$display_post[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                            
         
                                                <p class="ttl-lks">
		<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$display_post[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												<span class="number-likes<?= $display_post['id'] ?>"><?= $likenum ?></span> Likes</p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$display_post[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $display_post['id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $display_post['id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $display_post['id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $display_post['id'] ?>">Share</button>
													
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$display_post[id]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
	$commentr=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$commentresult[commenter_unique_id]'");
	$cmntr=mysqli_fetch_assoc($commentr);
														?>
														
													<div class="user-comments"><span class="user-icn-img">
														<?php if($cmntr['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $cmntr['profile_pic'] ?>" alt="user image" />
							<?php } ?>
														
													</span>
														<div class="cmnt-text"><a href='about3.php?id=<?= $cmntr['pet_unique_id'] ?>'><?= $cmntr['pet_name']?></a><span class="cmmnt-t"><?=$commentresult['comment'] ?></span></div></div>
													
													<?php
													}	
												}
												
												?>
												<div class="post-comment-box" id="<?= $display_post['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												</div>                                     </div>

											
											
											
											
<!--postactend-->											
											
</div>
</div>
