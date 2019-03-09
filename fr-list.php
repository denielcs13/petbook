<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>

<div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page">
<div class="main-content-inn col-three main-content-full">

<div class="main-content-inn-left">
<div class="col-first">

<div class="two-col-post">
<h2 class="fr-heading">Friends</h2>
    <?php
session_start();
$parent_id = $_SESSION["pet_unique_id"];
$display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) {

            ?>

    <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                                <div class="left friend-box">
                                <div class="post-in-c">
<div class="fr-left">
<div class="fri-image">
    <a href="about3.php?id=<?= $row['pet_unique_id'] ?>">
        <?php if($row['profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $row['profile_pic'] ?>">
							<?php } ?>
    </a>
</div>
</div>
<div class="fr-right">
<div class="fri-name">
<p class="ttl-lks"><a href="about3.php?id=<?= $row['pet_unique_id'] ?>"><?= $row['pet_name'] ?></a></p>
</div>

<div class="usr-cnct-l">
<h3>Friend</h3>
</div>

</div>
</div>
</div>
     <?php
                            }
                        }
                        ?>

</div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="css/packery-docs.css" media="screen" />
<script src="js/packery-docs.min.js"></script>
<?php require_once 'inc/footer.php';  ?>
</body>
</html>