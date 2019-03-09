<?php

$pageshareqry=mysqli_query($conn,"SELECT * FROM page_shares WHERE share_with='$parent_id'");

WHILE($pageshare=mysqli_fetch_assoc($pageshareqry)) {  
$sharerqry=mysqli_query($conn,"SELECT pet_name,pet_unique_id,profile_pic FROM user_inf WHERE pet_unique_id='$pageshare[sharer_id]' UNION SELECT company_name,business_uniqueid,profile_image FROM business WHERE business_uniqueid='$pageshare[sharer_id]' UNION SELECT ngo_name,ngo_unique_id,profile_image FROM ngo_resgitration WHERE ngo_unique_id='$pageshare[sharer_id]'");
$sharer=mysqli_fetch_assoc($sharerqry);
$pageqry=mysqli_query($conn,"SELECT * FROM pages WHERE page_id='$pageshare[page_id]'");
$pageinfo=mysqli_fetch_assoc($pageqry);
?>
   
	
<div class="one-col-post g-p-shr">
<div class="post-in-c" id="<?= $sharer['pet_unique_id'] ?>">
<div class="post-content">
<h2>
<span class="user-icn-img">
<?php if($sharer['profile_pic']=='') {
	echo "<img src='images/fr-pro-big-img.jpg'>";
}
else { ?>
<img src="<?= $sharer['profile_pic'] ?>" alt="user image">
<?php } ?>
</span>
<p class="user-nm"><a href="#"><?= $sharer['pet_name'] ?></a> <span class="is-txt">Shared a </span> <a href="#">Page</a></p></h2>
<a href="#" class="dismiss-ps" id="<?= $pageshare['page_id'] ?>"><i class="fa fa-close dismiss-ps"></i></a>
</div>

<div class="pro-pic-bx-s">

<div class="pro-pic-bx-l">
<div class="pro-pic-bx-img"><a href="pages1.php?id=<?= $pageshare['page_id'] ?>&name=<?= $pageinfo['page_name'] ?>"><img src="<?= $pageinfo['pg_profile_pic'] ?>" alt="user image"></a></div>
</div>
<div class="pro-pic-bx-r">
<div class="pro-pic-dsc">
<h2><?= $pageinfo['page_name'] ?></h2>
<p><?= $pageinfo['page_desc'] ?></p> 
</div>
<?php $likechk=mysqli_query($conn,"SELECT * FROM page_users WHERE page_id_fk='$pageshare[page_id]' AND user_id_fk='$parent_id' AND status='1'");

if(mysqli_num_rows($likechk)<1) {
?>
<div class="sub-btn">
<button class="lk-p page-like-btn" id="<?= $pageshare['page_id'] ?>"><i class="fa fa-thumbs-up"></i> Like Page</button>

</div>
<?php } else { ?>

<div class="sub-btn">
<button class="lk-p"><i class="fa fa-check"></i> Liked</button>

</div>
<?php } ?>
</div>

</div>
</div></div>
	
	
	
<?php } ?>
<script type="text/javascript">
				
					$(document).on('click','.page-like-btn',function(e) {
						e.preventDefault();
						var pageid=$(this).attr('id');
						
						$.ajax({
        	        url: "page_join_fun.php",
			        type: "POST",
			        data: { accept: pageid },
                    cache: false,
			        success: function(data) {
	          
			  $('#'+pageid+'.page-like-btn').text("LIKED");
			
		     
			  
		    }        
		});
		});
		
		</script>
		<script type="text/javascript">
				
					$(document).on('click','.dismiss-ps',function(e) {
						e.preventDefault();
						var pageid=$(this).attr('id');
						var sharer=$(this).closest('.post-in-c').attr('id');
						
						$.ajax({
        	        url: "page_uns.php",
			        type: "POST",
			        data: { puns: pageid, shr:sharer},
                    cache: false,
			        success: function(data) {
	          
			 $('#'+pageid+'.dismiss-ps').closest('#'+sharer+'.post-in-c').parent().fadeOut(300);
		  
		    }        
		});
		});
		
		</script>