<?php
// Loading files for frontend

// Loading Default values
require_once(dirname(__FILE__) . "/defaults.php");
require_once(dirname(__FILE__) . "/prototypes.php");
// Loading function that generates the custom css
require_once(dirname(dirname(__FILE__)) . "/includes/custom-styles.php");

// Loading the admin files

if( is_admin() ) {
// Loading the settings arrays
require_once(dirname(__FILE__) . "/settings.php");
// Loading the callback functions
require_once(dirname(__FILE__) . "/admin-functions.php");
// Loading the sanitize funcions
require_once(dirname(__FILE__) . "/sanitize.php");
// Loading color scheme presets
include(dirname(__FILE__) . "/schemes.php");
}

// Getting the theme options and making sure defaults are used if no values are set
function iced_mocha_get_theme_options() {
	global $iced_mocha_defaults;
	$optionsiced_mocha_Theme = get_option( 'iced_mocha_settings', $iced_mocha_defaults );
	$optionsiced_mocha_Theme = array_merge((array)$iced_mocha_defaults, (array)$optionsiced_mocha_Theme);
	$optionsiced_mocha_Theme['id'] = "iced_mocha_settings";
return $optionsiced_mocha_Theme;
}

$iced_mochas= iced_mocha_get_theme_options();
foreach ($iced_mochas as $key => $value) {
     ${"$key"} = $value ;
}


//  Hooks/Filters
add_action('admin_init', 'iced_mocha_init_fn' );
add_action('admin_menu', 'iced_mocha_add_page_fn');
add_action('init', 'iced_mocha_init');


$iced_mochas= iced_mocha_get_theme_options();

// Registering and enqueuing all scripts and styles for the init hook
function iced_mocha_init() {
//Loading Iced Mocha Theme text domain into the admin section
		load_theme_textdomain( 'iced_mocha', get_template_directory_uri() . '/languages' );
}

// Creating the iced_mocha subpage
function iced_mocha_add_page_fn() {
$page = add_theme_page('Iced Mocha Theme Settings', 'Iced Mocha Theme Settings', 'edit_theme_options', 'iced_mocha-page', 'iced_mocha_page_fn');
	add_action( 'admin_print_styles-'.$page, 'iced_mocha_admin_styles' );
	add_action('admin_print_scripts-'.$page, 'iced_mocha_admin_scripts');

}

// Adding the styles for the Iced Mocha Theme admin page used when iced_mocha_add_page_fn() is launched
function iced_mocha_admin_styles() {
	wp_register_style( 'jquery-ui-style',get_template_directory_uri() . '/js/jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css' );
	wp_enqueue_style( 'jquery-ui-style' );
	wp_register_style( 'iced_mocha-admin-style',get_template_directory_uri() . '/admin/css/admin.css' );
	wp_enqueue_style( 'iced_mocha-admin-style' );
     // codemirror css markup
     wp_register_style('espresso_theme-admin-codemirror-style',get_template_directory_uri() . '/admin/css/codemirror.css' );
	wp_enqueue_style('espresso_theme-admin-codemirror-style');
}

// Adding the styles for the Iced Mocha Theme admin page used when iced_mocha_add_page_fn() is launched
function iced_mocha_admin_scripts() {
// The farbtastic color selector already included in WP
	//wp_register_script('farbtastic-wp',get_template_directory_uri() . '/admin/js/accordion-slider.js', array('jquery') );
	//wp_enqueue_script('espresso_theme_accordion');
	wp_enqueue_script('farbtastic');
	wp_enqueue_style( 'farbtastic' );

//Jquery accordion and slider libraries alreay included in WP
    wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-tooltip');
// For backwards compatibility where Iced Mocha Theme is installed on older versions of WP where the ui accordion and slider are not included
	if (!wp_script_is('jquery-ui-accordion',$list='registered')) {
		wp_register_script('espresso_theme_accordion',get_template_directory_uri() . '/admin/js/accordion-slider.js', array('jquery') );
		wp_enqueue_script('espresso_theme_accordion');
		}
// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
         wp_enqueue_media();
      }
      else {
         wp_enqueue_script('media-upload');
         wp_enqueue_script('thickbox');
         wp_enqueue_style('thickbox');
      }
// The js used in the admin
	wp_register_script('espresso_theme-admin-js',get_template_directory_uri() . '/admin/js/admin.js' );
	wp_enqueue_script('espresso_theme-admin-js');
// codemirror css markup
     wp_register_script('espresso_theme-admin-codemirror-js',get_template_directory_uri() . '/admin/js/codemirror.min.js' );
	wp_enqueue_script('espresso_theme-admin-codemirror-js');
}

// The settings sectoions. All the referenced functions are found in admin-functions.php
function iced_mocha_init_fn(){

	register_setting('iced_mocha_settings', 'iced_mocha_settings', 'iced_mocha_settings_validate');

/**************
   sections
**************/

	add_settings_section('layout_section', __('Layout Settings','iced_mocha'), 'espresso_theme_section_layout_fn', __FILE__);
	add_settings_section('header_section', __('Header Settings','iced_mocha'), 'espresso_theme_section_header_fn', __FILE__);
	add_settings_section('presentation_section', __('Presentation Page','iced_mocha'), 'espresso_theme_section_presentation_fn', __FILE__);
	add_settings_section('text_section', __('Text Settings','iced_mocha'), 'espresso_theme_section_text_fn', __FILE__);
	add_settings_section('appereance_section',__('Color Settings','iced_mocha') , 'espresso_theme_section_appereance_fn', __FILE__);
	add_settings_section('graphics_section', __('Content Settings','iced_mocha') , 'espresso_theme_section_graphics_fn', __FILE__);
	add_settings_section('post_section', __('Post Information Settings','iced_mocha') , 'espresso_theme_section_post_fn', __FILE__);
	add_settings_section('excerpt_section', __('Post Excerpt Settings','iced_mocha') , 'espresso_theme_section_excerpt_fn', __FILE__);
	add_settings_section('featured_section', __('Featured Image Settings','iced_mocha') , 'espresso_theme_section_featured_fn', __FILE__);
	add_settings_section('socials_section', __('Social Media Settings','iced_mocha') , 'espresso_theme_section_social_fn', __FILE__);
	add_settings_section('misc_section', __('Miscellaneous Settings','iced_mocha') , 'espresso_theme_section_misc_fn', __FILE__);

/*** layout ***/
	add_settings_field('iced_mocha_side', __('Main Layout','iced_mocha') , 'espresso_theme_setting_side_fn', __FILE__, 'layout_section');
	add_settings_field('iced_mocha_sidewidth', __('Content / Sidebar Width','iced_mocha') , 'espresso_theme_setting_sidewidth_fn', __FILE__, 'layout_section');
	add_settings_field('iced_mocha_mobile', __('Responsiveness','iced_mocha') , 'espresso_theme_setting_mobile_fn', __FILE__, 'layout_section');

/*** presentation ***/
	add_settings_field('iced_mocha_frontpage', __('Enable Presentation Page','iced_mocha') , 'espresso_theme_setting_frontpage_fn', __FILE__, 'presentation_section');
	add_settings_field('iced_mocha_frontposts', __('Show Posts on Presentation Page','iced_mocha') , 'espresso_theme_setting_frontposts_fn', __FILE__, 'presentation_section');
	add_settings_field('iced_mocha_frontevents', __('Show Events on Presentation Page','iced_mocha') , 'espresso_theme_setting_frontevents_fn', __FILE__, 'presentation_section');
	add_settings_field('iced_mocha_frontslider', __('Slider Settings','iced_mocha') , 'espresso_theme_setting_frontslider_fn', __FILE__, 'presentation_section');
	add_settings_field('iced_mocha_frontslider2', __('Slides','iced_mocha') , 'espresso_theme_setting_frontslider2_fn', __FILE__, 'presentation_section');
	add_settings_field('iced_mocha_frontcolumns', __('Presentation Page Columns','iced_mocha') , 'espresso_theme_setting_frontcolumns_fn', __FILE__, 'presentation_section');
	add_settings_field('iced_mocha_fronttext', __('Extras','iced_mocha') , 'espresso_theme_setting_fronttext_fn', __FILE__, 'presentation_section');

/*** header ***/
	add_settings_field('iced_mocha_hheight', __('Header Height','iced_mocha') , 'espresso_theme_setting_hheight_fn', __FILE__, 'header_section');
	add_settings_field('iced_mocha_himage', __('Header Image','iced_mocha') , 'espresso_theme_setting_himage_fn', __FILE__, 'header_section');
	add_settings_field('iced_mocha_siteheader', __('Site Header','iced_mocha') , 'espresso_theme_setting_siteheader_fn', __FILE__, 'header_section');
	add_settings_field('iced_mocha_logoupload', __('Custom Logo Upload','iced_mocha') , 'espresso_theme_setting_logoupload_fn', __FILE__, 'header_section');
	add_settings_field('iced_mocha_headermargin', __('Header Content Spacing','iced_mocha') , 'espresso_theme_setting_headermargin_fn', __FILE__, 'header_section');
	add_settings_field('iced_mocha_favicon', __('FavIcon Upload','iced_mocha') , 'espresso_theme_setting_favicon_fn', __FILE__, 'header_section');

/*** text ***/
	add_settings_field('iced_mocha_fontfamily', __('General Font','iced_mocha') , 'espresso_theme_setting_fontfamily_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_fonttitle', __('Post Title Font ','iced_mocha') , 'espresso_theme_setting_fonttitle_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_fontside', __('Widget Title Font','iced_mocha') , 'espresso_theme_setting_fontside_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_sitetitlefont', __('Site Title Font','iced_mocha') , 'espresso_theme_setting_sitetitlefont_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_menufont', __('Main Menu Font','iced_mocha') , 'espresso_theme_setting_menufont_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_fontheadings', __('Headings Font','iced_mocha') , 'espresso_theme_setting_fontheadings_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_textalign', __('Force Text Align','iced_mocha') , 'espresso_theme_setting_textalign_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_paragraphspace', __('Paragraph spacing','iced_mocha') , 'espresso_theme_setting_paragraphspace_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_parindent', __('Paragraph Indent','iced_mocha') , 'espresso_theme_setting_parindent_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_headingsindent', __('Headings Indent','iced_mocha') , 'espresso_theme_setting_headingsindent_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_lineheight', __('Line Height','iced_mocha') , 'espresso_theme_setting_lineheight_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_wordspace', __('Word Spacing','iced_mocha') , 'espresso_theme_setting_wordspace_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_letterspace', __('Letter Spacing','iced_mocha') , 'espresso_theme_setting_letterspace_fn', __FILE__, 'text_section');
	add_settings_field('iced_mocha_letterspace', __('Uppercase Text','iced_mocha') , 'espresso_theme_setting_uppercasetext_fn', __FILE__, 'text_section');

/*** appereance ***/

    add_settings_field('iced_mocha_sitebackground', __('Background Image','iced_mocha') , 'espresso_theme_setting_sitebackground_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_generalcolors', __('General','iced_mocha') , 'espresso_theme_setting_generalcolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_accentcolors', __('Accents','iced_mocha') , 'espresso_theme_setting_accentcolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_titlecolors', __('Site Title','iced_mocha') , 'espresso_theme_setting_titlecolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_menucolors', __('Main Menu','iced_mocha') , 'espresso_theme_setting_menucolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_topmenucolors', __('Top Bar','iced_mocha') , 'espresso_theme_setting_topmenucolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_contentcolors', __('Content','iced_mocha') , 'espresso_theme_setting_contentcolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_frontpagecolors', __('Presentation Page','iced_mocha') , 'espresso_theme_setting_frontpagecolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_sidecolors', __('Sidebar Widgets','iced_mocha') , 'espresso_theme_setting_sidecolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_widgetcolors', __('Footer Widgets','iced_mocha') , 'espresso_theme_setting_widgetcolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_linkcolors', __('Links','iced_mocha') , 'espresso_theme_setting_linkcolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_metacolors', __('Post metas','iced_mocha') , 'espresso_theme_setting_metacolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_socialcolors', __('Socials','iced_mocha') , 'espresso_theme_setting_socialcolors_fn', __FILE__, 'appereance_section');
	add_settings_field('iced_mocha_caption', __('Caption type','iced_mocha') , 'espresso_theme_setting_caption_fn', __FILE__, 'appereance_section');

/*** graphics ***/

	add_settings_field('iced_mocha_topbar', __('Top Bar','iced_mocha') , 'espresso_theme_setting_topbar_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_breadcrumbs', __('Breadcrumbs','iced_mocha') , 'espresso_theme_setting_breadcrumbs_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_pagination', __('Pagination','iced_mocha') , 'espresso_theme_setting_pagination_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_menualign', __('Menu Alignment','iced_mocha') , 'espresso_theme_setting_menualign_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_contentmargins', __('Content Margins','iced_mocha') , 'espresso_theme_setting_contentmargins_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_image', __('Post Images Border','iced_mocha') , 'espresso_theme_setting_image_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_contentlist', __('Content List Bullets','iced_mocha') , 'espresso_theme_setting_contentlist_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_pagetitle', __('Page Titles','iced_mocha') , 'espresso_theme_setting_pagetitle_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_categetitle', __('Category Titles','iced_mocha') , 'espresso_theme_setting_categtitle_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_tables', __('Hide Tables','iced_mocha') , 'espresso_theme_setting_tables_fn', __FILE__, 'graphics_section');
	add_settings_field('iced_mocha_backtop', __('Back to Top button','iced_mocha') , 'espresso_theme_setting_backtop_fn', __FILE__, 'graphics_section');

/*** post metas***/
	add_settings_field('iced_mocha_metapos', __('Meta Bar Position','iced_mocha') , 'espresso_theme_setting_metapos_fn', __FILE__, 'post_section');
	add_settings_field('iced_mocha_metashowblog', __('Show on Blog Metas','iced_mocha') , 'espresso_theme_setting_metashowblog_fn', __FILE__, 'post_section');
	add_settings_field('iced_mocha_metashowsingle', __('Show on Single Pages','iced_mocha') , 'espresso_theme_setting_metashowsingle_fn', __FILE__, 'post_section');
	add_settings_field('iced_mocha_comtext', __('Text Under Comments','iced_mocha') , 'espresso_theme_setting_comtext_fn', __FILE__, 'post_section');
	add_settings_field('iced_mocha_comclosed', __('Comments are closed text','iced_mocha') , 'espresso_theme_setting_comclosed_fn', __FILE__, 'post_section');
	add_settings_field('iced_mocha_comoff', __('Comments off','iced_mocha') , 'espresso_theme_setting_comoff_fn', __FILE__, 'post_section');

/*** post exceprts***/
	add_settings_field('iced_mocha_excerpthome', __('Home Page','iced_mocha') , 'espresso_theme_setting_excerpthome_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_excerptsticky', __('Sticky Posts','iced_mocha') , 'espresso_theme_setting_excerptsticky_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_excerptarchive', __('Archive and Category Pages','iced_mocha') , 'espresso_theme_setting_excerptarchive_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_excerptwords', __('Number of Words for Post Excerpts ','iced_mocha') , 'espresso_theme_setting_excerptwords_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_magazinelayout', __('Magazine Layout','iced_mocha') , 'espresso_theme_setting_magazinelayout_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_excerptdots', __('Excerpt suffix','iced_mocha') , 'espresso_theme_setting_excerptdots_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_excerptcont', __('Continue reading link text ','iced_mocha') , 'espresso_theme_setting_excerptcont_fn', __FILE__, 'excerpt_section');
	add_settings_field('iced_mocha_excerpttags', __('HTML tags in Excerpts','iced_mocha') , 'espresso_theme_setting_excerpttags_fn', __FILE__, 'excerpt_section');

/*** featured ***/
	add_settings_field('iced_mocha_fpost', __('Featured Images as POST Thumbnails ','iced_mocha') , 'espresso_theme_setting_fpost_fn', __FILE__, 'featured_section');
	add_settings_field('iced_mocha_fauto', __('Auto Select Images From Posts ','iced_mocha') , 'espresso_theme_setting_fauto_fn', __FILE__, 'featured_section');
	add_settings_field('iced_mocha_falign', __('Thumbnails Alignment ','iced_mocha') , 'espresso_theme_setting_falign_fn', __FILE__, 'featured_section');
	add_settings_field('iced_mocha_fsize', __('Thumbnails Size ','iced_mocha') , 'espresso_theme_setting_fsize_fn', __FILE__, 'featured_section');
	add_settings_field('iced_mocha_fheader', __('Featured Images as HEADER Images ','iced_mocha') , 'espresso_theme_setting_fheader_fn', __FILE__, 'featured_section');

/*** socials ***/
	add_settings_field('iced_mocha_socials1', __('Link nr. 1','iced_mocha') , 'espresso_theme_setting_socials1_fn', __FILE__, 'socials_section');
	add_settings_field('iced_mocha_socials2', __('Link nr. 2','iced_mocha') , 'espresso_theme_setting_socials2_fn', __FILE__, 'socials_section');
	add_settings_field('iced_mocha_socials3', __('Link nr. 3','iced_mocha') , 'espresso_theme_setting_socials3_fn', __FILE__, 'socials_section');
	add_settings_field('iced_mocha_socials4', __('Link nr. 4','iced_mocha') , 'espresso_theme_setting_socials4_fn', __FILE__, 'socials_section');
	add_settings_field('iced_mocha_socials5', __('Link nr. 5','iced_mocha') , 'espresso_theme_setting_socials5_fn', __FILE__, 'socials_section');
	add_settings_field('iced_mocha_socialshow', __('Socials display','iced_mocha') , 'espresso_theme_setting_socialsdisplay_fn', __FILE__, 'socials_section');

/*** misc ***/
	add_settings_field('iced_mocha_iecompat', __('Internet Explorer Compatibility Tag','iced_mocha') , 'espresso_theme_setting_iecompat_fn', __FILE__, 'misc_section');
	add_settings_field('iced_mocha_copyright', __('Custom Footer Text','iced_mocha') , 'espresso_theme_setting_copyright_fn', __FILE__, 'misc_section');
	add_settings_field('iced_mocha_customcss', __('Custom CSS','iced_mocha') , 'espresso_theme_setting_customcss_fn', __FILE__, 'misc_section');
	add_settings_field('iced_mocha_customjs', __('Custom JavaScript','iced_mocha') , 'espresso_theme_setting_customjs_fn', __FILE__, 'misc_section');

}

 // Display the admin options page
function iced_mocha_page_fn() {
 // Load the import form page if the import button has been pressed
	if (isset($_POST['iced_mocha_import'])) {
		iced_mocha_import_form();
		return;
	}
 // Load the import form  page after upload button has been pressed
	if (isset($_POST['iced_mocha_import_confirmed'])) {
		iced_mocha_import_file();
		return;
	}

 // Load the presets  page after presets button has been pressed
	if (isset($_POST['iced_mocha_presets'])) {
		iced_mocha_init_fn();
		iced_mocha_presets();
		return;
	}


 if (!current_user_can('edit_theme_options'))  {
    wp_die( __('Sorry, but you do not have sufficient permissions to access this page.','iced_mocha') );
  }?>


<div class="wrap"><!-- Admin wrap page -->

<div id="lefty"><!-- Left side of page - the options area -->
<div>
	<div id="admin_header"><img src="<?php echo get_template_directory_uri() . '/admin/images/iced_mocha-logo.png' ?>" /> </div>
	<div id="admin_links">
		<a target="_blank" href="http://eventespresso.com/iced_mocha">Iced Mocha Theme Homepage</a>
		<a target="_blank" href="http://eventespresso.com/support/forums/">Support</a>
		<a target="_blank" href="http://eventespresso.com">Event Espresso</a>
	</div>
	<div style="clear: both;"></div>
</div>
<?php
if ( isset( $_GET['settings-updated'] ) ) {
    echo "<div class='updated fade' style='clear:left;'><p>";
	echo _e('Iced Mocha Theme settings updated successfully.','iced_mocha');
	echo "</p></div>";
}
?>
<div id="jsAlert" class=""><b>Checking jQuery functionality...</b><br/><em>If this message remains visible after the page has loaded then there is a problem with your WordPress jQuery library. This can have several causes, including incompatible plugins.
The Iced Mocha Theme Settings page cannot function without jQuery. </em></div>
<?php global $iced_mochas; $iced_mocha_varalert = espresso_theme_maxvarcheck(count($iced_mochas));
if ($iced_mocha_varalert): ?><div id="varlimitalert"> <?php echo $iced_mocha_varalert; ?> </div><?php endif; ?>
	<div id="main-options">
		<form name="iced_mocha_form" id="iced_mocha_form" action="options.php" method="post" enctype="multipart/form-data">
			<div id="accordion">
				<?php settings_fields('iced_mocha_settings'); ?>
				<?php do_settings_sections(__FILE__); ?>
			</div>
			<div id="submitDiv">
			    <br>
				<input class="button" name="iced_mocha_settings[iced_mocha_submit]" type="submit" id="iced_mocha_sumbit" style="float:right;"   value="<?php _e('Save Changes','iced_mocha'); ?>" />
				<input class="button" name="iced_mocha_settings[iced_mocha_defaults]" id="iced_mocha_defaults" type="submit" style="float:left;" value="<?php _e('Reset to Defaults','iced_mocha'); ?>" />
				</div>
		</form>
		<?php   $iced_mocha_theme_data = get_transient( 'iced_mocha_theme_info');  ?>
		<span id="version">
		Iced Mocha Theme v<?php echo iced_mocha_VERSION; ?> by <a href="http://eventespresso.com" target="_blank">Event Espresso</a>
		</span>
	</div><!-- main-options -->
</div><!--lefty -->


<div id="righty" ><!-- Right side of page - Coffee, RSS tips and others -->
	<div id="iced_mocha-donate" class="postbox donate">
	 <div title="Click to toggle" class="handlediv"><br /></div>
		<h3 class="hndle"> Coffee Break </h3>
		<div class="inside"><?php echo "<p>While looking at Iced Mocha Theme you will notice what may appear as colors. You'll see them within images, in links and menus, defining borders and backgrounds, as part of animations, hover effects and more.  </p>
<p>But don't let that fool you, those are not colors. What you're actually seeing is a complex mix of coffee and our own blood - you'd be surprised to see how many hues we can get by mixing those two. But as of late we've been feeling pretty dizzy and light headed and it's not from the lack of blood (we are secretly vampires).</p>
<p>What's causing the dizziness is the limited amount of coffee. Every morning we have to make one very tough decision: either use coffee to make colors for Iced Mocha Theme or drink it and stay awake to develop Iced Mocha Theme. It's a choice we'd rather not make so...</p>"; ?>
			
		</div><!-- inside -->
	</div><!-- donate -->

    <div id="iced_mocha-export" class="postbox export non-essential-option" style="overflow:hidden;">
            <div title="Click to toggle" class="handlediv"><br /></div>
           	<h3 class="hndle"><?php _e( 'Import/Export Settings', 'iced_mocha' ); ?></h3>
        <div class="panel-wrap inside">
				<form action="" method="post">
                	<?php wp_nonce_field('iced_mocha-export', 'iced_mocha-export'); ?>
                    <input type="hidden" name="iced_mocha_export" value="true" />
                    <input type="submit" class="button" value="<?php _e('Export Theme options', 'iced_mocha'); ?>" />
					<p class="imex-text"><?php _e("It's that easy: a mouse click away - the ability to export your Iced Mocha Theme settings and save them on your computer. Feeling safer? You should!","iced_mocha"); ?></p>
                </form>
				<br />
                <form action="" method="post">
                    <input type="hidden" name="iced_mocha_import" value="true" />
                    <input type="submit" class="button" value="<?php _e('Import Theme options', 'iced_mocha'); ?>" />
					<p class="imex-text"><?php _e("Without the import, the export would just be a fool's exercise. Make sure you have the exported file ready and see you after the mouse click.","iced_mocha"); ?></p>
                </form>
				<br />
			<form action="" method="post">
                    <input type="hidden" name="iced_mocha_presets" value="true" />
                    <input type="submit" class="button" id="presets_button" value="<?php _e('Color Schemes', 'iced_mocha'); ?>" />
					<p class="imex-text"><?php _e("A collection of preset color schemes to use as the starting point for your site. Just load one up and see your blog in a different light.","iced_mocha"); ?></p>
                </form> 

		</div><!-- inside -->
	</div><!-- export -->

    <div id="iced_mocha-news" class="postbox news" >
	 <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'Iced Mocha Theme Latest News', 'iced_mocha' ); ?></h3>
            <div class="panel-wrap inside" style="height:200px;overflow:auto;">
                <?php
				function return_10( $seconds )
					{
					return 10;}
				$iced_mocha_news = fetch_feed( array( 'http://eventespresso.com/blog/feed/') );

				if ( ! is_wp_error( $iced_mocha_news ) ) {
					$maxitems = $iced_mocha_news->get_item_quantity( 10 );
					$news_items = $iced_mocha_news->get_items( 0, $maxitems );
				}
				?>
                <ul class="news-list">
                	<?php if ( $maxitems == 0 ) : echo '<li>' . __( 'No news items.', 'iced_mocha' ) . '</li>'; else :
                	foreach( $news_items as $news_item ) : ?>
                    	<li>
                        	<a class="news-header" target="_blank" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'><?php echo esc_html( $news_item->get_title() ); ?></a><br />
                   <span class="news-item-date"><?php _e('Posted on','iced_mocha'); echo $news_item->get_date(' j F Y, H:i'); ?></span><br />
                            <?php echo iced_mocha_truncate_words(strip_tags( $news_item->get_description() ),40,'...') ; ?>
					<br><a class="news-read" target="_blank" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'>Read more &raquo;</a><br />
                        </li>
                    <?php endforeach; endif; ?>
                </ul>
            </div><!-- inside -->
    </div><!-- news -->


</div><!--  righty -->
</div><!--  wrap -->

<script type="text/javascript">
var reset_confirmation = '<?php echo esc_html(__('Reset Iced Mocha Theme Settings to Defaults?','iced_mocha')); ?>';

function startfarb(a,b) {
	jQuery(b).css('display','none');
	jQuery(b).farbtastic(a).addtitle({id: a});

	jQuery(a).click(function() {
			if(jQuery(b).css('display') == 'none')	{
                                        			jQuery(b).parents('div:eq(0)').addClass('ui-accordion-content-overflow');
                                                    jQuery(b).css({'display':'inline-block','position':'absolute',marginLeft:'100px',opacity:0}).animate({opacity:1,marginLeft:'0px'},150);
                                                       }
	});

	jQuery(document).mousedown( function() {
		if(jQuery(b).css('display') != 'none') setTimeout(function () { jQuery(b).css('display','none');},150);
		jQuery(b).animate({opacity:0,marginLeft:'100px'},150, function(){ jQuery(b).parents('div:eq(0)').removeClass('ui-accordion-content-overflow'); });
			// todo: find a better way to remove class after the fade on IEs
	});
}

function tooltip_terain() {
jQuery('#accordion small').parent('div').append('<a class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-tooltip.png" /></a>').
	each(function() {
	//jQuery(this).children('a.tooltip').attr('title',jQuery(this).children('small').html() );
	var tooltip_info = jQuery(this).children('small').html();
	jQuery(this).children('.tooltip').tooltip({content : tooltip_info});
     jQuery(this).children('.tooltip').tooltip( "option", "items", "a" );
	//jQuery(this).children('.tooltip').tooltip( "option", "show", "false");
	jQuery(this).children('.tooltip').tooltip( "option", "hide", "false");
	jQuery(this).children('small').remove();
	if (!jQuery(this).hasClass('slmini') && !jQuery(this).hasClass('slidercontent') && !jQuery(this).hasClass('slideDivs')) jQuery(this).addClass('tooltip_div');
	});
}

function coloursel(el){
	var id = "#"+jQuery(el).attr('id');
	jQuery(id+"2").hide();
	var bgcolor = jQuery(id).val();
	if (bgcolor <= "#666666") { jQuery(id).css('color','#ffffff'); } else { jQuery(id).css('color','#000000'); };
	jQuery(id).css('background-color',jQuery(id).val());
}

function vercomp(ver, req) {
    var v = ver.split('.');
    var q = req.split('.');
    for (var i = 0; i < v.length; ++i) {
        if (q.length == i) { return true; } // v is bigger
        if (parseInt(v[i]) == parseInt(q[i])) { continue; } // nothing to do here, move along
        else if (parseInt(v[i]) > parseInt(q[i])) { return true; } // v is bigger
        else { return false; } // q is bigger
    }
    if (v.length != q.length) { return false; } // q is bigger
    return true; // v = q;
}

// farbtastic title addon function
(function($){
        $.fn.extend({
            addtitle: function(options) {
                var defaults = {
                    id: ''
                }
                var options = $.extend(defaults, options);
            return this.each(function() {
                    var o = options;
					var title = jQuery(o.id).attr('title');
                    if (title===undefined) { } else { jQuery(o.id+'2').children('.farbtastic').append('<span class="mytitle">'+title+'</span>'); }
            });
        }
        });
})(jQuery);


jQuery(document).ready(function(){
	//var _jQueryVer = parseFloat('.'+jQuery().jquery.replace(/\./g, ''));  // jQuery version as float, eg: 0.183
	//var _jQueryUIVer = parseFloat('.'+jQuery.ui.version.replace(/\./g, '')); // jQuery UI version as float, eg: 0.192
	//if (_jQueryUIVer >= 0.190) {
	if (vercomp(jQuery.ui.version,"1.9.0")) {
		tooltip_terain();
		jQuery('.colorthingy').each(function(){
			id = "#"+jQuery(this).attr('id');
			startfarb(id,id+'2');
		});
	} else {
		jQuery("#main-options").addClass('oldwp');
		setTimeout(function(){jQuery('#iced_mocha_slideType').trigger('click')},1000);
		jQuery('.colorthingy').each(function(){
			id = "#"+jQuery(this).attr('id');
			jQuery(this).on('keyup',function(){coloursel(this)});
			coloursel(this);
		});
		// warn about the old partially unsupported version
		jQuery("#jsAlert").after("<div class='updated fade' style='clear:left; font-size: 16px;'><p>Iced Mocha Theme has detected you are running an older version of Wordpress (jQuery) and will be running in compatibility mode. Some features may not work correctly. Consider updating your Wordpress to the latest version.</p></div>");
	}
});
jQuery('#jsAlert').hide();
</script>

<?php } // iced_mocha_page_fn()
?>
