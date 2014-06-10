jQuery(document).ready(function($) {
	// The number of the next page to load (/page/x/).
	var page_number_next = parseInt(espresso_theme_ajax_more.page_number_next);
	
	// The maximum number of pages the current query can return.
	var page_number_max = parseInt(espresso_theme_ajax_more.page_number_max);
	
	// The link of the next page of posts.
	var page_link_model = espresso_theme_ajax_more.page_link_model;
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(page_number_next <= page_number_max) {
		// Insert the "More Posts" link.
		$(espresso_theme_ajax_more.content_css_selector)
			.append('<div id="espresso_theme_ajax_more_placeholder_'+ page_number_next +'"></div>')
			.append('<div id="espresso_theme_ajax_more_trigger">{loadmore}</div>'.replace('{loadmore}', espresso_theme_ajax_more.load_more_str));
			
		// Remove the traditional navigation.
		$(espresso_theme_ajax_more.pagination_css_selector).remove();
	}
		
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#espresso_theme_ajax_more_trigger').click(function() {
	    // Loading gif
		$(this).addClass('espresso_theme_click_loading');
		
		if(page_number_next <= page_number_max) {
			
			// Get the link for the next page to load
			var next_link = page_link_model.replace(/9999999/, page_number_next);
				
			// Load the next page - only .post class
			$('#espresso_theme_ajax_more_placeholder_'+ page_number_next).load(next_link + ' .post',
				function() {
					// Small fade in animation for each .post 
					$('#espresso_theme_ajax_more_placeholder_'+ page_number_next +' .post').fitVids().hide().each(function( index ) {
						$(this).delay(200*index).fadeIn('slow');			
					});
					// Removal of loading gif
					$('#espresso_theme_ajax_more_trigger').removeClass('espresso_theme_click_loading');
					
					// Update page number and next_link.					
					page_number_next++;
					
					// Add a new placeholder, for when user clicks again.
					$('#espresso_theme_ajax_more_trigger')
						.before('<div id="espresso_theme_ajax_more_placeholder_'+ page_number_next +'"></div>');
					// Debugging
					// alert ('Next page link= '+page_link_model+'| Next number= '+page_number_next+'| Max pages= '+page_number_max);
					// Remove the button when there are no more posts to load.
					if(page_number_next > page_number_max) {
						$('#espresso_theme_ajax_more_trigger').remove();
					} 
				}
			);
			
		}
		return false;
	});
});