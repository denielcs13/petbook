<?php 
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}
require 'dbcon.php'; 
?>
<html>
    <?php require_once 'inc/head-content.php';?>
    <body>
        <?php require_once 'inc/header_11.php'; ?>
      
<div class="main-content user-pro-dtls-page usr-feed-page-nw friend-list-page friend-listing-page rehome-list">
            <div class="main-content-inn col-three main-content-full">
                <div class="col-first-side">                    
                    <?php 
				if ((isset($_SESSION['pet_unique_id']))) {   
				require_once 'inc/user_profile_sidebar.php';
				require_once 'inc/side-bar.php';
				require_once 'inc/rehome-a-pet-side-bar.php';				
                                                }
                                if ((isset($_SESSION['business_unique_id']))) {   
                                require_once 'inc/business_profile_sidebar.php';
                                require_once 'inc/side-bar.php';
                                require_once 'inc/rehome-a-pet-side-bar.php';
                                                }
                                if ((isset($_SESSION['ngo_unique_id']))) {   
                                require_once 'inc/ngo_profile_sidebar.php';
                                require_once 'inc/side-bar.php';
                                require_once 'inc/rehome-a-pet-side-bar.php'; 
                                                }

		    ?>
                </div>
                <?php
                                $gp_id=$_GET[id];
				$profileqry=mysqli_query($conn,"SELECT * FROM groups WHERE group_id='$gp_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
		?>
                <div class="main-content-inn-left">
                    <div class="col-first">
                       <div class="two-col-post">
                         <h2 class="fr-heading"><span class="fr-h-l"><?= $profileinfo['group_name']?> >> Group Members</span> 
<span class="fr-inp-l">
<input type="hidden" id="group-id" name="g_id" value="<?php echo $gp_id; ?>">
<input type="text" name="search" placeholder="Find a member" id="search"></span></h2>

<?php

require './dbcon.php';
$query_fetchs = "SELECT pet_name, about_data, pet_unique_id, profile_pic, group_user_id
FROM user_inf, group_users
WHERE user_inf.status = '1'
AND user_inf.pet_unique_id = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
UNION SELECT `company_name` , `description` , `business_uniqueid` , `profile_image` , group_user_id
FROM `business` , group_users
WHERE business.status = '1'
AND business.business_uniqueid = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
UNION SELECT `ngo_name` , `ngo_desc` , `ngo_unique_id` , `profile_image` , group_user_id
FROM `ngo_resgitration` , group_users
WHERE ngo_resgitration.status = '1'
AND ngo_resgitration.ngo_unique_id = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
ORDER BY group_user_id DESC";
$results = mysqli_query($conn, $query_fetchs);
?>
<div id="display_data">
    <?php
while($row = mysqli_fetch_array($results))
{
 ?>
                                    <div class="left friend-box">
                                        <div class="post-in-c">
                                            <div class="fr-left">
                                                <div class="fri-image">
                                                    <a href="about3.php?id=<?= $row['pet_unique_id'] ?>">
                                                        <?php
                                                        if ($row['profile_pic'] == "") {
                                                            echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
                                                        } else {
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
                                                    <p class="pst-text"><?php echo substr($row['about_data'], 0, 80) ?></p>
                                                </div>
                                               </div>
                                        </div>
                                    </div> 
                                   
 
 
   
<?php// echo $row['pet_name']."<br>";?>
<?php
 }
 //include 'search.php';
?>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    $(document).ready(function () {
        
        $("#search").keyup(function () {
            var data = $("#search").val();
            var gid=$('#group-id').val();
            $.ajax({
                url: 'gmember-search.php',
                type: 'POST',
                data: {search:data,grpid:gid},
                success: function (response) {
                $("#display_data").html(response);
                }
            });
        });
    });
</script>

</div>
                    </div>
                    <?php require_once 'inc/ads_sidebar_d.php'; ?>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="css/packery-docs.css" media="screen" />
        <script src="js/packery-docs.min.js"></script>
        <?php require_once 'inc/footer.php'; ?>
    </body>
</html>