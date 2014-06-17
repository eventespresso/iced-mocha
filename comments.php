<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to iced_mocha_comment which is
 * located in the includes/theme-comments.php file.
 *
 * @package Iced Mocha
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */

$iced_mochas = iced_mocha_get_theme_options();
foreach ($iced_mochas as $key => $value) { ${"$key"} = esc_attr($value) ; }
$iced_mocha_comclass='';
if ( (!comments_open()) && (get_comments_number()<1) && 
(($iced_mocha_comclosed=="Hide everywhere") || (is_page() && $iced_mocha_comclosed=="Hide in pages") || (is_single() && $iced_mocha_comclosed=="Hide in posts") )) : $iced_mocha_comclass="hideme"; endif;
?> <div id="comments" class="<?php echo $iced_mocha_comclass ?>"> <?php
if (get_comments_number()<1):

else:
	if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'iced_mocha' ); ?></p>
		</div><!-- #comments --> <?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;

	// You can start editing here -- including this comment!

	if ( have_comments() ) : espresso_theme_before_comments_hook(); ?>
	<ol class="commentlist">
		<?php espresso_theme_comments_hook(); ?>
	</ol>
	<?php espresso_theme_after_comments_hook(); 
	else : // or, if we don't have comments:
		espresso_theme_nocomments_hook();
	endif; // end have_comments() ?>


<?php
endif; 
?>
<?php if ( comments_open() ): comment_form(); 
	  else : ?> <p class="nocomments<?php if (is_page()) echo "2"; ?>"><?php _e("Comments are closed","iced_mocha");?></p> <?php
	  endif; ?>
</div><!-- #comments -->
