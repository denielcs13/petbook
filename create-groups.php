<?php
session_start();
require './dbcon.php';
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}
?>
<html>
    <style>
    .alrt {
    float: left;
    top: -5px;
    position: relative;
    right: -4px;
    } 
        
    </style>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header_11.php'; ?>
        <?php
        $error_gname="";
        $q1 = "select pet_name from user_inf where pet_unique_id ='$parent_id' UNION select company_name from business where business_uniqueid ='$parent_id' UNION select ngo_name from ngo_resgitration where ngo_unique_id ='$parent_id'";
        $res1 = mysqli_query($conn, $q1);
        
        $group_info1 = mysqli_fetch_assoc($res1);
        if (isset($_POST["submit"])) {
            $name = mysqli_real_escape_string($conn,$_POST["gname"]);
            $desc = mysqli_real_escape_string($conn,$_POST["desc"]);
            $g_by = $group_info1['pet_name'];
            //$group_id= rand(222222, 9999999);
            //$ran = $group_id;
//            $q = "select * from groups where user_id_fk ='" . $parent_id . "'";
//            $res = mysqli_query($conn, $q);
            //print_r($res);
            if (empty($name)) {
                $error_gname = "Enter Group Name";
                    }
             else {

                //$insert = "INSERT INTO groups(group_name,group_desc,user_id_fk) VALUES ('$name','$desc','$parent_id')";
                $insert = "INSERT INTO groups(group_type,group_name,group_by,group_desc,user_id_fk,status) VALUES ('Group','$name','$g_by','$desc','$parent_id','1')";
                if ($conn->query($insert) === TRUE) {
                    $last_id = $conn->insert_id;
                    //echo $last_id;
                    //$_SESSION['last_id'] = $last_id;
                    //$_SESSION['name'] = $name;
                }
                $insert1 = "INSERT INTO group_users
(group_id_fk,user_id_fk,status) 
VALUES 
('$last_id','$parent_id','1')";
                mkdir($parent_id . "/Groups/" . $name . "/Photos", 0777, true);
                mkdir($parent_id . "/Groups/" . $name . "/Videos", 0777, true);
                mkdir($parent_id . "/Groups/" . $name . "/Shared_Videos", 0777, true);
                mkdir($parent_id . "/Groups/" . $name . "/post_images", 0777, true);
                mkdir($parent_id . "/Groups/" . $name . "/profile_pic", 0777, true);
                // print_r($insert);die;

                $sqll2 = mysqli_query($conn, $insert1);
                //print_r($sqll);die;
                if ($sqll2 > 0) {


                    
                    echo "<script>window.location='groups.php?cr_id=".$last_id."';</script>";
                } else {
                    echo "<script>alert('Unable to create Group')</script>";
                }
            }
        } 
        ?>

        <?php 
    
        $profileqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo = mysqli_fetch_assoc($profileqry);
        ?>
        <div class="main-content" id="page-load-ref">

            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw  create-new-page form-page create-grp">
                <div class="col-first-side">
        <?php
                    if((isset($_SESSION['pet_unique_id']))) {   
                   require_once 'inc/user_profile_sidebar.php'; 
                   require_once 'inc/side-bar.php';
                   require_once 'inc/rehome-a-pet-side-bar.php';
                   }
                   if((isset($_SESSION['business_unique_id']))) {   
                   require_once 'inc/bus_profile_sidebar.php'; 
                   }
                   if ((isset($_SESSION['ngo_unique_id']))) {   
                   require_once 'inc/ngo_profile_sidebar.php';
                       }                   
                 ?>                
                </div>
                <div class="main-content-inn-left" >
                    <div class="col-first" id="load-post-ref">
                        <div class="stat-textarea post-f">

                            <div class="uplbtn-btm">
                                
                                <div class="cr-form">
                                    <div class="reg-form-sec">
<div class="sel-cat">
                                    <h2 class="page-h-t">Create Group</h2>
                                </div>
                                        <form action="" method="post" id="group-cform">
                                            <div class="pt-dt">
                                                <div class="form-row">
                                                    <label>Name your group</label>
                                                    <input type="text" name="gname" placeholder="Group Name" />
                                                    <?php
                                                        if (empty($_POST["gname"])) {
                                                            echo "<p class='alrt' style='color:red'>" . $error_gname . "</p>";
                                                        }
                                                    ?>
                                                </div>
                                                <div class="form-row">
                                                    <label>Description</label>
                                                    <input type="text" name="desc" placeholder="Descriptions" />
                                                </div>
                                            </div>
                                            <div class="sub-btn">
                                                <div class=""><input type="submit" name="submit" value="Save" /></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
<div class="form-ri-img"><img src="images/form-l-img.jpg" alt=""></div>
                            </div>

                        </div>

                    </div>
<?php require_once 'inc/ads_sidebar_d.php'; ?>
                </div>
            </div>
        </div>
<?php require_once 'inc/footer.php'; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
    </body>
</html>