<?php
require 'dbcon.php';
session_start();
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

<?php require_once 'inc/head-content.php'; ?>
<body>
<?php require_once 'inc/header_11.php'; ?>

    <div class="main-content">
        <div class="main-content-inn col-three post-page">
            <div class="main-content-inn-left main-content-full">
                <div class="col-first">
                    <div class="panel panel-default noPadding">
                    <?php
if(isset($_POST["submit"])){
$user_one=mysqli_real_escape_string($conn,$_SESSION['pet_unique_id']);
$user_two=mysqli_real_escape_string($conn,$_GET['id']);
//print_r($user_one);//print_r($user_two);
if($user_one!=$user_two)
{
$q= mysqli_query("SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysql_error());
//print_r($q);
$time=time();
$ip=$_SERVER["REMOTE_ADDR"];
print_r($ip);
if(mysqli_num_rows($q)==0) 
{ 
echo 'hello';
$query = mysqli_query("INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysql_error());
$q1=mysqli_query("SELECT c_id FROM conversation WHERE user_one='$user_one' ORDER BY c_id DESC limit 1");
$v=mysqli_fetch_array($q1,MYSQLI_ASSOC);
//print_r($v);
return $v['c_id'];
//print_r($v['c_id']);
}
else
{
$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
return $v['c_id'];
}
}
}
?>
                    
<form method="post" action="">
<div>    
<textarea name="status" class="form-control share-text" rows="2" placeholder="Send your message..." id="conversationReply"></textarea></div>
<div class="panel-footer share-buttons">
<span class="pull-right">
    <input type="submit" name="submit" value="send">
</span>
</div>
</form>
</div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>