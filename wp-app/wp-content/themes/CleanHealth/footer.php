<?php
/**
 * The template for displaying the footer
 */

?>


<footer id="colophon" class="site-footer">
	<div class="content-inner">
	<div class="footer-top">
		<div class="footer-col">
			<div class="footer-logo">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.png"/>
			</div>
			<?php echo do_shortcode('[widget id="custom_html-2"]'); ?>
			<div class="footer-social">
				<ul>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					<li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				</ul>
			</div>
			<div class="footer-rologo">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/rto-logo.png"/>
			</div>
		</div>
		<div class="footer-col">
			<div class="footer-col-title">
				LINKS
			</div>
			<nav class="footer-navigation" aria-label="Footer Menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
					)
				);
				?>
			</nav>
		</div>
		<div class="footer-col">
			<div class="footer-col-title">
				INSTAGRAM
			</div>
			<div id="instragram-widget"></div>
		</div>
		<div class="footer-col">
			<div class="footer-col-title">
				CONTACT
			</div>
			<div id="footer-contact">
			</div>
		</div>
			</div>
	</div>
	<div class="footer-bottom">
		<div class="content-inner">
			<p id="copyright">2019 <span>Clean Health Fitness Institute</span>, with All rights reserved.</p>
		</div>
	</div>
</footer><!-- #colophon -->
<?php wp_footer(); ?>

</body>
</html>
