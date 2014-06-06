<?php
/**
 * Template Name: One column, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package Event Espresso - Iced Mocha Theme
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */

get_header(); ?>

		<section id="container" class="one-column">
	
			<div id="content" role="main">

				<?php get_template_part( 'content/content', 'page'); ?>

			</div><!-- #content -->
			
		</section><!-- #container -->

<?php get_footer(); ?>
