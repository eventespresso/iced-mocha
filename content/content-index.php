<?php
/**
 * The index template for displaying content
 *
 * @package Iced Mocha
 * @subpackage Iced Mocha Theme
 * @since Iced Mocha Theme 1.1
 */

$options = iced_mocha_get_theme_options();
foreach ($options as $key => $value) { ${"$key"} = $value; } 
?>

		<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">

			<div id="content" role="main">

			<?php espresso_theme_before_content_hook();

			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'content/content', get_post_format() );

				endwhile;

				if($iced_mocha_pagination=="Enable") iced_mocha_pagination(); else iced_mocha_content_nav( 'nav-below' );

			else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'iced_mocha' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iced_mocha' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php
			endif;
			espresso_theme_after_content_hook();
			?>

			</div><!-- #content -->
		<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #container -->
