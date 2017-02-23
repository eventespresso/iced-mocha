<?php
/**
 * Template Name: Event Details
 *
 * This is template will display all of your event's details
 *
 * @ package		Event Espresso - Event Registration and Management Plugin for WordPress
 * @ link			http://www.eventespresso.com
 * @ version		EE4+
 */
get_header(); 
?>

	<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
			<div id="content" role="main">
			<?php espresso_theme_before_content_hook(); ?>
		
			<div id="espresso-event-details-wrap-dv" class="">
				<div id="espresso-event-details-dv" class="" >				
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					$event_class = has_excerpt( $post->ID ) ? ' has-excerpt' : '';
					$event_class = apply_filters( 'FHEE__content_espresso_events__event_class', $event_class );
					
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( $event_class ); ?>>

						<div id="espresso-event-header-dv-<?php echo $post->ID;?>" class="espresso-event-header-dv">
							<?php espresso_get_template_part( 'content/espresso/content', 'espresso_events-thumbnail' ); ?>
							<?php espresso_get_template_part( 'content/espresso/content', 'espresso_events-header' ); ?>
						</div>

						<div class="espresso-event-wrapper-dv">
							<?php the_content(); ?>
							<footer class="event-meta">
								<?php do_action( 'AHEE_event_details_footer_top', $post ); ?>
								<?php do_action( 'AHEE_event_details_footer_bottom', $post ); ?>
							</footer>
						</div>
					</article>
					
					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
				</div>
			</div>

	<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
	<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #container -->

<?php get_footer(); ?>