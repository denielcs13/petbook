<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Featherlight – The ultra slim jQuery lightbox.</title>
		
		<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
		<style type="text/css">
			@media all {
				.lightbox { display: none; }
				.fl-page h1,
				.fl-page h3,
				.fl-page h4 {
					font-family: 'HelveticaNeue-UltraLight', 'Helvetica Neue UltraLight', 'Helvetica Neue', Arial, Helvetica, sans-serif;
					font-weight: 100;
					letter-spacing: 1px;
				}
				.fl-page h1 { font-size: 110px; margin-bottom: 0.5em; }
				.fl-page h1 i { font-style: normal; color: #ddd; }
				.fl-page h1 span { font-size: 30px; color: #333;}
				.fl-page h3 { text-align: right; }
				.fl-page h3 { font-size: 15px; }
				.fl-page h4 { font-size: 2em; }
				.fl-page .jumbotron { margin-top: 2em; }
				.fl-page .doc { margin: 2em 0;}
				.fl-page .btn-download { float: right; }
				.fl-page .btn-default { vertical-align: bottom; }

				.fl-page .btn-lg span { font-size: 0.7em; }
				.fl-page .footer { margin-top: 3em; color: #aaa; font-size: 0.9em;}
				.fl-page .footer a { color: #999; text-decoration: none; margin-right: 0.75em;}
				.fl-page .github { margin: 2em 0; }
				.fl-page .github a { vertical-align: top; }
				.fl-page .marketing a { color: #999; }

				/* override default feather style... */
				.fixwidth {
					background: rgba(256,256,256, 0.8);
				}
				.fixwidth .featherlight-content {
					width: 500px;
					padding: 25px;
					color: #fff;
					background: #111;
				}
				.fixwidth .featherlight-close {
					color: #fff;
					background: #333;
				}

			}
			@media(max-width: 768px){
				.fl-page h1 span { display: block; }
				.fl-page .btn-download { float: none; margin-bottom: 1em; }
			}
		</style>
	</head>
	<body>
		
			
				
				
				
					<a class="btn btn-default" href="#" data-featherlight="#fl1">Default</a>
					<a class="btn btn-default" href="#" data-featherlight="#fl2" data-featherlight-variant="fixwidth">Custom Styles</a>
					<a class="btn btn-default" href="assets/images/droplets.jpg" data-featherlight="image">Image</a>
					<a class="btn btn-default" href="https://player.vimeo.com/video/33110953" data-featherlight="iframe" data-featherlight-iframe-allowfullscreen="true" data-featherlight-iframe-width="500" data-featherlight-iframe-height="281">iFrame</a>

					<a class="btn btn-default" href="aj.php?id=21 .ajaxcontent" data-featherlight="ajax">Ajax</a>
						
	

		<div class="lightbox" id="fl1">
			<h2>Featherlight Default</h2>
			<p>
				This is a default featherlight lightbox.<br>
				It's flexible in height and width.<br>
				Everything that is used to display and style the box can be found in the <a href="https://github.com/noelboss/featherlight/blob/master/src/featherlight.css">featherlight.css</a> file which is pretty simple.</p>
		</div>

		<div class="lightbox" id="fl2">
			<h2>Featherlight with custom styles</h2>
			<p>It's easy to override the styling of Featherlight. All you need to do is specify an additional class in the data-featherlight-variant of the triggering element. This class will be added and you can then override everything. You can also reset all CSS: <em>$('.special').featherlight({ resetCss: true });</em>
			</p>
		</div>

		<div class="ajaxcontent lightbox">
		<?= $_GET[id] ?>
			<h2>This Ligthbox was loaded using ajax</h2>
			<p>With <a href="https://github.com/noelboss/featherlight/#installation">little code</a>, you can build lightboxes that use custom content loaded with ajax...</p>
		</div>

		<script src="feather/jquery-1.7.0.min.js"></script>
		<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

	</body>
</html>
