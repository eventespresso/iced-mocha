<?php
/**
 * Contains methods for customizing the theme customization screen.
 * @since iced_mocha 1.2.4
 * @updated iced_mocha 1.3.3 / espresso_theme 0.5
 */

$espresso_theme_customizer = array(

'info_sections' => array(
	'support' => array(
		'title' => __( 'Support', 'espresso_theme' ),
		'desc' => __( 'Got a question? Need help?', 'espresso_theme' ),
	),
	'rating' => array(
		'title' => __( 'Rating', 'espresso_theme' ),
		'desc' => __( 'If you like the theme, rate it. If you hate the theme, rate it as well. Let us know how we can make it better.', 'espresso_theme' ),
	),
), // info_sections

'info_settings' => array(
	'support_link1' => array(
		'default' => 'http://eventespresso.com/support/',
		'label' => __( 'Read the FAQs', 'espresso_theme' ),
		'desc' => __( '', 'espresso_theme' ),
		'section' => 'support',
	),
	'support_link2' => array(
		'default' => 'http://eventespresso.com/support/' ,
		'label' => __( 'Browse the Forum', 'espresso_theme' ),
		'desc' => __( '', 'espresso_theme' ),
		'section' => 'support',
	),
	'premium_support_link' => array(
		'default' => 'http://eventespresso.com/pricing/',
		'label' => __( 'Request Premium Support', 'espresso_theme' ),
		'desc' => __( 'We also provide fast support via our premium support system.', 'espresso_theme' ),
		'section' => 'support',
	),
	'rating_url' => array(
		'default' => 'https://eventespresso.com',
		'label' => sprintf( __( 'Rate %s on Wordpress.org', 'espresso_theme' ) , ucwords(_ESPRESSO_THEME_NAME) ),
		'desc' => __( '', 'espresso_theme' ),
		'section' => 'rating',
	),
), // info_settings

'advanced_settings' => array(
	'default' => sprintf('themes.php?page=%1$s-page', 'iced_mocha'),
	'label' => ucwords(_ESPRESSO_THEME_NAME) . ' ' . __(  'Settings', 'espresso_theme' ),
	'desc' => __('To configure the remaining 200+ theme options, access the dedicated settings page:', 'espresso_theme' ),
	'section' => 'advanced_settings',
	'priority' => 999,
), // advanced_settings

); // theme_customizer

///////// CUSTOM CUSTOMIZERS
function espresso_theme_customizer_extras($wp_customize) {

	class Espresso_Customize_Link_Control extends WP_Customize_Control {
			public $type = 'link';
			public function render_content() { 
				if ( !empty( $this->description ) ) { ?>
					<li class="customize-section-description-container">
						<div class="description customize-section-description">
						    <?php echo esc_attr( $this->description ); ?>
						</div>
					</li>
				<?php
				}
				echo '<a href="' . esc_url( $this->value() ) . '" target="_blank">' . esc_attr( $this->label ) .'</a>';
			}
	} // class Espresso_Customize_Link_Control
	
	class Espresso_Customize_Blank_Control extends WP_Customize_Control {
			public $type = 'blank';
			public function render_content() { 
				echo '&nbsp;';
			}
	} // class Espresso_Customize_Link_Control
	
} // espresso_theme_customizer_extras()

function espresso_theme_customizer_sanitize_blank(){
	// dummy function that does nothing, since the sanitized add_section 
	// calling it does not add any user-editable field
} // espresso_theme_customizer_sanitize_blank()
 
class espresso_theme_Customizer {

   public static function register( $wp_customize ) {	
		global $espresso_theme_customizer;
   
		// add about theme panel and sections
		if (!empty($espresso_theme_customizer['info_sections'])):
		$wp_customize->add_panel( 'about', array(
			'priority'       => 0,
			'title'          => __( 'About', 'espresso_theme' ). ' ' . ucwords(_ESPRESSO_THEME_NAME),
			'description'    => ucwords(_ESPRESSO_THEME_NAME) . __( ' by ', 'espresso_theme' ) . 'espresso_theme Creations',
		) );
		$section_priority = 10;
		
		foreach ($espresso_theme_customizer['info_sections'] as $iid=>$info):
			$wp_customize->add_section( $iid, array(
				'title'          => $info['title'],
				'description'    => $info['desc'],
				'priority'       => $section_priority++,
				'panel'  		 => 'about',
			) );
		endforeach;
		endif; //!empty
		
		foreach ($espresso_theme_customizer['info_settings'] as $iid => $info):
			$wp_customize->add_setting( $iid, array(
				'default'        => $info['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'espresso_theme_customizer_sanitize_blank'
			) );
			$wp_customize->add_control( new Espresso_Customize_Link_Control( $wp_customize, $iid, array(
				'label'   		=> $info['label'],
				'description'   => $info['desc'],
				'section' 		=> $info['section'],
				'settings'   	=> $iid,
				'priority'   	=> 10,
			) ) );				
		endforeach;		
		// end about panel
		
		// add settings page panel and section
		if (!empty($espresso_theme_customizer['advanced_settings'])):
		$adv = $espresso_theme_customizer['advanced_settings'];
		/*$wp_customize->add_panel( $adv['section'], array(
			'priority'       => $adv['priority'],
			'title'          => $adv['label'],
			'description'    => $adv['desc'],
		) );*/
		
		$wp_customize->add_section( $adv['section'], array(
			'title'          => $adv['label'],
			'description'    => '',
			'priority'       => $adv['priority'],
			//'panel'  => $opt['section'],
			) );
		
		$wp_customize->add_setting( $adv['section'], array(
			'default'        => $adv['default'],
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'espresso_theme_customizer_sanitize_blank'
		) );
		$wp_customize->add_control( new Espresso_Customize_Link_Control( $wp_customize, $adv['section'], array(
			'label'   => $adv['label'],
			'description'  => $adv['desc'],
			'section' => $adv['section'],
			'settings'   => $adv['section'],
			'priority'   => $adv['priority'],
		) ) );				
		endif;
		// end settings panel

   
   } // register()
 
} // class espresso_theme_Customizer

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', 'espresso_theme_customizer_extras' );
add_action( 'customize_register', array('espresso_theme_Customizer', 'register' ) );

?>