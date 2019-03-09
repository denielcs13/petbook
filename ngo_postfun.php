<?php
session_start();
print_r($_POST);
print_r($_SESSION);

if (isset($_POST['id'])) {

    //Business likes code start here
    $like_id = $_POST['id'];
    $pet_unique_id = $_SESSION['ngo_unique_id'];
    require './dbcon.php';
    $like_select = "select * from likes where post_id = '" . $like_id . "' AND liker_unique_id = '" . $pet_unique_id . "'";
    $query_like = mysqli_query($conn, $like_select);
    if (mysqli_num_rows($query_like) > 0) {
        require './dbcon.php';
        $like_delete = "delete from likes where post_id = '$like_id' AND liker_unique_id = '$pet_unique_id'";
        mysqli_query($conn, $like_delete);
		$like_count = mysqli_query($conn,"select * from likes where post_id = '$like_id'");
        echo mysqli_num_rows($like_count);
        
    } else {
        require './dbcon.php';
        $like_insert = "INSERT INTO `likes`(`post_id`, `liker_unique_id`) VALUES ('$like_id','$pet_unique_id')";
        mysqli_query($conn, $like_insert);
		$like_count = mysqli_query($conn,"select * from likes where post_id = '$like_id'");
        echo mysqli_num_rows($like_count);
    }
    //Business like code end here    
}

///Comments code start here
//print_r($_POST);
if (isset($_POST['commentid'])) {

    $comment_id = $_POST["commentid"];
    $pet_unique_comment_id = $_SESSION['ngo_unique_id'];
    $commenst = $_POST["commenttext"];
    require './dbcon.php';
    $comment_insert = "INSERT INTO `comments`(`post_id`, `commenter_unique_id`, `comment`) VALUES ('$comment_id','$pet_unique_comment_id','$commenst')";
    mysqli_query($conn, $comment_insert);
    
     require './dbcon.php';
     $like_select = "select * from ngo_resgitrationwhere ngo_unique_id= '" . $pet_unique_comment_id . "'";
     $display_name= mysqli_query($conn, $like_select);
    $comapny_name = mysqli_fetch_assoc($display_name);
     echo "<a href='#'>".$comapny_name['ngo_name']."</a>". $commenst;
    
}
if (isset($_POST['sub'])) {

    $filetmp = $_FILES["bgimg"]["tmp_name"];
    $filname = $_FILES["bgimg"]["name"];
    $filetype = $_FILES["bgimg"]["type"];
	$parent_id=$_SESSION['ngo_unique_id'];
     $result = mkdir($parent_id . "/bgImage", 0777, TRUE);
     $target_path = $parent_id . "/bgImage/" . basename($_FILES['bgimg']['name']);
     if (move_uploaded_file($_FILES['bgimg']['tmp_name'], $target_path)) {
     require './dbcon.php';
     $files = $parent_id . "/bgImage/" . $_FILES['bgimg']['name'];
     $updatebgimage = "UPDATE `ngo_resgitration` SET `bg_image`='$files' WHERE ngo_unique_id = '$parent_id'";
     
    mysqli_query($conn,$updatebgimage);
    }
    	header('Location:ngo_feed_page.php');
}
?>

