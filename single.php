<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Event Espresso - Iced Mocha Theme
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */

get_header();?>

		<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
			<div id="content" role="main">
			<?php espresso_theme_before_content_hook(); ?>
			
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php espresso_theme_post_title_hook(); ?>
					<div class="entry-meta">
						<?php iced_mocha_posted_on(); espresso_theme_post_meta_hook(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'iced_mocha' ), 'after' => '</span></div>' ) ); ?>
					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'iced_mocha_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php echo esc_attr( get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by ','iced_mocha').'%s <span class="meta-nav">&rarr;</span>', get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

					<footer class="entry-meta">
						<?php iced_mocha_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'iced_mocha' ), '<span class="edit-link"><i class="icon-edit icon-metas"></i> ', '</span>' ); espresso_theme_post_footer_hook(); ?>
					</footer><!-- .entry-meta -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<i class="meta-nav-prev"></i> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <i class="meta-nav-next"></i>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
	<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #container -->

<?php get_footer(); ?>
