<?php
////////// MASTER CUSTOM STYLE FUNCTION //////////

function iced_mocha_body_classes($classes) {
	$iced_mochas= iced_mocha_get_theme_options();
	$classes[] = $iced_mochas['iced_mocha_image_style'];
	$classes[] = $iced_mochas['iced_mocha_caption'];

	if ($iced_mochas['iced_mocha_magazinelayout'] == "Enable" || (is_front_page() && $iced_mochas['iced_mocha_frontpage'] == "Enable" && $iced_mochas['iced_mocha_frontpostsperrow'] == '2') ) { $classes[] = 'magazine-layout'; }
	if (is_front_page() && $iced_mochas['iced_mocha_frontpage'] == "Enable") {$classes[] = 'presentation-page';$classes[]= 'coldisplay'.$iced_mochas['iced_mocha_coldisplay']; }
	return $classes;
}
add_filter('body_class','iced_mocha_body_classes');

function iced_mocha_custom_styles() {
	$iced_mochas= iced_mocha_get_theme_options();
	foreach ($iced_mochas as $key => $value) { ${"$key"} = is_array( $value ) ? $value : esc_attr($value); }
	$totalwidth= $iced_mocha_sidewidth+$iced_mocha_sidebar;
	$contentSize = $iced_mocha_sidewidth;
	$sidebarSize= $iced_mocha_sidebar;
	ob_start();

?>
<style type="text/css">
<?php
////////// LAYOUT DIMENSIONS. //////////
?>
#header, #access, #branding, #main, #topbar-inner { width: <?php echo ($totalwidth); ?>px; }
#header, #main, #topbar-inner { <?php echo (($iced_mocha_mobile == 'Enable') ? 'max-' : '');?> width: <?php echo ($totalwidth); ?>px; }
#header-full, #footer { min-width: <?php echo ($totalwidth); ?>px; }
<?php
////////// COLUMNS //////////

$colPadding = 30;
$contentSize = $contentSize - 60;

?>
#container.one-column { }
#container.two-columns-right #secondary { width:<?php echo $sidebarSize; ?>px; float:right; }
#container.two-columns-right #content { width:<?php echo $contentSize-$colPadding; ?>px; float:left; } /*fallback*/
#container.two-columns-right #content { width:calc(100% - <?php echo $sidebarSize+$colPadding; ?>px); float:left; }
#container.two-columns-left #primary { width:<?php echo $sidebarSize; ?>px; float:left; }
#container.two-columns-left #content { width:<?php echo $contentSize-$colPadding; ?>px; float:right; } /*fallback*/
#container.two-columns-left #content { 	width:-moz-calc(100% - <?php echo $sidebarSize+$colPadding; ?>px); float:right; 
										width:-webkit-calc(100% - <?php echo $sidebarSize+$colPadding; ?>px); 
										width:calc(100% - <?php echo $sidebarSize+$colPadding; ?>px); }

#container.three-columns-right .sidey { width:<?php echo $sidebarSize/2; ?>px; float:left; }
#container.three-columns-right #primary { margin-left:<?php echo $colPadding; ?>px; margin-right:<?php echo $colPadding; ?>px; }
#container.three-columns-right #content { width:<?php echo $contentSize-$colPadding*2; ?>px; float:left; } /*fallback*/
#container.three-columns-right #content { 	width:-moz-calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px); float:left;
											width:-webkit-calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px);
											width:calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px);}
											
#container.three-columns-left .sidey { width:<?php echo $sidebarSize/2; ?>px; float:left; }
#container.three-columns-left #secondary {margin-left:<?php echo $colPadding; ?>px; margin-right:<?php echo $colPadding; ?>px; }
#container.three-columns-left #content { width:<?php echo $contentSize-$colPadding*2; ?>px; float:right;} /*fallback*/
#container.three-columns-left #content { width:-moz-calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px); float:right;
										 width:-webkit-calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px);
										 width:calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px); }

#container.three-columns-sided .sidey { width:<?php echo $sidebarSize/2; ?>px; float:left; }
#container.three-columns-sided #secondary { float:right; }
#container.three-columns-sided #content { width:<?php echo $contentSize-$colPadding*2; ?>px; float:right; /*fallback*/
										  width:-moz-calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px); float:right;
										  width:-webkit-calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px); float:right;
										  width:calc(100% - <?php echo $sidebarSize+$colPadding*2; ?>px); float:right;
		                                  margin: 0 <?php echo ($sidebarSize/2)+$colPadding;?>px 0 <?php echo -($contentSize+$sidebarSize); ?>px; }

#footer-widget-area {width:<?php echo $totalwidth-60; ?>px;}
<?php
////////// FONTS //////////
$iced_mocha_googlefont = str_replace('+',' ',preg_replace('/[:&].*/','',$iced_mocha_googlefont));
$iced_mocha_googlefonttitle = str_replace('+',' ',preg_replace('/[:&].*/','',$iced_mocha_googlefonttitle));
$iced_mocha_googlefontside = str_replace('+',' ',preg_replace('/[:&].*/','',$iced_mocha_googlefontside));
$iced_mocha_headingsgooglefont = str_replace('+',' ',preg_replace('/[:&].*/','',$iced_mocha_headingsgooglefont));
$iced_mocha_sitetitlegooglefont = str_replace('+',' ',preg_replace('/[:&].*/','',$iced_mocha_sitetitlegooglefont));
$iced_mocha_menugooglefont = str_replace('+',' ',preg_replace('/[:&].*/','',$iced_mocha_menugooglefont));
?>
body { font-family: <?php echo ((!$iced_mocha_googlefont)?$iced_mocha_fontfamily:"\"$iced_mocha_googlefont\""); ?>; }
#content h1.entry-title a, #content h2.entry-title a, #content h1.entry-title , #content h2.entry-title {
		font-family: <?php echo ((!$iced_mocha_googlefonttitle)?(($iced_mocha_fonttitle == 'General Font')?'inherit':$iced_mocha_fonttitle):"\"$iced_mocha_googlefonttitle\""); ?>; }
.widget-title, .widget-title a { line-height: normal;
		font-family: <?php echo ((!$iced_mocha_googlefontside)?(($iced_mocha_fontside == 'General Font')?'inherit':$iced_mocha_fontside):"\"$iced_mocha_googlefontside\"");  ?>;  }
.entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, #comments #reply-title,
.nivo-caption h2, #front-text1 h1, #front-text2 h1, .column-header-image  {
		font-family: <?php echo ((!$iced_mocha_headingsgooglefont)?(($iced_mocha_headingsfont == 'General Font')?'inherit':$iced_mocha_headingsfont):"\"$iced_mocha_headingsgooglefont\"");  ?>; }
#site-title span a {
		font-family: <?php echo ((!$iced_mocha_sitetitlegooglefont)?(($iced_mocha_sitetitlefont == 'General Font')?'inherit':$iced_mocha_sitetitlefont):"\"$iced_mocha_sitetitlegooglefont\"");  ?>; }
#access ul li a, #access ul li a span {
		font-family: <?php echo ((!$iced_mocha_menugooglefont)?(($iced_mocha_menufont == 'General Font')?'inherit':$iced_mocha_menufont):"\"$iced_mocha_menugooglefont\"");  ?>; }

<?php
////////// COLORS //////////
?>
body { color: <?php echo $iced_mocha_contentcolortxt; ?>; background-color: <?php echo $iced_mocha_backcolormain; ?> }
a { color: <?php echo $iced_mocha_linkcolortext; ?>; }
a:hover,.entry-meta span a:hover, .comments-link a:hover { color: <?php echo $iced_mocha_linkcolorhover; ?>; }
#header-full { background-color: <?php echo $iced_mocha_backcolorheader; ?>; }
#site-title span a { color:<?php echo $iced_mocha_titlecolor; ?>; }
#site-description { color:<?php echo $iced_mocha_descriptioncolor; ?>; <?php if(espresso_theme_hex2rgb($iced_mocha_descriptionbg)): ?>background-color: rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_descriptionbg); ?>,0.3); padding-left: 6px; <?php endif; ?>}

.socials a { background-color: <?php echo $iced_mocha_socialcolorbg; ?>; } 
.socials-hover { background-color: <?php echo $iced_mocha_socialcolorbghover; ?>; }
/* Main menu top level */
#access a, #nav-toggle span { color: <?php echo $iced_mocha_menucolortxtdefault; ?>; }
#access, #nav-toggle {background-color: <?php echo $iced_mocha_menucolorbgdefault; ?>; }
#access > .menu > ul > li > a > span { border-color: <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
-moz-box-shadow: 1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'24');?>; 
-webkit-box-shadow: 1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'24');?>; 
box-shadow: 1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'24');?>; }
#access a:hover {background-color: <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'13');?>; }
#access ul li.current_page_item > a, #access ul li.current-menu-item > a,
#access ul li.current_page_ancestor > a, #access ul li.current-menu-ancestor > a {
       background-color: <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'13');?>; }
/* Main menu Submenus */
#access > .menu > ul > li > ul:before {border-bottom-color:<?php echo $iced_mocha_submenucolorbgdefault; ?>;}
#access ul ul ul:before { border-right-color:<?php echo $iced_mocha_submenucolorbgdefault; ?>;}
#access ul ul li {
background-color:<?php echo $iced_mocha_submenucolorbgdefault; ?>;
border-top-color:<?php echo espresso_theme_hexadder($iced_mocha_submenucolorbgdefault,'14');?>;
border-bottom-color:<?php echo espresso_theme_hexadder($iced_mocha_submenucolorbgdefault,'-11');?>
}
#access ul ul li a{color:<?php echo $iced_mocha_submenucolortxtdefault; ?>}
#access ul ul li a:hover{background:<?php echo espresso_theme_hexadder($iced_mocha_submenucolorbgdefault,'14');?>}
#access ul ul li.current_page_item > a, #access ul ul li.current-menu-item > a,
#access ul ul li.current_page_ancestor > a, #access ul ul li.current-menu-ancestor > a  {
background-color:<?php echo espresso_theme_hexadder($iced_mocha_submenucolorbgdefault,'14');?>; }

<?php if (espresso_theme_hex2rgb($iced_mocha_submenucolorshadow)): ?>
	#access ul ul { box-shadow: 3px 3px 0 rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_submenucolorshadow); ?>,0.3); }
<?php endif; ?>


#access ul ul li a{color:<?php echo $iced_mocha_submenucolortxtdefault; ?>}
#access ul ul li a:hover{background:<?php echo espresso_theme_hexadder($iced_mocha_submenucolorbgdefault,'14');?>}
#access ul ul li.current_page_item > a, #access ul ul li.current-menu-item > a {
background-color:<?php echo espresso_theme_hexadder($iced_mocha_submenucolorbgdefault,'14');?>; }
<?php if (espresso_theme_hex2rgb($iced_mocha_submenucolorshadow)): ?>#access ul ul { box-shadow: 3px 3px 0 rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_submenucolorshadow); ?>,0.3); }<?php endif; ?>

#topbar {
<?php if ($iced_mocha_topbar == 'Hide'){ ?> display:none; <?php } 
else { ?>
	background-color:  <?php echo $iced_mocha_topbarcolorbg; ?>;border-bottom-color:<?php echo espresso_theme_hexadder($iced_mocha_topbarcolorbg,'40');?>;
	box-shadow:3px 0 3px <?php echo espresso_theme_hexadder($iced_mocha_topbarcolorbg,'-40');?>; 
	<?php if ($iced_mocha_topbar == 'Fixed'): ?>
		position:fixed;top:0;z-index:252;opacity:0.8;
	<?php endif; 
}?>
}
<?php if ($iced_mocha_topbar == 'Fixed') {?> #header-full {margin-top:30px;} <?php } ?>
<?php if ($iced_mocha_topbarwidth == 'Full width'){ ?> #topbar-inner {width:95%;} <?php } ?>
.topmenu ul li a { color: <?php echo $iced_mocha_topmenucolortxt; ?>; }
.topmenu ul li a:hover { color: <?php echo $iced_mocha_topmenucolortxthover; ?>; border-bottom-color: <?php echo $iced_mocha_accentcolora; ?>; }

#main { background-color: <?php echo $iced_mocha_contentcolorbg; ?>; }	
#author-info, #entry-author-info, .page-title { border-color: <?php echo $iced_mocha_accentcolora; ?>; background: <?php echo $iced_mocha_accentcolore; ?>; }
#entry-author-info #author-avatar, #author-info #author-avatar { border-color: <?php echo $iced_mocha_accentcolorc; ?>; }

.sidey .widget-container { color: <?php echo $iced_mocha_sidetxt; ?>; background-color: <?php echo $iced_mocha_sidebg; ?>; }
.sidey .widget-title { color: <?php echo $iced_mocha_sidetitletxt; ?>; background-color: <?php echo $iced_mocha_sidetitlebg; ?>;border-color:<?php echo espresso_theme_hexadder($iced_mocha_sidetitlebg,'-40');?>;}
.sidey .widget-container a {color:<?php echo $iced_mocha_linkcolorside;?>;}
.sidey .widget-container a:hover {color:<?php echo $iced_mocha_linkcolorsidehover;?>;}

.entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6 {
     color: <?php echo $iced_mocha_contentcolortxtheadings; ?>; }
 .sticky .entry-header {border-color:<?php echo $iced_mocha_accentcolora; ?> }
.entry-title, .entry-title a { color: <?php echo $iced_mocha_contentcolortxttitle; ?>; }
.entry-title a:hover { color: <?php echo $iced_mocha_contentcolortxttitlehover; ?>; }
#content h3.entry-format { color: <?php echo $iced_mocha_menucolortxtdefault; ?>; background-color: <?php echo $iced_mocha_menucolorbgdefault; ?>; }

#footer { color: <?php echo $iced_mocha_footercolortxt; ?>; background-color: <?php echo $iced_mocha_backcolorfooterw; ?>; }
#footer2 { color: <?php echo $iced_mocha_footercolortxt; ?>; background-color: <?php echo $iced_mocha_backcolorfooter; ?>;  }
#footer a { color: <?php echo $iced_mocha_linkcolorwooter; ?>; }
#footer a:hover { color: <?php echo $iced_mocha_linkcolorwooterhover; ?>; }
#footer2 a, .footermenu ul li:after  { color: <?php echo $iced_mocha_linkcolorfooter; ?>; }
#footer2 a:hover { color: <?php echo $iced_mocha_linkcolorfooterhover; ?>; }
#footer .widget-container { color: <?php echo $iced_mocha_widgettxt; ?>; background-color: <?php echo $iced_mocha_widgetbg; ?>; }
#footer .widget-title { color: <?php echo $iced_mocha_widgettitletxt; ?>; background-color: <?php echo $iced_mocha_widgettitlebg; ?>;border-color:<?php echo espresso_theme_hexadder($iced_mocha_widgettitlebg,'-40');?> }

a.continue-reading-link { color:<?php echo $iced_mocha_menucolortxtdefault; ?> !important; background:<?php echo $iced_mocha_menucolorbgdefault; ?>; border-bottom-color:<?php echo $iced_mocha_accentcolora; ?>; }
a.continue-reading-link:after { background-color:<?php echo $iced_mocha_accentcolorb; ?>; }
a.continue-reading-link i.icon-right-dir {color:<?php echo $iced_mocha_accentcolora; ?>}
a.continue-reading-link:hover i.icon-right-dir {color:<?php echo $iced_mocha_accentcolorb; ?>}
.page-link a, .page-link > span > em {border-color:<?php echo $iced_mocha_accentcolord;?>}

.columnmore a {background:<?php echo $iced_mocha_accentcolorb;?>;color:<?php echo $iced_mocha_accentcolore; ?>}
.columnmore a:hover {background:<?php echo $iced_mocha_accentcolora;?>;}

.file, .button, #respond .form-submit input#submit, input[type=submit], input[type=reset] {
	background-color: <?php echo $iced_mocha_contentcolorbg; ?>;
	border-color: <?php echo $iced_mocha_accentcolord; ?>;
    box-shadow: 0 -10px 10px 0 <?php echo $iced_mocha_accentcolore; ?> inset; }
.file:hover, .button:hover, #respond .form-submit input#submit:hover {
	background-color: <?php echo $iced_mocha_accentcolore; ?>; }
.entry-content tr th, .entry-content thead th {
	color: <?php echo $iced_mocha_contentcolortxtheadings; ?>; }
.entry-content fieldset, #content tr td,#content tr th,#content thead th { border-color: <?php echo $iced_mocha_accentcolord; ?>; }
 #content tr.even td { background-color: <?php echo $iced_mocha_accentcolore; ?> !important; }
hr { background-color: <?php echo $iced_mocha_accentcolord; ?>; }
input[type="text"], input[type="password"], input[type="email"], input[type="file"], textarea, select,
input[type="color"],input[type="date"],input[type="datetime"],input[type="datetime-local"],input[type="month"],input[type="number"],input[type="range"],
input[type="search"],input[type="tel"],input[type="time"],input[type="url"],input[type="week"] {
	background-color: <?php echo $iced_mocha_accentcolore; ?>;
    border-color: <?php echo $iced_mocha_accentcolord; ?> <?php echo $iced_mocha_accentcolorc; ?> <?php echo $iced_mocha_accentcolorc; ?> <?php echo $iced_mocha_accentcolord; ?>;
	color: <?php echo $iced_mocha_contentcolortxt; ?>; }
input[type="submit"], input[type="reset"] {
	color: <?php echo $iced_mocha_contentcolortxt; ?>;
	background-color: <?php echo $iced_mocha_contentcolorbg; ?>;
	border-color: <?php echo $iced_mocha_accentcolord; ?>;
	box-shadow: 0 -10px 10px 0 <?php echo $iced_mocha_accentcolore; ?> inset; }
input[type="text"]:hover, input[type="password"]:hover, input[type="email"]:hover, textarea:hover,
input[type="color"]:hover, input[type="date"]:hover, input[type="datetime"]:hover, input[type="datetime-local"]:hover, input[type="month"]:hover, input[type="number"]:hover, input[type="range"]:hover,
input[type="search"]:hover, input[type="tel"]:hover, input[type="time"]:hover, input[type="url"]:hover, input[type="week"]:hover {
	<?php if(espresso_theme_hex2rgb($iced_mocha_accentcolore)): ?>background-color: rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_accentcolore); ?>,0.4); <?php endif; ?> }
.entry-content code {
	border-color: <?php echo $iced_mocha_accentcolord; ?>;
	border-bottom-color:<?php echo $iced_mocha_accentcolora ;?>;}
.entry-content pre { border-color: <?php echo $iced_mocha_accentcolord; ?>;
	background-color:<?php echo $iced_mocha_accentcolore; ?>;}
.entry-content blockquote {
	border-color: <?php echo $iced_mocha_accentcolorc; ?>; }
abbr, acronym { border-color: <?php echo $iced_mocha_contentcolortxt; ?>; }
.comment-meta a { color: <?php echo $iced_mocha_contentcolortxt; ?>; }
#respond .form-allowed-tags { color: <?php echo $iced_mocha_contentcolortxtlight; ?>; }
.reply a{ background-color: <?php echo $iced_mocha_accentcolore; ?>; border-color: <?php echo $iced_mocha_accentcolorc; ?>; }
.reply a:hover { background-color: <?php echo $iced_mocha_menucolorbgdefault; ?>;color: <?php echo $iced_mocha_linkcolortext; ?>; }

.entry-meta .icon-metas:before {color:<?php echo $iced_mocha_metacoloricons; ?>;}
.entry-meta span a, .comments-link a {color:<?php echo $iced_mocha_metacolorlinks; ?>;}
.entry-meta span a:hover, .comments-link a:hover {color:<?php echo $iced_mocha_metacolorlinkshover; ?>;}

.nav-next a:hover {}
.nav-previous a:hover {
}
.pagination { border-color:<?php echo espresso_theme_hexadder($iced_mocha_accentcolore,'-10');?>;}
.pagination span, .pagination a { 
	background:<?php echo $iced_mocha_accentcolore;?>;
	border-left-color:<?php echo espresso_theme_hexadder($iced_mocha_accentcolore,'-26'); ?>;
	border-right-color:<?php echo espresso_theme_hexadder($iced_mocha_accentcolore,'16'); ?>;
}
.pagination a:hover { background: <?php echo espresso_theme_hexadder($iced_mocha_accentcolore,'8'); ?>; }

#searchform input[type="text"] {color:<?php echo $iced_mocha_contentcolortxtlight; ?>;}

.caption-accented .wp-caption {<?php if(espresso_theme_hex2rgb($iced_mocha_accentcolora)):?> background-color:rgba(<?php echo espresso_theme_hex2rgb($iced_mocha_accentcolora);?>,0.8); <?php endif; ?>
	color:<?php echo $iced_mocha_contentcolorbg;?>}

.iced_mocha-image-one .entry-content img[class*='align'],.iced_mocha-image-one .entry-summary img[class*='align'],
.iced_mocha-image-two .entry-content img[class*='align'],.iced_mocha-image-two .entry-summary img[class*='align'] {
	border-color:<?php echo $iced_mocha_accentcolora; ?>;} 
<?php
////////// LAYOUT //////////
?>
#content p, #content ul, #content ol, #content, #frontpage blockquote { text-align:<?php echo $iced_mocha_textalign;  ?> ; }
#content p, #content ul, #content ol, .widget-area, .widget-area a, table, table td {
                                font-size:<?php echo $iced_mocha_fontsize ?>;
								word-spacing:<?php echo $iced_mocha_wordspace ?>; letter-spacing:<?php echo $iced_mocha_letterspace ?>; }
#content p, #content ul, #content ol, .widget-area, .widget-area a { line-height:<?php echo $iced_mocha_lineheight ?>; } 
<?php if ($iced_mocha_uppercasetext==1): ?> #site-title a, #site-description, #access a, .topmenu ul li a, .footermenu a, .entry-meta span a, .entry-utility span a, #content h3.entry-format,
span.edit-link, h3#comments-title, h3#reply-title, .comment-author cite, .reply a, .widget-title, #site-info a, .nivo-caption h2, a.continue-reading-link,
.column-image h3, #front-columns h3.column-header-noimage, .tinynav , .entry-title, .breadcrumbs, .page-link{ text-transform: uppercase; }<?php endif; ?>
<?php if ($iced_mocha_hcenter): ?> #bg_image {display:block;margin:0 auto;} <?php endif; ?>
#content h1.entry-title, #content h2.entry-title { font-size:<?php echo $iced_mocha_headfontsize; ?> ;}
.widget-title, .widget-title a { font-size:<?php echo $iced_mocha_sidefontsize; ?> ;} 
<?php $font_root = 36;
for($i=1;$i<=6;$i++):
	echo "#content .entry-content h$i { font-size: ";
	echo round(($font_root-(4*$i))*(preg_replace("/[^\d]/","",$iced_mocha_headingsfontsize)/100),0);
	echo "px;} ";
endfor; ?>
#site-title span a { font-size:<?php echo $iced_mocha_sitetitlesize; ?> ;}
#access ul li a { font-size:<?php echo $iced_mocha_menufontsize; ?> ;}
#access ul ul ul a {font-size:<?php echo (absint($iced_mocha_menufontsize)-2); ?>px;}
<?php /*if ($iced_mocha_postseparator == "Show") { ?> article.post, article.page { padding-bottom: 10px; border-bottom: 3px solid #EEE; } <?php }*/ ?>
<?php if ($iced_mocha_contentlist == "Hide") { ?> #content ul li { background-image: none; padding-left: 0; } <?php } ?>
<?php if ($iced_mocha_comtext == "Hide") { ?> #respond .form-allowed-tags { display:none;} <?php } ?>
<?php switch ($iced_mocha_comclosed) {
	case "Hide in posts": ?> .nocomments { display:none;} <?php break;
	case "Hide in pages": ?> .nocomments2 {display:none;} <?php break;
	case "Hide everywhere": ?> .nocomments, .nocomments2 {display:none;} <?php break;
};//switch ?>
<?php if ($iced_mocha_comoff == "Hide") { ?> .comments-link span { display:none;} <?php } ?>
<?php if ($iced_mocha_tables == "Enable") { ?>
		#content table {border:none;} #content tr {background:none;} #content table {border:none;}
		#content tr th, #content thead th {background:none;} #content tr th, #content tr td {border:none;}
<?php } ?>
<?php if ($iced_mocha_headingsindent == "Enable") { ?>
		#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { margin-left:20px;}
		.sticky hgroup { padding-left: 15px;}
<?php } ?>
#header-container > div { margin:<?php echo $iced_mocha_headermargintop; ?>px 0 0 <?php echo $iced_mocha_headermarginleft; ?>px;}
<?php if ($iced_mocha_pagetitle == "Hide") { ?> .page h1.entry-title, .home .page h2.entry-title { display:none; } <?php } ?>
<?php if ($iced_mocha_categtitle == "Hide") { ?> header.page-header, .archive h1.page-title { display:none; }  <?php } ?>
#content p, #content ul, #content ol, #content dd, #content pre, #content hr { margin-bottom: <?php echo $iced_mocha_paragraphspace;?>; }
<?php if ($iced_mocha_parindent != "0px") { ?> #content p { text-indent:<?php echo $iced_mocha_parindent;?>;} <?php } ?>

<?php if ($iced_mocha_metapos == 'Top') { ?> footer.entry-meta {background-image:none !important;padding-top:0;} <?php } ?>
	
<?php switch ($iced_mocha_menualign): 
		case "center": ?> #access > .menu > ul { display: table; margin: 0 auto; text-align: center; } 
						  #access > .menu > ul > li { display: inline-block; float: initial; }
						  #access > .menu > ul > * { text-align: initial; }
						  #access > .menu > ul { border-left: 1px solid <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'24');?>; 
										-moz-box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
										-webkit-box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
										box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; } <?php 
		break;
		case "right": ?> #access > .menu { float: right; } 
						 #access > .menu > ul > li > a > span { border-left:1px solid <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'24');?>; 
							-moz-box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
							-webkit-box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
							box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
							border-right: 0; }
						 #nav-toggle { text-align: right; }	<?php
		break;
		case "rightmulti": ?> #access ul li { float: right; } 
						 #access > .menu > ul > li > a > span { border-left:1px solid <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'24');?>; 
							-moz-box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
							-webkit-box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>; 
							box-shadow: -1px 0 0 <?php echo espresso_theme_hexadder($iced_mocha_menucolorbgdefault,'-30');?>;
							border-right:0;	}
						 #nav-toggle { text-align: right; }
		<?php break;
		default: ?>
				#nav-toggle { text-align: left; } <?php
		break; 
	  endswitch; ?>
#toTop {background:<?php echo $iced_mocha_contentcolorbg; ?>;margin-left:<?php echo $totalwidth+150 ?>px;} 		  
<?php if (is_rtl() ) { ?> #toTop {margin-right:<?php echo $totalwidth+150 ?>px;-moz-border-radius:10px 0 0 10px;-webkit-border-radius:10px 0 0 10px;border-radius:10px 0 0 10px;}		<?php } ?>	
#toTop:hover .icon-back2top:before {color:<?php echo $iced_mocha_accentcolorb;?>;}  

#main {margin-top:<?php echo $iced_mocha_contentmargintop;?>px; }
#forbottom {margin-left: <?php echo $iced_mocha_contentpadding;?>px; margin-right: <?php echo $iced_mocha_contentpadding;?>px;}
#header-widget-area { width: <?php echo $iced_mocha_headerwidgetwidth; ?>; }
<?php
////////// HEADER IMAGE //////////
?>
#branding { height:<?php echo HEADER_IMAGE_HEIGHT; ?>px; }
<?php if ($iced_mocha_hratio) { ?> @media (max-width: 1920px) {#branding, #bg_image { height:auto; max-width:100%; min-height:inherit !important; } } <?php } ?>
</style>
<?php
	$iced_mocha_custom_styling = ob_get_contents();
	ob_end_clean();
	return $iced_mocha_custom_styling;
} // iced_mocha_custom_styles()

// Iced Mocha Theme function for inserting the Custom CSS into the header
function iced_mocha_customcss() {
	$iced_mochas= iced_mocha_get_theme_options();
	foreach ($iced_mochas as $key => $value) { ${"$key"} = is_array( $value ) ? $value : esc_attr($value); }
	if ($iced_mocha_customcss != "") {
		echo '<style type="text/css">'.htmlspecialchars_decode($iced_mocha_customcss, ENT_QUOTES).'</style>';
	}
} // iced_mocha_customcss()

// Iced Mocha Theme function for inseting the Custom JS into the header
function iced_mocha_customjs() {
	$iced_mochas= iced_mocha_get_theme_options();
	foreach ($iced_mochas as $key => $value) { ${"$key"} = is_array( $value ) ? $value : esc_attr($value); }
	echo '<script type="text/javascript">';
	echo 'var espresso_theme_global_content_width = '.$iced_mocha_sidewidth.';';
	echo 'var espresso_theme_toTop_offset = '.($iced_mocha_sidewidth+$iced_mocha_sidebar).';' ;
	if (is_rtl())  echo 'var espresso_theme_toTop_offset =  '.($iced_mocha_sidewidth+$iced_mocha_sidebar).';';
	if ($iced_mocha_customjs != "") {
		echo PHP_EOL.htmlspecialchars_decode($iced_mocha_customjs, ENT_QUOTES);
	}
	echo '</script>';
} // iced_mocha_customjs()

////////// FIN //////////
