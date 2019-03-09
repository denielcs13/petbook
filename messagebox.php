<?php 
$query= mysqli_query($conn,"SELECT pet_name, profile_pic, pet_unique_id, user_one, user_two,c_id
FROM user_inf, conversation
WHERE CASE
WHEN conversation.user_one = '$parent_id'
THEN conversation.user_two = user_inf.pet_unique_id
WHEN conversation.user_two = '$parent_id'
THEN conversation.user_one = user_inf.pet_unique_id
END
AND (
conversation.user_one = '$parent_id'
OR conversation.user_two = '$parent_id'
)
UNION SELECT company_name, profile_image, business_uniqueid, user_one, user_two,c_id
FROM business, conversation
WHERE CASE
WHEN conversation.user_one = '$parent_id'
THEN conversation.user_two = business.business_uniqueid
WHEN conversation.user_two = '$parent_id'
THEN conversation.user_one = business.business_uniqueid
END
AND (
conversation.user_one = '$parent_id'
OR conversation.user_two = '$parent_id'
)
UNION SELECT ngo_name, profile_image, ngo_unique_id, user_one, user_two,c_id
FROM ngo_resgitration, conversation
WHERE CASE
WHEN conversation.user_one = '$parent_id'
THEN conversation.user_two = ngo_resgitration.ngo_unique_id
WHEN conversation.user_two = '$parent_id'
THEN conversation.user_one = ngo_resgitration.ngo_unique_id
END
AND (
conversation.user_one = '$parent_id'
OR conversation.user_two = '$parent_id'
)ORDER BY c_id  DESC LIMIT 20");

//$msgnumqry=mysqli_query($conn,"SELECT * FROM ");
?>
<style>
.post-thumb img {
    width: 100%;
    height: 100%;
}
</style>

            
			<li class="notif_Container" id="noti_Container2">
			 
                <div class="notif_Counter" id="msg_Counter"></div>   
                
            
                <div class="notif_Button" id="msg_button"><img src="images/msgi.png"></div>    

               
                <div class="notif" id="message_box">
                    <h3>Messages</h3>
                    <div class="notification-area">
			<?php $cnum=0;
			$cidallqry=mysqli_query($conn,"SELECT c_id FROM conversation WHERE user_one='$parent_id' or user_two='$parent_id'");
			WHILE($cidall=mysqli_fetch_assoc($cidallqry)) {
			$mcntquery= mysqli_query($conn,"SELECT * FROM conversation_reply WHERE c_id_fk='$cidall[c_id]' AND notified='0'");
			if(mysqli_num_rows($mcntquery)>0) {
				$cnum+=1;
			}
			}
			?>
				<div id="message-count" style="display:none;"><?= $cnum; ?></div>	

<?php 
while($row=mysqli_fetch_assoc($query)) 
{
$c_id=$row['c_id'];
$user_id=$row['pet_unique_id'];
$username=$row['pet_name'];
//$email=$row['email'];
$cquery= mysqli_query($conn,"SELECT R.cr_id,R.time,R.reply FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1");
$crow=mysqli_fetch_assoc($cquery);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time1=$crow['time'];
?>
	<a class="notification-links" href="message-list.php?id=<?= $row['c_id'] ?>&user_id=<?= $row['pet_unique_id'] ?>">
	
	<div class="notif-box">
	
	<div class="not-area">
	<div class="post-thumb"> 
	<?php if($row['profile_pic']=='') { ?>
	<img src="images/user_image05.jpg" alt="user image">
	<?php } else { ?>
	<img src="<?= $row['profile_pic'] ?>" alt="user image" />
	<?php } ?>
	</div>
<p><b><?= $row['pet_name'].":</b>".$crow['reply'] ?></p>


	</div>
	</div>
	</a>
<?php } ?>
	
	</div>
                    <div class="seeAll"><a class="see-all" href="#">See All</a></div>
                </div>
            </li>
            
<script>
    $(document).ready(function () {

   $('#msg_Counter')
            .css({ opacity: 0 })
            .text($('#message-count').text())              
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#msg_button').click(function () {

           
            $('#message_box').fadeToggle('fast', 'linear', function () {
                $('#notifications').hide();
				$('#notifications2').hide();
            });

            $('#msg_Counter').fadeOut('slow');                 

            return false;
        });

        
        $(document).click(function () {
            $('#message_box').hide();

           
        });

        $('#message_box').click(function () {
            //return false;       
        });
		
    });
</script>