<?php defined('ABSPATH') or die('No direct script access.'); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php
		// Print the <title> tag based on what is being viewed.
		global $page, $paged;
		wp_title( '|', true, 'right' );

		// Add the blog name.
		echo $ccache['blogname'];

		// Add the blog description for the home/front page.
		if ( $ccache['blogtag'] && ( is_home() || is_front_page() ) )
			echo " | " . $ccache['blogtag'];

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'wpcitadel' ), max( $paged, $page ) );

		?></title>
	<meta name="viewport" content="width=device-width" />

	<!-- to be insert by wordpress and its plugins -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
