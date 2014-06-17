<?php
/**
 * The default template for displaying content
 *
 * @package Iced Mocha
 * @subpackage Iced Mocha Theme
 * @since Iced Mocha Theme 1.0
 */

$options= iced_mocha_get_theme_options();
foreach ($options as $key => $value) {
     ${"$key"} = $value ;
} 

?><?php espresso_theme_before_article_hook(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
		<header class="entry-header">			
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'iced_mocha' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php espresso_theme_post_title_hook(); ?>
			<div class="entry-meta">
				<?php	espresso_theme_post_meta_hook();  ?>
			</div><!-- .entry-meta -->	
		</header><!-- .entry-header -->
		
			<?php espresso_theme_post_before_content_hook();  
			?><?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			
						<?php if ($iced_mocha_excerptarchive != "Full Post" ){ ?>
						<div class="entry-summary">
						<?php iced_mocha_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'iced_mocha' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }   ?>
			
		<?php else : 
				if (is_sticky() && $iced_mocha_excerptsticky == "Full Post")  $sticky_test=1; else $sticky_test=0;
				if ($iced_mocha_excerpthome != "Full Post" && $sticky_test==0){ ?>
					
					
						<div class="entry-summary">
						<?php iced_mocha_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary --> 
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'iced_mocha' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }  

			endif; ?>

		<footer class="entry-meta">
			<?php espresso_theme_post_after_content_hook();  ?>
		</footer>
	</article><!-- #post-<?php the_ID(); ?> -->
	
	
<?php espresso_theme_after_article_hook(); ?>