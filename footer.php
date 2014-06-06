<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package Event Espresso - Iced Mocha Theme
 * @subpackage iced_mocha
 * @since iced_mocha 0.5
 */
?>	<div style="clear:both;"></div>
	</div> <!-- #forbottom -->


	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->

		<div id="footer2">
		
			<?php espresso_theme_footer_hook(); ?>
			
		</div><!-- #footer2 -->

	</footer><!-- #footer -->

	</div><!-- #main -->
</div><!-- #wrapper -->


<?php	wp_footer(); ?>

</body>
</html>
