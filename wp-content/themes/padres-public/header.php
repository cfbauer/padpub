<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Padres Public
 * @since Padres Public 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type"text/javascript" src="https://ia902500.us.archive.org/22/items/gfycat_hover/gfycat_hover.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" />
<meta name="theme-color" content="#E2DBC9">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</hgroup>

		<nav role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text"><?php _e( '<i class="fa fa-bars"></i>', 'padres_public' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'padres_public' ); ?>"><?php _e( 'Skip to content', 'padres_public' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->

	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">

	<div id="banner"><a rel="lightbox[8035]" title="Chicken Schtick" class="chickenschtick cboxElement" href="/wordpress/wp-content/uploads/2013/07/chickenschtick.gif"></a></div>

