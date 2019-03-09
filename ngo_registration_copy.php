<?php
session_start();
//if(!(isset($_SESSION['pet_unique_id']))) {
// header('Location:index.php');
// }
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header_ngo.php'; ?>
        <div class="main-content ngo-page">
            <div class="main-content-inn">
                <div class="">
                    <div class="reg-left-sec">
                        <div class="reg-left-top">
                            <h2>Trending Images</h2>
                            <div class="tr-img">
                                <div class="tr-img-col">
                                    <?php
                                    require './dbcon.php';
                                    $image = "select * from uploadimages ORDER BY RAND() LIMIT 3";
                                    $res = mysqli_query($conn, $image);
                                    while ($row = mysqli_fetch_array($res)) {
                                        $dir = $row["uniqueid"] . "/Photos/" . $row["image_name"];
                                        ?>
                                        <div class="image"><div class="tr-img-col"> <img src="<?php echo $dir; ?>" width="50" height="50"></div></div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="tr-video">
                                <h2>Trending Video</h2>
                                <div class="tr-vd-col">
                                    <div class="vdo">
                                        <?php
                                        require './dbcon.php';
                                        $image = "select * from videoupload ORDER BY RAND() LIMIT 1";
                                        $res = mysqli_query($conn, $image);
                                        while ($row = mysqli_fetch_array($res)) {
                                            //    $dir = $row["uniqueid"] . "/photo/" . $row["image_name"];
                                            $vid = $row["uniqueid"] . "/Videos/" . $row["video_name"];

                                            //    print_r($vid);
                                            ?>
                                            <link href="css/video-js.css"  rel="stylesheet">
                                            <script src="js/videojs-ie8.min.js"></script>
                                            <video id="my-video" class="video-js" controls preload="auto" width="600" height="330px" poster="http://vjs.zencdn.net/v/oceans.png" data-setup="{}">
                                                <source src="<?php echo $vid; ?>" type='<?php echo $row["video_type"]; ?>'>
                                            </video>
                                            <script src="http://vjs.zencdn.net/6.2.7/video.js"></script>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="reg-right-sec">
                        <?php
                        if (isset($_POST['submit'])) {
                           // print_r($_POST);
                            $name = $_POST["name"];
                            $website = $_POST["website"];
                            $email = $_POST["email"];
                            $address = $_POST["address"];
                            $objective = $_POST["objective"];
                            $password = $_POST["password"];
                            $passwords = md5($password);
                            if (empty($name)) {
                                $error_name = "Enter name";
                            }
                            if (empty($address)) {
                                $error_address = "Enter address";
                            }

                            

                            if (!empty($name) && !empty($address)) {
                             
                                $rno = rand(1111111, 9999999);
                                require './dbcon.php';
                                $ngo_results = "select email from ngo_resgitration where email = '$email'";
                                $results_ngo = mysqli_query($conn, $ngo_results);
                                if (mysqli_num_rows($results_ngo) == 1) {
                                    ?>
                                    <script>alert("Try diffrent email or registration number")</script>
                                    <?php
                                
                                } 
                                else {

                                    require './dbcon.php';
                                    $_SESSION['name'] = $name;
                                    $_SESSION['address'] = $address;
                                    $_SESSION['objective'] = $objective;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['otp'] = $rno;
                                    $_SESSION['password'] = $passwords;
                                    $_SESSION['website'] = $website;
                                    $email = $_POST["email"];
                                    $to = $email;
                                    $subject = $_SESSION['otp'];
                                    $message = "<body style='width:100%;height:100%;float:left;background-color:#fff;font-family: Didact Gothic;margin:0;padding:0;'>
<div style='width:600px;height:100%;margin:0 auto;'>
<header style='width:100%;float:left;'>
<div style='width:100%;float:left;background-color:#4083fc;height:10px;'>&nbsp;</div>
<div style='width:160px;float:left;padding: 10px 0px;'><img src='http://petbooqtesting.com/images/emaillogo.png' alt='logo' style='width:100%;' /></div>
</header>
<section style='width:100%;float:left;'><img src='http://petbooqtesting.com/images/petbk-banner-image.jpg' alt='logo' /></section>
<section style='width:100%;float:left;'>
<div style='width:500px;height:100%;margin: 50px auto 30px;text-align: center;'>
<p style='font-family: arial;text-align:center;font-size:13px;line-height:22px;'>
<strong style='font-family: arial;font-size:20px;'>Thank you for joining PetBooQ! </strong> <br>
Click the link below to verify your email and join hundreds and thousands</br>
who are giving a space to their beloved, a space of their own.</br></br>

<strong style='font-family:arial;font-size:20px;display: inline-block;width: 100%;margin: 20px 0;'>
<a href='#' style='font-family:Didact Gothic;text-align:center;color:#fff;border-radius:25px;font-size:20px;padding:5px 65px;background-color:#4083fc;text-decoration:none;font-weight: bold;' >" . $_SESSION['otp'] . "</a>
</strong>
</br></br>
Pet-owners naturally conjugate- whether it is because of their daily walks, or for</br>
pet-shows, or for just comparing notes- Pet Owners are very passionate about</br>
their pets! PetBooq is one such platform that provide forums, resources, and</br>
expert help, but they also provide owners with the ability to showcase their pets</br>
by developing pet profiles, creating groups, exchanging photos &videos, thus</br>
providing their Pets a Space of Their Own. </br></br></p>
</section>
<section style='width:100%;float:left;text-align:center;background-color:#545454;color:#fff;padding:5px 0;margin-top:0px;'><div style='width:179px;float:left;padding: 10px 0px 50px 10px;'><img src='http://petbooqtesting.com/images/petbk-footer-logo.png' alt='logo' style='width:100%;' /></div></section>
</div>
</div>
</body>
";
                                    $from = 'peterparker@email.com';
                                    $header = "<h2>PetbooQ Account Verification</h2>";
                                    $header = 'MIME-Version: 1.0' . "\r\n";
                                    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                    mail($to, $subject, $message, $header);
                                    $otp_verification = "Insert into otp_verfication(otp,email,createdOn) value (" . $_SESSION['otp'] . ",'$email',NOW())";
                                    mysqli_query($conn, $otp_verification);
                                   // header("Location:otp_verification_ngo.php");
                                     echo "<script>window.location='otp_verification_ngo.php'</script>";
                                }
                            }
                        }
                        ?>
                        <div class="stat-textarea post-f">
                            <div class="acc-sec-top">
                                <p>Non-Profit Organisation </p>
                                <h1>Create a new account</h1>
                                <p>It's free and always will be.</p>
                            </div>
                            <div class="">
                                <div class="cr-form">
                                    <div class="reg-form-sec">
                                        <form method="post" action="">
                                            <div class="pt-dt">
                                                <div class="form-row">
                                                    <label>Name</label>
                                                    <input type="text" name="name" placeholder="" />
<?php
if (empty($_POST["name"])) {
    echo "<p style='color:red'>" . $error_name . "</p>";
}
?>
                                                </div>
                                                <div class="em-ps">
                                                    <div class="form-row">
                                                        <label>Email</label>
                                                        <input type="text" name="email" placeholder=""/>
                                                    </div>
                                                    <div class="form-row">
                                                        <label>Password</label>
                                                        <input type="password" name="password" placeholder=""/>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <label>Address</label>
                                                    <input type="text" name="address" placeholder="" />
<?php
if (empty($_POST["address"])) {
    echo "<p style='color:red'>" . $error_address . "</p>";
}
?>
                                                </div>

                                                <div class="form-row">
                                                    <label>Objective</label>
                                                    <input type="text" name="objective" placeholder=""/>
                                                </div>
                                                <div class="form-row">
                                                    <label>Website</label>
                                                    <input type="text" name="website" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="dic-inf">
                                                <p>By clicking Create Account, you agree to our Terms and confirm 
                                                    that you have read our Data Policy, 
                                                    including our Cookie Use Policy. You may receive SMS message 
                                                    notifications from Petbooq and can opt out at any time.
                                                </p>
                                            </div>
                                            <div class="sub-btn"><input type="submit"  name="submit" value="Submit" /></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php require_once 'inc/footer.php'; ?>
    </body>
</html>