<?php
/**
 * The template for displaying Search results pages.
 *
 * @package Iced Mocha
 * @subpackage Iced Mocha Theme
 * @since Iced Mocha Theme 1.0
 */

get_header(); ?>

		<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
			<div id="content" role="main">
	<?php espresso_theme_before_content_hook(); ?>
	
			<?php if ( have_posts() ) : ?>

				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'iced_mocha' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	<div class="contentsearch"><?php get_search_form(); ?></div>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

									<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'content/content', get_post_format() );
				?>
										<?php endwhile; ?>

				<?php if($iced_mocha_pagination=="Enable") iced_mocha_pagination(); else iced_mocha_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'iced_mocha' ); ?></h1>
					</header><!-- .entry-header -->
					<h4><?php printf( __( 'No search results for: %s.', 'iced_mocha' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					<br><div class="contentsearch"><?php get_search_form(); ?></div>
				</article><!-- #post-0 -->
	
				<?php endif; ?>


			<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
		<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #primary -->

<?php get_footer(); ?>
