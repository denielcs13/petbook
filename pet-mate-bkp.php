<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>	

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header_11.php'; ?>        

        <div class="main-content" id="page-load-ref">

            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw  create-new-page create-grp pet-rehome">
                <div class="col-first-side">
                    <?php
                    $alrt = '';
                    $error = "";
                    if (isset($_POST["sub"])) {

                        
                        $type= $_POST['type'];
                        $breed = $_POST['breed'];
                        $pet_name = $_post["pet_name"];
                        $age = $_POST['age'];
                        $sex = $_POST['radio1'];
                        $location = $_POST['location'];
                        $description = $_POST['description'];
                        $radio2 = $_POST['radio2'];
                        $random = rand(1111111,9999999);
                         require './dbcon.php';
                        $query = "INSERT INTO `pet_meet`(`pet_met_unique_id`, `type`, `breed`, `pet_name`, `age`, `sex`, `location`, `about_pet`, `pedigree`) VALUES 
                        ('$random','$type','$breed','$pet_name','$age','$sex','$location','$description','$radio2')";
                        
                        mysqli_query($conn,$query);
                        
                        
                    }
                    ?>
                    <?php require_once 'inc/user_profile_sidebar.php'; ?>   
                    <?php require_once 'inc/side-bar.php'; ?>
                </div>
                <div class="main-content-inn-left" >
                    <div class="col-first" id="load-post-ref">
                        <div class="stat-textarea post-f">
                            <div class="uplbtn-btm">
                                <div class="">
                                    <div class="sel-cat">
                                        <h2 class="page-h-t">Find perfect partner for your pet </h2>
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
                                                    <label>Type</label>
                                                    <select name="type">
                                                        <option name="">Select type</option>
                                                        <option name="Dog">Dog</option>
                                                        <option name="Cat">Cat</option>
                                                        <option name="Rabbit">Rabbit</option>
                                                        <option name="Rat">Rat</option>
                                                    </select>
                                                </div>

                                                <div class="form-row">
                                                    <label>Breed</label>
                                                    <select name="breed">
                                                        <option value="">Select breed</option>
                                                        <option value="Gentle Giants">Gentle Giants</option>
                                                        <option value="Mutt-Madness Surprise Mix!">Mutt-Madness Surprise Mix!</option>
                                                        <option value="Mini Mutts (Mucho Love!)">Mini Mutts (Mucho Love!)</option>
                                                        <option value="Mid-Sized Mutts">Mid-Sized Mutts</option>
                                                        <option value="Barrymore's Buddies">Barrymore's Buddies</option>
                                                        <option value="Affenpinscher">Affenpinscher</option>
                                                        <option value="Afghan Hound">Afghan Hound</option>
                                                    </select>
                                                </div>

                                                <div class="form-row brws-img">
                                                    <label>Pet Name</label>
                                                    <input type="text" name="pet_name" />
                                                </div>

                                                <div class="form-row">
                                                    <label>Age</label>
                                                    <input type="text" name="age" />
                                                </div>
                                                <div class="form-row rdo-row">
                                                    <label>Sex</label>
                                                    <div class="rdo">
                                                        <input type="radio" name="radio1" value="male" /><span>Male</span>
                                                        <input type="radio" name="radio1" value="female" /><span>Female</span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <label>Location</label>
                                                    <input type="text" name="location"/>
                                                </div>
                                                <div class="form-row">
                                                    <label>About Pet</label>
                                                    <textarea name="description"></textarea>
                                                </div>
                                                <div class="form-row rdo-row">
                                                    <label>Pedigree</label>
                                                    <div class="rdo">
                                                        <input type="radio" name="radio2" value="male" /><span>Yes</span>
                                                        <input type="radio" name="radio2" value="female" /><span>No</span>
                                                    </div>
                                                </div>
                                              </div>
                                            <div class="sub-btn">
                                                <input type="submit" value="Create" name="sub"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
