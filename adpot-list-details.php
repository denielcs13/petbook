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
    <body>
        <?php require_once 'inc/header_11.php'; ?>
                <style>
.switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 17px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(28px);
  -ms-transform: translateX(28px);
  transform: translateX(28px);
}


/*------ ADDED CSS ---------*/

.on {
  display: none;
}

.on,
.off {
  color: white;
  position: absolute;
  transform: translate(-50%, -50%);
  top: 25%;
  left: 25%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}

.on {
  top: 8px;
}

.off {
  left: auto;
  right: -5px;
  top: 8px;
}

input:checked+ .slider .on {
  display: block;
}

input:checked + .slider .off {
  display: none;
}


/*--------- END --------*/


/* Rounded sliders */

.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page friend-listing-page rehome-list">
            <div class="main-content-inn col-three main-content-full">
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
                                                }

				?> 
                </div>
                <div class="main-content-inn-left">
                    <div class="col-first">
                       <div class="two-col-post">
                         <h2 class="fr-heading"><span class="fr-h-l">Adopt a Pet List Details</span></h2>
<?php
//session_start();
//$parent_id = $_SESSION["pet_unique_id"];                           
//require './dbcon.php';
$query_fetchs = "select * from adopt_pet where adopt_pet_unique_id = '$parent_id'";
$results = mysqli_query($conn, $query_fetchs);
?>
<div id="display_data_adopt">
    <?php
while($row = mysqli_fetch_array($results))
{
 ?>
                                    <div class="left friend-box">
                                        <div class="post-in-c">
                                            <div class="fr-left">
                                                <div class="fri-image">
                                                    <a href="adopt-about.php?id=<?= $row['id'] ?>">
                                                        <?php
                                                        if ($row['pet_photo'] == "") {
                                                            echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
                                                        } else {
                                                            ?>
                                                            <img class="photo"  alt="" src="<?= $row['pet_photo'] ?>">
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="fr-right">
                                                <div class="fri-name">
                                                    <p class="ttl-lks"><a href="adopt-about.php?id=<?= $row['id'] ?>"><?= $row['pet_name_adopt'] ?></a></p>
                                                </div>
                                                <div class="usr-cnct-l">
                                                    <p class="pst-text"><?php echo substr($row['about_pet'], 0, 80) ?></p>
                                                </div>
                                                <label class="switch">
						 <?php
                                                if($row['status']==1)
                                                {
                                               
                                                ?>
                                                <input type="checkbox" id="<?= $row['id']?>" name="rehome_pet" class="rehome_pet" checked>
                                                <div class="slider round">
                                                <span class="on">ON</span>
                                                </div>
						<?php
                                                }
                                                else
                                                {
                                               ?>
                                               <input type="checkbox" id="<?= $row['id']?>" name="rehome_pet" class="rehome_pet">
                                               <div class="slider round">
                                                <span class="off">OFF</span>
                                                </div>
						<?php
                                                }
                                                ?>
                                                 
						</label>
                                            </div>
                                        </div>
                                    </div> 
 
 
 
   
<?php// echo $row['pet_name']."<br>";?>
<?php
 }
 //include 'search.php';
?>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				<script>
				$(document).ready(function()
				{
				  $(".rehome_pet").on('click',function(){
				  var data = $(this).is(":checked");
				  var ids = $(this).attr('id');
				 
				  $.ajax({
				     url:'adopt-search.php',
				     type:'POST',
				     data:{adopt:data,id:ids},
				     success:function(response)
				     {
				      console.log(response);
				     }
				  });
				});
				});
				</script>




</div>
                    </div>
                    <?php require_once 'inc/ads_sidebar_d.php'; ?>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="css/packery-docs.css" media="screen" />
        <script src="js/packery-docs.min.js"></script>
        <?php require_once 'inc/footer.php'; ?>
    </body>
</html>