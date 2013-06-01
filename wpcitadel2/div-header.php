<?php defined('ABSPATH') or die('No direct script access.'); ?>

<div id="misc">
	<p class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wpcitadel' ); ?>"><?php _e( 'Skip to content', 'wpcitadel' ); ?></a></p>
	<!--[if lt IE 7]>
	<p class="chromeframe"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.', 'wpcitadel' ); ?></p>
	<![endif]-->
</div>

<header>
	<section id='leftheader'>
	<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo $ccache['blogname']; ?>" />
	<?php else : ?>
		<h1 id="site-title"><a href="<?php echo $ccache['home']; ?>" title="<?php echo $ccache['blogname']; ?>" rel="home"><?php echo $ccache['blogname']; ?></a></h1>
		<div id="site-description"><?php echo $ccache['blogtag']; ?></div>
	<?php endif; ?>
	</section>

	<?php if ( $citadel_options['about_phone'] ) : ?>
	<section id='rightheader'>
		<a href='tel:<?php echo $citadel_options['about_phone']; ?>' class='citadel-btn'>Call Us</a>
	</section>
	<?php endif; ?>

</header>

<nav>
<?php if ( has_nav_menu('header-menu') ) : ?>
	<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
<?php else : ?>
<ul>
<li><a href="<?php echo $ccache['home']; ?>" title='Home' rel='home'><?php _e('Home', 'wpcitadel'); ?></a></li>
<li>
	<?php _e('Categories', 'wpcitadel'); ?><ul>
	<?php
	$arg = array(
		'show_option_all'		=> '',
		'orderby'				=> 'name',
		'order'					=> 'ASC',
		'style'					=> 'list',
		'show_count'			=> 0,
		'hide_empty'			=> 1,
		'use_desc_for_title'	=> 1,
		'hierarchical'			=> 0,
		'title_li'				=> '',
		'show_option_none'		=> __('No categories'),
		'number'				=> null,
		'echo'					=> 0,
		'depth'					=> 1,
		'taxonomy'				=> 'category'
	);
	$cats = wp_list_categories($arg);
	print_r($cats);
	unset($arg, $cats);
	?></ul>
</li>
<li>
	<?php _e('Pages', 'wpcitadel'); ?><ul>
	<?php
	$arg = array(
		'depth'			=> 1,
		'show_date'		=> '',
		'child_of'		=> 0,
		'title_li'		=> '',
		'echo'			=> 0,
		'sort_column'	=> 'menu_order, post_title',
		'post_type'		=> 'page',
		'post_status'	=> 'publish'
	);
	$pages = wp_list_pages($arg);
	print_r($pages);
	unset($arg, $pages);
	?></ul>
</li>
<li>
	<?php _e('Search', 'wpcitadel'); ?>
	<ul><li><?php get_search_form(); ?></li></ul>
</li>
<li>
	<?php _e('Login', 'wpcitadel'); ?><ul>
	<?php if ( is_user_logged_in() ) : ?>
		<li>Hi, <?php echo $user_identity; ?></li>
		<?php wp_register(); ?>
		<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></li>
	<?php else : ?>
		<li><?php wp_login_form(); ?></li>
		<?php wp_register(); ?>
		<li><a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Password</a></li>
	<?php endif; ?>
	</ul>
</li>
</ul>
<?php endif; ?>
</nav>
