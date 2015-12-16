<?php
/**
 * Frontpage generation functions
 * Creates the slider, the columns, the titles and the extra text
 *
 * @package iced_mocha
 * @subpackage Functions
 */

//wp_enqueue_style( 'iced_mocha-frontpage' );

function iced_mocha_excerpt_length_slider( $length ) {
	$iced_mochas = iced_mocha_get_theme_options();
	return ceil($iced_mochas['iced_mocha_excerptwords']/2);
}

function iced_mocha_excerpt_more_slider( $more ) {
	return '...';
}

     $iced_mochas= iced_mocha_get_theme_options();
     foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; } ?>

<script type="text/javascript">
     jQuery(document).ready(function() {
	// Slider creation
     jQuery('#slider').nivoSlider({
		effect: '<?php  echo $iced_mocha_fpslideranim; ?>',
       	animSpeed: <?php echo $iced_mocha_fpslidertime; ?>,
		<?php if($iced_mocha_fpsliderarrows=="Hidden"): ?>directionNav: false,<?php endif;
   		      if($iced_mocha_fpsliderarrows=="Always Visible"): ?>directionNavHide: false,<?php endif; ?>
		//controlNavThumbs: true, 
		pauseTime: <?php echo $iced_mocha_fpsliderpause; ?>
     });
	});
</script> 

<div id="frontpage">
<?php
// When a post query has been selected from the Slider type in the admin area
     global $post;
     // Initiating query
     $custom_query = new WP_query();
     $slides = array();
	 
	 if($iced_mocha_slideNumber>0 || $iced_mocha_slideNumberEvents>0):

     // Switch for Query type
     switch ($iced_mocha_slideType) {
          case 'Latest Events' :
               $custom_query->query('post_type=espresso_events&showposts='.$iced_mocha_slideNumberEvents);
          break;
          case 'Random Events' :
               $custom_query->query('post_type=espresso_events&showposts='.$iced_mocha_slideNumberEvents.'&orderby=rand');
          break;
          case 'Latest Posts' :
               $custom_query->query('showposts='.$iced_mocha_slideNumber.'&ignore_sticky_posts=1');
          break;
          case 'Random Posts' :
               $custom_query->query('showposts='.$iced_mocha_slideNumber.'&orderby=rand&ignore_sticky_posts=1');
          break;
          case 'Latest Posts from Category' :
               $custom_query->query('showposts='.$iced_mocha_slideNumber.'&category_name='.$iced_mocha_slideCateg.'&ignore_sticky_posts=1');
          break;
          case 'Random Posts from Category' :
               $custom_query->query('showposts='.$iced_mocha_slideNumber.'&category_name='.$iced_mocha_slideCateg.'&orderby=rand&ignore_sticky_posts=1');
          break;
          case 'Sticky Posts' :
               $custom_query->query(array('post__in'  => get_option( 'sticky_posts' ), 'showposts' =>$iced_mocha_slideNumber,'ignore_sticky_posts' => 1));
          break;
          case 'Specific Posts' :
               // Transofm string separated by commas into array
               $pieces_array = explode(",", $iced_mocha_slideSpecific);
               $custom_query->query(array( 'post_type' => 'any', 'post__in' => $pieces_array, 'ignore_sticky_posts' => 1,'orderby' => 'post__in' ));
               break;
          case 'Custom Slides':

               break;
		  case 'Disabled':
			   break;
     }//switch
	 
	 endif; // slidenumber>0

	 add_filter( 'excerpt_length', 'iced_mocha_excerpt_length_slider', 999 );
	 remove_filter( 'get_the_excerpt', 'iced_mocha_custom_excerpt_more' ); // remove theme continue-reading on slider posts
	 add_filter( 'excerpt_more', 'iced_mocha_excerpt_more_slider', 999 );
     // switch for reading/creating the slides
     switch ($iced_mocha_slideType) {
		  case 'Disabled':
			   break;
          case 'Custom Slides':
               for ($i=1;$i<=10;$i++):
                    if(${"iced_mocha_sliderimg$i"}):
                         $slide['image'] = esc_url(${"iced_mocha_sliderimg$i"});
                         $slide['link'] = esc_url(${"iced_mocha_sliderlink$i"});
                         $slide['title'] = ${"iced_mocha_slidertitle$i"};
                         $slide['text'] = ${"iced_mocha_slidertext$i"};
                         $slides[] = $slide;
                    endif;
               endfor;
               break;
          default:
			   if($iced_mocha_slideNumber>0 || $iced_mocha_slideNumberEvents>0):	
               if ( 
                  $custom_query->have_posts() ) while ($custom_query->have_posts()) :
                  $custom_query->the_post();
                  $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'slider');
                	$slide['image'] = $img[0];
                	$slide['link'] = get_permalink();
                	$slide['title'] = get_the_title();
                	$slide['text'] = get_the_excerpt();
                	$slides[] = $slide;
               endwhile;
			   endif; // slidenumber>0
               break;
     }; // switch


if (count($slides)>0):
     ?>
<div class="slider-wrapper theme-default <?php if($iced_mocha_fpsliderarrows=="Visible on Hover"): ?>slider-navhover<?php endif; ?> slider-<?php echo  preg_replace("/[^a-z0-9]/i","",strtolower($iced_mocha_fpslidernav)); ?>">
     <div class="ribbon"></div>
     <div id="slider" class="nivoSlider">
	<?php foreach($slides as $id=>$slide):
            if($slide['image']): ?>
            <a href='<?php echo ($slide['link']?$slide['link']:'#'); ?>'>
                 <img src='<?php echo $slide['image']; ?>' data-thumb='<?php echo $slide['image']; ?>' alt="" <?php if ($slide['title'] || $slide['text']): ?>title="#caption<?php echo $id;?>" <?php endif; ?> />
            </a><?php endif; ?>
     <?php endforeach; ?>
     </div>
     <?php foreach($slides as $id=>$slide): ?>
            <div id="caption<?php echo $id;?>" class="nivo-html-caption">
                <?php echo (strlen($slide['title'])>0?'<h2>'.$slide['title'].'</h2>':'');
				      echo (strlen($slide['text'])>0?'<div class="slide-text">'.$slide['text'].'</div>':''); ?>
            </div>
	<?php endforeach; ?>
     </div>
<?php endif; ?> 
<div class="slider-shadow"></div>
<div id="pp-afterslider">
<?php
// First FrontPage Title
if($iced_mocha_fronttext1) {?><div id="front-text1"> <h1><?php echo wp_kses_post($iced_mocha_fronttext1) ?> </h1></div><?php }
if($iced_mocha_fronttext3) {?><div id="front-text3"> <blockquote><?php echo do_shortcode($iced_mocha_fronttext3) ?> </blockquote></div><?php }

//COLUMNS
     // Initiating query
     $custom_query2 = new WP_query();
     $columns= array();
	 
	 if($iced_mocha_columnNumber>0 || $iced_mocha_columnNumberEvents>0):
     // Switch for Query type
     switch ($iced_mocha_columnType) {
          case 'Latest Events' :
               $custom_query2->query('post_type=espresso_events&showposts='.$iced_mocha_columnNumberEvents);
          break;
          case 'Random Events' :
               $custom_query2->query('post_type=espresso_events&showposts='.$iced_mocha_columnNumberEvents.'&orderby=rand');
          break;
          case 'Latest Posts' :
               $custom_query2->query('showposts='.$iced_mocha_columnNumber.'&ignore_sticky_posts=1');
          break;
          case 'Random Posts' :
               $custom_query2->query('showposts='.$iced_mocha_columnNumber.'&orderby=rand&ignore_sticky_posts=1');
          break;
          case 'Latest Posts from Category' :
               $custom_query2->query('showposts='.$iced_mocha_columnNumber.'&category_name='.$iced_mocha_columnCateg.'&ignore_sticky_posts=1');
          break;
          case 'Random Posts from Category' :
               $custom_query2->query('showposts='.$iced_mocha_columnNumber.'&category_name='.$iced_mocha_columnCateg.'&orderby=rand&ignore_sticky_posts=1');
          break;
          case 'Sticky Posts' :
               $custom_query2->query(array('post__in'  => get_option( 'sticky_posts' ), 'showposts' =>$iced_mocha_columnNumber,'ignore_sticky_posts' => 1));
          break;
          case 'Specific Posts' :
               // Transofm string separated by commas into array
               $pieces_array = explode(",", $iced_mocha_columnSpecific);
               $custom_query2->query(array( 'post_type' => 'any', 'post__in' => $pieces_array, 'ignore_sticky_posts' => 1,'orderby' => 'post__in' ));
               break;
          case 'Widget Columns':
		  
			   break;
		  case 'Disabled':

               break;
     }//switch
	 
	 endif; // columnNumber>0
	 
	 
	    // switch for reading/creating the columns
     switch ($iced_mocha_columnType) {
		  case 'Disabled':
			   break;
          case 'Widget Columns':
		       // if widgets loaded 
               if (is_active_sidebar('presentation-page-columns-area')) {
					echo "<div id='front-columns'>";
					dynamic_sidebar( 'presentation-page-columns-area' );
					echo "</div>";
				}
				// if no widgets loaded use the defaults
			   else {
					global $iced_mocha_column_defaults;
					iced_mocha_columns_output($iced_mocha_column_defaults,$iced_mocha_nrcolumns, $iced_mocha_columnreadmore); 
				}
               break;
          default: 
			   if($iced_mocha_columnNumber>0 || $iced_mocha_columnNumberEvents>0):
               if ( $custom_query2->have_posts() ) 
					while ($custom_query2->have_posts()) :
						$custom_query2->the_post();
                        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'columns');
						$column['image'] = $img[0];
						$column['link'] = get_permalink();
						$column['text'] = get_the_excerpt();
						$column['title'] = get_the_title();
						$columns[] = $column;
					endwhile;
					iced_mocha_columns_output($columns,$iced_mocha_nrcolumns, $iced_mocha_columnreadmore);
			   endif; // columnNumber>0
               break;
     }; // switch
	


function iced_mocha_columns_output($columns,$nr_columns,$readmore){
  $counter=0;
  $iced_mochas = iced_mocha_get_theme_options();
    foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }
  ?>
 <div id="front-columns"> 
 <?php
  foreach($columns as $column):
    if($column['image']) :
      $counter++;
      if (!isset($column['blank'])) $column['blank'] = 0;
      $coldata = array(
        'colno' => (($counter%$nr_columns)?$counter%$nr_columns:$nr_columns),
        'counter' => $counter,
        'image' => esc_url($column['image']),
        'link' => esc_url($column['link']),
        'blank' => ($column['blank']?'target="_blank"':''),
        'title' =>  wp_kses_data($column['title']),
        'text' => wp_kses_data($column['text']),
        'readmore' => wp_kses_data($readmore),
      );
      iced_mocha_singlecolumn_output($coldata);
    endif;
  endforeach; ?>
</div><?php
} // iced_mocha_columns()


// Second FrontPage title
if($iced_mocha_fronttext2) {?><div id="front-text2"> <h1><?php echo wp_kses_post($iced_mocha_fronttext2) ?> </h1></div><?php }

// Frontpage second text area
if($iced_mocha_fronttext4) {?><div id="front-text4"> <blockquote><?php echo do_shortcode($iced_mocha_fronttext4) ?> </blockquote></div><?php }

	 remove_filter( 'excerpt_length', 'iced_mocha_excerpt_length_slider', 999 );
	 remove_filter( 'excerpt_more', 'iced_mocha_excerpt_more_slider', 999 );
   if ($iced_mocha_frontposts=="Enable" || $iced_mocha_frontevents=="Enable"):
?>
  <section id="container" class="one-column <?php //echo iced_mocha_get_layout_class(); ?>">
    <div id="content" role="main">
      <?php
      if ($iced_mocha_frontposts=="Enable"): get_template_part('content/content', 'frontpage'); endif;
      if ($iced_mocha_frontevents=="Enable"): get_template_part('content/content', 'frontevents'); endif; ?>
   </div><!-- #content -->
    <?php //iced_mocha_get_sidebar(); ?>
  </section><!-- #container -->
<?php endif; ?>
</div> <!-- #pp-afterslider -->
</div> <!-- #frontpage -->
<?php // End of iced_mocha_frontpage_generator
