<html>
<?php require_once 'inc/head-content-fpwd.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>


<div class="main-content">
<div class="main-content-inn col-three post-page forget-password">
<div class="main-content-inn-left main-content-full">
<div class="col-first">
<div class="stat-textarea post-f frgt-pass">
<?php
session_start();
$sucess_message="";
$var='';
if(isset($_POST["submit"]))
{
  $useremail = $_POST["email"];
  
  require_once './dbcon.php';
  $fetch_result = "select `email`,`pet_unique_id` from user_inf where email='$useremail'";
  $fetch_result = mysqli_query($conn, $fetch_result);
  if(mysqli_num_rows($fetch_result)==1)
  {
   while($row = mysqli_fetch_assoc($fetch_result))
  {
	
        $id = $row["pet_unique_id"];
        $subject = "Password Change Petbooq";
        $message = "<body style='width:100%;background-color:#b5b5b5;margin:0;padding:0;'>
        <div style='width: 680px;margin:0 auto;font-family:arial;box-sizing: border-box;'>
        <div style='width:100%;background-color:#fff;padding: 15px;box-sizing: border-box;border: 20px solid #b5b5b5;box-sizing: border-box;'>
        <div style='display:inline-block;width:100%;box-sizing:border-box;border-bottom:1px solid #ccccce;margin-bottom: 12px;'>
        <div style='float:left;'><img src='http://petbooq.com/images/logo.jpg'/></div>
        <div style='float:right;'>
        <a href='http://www.petbooq.com' style='display:inline-block;margin-top:15px;text-decoration:none;color:#000;font-size:13px;text-
        transform:uppercase;font-weight:bold;'>//petbooq.com</a>
        </div>
        </div>
        <div style='display:inline-block;width:100%;text-align:center;'>
        <div style='float:left;width:100%;'><img src='http://petbooq.com/images/thankyou-mailer-banner.jpg' style=''/></div>
        </div>
        <div style='width:100%;display:inline-block;'>
        <div style='display:inline-block;padding: 0px;width:100%;background:#fff;margin-bottom:0px;box-sizing: border-box;'>
        <div style='display:inline-block;width:100%;box-sizing:border-box;padding: 0 150px'>
        <div style='display:inline-block;width:100%;font-size:17px;color:#6e6f73;line-height:34px;font-weight:bold;margin-top:10px;'>
        <a href=\"http://petbooq.com/changepassword.php?id=" . urlencode($id) . "\" style='display:inline-block;width:100%;padding:5px 0;background-color:#6d6e72;color:#fff;font-size:23px;text-decoration:none;text-align:center;font-weight:bold;'>Click Here to Change Password</a>

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
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.facebook.com/petbooq'><img src='http://petbooq.com/images/social-icon1.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.instagram.com/petbooq/'><img src='http://petbooq.com/images/social-icon2.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://twitter.com/petbooq'><img src='http://petbooq.com/images/social-icon3.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://in.pinterest.com/petbooq/'><img src='http://petbooq.com/images/social-icon4.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://plus.google.com/u/1/113913416342083840664'><img src='http://petbooq.com/images/social-icon5.png' style=''/></a></li>
<li style='display:inline-block;margin: 0;padding: 0;'><a href='https://www.tumblr.com/blog/petbooq1'><img src='http://petbooq.com/images/social-icon6.png' style=''/></a></li>
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
                    mail($useremail, $subject, $message, $headers);
         







  }
  }
  else{
  $var ="Enter correct email";
  }
}
?>
<?php if(isset($sucess_message)){echo $sucess_message;}?>
<form method="post" action="#">
<div class="uplbtn-btm">
<h2>Forgot Password</h2>
<p style="margin-top:5px;margin-bottom:0px;">Please enter your email address.</p>
<div class="upl-btm-text">
    <input type="text" name="email" placeholder="Email">
    <p style="color:red;"><?php echo $var;?><p>
    <?php
     if (empty($_POST["password"])) {
      echo "<p style='color:red'>" . $error_password . "</p>";  
     }
     ?>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld upload-btn-hld-top">
    <input type="submit" name="submit" value="Submit" class="fl-upld">
</div></div></div>
</form></div></div></div></div></div>

<?php require_once 'inc/footer.php';  ?>
</body>
</html>