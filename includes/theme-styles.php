<?php
/*
 * Styles and scripts registration and enqueuing
 *
 * @package iced_mocha
 * @subpackage Functions
 */

// Adding the viewport meta if the mobile view has been enabled

function iced_mocha_register_styles() {
	wp_register_style( 'iced_mocha-style', get_stylesheet_uri() );
	wp_register_style( 'iced_mocha-fonts', get_template_directory_uri() . '/fonts/fontfaces.css' );
}

add_action('init', 'iced_mocha_register_styles' );


function iced_mocha_enqueue_styles() {
	global $iced_mochas;
	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value ;}
	
	$gfonts = array();
	
	if($iced_mocha_mobile=="Enable") { wp_register_style( 'iced_mocha-mobile', get_template_directory_uri() . '/styles/style-mobile.css' );}
	if($iced_mocha_frontpage=="Enable" ) { wp_register_style( 'iced_mocha-frontpage', get_template_directory_uri() . '/styles/style-frontpage.css' );}

	if($iced_mocha_googlefont) $gfonts[] = esc_attr(preg_replace( '/\s+/', '+', $iced_mocha_googlefont ));
	if($iced_mocha_googlefonttitle) $gfonts[] = esc_attr(preg_replace( '/\s+/', '+',$iced_mocha_googlefonttitle ));
	if($iced_mocha_googlefontside) $gfonts[] = esc_attr(preg_replace( '/\s+/', '+',$iced_mocha_googlefontside ));
	if($iced_mocha_headingsgooglefont) $gfonts[] = esc_attr(preg_replace( '/\s+/', '+',$iced_mocha_headingsgooglefont ));
	if($iced_mocha_sitetitlegooglefont) $gfonts[] = esc_attr(preg_replace( '/\s+/', '+',$iced_mocha_sitetitlegooglefont ));
	if($iced_mocha_menugooglefont) $gfonts[] = esc_attr(preg_replace( '/\s+/', '+',$iced_mocha_menugooglefont ));
	
	wp_enqueue_style( 'iced_mocha-fonts');
	
	// enqueue fonts with subsets separately
	foreach($gfonts as $i=>$gfont):
		if (strpos($gfont,"&") === false):
		   // do nothing
		else:
			wp_enqueue_style( 'iced_mocha-googlefont_'.$i, '//fonts.googleapis.com/css?family=' . $gfont );	
			unset($gfonts[$i]);
		endif;		
	endforeach;
	
	// merged fonts
	if ( count($gfonts)>0 ):
		wp_enqueue_style( 'iced_mocha-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique($gfonts) ), array(), null, 'screen' );
	endif;
	wp_enqueue_style( 'iced_mocha-style');
	
	// presentation page styling enqueued in frontpage.php
	if (($iced_mocha_frontpage=="Enable") && is_front_page()) { wp_enqueue_style( 'iced_mocha-frontpage' ); }

}

if( !is_admin() ) { add_action('wp_head', 'iced_mocha_enqueue_styles', 5 ); }

function iced_mocha_styles_echo() {
	global $iced_mochas;

	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value ;}
	echo preg_replace("/[\n\r\t\s]+/"," " ,iced_mocha_custom_styles())."\n";

	if(($iced_mocha_frontpage=="Enable")&&is_front_page()) { echo preg_replace("/[\n\r\t\s]+/"," " ,iced_mocha_presentation_css())."\n";}
	echo preg_replace("/[\n\r\t\s]+/"," " ,iced_mocha_customcss())."\n";
}

add_action('wp_head', 'iced_mocha_styles_echo', 20);

function iced_mocha_load_mobile_css() {
global $iced_mochas;
if ($iced_mochas['iced_mocha_mobile']=="Enable") {
	echo "<link rel='stylesheet' id='iced_mocha_style_mobile'  href='".get_template_directory_uri() . '/styles/style-mobile.css' . "' type='text/css' media='all' />";
}
}
add_action ('wp_head','iced_mocha_load_mobile_css', 30);

// JS loading and hook into wp_enque_scripts
add_action('wp_head', 'iced_mocha_customjs', 35 );



// Scripts loading and hook into wp_enque_scripts

function iced_mocha_scripts_method() {
global $iced_mochas;
foreach ($iced_mochas as $key => $value) {
    							 ${"$key"} = $value ;
									}

// If frontend - load the js for the menu and the social icons animations
	if ( !is_admin() ) {
		wp_register_script('espresso_theme-frontend',get_template_directory_uri() . '/js/frontend.js', array('jquery') );
		wp_enqueue_script('espresso_theme-frontend');
  		// If iced_mocha from page is enabled and the current page is home page - load the nivo slider js
		if($iced_mocha_frontpage == "Enable" && is_front_page()) {
							wp_register_script('espresso_theme-nivoSlider',get_template_directory_uri() . '/js/nivo-slider.js', array('jquery'));
							wp_enqueue_script('espresso_theme-nivoSlider');
							}
  	}


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

if( !is_admin() ) { add_action('wp_enqueue_scripts', 'iced_mocha_scripts_method'); }
?>