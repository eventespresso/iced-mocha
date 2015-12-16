<?php 
/*
 * meta related functions
 *
 * @package iced_mocha
 * @subpackage Functions
 */

function iced_mocha_mobile_meta() {
global $iced_mochas;
if ($iced_mochas['iced_mocha_iecompat']) echo PHP_EOL.'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'.PHP_EOL;
if ($iced_mochas['iced_mocha_zoom']==1) 
    echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0">';
else echo '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">';
echo PHP_EOL;
}

add_action ('espresso_theme_meta_hook','iced_mocha_mobile_meta');

// Iced Mocha favicon
function iced_mocha_fav_icon() {
global $iced_mochas;
foreach ($iced_mochas as $key => $value) {
${"$key"} = $value ;}
     echo '<link rel="shortcut icon" href="'.esc_url($iced_mochas['iced_mocha_favicon']).'" />';
     echo '<link rel="apple-touch-icon" href="'.esc_url($iced_mochas['iced_mocha_favicon']).'" />';
    }

if ($iced_mochas['iced_mocha_favicon']) add_action ('espresso_theme_header_hook','iced_mocha_fav_icon');