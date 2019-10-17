<?php
/**
 * The header for our theme
 */
global $woocommerce;
$item_no = $woocommerce->cart->get_cart_contents_count();
$total_amount = $woocommerce->cart->get_cart_contents_total();
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
<header id="masthead" class="site-header <?= is_admin_bar_showing()?"admin": ""; ?>">
	<div class="header-top">
		<div class="content-inner withPadding">
			<div class="social-top-menu">
				<?php echo do_shortcode('[widget id="custom_html-4"]'); ?>
			</div>
		</div>
	</div>
	<div class="header-middle">
		<div class="content-inner withPadding">
			<div class="col-2-section">
				<div class="site-description">
					<?php echo get_bloginfo( 'description', 'display' ); ?>
				</div>
				<nav class="secondary-menu">
					<ul>
						<li><a href="<?php echo get_site_url() ?>/my-account"><i class="fa fa-user-circle-o"></i> MY ACCOUNT</a></li>		
						<li><a href="#">SHOP</a></li>
						<li><a href="<?php echo get_site_url() ?>/cart"><i class="fa fa-shopping-cart"></i> <span id="header-cart-text"><?=$item_no ?> ITEMS - $<?= $total_amount ?></span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="header-bottom">
		<div class="content-inner withPadding">
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
					<div id="header-search"><a id="header-search-btn" href="#"><i class="fa fa-search"></i></a></div>
				</nav>
			</div>
		</div>
	</div>
	<div class="mobile-header">
		<div class="mh-left">
			<a href="#" id="mb-menu-btn"><i class="fa fa-bars"></i></a>
			<!-- <a href="#" id="mb-menu-btn">
				<div id="nav-icon1">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</a> -->
		</div>
		<div class="mh-middle">
			<div class="site-logo"><?php the_custom_logo(); ?></div>
		</div>
		<div class="mh-right">
			<ul>
				<li><a href="<?php echo get_site_url() ?>/my-account"><i class="fa fa-user-circle-o"></i></a></li>		
				<li><a href="<?php echo get_site_url() ?>/cart"><i class="fa fa-shopping-cart"></i><span id="mh-header-cart"><?=$item_no ?></span></a></li>
			</ul>
		</div>
	</div>
</header><!-- #masthead -->
<div id="mobile-menu-block">
	<div class="mmb-header">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-logo.png"/>
	</div>
	<div class="mmb-sub-header">
		<div class="col-2">
			<a class="mmb-acount" href="<?php echo get_site_url() ?>/my-account"><i class="fa fa-user-circle-o"></i> MY ACCOUNT</a>
		</div>
		<div class="col-2">
			<a class="mmb-cart" href="<?php echo get_site_url() ?>/cart"><i class="fa fa-shopping-cart"></i> <span id="mobile-header-cart"><?=$item_no ?> ITEMS - $<?= $total_amount ?></span></a>
		</div>
	</div>
	<div class="mmb-subscription">
		<form action="#">
			<p>Sign in to join our Clean Health club</p>
			<input type="email" placeholder="Enter your email address here">
		</form>
	</div>
	<div class="mmb-menu">
		<?php
			wp_nav_menu(
				array(
					'menu' => 'mobile-menu',
					'menu_class' => 'mobile-menu',
					'depth' => 2,
				)
			);
		?>
	</div>
	<div class="mmb-social">
		<?php echo do_shortcode('[widget id="custom_html-4"]'); ?>
	</div>
	<div class="mmb-footer-menu">
		<?php
			wp_nav_menu(
				array(
					'menu' => 'mobile-footer',
					'menu_class' => 'footer-mobile-menu',
					'depth' => 1,
				)
			);
		?>
	</div>
</div>	