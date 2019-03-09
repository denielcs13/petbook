<?php
session_start();
$parent_id=$_SESSION['pet_unique_id'];
?>

    
        <ul class="notification-bar">
            
			<li class="notif_Container" id="noti_Container">
			<?php $frndreqqry=mysqli_query($conn,"SELECT pet_name,email,profile_pic,parent_id,addfriend.status,child_id FROM user_inf JOIN addfriend ON addfriend.parent_id = user_inf.pet_unique_id WHERE child_id='$parent_id' AND parent_id!='$parent_id' AND addfriend.status=1 LIMIT 5");
			$frcount=mysqli_num_rows($frndreqqry);
			
			?>
			<div id="frcount" style="display:none;"><?= $frcount ?></div>
                <div class="notif_Counter" id="noti_Counter"></div>   
                
              
                <div class="notif_Button" id="noti_Button"><img src="images/friend.png"></div>    

               
                <div class="frnd-request" id="notifications">
                    <div class="frq-title">Friend Request</div>
                    <div class="friend-req-area">
					<div class="fr-list">
					<?php WHILE($friendreq=mysqli_fetch_assoc($frndreqqry)) { ?>
					<div class="fr-li-cont" id="friend-req-show">
                                    <div class="fr-li-row">
                                        <div class="fr-t-l">
                                            <a href="about3.php?id=<?= $friendreq['parent_id'] ?>">
											<span class="user-icn-img">
											<?php if($friendreq['profile_pic']=='') { ?>
											<img src="images/pet-icon.png" alt="user image">
											<?php } else { ?>
											<img src="<?= $friendreq['profile_pic'] ?>">
											<?php } ?>
											<span class="fr-nm"><?= $friendreq['pet_name'] ?></span></span>
											</a>
                                        </div>
                                        <div class="user-act"><a href="#" class="frn_req_acc" id="<?= $friendreq['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?= $friendreq['parent_id'] ?>">Reject</a></div>
                                    </div>
                                </div>
								
					<?php } ?>
					</div>
					</div>
                    <div class="seeAll"><a class="see-all" href="#">See All</a></div>
                </div>
            </li>
			
			
			
			
			
           
            
			
        </ul>
    

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        
        $('#noti_Counter')
            .css({ opacity: 0 })
            .text($('#frcount').text())          
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button').click(function () {

            
            $('#notifications').fadeToggle('fast', 'linear', function () {
                
            });

            $('#noti_Counter').fadeOut('slow');                

            return false;
        });

        $(document).click(function () {
            $('#notifications').hide();

            
        });

        $('#notifications').click(function () {
            return false;      
        });
		
		
		
		$('#noti_Counter2')
            .css({ opacity: 0 })
            .text('0')              
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button2').click(function () {

           
            $('#notifications2').fadeToggle('fast', 'linear', function () {
                
            });

            $('#noti_Counter2').fadeOut('slow');                 

            return false;
        });

        
        $(document).click(function () {
            $('#notifications2').hide();

           
        });

        $('#notifications2').click(function () {
            return false;       
        });
		
    });
</script>