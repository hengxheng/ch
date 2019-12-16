<?php
/**
 * The template for displaying search results pages
 */

get_header();

global $wp_query;
$total_results = $wp_query->found_posts;
?>

<section id="primary" class="content-area search-page">
	<div class="content-inner withPadding">
		<h2 class="search-page-title"><strong>Number of results:</strong>
		<span><?= $total_results ?></span></h2>
		<div class="search-result-block">
		<?php if ( have_posts() ) : 
			while ( have_posts() ) :
				the_post();
?>
			<article id="post-<?php the_ID(); ?>" class="search-result-item">
				<div class="sr-left">
					<h3 class="entry-title">
						<?php
						the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );
						?>
					</h3>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="sr-right">
					<a href="<?=get_permalink(); ?>" class="blk-btn" rel="bookmark">VISIT PAGE</a>
				</div>
			</article>
		<?php
			endwhile;
		?>		
		<div class="post-pagination">	
			<?= twentynineteen_the_posts_navigation(); ?>
		</div>
		<?php
			else :
		?>
		<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
		<?php
		endif;
		?>
		</div>
		</div>
	</section><!-- #primary -->

<?php
get_footer();
