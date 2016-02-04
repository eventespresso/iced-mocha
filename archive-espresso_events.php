<?php
/**
 * Template Name: Event List
 *
 * This template will display a list of your events 
 *
 * @ package		Event Espresso
 * @ author		Seth Shoultes
 * @ copyright	(c) 2008-2014 Event Espresso  All Rights Reserved.
 * @ license		http://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link			http://www.eventespresso.com
 * @ version		EE4+
 */
get_header(); 
?>

	<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
			<div id="content" role="main">
			<?php espresso_theme_before_content_hook(); ?>
			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Today\'s Events: %s', 'event_espresso' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Events This Month: %s', 'event_espresso' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'event_espresso' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Events This Year: %s', 'event_espresso' ), get_the_date( _x( 'Y', 'yearly archives date format', 'event_espresso' ) ) );

						else :
							echo apply_filters( 'FHEE__archive_espresso_events_template__upcoming_events_h1', __( 'Upcoming Events', 'event_espresso' ));
							echo is_tax('espresso_event_categories')? single_term_title( ' '.__( 'in', 'event_espresso' ).' ', false):'';

						endif;
					?>
				</h1>
			</header><!-- .page-header -->
			
			<?php 
				// allow other stuff
				do_action( 'AHEE__archive_espresso_events_template__before_loop' ); 
				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					$event_class = has_excerpt( $post->ID ) ? ' has-excerpt' : '';
					$event_class = apply_filters( 'FHEE__content_espresso_events__event_class', $event_class );

					do_action( 'AHEE_event_details_before_post', $post ); 
					?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( $event_class ); ?>>

							<div id="espresso-event-list-header-dv-<?php echo $post->ID;?>" class="espresso-event-header-dv">
								<?php espresso_get_template_part( 'content/espresso/content', 'espresso_events-thumbnail' ); ?>
								<?php espresso_get_template_part( 'content/espresso/content', 'espresso_events-header' ); ?>
							</div>

							<div class="espresso-event-list-wrapper-dv">
								<?php the_content(); ?>
							</div>

						</article>
						<!-- #post -->
						
					<?php do_action( 'AHEE_event_details_after_post', $post );

				endwhile;
				// Previous/next page navigation.
				espresso_pagination();
				// allow moar other stuff
				do_action( 'AHEE__archive_espresso_events_template__after_loop' );

			else :
				// If no content, include the "No posts found" template.
				espresso_get_template_part( 'content', 'none' );
				
			endif;
			?>
			<?php espresso_theme_after_content_hook(); ?>
			</div><!-- #content -->
		<?php iced_mocha_get_sidebar(); ?>
		</section><!-- #primary -->

<?php get_footer(); ?>