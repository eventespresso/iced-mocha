<?php
/**
 * Export Iced Mocha Theme settings to file
 */

function iced_mocha_export_options(){

    if (ob_get_contents()) ob_clean();

	/* Check authorisation */
	$authorised = true;
	// Check nonce
	if ( ! wp_verify_nonce( $_POST['iced_mocha-export'], 'iced_mocha-export' ) ) {
		$authorised = false;
	}
	// Check permissions
	if ( ! current_user_can( 'edit_theme_options' ) ){
		$authorised = false;
	}

	if ( $authorised) {
          global $iced_mochas;
          date_default_timezone_set('UTC');

          $name = 'iced_mochasettings-'.preg_replace("/[^a-z0-9-_]/i",'',str_replace("http://","",get_option('siteurl'))).'-'.date('Ymd-His').'.txt';
		//$name = 'iced_mocha-settings.txt';
		$data = $iced_mochas;
		$data = json_encode( $data );
		$size = strlen( $data );

		header( 'Content-Type: text/plain' );
		header( 'Content-Disposition: attachment; filename="'.$name.'"' );
		header( "Content-Transfer-Encoding: binary" );
		header( 'Accept-Ranges: bytes' );

		/* The three lines below basically make the download non-cacheable */
		header( "Cache-control: private" );
		header( 'Pragma: private' );
		header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );

		header( "Content-Length: " . $size);
		print( $data );
}
die();
}

if ( isset( $_POST['iced_mocha_export'] ) ){
	add_action( 'init', 'iced_mocha_export_options' );
}

/**
 * This file manages the theme settings uploading and import operations.
 * Uses the theme page to create a new form for uplaoding the settings
 * Uses WP_Filesystem
*/
function iced_mocha_import_form(){

    $bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
    $size = wp_convert_bytes_to_hr( $bytes );
    $upload_dir = wp_upload_dir();
    if ( ! empty( $upload_dir['error'] ) ) :
        ?><div class="error"><p><?php _e('Before you can upload your import file, you will need to fix the following error:', 'iced_mocha'); ?></p>
            <p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
    else :
    ?>

    <div class="wrap">
		<div style="width:400px;display:block;margin-left:30px;">
        <div id="icon-tools" class="icon32"><br></div>
        <h2><?php echo __( 'Import Iced Mocha Options', 'iced_mocha' );?></h2>
        <form enctype="multipart/form-data" id="import-upload-form" method="post" action="">
        	<p><?php _e('Hi! This is where you import the Iced Mocha Theme settings.<i> Please remember that this is still an experimental feature.</i>', 'iced_mocha'); ?></p>
            <p>
                <label for="upload"><strong><?php _e('Just choose a file from your computer:', 'iced_mocha'); ?> </strong><i>(iced_mocha-settings.txt)</i></label>
		       <input type="file" id="upload" name="import" size="25"  />
				<span style="font-size:10px;">(<?php  printf( __( 'Maximum size: %s', 'iced_mocha' ), $size ); ?> )</span>
                <input type="hidden" name="action" value="save" />
                <input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
                <?php wp_nonce_field('iced_mocha-import', 'iced_mocha-import'); ?>
                <input type="hidden" name="iced_mocha_import_confirmed" value="true" />
            </p>
            <input type="submit" class="button" value="<?php _e('And import!', 'iced_mocha'); ?>" />
        </form>
	</div>
    </div> <!-- end wrap -->
    <?php
    endif;
} // Closes the iced_mocha_import_form() function definition


/**
 * This actual import of the options from the file to the settings array.
*/
function iced_mocha_import_file() {
    global $iced_mochas;

    /* Check authorisation */
    $authorised = true;
    // Check nonce
    if (!wp_verify_nonce($_POST['iced_mocha-import'], 'iced_mocha-import')) {$authorised = false;}
    // Check permissions
    if (!current_user_can('edit_theme_options')){ $authorised = false; }

    // If the user is authorised, import the theme's options to the database
    if ($authorised) {?>
        <?php
        // make sure there is an import file uploaded
        if ( (isset($_FILES["import"]["size"]) &&  ($_FILES["import"]["size"] > 0) ) ) {

			$form_fields = array('import');
			$method = '';

			$url = wp_nonce_url('themes.php?page=iced_mocha-page', 'iced_mocha-import');

			// Get file writing credentials
			if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_fields) ) ) {
				return true;
			}

			if ( ! WP_Filesystem($creds) ) {
				// our credentials were no good, ask the user for them again
				request_filesystem_credentials($url, $method, true, false, $form_fields);
				return true;
			}

			// Write the file if credentials are good
			$upload_dir = wp_upload_dir();
			$filename = trailingslashit($upload_dir['path']).'iced_mochas.txt';

			// by this point, the $wp_filesystem global should be working, so let's use it to create a file
			global $wp_filesystem;
			if ( ! $wp_filesystem->move($_FILES['import']['tmp_name'], $filename, true) ) {
				echo 'Error saving file!';
				return;
			}

			$file = $_FILES['import'];

			if ($file['type'] == 'text/plain') {
				$data = $wp_filesystem->get_contents($filename);
				// try to read the file
				if ($data !== FALSE){
					$settings = json_decode($data, true);
					// try to read the settings array
					if (isset($settings['iced_mocha_db'])){ ?>
        <div class="wrap">
        <div id="icon-tools" class="icon32"><br></div>
        <h2><?php echo __( 'Import Iced Mocha Options ', 'iced_mocha' );?></h2> <?php
						$settings = array_merge($iced_mochas, $settings);
						update_option('iced_mocha_settings', $settings);
						echo '<div class="updated fade"><p>'. __('Great! The options have been imported!', 'iced_mocha').'<br />';
						echo '<a href="themes.php?page=iced_mocha-page">'.__('Go back to the Iced Mocha Theme options page and check them out!', 'iced_mocha').'<a></p></div>';
					}
					else { // else: try to read the settings array
						echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'iced_mocha').'</strong><br />';
						echo __('The uploaded file does not contain valid Iced Mocha Theme options. Make sure the file is exported from the Iced Mocha Theme Options page.', 'iced_mocha').'</p></div>';
						iced_mocha_import_form();
					}
				}
				else { // else: try to read the file
					echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'iced_mocha').'</strong><br />';
					echo __('The uploaded file could not be read.', 'iced_mocha').'</p></div>';
					iced_mocha_import_form();
				}
			}
			else { // else: make sure the file uploaded was a plain text file
				echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'iced_mocha').'</strong><br />';
				echo __('The uploaded file is not supported. Make sure the file was exported from the Iced Mocha Theme page and that it is a text file.', 'iced_mocha').'</p></div>';
				iced_mocha_import_form();
			}

			// Delete the file after we're done
			$wp_filesystem->delete($filename);

        }
        else { // else: make sure there is an import file uploaded
            echo '<div class="error"><p>'.__( 'Oops! The file is empty or there was no file. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.', 'iced_mocha' ).'</p></div>';
			iced_mocha_import_form();
        }
        echo '</div> <!-- end wrap -->';
    }
    else {
        wp_die(__('ERROR: You are not authorised to perform that operation', 'iced_mocha'));
    }
} // Closes the iced_mocha_import_file() function definition



function iced_mocha_presets(){
?>
<script type="text/javascript">
var scheme_confirmation = '<?php echo esc_html__('Are you sure you want to load a new color scheme? \nAll current saved settings under Text and Color Settings will be lost.','iced_mocha'); ?>';
</script>
    <div class="wrap">
		<div id="admin_header"><img src="<?php echo get_template_directory_uri() . '/admin/images/colorschemes-logo.png' ?>" /> </div>
		<div style="display:block;margin-left:30px;clear:both;float:none;">
			<p><em><?php echo _e("Select one of the preset color schemes and press the Load button.<br> <b> CAUTION! </b> When loading a color scheme, the Iced Mocha Theme theme settings under Text and Color Settings will be overriden. All other settings will remain intact.<br> <u>SUGGESTION:</u> It's always better to export your current theme settings before loading a color scheme." , "iced_mocha"); ?></em></p>
			<br>
			<form name="iced_mocha_form" action="options.php" method="post" enctype="multipart/form-data">

	<?php
	settings_fields('iced_mocha_settings');

	global $iced_mochas;
	global $iced_mocha_colorschemes_array;
	$items = $iced_mocha_colorschemes_array;

	foreach($items as $key=>$item) {
		$id = preg_replace('/[^a-z0-9]/i', '',$key);
		$checkedClass = ($iced_mochas['iced_mocha_colorschemes']==$item) ? ' checkedClass' : '';
		echo " <label id='$id' for='$id$id' class='images presets $checkedClass'><input ";
			checked($iced_mochas['iced_mocha_colorschemes'],$item);
		echo " value='$key' id='$id$id' onClick=\"changeBorder('$id','images');\" name='iced_mocha_settings[iced_mocha_colorschemes]' type='radio' /><img class='$id'  src='".get_template_directory_uri()."/admin/images/schemes/{$key}.png'/><p>{$key}</p></label>";
	}

	?>

			<div id="submitDiv" style="width:400px;display:block;margin:0 auto;">
				<br>
				<input type="hidden" value="true" name="iced_mocha_presets_loaded" />
				<input class="button" name="iced_mocha_settings[iced_mocha_schemessubmit]" type="submit" id="load-color-scheme" style="width:400px;height:40px;display:block;text-align:center;" value="<?php _e('Load Color Scheme','iced_mocha'); ?>" />
			</div>
			</form>
		</div>
    </div> <!-- end wrap -->
	<br>
    <?php
} // Closes the iced_mocha_import_form() function definition


// Truncate function for use in the Admin RSS feed
function iced_mocha_truncate_words($string,$words=20, $ellipsis=' ...') {
 $new = preg_replace('/((\w+\W+\'*){'.($words-1).'}(\w+))(.*)/', '${1}', $string);
 return $new.$ellipsis;
}

// Check PHP's max_var_input value and return alert accordingly
function espresso_theme_maxvarcheck($themevarcount,$debug=false){
     $warnstr1 = "<b>Notice!</b> You are close to the limit of variables your server accepts to process at a time.
                 You may not be able to save theme settings if a future update adds more configuration options unless you increase PHP's <tt>%s0%</tt> value.<br/>";
     $warnstr2 = "<b>Warning!</b> You will not be able to save the theme settings. Your server imposes a limit on the number of variables processed at a time lower than
                 the number of configuration variables the theme uses. You need to increase PHP's <tt>%s0%</tt> value to use the theme.<br/>";
     $warninfo = "<em>The theme is currently using <b>%s1%</b> variables while your server limit is at <b>%s2%</b>.</em>";
     if (ini_get('max_input_vars')):
          $phpmaxvars = ini_get('max_input_vars');
          $warnstr1 = str_replace("%s0%","max_input_vars",$warnstr1);
          $warnstr2 = str_replace("%s0%","max_input_vars",$warnstr2);
     elseif (ini_get('suhosin.post.max_vars')):
          $phpmaxvars = ini_get('suhosin.post.max_vars');
          $warnstr1 = str_replace("%s0%","suhosin.post.max_vars",$warnstr1);
          $warnstr2 = str_replace("%s0%","suhosin.post.max_vars",$warnstr2);
     else:
          $phpmaxvars = PHP_INT_MAX;
     endif;
     $warninfo = str_replace(array("%s1%","%s2%"),array($themevarcount,$phpmaxvars),$warninfo);

     if ($themevarcount > $phpmaxvars): $return = $warnstr2.$warninfo;
     elseif ($themevarcount+100 > $phpmaxvars): $return = $warnstr1.$warninfo;
     else:
          if ($debug): $return = "DEBUG: ".$warninfo; else: $return = ''; endif;
     endif;
     return $return;
} // espresso_theme_maxvarcheck()

// Synchronizing the tinymce width with the content width
add_filter('tiny_mce_before_init', 'iced_mocha_dynamic_editor_styles', 10);
function iced_mocha_dynamic_editor_styles($settings){
    $settings['content_css'] .= ",".admin_url('admin-ajax.php') ."/?action=dynamic_styles";
    return $settings;
}