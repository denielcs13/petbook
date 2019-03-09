<html>
    <?php require_once 'inc/head-content.php'; ?>
    <body class="otp-ver">
        <?php require_once 'inc/header.php'; ?>

        <div class="main-content">
            <div class="main-content-inn col-three post-page">
                <div class="main-content-inn-left main-content-full">
                    <div class="col-first">
                        <div class="stat-textarea post-f frgt-pass">
                            <h2>OPT Verification</h2>
                            <?php
                            session_start();
                            $rno = $_SESSION["otp"];
                            $category = $_SESSION['category'];
                            $description = $_SESSION['description'];
                            $website= $_SESSION['website'];
                            $email = $_SESSION['email'];
                            $company_name = $_SESSION['company_name'];
                            $password = $_SESSION['password'];
                            $password = md5($password);
                            $phone_number = $_SESSION['phone_number'];
                            $country = $_SESSION['country'];
                            $country_code = $_SESSION['country_code'];
                             $random_id = rand(1111111, 9999999);
                            $ran = $random_id;
                            $phone_number = $country_code.'-'.$phone_number;
			//print_r($phone_number);die;
//$_SESSION['otp']=$random_number;
                            require_once './dbcon.php';
                            if (isset($_POST['verify'])) {
                                $_SESSION['last_action'] = time();
                                $otp_verify = $_POST["otp"];
                                $result = "select *  from otp_verfication where otp ='" . $otp_verify . "'" ;
                                $query = mysqli_query($conn, $result);
                                if (mysqli_num_rows($query)!= 1) {
                                echo "Wrong OTP";    
                                }                                
                                else
                                {
                                    
                                    require_once './dbcon.php';
                                  
                                    $insert_business_data = "INSERT INTO `business`(`business_uniqueid`,`business_type`,`description`, `website`, `email`, `password`, `company_name`, `country`,`phone`,`default_type`) "
                  . "VALUES ('$ran','$category','$description','$website','$email','$password','$company_name','$country','$phone_number','Business')";
                // print_r($insert_business_data);die;
          mysqli_query($conn, $insert_business_data);
          require_once './dbcon.php';
          $insert_login = "INSERT INTO `login`(`email`, `password`,`unique_id`,`type`) VALUES ('$email','$password','$ran','business')";
        //  print_r($insert_login);
          mysqli_query($conn, $insert_login);
                                   $_SESSION["business_uniqueid"] = $random_id;
                                    mkdir($random_id . "/profile_pic", 0777, TRUE);
				    mkdir($random_id . "/post_images", 0777, TRUE);
				    mkdir($random_id . "/Share_image", 0777, TRUE);
				    mkdir($random_id . "/Shared_Videos", 0777, TRUE);
				    mkdir($random_id . "/Videos", 0777, TRUE);
                     			
                                     $subject = "Thanks for Joining Petbooq";
                    $message = "<body style='width:100%;background-color:#b5b5b5;margin:0;padding:0;'>
<div style='width: 680px;margin:0 auto;font-family:arial;box-sizing: border-box;'>
<div style='width:100%;background-color:#fff;padding: 15px;box-sizing: border-box;border: 20px solid #b5b5b5;box-sizing: border-box;'>
<div style='display:inline-block;width:100%;box-sizing:border-box;border-bottom:1px solid #ccccce;margin-bottom: 12px;'>
<div style='float:left;'><img src='http://petbooq.com/images/logo.jpg'/></div>
<div style='float:right;'>
<a href='http://www.petbooq.com' style='display:inline-block;margin-top:15px;text-decoration:none;color:#000;font-size:13px;text-transform:uppercase;font-weight:bold;'>petbooq.com</a>
</div>
</div>
<div style='display:inline-block;width:100%;text-align:center;'>
<div style='float:left;width:100%;'><img src='http://petbooq.com/images/thankyou-mailer-banner.jpg' style=''/></div>
</div>
<div style='width:100%;display:inline-block;'>
<div style='display:inline-block;padding: 0px;width:100%;background:#fff;margin-bottom:0px;box-sizing: border-box;'>
<div style='display:inline-block;width:100%;box-sizing:border-box;padding: 0 110px'>
<div style='display:inline-block;width:100%;font-size:25px;color:#6e6f73;line-height:34px;font-weight:bold;margin-top:10px;'>
Thank you for joining Petbooq.
</div>
<p style='display:inline-block;width:100%;font-size: 14px;color:#6e6f73;line-height:25px;margin: 0px 0 15px;'>
<div>Thanks</div>
<div>The Petbooq Team.</div>
</p>
</div>
</div>
</div>
<div style='display:inline-block;width:100%;border-top:1px solid #ccc;padding-top:15px;margin-top:15px;'>
<div style='float:left;'>
<a href='http://www.petbooq.com' style='display:inline-block;font-size:12px;text-decoration:none;color:#000;'>petbooq.com</a>
<span style='display:inline-block;margin: 0 5px;font-size:12px;color:#000;'>|</span>
<a href='mailto:pets@petbooq.com' style='display:inline-block;font-size:12px;text-decoration:none;color:#000;'>pets@petbooq.com  </a>
</div>
<div style='float:right;'>
<ul style='display:inline-block;padding: 0px;width:100%;margin:0;'>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='#'><img src='http://petbooq.com/images/social-icon1.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='#'><img src='http://petbooq.com/images/social-icon2.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='#'><img src='http://petbooq.com/images/social-icon3.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='#'><img src='http://petbooq.com/images/social-icon4.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='#'><img src='http://petbooq.com/images/social-icon5.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='#'><img src='http://petbooq.com/images/social-icon6.png' style=''/></a></li>
</ul>
</div>
</div>
</div>
</div>
</body>
";
                    $header = "<h2>PetbooQ Welcome</h2>";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Petbooq<Petbooq@gmail.com>' . "\r\n";
                    mail($email, $subject, $message, $headers);


                                    echo "<script>alert('Registration Successful!')</script>";
                                    //header("Location:index.php");
                                    echo "<script>window.location='index.php'</script>";
                               }
                             }
                            ?>
                            <form method="post" action="">
                                <div class="uplbtn-btm">
                                    
                                    <p style="margin-top:15px;margin-bottom:0px;">Please enter your OTP for verification.</p>
                                    <div class="upl-btm-text"><input type="text" name="otp" placeholder="Please Enter your OTP" /></div>
                                </div>
                                <div class="upload-btn uplbtn-top uplbtn-btm-t">
                                    <div class="upload-btn-hld upload-btn-hld-top">
                                        <a href="resendotp.php" class="rs-anc">Resend OTP</a>
                                        <input type="submit" class="fl-upld" name="verify" value="Submit" />
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>



<?php //require_once 'inc/footer.php';   ?>
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
      
window.open(
    'https://www.facebook.com/dialog/feed?app_id=1369234256522197&link=http://petbooq.com&picture=http://placekitten.com/500/500&caption=This%20is%20the%20caption', 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
});
</script>
</html>