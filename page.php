<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Iced Mocha
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */
get_header();
if ($iced_mocha_frontpage=="Enable" && is_front_page()): get_template_part( 'frontpage' );
else :
?>
		<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">

			<div id="content" role="main">
			<?php espresso_theme_before_content_hook(); ?>

				<?php get_template_part( 'content/content', 'page'); ?>

			<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
			<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #container -->


<?php
endif;
get_footer();
?>
