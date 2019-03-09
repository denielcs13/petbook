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
        <div class="main-content">
            <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page create-event ngo-reg">
                <div class="main-content-inn-left products gallery">
                    <div class="col-first">
                        <?php
                        if (isset($_POST['submit'])) {
                            $name = $_POST["name"];
                            $address = $_POST["address"];
                            $organisation = $_POST["organisation"];
                            $objective = $_POST["objective"];
                            $Certified = $_POST["Certified"];
                            $reg_num = $_POST["reg_num"];
                            $establish_date = $_POST["establish_date"];
                            $website = $_POST["website"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $passwords = md5($password);
                            if (empty($name)) {
                                $error_name = "Enter name";
                            }
                            if (empty($address)) {
                                $error_address = "Enter address";
                            }
                            if (empty($organisation)) {
                                $error_organisation = "Enter organisation";
                            }
                            if (empty($reg_num)) {
                                $error_reg_num = "Enter registration number";
                            } else {
                                $rno = rand(1111111, 9999999);
                                require './dbcon.php';
                                $ngo_results = "select email,resgistration_number from ngo_resgitration where email = '$email' and resgistration_number = '$reg_num'";
                                $results_ngo = mysqli_query($conn, $ngo_results);
                                if (mysqli_num_rows($results_ngo) == 1) {
                                    ?>
                                    <script>alert("Try diffrent email or registration number")</script>
                                    <?php
                                } else {
                                    require './dbcon.php';
                                    $_SESSION['name'] = $name;
                                    $_SESSION['address'] = $address;
                                    $_SESSION['organisation'] = $organisation;
                                    $_SESSION['objective'] = $objective;
                                    $_SESSION['certified'] = $Certified;
                                    $_SESSION['registration_number'] = $reg_num;
                                    $_SESSION['establish_date'] = $establish_date;
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
<a href='#' style='font-family:Didact Gothic;text-align:center;color:#fff;border-radius:25px;font-size:20px;padding:5px 65px;background-color:#4083fc;text-decoration:none;font-weight: bold;' >".$_SESSION['otp']."</a>
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
                                    $from = 'petbooq@mail.com';
                                    $header = "<h2>PetbooQ Account Verification</h2>";
                                    $header = 'MIME-Version: 1.0' . "\r\n";
                                    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                    mail($to, $subject, $message,$header);
                                    $otp_verification = "Insert into otp_verfication(otp,email,createdOn) value (" . $_SESSION['otp'] . ",'$email',NOW())";
                                    mysqli_query($conn,$otp_verification);
                                    //print_r($otp_verification);die;
                                    header("Location:otp_verification_ngo.php");
                                }
                                // $ngo_query =   "INSERT INTO `ngo_resgitration`(`ngo_name`, `address`, `organisation`, `obejective`,`email`,`govt_certificate`, `resgistration number`, `establish_date`) VALUES ('$name','$address','$organisation','$objective','$email','$Certified','$reg_num','$establish_date')";  
                                //   mysqli_query($conn, $ngo_query);
                                // print_r($ngo_query);die;
                            }
                        }
                        ?>
                        <div class="stat-textarea post-f">
                            <div class="">
                                <div class="grp-top-opt">
                                    <h2 class="fr-heading">NGO Registration</h2>
                                </div>
                            </div>
                            <div class="uplbtn-btm">
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
                                                    <label>Organisation</label>
                                                    <select name="organisation">
                                                        <option value="">Select Organisation</option>
                                                        <option value="Pet1">Pets1</option>
                                                        <option value="Pet2">Pets2</option>
                                                    </select>
                                                    <?php
                                                    if (empty($_POST["organisation"])) {
                                                        echo "<p style='color:red'>" . $error_organisation . "</p>";
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
                                                <div class="form-row">
                                                    <label>Email</label>
                                                    <input type="text" name="email" placeholder=""/>
                                                </div>
                                                <div class="form-row">
                                                    <label>Password</label>
                                                    <input type="text" name="password" placeholder=""/>
                                                </div>

                                                <div class="form-row">
                                                    <label>Government Certified</label>
                                                    <div class="rdo">
                                                        <input type="radio" name="Certified" value="Yes" /><span>Yes</span>
                                                        <input type="radio" name="Certified" value="No" /><span>No</span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <label>Registration Number</label>
                                                    <input type="text" name="reg_num" placeholder="" />
                                                    <?php
                                                    if (empty($_POST["reg_num"])) {
                                                        echo "<p style='color:red'>" . $error_reg_num . "</p>";
                                                    }
                                                    ?>
                                                </div>

                                                <div class="form-row">
                                                    <label>Established Date</label>
                                                    <input type="text" name="establish_date" placeholder="" />
                                                </div>
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