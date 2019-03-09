<?php
if(isset($_POST["sub"]))
{
   $emails=$_POST["email"];
   $to = $emails;
   $subject='Application Form ';
   $message='testing';
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= $_POST["sender"] .'@gmail.com'. "\r\n";
   if(mail($to,$subject,$message,$headers))
   {
   echo "Mail Successfully Sent..";
   exit;
   }
}
?>
<form method="post">
<input type="text" name="sender" placeholder="sender">
<input type="text" name="email">
<input type="submit" value="Submit" name="sub">
</form>