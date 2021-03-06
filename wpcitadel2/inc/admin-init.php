<?php defined('ABSPATH') or die('No direct script access.');

$theme_data = get_file_data(
	$this->ccache['child_path']."/style.css",
	array(
		"Theme Name" => "Theme Name",
		"Theme URI" => "Theme URI",
		"Author" => "Author",
		"Author URI" => "Author URI"
	)
);

// set the defaults
$default_options = array(
	'child_theme'  => $theme_data['Theme Name'],
	'child_author' => $theme_data['Author'],
	'child_url'    => $theme_data['Author URI'],
	'noautop'      => false,
	'nosmartq'     => false,
	'sitelocked'   => false,
	'sitelockuser' => '',
	'load_js'      => 'jquery,modernizr,jquery-countdown',
	'load_css'     => 'normalize',
	'extra_head'   => '',
	'extra_foot'   => '',
	'sitemap'      => 'posts-by-alpha,categories',
	'contact_sentto' => '',
	'cnt_time' => time() + 365*24*60*60,
	'cnt_form' => '',
	'about_name'    => '',
	'about_desc'    => '',
	'about_address' => '',
	'about_phone'   => '',
	'about_hours'   => '',
	'about_facebook'   => '',
	'about_twitter'    => '',
	'about_googleplus' => '',
	'' => ''
);

// update your default settings...
$options = get_option($this->opt_name);
if ( $options )
	foreach ($options as $key => $value)
	{
		// prune depcreated keys
		if ( isset($default_options[$key]) )
			$default_options[$key] = $value;
	}

// ... and back to database, just in case you have new stuffs in defaults
update_option($this->opt_name, $default_options);

// to ensure your current options is same as the defaults
$this->options = $default_options;
//----------------------------------------------------------------
// get existing phpcodes
$codes = get_option($this->code_name);
$this->phpcodes = ( empty($codes) ) ? array() : $codes;
//----------------------------------------------------------------
// READ MORE: PHP heredoc / nowdoc syntax
$sass = get_option($this->sass_name);
$this->sass = ( empty($sass) ) ? file_get_contents( $this->getfile('/file/child.scss', 1) ) : $sass;
//----------------------------------------------------------------
//----------------------------------------------------------------

