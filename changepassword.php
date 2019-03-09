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
   $sucess_message="";
   $var='';
  
   if(isset($_POST["submit"]))
    {
     $profile_id = $_GET['id'];
     $password = $_POST["password"];
     $newpassword = $_POST["newpassword"];
     $passwords = trim(md5($_POST["password"]));
     $newpassword= trim(md5($_POST["newpassword"]));
     if(empty($_POST['password']))
	{
	$error_password = "Enter password";
	}
        if(empty($_POST['newpassword']))
	{
	$error_newpassword = "Enter new password";
	}
    else{
     if($passwords==$newpassword)
     {
     require_once './dbcon.php';
     $update_password = "update user_inf set password = '$newpassword' where pet_unique_id = '$profile_id'";
     mysqli_query($conn, $update_password);
     $update_passwords = "update login set password = '$newpassword' where unique_id	 = '$profile_id'";
     mysqli_query($conn, $update_passwords);
    $sucess_message = "<p style='color:green'>Password sucessfully update</p>";
    
    }
    else
    {
    $var ="Password not match";
    }
    }
    }
  ?>

<form method="post" action="#">
<div class="uplbtn-btm">
<h2>Change Password</h2>
<p style="margin-top:5px;margin-bottom:0px;">Please enter your new password.</p>
<div class="upl-btm-text">
    <p style="color:red;"><?php echo $var;?><p>
    <?php if(isset($sucess_message)){echo $sucess_message;}?> 
    <input type="password" name="password" placeholder="Password">
    <?php
     if (empty($_POST["password"])) {
      echo "<p style='color:red'>" . $error_password . "</p>";  
     }
     ?>
    <input type="password" name="newpassword" placeholder="New password">
     <?php
     if (empty($_POST["newpassword"])) {
      echo "<p style='color:red'>" . $error_newpassword . "</p>";  
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