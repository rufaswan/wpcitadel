<?php
// for mobile autodetect
$mobile = 1;

// join and compress all wordpress built-in js for faster loading
$compress_scripts		= true;
$concatenate_scripts	= true;
$compress_css			= true;
$ccache['home']			= get_option('home') . '/';
$ccache['siteurl']		= get_option('siteurl');
$ccache['permalink']	= get_option('permalink_structure');
$ccache['blogname']		= esc_attr( get_bloginfo( 'name', 'display' ) );
$ccache['blogtag']		= get_bloginfo( 'description', 'display' );
$ccache['template_url']	= get_bloginfo('template_url');
$ccache['child_url']	= get_stylesheet_directory_uri();
$ccache['rss2_url']		= get_bloginfo('rss2_url');

// remove wordpress version from display on html source for security
remove_action('wp_head', 'wp_generator');

//===============================================================
// add theme support
if ( version_compare( $wp_version, '3.4', '>=' ) )
{
	set_post_thumbnail_size( 200, 200, true );		// wp2.9
	add_theme_support( 'post-thumbnails' );			// wp2.9
	add_theme_support( 'automatic-feed-links' );	// wp3.0
	add_theme_support( 'custom-header' );			// wp3.4
	add_theme_support( 'custom-background' );		// wp3.4
}
//===============================================================
