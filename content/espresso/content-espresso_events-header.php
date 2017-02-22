<?php global $post; 
$date_format = apply_filters( 'iced_mocha_espresso_events_header_template_date_format', get_option( 'date_format' ) );
$time_format = apply_filters( 'iced_mocha_espresso_events_header_template_time_format', get_option( 'time_format' ) );
?>
<header class="event-header">
	<h1 id="event-details-h1-<?php echo $post->ID; ?>" class="entry-title">
		<a class="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h1>
	<?php if ( ! is_archive() && has_excerpt( $post->ID )): the_excerpt(); endif;?>
	<p id="event-date-p">
		<?php 
		if ( isset( $post->EE_Event ) && $post->EE_Event instanceof EE_Event ) {
			echo $post->EE_Event->primary_datetime()->start_date_and_time( $date_format, $time_format ); 
		}				
		?>
	</p>
</header>
