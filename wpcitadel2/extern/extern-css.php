<?php
header('Content-type: text/css');
//header('Content-type: text/javascript');
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));

echo file_get_contents('../style.css');
$css = array(
	'normalize'	=> 'normalize-2.1.0.css',
	'qunit'		=> 'qunit-1.11.0.css'
);

$q = explode(',', $_GET['q']);
if ( !$q ) die();

foreach ( $q as $i )
	echo file_get_contents('css/'. $css[$i]);
