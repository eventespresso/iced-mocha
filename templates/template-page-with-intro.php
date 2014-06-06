<?php /*
Template Name: Category page with intro
*/ ?>


<?php get_header(); ?>

<section id="container" class="<?php echo iced_mocha_get_layout_class(); ?>">
	<div id="content" role="main">

	 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'iced_mocha' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'iced_mocha' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php
		$slug = basename(get_permalink());
		$meta_slug = get_post_meta(get_the_ID(), "slug", $single); // slug custom field
		$meta_catid = get_post_meta(get_the_ID(), "catid", $single); // category_id custom field
		$key = get_post_meta(get_the_ID(), "key", $single); // either slug or category_id custom field
		$slug = ($key?$key:($meta_catid?$meta_catid:($meta_slug?$meta_slug:($slug?$slug:0)))); // select one value out of the custom fields 	
		?>
	<?php endwhile; else: endif; ?>
	<br />
	<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if (is_numeric($slug)&&($slug>0)): 
		$the_query = new WP_Query( 'cat='.$slug.'&post_status=publish&orderby=date&order=desc&posts_per_page='.get_option('posts_per_page').'&paged=' . $paged ); 
	else: 
		$the_query = new WP_Query( 'category_name='.$slug.'&post_status=publish&orderby=date&order=desc&posts_per_page='.get_option('posts_per_page').'&paged=' . $paged ); 
	endif; 
	/* Start the Loop */ 
	while ( $the_query->have_posts() ) : $the_query->the_post();
		global $more; $more=0; // more gets lost inside page templates
		get_template_part( 'content/content', get_post_format() ); 
	endwhile;
	if($iced_mocha_pagination=="Enable") iced_mocha_pagination($the_query->max_num_pages); else iced_mocha_content_nav( 'nav-below' );	
	?>
		
	</div><!-- #content -->
	
	<?php iced_mocha_get_sidebar(); ?>
	
</section><!-- #container -->

<?php get_footer(); ?>
