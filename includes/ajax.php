<?php 
/**
 * Ajax related functions
 * Since Iced Mocha 1.0
*/

if (  'posts' == get_option( 'show_on_front' )) add_action('pre_get_posts', 'espresso_theme_query_offset', 1 );

function espresso_theme_query_offset(&$query) {

	$iced_mochas = iced_mocha_get_theme_options();
	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; } 

	if ( !is_front_page() || $iced_mocha_frontpage != "Enable" )  {
		return;
	}

    //Determine how many posts per page you want (we'll use WordPress's settings)
    $ppp = $iced_mochas['iced_mocha_frontpostscount'];

    //Detect and handle pagination...
    if ( $query->is_paged ) {

        //Manually determine page query offset (offset + current page (minus one) x posts per page)
        $page_offset =  ($query->query_vars['paged']-1) * $ppp ;

        //Apply adjust page offset
        $query->set('offset', $page_offset );

    }
    else {

        //This is the first page. No offset
        $query->set('offset',0);

    }
}

if (  'posts' == get_option( 'show_on_front' )) add_action('template_redirect', 'espresso_theme_ajax_init');

	 function espresso_theme_ajax_init() {
	    // loading our theme settings
		$iced_mochas = iced_mocha_get_theme_options();
		foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; } 
		
		if(is_front_page() && $iced_mocha_frontpage=="Enable") {  
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$the_query = new WP_Query( array('posts_per_page'=>$iced_mochas['iced_mocha_frontpostscount']) ); 
		}
	/*	elseif (is_page_template('templates/template-blog.php')) {
			$the_query = new WP_Query( 'post_status=publish&orderby=date&order=desc&posts_per_page='.get_option('posts_per_page'));
		}
		elseif (is_home()) {
			global $wp_query;
			$the_query = $wp_query;
		}*/
		else {return;}
		// Enqueue JS 
		wp_enqueue_script(
			'espresso_theme_ajax_more',
			get_template_directory_uri(). '/js/ajax.js',
			array('jquery'),
			'1.0',
			true
		);

		// Max number of pages
		$page_number_max = $the_query->max_num_pages;

		// Next page to load
		$page_number_next = (get_query_var('paged') > 1) ? get_query_var('paged') + 1 : 2;

		// Add some parameters for the JS.
		wp_localize_script(
			'espresso_theme_ajax_more',
			'espresso_theme_ajax_more',
			array(
				'page_number_next' => $page_number_next,
				'page_number_max' => $page_number_max,
				'page_link_model' => get_pagenum_link(9999999),
				'load_more_str' => __('More posts', 'iced_mocha'),
				'content_css_selector' => '#content',
				'pagination_css_selector' =>  '.pagination, .navigation',
			)
		);
	}
