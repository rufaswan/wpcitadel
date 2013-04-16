<?php defined('TEMPLATEPATH') or die('No direct script access.');

?>
<div id='cdlmenu' class='wrap license'>
<h2><?php _e('Software License', 'wpcitadel'); ?></h2>

<table class='widefat' summary=''>
<thead>
<tr>
	<th>Name</th>
	<th>Version</th>
	<th>License</th>
	<th>URL</th>
</tr>
</thead>
<tbody>
<?php
$script = array(
	array('WordPress',			'http://wordpress.org',						'3.5.1',	'GPL 2.0'),
	array('WP Citadel',			'http://wpcitadel.com',						'2.0',		'GPL 2.0'),
	array('HTML5 Boilerplate',	'http://html5boilerplate.com',				'4.1.0',	''),
	array('scssphp',			'http://leafo.net/scssphp/',				'0.0.5',	'GPL 3.0 / MIT License'),
	array('jQuery',				'http://jquery.com',						'1.9.1',	'MIT License'),
	array('jquery-countdown',	'http://keith-wood.name/countdown.html',	'1.6.1',	'MIT License'),
	array('jquery-mobile',		'http://jquerymobile.com',					'1.3.0',	'MIT License'),
	array('Modernizr',			'http://modernizr.com',						'2.6.2',	'MIT License'),
	array('Normalize',			'http://necolas.github.com/normalize.css/',	'2.1.0',	'MIT License'),
	array('QUnit',				'http://qunitjs.com',						'1.11.0',	'MIT License'),
	array('Somacro: Social Media Icons',	'http://vervex.deviantart.com/art/Somacro-32-300DPI-Social-Media-Icons-267955425',	'Oct 2012',	'CC-SA 3.0'),
	//array('',	'http://',	'',	''),
	//array('',	'http://',	'',	''),
	array('',	'http://',	'',	'')
);

foreach ( $script as $v )
{
	echo "<tr><td>".$v[0]."</td>";
	echo "<td>".$v[2]."</td>";
	echo "<td>".$v[3]."</td>";
	echo "<td><a href='".$v[1]."' target='_blank'>".$v[1]."</a></td></tr>\n";
}
?>
</tbody>
</table>
</div>
