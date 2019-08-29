<?php
/**
 * The header for our theme
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all">
</head>

<body>
<?php wp_body_open(); ?>
<header id="masthead" class="site-header">
	<div class="header-top">
		<div class="content-inner">
			<div class="social-top-menu">
				<ul>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					<li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="header-middle">
		<div class="content-inner">
			<div class="col-2-section">
				<div class="site-description">
					<?php echo get_bloginfo( 'description', 'display' ); ?>
				</div>
				<nav class="secondary-menu">
					<ul>
						<li><a href="#"><i class="fa fa-user-circle-o"></i> MY ACCOUNT</a></li>		
						<li><a href="#">SHOP</a></li>
						<li><a href="#"><i class="fa fa-shopping-cart"></i> 0 ITEMS - $0.00</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="header-bottom">
		<div class="content-inner">
			<div class="col-2-section">
				<div class="site-logo"><?php the_custom_logo(); ?></div>
				<nav id="site-navigation" class="main-navigation">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_class'     => 'main-menu',
								'after'	=> '<span>|</span> ',
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							)
						);
					?>
				</nav>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
