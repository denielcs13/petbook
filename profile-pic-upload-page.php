<?php
session_start();
require 'dbcon.php';
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
<?php require_once 'inc/head-content.php'; ?>
  <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page create-form-page form-page">
<div class="col-first-side" id="">
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

<script>

$(document).ready(function() {
    $(".cate-hld a").click(function(){
        $("this").addClass("select").siblings().removeClass("select");   
    });
});

/*$('.cate-hld a').on('click', 'a', function(){
    $('.cate-hld a').removeClass('active');
    $(this).addClass('active');
});*/
</script>

</div>
    <?php
        if (isset($_POST["submit"])) 
        {
       
        //$p_type = $_POST["p_type"];
        $p_name = $_POST["p_name"];            
        $desc = $_POST["desc"];
        $web_name = $_POST["web_name"];
        $c_name= $_POST["c_name"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $position = $_POST["position"];
        //$group_id= rand(222222, 9999999);
        //$ran = $group_id;  
        //print_r($_POST);die;
        
                $q = "select * from pages where user_id_fk ='" . $parent_id . "'";
                $res = mysqli_query($conn, $q);
                //print_r($res);
                $group_info=mysqli_fetch_assoc($res);
                if($group_info['pages']=="$p_name")
                    {
    echo "<script>alert('Page Already Exist')</script>";             
                                                         
                    }
 else {
        
        
        $insert = "INSERT INTO pages(page_type,page_name,page_desc,website,user_id_fk,status) 
VALUES ('page','$p_name','$desc','$web_name','$parent_id','1')";
//print_r($insert);die;
if ($conn->query($insert) === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
    $_SESSION['name']= $p_name;
    $_SESSION['last_id']=$last_id;
    //print_r($_SESSION);die;
}
        $insert1="INSERT INTO page_users (page_id_fk,user_id_fk,status) VALUES ('$last_id','$parent_id','1')";
                                   mkdir($parent_id . "/Pages/".$p_name."/Photos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/post_images", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/profile_pic", 0777, true);
           // print_r($insert);die;
            //$sqll=mysqli_query($conn, $insert);
            $sqll2=mysqli_query($conn, $insert1);
            //print_r($sqll);die;
            if ($sqll2>0) {            
               
                echo "<script>alert('Page created Successfully')</script>";
                echo "<script>window.location='pages1.php?id=".$last_id."'</script>";
            }
            else{
      echo "<script>alert('Page not created')</script>";
      
      }
        }
        }
        ?>
<?php
         //$parent_id = $_SESSION['pet_unique_id'];
        $profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo=mysqli_fetch_assoc($profileqry);        
        ?>
<div class="main-content-inn-left products gallery">
<div class="col-first">

<div class="stat-textarea post-f">

<div class="uplbtn-btm">
<div class="cr-form">

<div class="pro-pic-upld-f">
<div class="pro-pic-h">
<h2>Add a Profile Picture</h2>
<h4>Help people find your Page by adding a photo.</h4>
</div>
<div class="pro-d-img"><img src="images/profile-dummy-img.png" alt="user image"></div>
<div class="sub-btn">
<button class="skip">skip</button>
<input type="submit" name="file" value="Upload Picture" class="upload-img">
</div>
</div>
  
</div>
<div class="form-ri-img"><img src="images/form-l-img.jpg" alt=""></div>

</div>
</div>
<?php require_once 'inc/ads_sidebar_d.php'; ?>
</div>



</div>
</div>

<script>
$(document).ready(function() {
    $(".cate-hld a").click(function(){
        $("this").addClass("select").siblings().removeClass("select");   
    });
});

$(".test li").click(function() {
    alert($(this).text()); 
    var category = $(this).text();  
});

</script>
<?php require_once 'inc/footer.php';  ?>
</body>
</html>