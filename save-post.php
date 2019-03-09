<?php
include("dbcon.php");
session_start();
$title=mysqli_real_escape_string($conn,$_POST['title']);
$description=mysqli_real_escape_string($conn,$_POST['description']);
$addlink=mysqli_real_escape_string($conn,$_POST['post-url']);
$uniqueid=$_SESSION['pet_unique_id'];
date_default_timezone_set("Asia/Calcutta");
$post_datetime=date('Y-m-d H:i:s');
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
echo $str;
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
	$savepost="INSERT INTO post(child_post_id,title,posts,url,time)VALUES('$uniqueid','$title','$description','$addlink','$post_datetime')";
}
else {
	$savepost="INSERT INTO post(child_post_id,title,posts,url,image,img_count,video,vid_count,time)VALUES('$uniqueid','$title','$description','$addlink','$im_path','$im_count','$vid_path','$vid_count','$post_datetime')";
}
//mysqli_query($conn,$savepost);
//echo $im_count."--".$vid_count;

if ($conn->query($savepost) === TRUE) {
    $posted_id = $conn->insert_id;
    
}

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
$disp_post=mysqli_query($conn,"SELECT * FROM post WHERE id='$posted_id'");
$display_post=mysqli_fetch_assoc($disp_post);
?>


<div class="two-col-post" id="<?= $display_post['id']?>">
                                    <div class="left">
                                        <div class="post-in-c">
<div class="multi-pimg">
                                            <?php if($display_post['img_count']>=1) {
												$post_images=explode(",",$display_post['image']);
												for($i=0;$i<count($post_images); $i++) {
												?>
											<div class="post-image fbphotobox">
											
											
    <a class="example-image-link" data-lightbox="example-1" data-title="" href="images/user_image08.jpg" data-lightbox="example-1">
                        <img class="photo" fbphotobox-src="<?= $post_images[$i] ?>" alt="" src="<?= $post_images[$i] ?>">
                                                </a>

                                            </div>
											<?php } } ?>
</div>
											
											<div class="post_video">
											<?php if($display_post['vid_count']>=1) { 
											$post_videos=explode(",",$display_post['video']);
											for($i=0;$i<count($post_videos); $i++) {
											?>
											<div class="display_videos">
											<video width="230" height="200" controls>
  <source src="<?= $post_videos[$i] ?>" type="video/mp4">
 
</video>

											</div>
											<?php } }?>
											</div>
                                            
											
											
											
											
											<div class="post-content">
                                                <h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"></a></p></h2>
                                                <p class="pst-text"><?= $display_post['posts'] ?><p>
                                                <p class="ttl-lks"><a href="#">likes</a></p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
                                                    <a href="#" title="">like
                                                    </a><a href="#" title="">Comment</a>
                                                    <a href="#" title="">Share</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
</div>

