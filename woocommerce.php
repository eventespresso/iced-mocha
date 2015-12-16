<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package espresso_theme Creations
 * @subpackage iced_mocha
 * @since iced_mocha 1.3
 */
get_header();
?>
		<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">

			<div id="content" role="main">
			<?php espresso_theme_before_content_hook(); ?>

				<?php woocommerce_content(); ?>

			<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
			<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #container -->


<?php
get_footer();
?>
