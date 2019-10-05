<?php
get_header();
?>

<section id="primary" class="content-area article-single-page-main">
	<?php
		/* Start the Loop */
		while ( have_posts() ): the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
		endwhile;
	?>
</section>

<?php
get_footer();
