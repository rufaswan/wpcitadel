<?php defined('ABSPATH') or die('No direct script access.');

global $wpdb;
//---------------------------------------------------------------
// upperland - no return / notice only submits
//---------------------------------------------------------------
if ( isset($_POST['reset_options']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	delete_option($this->opt_name);	// delete options
	$this->init();	// initialize again
	echo "<div id='message' class='updated fade'><p><b>Options Reset</b></p></div>";
}
//---------------------------------------------------------------
if ( isset($_POST['delete_revisions']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$wpdb->query( 'DELETE FROM '.$wpdb->posts.' WHERE post_type = "revision";' );
	echo "<div id='message' class='updated fade'><p><b>Revision Posts Removed</b></p></div>";
}
//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap maintenance'>
<h2><?php _e('Maintainance Mode', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<div class='postbox'>
	<input name="reset_options" type="submit" class="button-primary big-button" value="<?php _e('Reset Options', 'wpcitadel'); ?>" />
	<p><b><?php _e('Reset all WP Citadel options to its default value.', 'wpcitadel'); ?></b></p>
</div>

<div class='postbox'>
	<input name="delete_revisions" type="submit" class="button-primary big-button" value="<?php _e('Delete Revisions', 'wpcitadel'); ?>" />
	<p><b><?php _e('Remove all WP post revisions from database', 'wpcitadel'); ?></b></p>
</div>

<div class='postbox'>
	<input name="show_options" type="submit" class="button-primary big-button" value="<?php _e('Show Options', 'wpcitadel'); ?>" />
	<p><b><?php _e('Show all values for WP Citadel options.', 'wpcitadel'); ?></b></p>
</div>

<div class='postbox'>
	<input name="fileperm" type="submit" class="button-primary big-button" value="<?php _e('File Permission', 'wpcitadel'); ?>" />
	<p><b><?php _e('Check for file permission.<br />DIR = 755, FILE = 644,<br />Upload/Cache DIR = 777 or 775', 'wpcitadel'); ?></b></p>
</div>

<div class='postbox'>
	<input name="filemtime" type="submit" class="button-primary big-button" value="<?php _e('Modified in 7 Days', 'wpcitadel'); ?>" />
	<p><b><?php _e('Show all files modified within 7 days.', 'wpcitadel'); ?></b></p>
</div>

<div class='postbox'>
</div>

<?php
//---------------------------------------------------------------
// lowerland - display table / data submits
//---------------------------------------------------------------
if ( isset($_POST['show_options']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	?><table class='widefat' summary=''>
	<thead><tr><th>Key</th><th>Value</th></tr></thead>
	<tbody><?php
	foreach($this->options as $name => $value)
	{
		echo "<tr><td>" . $name . "</td><td>";
		echo ( $value ) ? nl2br($value) : '-';
		echo "</td></tr>\n";
	}
	?></tbody></table><?php
}
//---------------------------------------------------------------
if ( isset($_POST['fileperm']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	// dir = 755 (rwxr-xr-x), file = 644 (rw-r--r--)
	$dirperm	= '755';
	$fileperm	= '644';

	$p = new citadel_recursive;
	$p->fperm(ABSPATH);
	$list = $p->get_list();
	//print_r($list);
	//echo "<tr><td>".$v1."</td></tr>";

	?><table class='widefat' summary=''>
	<thead><tr><th>File</th><th>Permission</th><th>&nbsp;</th></tr></thead>
	<tbody><?php
	foreach ( $list['dir'] as $k => $v)
	{
		$v1 = $p->sub_perms($v);
		echo "<tr><td>( DIR ) " .$k. "</td><td>" .sprintf('%o', $v). "</td>";
		echo ( $v1 == $dirperm ) ? "<td style='color:#0f0;'>OK</td>" : "<td style='color:#f00;'>NOT OK</td>" ;
		echo "</tr>";
	}
	foreach ( $list['file'] as $k => $v)
	{
		$v1 = $p->sub_perms($v);
		echo "<tr><td>( FILE ) " .$k. "</td><td>" .sprintf('%o', $v). "</td>";
		echo ( $v1 == $fileperm ) ? "<td style='color:#0f0;'>OK</td>" : "<td style='color:#f00;'>NOT OK</td>" ;
		echo "</tr>";
	}
	?></tbody></table><?php
}
//---------------------------------------------------------------
if ( isset($_POST['filemtime']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$time = current_time('timestamp');
	// 7 days = 60 * 60 * 24 * 7
	$limit = $time - ( 60 * 60 * 24 * 7 );
	$limit2 = $time - ( 60 * 60 * 24 * 3 );

	$p = new citadel_recursive;
	$p->fmtime(ABSPATH);
	$list = $p->get_list();
	//print_r($list);

	foreach ( $list as $k => $v)
		if ( $v < $limit )
			unset($list[$k]);

	?><table class='widefat' summary=''>
	<thead><tr><th><?php echo date('j M g:i A', $limit); ?> - <?php echo date('j M g:i A', $time); ?></th><th>Modified</th></tr></thead>
	<tbody><?php
	if ( empty($list) )
		echo "<tr><td>No file modified within last 7 days</td><td>-</td></tr>";
	else
	{
		foreach ( $list as $k => $v)
		{
			$color = ( $v > $limit2 ) ? '#ff0' : '#fff';
			echo "<tr style='background:" .$color. "'><td>" .$k. "</td><td>" .$this->relative_time($v - $time). "</td></tr>";
		}
	}
	?></tbody></table><?php
}
//---------------------------------------------------------------
//---------------------------------------------------------------
// delete cookies
// check broken links
// check broken imgs

// testing area
//---------------------------------------------------------------
//echo "<pre>***Test area***\n";



//$images = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'posts WHERE post_mime_type LIKE "image%";' );
//echo "\n***Test area***</pre>";
//---------------------------------------------------------------
?>
</form>
</div>
