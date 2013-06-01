<?php defined('ABSPATH') or die('No direct script access.');

// update options for use in this function
$this->init();
$template = 'page-aboutus.php';

if ( isset($_POST['createpage']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->create_page('About Us', 'about-us', $template);
}

if ( isset($_POST['update']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->options['about_name']		= $this->save($_POST['about_name']);
	$this->options['about_desc']		= $this->save($_POST['about_desc']);
	$this->options['about_address']		= $this->save($_POST['about_address']);
	$this->options['about_phone']		= $this->save($_POST['about_phone']);
	$this->options['about_hours']		= $this->save($_POST['about_hours']);
	$this->options['about_facebook']	= $_POST['about_facebook'];
	$this->options['about_twitter']		= $_POST['about_twitter'];
	$this->options['about_googleplus']	= $_POST['about_googleplus'];
	update_option($this->opt_name, $this->options);
}
//----------------------------------------------------------------
$pages = get_pages(array(
	'hierarchical'	=> 0,
	'meta_key'		=> '_wp_page_template',
	'meta_value'	=> $template
));
$address = "1600 Pennsylvania Avenue \nNW Washington, D.C. \n20500 U.S.A.";
if ( empty($this->options['about_address']) )
	$this->options['about_address'] = $address;

$default = <<< _OVER
Based on Model under MVC (or Model-View-Controller) design pattern, WP Citadel aims to be The Engine for higher flexibility and faster theme development.

If you find our theme useful, please consider donate to support our work.

Thanks,
WP Citadel Team
_OVER;
$overview = ( $this->options['about_desc'] ) ? $this->html_decode( $this->options['about_desc'] ) : $default;

//----------------------------------------------------------------
// vision
// mission
// contact skype
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('Page Template: About Us', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<div class='msgbox'>
<?php if ( $pages ) : ?>
	<p>PAGE : <?php foreach ( $pages as $p )
		echo "<a href='" .$p->guid. "' rel='nofollow'>" .$p->post_title. "</a> ";
	?></p>
<?php else : ?>
	<input type='submit' name='createpage' class='button-primary big-button' value='Create' />
	<?php _e('It seems you haven&#039;t use this page template in any pages yet. Do you want to make a sample page now?', 'wpcitadel'); ?>
<?php endif; ?>
</div>

<table class='form-table' summary=''><tbody>

<tr>
	<th><?php _e('Name', 'wpcitadel'); ?></th>
	<td><input type='text' name='about_name' class='large-text code'
		value="<?php echo ( $this->options['about_name'] ) ? $this->options['about_name'] : ''; ?>"
		placeholder='WP Citadel (demo)' /></td>
</tr>

<tr>
	<th><?php _e('Overview', 'wpcitadel'); ?></th>
	<td><?php wp_editor($overview, 'about_desc'); ?></td>
</tr>

<tr>
	<th><?php _e('Address', 'wpcitadel'); ?></th>
	<td><textarea cols='50' rows='3' class='large-text code' name='about_address'
		placeholder='<?php echo $address; ?>'><?php echo $this->options['about_address']; ?></textarea></td>
</tr>

<tr>
	<th><?php _e('Phone Number', 'wpcitadel'); ?></th>
	<td><input type='tel' name='about_phone' class='large-text code'
		value="<?php echo ( $this->options['about_phone'] ) ? $this->options['about_phone'] : ''; ?>"
		placeholder='+123456789 (demo)' /></td>
</tr>

<tr>
	<th><?php _e('Business Hours', 'wpcitadel'); ?></th>
	<td><textarea cols='50' rows='2' class='large-text code' name='about_hours'
		placeholder='Monday - Friday : 9am to 5pm'><?php echo $this->options['about_hours']; ?></textarea></td>
</tr>

<tr>
	<th><?php _e('Follow: Facebook', 'wpcitadel'); ?></th>
	<td><input type='url' name='about_facebook' class='large-text code'
		value="<?php echo ( $this->options['about_facebook'] ) ? $this->options['about_facebook'] : ''; ?>"
		placeholder='https://www.facebook.com/rufaswan (demo)' /></td>
</tr>

<tr>
	<th><?php _e('Follow: Twitter', 'wpcitadel'); ?></th>
	<td><input type='url' name='about_twitter' class='large-text code'
		value="<?php echo ( $this->options['about_twitter'] ) ? $this->options['about_twitter'] : ''; ?>"
		placeholder='https://twitter.com/RufasWan (demo)' /></td>
</tr>

<tr>
	<th><?php _e('Follow: GooglePlus', 'wpcitadel'); ?></th>
	<td><input type='url' name='about_googleplus' class='large-text code'
		value="<?php echo ( $this->options['about_googleplus'] ) ? $this->options['about_googleplus'] : ''; ?>"
		placeholder='https://plus.google.com/u/0/118400319415336869294 (demo)' /></td>
</tr>

</tbody></table>

<p class='submit'>
	<input name="update" type="submit" class="button-primary big-button" value="<?php _e('Save Settings', 'wpcitadel'); ?>" />
</p>

<?php
/*
<tr>
	<th><?php _e('', 'wpcitadel'); ?></th>
	<td></td>
</tr>
*/
?>
</form>
</div>
