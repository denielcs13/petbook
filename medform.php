<form method="post" id="profile-post-form" enctype="multipart/form-data">
                     <input name="files[]" value="upload" class="fl-img" type="file" multiple>
                      <input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
</form>
<span id="msg" style="display:none;"></span>
							<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
							<script type="text/javascript">
                   $("#profile-post-form").on("submit",function(e){
                     e.preventDefault();
					
                     $.ajax({
                     
                     url:"mediatest.php",
                     type:"POST",
                     data: new FormData(this),
                     contentType: false,
                     cache: false,
                     processData: false,
                     beforeSend: function ()
                     {
                     $('#msg').text('SENDING').show();
                     },
                      success: function (data)
                       {
					   $('#msg').hide()
                       
                      
                       $('#profile-post-form')[0].reset();
                       $('#post-submit-btn').removeAttr('disabled');
                       },
                       error: function ()
                       {

                       }
                     }); 
                      $(this).find(':submit').attr('disabled', 'disabled');               
                   });
                </script>