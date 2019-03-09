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
  
  <style>
  #page-create-area2 .page-upl-image {
	  display:none;
  }
  .upload-page-pic {
	  -webkit-appearance: button;
background:#4eb900;
color:#fff;
	border: 0;
    width: auto;
    padding: 5px 26px;
    float: right;
    border-radius: 4px;
  }
  #page-create-area1 .page-pic-hidden {
	  display:none;
  }
  </style>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
		$page_image=$_POST["page-image"];
        $c_name= $_POST["c_name"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $position = $_POST["position"];
        
		$image_name =$_FILES['pgimage']['name'];
	$image_type=$_FILES['pgimage']['type'];
	$image_size=$_FILES['pgimage']['size'];
	$image_tmpname=$_FILES['pgimage']['tmp_name'];
        
                $q = "select * from pages where user_id_fk ='" . $parent_id . "'";
                $res = mysqli_query($conn, $q);
               
                $group_info=mysqli_fetch_assoc($res);
                if($group_info['pages']=="$p_name")
                    {
    echo "<script>alert('Page Already Exist')</script>";             
                                                         
                    }
 else {
   
        
$insert = "INSERT INTO pages(page_type,page_name,page_desc,website,user_id_fk,status)VALUES('page','$p_name','$desc','$web_name','$parent_id','1')";

if ($conn->query($insert) === TRUE) {
    $last_id = $conn->insert_id;
    
    $_SESSION['name']= $p_name;
    $_SESSION['last_id']=$last_id;
   
}
        $insert1="INSERT INTO page_users (page_id_fk,user_id_fk,status) VALUES ('$last_id','$parent_id','1')";
                                   mkdir($parent_id . "/Pages/".$p_name."/Photos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/post_images", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/profile_pic", 0777, true);
          
            $sqll2=mysqli_query($conn, $insert1);
			
	
	
        $target_path = $parent_id ."/Pages/".$p_name."/profile_pic/" . basename($_FILES['pgimage']['name']);   
            
	if($image_type=='image/png' or $image_type=='image/jpeg' or $image_type=='image/jpg'){
		move_uploaded_file($image_tmpname,$target_path);      
		mysqli_query($conn,"update pages SET pg_profile_pic='$target_path' WHERE page_id='$last_id'");
		}
			
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
        
        $profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo=mysqli_fetch_assoc($profileqry);        
        ?>
<div class="main-content-inn-left products gallery">
<div class="col-first" id="page-create-area1">

<div class="stat-textarea post-f">

<div class="uplbtn-btm">
<div class="cr-form">
<div id="tabs">

	<div class="sel-cat">
    <form action="">
	<ul class="sel-tbs">
    <li>
    <a href="#tabs-1">
    <input type="radio"  name="p_type" value="professional" id="professional" style="display:none"/>
    <label for="professional">I am a Professional</label>
    </a>
    </li>
    <li>
    <a href="#tabs-2">
    <input type="radio" name="c_type" value="charity" id="charity" style="display:none"/>
    <label for="charity">Charity</label>
    </a>
    </li>
	<li>
    
    </li>
	</ul>
	</form>
	</div>
  
  <div id="tabs-1">	

<div class="reg-form-sec">
<form enctype="multipart/form-data" method="post" action="" id="page-create-form">
<div class="pt-dt">
<div class="form-row">
<select>
	<option>Shop</option>
	<option>Medical Service</option>
	<option>Animal Service</option>
	</select>
</div>
<div class="form-row">

<input type="text" name="p_name" placeholder="Page name" />
</div>
<div class="form-row">

<textarea name="desc" placeholder="Description"></textarea>
</div>

<div class="form-row">

<input type="text" name="web_name" placeholder="http://"/>
</div>

</div>
    <div class="sub-btn"><input type="submit" id="page-submit-act" name="submit" value="Save Page" /></div>
	<div class="sub-btn"><button id="page-create-nxt">Next Step</button></div>
</form>
</div>
  
  </div>
  <div id="tabs-2">
    
<div class="reg-form-sec">
<form method="post" action="">
<div class="pt-dt">
<div class="form-row">
<select>
<option>Defense / Protection</option>
<option>Shelter</option>
<option>Pets Association</option>
</select>
</div>
<div class="form-row">

<input type="text" name="p_name" placeholder="Page name" />
</div>
<div class="form-row">

<textarea name="desc" placeholder="Description"></textarea>
</div>
<div class="form-row">

<input type="text" name="web_name" placeholder="http://"/>
</div>

</div>
    <div class="sub-btn"><input type="submit"  name="submit" value="Save" /></div>
</form>
</div>

  </div>
  </div>
  
</div>
<div class="form-ri-img"><img src="images/form-l-img.jpg" alt=""></div>

</div> 
</div>
<?php require_once 'inc/ads_sidebar_d.php'; ?>
</div>

<div class="col-first" id="page-create-area2" style="display:none;">

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
<label class="upload-page-pic">Upload<input type="file" name="pgimage" id="page-image-upl" class="page-upl-image"></label>
</div>
</div>
  <button id="save-page">Save Page</button>
</div>

<div class="form-ri-img"><img src="images/form-l-img.jpg" alt=""></div>

</div>
</div>

</div>



</div>
</div>
<script>
$(document).ready(function() {
	$('#page-create-nxt').on('click',function(e) {
		e.preventDefault();
		$('#page-create-area1').css('position','fixed');
		$('#page-create-area2').show();
		
		
	});	

});
</script>
<script>

$(document).on('click','#save-page',function(e) {
	e.preventDefault();
	$('#page-create-form').append($('#page-image-upl'));
	
	$('#page-submit-act').click();
	
});

</script>
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