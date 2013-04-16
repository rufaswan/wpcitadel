<?php
//header('Content-type: text/css');
header('Content-type: text/javascript');
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));

echo file_get_contents('js/console.js');
$js = array(
	'jquery'					=> 'jquery-1.9.1.min.js',
	'modernizr'					=> 'modernizr-2.6.2.min.js',
	'qunit'						=> 'qunit-1.11.0.js',
	'jquery-mobile'				=> 'jquery.mobile-1.3.0.min.js',
	'jquery-countdown'			=> 'jquery.countdown-1.6.1.min.js',
);

$q = explode(',', $_GET['q']);
if ( !$q ) die();

foreach ( $q as $i )
	echo file_get_contents('js/' .$js[$i]);
