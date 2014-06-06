<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Event Espresso - Iced Mocha Theme
 * @subpackage Iced Mocha Theme
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">		
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'iced_mocha' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>				
			<?php espresso_theme_post_title_hook(); ?>
				<div class="entry-meta">
					<?php	espresso_theme_post_meta_hook();  ?>
				</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
	<?php espresso_theme_post_before_content_hook();  
	?><?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">	
			<?php /* endif; */ ?>
			<div class="avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'iced_mocha_status_avatar', '65' ) ); ?>
			</div>
			<div class="status_content">	
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'iced_mocha' ) ); ?> </div>
			</div><!-- .entry-content -->
		<?php endif; ?>
		<footer class="entry-meta">
						<h3 class="entry-format"><i class="icon-status" title="<?php _e( 'Status', 'iced_mocha' ); ?>"></i></h3>
			<?php espresso_theme_post_after_content_hook();  ?>
		</footer>
	</article><!-- #post-<?php the_ID(); ?> -->
