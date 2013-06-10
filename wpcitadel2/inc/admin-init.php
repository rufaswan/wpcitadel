<?php defined('ABSPATH') or die('No direct script access.');

// set the defaults
$default_options = array(
	'noautop' => false,
	'nosmartq' => false,
	'sitelocked' => false,
	'sitelockuser' => '',
	'load_js' => 'jquery,modernizr,jquery-countdown',
	'load_css' => 'normalize',
	'extra_head' => '',
	'extra_foot' => '',
	'sitemap' => 'posts-by-alpha,categories',
	'contact_sentto' => '',
	'cnt_time' => 0,
	'cnt_form' => '',
	'about_name' => '',
	'about_desc' => '',
	'about_address' => '',
	'about_phone' => '',
	'about_hours' => '',
	'about_facebook' => '',
	'about_twitter' => '',
	'about_googleplus' => '',
	'' => '');

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

