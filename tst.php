<?php
session_start();
if ((isset($_SESSION['pet_unique_id']))) {
    $parent_id = $_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {
    $parent_id = $_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {
    $parent_id = $_SESSION['ngo_unique_id'];
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>	

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/countries.js"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header_11.php'; ?>        

        <div class="main-content" id="page-load-ref">

            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw  create-new-page create-grp form-page">
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
                    <?php
                    $alrt = '';
                    $error = "";
                    if (isset($_POST["sub"])) {

                        $page_name = $_POST['page_name'];
                        $banner_name = $_FILES["banner"]["name"];
                        $heading = $_POST["heading"];
                        $description = $_POST["description"];
                        $linkdestionation = $_POST["linkdestionation"];
                        $linkdestionation = 'https://' . $linkdestionation;
                        $country = $_POST['country'];
                        $state = $_POST['state'];
                        $filetmp = $_FILES["banner"]["tmp_name"];
                        if (empty($page_name)) {
                            $error_page_name = "Enter client name";
                        } else {

                            $fileData = pathinfo(basename($_FILES["banner"]["name"]));
                            $fileName = uniqid() . '.' . $fileData['extension'];

                            $random_numbers = rand(1111111, 9999999);


                            $target_path = "ads/" . $fileName;
                            if (move_uploaded_file($_FILES['banner']['tmp_name'], $target_path)) {
                                require './dbcon.php';
                                $files = "ads/" . $fileName;
                                $banner_insert = "insert into ads(client_name,banner_image,heading,description,link,country,state)values('$page_name','$files','$heading','$description','$linkdestionation','$country','$state')";

                                $sqll = mysqli_query($conn, $banner_insert);
                                if ($sqll > 0) {
                                    $alrt = "Your Ads Created Successfully";
                                    //header("location: creates_ads.php");
                                }
                            }
                        }
                    }
                    ?>
                <div class="main-content-inn-left" >
                    <div class="col-first" id="load-post-ref">
                        <div class="stat-textarea post-f">
                            <div class="uplbtn-btm">
                                <div class="">
                                    <!--<div class="sel-cat">
                                         <h2 class="page-h-t">Creates Ads</h2> 
                                    </div>-->

                                </div>                                
                                <div class="cr-form">
                                    <span class="su-msg" style=""><center><?php print_r($alrt); ?></center></span>
                                    <div class="reg-form-sec">
                                        <form action="" method="post" enctype="multipart/form-data">
                                                <?php
                                                if (empty($error)) {
                                                    echo $error;
                                                }
                                                ?>
                                            <div class="pt-dt">
                                                <div class="form-row">
                                                    <input type="text" name="page_name" placeholder="Name of Client"/>
                                            <?php
                                            if (empty($_POST["page_name"])) {
                                                echo "<p style='color:red;text-align:left'>" . $error_page_name . "</p>";
                                            }
                                            ?>
                                                </div>

                                                <div class="form-row brws-img brws-img-prv">
                                                    <div class="le-ri-im-l"><div class="left-im-l">
                                                            <input type="file" name="banner" placeholder="Banner Image" id="imgInp"/></div>
                                                        <div class="right-im-l"></div></div>
                                                    <script>
                                                        function readURL(input) {
                                                            if (input.files && input.files[0]) {
                                                                var reader = new FileReader();
                                                                reader.onload = function (e) {
                                                                    $('.blah').attr('src', e.target.result);
                                                                }
                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                        }
                                                        $("#imgInp").change(function () {
                                                            readURL(this);
                                                        });
                                                    </script>
                                                </div>

                                                <div class="form-row">
                                                    <input type="text" onkeyup="$('.headings').html(this.value)" name="heading" placeholder="Heading"/>
                                                </div>

                                                <div class="form-row">
                                                    <textarea name="description" onkeyup="$('.addr').html(this.value)" placeholder="Description"></textarea>
                                                </div>

                                                <div class="form-row">
                                                    <input type="text" name="linkdestionation" placeholder="Link Destination"/>
                                                </div>

                                                <div class="form-row">
                                                    <select onchange="print_state('state', this.selectedIndex);" id="country" name ="country"></select>
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

                                <div class="form-ri-img">
                                    <div class="post-rw-hld">
                                        <div class="post-img"><img class="blah" style="height:300;width:460"/></div>
                                        <div class="post-content">
                                            <h2><p class="user-nm headings"></p></h2>
                                            <p class="pst-text addr"></p>
                                        </div>
                                    </div>
                                </div>
                               <div class="form-ri-img">
                                    <div class="post-rw-hld">
                                        <div class="post-img"><img class="blah" style="height:100;width:160"/></div>
                                        <div class="post-content">
                                            <h2><p class="user-nm headings"></p></h2>
                                            <p class="pst-text addr"></p>
                                        </div>
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