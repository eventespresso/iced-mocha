<?php
/**
 * Frontpage helper functions
 * Creates the custom css for the presentation page
 *
 * @package iced_mocha
 * @subpackage Functions
 */
 

function iced_mocha_presentation_css() {
	$iced_mochas= iced_mocha_get_theme_options();
	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }
	ob_start();
	echo '<style type="text/css">';
	if ($iced_mocha_fronthideheader) {?> #branding {display: none;} <?php }
	if ($iced_mocha_fronthidemenu) {?> #access, .topmenu {display: none;} <?php }
  	if ($iced_mocha_fronthidewidget) {?> #colophon {display: none;} <?php }
	if ($iced_mocha_fronthidefooter) {?> #footer2 {display: none;} <?php }
    if ($iced_mocha_fronthideback) {?> #main {background: none;} <?php }
	
	if ($iced_mocha_fpslider_topmargin) { ?> .slider-wrapper {padding-top: <?php echo $iced_mocha_fpslider_topmargin; ?>px;} <?php }
?>

.slider-wrapper {
	width: <?php echo ($iced_mocha_fpsliderwidth) ?>px ;
	max-height: <?php echo $iced_mocha_fpsliderheight ?>px ;
	}
.slider-shadow {
	/* width: <?php echo ($iced_mocha_fpsliderwidth) ?>px ; */
	}
#slider{
	width: <?php echo ($iced_mocha_fpsliderwidth) ?>px ;
	max-height: <?php echo $iced_mocha_fpsliderheight ?>px ;
<?php if ($iced_mocha_fpslider_bordersize): ?> border:<?php echo $iced_mocha_fpslider_bordersize ;?>px solid <?php echo $iced_mocha_fpsliderbordercolor; ?>; <?php endif; ?> }
.theme-default .nivo-controlNav {top:-<?php echo $iced_mocha_fpslider_bordersize+33 ?>px;}

#front-text1 h1, #front-text2 h1{
	color: <?php echo $iced_mocha_fronttitlecolor; ?>; }

#front-columns > div {
	width: <?php switch ($iced_mocha_nrcolumns) {
    case 0: break;
	case 1: echo "100"; break;
    case 2: echo "47.5"; break;
    case 3: echo "30"; break;
    case 4: echo "21.2"; break;
	} ?>%; }

#front-columns > div.column<?php echo $iced_mocha_nrcolumns; ?> { margin-right: 0; }

.column-image img {	height:<?php echo ($iced_mocha_colimageheight) ?>px;}

.nivo-caption { background-color: rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_fpslidercaptionbg); ?>,0.7); }
.nivo-caption, .nivo-caption a { color: <?php echo $iced_mocha_fpslidercaptioncolor; ?>; }
.theme-default .nivo-controlNav, .theme-default .nivo-directionNav a { background-color:<?php echo $iced_mocha_fpsliderbordercolor; ?>; }
.slider-bullets .nivo-controlNav a { background-color: <?php echo $iced_mocha_sidetitlebg; ?>; }
.slider-bullets .nivo-controlNav a:hover { background-color: <?php echo $iced_mocha_menucolorbgdefault; ?>; }
.slider-bullets .nivo-controlNav a.active {background-color: <?php echo $iced_mocha_accentcolora; ?>; }
.slider-numbers .nivo-controlNav a { color:<?php echo $iced_mocha_fpslidercaptioncolor; ?>;background-color:<?php echo $iced_mocha_fpslidercaptionbg;?>;}
.slider-numbers .nivo-controlNav a:hover { color: <?php echo $iced_mocha_accentcolora; ?>; }
.slider-numbers .nivo-controlNav a.active { color:<?php echo $iced_mocha_accentcolora; ?>;}


.column-image h3{ color: <?php echo $iced_mocha_contentcolortxt; ?>; background-color: rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_contentcolorbg); ?>,0.6); }
.columnmore { background-color: <?php echo $iced_mocha_backcolormain; ?>; }
#front-columns h3.column-header-noimage { background: <?php echo $iced_mocha_contentcolorbg;?>; }

<?php
	echo '</style>';
	$iced_mocha_presentation_page_styling = ob_get_contents();
	ob_end_clean();
	return $iced_mocha_presentation_page_styling;
} // iced_mocha_presentation_css()

?>