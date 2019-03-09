<?php
session_start();
if ((isset($_SESSION['pet_unique_id']))) {   
   header('Location:feed-page-copy.php');
}
if ((isset($_SESSION['business_unique_id']))) {   
   header('Location:bus_page.php');
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   header('Location:ngo_feed_page.php');
}
?>
<!DOCTYPE html>
<html>
<?php require_once 'inc/head-content.php';  ?>
<body class="index">
<?php require_once 'inc/header_11.php'; 

 
 require './dbcon.php';
?>

<div class="main-content">
<div class="main-content-inn ">
<div class="acc-sec-top">
<p>New to PetBooQ?</p>
<h1>Create a new account</h1>
<p>It's free and always will be.</p>
</div>

<div class="acc-sec-btm acc-sec-col">
<div class="acc-sign-top">
<div class="bl-top-acc">
<p class="lf">Pet Owner</p>
<a href="registration.php" class="sing-btn">Sign Up</a>
</div>

<div class="bl-top-acc">
<p class="lf">Business</p>
<a href="business-reg-copy.php" class="sing-btn">Sign Up</a>
</div>

<div class="bl-top-acc">
<p class="lf">Non-Profit Organisation </p>
<a href="ngo-registration.php" class="sing-btn">Sign Up</a>
</div>

</div>
<div class="lgn-image-sec">
<?php
                               
                                $image = "select * from uploadimages ORDER BY RAND() LIMIT 3";
                                $res = mysqli_query($conn, $image);
                                while ($row = mysqli_fetch_array($res)) {
                                    $dir = $row["image_path"];
                                    ?>
                                    <div class="image">    <div class="tr-img-col"> <img src="<?php echo $dir; ?>" width="50" height="50" alt="pet image"></div></div>
                                    <?php
                                }
                                ?>
</div>

<div class="lgn-txt-sec ">
<div class="cont-btm-sec"><p>Sign Up Now, Share and enjoy your pet with others Give your pet, place of his own. </p></div>
<div class="cont-btm-sec"><p>If you have goods or sevices which can bring a 
change in the life of animals, Sign Up Now, Share  
with others </p></div>
<div class="cont-btm-sec"><p>If you are an non-profit organisation whose objective is to 
help animals, Sign Up Now, Share  with others</p></div>
</div>

 <div class="ads ads-arc"><h2 class="sp-h-ads">Sponsored Ads</h2>
                    
                                    <?php
                                    $ip_addr=$_SERVER['REMOTE_ADDR'];
                    $qry=file_get_contents('http://freegeoip.net/json/'.$ip_addr);
                    $res=json_decode($qry);
                    $country = $res->country_name;
            
                                require './dbcon.php';
                                $display_banner = "select * from ads where country = '$country' ORDER BY RAND() LIMIT 3";
                                $results = mysqli_query($conn, $display_banner);
                                while ($row = mysqli_fetch_array($results)) {
                                $description = $row["description"];
                                $link = $row["link"];
                                    ?>
       <div class="one-col-post-ads">
       <a href='<?php echo $row["link"]?>' target='_blank'>
        <div class="one-col-inn">                 
            <div class="post-in-c">
                <div class="post-content">

<div class="post-img"><img src="<?php echo $row["banner_image"] ?>" alt="ads image"></div>
<h2><p class="pst-text"><?php echo $row["heading"] ?></p></h2>
<p class="pst-text"><?php echo substr($description, 0, 100)?></p>
</div>
</div>
</div>
</a>
</div>
<?php
} ?>
</div>
<script>
function loadlink(){
    $('.ads-arc').load(document.URL + ' .ads-arc');
}

loadlink(); 
setInterval(function(){
    loadlink() 
}, 120000);
</script>            



</div>
<div class="footer-div">
<div class="ftr-left">
<ul>
<li><a href="#" class="ftr-anc">About</a><span class="ftr-spn">|</span></li>
<li><a href="#" class="ftr-anc">Privacy </a> <span class="ftr-spn">|</span></li>
<li><a href="#" class="ftr-anc">Terms & Conditions </a> <span class="ftr-spn">|</span></li>
<li><a href="#" class="ftr-anc">Disclaimer</a> <span class="ftr-spn">|</span></li>

</ul>
</div>
<div class="ftr-right">
<ul class="ftr-ul">
<li class="ftr-li"><a href="https://www.facebook.com/petbooq"><img src="http://petbooq.com/images/social-icon1.png" style=""></a></li>
<li class="ftr-li" ><a href="https://www.instagram.com/petbooq/"><img src="http://petbooq.com/images/social-icon2.png" style=""></a></li>
<li class="ftr-li" ><a href="https://twitter.com/petbooq"><img src="http://petbooq.com/images/social-icon3.png" style=""></a></li>
<li class="ftr-li" ><a href="https://in.pinterest.com/petbooq/"><img src="http://petbooq.com/images/social-icon4.png" style=""></a></li>
<li class="ftr-li" ><a href="https://plus.google.com/u/1/113913416342083840664"><img src="http://petbooq.com/images/social-icon5.png" style=""></a></li>
<li class="ftr-li" ><a href="https://www.tumblr.com/blog/petbooq1"><img src="http://petbooq.com/images/social-icon6.png" style=""></a></li>
</ul>
</div>
</div>
</div>
</div>




</body>
</html>