<?php
session_start();
  if(!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
  }
  ?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header.php';  ?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page create-event">
<div class="col-first-side">
  <?php
        if (isset($_POST["submit"])) 
        {
        $parent_id = $_SESSION['pet_unique_id'];
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
        require_once './dbcon.php';
                $q = "select * from pages where user_id_fk ='" . $parent_id . "'";
                $res = mysqli_query($conn, $q);
                //print_r($res);
                $group_info=mysqli_fetch_assoc($res);
                if($group_info['pages']=="$p_name")
                    {
    echo "<script>alert('Page Already Exist')</script>";             
                                                         
                    }
 else {
        require './dbcon.php';
        
        $insert = "INSERT INTO pages( page_name,page_desc,website,country_name,f_name,l_name,phone_num,position,user_id_fk,status) 
VALUES ('$p_name','$desc','$web_name','$c_name','$fname','$lname','$phone','$position','$parent_id','1')";
//print_r($insert);die;
if ($conn->query($insert) === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
    $_SESSION['page_name']= $p_name;
    $_SESSION['$last_id']=$last_id;
    //print_r($_SESSION);die;
}
        $insert1="INSERT INTO page_users
(page_id_fk,user_id_fk,status) 
VALUES 
('$last_id','$parent_id','1')";
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
                echo "<script>window.location='pages.php'</script>";
            }
            else{
      echo "<script>alert('Page not created')</script>";
      
      }
        }
        }
        ?>
    <?php
         $parent_id = $_SESSION['pet_unique_id'];
        $profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo=mysqli_fetch_assoc($profileqry);
        
        ?>
<div class="pro-pic-sec">
<div class="pht"><?php if($profileinfo['profile_pic']=="") {
              echo "<img src='images/fr-pro-big-img.jpg'>";
              }
              else {
              ?>
              <img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
              <?php } ?></div>
<div class="pet-info">
<p>Name: <?= $profileinfo['pet_name']; ?></p>
<p>DOB: <?= $profileinfo['dob']; ?></p>
</div>
<div class="pet-info">
<p>Owner: <?= $profileinfo['powner_name']; ?></p>
</div>
</div>

<div class="pro-right-sec">
<div class="sidebar">
<ul>
<li><a href="#"><span class="icn"><img src="images/create-page-icon.png" alt="icon" /></span>Create Page</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Create Groups</a></li>
<li><a href="#"><span class="icn"><img src="images/event-icon.png" alt="icon" /></span>Events</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Create Ads</a></li>
<li><a href="#"><span class="icn"><img src="images/notes-icon.png" alt="icon" /></span>Create Notes</a></li>
<li><a href="#"><span class="icn"><img src="images/rec-icon.png" alt="icon" /></span>Recommendations</a></li>
</ul>
</div>
</div>
</div>

<div class="main-content-inn-left products gallery">
<div class="col-first">

<div class="stat-textarea post-f">
<div class="">
<div class="grp-top-opt">
	<h2 class="fr-heading">Create Events</h2>
	</div>
</div>
<div class="uplbtn-btm">

<div class="cr-form">
<div class="reg-form-sec">
<form method="post" action="">
<div class="pt-dt">
<div class="form-row">
<label>Event Photo or Video</label>
<input type="file" name="" placeholder="Page name" />
</div>

<div class="form-row">
<label>Event Name</label>
<input type="text" name="" placeholder="Event name" />
</div>
<div class="form-row">
<label>Location</label>
<input type="text" name="" placeholder="Add Location" />

</div>
<div class="form-row">
<label>Date/Time</label>
<input type="text" name="" placeholder="" id="datepicker"/>
</div>

<div class="form-row">
<label>Description</label>
<textarea placeholder="Tell people more about the event"></textarea>
</div>


<div class="form-row invt-g">
<label><input type="checkbox" id="" /> Guests can invite friends</label>

</div>
</div>
    <div class="sub-btn"><input type="submit"  name="submit" value="Create" /></div>
</form>
</div>
</div>
</div>
</div>


<div class="col-third ads-sec">
<div class="ltst-arc">
<h2>The latest articles</h2>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image03.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image07.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>

<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image05.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>

</div>
</div>
</div>



</div>
</div>



<?php require_once 'inc/footer.php';  ?>
</body>
</html>