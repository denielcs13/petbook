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
    <?php require_once 'inc/head-content.php'; ?>	

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/countries.js"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body class="pet-form-page">
        <?php require_once 'inc/header_11.php'; ?>        

        <div class="main-content" id="page-load-ref">

            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw  create-new-page create-grp pet-rehome width-re-agn">
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
				require_once 'inc/rehome-a-pet-side-bar.php'; 
                                                }
                                if ((isset($_SESSION['ngo_unique_id']))) {   
                                require_once 'inc/ngo_profile_sidebar.php';
                                //require_once 'inc/side-bar.php';
				//require_once 'inc/rehome-a-pet-side-bar.php';
                                }

		     ?>
                </div>
                <?php
                    $alrt="";
                    //$parent_id = $_SESSION['pet_unique_id'];
                    $error_location="";
                    if (isset($_POST["sub"])) {			
                       $location = $_POST["location"];
                       $type= $_POST["type"];
                       $breed= $_POST["breed"];
                       $pet_name= $_POST["pet_name"];
                       mkdir($parent_id . "/Adopt", 0777, true);
                       $image_name =$_FILES['file']['name'];
                       $image_type=$_FILES['file']['type'];
                       $image_size=$_FILES['file']['size'];
                       $image_tmpname=$_FILES['file']['tmp_name'];
                       $target_path = $parent_id . "/Adopt/" . basename($_FILES['file']['name']);
//                       if($image_type=='application/msword' or $image_type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type=='application/pdf' or $image_type=='image/png' or $image_type=='image/jpeg' or $image_type=='image/jpg'){
//                                                                    
//                                move_uploaded_file($image_tmpname,$target_path);
//                        }
                       move_uploaded_file($image_tmpname,$target_path);
                       $gender = $_POST["radio1"];
                       $age = $_POST["age"];
                       $email = $_POST["email"];
                       $country = $_POST['country'];
                       $state = $_POST['state'];
                       $address = mysqli_real_escape_string($conn,$_POST["description"]);                       
                       if(empty($location))
                       {
                       $error_location = "Enter location";
                       }
                       if(!empty($location))
                       {
                     require './dbcon.php';
                    //$random_number = rand(1111111, 9999999);
//$pet_adopt_query = "INSERT INTO `adopt_pet`(`adopt_pet_unique_id`, `location`, `type`, `breed`, `pet_name_adopt`, `sex`, `age`, `about_pet`) VALUES ('$random_number','$location','$type','$breed','$pet_name','$gender','$age','$address')";
$pet_adopt_query="INSERT INTO `adopt_pet`(`adopt_pet_unique_id`, `location`, `type`, `breed`, `pet_name_adopt`,`pet_photo` ,`sex`, `age`,`email`, `about_pet`,`status`,`country`,`state`,`createdOn`) VALUES ('$parent_id','$location','$type','$breed','$pet_name','$target_path','$gender','$age','$email','$address','1','$country','$state',NOW())";

                       $sqll=mysqli_query($conn,$pet_adopt_query);
                       if($sqll>0){
                       $alrt = "Record inserted sucessfully";
                      // header("Location:adopt-pet.php");
                       //header("location: adopt-pet.php");
                      echo "<script>alert('Record inserted sucessfully')</script>";
                      echo "<script>window.location='adopt-pet.php'</script>";
					  //echo "<script> $('#adopt-pet-form')[0].reset();</script>";
					  echo "<script>$('.su-msg center').text('Record inserted sucessfully');</script>";
                      // exit;
                       }
                       }
                    }
                    ?>
                <div class="main-content-inn-left" >
                    <div class="col-first" id="load-post-ref">
                        <div class="stat-textarea post-f">
                            <div class="uplbtn-btm">
                            <?php
                            require './dbcon.php';
                            $display_count = "select * from adopt_pet where adopt_pet_unique_id = '$parent_id' and status = '1'";
                            $query = mysqli_query($conn,$display_count);
                            $display_counts = mysqli_num_rows($query);
                            ?>
                                <div class="">
                                    <div class="sel-cat ind-post-hd">
                                        <h2 class="page-h-t">Adopt A Pet</h2><a href="adpot-list-details.php">List of adopt pet post<span class="list-counts">(<?php echo $display_counts?>)</span></a>
                                    </div>
                                    <span class="su-msg"><center><?php print_r($alrt); ?></center></span>
                                </div>                                
                                <div class="cr-form">
                                    <div class="reg-form-sec">
                                        <form action="adopt-pet.php" id="adopt-pet-form" method="post" enctype="multipart/form-data">
                                            <?php
                                            if (empty($error)) {
                                                echo $error;
                                            }
                                            ?>
                                            <div class="pt-dt">
                                                <div class="form-row">
                                                    <input type="text" name="location" placeholder="Address"/>
                                                     <?php
			                                if (empty($_POST["location"])) {
			                                    echo "<p style='color:red'>" . $error_location  . "</p>";
			                                }
			                                ?>
                                                </div>
                                                <div class="form-row">
                                                    <select name="type">
                                                        <optoin value="">Search</option>
                                                        <option value="Dog">Dog</option>
                                                        <option value="Cat">Cat</option>
                                                        <option value="Rabbit">Rabbit</option>
                                                        <option value="Rat">Rat</option>
                                                    </select>
                                                </div>

                                                <div class="form-row">
                                                    <select name="breed">
                                                        <option value="">Select breed</option>
                                                        <option value="Border collie">Border collie</option>
                                                        <option value="Poodle">Poodle</option>
                                                        <option value="Indie">Indie</option>
                                                        <option value="German shepherd">German shepherd</option>
                                                        <option value="Golden retriever">Golden retriever</option>
                                                        <option value="Doberman pinscher">Doberman pinscher</option>
                                                        <option value="Shetland sheepdog">Shetland sheepdog</option>
                                                        <option value="Labrador retriever">Labrador retriever</option>
                                                        <option value="Papillon">Papillon</option>
                                                        <option value="Rottweiler">Rottweiler</option>
                                                        <option value="Australian cattle dog">Australian cattle dog</option>
                                                    </select>
                                                </div>

                                                <div class="form-row brws-img">
                                     <input type="text" name="pet_name" placeholder="Pet Name" onchange="loadFile(event)"/>
                                                </div>
                                                <div class="form-row brws-img">
<div class="le-ri-im-l"><div class="left-im-l">
                               <input type="file" placeholder="Pet Photo" name="file" onchange="loadFile(event)"/></div>
                               			<div class="right-im-l"><img id="images"/></div>
							<script>
							  var loadFile = function(event) {
							    var reader = new FileReader();
							    reader.onload = function(){
							      var output = document.getElementById('images');
							      output.src = reader.result;
							    };
							    reader.readAsDataURL(event.target.files[0]);
							  };
							</script>                                                      

                                                </div></div>
                                                 
                                                
                                                
                                                
                                                
                                                <div class="form-row">
                                                    <input type="text" name="age" placeholder="Age"/>
                                                </div>
                                                <div class="form-row">
                                                   <input type="text" name="email" placeholder="Email"/>
                                                </div>
<div class="form-row rdo-row">
                                                    <label>Sex</label>
                                                    <div class="rdo">
                                                        <input type="radio" name="radio1" value="male" /><span>Male</span>
                                                        <input type="radio" name="radio1" value="female" /><span>Female</span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                   <textarea name="description" placeholder="About Pet"></textarea>
                                                </div>
                                                <div class="form-row">
                                                <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>
							</div>
<div class="form-row">
						
					        <select name ="state" id ="state"></select>
						<script language="javascript">print_country("country");</script>
					        </div></div>
                                            <div class="sub-btn">
                                                <input type="submit" value="Save" name="sub"/>
                                            </div>
                                        </form>
					
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-second">
				<!--pet mate and adopt -->
                                <?php require_once 'inc/adopt-pet-sidebar.php'; ?>                      
                        

 


                        <script type="text/javascript">
                        var jQuery =$;
                        //jQuery.noConflict();
                            jQuery(document).ready(function () {
                                jQuery('.frn_req_acc').on('click', function (e) {
                                    e.preventDefault();
                                    var acc_id = jQuery(this).attr('id');

                                    jQuery.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {accept: acc_id},
                                        cache: false,
                                        success: function (data) {

                                            jQuery('#' + acc_id + '.frn_req_acc').parent().html("ACCEPTED");
                                            jQuery('#friend-req-show').load(document.URL + ' #friend-req-show');
                                            jQuery('#friends-list').load(document.URL + ' #friends-list');
                                        }
                                    });
                                }),
                                        jQuery('.frn_req_rej').on('click', function (e) {
                                    e.preventDefault();
                                    var rej_id = $(this).attr('id');
                                    jQuery.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {reject: rej_id},
                                        cache: false,
                                        success: function (data) {
                                            jQuery('#' + rej_id + '.frn_req_rej').parent().html("REJECTED");
                                            jQuery('#friend-req-show').load(document.URL + ' #friend-req-show');
                                        }
                                    });
                                });
                            });
                        </script>
                                                
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
