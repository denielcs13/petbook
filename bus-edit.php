<?php
session_start();
if (!(isset($_SESSION['business_unique_id']))) {
     header('Location:index.php');
}
$parent_id = $_SESSION['business_unique_id'];
 require 'dbcon.php';
?>
<html>
    <?php
    session_start();
    $alrt = '';
    //$id = $_SESSION["business_unique_id"];
    $id=$parent_id;
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
            require './dbcon.php';
            $insert = "update  business set  profile_image = '$target_path' where business_uniqueid = $id";
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
            require './dbcon.php';
            $insert = "update  business set  bg_image = '$target_path' where business_uniqueid = $id";
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
        $business_type = $_POST["business_type"];
        $description = $_POST["description"];
        $website = $_POST["website"];
        $email = $_POST["email"];
        $company_name = $_POST["company_name"];
        $country = $_POST["country"];
        $phone = $_POST["phone"];
        require './dbcon.php';
        $insert = "update  business set business_type = '$business_type',description='$description',website = '$website',email ='$email',company_name='$company_name',country='$country',phone='$phone',
        updateOn=NOW() where business_uniqueid = $id";
        //print_r($insert);die;
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
                   <?php require_once 'inc/bus_profile_sidebar.php'; ?>

                </div>
                <div class="main-content-inn-left">

                    <?php
                    require 'dbcon.php';
                    $results_display = mysqli_query($conn, "select * from business where business_uniqueid = '$id'");
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
                    if ($profileinfo['profile_image'] == "") {
                        echo "<img src='images/fr-pro-big-img.jpg'>";
                    } else {
                        ?>
                                            <img src="<?= $profileinfo['profile_image'] ?>" alt="user image" />
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
                                        <div class="ed-l"><label>Company Name</label></div>
                                        <input type="text" class="ed-r"  name="company_name" value="<?php echo $profileinfo["company_name"] ?>" placeholder="Pet name" readonly="" >
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Category</label></div>
                                        <input type="text" class="ed-r"  name="business_type" value="<?php echo $profileinfo["business_type"] ?>" placeholder="Owner name" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Description</label></div>
                                        <input type="text" class="ed-r"  name="description" value="<?php echo $profileinfo["description"] ?>" placeholder="About pet">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Website</label></div>
                                        <input type="text" class="ed-r"  name="website" value="<?php echo $profileinfo["website"] ?>" placeholder="Type of pet" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>E-mail</label></div>
                                        <input type="text" class="ed-r"  name="email" value="<?php echo $profileinfo["email"] ?>" placeholder="Email" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Country</label></div>
                                        <input type="text" class="ed-r"  name="country"  value="<?php echo $profileinfo["country"] ?>" placeholder="Country" readonly="">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Phone</label></div>
                                        <input type="text" class="ed-r"  name="phone" value="<?php echo $profileinfo["phone"] ?>" placeholder="Phone" readonly="">
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