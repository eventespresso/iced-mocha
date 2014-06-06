<?php /*
 * meta related functions
 *
 * @package iced_mocha
 * @subpackage Functions
 */

/**
 * Filter for page meta title.
 */
function iced_mocha_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend name
    $filtered_title = $title.' - '.$site_name;
	// Get the Site Description
 	$site_description = get_bloginfo( 'description' );
    // If site front page, append description
    if ( (is_home() || is_front_page()) && $site_description ) {
        // Append Site Description to title
        $filtered_title =$site_name. " | ".$site_description;
    }
	// Add pagination if that's the case
	global $page, $paged;
	if ( $paged >= 2 || $page >= 2 )
	$filtered_title .=	 ' | ' . sprintf( __( 'Page %s', 'iced_mocha' ), max( $paged, $page ) );

    // Return the modified title
    return $filtered_title;
}

function iced_mocha_filter_wp_title_rss($title) {
return ' ';
}
add_filter( 'wp_title', 'iced_mocha_filter_wp_title' );
add_filter('wp_title_rss','iced_mocha_filter_wp_title_rss');

 /**
 * Meta author
 */
function iced_mocha_meta_name() {
	global $iced_mochas;
	foreach ($iced_mochas as $key => $value) {
     ${"$key"} = $value ;}
echo '<meta name="author" content="'.$iced_mocha_meta_author.'" />';
}
 /**
 * Meta Theme
 */
function iced_mocha_meta_template() {
echo PHP_EOL.'<meta property="template" content="iced_mocha" />'.PHP_EOL;
}
/**
 * Meta Title
 */
function iced_mocha_meta_title() {
global $iced_mochas;
echo "<title>".wp_title( '', false, 'right' )."</title>";
if ($iced_mochas['iced_mocha_iecompat']): echo PHP_EOL.'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'; endif;
}



add_action ('espresso_theme_meta_hook','iced_mocha_meta_title',0);
add_action ('espresso_theme_meta_hook','iced_mocha_meta_template');

// Iced Mocha Theme favicon
function iced_mocha_fav_icon() {
global $iced_mochas;
foreach ($iced_mochas as $key => $value) {
${"$key"} = $value ;}
	 echo '<link rel="shortcut icon" href="'.esc_url($iced_mochas['iced_mocha_favicon']).'" />';
	 echo '<link rel="apple-touch-icon" href="'.esc_url($iced_mochas['iced_mocha_favicon']).'" />';
	}

if ($iced_mochas['iced_mocha_favicon']) add_action ('espresso_theme_header_hook','iced_mocha_fav_icon');


?>