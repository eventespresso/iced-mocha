<?php
/**
 * The template for displaying an Audio Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Iced Mocha
 * @subpackage Iced Mocha Theme
 * @since Iced Mocha Theme 1.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'indexed' ); ?>>
	
		<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'iced_mocha' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php espresso_theme_post_title_hook(); ?>
			<div class="entry-meta">
				<?php	espresso_theme_post_meta_hook();  ?>
			</div><!-- .entry-meta -->		
		</header><!-- .entry-header -->
<?php espresso_theme_post_before_content_hook();  ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'iced_mocha' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'iced_mocha' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
						<h3 class="entry-format"><i class="icon-audio" title="<?php _e( 'Audio', 'iced_mocha' ); ?>"></i></h3>
			<?php espresso_theme_post_after_content_hook();  ?>
		</footer>
	</article><!-- #post-<?php the_ID(); ?> -->
