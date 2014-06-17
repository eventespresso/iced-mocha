<?php
/**
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Iced Mocha
 * @subpackage Iced Mocha Theme
 */

if ( have_posts()  ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<div style="clear:both;"></div>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'iced_mocha' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'iced_mocha' ), '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php  comments_template( '', true );
				endwhile; ?>
