<html>
    <?php
    session_start();
	require './dbcon.php';
	if ((isset($_SESSION['pet_unique_id']))) {   
   $id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $id=$_SESSION['ngo_unique_id'];
}
    $alrt = '';
    
    if (isset($_POST["file"])) {

        $image_name = $_FILES['file']['name'];
        $image_type = $_FILES['file']['type'];
        $image_size = $_FILES['file']['size'];
        $image_tmpname = $_FILES['file']['tmp_name'];
        $target_path = $id . "/profile_pic/" . basename($_FILES['file']['name']);
        $brk_path = $id . "/profile_pic/";
        if ($image_type == 'application/msword' or $image_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type == 'application/pdf' or
                $image_type == 'image/png' or $image_type == 'image/jpeg' or $image_type == 'image/jpg' or $image_type == 'application/msword') {
            move_uploaded_file($image_tmpname, $target_path);
            $target_path = $id . "/profile_pic/" . basename($_FILES['file']['name']);
        }
        //else{
        //	echo "<script>alert('uploade file formate not supported')</script>";
        //	}
        if ($brk_path != $target_path) {
            
            $insert = "update  user_inf set  profile_pic = '$target_path' where pet_unique_id = $id";
            // print_r($insert);die;
            $sqll = mysqli_query($conn, $insert);
            //print_r($sqll);die;
            if ($sqll > 0) {
                $alrt = "Your record Updated Successfully";
            } else {
                echo "<script>alert('Record not updated')</script>";
            }
        } else {
            //echo 'choose a file';
        }
    }
    if (isset($_POST["bgfile"])) {

        $image_name = $_FILES['bgfile']['name'];
        $image_type = $_FILES['bgfile']['type'];
        $image_size = $_FILES['bgfile']['size'];
        $image_tmpname = $_FILES['bgfile']['tmp_name'];
        $brk_path = $id . "/profile_pic/";
        $target_path = $id . "/profile_pic/" . basename($_FILES['bgfile']['name']);
        //print_r($target_path);die;
        if ($image_type == 'application/msword' or $image_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type == 'application/pdf' or
                $image_type == 'image/png' or $image_type == 'image/jpeg' or $image_type == 'image/jpg' or $image_type == 'application/msword') {
            move_uploaded_file($image_tmpname, $target_path);
            $target_path = $id . "/profile_pic/" . basename($_FILES['bgfile']['name']);
        }
        //else{
        //  echo "<script>alert('uploade file formate not supported')</script>";
        //  }
        if ($brk_path != $target_path) {
           
            $insert = "update  user_inf set  bg_image = '$target_path' where pet_unique_id = $id";
            //print_r($insert);die;
            $sqll = mysqli_query($conn, $insert);
            //print_r($sqll);die;
            if ($sqll > 0) {
                $alrt = "Your record Updated Successfully";
            } else {
                echo "<script>alert('Record not updated')</script>";
            }
        } else {
            // echo 'choose a file';
        }
    }
    if (isset($_POST["submit_data"])) {
        $name = $_POST["name"];
        $user_name = $_POST["user_name"];
        $user_about = $_POST["user_about"];
        $type_of_pet = $_POST["type_of_pet"];
        $email = $_POST["email"];
        $address = $_POST["phone"];
        $birthday = $_POST["birthday"];
        $country = $_POST["country"];
        require './dbcon.php';
        $insert = "update  user_inf set pet_name = '$name',about_data='$user_about',type_of_pet = '$type_of_pet',dob ='$birthday',powner_name='$user_name',email='$email',country='$country',phone='$address',
        updateOn=NOW() where pet_unique_id = $id";
        // print_r($insert);die;
        $sqll = mysqli_query($conn, $insert);
        //print_r($sqll);die;
        if ($sqll > 0) {
            $alrt = "Your record Updated Successfully";
        } else {
            echo "<script>alert('Record not updated')</script>";
        }
    }
    ?>
    <?php require_once 'inc/head-content.php'; ?>
    <body>
    <?php require_once 'inc/header_11.php'; ?>

        <div class="main-content edit-profile usr-feed-page-nw usr-feed-page profile-edit-page">
            <div class="main-content-inn col-three main-content-full">
                <div class="col-first-side">
    <?php
    $alrt = '';
    $error = "";
    if (isset($_POST["sub"])) {

        $page_name = $_POST['page_name'];
        $banner_name = $_FILES["banner"]["name"];
        $heading = $_POST["heading"];
        $description = $_POST["description"];
        $linkdestionation = $_POST["linkdestionation"];
        $filetmp = $_FILES["banner"]["tmp_name"];
        if ($_POST['page_name'] != '' && $_POST['heading'] != '' && $_POST['description'] != '') {

            $fileData = pathinfo(basename($_FILES["banner"]["name"]));
            $fileName = uniqid() . '.' . $fileData['extension'];

            $random_numbers = rand(1111111, 9999999);


            $target_path = "ads/" . $fileName;
            if (move_uploaded_file($_FILES['banner']['tmp_name'], $target_path)) {
                require './dbcon.php';
                $files = "ads/" . $fileName;
                $banner_insert = "insert into ads(client_name,banner_image,heading,description,link)values('$page_name','$files','$heading','$description','$linkdestionation')";

                $sqll = mysqli_query($conn, $banner_insert);
                if ($sqll > 0) {
                    $alrt = "Your Ads Created Successfully";
                    //header("location: creates_ads.php");
                }
            } else {

                $error = "Please fill all details";
            }
        }
    }
    ?>
                    <?php require_once 'inc/user_profile_sidebar.php'; ?>   
                    <?php require_once 'inc/side-bar.php'; ?>
                </div>
                <div class="main-content-inn-left">

                    <?php
                    require 'dbcon.php';
                    $results_display = mysqli_query($conn, "select * from user_inf where pet_unique_id = '$id'");
                    $profileinfo = mysqli_fetch_assoc($results_display);
                    ?>
                    <div class="col-first">
                        <div class="edit-profile-hld">
                            <h2 class="p-hdng"><span class="su-msg"><center><?php print_r($alrt); ?></center></span></h2>
                            <div class="edit-profile-left">
                                <form method="post"  enctype="multipart/form-data">
                                    <h2>Profile Image</h2>
                                    <div class="edit-pic usr-pro-img">
<!--                                        <img src="images/user_image02.jpg" alt="user image" />-->
<!--                                        <img src="<?php // echo $profileinfo["profile_pic"] ?>" alt="user image" />-->

                    <?php
                    if ($profileinfo['profile_pic'] == "") {
                        echo "<img src='images/fr-pro-big-img.jpg'>";
                    } else {
                        ?>
                                            <img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
<?php } ?>
                                        <div class="edit-pic-upl">
                                            <div class="edit-pic-in">
                                                <input type="file" name="file" >
                                                <span class="sl-img-z">Update Profile picture</span>
                                            </div>
                                        </div>                                

                                    </div>
                                    <div class="edit-pic-upload">
                                        <input type="submit" name="file" value="Upload Photo" class="upload-img"> 
                                    </div>

                                </form>

                                <form method="post"  enctype="multipart/form-data">
                                    <h2>Backgroung Image</h2>

                                    <div class="edit-pic usr-pro-img">
<!--                                        <img src="images/user_image02.jpg" alt="user image" />-->
<!--                                        <img src="<?php // echo $profileinfo["profile_pic"]  ?>" alt="user image" />-->

<?php
if ($profileinfo['bg_image'] == "") {
    echo "<img src='images/paw.gif'>";
} else {
    ?>
                                            <img src="<?= $profileinfo['bg_image'] ?>" alt="user image" />
<?php } ?>
                                        <div class="edit-pic-upl">
                                            <div class="edit-pic-in">
                                                <input type="file" name="bgfile" class="sl-img" >
                                                <span class="sl-img-z">Update Profile picture</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="edit-pic-upload">
                                        <input type="submit" name="bgfile" value="Upload Photo" class="upload-img"> 
                                    </div>

                                </form>
                            </div>

                            <div class="edit-info-sec">
                                <form method="post" action="">
                                    <!-- <a href="#" class="edt-anc" onclick="edit_profile()">Edit</a> -->
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Pet Name</label></div>
                                        <input type="text" class="ed-r"  name="name" value="<?php echo $profileinfo["pet_name"] ?>" placeholder="Pet name" readonly="" >
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Owner name</label></div>
                                        <input type="text" class="ed-r"  name="user_name" value="<?php echo $profileinfo["powner_name"] ?>" placeholder="Owner name" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>About Pet</label></div>
                                        <input type="text" class="ed-r"  name="user_about" value="<?php echo $profileinfo["about_data"] ?>" placeholder="About pet">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Type of pet</label></div>
                                        <input type="text" class="ed-r"  name="type_of_pet" value="<?php echo $profileinfo["type_of_pet"] ?>" placeholder="Type of pet" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>E-mail</label></div>
                                        <input type="text" class="ed-r"  name="email" value="<?php echo $profileinfo["email"] ?>" placeholder="Email" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Phone</label></div>
                                        <input type="text" class="ed-r"  name="phone" value="<?php echo $profileinfo["phone"] ?>" placeholder="Phone" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Birthday</label></div>
                                        <input type="text" class="ed-r"  name="birthday" value="<?php echo $profileinfo["dob"] ?>" placeholder="Birthday" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Country</label></div>
                                        <input type="text" class="ed-r"  name="country"  value="<?php echo $profileinfo["country"] ?>" placeholder="Country" readonly="">
                                    </div>
                                    <div class="save-btn">
                                        <input type="submit" name="submit_data" value="Save">
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
<?php require_once 'inc/ads_sidebar_d.php'; ?>
                </div>
            </div>
        </div>

<?php require_once 'inc/footer.php'; ?>
    </body>
</html>