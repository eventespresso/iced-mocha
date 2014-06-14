<?php
/**
 * The frontpage template for displaying posts
 *
 * @package Event Espresso - Iced Mocha Theme
 * @subpackage Iced Mocha Theme
 * @since Iced Mocha Theme 1.0
 */

$iced_mochas = iced_mocha_get_theme_options();
foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; } 
?>

		

			<?php //espresso_theme_before_content_hook();

			if ( have_posts() ) :

				/* Start the Loop */
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$the_query = new WP_Query( array('posts_per_page'=>$iced_mochas['iced_mocha_frontpostscount'],'paged'=> $paged) ); 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
 
 		            global $more; $more=0; 
					get_template_part( 'content/content', get_post_format() );

				endwhile;

				if($iced_mocha_pagination=="Enable") iced_mocha_pagination($the_query->max_num_pages); else iced_mocha_content_nav( 'nav-below' );

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
			//espresso_theme_after_content_hook();
			?>
