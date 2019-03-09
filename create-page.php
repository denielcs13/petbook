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
    <style>
        p.alrt {
    float: left;
    position:  relative;
    top: -6px;
}
        
    </style>
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
  span#frm-alert-desc,span#frm-alert-name,span#frm-alert-type,span#frm-alert-pic {
	  display:none;
	  border:none;
	  color:RED;
  }
  input#page-submit-act {
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
        $p_name = mysqli_real_escape_string($conn,$_POST["p_name"]);            
        $desc = mysqli_real_escape_string($conn,$_POST["desc"]);
        $web_name = $_POST["web_name"];
        $p_type=$_POST["p_type"];
        $image_name =$_FILES['pgimage']['name'];
	$image_type=$_FILES['pgimage']['type'];
	$image_size=$_FILES['pgimage']['size'];
	$image_tmpname=$_FILES['pgimage']['tmp_name'];       
                

$insert="INSERT INTO `pages` ( `page_type` , `page_cat` , `page_name` , `page_desc` , `website` , `user_id_fk` , `created` , `status` )
VALUES ('page', '$p_type', '$p_name', '$desc', '$web_name', '$parent_id', NOW( ) , '1')";
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
               
                //echo "<script>alert('Page created Successfully')</script>";
                echo "<script>window.location='pages1.php?id=".$last_id."'</script>";
				
            }
            else{
      echo "<script>alert('Page not created')</script>";
      
      }
        
        }
        
        $profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo=mysqli_fetch_assoc($profileqry);        
        ?>
<div class="main-content-inn-left products gallery">
<div class="col-first" id="page-create-area1">

<div class="stat-textarea post-f">

<div class="uplbtn-btm">
<div class="cr-form create-page-f">
<div class="grp-top-opt">
	<h2 class="fr-heading">Create Page</h2>
	</div>
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
<select name="p_type" id="type_pet">
        <option value="">Select Type</option>
        <option value="Shop" selected>Shop</option>
        <option value="Medical Service">Medical Service</option>
        <option value="Animal Service">Animal Service</option>
</select>
<span id="frm-alert-type">Please Select Type</span>
</div>
<div class="form-row">

<input type="text" name="p_name" placeholder="Page name" />
   <span id="frm-alert-name">Please Enter Page Name</span>                                             
</div>
<div class="form-row">

<textarea name="desc" placeholder="Description"></textarea>
     <span id="frm-alert-desc">Please Enter a Description</span>                                               
</div>

<div class="form-row">

<input type="text" name="web_name" placeholder="http://"/>
</div>

</div>
    <div class="sub-btn"><input type="submit" id="page-submit-act" name="submit" value="Save Page">
	<button id="page-create-nxt" class="nxt-btn">Next Step</button></div>
	
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
<div class="cr-form create-page-f">

<div class="reg-form-sec">
<div class="pro-pic-upld-f"> 
<div class="pro-pic-h">
<h2>Add a Profile Picture</h2>
<h4>Help people find your Page by adding a photo.</h4>
</div>
<div class="pro-d-img"><img src="images/profile-dummy-img.png" alt="user image"></div>
<label class="upload-page-pic">Upload<input type="file" name="pgimage" id="page-image-upl" class="page-upl-image"></label>
<span id="frm-alert-pic">Please Upload an Image</span>
</div>

<div class="sub-btn">
<button class="skip save-grn-btn" id="skip-pic-upl">Skip & Save</button>
<button id="save-page" class="save-grn-btn">Save Page</button>
</div>

</div>

  
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
		
		if($(this).parent().parent().find('select option:selected').val()=='') {
			$(this).parent().parent().find('#frm-alert-type').show();
			return;
		}
		if($(this).parent().parent().find('input[name="p_name"]').val()=='') {
			$(this).parent().parent().find('#frm-alert-name').show();
			return;
		} 
		if($(this).parent().parent().find('textarea[name="desc"]').val()=='') {
			$(this).parent().parent().find('#frm-alert-desc').show();			
			return;
		}
		$('#page-create-area1').css('position','fixed');
		$('#page-create-area2').show();
		
		
	});	

});
</script>
<script>

$(document).on('click','#save-page',function(e) {
	e.preventDefault();
	if($(this).parent().parent().find('input[name="pgimage"]').val()=='') {
		$(this).parent().parent().find('#frm-alert-pic').show();
		$(this).parent().parent().find('#frm-alert-pic').fadeOut(2000);
		return;
	}
	$('#page-create-form').append($('#page-image-upl'));
	//$('form#page-create-form').submit();
	$('#page-submit-act').click();
	
});
$(document).on('click','#skip-pic-upl',function(e) {
	e.preventDefault();
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