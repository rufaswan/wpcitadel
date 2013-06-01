<?php defined('ABSPATH') or die('No direct script access.');

wp_register_style('cdl_admin_css', $this->ccache['base_url'] . '/file/admin.css');
wp_enqueue_style('cdl_admin_css');

//wp_deregister_script('jquery');
//wp_register_script('jquery',			$this->ccache['base_url'] . '/extern/js/jquery-1.9.1.min.js');
wp_register_script('modernizr',			$this->ccache['base_url'] . '/extern/js/modernizr-2.6.2.min.js');
wp_register_script('qunit',				$this->ccache['base_url'] . '/extern/js/qunit-1.11.0.js',					array('jquery'));
wp_register_script('jquery-countdown',	$this->ccache['base_url'] . '/extern/js/jquery.countdown-1.6.1.min.js',	array('jquery'));
wp_register_script('jquery-mobile',		$this->ccache['base_url'] . '/extern/js/jquery.mobile-1.3.0.min.js',		array('jquery'));
wp_register_script('cdl_admin_js',		$this->ccache['base_url'] . '/file/admin.js', array('jquery'));

wp_enqueue_script('jquery');
wp_enqueue_script('cdl_admin_js');
