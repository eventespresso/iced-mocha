<?php

/** 
 * PRESENTATION PAGE COLUMNS 
 */

// Counting the PP column widgets
global $iced_mocha_column_counter;
$iced_mocha_column_counter = 0;

class ColumnsWidget extends WP_Widget
{ 	
  var $iced_mochas; // theme options read in the constructor
  
  public function __construct() { 
    $widget_ops = array('classname' => 'ColumnsWidget', 'description' => 'Add columns in the presentation page' );
	$control_ops = array('width' => 350, 'height' => 350); // making widget window larger
	parent::__construct('columns_widget', 'espresso_theme Column', $widget_ops, $control_ops);
	$this->iced_mochas = iced_mocha_get_theme_options(); // reading theme options
  } // construct()
  
  public function ColumnsWidget(){
	self::__construct();	  
  } // PHP4 constructor

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'image' => '', 'title' => '' , 'text' => '',  'link' => '',  'blank' => '' ) );
    $image = $instance['image'];
	$title = $instance['title'];
	$text = $instance['text'];
	$link = $instance['link'];
	$blank = $instance['blank'];?>
	<div>
		<p><label for="<?php echo $this->get_field_id('image'); ?>">Image: <input class="widefat slideimages" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_url($image); ?>" /></label><a class="upload_image_button button" href="#">Select / Upload Image</a></p>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Text: <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php echo esc_attr($text); ?></textarea></label></p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>">Link: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_url($link); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('blank'); ?>">Open in new Window: <input id="<?php echo $this->get_field_id('blank'); ?>" name="<?php echo $this->get_field_name('blank'); ?>" type="checkbox" <?php checked($blank, 1); ?> value="1" /></label></p>
	</div>
	
<?php  } // form() function

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['image'] = $new_instance['image'];
	$instance['title'] = $new_instance['title'];
	$instance['text'] = $new_instance['text'];
	$instance['link'] = $new_instance['link'];
	$instance['blank'] = $new_instance['blank'];
    return $instance;
  } // update()
  
   function widget($args, $instance) { 
	$iced_mocha_nrcolumns = $this->iced_mochas['iced_mocha_nrcolumns']; // getting the number of columns setting
	global $iced_mocha_column_counter; // globabl counter for incrementing further
	$blank="";
	if($instance['blank']) $blank="target='_blank'";
	
	if($instance['image']) : 
		$iced_mocha_column_counter++; // incrementing counter only if widget has image
		$counter = $iced_mocha_column_counter; 
		$coldata = array(
			'colno' => (($counter%$iced_mocha_nrcolumns)?$counter%$iced_mocha_nrcolumns:$iced_mocha_nrcolumns),
			'counter' => $counter,
			'image' => esc_url($instance['image']),
			'link' => esc_url($instance['link']),
			'blank' => ($instance['blank']?'target="_blank"':''),
			'title' =>  $instance['title'],
			'text' => $instance['text'],
			'readmore' => $this->iced_mochas['iced_mocha_columnreadmore'],  // read more setting
		);		
		iced_mocha_singlecolumn_output($coldata);	
	endif; 
  } // widget()
  
} // ColumnsWidget class

add_action( 'widgets_init', create_function('', 'return register_widget("ColumnsWidget");') );

function iced_mocha_widget_scripts() {
	// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
         wp_enqueue_media();
      }
      else {
         wp_enqueue_script('media-upload');
         wp_enqueue_script('thickbox');
         wp_enqueue_style('thickbox');
      }
	wp_register_script('admin', get_template_directory_uri().'/admin/js/widgets.js');
	wp_enqueue_script('admin'); 
}

add_action ('admin_print_scripts-widgets.php','iced_mocha_widget_scripts');

/**
 * presentation page column output
 */
if ( ! function_exists('iced_mocha_singlecolumn_output') ):
function iced_mocha_singlecolumn_output($data){
	foreach ($data as $key => $value) { ${"$key"} = $value; }
	$counter = 0;
	?>
		<div class="column<?php echo $colno; ?>">
			<?php if ($image) {	?>
				<a href="<?php echo $link; ?>" <?php echo $blank; ?> class="clickable-column">
					<?php if ($title) { echo "<h3 class='column-header-image'>".$title."</h3>"; } ?>
				</a>

				<div class="column-image">
					<div class="column-image-inside">  </div>
						<a href="<?php echo $link; ?>" <?php echo $blank; ?> class="clickable-column">
							<img  src="<?php echo esc_url($image) ?>" id="columnImage<?php echo $counter; ?>" alt="<?php echo ($title?wp_kses($title,array()):''); ?>" />
						</a>
					
					<?php if ($text) { ?>		
						<div class="column-text">
							<?php echo $text; ?>							
						</div>
					<?php if ( $readmore && $link ): ?>
						<div class="columnmore">
							<a href="<?php echo $link; ?>" <?php echo $blank; ?>><?php echo $readmore ?> <i class="column-arrow"></i> </a>
						</div>
						<?php endif; ?>
					<?php } ?>
					
				</div><!--column-image-->
			<?php } ?>
		</div><!-- column -->
	<?php
} // iced_mocha_singlecolumn_output()
endif;

/**
 * ------------------------------------------------------------------------
 *
 * Iced Mocha - Upcoming Events Widget
 *
 * @package		Event Espresso
 * @subpackage	/widgets/upcoming_events/
 * @author		Brent Christensen, Seth Shoultes
 *
 * ------------------------------------------------------------------------
 */
class Iced_Mocha_EEW_Upcoming_Events  extends WP_Widget {


	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'iced_mocha-upcoming-events-widget',
			__( 'Iced Mocha Upcoming Events', 'iced_mocha' ),
			 array( 'description' => __( 'Another widget to display your upcoming events.', 'iced_mocha' )),
			array(
				'width' => 300,
				'height' => 350,
				'id_base' => 'iced_mocha-upcoming-events-widget'
			)
		);
	}



	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		EE_Registry::instance()->load_helper( 'Form_Fields' );
		EE_Registry::instance()->load_class( 'Question_Option', array(), FALSE, FALSE, TRUE );
		// Set up some default widget settings.
		$defaults = array(
			'title' => __('Upcoming Events', 'iced_mocha'),
			'category_name' => '',
			'show_expired' => FALSE,
			'show_desc' => TRUE,
			'show_dates' => TRUE,
			'limit' => 10,
			'image_size' => 'medium'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		// don't add HTML labels for EE_Form_Fields generated inputs
		add_filter( 'FHEE__EEH_Form_Fields__label_html', '__return_empty_string' );
		$yes_no_values = array(
			EE_Question_Option::new_instance( array( 'QSO_value' => 0, 'QSO_desc' => __('No', 'iced_mocha'))),
			EE_Question_Option::new_instance( array( 'QSO_value' => 1, 'QSO_desc' => __('Yes', 'iced_mocha')))
		);

	?>

		<!-- Widget Title: Text Input -->

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'iced_mocha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category_name'); ?>">
				<?php _e('Event Category:', 'iced_mocha'); ?>
			</label>
			<?php
			$event_categories = array();
			if ( $categories = EE_Registry::instance()->load_model( 'Term' )->get_all_ee_categories( TRUE )) {
				foreach ( $categories as $category ) {
					$event_categories[] = EE_Question_Option::new_instance( array( 'QSO_value' => $category->get( 'slug' ), 'QSO_desc' => $category->get( 'name' )));
				}
			}
			array_unshift( $event_categories, EE_Question_Option::new_instance( array( 'QSO_value' => '', 'QSO_desc' => __(' - display all - ', 'iced_mocha'))));
			echo EEH_Form_Fields::select(
				 __('Event Category:', 'iced_mocha'),
				$instance['category_name'],
				$event_categories,
				$this->get_field_name('category_name'),
				$this->get_field_id('category_name')
			);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>">
				<?php _e('Number of Events to Display:', 'iced_mocha'); ?>
			</label>
			<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $instance['limit']; ?>" size="3" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_expired'); ?>">
				<?php _e('Show Expired Events:', 'iced_mocha'); ?>
			</label>
			<?php
			echo EEH_Form_Fields::select(
				 __('Show Expired Events:', 'iced_mocha'),
				$instance['show_expired'],
				$yes_no_values,
				$this->get_field_name('show_expired'),
				$this->get_field_id('show_expired')
			);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image_size'); ?>">
				<?php _e('Image Size:', 'iced_mocha'); ?>
			</label>
			<?php
			$image_sizes = array();
			if ( $sizes = get_intermediate_image_sizes() ) {
				// loop thru images and create option objects out of them
				foreach ( $sizes as $image_size ) {
					$image_size = trim( $image_size );
					// no big images plz
					if ( ! in_array( $image_size, array( 'large', 'post-thumbnail' ))) {
						$image_sizes[] = EE_Question_Option::new_instance( array( 'QSO_value' => $image_size, 'QSO_desc' => $image_size ));
					}
				}
				$image_sizes[] = EE_Question_Option::new_instance( array( 'QSO_value' => 'none', 'QSO_desc' =>  __('don\'t show images', 'iced_mocha') ));
			}
			echo EEH_Form_Fields::select(
				 __('Image Size:', 'iced_mocha'),
				$instance['image_size'],
				$image_sizes,
				$this->get_field_name('image_size'),
				$this->get_field_id('image_size')
			);
			?>

		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_desc'); ?>">
				<?php _e('Show Description:', 'iced_mocha'); ?>
			</label>
			<?php
			echo EEH_Form_Fields::select(
				 __('Show Description:', 'iced_mocha'),
				$instance['show_desc'],
				$yes_no_values,
				$this->get_field_name('show_desc'),
				$this->get_field_id('show_desc')
			);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_dates'); ?>">
				<?php _e('Show Dates:', 'iced_mocha'); ?>
			</label>
			<?php
			echo EEH_Form_Fields::select(
				 __('Show Dates:', 'iced_mocha'),
				$instance['show_dates'],
				$yes_no_values,
				$this->get_field_name('show_dates'),
				$this->get_field_id('show_dates')
			);
			?>
		</p>

		<?php
	}



	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['category_name'] = $new_instance['category_name'];
		$instance['show_expired'] = $new_instance['show_expired'];
		$instance['limit'] = $new_instance['limit'];
		$instance['image_size'] = $new_instance['image_size'];
		$instance['show_desc'] = $new_instance['show_desc'];
		$instance['show_dates'] = $new_instance['show_dates'];
		return $instance;
	}



	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		global $post;
		// make sure there is some kinda post object
		if ( $post instanceof WP_Post ) {
			// but NOT an events archives page, cuz that would be like two event lists on the same page
			if ( ! ( $post->post_type == 'espresso_events' && is_archive() )) {
				// let's use some of the event helper functions'
				EE_Registry::instance()->load_helper( 'Event_View' );
				// make separate vars out of attributes
				extract($args);
				// filter the title
				$title = apply_filters('widget_title', $instance['title']);
				// Before widget (defined by themes).
				echo $before_widget;
				// Display the widget title if one was input (before and after defined by themes).
				if ( ! empty( $title )) {
					echo $before_title . $title . $after_title;
				}
				// grab widget settings
				$category = isset( $instance['category_name'] ) && ! empty( $instance['category_name'] ) ? $instance['category_name'] : FALSE;
				$show_expired = isset( $instance['show_expired'] ) ? (bool) absint( $instance['show_expired'] ) : FALSE;
				$image_size = isset( $instance['image_size'] ) && ! empty( $instance['image_size'] ) ? $instance['image_size'] : 'medium';
				$show_desc = isset( $instance['show_desc'] ) ? (bool) absint( $instance['show_desc'] ) : TRUE;
				$show_dates = isset( $instance['show_dates'] ) ? (bool) absint( $instance['show_dates'] ) : TRUE;
				// start to build our where clause
				$where = array(
//					'Datetime.DTT_is_primary' => 1,
					'status' => 'publish'
				);
				// add category
				if ( $category ) {
					$where['Term_Taxonomy.taxonomy'] = 'espresso_event_categories';
					$where['Term_Taxonomy.Term.slug'] = $category;
				}
				// if NOT expired then we want events that start today or in the future
				if ( ! $show_expired ) {
					$where['Datetime.DTT_EVT_start'] = array( '>=', date( 'Y-m-d' ));
				}
				// run the query
				$events = EE_Registry::instance()->load_model( 'Event' )->get_all( array(
					$where,
					'limit' => $instance['limit'] > 0 ? '0,' . $instance['limit'] : '0,10',
					'order_by' => 'Datetime.DTT_EVT_start',
					'order' => 'ASC',
					'group_by' => 'EVT_ID'
				));

				if ( ! empty( $events )) {
					echo '<ul class="ee-upcoming-events-widget-ul">';
					foreach ( $events as $event ) {
						if ( $event instanceof EE_Event && $post->ID != $event->ID() ) {
							//printr( $event, '$event  <br /><span style="font-size:10px;font-weight:normal;">' . __FILE__ . '<br />line no: ' . __LINE__ . '</span>', 'auto' );
							echo '<li id="ee-upcoming-events-widget-li-' . $event->ID() . '" class="ee-upcoming-events-widget-li">';
							// how big is the event name ?
							$name_length = strlen( $event->name() );
							switch( $name_length ) {
								case $name_length > 70 :
									$len_class =  'three-line';
									break;
								case $name_length > 35 :
									$len_class =  'two-line';
									break;
								default :
									$len_class =  'one-line';
							}
							echo '<a class="ee-widget-event-name-a" href="' . get_permalink( $event->ID() ) . '">' . $event->name() . '</a>';
							if ( has_post_thumbnail( $event->ID() ) && $image_size != 'none' ) {
								echo '<a class="ee-upcoming-events-widget-img" href="' . get_permalink( $event->ID() ) . '">' . get_the_post_thumbnail( $event->ID(), $image_size ) . '</a>';
							}
							if ( $show_dates ) {
								echo espresso_list_of_event_dates( $event->ID(), 'D M jS, Y', 'g:i a', FALSE, NULL, TRUE, TRUE );
							}
							if ( $show_desc && $desc = $event->short_description( 25 )) {
								echo  '<p>' . $desc . '</p>';
							}
							echo '<hr /></li>';
						}
					}
					echo '</ul>';
				}
				// After widget (defined by themes).
				echo $after_widget;
			}
		}
	}



}
// Register and load the widget
add_action( 'widgets_init', create_function('', 'return register_widget("Iced_Mocha_EEW_Upcoming_Events");') );

