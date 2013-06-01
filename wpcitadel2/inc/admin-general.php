<?php defined('ABSPATH') or die('No direct script access.');

$css = array('normalize','qunit');
$js = array('jquery','modernizr','qunit','jquery-countdown','jquery-mobile');

if ( isset($_POST['update']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->options['extra_head']	= $this->save($_POST['extra_head']);
	$this->options['extra_foot']	= $this->save($_POST['extra_foot']);
	$this->options['load_css']		= join(',', $_POST['load_css']);
	$this->options['load_js']		= join(',', $_POST['load_js']);
	$this->options['noautop']		= $_POST['noautop'];
	$this->options['nosmartq']		= $_POST['nosmartq'];
	update_option($this->opt_name, $this->options);
}
//----------------------------------------------------------------
$extra_head = ( $this->options['extra_head'] ) ? $this->html_decode($this->options['extra_head']) : '';
$extra_foot = ( $this->options['extra_foot'] ) ? $this->html_decode($this->options['extra_foot']) : '';
$arr_js  = ( $this->options['load_js'] )  ? $this->explode(',', $this->options['load_js'])  : array();
$arr_css = ( $this->options['load_css'] ) ? $this->explode(',', $this->options['load_css']) : array();
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('General Options', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<table class='form-table' summary=''><tbody>

<tr>
	<th><?php _e('Extra Head', 'wpcitadel'); ?></th>
	<td>
		<p class='description'><?php _e('Insert additional stuff into &lt;head&gt; ... &lt;/head&gt;. Useful to insert meta tags for site verification.', 'wpcitadel'); ?></p>
		<textarea cols='50' rows='5' class='large-text code' name='extra_head'><?php echo $extra_head; ?></textarea>
	</td>
</tr>

<tr>
	<th><?php _e('Extra Foot', 'wpcitadel'); ?></th>
	<td>
		<p class='description'><?php _e('Insert additional stuff into area before &lt;/body&gt; and &lt;/html&gt;. Useful to insert tracking pixels, javascript for website performance tracking.', 'wpcitadel'); ?></p>
		<textarea cols='50' rows='5' class='large-text code' name='extra_foot'><?php echo $extra_foot; ?></textarea>
	</td>
</tr>

<tr>
	<th><?php _e('Load WP Citadel CSS', 'wpcitadel'); ?></th>
	<td class='checkboxes'><?php
		foreach ( $css as $i)
		{
			echo "<p><input type='checkbox' name='load_css[]' value='".$i."'";
			echo ( in_array($i, $arr_css) ) ? " checked='checked'" : '';
			echo " /> ".$i."</p>";
		}
	?></td>
</tr>

<tr>
	<th><?php _e('Load WP Citadel JS', 'wpcitadel'); ?></th>
	<td class='checkboxes'><?php
		foreach ( $js as $i)
		{
			echo "<p><input type='checkbox' name='load_js[]' value='".$i."'";
			echo ( in_array($i, $arr_js) ) ? " checked='checked'" : '';
			echo " /> ".$i."</p>";
		}
	?></td>
</tr>

<tr>
	<th><?php _e('WP Auto-Paragraphing', 'wpcitadel'); ?></th>
	<td>
		<p class='description'><?php _e('By default, WordPress will replaces double line-breaks with paragraph elements. If you find it keep messing up your formatting, you can disable it here.', 'wpcitadel'); ?></p>

		<input type="radio" name="noautop" value="1" <?php if ( $this->options['noautop'] ) echo "checked='checked'"; ?> />
		<?php _e('Yes, disable it.', 'wpcitadel'); ?>

		<br />

		<input type="radio" name="noautop" value="0" <?php if ( !$this->options['noautop'] ) echo "checked='checked'"; ?> />
		<?php _e('No, leave it alone.', 'wpcitadel'); ?>

	</td>
</tr>

<tr>
	<th><?php _e('WP Smart Quotes', 'wpcitadel'); ?></th>
	<td>
		<p class='description'><?php _e('By default, WordPress will replaces quotes symbols with smart quotes (or curly quotes). If you find it annoying, you can disable it here.', 'wpcitadel'); ?></p>

		<input type="radio" name="nosmartq" value="1" <?php if ( $this->options['nosmartq'] ) echo "checked='checked'"; ?> />
		<?php _e('Yes, disable it.', 'wpcitadel'); ?>

		<br />

		<input type="radio" name="nosmartq" value="0" <?php if ( !$this->options['nosmartq'] ) echo "checked='checked'"; ?> />
		<?php _e('No, leave it alone.', 'wpcitadel'); ?>

	</td>
</tr>

</tbody></table>

<p class='submit'>
	<input name="update" type="submit" class="button-primary big-button" value="<?php _e('Save Settings', 'wpcitadel'); ?>" />
</p>

</form>
</div>

<?php
// http://disqus.com/ (comment)
// use custom favicon (upload?)
// use custom social icons (disable for plugin conflict?)
