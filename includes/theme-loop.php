<?php /*
 * Main loop related functions
 *
 * @package iced_mocha
 * @subpackage Functions
 */


 /**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Iced Mocha Theme 1.0
 * @return int
 */
function iced_mocha_excerpt_length( $length ) {
	global $iced_mocha_excerptwords;
	return $iced_mocha_excerptwords;
}
add_filter( 'excerpt_length', 'iced_mocha_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since iced_mocha 0.5
 * @return string "Continue Reading" link
 */
function iced_mocha_continue_reading_link() {
	global $iced_mocha_excerptcont;
	return ' <a class="continue-reading-link" href="'. get_permalink() . '">' .$iced_mocha_excerptcont.'<i class="icon-right-dir"></i></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and iced_mocha_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since iced_mocha 0.5
 * @return string An ellipsis
 */
function iced_mocha_auto_excerpt_more( $more ) {
	global $iced_mocha_excerptdots;
	return $iced_mocha_excerptdots. iced_mocha_continue_reading_link();
}
add_filter( 'excerpt_more', 'iced_mocha_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since iced_mocha 0.5
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function iced_mocha_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= iced_mocha_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'iced_mocha_custom_excerpt_more' );


/**
 * Adds a "Continue Reading" link to post excerpts created using the <!--more--> tag.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the the_content_more_link filter hook.
 *
 * @since iced_mocha 0.5
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function iced_mocha_more_link($more_link, $more_link_text = '') {
	global $iced_mocha_excerptcont;
	$new_link_text = $iced_mocha_excerptcont;
	if (preg_match("/custom=(.*)/",$more_link_text,$m) ) {
		$new_link_text = $m[1];
	};
	$more_link = str_replace($more_link_text, $new_link_text, $more_link);
	$more_link = str_replace('more-link', 'continue-reading-link', $more_link);
	return $more_link;
}
add_filter('the_content_more_link', 'iced_mocha_more_link',10,2);


/**
 * Allows post excerpts to contain HTML tags
 * @since iced_mocha 1.8.7
 * @return string Excerpt with most HTML tags intact
 */

function iced_mocha_trim_excerpt($text) {
     global $iced_mocha_excerptwords;
     global $iced_mocha_excerptcont;
     global $iced_mocha_excerptdots;
     $raw_excerpt = $text;
     if ( '' == $text ) {
         //Retrieve the post content.
         $text = get_the_content('');

         //Delete all shortcode tags from the content.
         $text = strip_shortcodes( $text );

         $text = apply_filters('the_content', $text);
         $text = str_replace(']]>', ']]&gt;', $text);

         $allowed_tags = '<a>,<img>,<b>,<strong>,<ul>,<li>,<i>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<pre>,<code>,<em>,<u>,<br>,<p>';
         $text = strip_tags($text, $allowed_tags);

         $words = preg_split("/[\n\r\t ]+/", $text, $iced_mocha_excerptwords + 1, PREG_SPLIT_NO_EMPTY);
         if ( count($words) > $iced_mocha_excerptwords ) {
             array_pop($words);
             $text = implode(' ', $words);
             $text = $text .' '.$iced_mocha_excerptdots. ' <a class="continue-reading-link" href="'. get_permalink() . '">' .$iced_mocha_excerptcont.' <span class="meta-nav">&rarr; </span>' . '</a>';
         } else {
             $text = implode(' ', $words);
         }
     }
     return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
if ($iced_mocha_excerpttags=='Enable') {
     remove_filter('get_the_excerpt', 'wp_trim_excerpt');
     add_filter('get_the_excerpt', 'iced_mocha_trim_excerpt');
}


/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Iced Mocha Theme's style.css.
 *
 * @since iced_mocha 0.5
 * @return string The gallery style filter, with the styles themselves removed.
 */
function iced_mocha_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'iced_mocha_remove_gallery_css' );


if ( ! function_exists( 'iced_mocha_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since iced_mocha 0.5
 */
function iced_mocha_posted_on() {
     global $iced_mochas;
     foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }	
	 
	 // If single page take appropiate settings
	 if (is_single()) {$iced_mocha_blog_show = $iced_mocha_single_show;}

	// Post Author
	$output="";
	 if ($iced_mocha_blog_show['author']) {
     $output .= sprintf( '<span class="author vcard" ><i class="icon-author icon-metas" title="'.__( 'Author ','iced_mocha'). '"></i>  <a class="url fn n" href="%1$s" title="%2$s">%3$s</a> <span class="bl_sep">&#8226;</span></span>',
     		get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'iced_mocha' ), get_the_author() ),
			get_the_author()
				);
	}

     // Post date/time 
	 if ($iced_mocha_blog_show['date'] || $iced_mocha_blog_show['time'] ) { 
		$separator="";$date="";$time ="";
		if ( $iced_mocha_blog_show['date'] && $iced_mocha_blog_show['time'] ) {$separator = " - ";}
		if ($iced_mocha_blog_show['date']) { $date = get_the_date(); }
		if ($iced_mocha_blog_show['time']) { $time = esc_attr( get_the_time() ); }
		$output.='<span class="onDate"><i class="icon-time icon-metas" title="'.__("Date", "iced_mocha").'"></i><a href="'.get_permalink().'" rel="bookmark">'.$date.$separator.$time.'</a></span>';
	}
	// Post categories
     if ($iced_mocha_blog_show['category']) { 
			$output .= '<span class="bl_categ"><i class="icon-folder-open icon-metas" title="'.__("Categories", "iced_mocha").'"></i>'.get_the_category_list( ', ' ).'</span> ' ;
		}
		echo $output;
	
}; // iced_mocha_posted_on()
endif;


if ( ! function_exists( 'iced_mocha_posted_after' ) ) :
/**
 * Prints HTML with tags information for the current post. ALso adds the edit button.
 *
 * @since iced_mocha 0.9
 */
function iced_mocha_posted_after() { 
	global $iced_mochas;
    foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }	

	$tag_list = get_the_tag_list( '', ', ' );
     if ( $tag_list && ($iced_mocha_blog_show['tag']) ) { ?>
		<span class="footer-tags"><i class="icon-tag icon-metas" title="<?php _e( 'Tags','iced_mocha'); echo '"> </i>'.$tag_list; ?> </span>
     <?php }
	edit_post_link( __( 'Edit', 'iced_mocha' ), '<span class="edit-link icon-metas"><i class="icon-edit  icon-metas"></i> ', '</span>' );
	espresso_theme_post_footer_hook();  ?>
<?php
}; // iced_mocha_posted_after()
endif;

function iced_mocha_meta_infos() {
	global $iced_mochas;
    foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }	
switch($iced_mocha_metapos):

	case "Bottom":
		add_action('espresso_theme_post_after_content_hook','iced_mocha_posted_on',10);
		add_action('espresso_theme_post_after_content_hook','iced_mocha_posted_after',11);
		add_action('espresso_theme_post_after_content_hook','iced_mocha_comments_on',12);
	break;
	
	case "Top":
	if( !is_single()) { 
		add_action('espresso_theme_post_meta_hook','iced_mocha_posted_on',10);
		add_action('espresso_theme_post_meta_hook','iced_mocha_posted_after',11);
		add_action('espresso_theme_post_meta_hook','iced_mocha_comments_on',12);
	}
	break;
	
	default:
	break;
	
endswitch;

}

add_action('wp_head','iced_mocha_meta_infos');


// Remove category from rel in categry tags.
add_filter( 'the_category', 'iced_mocha_remove_category_tag' );
add_filter( 'get_the_category_list', 'iced_mocha_remove_category_tag' );


function iced_mocha_remove_category_tag( $text ) {
     $text = str_replace('rel="category tag"', 'rel="tag"', $text); return $text;
}


if ( ! function_exists( 'iced_mocha_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since iced_mocha 0.5
 */
function iced_mocha_posted_in() {
	global $iced_mochas;
    foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }	
	
	if ($iced_mocha_single_show['tag'] || $iced_mocha_single_show['bookmark']) :
		// Retrieves tag list of current post, separated by commas.
		$posted_in="";
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list && $iced_mocha_single_show['tag'] ) {
			$posted_in .=  '<span class="footer-tags"><i class="icon-tag icon-metas" title="'.__( 'Tagged','iced_mocha').'"></i>&nbsp; %2$s.</span>';
		} 
		if ($iced_mocha_single_show['bookmark'] ) {
			$posted_in .= '<span class="bl_bookmark"><i class="icon-bookmark icon-metas" title="'.__(' Bookmark the permalink','iced_mocha').'"></i> <a href="%3$s" title="'.__('Permalink to','iced_mocha').' %4$s" rel="bookmark"> '.__('Bookmark','iced_mocha').'</a>.</span>';
		}

		// Prints the string, replacing the placeholders.
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	endif;
}; // iced_mocha_posted_in()
endif;

if ( ! function_exists( 'iced_mocha_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function iced_mocha_content_nav( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<i class="meta-nav-prev"></i> <span>Older posts</span>', 'iced_mocha' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( '<span>Newer posts</span> <i class="meta-nav-next"></i>', 'iced_mocha' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}; // iced_mocha_content_nav()
endif; // iced_mocha_content_nav

// Custom image size for use with post thumbnails
if ($iced_mocha_fcrop) add_image_size( 'custom', $iced_mocha_fwidth, $iced_mocha_fheight, true );
                else add_image_size( 'custom', $iced_mocha_fwidth, $iced_mocha_fheight );


function espresso_theme_echo_first_image ($postID)
{
	$args = array(
	'numberposts' => 1,
	'orderby'=> 'none',
	'post_mime_type' => 'image',
	'post_parent' => $postID,
	'post_status' => 'any',
	'post_type' => 'any'
	);

	$attachments = get_children( $args );
	//print_r($attachments);

	if ($attachments) {
		foreach($attachments as $attachment) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'custom' )  ? wp_get_attachment_image_src( $attachment->ID, 'custom' ) : wp_get_attachment_image_src( $attachment->ID, 'custom' );

			return $image_attributes[0];

		}
	}
}; // echo_first_image()

if ( ! function_exists( 'iced_mocha_set_featured_thumb' ) ) :
/**
 * Adds a post thumbnail and if one doesn't exist the first image from the post is used.
 */
function iced_mocha_set_featured_thumb() {
	global $iced_mochas;
	foreach ($iced_mochas as $key => $value) { ${"$key"} = $value; }
     global $post;

     $image_src = espresso_theme_echo_first_image($post->ID);
     if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $iced_mocha_fpost=='Enable')
			the_post_thumbnail( 'custom', array("class" => "align".strtolower($iced_mocha_falign)." post_thumbnail" ) );
	else if ($iced_mocha_fpost=='Enable' && $iced_mocha_fauto=="Enable" && $image_src )
			echo '<a title="'.the_title_attribute('echo=0').'" href="'.get_permalink().'" ><img width="'.$iced_mocha_fwidth.'" title="" alt="" class="align'.strtolower($iced_mocha_falign).' post_thumbnail" src="'.$image_src.'"></a>' ;

};
endif; // iced_mocha_set_featured_thumb

if ($iced_mocha_fpost=='Enable' && $iced_mocha_fpostlink) add_filter( 'post_thumbnail_html', 'iced_mocha_thumbnail_link', 10, 3 );

/**
 * The thumbnail gets a link to the post's page
 */
function iced_mocha_thumbnail_link( $html, $post_id, $post_image_id ) {
     $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" alt="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
     return $html;
}; // iced_mocha_thumbnail_link()

?>