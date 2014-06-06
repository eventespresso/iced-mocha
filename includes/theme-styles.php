<?php
/*
 * Styles and scripts registration and enqueuing
 *
 * @package iced_mocha
 * @subpackage Functions
 */

// Adding the viewport meta if the mobile view has been enabled

function iced_mocha_register_styles() {
	global $iced_mochas;
	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value ;}

	wp_register_style( 'iced_mochas', get_stylesheet_uri() );

	if($iced_mocha_mobile=="Enable") { wp_register_style( 'iced_mocha-mobile', get_template_directory_uri() . '/styles/style-mobile.css' );}
	if($iced_mocha_frontpage=="Enable" ) { wp_register_style( 'iced_mocha-frontpage', get_template_directory_uri() . '/styles/style-frontpage.css' );}

	if($iced_mocha_googlefont) wp_register_style( 'iced_mocha_googlefont', esc_attr("//fonts.googleapis.com/css?family=".preg_replace( '/\s+/', '+', $iced_mocha_googlefont )));
	if($iced_mocha_googlefonttitle) wp_register_style( 'iced_mocha_googlefonttitle', esc_attr("//fonts.googleapis.com/css?family=".preg_replace( '/\s+/', '+',$iced_mocha_googlefonttitle )));
	if($iced_mocha_googlefontside) wp_register_style( 'iced_mocha_googlefontside',esc_attr("//fonts.googleapis.com/css?family=".preg_replace( '/\s+/', '+',$iced_mocha_googlefontside )));
	if($iced_mocha_headingsgooglefont) wp_register_style( 'iced_mocha_headingsgooglefont', esc_attr("//fonts.googleapis.com/css?family=".preg_replace( '/\s+/', '+',$iced_mocha_headingsgooglefont )));
	if($iced_mocha_sitetitlegooglefont) wp_register_style( 'iced_mocha_sitetitlegooglefont', esc_attr("//fonts.googleapis.com/css?family=".preg_replace( '/\s+/', '+',$iced_mocha_sitetitlegooglefont )));
	if($iced_mocha_menugooglefont) wp_register_style( 'iced_mocha_menugooglefont', esc_attr("//fonts.googleapis.com/css?family=".preg_replace( '/\s+/', '+',$iced_mocha_menugooglefont )));

}

add_action('init', 'iced_mocha_register_styles' );


function iced_mocha_enqueue_styles() {
	global $iced_mochas;
	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value ;}

	wp_enqueue_style( 'iced_mochas');
	wp_enqueue_style( 'iced_mochas2');
	wp_enqueue_style( 'iced_mocha_googlefont');
	wp_enqueue_style( 'iced_mocha_googlefonttitle');
	wp_enqueue_style( 'iced_mocha_googlefontside');
	wp_enqueue_style( 'iced_mocha_headingsgooglefont');
	wp_enqueue_style( 'iced_mocha_sitetitlegooglefont');
	wp_enqueue_style( 'iced_mocha_menugooglefont');
	// presentation page styling enqued in frontpage.php
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

function iced_mocha_mobile_meta() {
global $iced_mochas;
foreach ($iced_mochas as $key => $value) {
    							 ${"$key"} = $value ;
									}
return '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">';
}

function iced_mocha_load_mobile_css() {
global $iced_mochas;
foreach ($iced_mochas as $key => $value) {
    							 ${"$key"} = $value ;
									}
	if ($iced_mocha_mobile=="Enable") {
		echo "\n".iced_mocha_mobile_meta()."\n";
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