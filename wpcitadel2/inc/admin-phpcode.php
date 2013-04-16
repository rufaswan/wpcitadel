<?php defined('TEMPLATEPATH') or die('No direct script access.');

// update options for use in this function
$this->init();

if ( isset($_POST['update']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->phpcodes = array(); // reset
	foreach ( $_POST['code'] as $k => $v )
	{
		// skip those with missing shortcode or php code
		if ( empty($_POST['php'][$k]) || empty($v) ) continue;
		$v = $this->save($v);
		$this->phpcodes[$v] = $this->save( $_POST['php'][$k] );
		update_option($this->code_name, $this->phpcodes);
	}
}
?>
<div id='cdlmenu' class='wrap phpcode'>
<h2><?php _e('PHP Shortcodes', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<table class='form-table' summary=''><tbody>

<?php if ( !empty($this->phpcodes) ) : ?>
<?php foreach ($this->phpcodes as $k => $v) : ?>
	<tr><td>
		<input type='text' name='code[]' class='regular-text code' value='<?php echo $k; ?>' placeholder='shortcode' />
		<textarea cols='50' rows='5' name='php[]' class='large-text code'><?php echo stripslashes($v); ?></textarea>
	</td></tr>
<?php endforeach; ?>
<?php endif; ?>

<tr><td>
	<input type='text' name='code[]' class='regular-text code' value='' placeholder='shortcode (use on post as [shortcode])' />
	<textarea cols='50' rows='5' name='php[]' class='large-text code' placeholder='&lt;?php phpinfo(); ?&gt;'></textarea>
</td></tr>

</tbody></table>

<p class='submit'>
	<input name="update" type="submit" class="button-primary big-button" value="<?php _e('Save Settings', 'wpcitadel'); ?>" />
</p>

</form>
</div>
