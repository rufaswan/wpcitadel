<?php
// for mobile autodetect
$citadel_mobile = 1;
$citadel_locked = 1;

// join and compress all wordpress built-in js for faster loading
$compress_scripts		= true;
$concatenate_scripts	= true;
$compress_css			= true;

// remove wordpress version from display on html source for security
remove_action('wp_head', 'wp_generator');

//===============================================================
// add theme support
// force support up to wp 3.3
set_post_thumbnail_size( 200, 200, true );		// wp2.9
add_theme_support( 'post-thumbnails' );			// wp2.9
add_theme_support( 'automatic-feed-links' );	// wp3.0

if ( version_compare( $wp_version, '3.3', '>=' ) )
{
	add_theme_support( 'custom-header' );			// wp3.4
	add_theme_support( 'custom-background' );		// wp3.4
}
//===============================================================
