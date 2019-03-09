<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.box-right {
	width:50%;
	float:right;
}
.box-left {
	float:left;
}
.disp-img {
	width:350px;
}
.left-arrow {
	position:relative;
	float:left;
	top: 130px
}
.right-arrow {
	position:relative;
	float:right;
	top: 130px
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/basicPopup.css" rel="stylesheet" type="text/css">
<link href="css/basicPopupDefault.css" rel="stylesheet" type="text/css">
<style>
#popup-content { display:none; text-align:center}
</style>
</head>

<body>
<div class="display-img" id="55">
<a href="#" class="btn-open">
<img src="images/user_image05.jpg" alt="">
</a>
<a href="#" class="btn-open">
<img src="images/user_image06.jpg" alt="">
</a>
<a href="#" class="btn-open">
<img src="images/user_image07.jpg" alt="">
</a>
</div>

<!--<button id="btn-open">Click me</button>-->
<div id="popup-content">
<div class="box-left">
<div class="left-arrow" id="left-img"><a href="#"><img src="images/Arrowhead-Left.png"></a></div>
<div class="right-arrow" id="right-img"><a href="#"><img src="images/Arrowhead-Right.png"></a></div>

<img id="box-image" class="disp-img" src="images/user_image05.jpg" alt="">

</div>
<div class="box-right">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce libero velit, dictum eget ligula scelerisque, elementum venenatis purus. Phasellus placerat tempor velit id ultricies. Vivamus sollicitudin, dui non imperdiet maximus, tortor lorem interdum lectus.</p>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/jquery.basicPopup.js"></script>
<script>
$(document).ready(function() {

		
	$('.btn-open').click(function(){	
	    var id=$(this).parent().attr('id');
		var img=$(this).find('img').attr('src');
		$('#popup-content').attr('pid',id);
		$('#box-image').attr('src',img);
		$.basicpopup({
			
			content: $('#popup-content').html()
		});
		
	}),
	$(document).on('click','#right-img',function() {
		//alert("hi");
		var next=
		$('#box-image').attr('src',next);
		
		
		
	});

});
</script>




</body>
</html>
