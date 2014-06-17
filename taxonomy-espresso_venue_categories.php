<?php
/**
 * Template Name: Venue Category List
 *
 * This is template will display a list of your event venues 
 *
 * Event Registration and Management Plugin for WordPress
 *
 * @ package		Event Espresso
 * @ author		Seth Shoultes
 * @ copyright	(c) 2008-2014 Event Espresso  All Rights Reserved.
 * @ license		http://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link			http://www.eventespresso.com
 * @ version		EE4+
 */
 get_header(); 
?>

	<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
			<div id="content" role="main">
			<?php espresso_theme_before_content_hook(); ?>
			<?php get_template_part( 'loop', 'espresso_venues' ); ?>			
			<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
		<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #primary -->
<?php get_footer(); ?>