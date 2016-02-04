<?php
/**
 * Espresso Template functions
 *
 * @ package		Event Espresso
 * @ author		Seth Shoultes
 * @ copyright	(c) 2008-2014 Event Espresso  All Rights Reserved.
 * @ license		http://venueespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link			http://www.eventespresso.com
 * @ version		4+
 */
define( 'EE_THEME_FUNCTIONS_LOADED', TRUE );
 
/**
 * 	espresso_pagination
 *
 *  @access 	public
 *  @return 	void
 */
function espresso_pagination() {
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	$pagination = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'show_all'     => TRUE,
		'end_size'     => 10,
		'mid_size'     => 6,
		'prev_next'    => TRUE,
		'prev_text'    => __( '&lsaquo; PREV', 'event_espresso' ),
		'next_text'    => __( 'NEXT &rsaquo;', 'event_espresso' ),
		'type'         => 'plain',
		'add_args'     => FALSE,
		'add_fragment' => ''
	));
	echo ! empty( $pagination ) ? '<div class="ee-pagination-dv clear">' . $pagination . '</div>' : '';
}

/**
 * 	espresso_locate_template_custom_directory
 *
 *  @access 	public
 *  @return 	array		array of full template paths.
 */
function espresso_locate_template_custom_directory( $full_template_paths, $template_filename ) {	

	//Build the new full template path to check within iced-mocha
	$theme_espresso_template_dir = get_stylesheet_directory() . '/content/espresso/' . $template_filename;

	//Add the new template path to the paths check by locate_template()
	array_unshift( $full_template_paths, $theme_espresso_template_dir );

	//Debug line - output all of template paths EE will search.
	//d($full_template_paths);
	
	return $full_template_paths;

}
add_filter( 'FHEE__EEH_Template__locate_template__full_template_paths', 'espresso_locate_template_custom_directory', 10, 2 );

//Use the custom template order when using single-espresso_events.php template file.
add_filter( 'FHEE__EED_Event_Single__template_include__allow_custom_selected_template', '__return_true' );

//Use the custom template order when using archive-espresso_events.php template file.
add_filter( 'FHEE__EED_Event_Archive__template_include__allow_custom_selected_template', '__return_true' );