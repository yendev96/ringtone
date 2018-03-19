<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php 
	wp_head();
	?>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="icon" href="<?php bloginfo('template_url');?>/image/logo.png"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/circle.player.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/jplayer.blue.monday.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url');?>/style.css">
	<script src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.jplayer.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/circle.player.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.grab.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.transform.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/mod.csstransforms.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/myquery.js"></script>


	<script type="text/javascript">

		$(document).ready(function(){


			$('.dropdown-toggle').click(function(){
				$('.sub-menu').stop().slideToggle();
			});

			$('.button-show-hide').click(function(){
				$('.category').stop().slideToggle();

			})

			// $('body').click(function(){
			// 	$('.sub-menu').slideUp();
			// })

		});
	</script>
</head>
<body style="background: #d6d6d6;">
	<div class="wraper">
		<header id="header" class="myheader">

			<nav class="mynav">
				<div class="container-fluid">
					<div class="row">
						<div class="logo" style="position: relative;">

							<a class="navbar-brand" href="<?php bloginfo('url'); ?>" style="font-size: 20px;">
								<img src="<?php bloginfo('template_url');?>/image/logo.png" alt="" style="width: 55px;"> FreeRingTonesMobile
							</a>
							<i class="fas fa-align-justify button-show-hide"></i>
						</div>

						<div class="category">
							
							<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => 'list-menu',
								'walker' => new Sunset_Walker_Nav_Primary()
							) );	
							?>

						</div>
					</div>
				</div>
			</nav>
		</header><!-- /header -->
		
		<br><br>
		<div class="container" style="margin-top: 140px;">
			<?php get_search_form(); ?>
		</div>
