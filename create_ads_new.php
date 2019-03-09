<?php
session_start();
	if(!(isset($_SESSION['pet_unique_id']))) {
		header('Location:index.php');
	}
	?>
	<html>
	<?php
	require_once 'inc/head-content.php'; ?>	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
    <body>
        <?php require_once 'inc/header.php'; ?>
        <?php
        if (isset($_POST["submit"])) {
        $parent_id = $_SESSION['pet_unique_id'];
        $name = $_POST["gname"];       
        $desc = $_POST["desc"];        
        //$group_id= rand(222222, 9999999);
        //$ran = $group_id;  
        require_once './dbcon.php';
                $q = "select * from groups where user_id_fk ='" . $parent_id . "'";
                $res = mysqli_query($conn, $q);
                //print_r($res);
                $group_info=mysqli_fetch_assoc($res);
                if($group_info['group_name']=="$name")
                    {
		echo "<script>alert('Group Already Exist')</script>";							
                                                         
                    }
                
 else {
        require './dbcon.php';
        
        

 //$insert = "INSERT INTO groups(group_name,group_desc,user_id_fk) VALUES ('$name','$desc','$parent_id')";
 $insert = "INSERT INTO groups(group_id,group_name,group_desc,user_id_fk) VALUES ('$ran','$name','$desc','$parent_id')";
if ($conn->query($insert) === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
}
        $insert1="INSERT INTO group_users
(group_id_fk,user_id_fk) 
VALUES 
('$last_id','$parent_id')";
                                   mkdir($parent_id . "/Groups/".$name."/Photos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/Videos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/post_images", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/profile_pic", 0777, true);
           // print_r($insert);die;
            
            $sqll2=mysqli_query($conn, $insert1);
            //print_r($sqll);die;
            if ($sqll2>0) {
            
               
                echo "<script>alert('Group created Successfully')</script>";
                echo "<script>window.location='groups.php'</script>";
            }
            else{
			echo "<script>alert('Group not created')</script>";
			
			}
        }
        }
        ?>

			<?php
                                $parent_id = $_SESSION['pet_unique_id'];
				$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
				?>
            <div class="main-content" id="page-load-ref">
            
                <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw  create-new-page create-grp create-ads">
                <div class="col-first-side">
				<div class="pro-pic-sec">
<div class="pht"><?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?>
						</div>
<div class="pet-info">
<p>Name: <?= $profileinfo['pet_name']; ?></p>
</div>
<div class="pet-info">
<p>DOB: <?= $profileinfo['dob']; ?></p>
</div>
<div class="pet-info">
<p>Owner: <?= $profileinfo['powner_name']; ?></p>
</div>
</div>
                <div class="pro-right-sec">
                
                    <div class="sidebar">
                        <ul>
                            <li><a href="#"><span class="icn"><img src="images/create-page-icon.png" alt="icon" /></span>Create Page</a></li>
                            <li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Create Groups</a></li>
                            <li><a href="#"><span class="icn"><img src="images/event-icon.png" alt="icon" /></span>Events</a></li>
                            <li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Create Ads</a></li>
                            <li><a href="#"><span class="icn"><img src="images/notes-icon.png" alt="icon" /></span>Create Notes</a></li>
                            <li><a href="#"><span class="icn"><img src="images/rec-icon.png" alt="icon" /></span>Recommendations</a></li>
                        </ul>
                    </div>
                </div>
                </div>
                    <div class="main-content-inn-left" >
                        <div class="col-first" id="load-post-ref">
                            <div class="stat-textarea post-f">
							
                          <div class="uplbtn-btm">


<div class="sel-cat">
<h2 class="page-h-t">Create Ads</h2>
</div>

<div class="cr-form">
<div class="reg-form-sec">
<form action="">
<div class="pt-dt">
<div class="form-row">
<label>Name of Client</label>
<input type="text" name="Page name" />
</div>
<div class="form-row brws-img">
<label>Banner Image</label>
<input type="file" name="" id="" />
</div>

<div class="form-row">
<label>Heading</label>
<input type="text" name="Page name" />
</div>

<div class="form-row">
<label>Description</label>
<textarea name="description"></textarea>
</div>

<div class="form-row">
<label>Link Destination </label>
<input type="text" name="Page name" />
</div>

</div>

<div class="sub-btn"><input type="submit" value="Save" /></div>

</form>
</div>
</div>
</div>
								
                            </div>

                    </div>
					
					
					<div class="col-third   animated fadeInRight">
<div class="ltst-arc">
<h2>The latest articles</h2>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image03.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image07.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>

<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image05.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>


<h2>latest News</h2>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image04.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image03.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image07.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image09.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
</div>
</div>
	        </div>
          </div>
        </div>
        <?php require_once 'inc/footer.php'; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    </body>
</html>
