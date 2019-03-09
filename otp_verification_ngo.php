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
                           // print_r($_SESSION);
                            $name = $_SESSION['name'];
                            $address = $_SESSION["address"];
                            $rno = $_SESSION["otp"];
                           // $organisation = $_SESSION['organisation'];
                           // $objective= $_SESSION['objective'];
                            $email = $_SESSION['email'];
                            $company_name = $_SESSION['company_name'];
                            $password = $_SESSION['password'];
                            $user_name = $_SESSION['user_name'];
                            $phone_number = $_SESSION['phone_number'];
                            $country = $_SESSION['country'];
                            $password  = $_SESSION['password'];
                            $website = $_SESSION['website'];
                            //$Certified  = $_SESSION['certified'];
                            // $reg_num = $_SESSION['registration_number'];
                            //$establish_date = $_SESSION['establish_date'];
                             $random_id = rand(1111111, 9999999);
                             $ran = $random_id;

//$_SESSION['otp']=$random_number;
                            require_once './dbcon.php';
                            if (isset($_POST['verify'])) {
                                $_SESSION['last_action'] = time();
                                $otp_verify = $_POST["otp"];
                                $result = "select *  from otp_verfication where otp ='" . $otp_verify . "'" ;
                                $query = mysqli_query($conn, $result);
                                if (mysqli_num_rows($query)!= 1) 
                                {
                               echo "Wrong OTP";
                                }                                
                                else
                                {
                                    
                                    require_once './dbcon.php';
                                   $ngo_query =   "INSERT INTO `ngo_resgitration`(`ngo_unique_id`,`ngo_name`,`obejective`,`email`,`website`,`password`,`ngo`) VALUES ('$random_id','$name','$objective','$email','$website','$password','ngo')";  
                                  //print_r($ngo_query);die;
                                   mysqli_query($conn, $ngo_query);
                                   require_once './dbcon.php';
                                   $insert_login = "INSERT INTO `login`(`email`, `password`,`unique_id`,`type`) VALUES ('$email','$password','$ran','ngo')";
                                   mysqli_query($conn, $insert_login);
                                   $_SESSION["otp"] = $random_id;
                                   mkdir($random_id . "/profile_pic", 0777, TRUE);
				   mkdir($random_id . "/post_images", 0777, TRUE);
				   mkdir($random_id . "/Share_image", 0777, TRUE);
				   mkdir($random_id . "/Shared_Videos", 0777, TRUE);
				   mkdir($random_id . "/Videos", 0777, TRUE);
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

</html>