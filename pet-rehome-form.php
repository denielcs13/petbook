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
if(!(isset($_SESSION['pet_unique_id'])) && !(isset($_SESSION['business_unique_id'])) && !(isset($_SESSION['ngo_unique_id']))) {
header('Location:index.php');
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

            <!-- <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw  create-new-page create-grp pet-rehome"> -->
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
                    $error_spices=$error_pet_name=$error_description=$error_email=$error_phone="";
                    if (isset($_POST["sub"])) {
                       $species = $_POST["species"];
                       $pet_name = $_POST["pet_name"];
                       if (!file_exists('$parent_id . "/Rehome"')) {
                       mkdir($parent_id . "/Rehome", 0777, true);
                         }
                       //mkdir($parent_id . "/Rehome", 0777, true);
                       $image_name =$_FILES['file']['name'];
                       $image_type=$_FILES['file']['type'];
                       $image_size=$_FILES['file']['size'];
                       $image_tmpname=$_FILES['file']['tmp_name'];
                       $target_path = $parent_id . "/Rehome/" . basename($_FILES['file']['name']);
//                       if($image_type=='application/msword' or $image_type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type=='application/pdf' or $image_type=='image/png' or $image_type=='image/jpeg' or $image_type=='image/jpg'){
//                                                                    
//                                move_uploaded_file($image_tmpname,$target_path);
//                        }
                       move_uploaded_file($image_tmpname,$target_path);
                       $description = mysqli_real_escape_string($conn,$_POST["description"]);
                       $color = $_POST["color"];
                       $sex = $_POST["sex"];
                       $age = $_POST["age"];
                       $email = $_POST["email"];
                       $phone_number = $_POST["phone_number"];
                       $address = $_POST["address"];
                       $country = $_POST['country'];
                       $state = $_POST['state'];
                       if(empty($species))
                       {
                       $error_spices = "Select spices";
                       }
                       if(empty($pet_name))
                       {
                       $error_pet_name = "Enter pet name";
                       }
                       if(empty($description))
                       {
                       $error_description = "Enter description";
                       }
                       if(empty($email))
                       {
                       $error_email = "Enter email";
                       }
                       if(empty($phone_number))
                       {
                       $error_phone = "Enter number";
                       }
                       if(!empty($species) && !empty($pet_name) && !empty($description) && !empty($email) && !empty($phone_number))
                       {
                       require './dbcon.php';
                       $pet_email = "select * from pet_rehome where email = '$email'";
                       $results = mysqli_query($conn,$pet_email);
                       if(mysqli_num_rows($results)==1)
                       {                       
                       $message = "Already exist email";
                       echo "<script type='text/javascript'>alert('$message');</script>";
                       
                       }
                       
                       else
                       {
                    require './dbcon.php';
                    //$random_number = rand(1111111, 9999999);
$pet_rehome_query = "INSERT INTO `pet_rehome`(`species`, `pet_name`,`pet_photo`,`user_id_fk`,`about_pet`, `colour`, `sex`, `age`, `email`, `phone`, `address`,`status`,`country`,`state`,`createdOn`) VALUES ('$species','$pet_name','$target_path','$parent_id','$description','$color','$sex','$age','$email','$phone_number','$address','1','$country','$state',NOW())";
//print_r($pet_rehome_query);die;
                       $sqll=mysqli_query($conn,$pet_rehome_query);
                       if($sqll>0){
                       $alrt = "Record inserted sucessfully";
                       header("Location:pet-rehome-form.php");
                       }
                      
                       }
                       }
                    }
                    ?>
                
                <?php
                require './dbcon.php';
                $results = "select * from pet_rehome where user_id_fk = '$parent_id' and status=1";
                $display_stauts = mysqli_query($conn,$results);
                $counts = mysqli_num_rows($display_stauts);
                ?>
                <div class="main-content-inn-left">
                    <div class="col-first" id="load-post-ref">
                        <div class="stat-textarea post-f">
                            <div class="uplbtn-btm">
                                <div class="">
                                    <div class="sel-cat ind-post-hd">
                          <h2 class="page-h-t">Rehome A Pet </h2> 
                          <a href="rehome_list_details.php">
                          <!-- <i class="fa fa-plus"></i> -->  List of Rehome post<span class="list-counts">(<?php echo $counts?>)</span>
                          </a>
                                    </div>
                                    <span class="su-msg"><center><?php print_r($alrt); ?></center></span>
                                </div>                                
                                <div class="cr-form">
                                    <div class="reg-form-sec">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <?php
                                            if (empty($error)) {
                                                echo $error;
                                            }
                                            ?>
                                            <div class="pt-dt">
                                                <div class="form-row">
                                                    
                                                    <select name="species">
                                                        <option value="">Type Of Pet</option>
                                                        <option value="Dog">Dog</option>
                                                        <option value="Cat">Cat</option>
                                                        <option value="Rabbit">Rabbit</option>
                                                        <option value="Rat">Rat</option>
                                                    </select>
													<?php
													if (empty($_POST["species"])) {
														echo "<p style='color:red'>" . $error_spices . "</p>";
													}
													?>
                                                </div>
                                                     
                                                <div class="form-row brws-img">
                                                    <input type="text" name="pet_name" placeholder="Pet Name"/>
													<?php
													if (empty($_POST["pet_name"])) {
														echo "<p style='color:red'>" . $error_pet_name . "</p>";
													}
													?>
                                                </div>
                                                     
                                                
                                                <div class="form-row brws-img">
<div class="le-ri-im-l"><div class="left-im-l">
                                                    <input type="file" placeholder="Pet Photo" name="file" onchange="loadFile(event)"/></div>
                                                    <div class="right-im-l"><img id="output"/></div>
                                                </div></div>
                                                
						<script>
						  var loadFile = function(event) {
						    var reader = new FileReader();
						    reader.onload = function(){
						      var output = document.getElementById('output');
						      output.src = reader.result;
						    };
						    reader.readAsDataURL(event.target.files[0]);
						  };
						</script>
                                                <div class="form-row">
                                               <textarea name="description" placeholder="About Pet"></textarea>
						<?php
						if (empty($_POST["description"])) {
						echo "<p style='color:red'>" . $error_description . "</p>";
						}
						?>	
                                                </div>
                                                       
                                                <div class="sep-row">
<!--                                                    <h2 class="f-h">pet information</h2>-->
                                                    <div class="form-row">
                                                        <input type="text" name="color" placeholder="Color"/>
                                                    </div>
                                                    <div class="form-row rdo-row">
                                                        <label>Sex</label>
                                                        
                                                         <div class="rdo">
                                                        <input type="radio" name="sex" value="male" /><span>Male</span>
                                                        <input type="radio" name="sex" value="female" /><span>Female</span>
</div>
                                                    </div> 
                                                    </div>
                                                    <div class="form-row">
                                                        <input type="text" name="age" placeholder="Age"/>
                                                    </div>
                                                    <div class="form-row">
                                                      <input type="text" name="email" placeholder="Email"/>
					<?php
					if (empty($_POST["email"])) {
					echo "<p style='color:red'>" . $error_email . "</p>";
					}
					?>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                      <input type="text" name="phone_number" placeholder="Phone No."/>
						     <?php
						      if (empty($_POST["phone_number"])) {
							echo "<p style='color:red'>" . $error_phone . "</p>";
							}
						     ?>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                        <input type="text" name="address" placeholder="Address"/>
                                                    </div>
                                                    
												<div class="form-row">
												
												<select onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>
												</div>
												<div class="form-row">
												<select name ="state" id ="state"></select>
												<script language="javascript">print_country("country");</script>
												</div> 
<div class="sub-btn">
                                                <input type="submit" value="Save" name="sub"/>
                                            </div>                                           
                                                </div>

                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
				<div class="col-second">
				<!--pet mate and adopt -->
                                <?php require_once 'inc/rehome-pet-sidebar.php'; ?>                      
                        

 


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
        </div>
        <?php require_once 'inc/footer.php'; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
    </body>
</html>
