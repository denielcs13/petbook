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
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page form-page create-event">
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
<?php
$error_ename=$error_eloc=$error_edesc=$error_edate=$error_etime="";
$profileqry=mysqli_query($conn,"SELECT pet_name
FROM user_inf
WHERE pet_unique_id =  '$parent_id'
UNION SELECT company_name
FROM business
WHERE business_uniqueid =  '$parent_id'
UNION SELECT ngo_name
FROM ngo_resgitration
WHERE ngo_unique_id =  '$parent_id'");
        $profileinfo=mysqli_fetch_assoc($profileqry);
        if (isset($_POST["submit"])) 
        {
        //$parent_id = $_SESSION['pet_unique_id'];
        $parent_id=$parent_id;
        $e_name = mysqli_real_escape_string($conn,$_POST["e_name"]);
        $e_by = $profileinfo['pet_name'];            
        $e_loc = mysqli_real_escape_string($conn,$_POST["e_loc"]);
        $e_date = $_POST["e_date"];
        $e_time = $_POST["e_time"];
        $e_desc= mysqli_real_escape_string($conn,$_POST["e_desc"]);
        
                if (empty($e_name)) {
                        $error_ename = "Enter Event Name";
                            }
                if (empty($e_loc)) {
                        $error_eloc = "Enter Event location";
                            }
                if (empty($e_date)) {
                        $error_edate = "Enter Event Date";
                            }
                if (empty($e_time)) {
                        $error_etime = "Enter Event Time";
                            }
                if (empty($e_desc)) {
                        $error_edesc = "Enter Event Description";
                            }
        
//                require_once './dbcon.php';
//                $q = "select * from events where user_id_fk ='" . $parent_id . "'";
//                $res = mysqli_query($conn, $q);
//                $group_info=mysqli_fetch_assoc($res);
//                if($group_info['event_name']=="$e_name")
//                    {
//                echo "<script>alert('Events Already Exist')</script>";             
//                                                         
//                    }
 
 else {
        require './dbcon.php';        
        $insert = "INSERT INTO `events`(`event_name`,`event_by`, `event_loc`, `event_desc`, `event_date`,`event_time`, `user_id_fk`, `created`, `status`) 
VALUES ('$e_name','$e_by','$e_loc','$e_desc','$e_date','$e_time','$parent_id',NOW(),'1')";
        //print_r($insert);
if ($conn->query($insert) === TRUE) {
    $last_id = $conn->insert_id;
    //echo $last_id;
    $_SESSION['e_name']= $e_name;
    $_SESSION['last_id']=$last_id;
}
        $insert1="INSERT INTO event_users(event_id_fk,user_id_fk,status) VALUES ('$last_id','$parent_id','1')";
                                   mkdir($parent_id . "/Events/".$e_name."/Photos", 0777, true);
                                   mkdir($parent_id . "/Events/".$e_name."/Videos", 0777, true);
                                   mkdir($parent_id . "/Events/".$e_name."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Events/".$e_name."/post_images", 0777, true);
                                   mkdir($parent_id . "/Events/".$e_name."/profile_pic", 0777, true);
           // print_r($insert);die;
            //$sqll=mysqli_query($conn, $insert);
            $sqll2=mysqli_query($conn, $insert1);
            //print_r($sqll);die;
            if ($sqll2>0) {            
               
                echo "<script>alert('Events created Successfully')</script>";
                echo "<script>window.location='events.php'</script>";
            }
            else{
      echo "<script>alert('Events not created')</script>";
      
      }
        }
        }
        ?>
<div class="main-content-inn-left products gallery">
<div class="col-first">

<div class="stat-textarea post-f">

<div class="uplbtn-btm">

<div class="cr-form">
<div class="reg-form-sec">
<div class="">
<div class="grp-top-opt">
	<h2 class="fr-heading">Create Events</h2>
	</div>
</div>
<form method="post" action="">
<div class="pt-dt">
<div class="form-row">
<label>Event Name</label>
<input type="text" name="e_name" placeholder="Event name" />
                                                    <?php
                                                        if (empty($_POST["e_name"])) {
                                                            echo "<p class='alrt' style='color:red'>" . $error_ename . "</p>";
                                                        }
                                                    ?>
</div>
<div class="form-row">
<label>Location</label>
<input type="text" name="e_loc" placeholder="Add Event Location" />
<?php
                                                        if (empty($_POST["e_loc"])) {
                                                            echo "<p class='alrt' style='color:red'>" . $error_eloc . "</p>";
                                                        }
                                                    ?>
</div>
<div class="form-row">
<label>Date</label>
<input type="date" name="e_date" placeholder="Event Date" id="datepicker"/>
<?php
                                                        if (empty($_POST["e_date"])) {
                                                            echo "<p class='alrt' style='color:red'>" . $error_edate . "</p>";
                                                        }
                                                    ?>
</div>
<div class="form-row">
<label>Time</label>
<input type="time" name="e_time" placeholder="Event Time" id="datepicker"/>
                                                    <?php
                                                        if (empty($_POST["e_time"])) {
                                                            echo "<p class='alrt' style='color:red'>" . $error_etime . "</p>";
                                                        }
                                                    ?>
</div>
<div class="form-row">
<label>Description</label>
<textarea name="e_desc" placeholder="Tell people more about the event"></textarea>
                                            <?php
                                                        if (empty($_POST["e_desc"])) {
                                                            echo "<p class='alrt' style='color:red'>" . $error_edesc . "</p>";
                                                        }
                                                    ?>
</div>
</div>
    <div class="sub-btn"><input type="submit"  name="submit" value="Save" /></div>
</form>
</div>
</div>
<div class="form-ri-img"><img src="images/form-l-img.jpg" alt=""></div>
</div>
</div>
<?php require_once 'inc/ads_sidebar_d.php'; ?>
</div>
</div>
</div>
<?php require_once 'inc/footer.php';  ?>
</body>
</html>