<?php
session_start();
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
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page create-event form-page edit-event">
<div class="col-first-side">
<?php 
				if ((isset($_SESSION['pet_unique_id']))) {   
				require_once 'inc/user_profile_sidebar.php';
				require_once 'inc/side-bar.php';
				require_once 'inc/rehome-a-pet-side-bar.php';				
                                                }
                                if ((isset($_SESSION['business_unique_id']))) {   
                                require_once 'inc/business_profile_sidebar.php';
                                require_once 'inc/side-bar.php';
                                                }
                                if ((isset($_SESSION['ngo_unique_id']))) {   
                                require_once 'inc/ngo_profile_sidebar.php';
                                                }

				?>
</div>
<?php
     $alrt='';
     //$parent_id = $_SESSION['pet_unique_id'];
        if (isset($_POST["submit"])) 
        {
        $e_name = mysqli_real_escape_string($conn,$_POST["e_name"]);            
        $e_loc = mysqli_real_escape_string($conn,$_POST["e_loc"]);
        $e_date = $_POST["e_date"];
        $e_time = $_POST["e_time"];
        $e_desc= mysqli_real_escape_string($conn,$_POST["e_desc"]);
        
        require_once './dbcon.php';        
        $insert = "UPDATE `events` SET `event_name`='$e_name',`event_loc`='$e_loc',`event_desc`='$e_desc',`event_date`='$e_date',`event_time`='$e_time',`updated`=NOW() where `event_id`= $_GET[id]";

                                  
           //print_r($insert);die;
            //$sqll=mysqli_query($conn, $insert);
            $sqll2=mysqli_query($conn, $insert);
            //print_r($sqll);die;
            if ($sqll2>0) {            
               
                $alrt= "Your record Updated Successfully";
                //echo "<script>window.location='events.php'</script>";
            }
            else{
      echo "<script>alert('Events not created')</script>";
      
      }
        }
        ?>
<div class="main-content-inn-left products gallery">
    <?php
        require 'dbcon.php';
       $results_display = mysqli_query($conn, "select * from events where event_id = '$_GET[id]'");
        $profileinfo = mysqli_fetch_assoc($results_display);

    ?>
<div class="col-first">

<div class="stat-textarea post-f">
    
<div class="">

	
</div>
<span class="su-msg"><center><?php print_r($alrt) ;?></center></span>
<div class="uplbtn-btm">

<div class="cr-form">
<div class="grp-top-opt">
	<h2 class="fr-heading">Edit Events </h2>
	</div>
<div class="reg-form-sec">
<form method="post" action="">
<div class="pt-dt">
<div class="form-row">
<label>Event Name</label>
<input type="text" name="e_name" value="<?php echo $profileinfo["event_name"] ?>" placeholder="Event name" />
</div>
<div class="form-row">
<label>Location</label>
<input type="text" name="e_loc" value="<?php echo $profileinfo["event_loc"] ?>" placeholder="Add Event Location" />
</div>
<div class="form-row">
<label>Date</label>
<input type="date" name="e_date" value="<?php echo $profileinfo["event_date"] ?>" placeholder="Event Date" id="datepicker"/>
</div>
<div class="form-row">
<label>Time</label>
<input type="time" name="e_time" value="<?php echo $profileinfo["event_time"] ?>" placeholder="Event Time" id="datepicker"/>
</div>
<div class="form-row">
<label>Description</label>
<textarea name="e_desc"  placeholder="<?php echo $profileinfo["event_desc"] ?>"><?php echo $profileinfo["event_desc"] ?></textarea>
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