<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Iced Mocha
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */

get_header(); ?>

	<div id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
	
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'iced_mocha' ); ?></h1>
				<div class="entry-content">
					<div class="contentsearch">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'iced_mocha' ); ?></p>
					<?php get_search_form(); ?>
					</div>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
<?php iced_mocha_get_sidebar(); ?>
	</div><!-- #container -->
<?php get_footer(); ?>