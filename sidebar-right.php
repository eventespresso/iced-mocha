<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package Iced Mocha
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */

/* This  retrieves  admin options. */
$iced_mochas = iced_mocha_get_theme_options();
foreach ($iced_mochas as $key => $value) { ${"$key"} = esc_attr($value); }
?>
		<div id="secondary" class="widget-area sidey" role="complementary">
		<?php espresso_theme_before_primary_widgets_hook(); ?>

			<ul class="xoxo">
				<?php if($iced_mocha_socialsdisplay2) { ?>
					<li id="socials-left" class="widget-container">
					<?php iced_mocha_smenur_socials(); ?>
					</li>
				<?php } ?>
				<?php if (is_active_sidebar('right-widget-area')): dynamic_sidebar( 'right-widget-area' );
                                                           else: ?>
				<li class="widget-container widget-placeholder">
					<h3 class="widget-title"><?php _e('Right Sidebar','iced_mocha'); ?></h3>
					<p><?php
					printf( __('You currently have no widgets set in the right sidebar. You can add widgets via the <a href="%s">Dasboard</a>.','iced_mocha'),esc_url( admin_url()."widgets.php") ); echo "<br/>";
					printf( __('To hide this sidebar, switch to a different Layout via the <a href="%s">Theme Settings</a>.','iced_mocha'), esc_url( admin_url()."themes.php?page=iced_mocha-page") );
					?></p>
				</li>
				<?php endif; ?>
			</ul>

			<?php espresso_theme_after_primary_widgets_hook(); ?>

		</div>
