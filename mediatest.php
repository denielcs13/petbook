<?php
include("dbcon.php");
session_start();

date_default_timezone_set("Asia/Calcutta"); 
$post_datetime=date('Y-m-d H:i:s');
$im_path="";
$vid_path="";
    
$im_count=0;
$vid_count=0;
$loc_path = "vcp/";   
$vid_loc_path =  "vcp/";


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

move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_path); 
}
}



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

