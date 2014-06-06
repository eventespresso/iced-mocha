<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Event Espresso - Iced Mocha Theme
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php  espresso_theme_meta_hook(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
 	espresso_theme_header_hook();
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php espresso_theme_body_hook(); ?>

<div id="wrapper" class="hfeed">
<div id="topbar" ><div id="topbar-inner"> <?php espresso_theme_topbar_hook(); ?> </div></div>
<?php espresso_theme_wrapper_hook(); ?>

<div id="header-full">
	<header id="header">
<?php espresso_theme_masthead_hook(); ?>
		<div id="masthead">
			<div id="branding" role="banner" >
				<?php espresso_theme_branding_hook();?>
				<?php espresso_theme_header_widgets_hook(); ?>
				<div style="clear:both;"></div>
			</div><!-- #branding -->
			<nav id="access" role="navigation">
				<?php espresso_theme_access_hook();?>
			</nav><!-- #access -->
		</div><!-- #masthead -->
	</header><!-- #header -->
</div><!-- #header-full -->

<div style="clear:both;height:0;"> </div>

<div id="main">
		<?php espresso_theme_main_hook(); ?>
	<div  id="forbottom" >
		<?php espresso_theme_forbottom_hook(); ?>

		<div style="clear:both;"> </div>

		<?php espresso_theme_breadcrumbs_hook();?>
