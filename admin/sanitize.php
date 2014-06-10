<?php

/*
 *
 * Settings arrays
 *
 */

/* Font family arrays */
$iced_mocha_colorschemes_array = array(
// color scheme presets are defined via schemes.php
);

$fonts = array(

	'Theme Fonts' => array(
					 "Droid Sans",
					 "Ubuntu",
					 "Ubuntu Light",
					 "Open Sans",
					 "Open Sans Light",
					 "Bebas Neue",
					 "Oswald",
					 "Oswald Light",
					 "Yanone Kaffeesatz Regular",
					 "Yanone Kaffeesatz Light"),

	'Sans-Serif' => array("Segoe UI, Arial, sans-serif",
					 "Verdana, Geneva, sans-serif " ,
					 "Geneva, sans-serif ",
					 "Helvetica Neue, Arial, Helvetica, sans-serif",
					 "Helvetica, sans-serif" ,
					 "Century Gothic, AppleGothic, sans-serif",
				      "Futura, Century Gothic, AppleGothic, sans-serif",
					 "Calibri, Arian, sans-serif",
				      "Myriad Pro, Myriad,Arial, sans-serif",
					 "Trebuchet MS, Arial, Helvetica, sans-serif" ,
					 "Gill Sans, Calibri, Trebuchet MS, sans-serif",
					 "Impact, Haettenschweiler, Arial Narrow Bold, sans-serif ",
					 "Tahoma, Geneva, sans-serif" ,
					 "Arial, Helvetica, sans-serif" ,
					 "Arial Black, Gadget, sans-serif",
					 "Lucida Sans Unicode, Lucida Grande, sans-serif "),

	'Serif' => array("Georgia, Times New Roman, Times, serif" ,
					  "Times New Roman, Times, serif",
					  "Cambria, Georgia, Times, Times New Roman, serif",
					  "Palatino Linotype, Book Antiqua, Palatino, serif",
					  "Book Antiqua, Palatino, serif",
					  "Palatino, serif",
				       "Baskerville, Times New Roman, Times, serif",
 					  "Bodoni MT, serif",
					  "Copperplate Light, Copperplate Gothic Light, serif",
					  "Garamond, Times New Roman, Times, serif"),

	'MonoSpace' => array( "Courier New, Courier, monospace" ,
					  "Lucida Console, Monaco, monospace",
					  "Consolas, Lucida Console, Monaco, monospace",
					  "Monaco, monospace"),

	'Cursive' => array(  "Lucida Casual, Comic Sans MS , cursive ",
				      "Brush Script MT,Phyllis,Lucida Handwriting,cursive",
					 "Phyllis,Lucida Handwriting,cursive",
					 "Lucida Handwriting,cursive",
					 "Comic Sans MS, cursive")
); // fonts


/* Social media links */

$socialNetworks = array (
		"AboutMe", "AIM", "Amazon", "Delicious", "DeviantArt", 
		"Digg", "Dribbble", "Etsy", "Facebook", "Flickr",
		"FriendFeed", "GoodReads", "GooglePlus", "IMDb", "Instagram",
		"LastFM", "LinkedIn", "Mail", "MySpace", "Newsvine", 
		"Picasa", "Pinterest", "Reddit", "RSS", "ShareThis",  
		"Skype", "Steam", "SoundCloud", "StumbleUpon", "Technorati", 
		"Tumblr",  "Twitch", "Twitter", "Vimeo", "VK",
		"WordPress", "Yahoo", "Yelp", "YouTube", "Xing" );

if (!function_exists ('iced_mocha_options_validate') ) :
/*
 *
 * Validate user data
 *
 */
function iced_mocha_settings_validate($input) {
global $iced_mocha_defaults;
global $iced_mochas;
global $iced_mocha_colorschemes_array ;

$colorSchemes = ( ! empty( $input['iced_mocha_schemessubmit']) ? true : false );
if ($colorSchemes) : $input = array_merge($iced_mochas,json_decode("{".$iced_mocha_colorschemes_array[$input['iced_mocha_colorschemes']]."}",true));
else :
/*** 1 ***/
	if(isset($input['iced_mocha_sidewidth']) && is_numeric($input['iced_mocha_sidewidth']) && $input['iced_mocha_sidewidth']>=500 && $input['iced_mocha_sidewidth'] <=1760) {} else {$input['iced_mocha_sidewidth']=$iced_mocha_defaults['iced_mocha_sidewidth']; }
	if(isset($input['iced_mocha_sidebar']) && is_numeric($input['iced_mocha_sidebar']) && $input['iced_mocha_sidebar']>=220 && $input['iced_mocha_sidebar'] <=800) {} else {$input['iced_mocha_sidebar']=$iced_mocha_defaults['iced_mocha_sidebar']; }

	$input['iced_mocha_hheight'] =  intval(wp_kses_data($input['iced_mocha_hheight']));
	$input['iced_mocha_copyright'] = trim(wp_kses_post($input['iced_mocha_copyright']));

	$input["iced_mocha_backcolorheader"] = trim(wp_kses_data($input['iced_mocha_backcolorheader']));
	$input["iced_mocha_backcolormain"] = trim(wp_kses_data($input['iced_mocha_backcolormain']));
	$input["iced_mocha_backcolorfooterw"] = trim(wp_kses_data($input['iced_mocha_backcolorfooterw']));
	$input["iced_mocha_backcolorfooter"] = trim(wp_kses_data($input['iced_mocha_backcolorfooter']));

	$input["iced_mocha_contentcolortxt"] = trim(wp_kses_data($input['iced_mocha_contentcolortxt']));
	$input["iced_mocha_contentcolortxtlight"] = trim(wp_kses_data($input['iced_mocha_contentcolortxtlight']));
	$input["iced_mocha_footercolortxt"] = trim(wp_kses_data($input['iced_mocha_footercolortxt']));

	$input["iced_mocha_titlecolor"] = trim(wp_kses_data($input['iced_mocha_titlecolor']));
	$input["iced_mocha_descriptioncolor"] = trim(wp_kses_data($input['iced_mocha_descriptioncolor']));
	$input["iced_mocha_descriptionbg"] = trim(wp_kses_data($input['iced_mocha_descriptionbg']));

	$input["iced_mocha_menucolorbgdefault"] = trim(wp_kses_data($input['iced_mocha_menucolorbgdefault']));
	$input["iced_mocha_menucolorbghover"] = trim(wp_kses_data($input['iced_mocha_menucolorbghover']));
	$input["iced_mocha_menucolorbgactive"] = trim(wp_kses_data($input['iced_mocha_menucolorbgactive']));
	$input["iced_mocha_menucolorshadow"] = trim(wp_kses_data($input['iced_mocha_menucolorshadow']));
	$input["iced_mocha_menucolortxtdefault"] = trim(wp_kses_data($input['iced_mocha_menucolortxtdefault']));
	$input["iced_mocha_menucolortxthover"] = trim(wp_kses_data($input['iced_mocha_menucolortxthover']));
	$input["iced_mocha_menucolortxtactive"] = trim(wp_kses_data($input['iced_mocha_menucolortxtactive']));

	$input["iced_mocha_topmenucolortxt"] = trim(wp_kses_data($input['iced_mocha_topmenucolortxt']));
	$input["iced_mocha_topmenucolortxthover"] = trim(wp_kses_data($input['iced_mocha_topmenucolortxthover']));
	$input["iced_mocha_topbarcolorbg"] = trim(wp_kses_data($input['iced_mocha_topbarcolorbg']));

	$input["iced_mocha_contentcolorbg"] = trim(wp_kses_data($input['iced_mocha_contentcolorbg']));
	$input["iced_mocha_contentcolortxttitle"] = trim(wp_kses_data($input['iced_mocha_contentcolortxttitle']));
	$input["iced_mocha_contentcolortxttitlehover"] = trim(wp_kses_data($input['iced_mocha_contentcolortxttitlehover']));
	$input["iced_mocha_contentcolortxtheadings"] = trim(wp_kses_data($input['iced_mocha_contentcolortxtheadings']));

	$input["iced_mocha_sidebg"] = trim(wp_kses_data($input['iced_mocha_sidebg']));
	$input["iced_mocha_sidetxt"] = trim(wp_kses_data($input['iced_mocha_sidetxt']));
	$input["iced_mocha_sidetitlebg"] = trim(wp_kses_data($input['iced_mocha_sidetitlebg']));
	$input["iced_mocha_sidetitletxt"] = trim(wp_kses_data($input['iced_mocha_sidetitletxt']));

	$input["iced_mocha_widgetbg"] = trim(wp_kses_data($input['iced_mocha_widgetbg']));
	$input["iced_mocha_widgettxt"] = trim(wp_kses_data($input['iced_mocha_widgettxt']));
	$input["iced_mocha_widgettitlebg"] = trim(wp_kses_data($input['iced_mocha_widgettitlebg']));
	$input["iced_mocha_widgettitletxt"] = trim(wp_kses_data($input['iced_mocha_widgettitletxt']));

	$input["iced_mocha_linkcolortext"] = trim(wp_kses_data($input['iced_mocha_linkcolortext']));
	$input["iced_mocha_linkcolorhover"] = trim(wp_kses_data($input['iced_mocha_linkcolorhover']));
	$input["iced_mocha_linkcolorside"] = trim(wp_kses_data($input['iced_mocha_linkcolorside']));
	$input["iced_mocha_linkcolorsidehover"] = trim(wp_kses_data($input['iced_mocha_linkcolorsidehover']));
	$input["iced_mocha_linkcolorwooter"] = trim(wp_kses_data($input['iced_mocha_linkcolorwooter']));
	$input["iced_mocha_linkcolorwooterhover"] = trim(wp_kses_data($input['iced_mocha_linkcolorwooterhover']));
	$input["iced_mocha_linkcolorfooter"] = trim(wp_kses_data($input['iced_mocha_linkcolorfooter']));
	$input["iced_mocha_linkcolorfooterhover"] = trim(wp_kses_data($input['iced_mocha_linkcolorfooterhover']));

	$input["iced_mocha_accentcolora"] = trim(wp_kses_data($input['iced_mocha_accentcolora']));
	$input["iced_mocha_accentcolorb"] = trim(wp_kses_data($input['iced_mocha_accentcolorb']));
	$input["iced_mocha_accentcolorc"] = trim(wp_kses_data($input['iced_mocha_accentcolorc']));
	$input["iced_mocha_accentcolord"] = trim(wp_kses_data($input['iced_mocha_accentcolord']));
	$input["iced_mocha_accentcolore"] = trim(wp_kses_data($input['iced_mocha_accentcolore']));
	
	$input['iced_mocha_frontpostscount'] =  intval(wp_kses_data($input['iced_mocha_frontpostscount'])); 

	$input['iced_mocha_fronttitlecolor'] =  wp_kses_data($input['iced_mocha_fronttitlecolor']);
	$input['iced_mocha_fpsliderbordercolor'] =  wp_kses_data($input['iced_mocha_fpsliderbordercolor']);
	$input['iced_mocha_fpslidercaptioncolor'] =  wp_kses_data($input['iced_mocha_fpslidercaptioncolor']);
	$input['iced_mocha_fpslidercaptionbg'] =  wp_kses_data($input['iced_mocha_fpslidercaptionbg']);
	
	$input["iced_mocha_socialcolorbg"] = trim(wp_kses_data($input['iced_mocha_socialcolorbg']));
	$input["iced_mocha_socialcolorbghover"] = trim(wp_kses_data($input['iced_mocha_socialcolorbghover']));
	
	$input["iced_mocha_metacoloricons"] = trim(wp_kses_data($input['iced_mocha_metacoloricons']));
	$input["iced_mocha_metacolorlinks"] = trim(wp_kses_data($input['iced_mocha_metacolorlinks']));
	$input["iced_mocha_metacolorlinkshover"] = trim(wp_kses_data($input['iced_mocha_metacolorlinkshover']));

	$input['iced_mocha_excerptwords'] =  intval(wp_kses_data($input['iced_mocha_excerptwords']));
	$input['iced_mocha_excerptdots'] =  wp_kses_data($input['iced_mocha_excerptdots']);
	$input['iced_mocha_excerptcont'] =  wp_kses_data($input['iced_mocha_excerptcont']);

	$input['iced_mocha_fwidth'] =  intval(wp_kses_data($input['iced_mocha_fwidth']));
	$input['iced_mocha_fheight'] =  intval(wp_kses_data($input['iced_mocha_fheight']));

	$input['iced_mocha_contentmargintop'] =  intval(wp_kses_data($input['iced_mocha_contentmargintop']));
	$input['iced_mocha_contentpadding'] =  intval(wp_kses_data($input['iced_mocha_contentpadding']));

/*** 2 ***/

	$espresso_theme_special_terms = array('mailto:','callto://');
	$espresso_theme_special_keys = array('Mail', 'Skype');
	for ($i=1;$i<10;$i+=2) {
		if (!isset($input['iced_mocha_social_target'.$i])) {$input['iced_mocha_social_target'.$i] = "0";}
		$input['iced_mocha_social_title'.$i] = wp_kses_data(trim($input['iced_mocha_social_title'.$i]));
		$j=$i+1;
		if (in_array($input['iced_mocha_social'.$i],$espresso_theme_special_keys)) :
			$input['iced_mocha_social'.$j]	= wp_kses_data(str_replace($espresso_theme_special_terms,'',$input['iced_mocha_social'.$j]));
			if ($input['iced_mocha_social'.$i]=='Mail') {$input['iced_mocha_social'.$j]='mailto:'.$input['iced_mocha_social'.$j];};
			if ($input['iced_mocha_social'.$i]=='Skype') {$input['iced_mocha_social'.$j]='callto://'.$input['iced_mocha_social'.$j];};
		else :
			$input['iced_mocha_social'.$j] = esc_url_raw($input['iced_mocha_social'.$j]);
		endif;
	}
	for ($i=0;$i<=5;$i++) {
		if (!isset($input['iced_mocha_socialsdisplay'.$i])) {$input['iced_mocha_socialsdisplay'.$i] = "0";}
		}
		
	$show_blog= array("author","date","time","category","tag","comments");
	foreach ($show_blog as $item) :
		if (!isset($input['iced_mocha_blog_show'][$item])) {$input['iced_mocha_blog_show'][$item] = 0;}
	endforeach;
	
	$show_single= array("author","date","time","category","tag","bookmark");
	foreach ($show_single as $item) :
	if (!isset($input['iced_mocha_single_show'][$item])) {$input['iced_mocha_single_show'][$item] = 0;}
	endforeach;


	$input['iced_mocha_favicon'] =  esc_url_raw($input['iced_mocha_favicon']);
	$input['iced_mocha_logoupload'] =  esc_url_raw($input['iced_mocha_logoupload']);
	$input['iced_mocha_headermargintop'] =  intval(wp_kses_data($input['iced_mocha_headermargintop']));
	$input['iced_mocha_headermarginleft'] =  intval(wp_kses_data($input['iced_mocha_headermarginleft']));

	$input['iced_mocha_customcss'] =  wp_kses_post(trim($input['iced_mocha_customcss']));
	$input['iced_mocha_customjs'] =  wp_kses_post(trim($input['iced_mocha_customjs']));

	$input['iced_mocha_googlefont'] = 	trim(wp_kses_data($input['iced_mocha_googlefont']));
	$input['iced_mocha_googlefonttitle'] = 	trim(wp_kses_data($input['iced_mocha_googlefonttitle']));
	$input['iced_mocha_googlefontside'] = 	trim(wp_kses_data($input['iced_mocha_googlefontside']));
	$input['iced_mocha_headingsgooglefont'] = 	trim(wp_kses_data($input['iced_mocha_headingsgooglefont']));
	$input['iced_mocha_sitetitlegooglefont'] = 	trim(wp_kses_data($input['iced_mocha_sitetitlegooglefont']));
	$input['iced_mocha_menugooglefont'] = 	trim(wp_kses_data($input['iced_mocha_menugooglefont']));

	$input['iced_mocha_slideNumber'] =  intval(wp_kses_data($input['iced_mocha_slideNumber']));
	$input['iced_mocha_slideSpecific'] = wp_kses_data($input['iced_mocha_slideSpecific']);

	$input['iced_mocha_fpsliderwidth'] =  intval(wp_kses_data($input['iced_mocha_fpsliderwidth']));
	$input['iced_mocha_fpsliderheight'] = intval(wp_kses_data($input['iced_mocha_fpsliderheight']));
	$input['iced_mocha_fpslider_topmargin'] = intval(wp_kses_data($input['iced_mocha_fpslider_topmargin']));
	$input['iced_mocha_fpslider_bordersize'] = intval(wp_kses_data($input['iced_mocha_fpslider_bordersize']));
	
/** 3 ***/
	$input['iced_mocha_sliderimg1'] =  wp_kses_data($input['iced_mocha_sliderimg1']);
	$input['iced_mocha_slidertitle1'] =  wp_kses_data($input['iced_mocha_slidertitle1']);
	$input['iced_mocha_slidertext1'] =  wp_kses_post($input['iced_mocha_slidertext1']);
	$input['iced_mocha_sliderlink1'] =  esc_url_raw($input['iced_mocha_sliderlink1']);
	$input['iced_mocha_sliderimg2'] =  wp_kses_data($input['iced_mocha_sliderimg2']);
	$input['iced_mocha_slidertitle2'] =  wp_kses_data($input['iced_mocha_slidertitle2']);
	$input['iced_mocha_slidertext2'] =  wp_kses_post($input['iced_mocha_slidertext2']);
	$input['iced_mocha_sliderlink2'] =  esc_url_raw($input['iced_mocha_sliderlink2']);
	$input['iced_mocha_sliderimg3'] =  wp_kses_data($input['iced_mocha_sliderimg3']);
	$input['iced_mocha_slidertitle3'] =  wp_kses_data($input['iced_mocha_slidertitle3']);
	$input['iced_mocha_slidertext3'] =  wp_kses_post($input['iced_mocha_slidertext3']);
	$input['iced_mocha_sliderlink3'] =  esc_url_raw($input['iced_mocha_sliderlink3']);
	$input['iced_mocha_sliderimg4'] =  wp_kses_data($input['iced_mocha_sliderimg4']);
	$input['iced_mocha_slidertitle4'] =  wp_kses_data($input['iced_mocha_slidertitle4']);
	$input['iced_mocha_slidertext4'] =  wp_kses_post($input['iced_mocha_slidertext4']);
	$input['iced_mocha_sliderlink4'] =  esc_url_raw($input['iced_mocha_sliderlink4']);
	$input['iced_mocha_sliderimg5'] =  wp_kses_data($input['iced_mocha_sliderimg5']);
	$input['iced_mocha_slidertitle5'] =  wp_kses_data($input['iced_mocha_slidertitle5']);
	$input['iced_mocha_slidertext5'] =  wp_kses_post($input['iced_mocha_slidertext5']);
	$input['iced_mocha_sliderlink5'] =  esc_url_raw($input['iced_mocha_sliderlink5']);
	
	$input['iced_mocha_columnNumber'] = intval(wp_kses_data($input['iced_mocha_columnNumber']));
	$input['iced_mocha_nrcolumns'] = intval(wp_kses_data($input['iced_mocha_nrcolumns']));
	$input['iced_mocha_colimageheight'] = intval(wp_kses_data($input['iced_mocha_colimageheight']));
	
/** 4 **/
	$input['iced_mocha_columnimg1'] =  wp_kses_data($input['iced_mocha_columnimg1']);
	$input['iced_mocha_columntitle1'] =  wp_kses_data($input['iced_mocha_columntitle1']);
	$input['iced_mocha_columntext1'] =  wp_kses_post($input['iced_mocha_columntext1']);
	$input['iced_mocha_columnlink1'] =  esc_url_raw($input['iced_mocha_columnlink1']);
	$input['iced_mocha_columnimg2'] =  wp_kses_data($input['iced_mocha_columnimg2']);
	$input['iced_mocha_columntitle2'] =  wp_kses_data($input['iced_mocha_columntitle2']);
	$input['iced_mocha_columntext2'] =  wp_kses_post($input['iced_mocha_columntext2']);
	$input['iced_mocha_columnlink2'] =  esc_url_raw($input['iced_mocha_columnlink2']);
	$input['iced_mocha_columnimg3'] =  wp_kses_data($input['iced_mocha_columnimg3']);
	$input['iced_mocha_columntitle3'] =  wp_kses_data($input['iced_mocha_columntitle3']);
	$input['iced_mocha_columntext3'] =  wp_kses_post($input['iced_mocha_columntext3']);
	$input['iced_mocha_columnlink3'] =  esc_url_raw($input['iced_mocha_columnlink3']);
	$input['iced_mocha_columnimg4'] =  wp_kses_data($input['iced_mocha_columnimg4']);
	$input['iced_mocha_columntitle4'] =  wp_kses_data($input['iced_mocha_columntitle4']);
	$input['iced_mocha_columntext4'] =  wp_kses_post($input['iced_mocha_columntext4']);
	$input['iced_mocha_columnlink4'] =  esc_url_raw($input['iced_mocha_columnlink4']);

	$input['iced_mocha_columnreadmore'] =  wp_kses($input['iced_mocha_columnreadmore'],'');

	$input['iced_mocha_fronttext1'] =  trim( wp_kses_post($input['iced_mocha_fronttext1']));
	$input['iced_mocha_fronttext2'] =  trim( wp_kses_post($input['iced_mocha_fronttext2']));
	$input['iced_mocha_fronttext3'] = trim( wp_kses_post($input['iced_mocha_fronttext3']));
	$input['iced_mocha_fronttext4'] = trim (wp_kses_post($input['iced_mocha_fronttext4']));
	
	$input['iced_mocha_postboxes'] = wp_kses_post($input['iced_mocha_postboxes']);

	$resetDefault = ( ! empty( $input['iced_mocha_defaults']) ? true : false );


	if ($resetDefault) { $input = $iced_mocha_defaults; }
endif;

	return $input; // return validated input

}

endif;
?>