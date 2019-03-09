<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {   
    header('Location:index.php');
}
if(isset($_GET['id'])) {
	$profile_uid=$_GET['id'];
}
?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>
<?php    
$pet_id = $_SESSION['pet_unique_id'];
$error_invite = "";
if($_POST['btn-invitation'])
{
	
	$invite = trim($_POST["invitation"]);
	if(empty($_POST['invitation']))
	{
	$error_invite = "Enter email";
	}
	else{
	
	$to = $invite;
	$subject = "Invitation link PetbooQ";
	$message = "<body style='width:100%;height:100%;float:left;background-color: rgba(64, 131, 252, 0.4);font-family: 'Didact Gothic', sans-serif;margin:0;padding:0;font-size:13px;line-height:22px;'>
<div style='width:100%;height:100%;margin:0 auto;background-color: rgba(64, 131, 252, 0.4)'>
<header style='width:100%;float:left;'>
<div style='width:100%;float:left;padding: 10px 0px;'><img src='http://petbooqtesting.com/images/logo.png' alt='logo' /></div>
</header>
<section style='width:100%;float:left;'>
<div style='width:500px;height:100%;margin:0 auto;'>
<p style='font-family: 'Didact Gothic', sans-serif;text-align:center;font-size:13px;line-height:22px;'>
<strong style='font-family: 'Didact Gothic';font-size:20px;'>Thank you for joining PetbbooQ!</strong> <br/>
Click the link below to verify your email and join hundreds and thousands<br/>
who are plannning a Fruitful and Glorious Future with ZuperCoin.<br/><br/>
<strong>
//<a href='http://petbooqtesting.com/user_registration.php?id=<?php //echo $pet_id;?>' style='font-family: 'Didact Gothic', sans-serif;text-align:center;color:#fff;border-radius:25px;font-size:20px;padding:1px 65px;background-color:#4083fc;text-decoration:none;font-weight: bold;'><center><h3>Invitation link</h3></center></a>
echo '<a href=http://petbooqtesting.com/user_registration.php?compna=',urlencode($$pet_id),'>$pet_id</a>';
</strong>
<br/><br/>
Digital currency will only work if there is a distributed network <br/>
for it to run on. This requires users to adopt the coin and want<br/>
to use it. You also need merchants who will accept the coin as<br/>
a form of payment, ZuperNetwork is an attemp to create a<br/>
community of Users all across the Globe who will use ZuperCoin for<br/>
their ECommerce Transactions and also encourage others  to<br/>
use ZuperCoin in their daily needs.<br/><br/><br/>
</p> 
<div style='width:100%;border-top:1px solid #000;padding:20px 20px;box-sizing: border-box;'>
<div style='width:100%;padding:5px 0;'>
</div>
</div>
</div>
</section>
<section style='font-family: 'Didact Gothic', sans-serif;width:100%;float:left;text-align:left;background-color:#545454;color:#fff;padding:5px 0;margin-top:30px;'>
<div style='width:100%;padding:10px 20px;'><img src='http://petbooqtesting.com/images/logo.png' alt='logo' /></div>
<div style='width:100%;padding:10px 20px;color:#c2c2c2;'>
</div>
</section>
</div>
</body>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	mail($to,$subject,$message,$headers);
	}
	
}
?>
<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side">
<div class="pro-right-sec">
<div class="sidebar">
<h3>Invitation</h3>
<?php
print_r($_SESSION['pet_unique_id']);
?>
<form method="post">
<input type="text" name="invitation">
<?php
 if (empty($_POST["invitation"])) {echo "<p style='color:red'>" . $error_invite . "</p>"; }?>
<input type="submit" name="btn-invitation" value="Invite">
</form>
</div>
</div>
</div>
<div class="main-content-inn-left">
<div class="col-first">

<div class="two-col-post two-col-post-brdr">

</div>
</div>
</div>
</div>
</div>

<?php require_once 'inc/footer.php';  ?>
</body>
</html>