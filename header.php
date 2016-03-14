<?php
/**
 * Header
 */
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#"> <!--<![endif]-->
	<head>	
		<meta charset="utf-8" />
		
		<title><?php wp_title('|',true, 'right'); bloginfo('name'); ?></title>
		<meta name="description" content="">
		<meta name="author" content="Jeremy Castelli">
	
		<meta http-equiv="imagetoolbar" content="false" />

		<!--active thisif you want responsive design, otherwise it will break your normal layout on mobile-->
		<!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
		
		<link rel="dns-prefetch" href="//ajax.googleapis.com" />
		
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		
		<?php wp_head(); ?>
		
	</head>

	<body <?php body_class(); ?>>
		
		<div id="container" class="container">
		
			<header class="header">
		
				<a href="<?php echo home_url( '/' ); ?>" title="Retour à l'accueil" class="logo"><img src="<?php echo get_bloginfo('template_directory' ).'/images/logo.png'; ?>" alt="logo" /></a>
			
				<a href="#main" class="visuallyhidden">Skip navigation</a>
				<?php 
					/*
					$arg = array(
					  'theme_location'  => 'principal',
					  'menu'            => , 
					  'container'       => 'nav', 
					  'container_class' => 'menu-{menu slug}-container', 
					  'container_id'    => ,
					  'menu_class'      => 'menu', 
					  'menu_id'         => ,
					  'echo'            => true,
					  'fallback_cb'     => 'wp_page_menu',
					  'before'          => ,
					  'after'           => ,
					  'link_before'     => ,
					  'link_after'      => ,
					  'items_wrap'      => '<ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
					  'depth'           => 0,
					  'walker'          => );
					  */
					  
					  $arg = array('theme_location' => 'principal', 'container' => 'nav', 'container_class' => 'main-nav');
					wp_nav_menu( $arg ); 
				?>
	
			</header> <!-- end header -->
