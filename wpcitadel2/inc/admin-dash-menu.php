<?php defined('ABSPATH') or die('No direct script access.');

$this->pages = array();

// add_menu_page(page_title, menu_title,
//     capability, handle, [function], [icon_url]);
$hook = add_menu_page('Citadel Menu', 'Citadel Menu',
	'administrator', 'general', array($this, 'general'));
$this->pages[] = $hook;

$subloop = array(
	array('Page: Contact Us', 'page_contactform'),
	array('Page: About Us', 'page_aboutus'),
	array('Page: Sitemap', 'page_sitemap'),
	array('Count Down', 'countdown'),
	array('Stylesheet', 'sass'),
	array('PHP Shortcode', 'phpcode'),
	array('Maintenance', 'maintenance'),
	array('Broken Links', 'brokenlinks'),
	array('Feedback', 'feedback'),
	array('License', 'license')
);

foreach ( $subloop as $k => $v )
{
	// add_submenu_page(parent, page_title, menu_title,
	//    capability, file/handle, [function]);
	$hook = add_submenu_page('general', 'Citadel '.$v[0], $v[0],
		'administrator', $v[1], array($this, $v[1]));
	$this->pages[] = $hook;
}

// load citadel js and css to citadel admin pages only
foreach ( $this->pages as $hook)
	add_action( 'load-' . $hook, array($this, 'admin_init') );
