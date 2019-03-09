<?php 
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
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />	

    <body>
        <?php require_once 'inc/header_11.php'; ?>
        
       
        <div class="main-content user-pro-dtls-page usr-feed-page usr-feed-page-nw friend-list-page grp-mem-page event-list event-page">
            <div class="main-content-inn col-three main-content-full">
                    
                <style>

                    /*================== fr =========================*/


                    .friend-list-page .left.friend-box {
                        width: 50%;
                        padding: 0 11px;
                        box-sizing: border-box;
                    }
                    .friend-list-page .left.friend-box .photo {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                    .friend-list-page .left.friend-box .fr-left {
                        width: 32%;
                        display: inline-block;
                        height: 100px;
                        float: left;
                    }
                    .friend-list-page .left.friend-box .fr-right {
                        display: inline-block;
                        vertical-align: top;
                        margin-left: 10px;
                    }
                    .friend-list-page .post-in-c {
                        box-shadow: none;
                        background: none;
                        border: 1px solid #ccc;
                        border-radius: 0;
                    }
                    .two-col-post {
                    }
                    .friend-list-page.usr-feed-page-nw .two-col-post .post-in-c {
                        width: 100%;
                        box-sizing: border-box;
                        padding: 0;
                        margin: 0;
                        display: inline-block;
                    }
                    .friend-list-page .left.friend-box .fr-right a {
                        color: #2c86bf;
                        letter-spacing: 0;
                        font-size: 12px;
                    }
                    .friend-list-page .left.friend-box .fr-right .ttl-lks {
                        margin-bottom: 0;
                    }
                    .friend-list-page.usr-feed-page-nw .two-col-post {
                        width: 100%;
                        display: inline-block;
                        margin: 0;
                        box-shadow: 2px 2px 10px 0 rgba(0,0,0,.1);
                        background: #fff;
                        padding: 0;
                        border-radius: 4px;
                        box-sizing: border-box;padding: 15px 0 0;
                    }
                    .friend-list-page .fr-heading {
                        margin: 0;
                        padding: 0 10px 10px;
                        border-bottom: 1px solid #eee;
                        box-sizing: border-box;
                        margin-bottom: 15px;
                        color: #5785e0;
                    }
                    .friend-list-page .fr-right .fr-btn{
                        background: url(../images/right-checkmark.png);
                        display: inline-block;
                        font-size: 13px;
                        border-radius: 2px;
                        border: 1px solid #6f6f6f;
                        padding: 2px 8px 2px 24px;
                        color: #fff;
                        margin-top: 10px;
                        background-color: #5785e0;
                        background-repeat: no-repeat;
                        background-position: 6px center;
                        background-size: 17%;
                    }
                    .friend-list-page .fr-right .fr-btn h3 {
                        font-size: 12px;
                        margin: 0;
                    }
                    /*================== fr =========================*/
                </style>

               

		 <div class="col-first-side"> 
		 <?php
 if((isset($_SESSION['pet_unique_id']))) {   
require_once 'inc/user_profile_sidebar.php';
require_once 'inc/side-bar.php';  
}
if((isset($_SESSION['business_unique_id']))) {   
require_once 'inc/bus_profile_sidebar.php'; 
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   require_once 'inc/ngo_profile_sidebar.php';
}
 ?>                   
                </div>
		<div class="main-content-inn-left">
                <div class="col-first  crt-pgs" id="page-load-ref">                   
								<div class="tp-ntf-list fr-list">
								<div class="grp-top-opt">
												<h2 class="fr-heading">Pending Invites</h2>
												
												</div>
												<div class="two-col-post two-col-post-brdr">
                                                                    
                                                                    <?php                                                    
	

//session_start();
//$gp_id=$_GET['id'];
//$parent_id = $_SESSION["pet_unique_id"];
$grpqry=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id, U.profile_pic, P.user_id_fk, P.event_by, G.event_id_fk, G.status, P.event_name, P.event_desc, P.e_profile_pic, P.event_id, P.event_date
FROM user_inf U, event_users G, 
events P
WHERE U.status =  '1'
AND U.pet_unique_id = G.user_id_fk
AND G.event_id_fk = P.event_id
AND G.user_id_fk =  '$parent_id'
AND G.status =  '0'");
					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
						?>
								<div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										 <?php if($grpres['e_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['e_profile_pic'] ?>">
							<?php } ?>
										</div>
										</div>
										<div class="fr-right">
										<div class="shdl-date">
										<div class="left"><span class="mnth"><?php
$event_date = DateTime::createFromFormat("Y-m-d", $grpres['event_date'] );
$emonth= $event_date->format("m");
$evm=date("F", strtotime($grpres['event_date']));
$ev_month=substr($evm, 0, 3);
echo $ev_month."<br>".$event_date->format("d");
 ?></span><span class="dt"></span></div>
										<div class="right">
										<h3 class="ev-hding"><?= $grpres['event_name'] ?></h3>
										<div class="pbl-b"><span><i class="fa fa-globe"></i> Published by</span> <a href="about3.php?id=<?= $grpres['user_id_fk'] ?>"><?= $grpres['event_by'] ?></div>
										<div class="usr-pro-right">
										<div class="post-act-ins">
                                                                                <a href="#" class="frn_req_acc event-edit-button" id="<?= $grpres['event_id_fk'] ?>"><i class="fa fa-user-plus"></i>Join</a>
                                                                                <a href="#" class="frn_req_rej event-edit-button" id="<?= $grpres['event_id_fk'] ?>"><i class="fa fa-times"></i>Reject</a>
										</div>
										</div>
										</div>
										</div>
										</div>										
										
										
                                        </div>                              
                                        </div>
                                                                    
  <?php
                            }
                        ?>	
								</div>
								</div>
								
                                <div class="fr-list" id="friends-list">


                                            <div class="">
                                                <div class="two-col-post two-col-post-brdr">
                                                <div class="grp-top-opt">
												<h2 class="fr-heading">Your Events</h2>
                                                
                                                <a class="crt-grp" href="create-event.php"><i class="fa fa-plus"></i>Create Events</a>
												</div>
                                                    <?php
//session_start();
//$parent_id = $_SESSION["pet_unique_id"];
//$grpqry=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id, U.profile_pic, P.user_id_fk, P.event_by, G.event_id_fk, G.status, P.event_name, P.event_desc, P.e_profile_pic, P.event_id, P.event_date
//FROM user_inf U, event_users G, 
//events P
//WHERE U.status =  '1'
//AND U.pet_unique_id = G.user_id_fk
//AND G.event_id_fk = P.event_id
//AND G.user_id_fk =  '$parent_id'
//AND G.status =  '1'");
$grpqry=mysqli_query($conn,"SELECT * FROM `events` WHERE `user_id_fk`='$parent_id'");

					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
                                            $description=$grpres['event_desc'];
						?>
                                        <div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										<a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>">
        <?php if($grpres['e_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['e_profile_pic'] ?>">
							<?php } ?></a>
										</div>
										</div>
										<div class="fr-right">
										<div class="shdl-date">
										<div class="left"><span class="mnth"><?php
$event_date = DateTime::createFromFormat("Y-m-d", $grpres['event_date'] );
$emonth= $event_date->format("m");
$evm=date("F", strtotime($grpres['event_date']));
$ev_month=substr($evm, 0, 3);
echo $ev_month."<br>".$event_date->format("d");
 ?></span><span class="dt"></span></div>
										<div class="right">
                                                                                <h3 class="ev-hding"><a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>"><?= $grpres['event_name'] ?></a></h3>
										<div class="pbl-b"><span><i class="fa fa-globe"></i> Published by</span> <a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>"><?= $grpres['event_by'] ?></a></div>
										<div class="desc_text"><?php echo substr($description, 0, 30) ?></div>
										<div class="usr-pro-right">
										<div class="post-act-ins">
										<button class="post-join-button post-share-btn inv-btn" id=""><i class="fa fa-user-plus"></i>Invite</button>
										<a href="edit-event.php?id=<?= $grpres['event_id'] ?>" class="event-edit-button">Edit</a>
										</div>
										</div>
										</div>
										</div>
										</div>
										<div class="close-bt"><button class="delete-btn-user" id="<?= $grpres['event_id'] ?>">X</button></div>
                                        </div>                              
                                        </div>
                                                     <?php
                            }
                        ?>			
                                                </div>
                                            </div>

                                    <div class="fr-list" id="friends-list">
                                    <div class="">
                                                <div class="two-col-post two-col-post-brdr">
                                                <div class="grp-top-opt">
												<h2 class="fr-heading">Joined Events</h2>
                                                
<!--                                                <a class="crt-grp" href="create-event.php"><i class="fa fa-plus"></i>Create Events</a>-->
												</div>
                                                    <?php
//session_start();
//$parent_id = $_SESSION["pet_unique_id"];
//$grpqry=mysqli_query($conn,"SELECT U.pet_name, U.pet_unique_id, U.profile_pic, P.user_id_fk, P.event_by, G.event_id_fk, G.status, P.event_name, P.event_desc, P.e_profile_pic, P.event_id, P.event_date
//FROM user_inf U, event_users G, 
//events P
//WHERE U.status =  '1'
//AND U.pet_unique_id = G.user_id_fk
//AND G.event_id_fk = P.event_id
//AND G.user_id_fk =  '$parent_id'
//AND G.status =  '1'");
$grpqry=mysqli_query($conn,"SELECT G.event_id_fk,G.user_id_fk, G.status, P.event_name,P.event_by,P.event_date,P.event_desc,P.e_profile_pic,P.event_id
FROM  event_users G, events P
WHERE G.event_id_fk = P.event_id
AND G.user_id_fk =  '$parent_id'
AND P.user_id_fk!='$parent_id'
AND G.status = '1'
");

					WHILE($grpres=mysqli_fetch_assoc($grpqry)) {
                                            $description=$grpres['event_desc'];
						?>
                                        <div class="fr-li-cont  left friend-box ">
                                        <div class="post-in-c">
                                        <div class="fr-left">
										<div class="fri-image">
										<a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>">
        <?php if($grpres['e_profile_pic']=="") {
							echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img class="photo"  alt="" src="<?= $grpres['e_profile_pic'] ?>">
							<?php } ?></a>
										</div>
										</div>
										<div class="fr-right">
										<div class="shdl-date">
										<div class="left"><span class="mnth"><?php
$event_date = DateTime::createFromFormat("Y-m-d", $grpres['event_date'] );
$emonth= $event_date->format("m");
$evm=date("F", strtotime($grpres['event_date']));
$ev_month=substr($evm, 0, 3);
echo $ev_month."<br>".$event_date->format("d");
 ?></span><span class="dt"></span></div>
										<div class="right">
       <h3 class="ev-hding"><a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>"><?= $grpres['event_name'] ?></a></h3>
										<div class="pbl-b"><span><i class="fa fa-globe"></i> Published by</span> <a href="event-test.php?id=<?= $grpres['event_id'] ?>&name=<?= $grpres['event_name'] ?>"><?= $grpres['event_by'] ?></a></div>
										<div class="desc_text"><?php echo substr($description, 0, 30) ?></div>
										<div class="usr-pro-right">
										<div class="post-act-ins">
<!--										<button class="post-join-button post-share-btn inv-btn" id=""><i class="fa fa-user-plus"></i>Invite</button>
										<a href="edit-event.php?id=<//?= $grpres['event_id'] ?>" class="event-edit-button">Edit</a>-->
										</div>
										</div>
										</div>
										</div>
										</div>										
										<div class="close-bt"><button class="delete-btn" id="<?= $grpres['event_id'] ?>">X</button></div>
                                        </div>                              
                                        </div>
                                                     <?php
                            }
                        ?>			
                                                </div>
                                            </div>
                                </div>
                                        
                                    </div>
                                    <script type="text/javascript">
        
           $(document).on('click', '.delete-btn', function () {
                var fr_id = $(this).attr("id");
              $.ajax({
                    url: "delete-functions.php",
                    type: "POST",
                    data: {delete_f: fr_id},
                    cache: false,
                    success: function (data)
                    {
                    //alert(data);

                      $('#'+fr_id+'.delete-btn').closest('.friend-box').fadeOut(1000);
                        
                        
                    },
                    error: function ()
                    {

                    }
                });
            });
        </script>
        <script type="text/javascript">
        
           $(document).on('click', '.delete-btn-user', function () {
                var fr_id = $(this).attr("id");
              $.ajax({
                    url: "delete-functions.php",
                    type: "POST",
                    data: {delete_f_u: fr_id},
                    cache: false,
                    success: function (data)
                    {

                      $('#'+fr_id+'.delete-btn-user').closest('.friend-box').fadeOut(1000);
                        
                        
                    },
                    error: function ()
                    {

                    }
                });
            });
        </script>
                                   
                            
                        
                    </div>
					<div class="col-third animated fadeInRight">
					<?php require_once 'inc/ads_sidebar_d.php'; ?>
                    </div>
                </div>
            </div>
        </div> 
        </div> 
                                <?php require_once 'inc/footer.php'; ?>
        
        <link rel="stylesheet" href="css/modal.css">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
					 
					
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-pid="123" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <h3 class="modal-title" id="exampleModalLabel">Select Friends To Invite</h3>
        <button type="button" class="close" id="share-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="fr-li-cont">
	  <form method="post" id="share-form">
	  <?php
	  //$pg_id=$_GET['id'];
    $friendqry="SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,user_inf.profile_pic,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1' LIMIT 10";
	
$friendrun=mysqli_query($conn,$friendqry);
WHILE($friendlist=mysqli_fetch_assoc($friendrun)) {
	?>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
									
          <a href="#"><span class="user-icn-img">
                  <?php if($friendlist['profile_pic']=="") {
							echo "<img src='images/pet-icon.png' alt='user image'>";
							}
							else {
							?>
							<img src="<?= $friendlist['profile_pic']  ?>" alt="user image" />
							<?php } ?>
                  <span class="fr-nm"><?= $friendlist['pet_name'] ?></span></span></a>
		  <input type="checkbox" style="display:none" class="check-share" name="<?= $friendlist['pet_name'] ?>" value="<?= $friendlist['pet_unique_id'] ?>"> 
                                    </div>
                                    <div class="user-nm" id="<?= $friendlist['pet_unique_id'] ?>"><a href="#" class="share-select-frn">SELECT</a></div>
                                </div>
							
<?php } ?>
              
              <input type="hidden" name="event_id" value="<?= $grpres['event_id'] ?>">
								</div>
	  
        
      </div>
      <div class="modal-footer">
        
        <input type="submit" id="share-btn" value="Invite">
		
      </div>
	  
</form>
    </div>
  </div>
</div>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
			        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
          <script type="text/javascript">
				
					$(document).on('click','.frn_req_acc',function(e) {
						e.preventDefault();
						var acc_id=$(this).attr('id');
						
						$.ajax({
        	        url: "event_join_fun.php",
			type: "POST",
			data: { accept: acc_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("JOINED");
			  location.reload();
		      //$('#page-load-ref').load(document.URL +  '#page-load-ref');
			  
		    }        
		});
						
					}),
					
					$(document).on('click','.frn_req_rej',function(e) {
						e.preventDefault();
						var rej_id=$(this).attr('id');
						
						$.ajax({
        	        url: "event_join_fun.php",
			type: "POST",
			data: { reject: rej_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+rej_id+'.frn_req_rej').parent().html("DECLINED");
			  location.reload();
			  //$('#page-load-ref').load(document.URL +  '#page-load-ref');
		        
		    }        
		});
						
					});
					
					
			
				</script>
                                <script type="text/javascript">
    $(document).ready(function () {
      
        $(document).on('click','.post-share-btn', function() {
			 var pid=$(this).attr('id');
           $('#myModal').show().attr("data-pid",pid);
		 
		   //$('#myModal').data("pid",pid);
		   
        }),
		$('.share-select-frn').on('click',function(e) {
			e.preventDefault();
			 $(this).attr('id');
			$(this).parent().parent().toggleClass("marked");
			$(this).parent().parent().find('.check-share').trigger('click');
		}),
$('#share-modal-close').click(function() {

$('#myModal').hide();

});
		
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
$("#share-form").on('submit',(function(e)  {
		
           e.preventDefault();
		   var $form = $(this);
            $form.find('submit').attr('disabled', true);
		   var fd=new FormData(this);
		   
		   
		$.ajax({
        	url: "event-share-fun.php",
			type: "POST",
			data: fd,
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
	          $('#alert-msg').html(data).show();
			  $('#alert-msg').fadeOut(10000);
			  
				//alert(data);
				$('#share-form')[0].reset();
				$('#myModal').hide();
				$('#share-form').find('.fr-li-row').removeClass('marked');
		
		    },
		  	error: function() 
	    	{
				
	    	} 	
		
	   });
	   return false;
	}));
});
</script>
            </body>
            </html>
