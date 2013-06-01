<?php defined('ABSPATH') or die('No direct script access.');

// update options for use in this function
$this->init();

if ( isset($_POST['locksite']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->options['sitelocked'] = 1;
	update_option($this->opt_name, $this->options);
}

if ( isset($_POST['unlocksite']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->options['sitelocked'] = 0;
	update_option($this->opt_name, $this->options);
}

if ( isset($_POST['update']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$text = $_POST['cnt_form'];
	$text = preg_replace('|<link[^>]+>|is', '', $text);
	$text = preg_replace('|<style(.*?)>(.*?)</style>|is', '', $text);
	$text = preg_replace('|<script(.*?)>(.*?)</script>|is', '', $text);

	$this->options['cnt_time'] = $this->totime( $_POST['yy'], $_POST['mm'], $_POST['dd'], $_POST['hr'], $_POST['mi'], $_POST['ss'] );
	$this->options['cnt_form'] = $this->save( $text );

	$this->options['sitelockuser'] = join(',', $_POST['allowed_users']);

	update_option($this->opt_name, $this->options);
}
//----------------------------------------------------------------
$cnt_time = $this->todate( $this->options['cnt_time'] );
$cnt_form = ( $this->options['cnt_form'] ) ? $this->html_decode($this->options['cnt_form']) : '';
$cnt_user = $this->explode(',', $this->options['sitelockuser'] );
//----------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('Count Down Mode', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<?php if ( !$this->options['sitelocked'] ) : ?>
	<div class='msgbox'>
		<input type='submit' name='locksite' class='button-primary big-button' value='Lock' />
		<?php _e('Lock your site from public view, with a count down to arrival.', 'wpcitadel'); ?>
	</div>
<?php else : ?>
	<div class='msgbox'>
		<input type='submit' name='unlocksite' class='button-primary big-button' value='Unlock' />
		<?php _e('Unlock your site to public view now,', 'wpcitadel'); ?>
	</div>

	<h3><?php _e('After lock down, allow only these users to see locked content.', 'wpcitadel'); ?></h3>
	<div class='checkboxes'>
		<?php
		$data = array(
			'orderby'	=> 'display_name',
			'order'		=> 'ASC',
			'fields'	=> array('ID', 'display_name')
		);
		$users = get_users($data);
		foreach ($users as $u )
		{
			echo "<p><input type='checkbox' name='allowed_users[]' value='" .$u->ID. "' ";
			echo ( in_array($u->ID, $cnt_user) ) ? " checked='checked'" : '';
			echo "/> " .$u->display_name. "</p>";
		}
		?>
		<input type='hidden' name='allowed_users[]' value='0' />
	</div>

	<br class='clearfix' />
	<h3><?php _e('Target date and time to unlock the content', 'wpcitadel'); ?></h3>
	<input type='text' id='yy' name='yy' class='small-text code' value='<?php echo $cnt_time["yy"]; ?>' /> -
	<input type='text' id='mm' name='mm' class='small-text code' value='<?php echo $cnt_time["mm"]; ?>' /> -
	<input type='text' id='dd' name='dd' class='small-text code' value='<?php echo $cnt_time["dd"]; ?>' />

	<input type='text' id='hr' name='hr' class='small-text code' value='<?php echo $cnt_time["hr"]; ?>' /> :
	<input type='text' id='mi' name='mi' class='small-text code' value='<?php echo $cnt_time["min"]; ?>' /> :
	<input type='text' id='ss' name='ss' class='small-text code' value='<?php echo $cnt_time["ss"]; ?>' />

	(YYYY-MM-DD hh:mm:ss)

	<a href='#' id='current-time' class='button-primary'><?php _e('Set Current Time', 'wpcitadel'); ?></a>

	<h3><?php _e('Subscribe form to stay informed when the site is ready.', 'wpcitadel'); ?></h3>
	<textarea cols='20' rows='10' class='large-text code' name='cnt_form'><?php echo $cnt_form; ?></textarea>

	<p class='submit'>
		<input name="update" type="submit" class="button-primary big-button" value="<?php _e('Update', 'wpcitadel'); ?>" />
	</p>

<?php endif; ?>

</form>
</div>
