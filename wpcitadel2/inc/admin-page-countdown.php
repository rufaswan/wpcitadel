<?php defined('TEMPLATEPATH') or die('No direct script access.');

// update options for use in this function
$this->init();
global $ccache;
$template = 'page-countdown.php';

if ( isset($_POST['createpage']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->create_page('Count Down', 'countdown', $template);
}

if ( isset($_POST['update']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$text = $_POST['cnt_form'];
	$text = preg_replace('|<link[^>]+>|is', '', $text);
	$text = preg_replace('|<style(.*?)>(.*?)</style>|is', '', $text);
	$text = preg_replace('|<script(.*?)>(.*?)</script>|is', '', $text);

	$this->options['cnt_time'] = $this->totime( $_POST['yy'], $_POST['mm'], $_POST['dd'], $_POST['hr'], $_POST['min'], $_POST['ss'] );
	$this->options['cnt_form'] = $this->save( $text );
	update_option($this->opt_name, $this->options);
}
//----------------------------------------------------------------
$cnt_time = $this->todate( $this->options['cnt_time'] );
$cnt_form = ( $this->options['cnt_form'] ) ? $this->html_decode($this->options['cnt_form']) : '';

$pages = get_pages(array(
	'hierarchical'	=> 0,
	'meta_key'		=> '_wp_page_template',
	'meta_value'	=> $template
));
//----------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('Page Template: Count Down', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<div id='message' class='updated'>
<?php if ( $pages ) : ?>
	<p>PAGE : <?php foreach ( $pages as $p )
		echo "<a href='" .$p->guid. "' rel='nofollow'>" .$p->post_title. "</a> ";
	?></p>
<?php else : ?>
	<input type='submit' name='createpage' class='button-primary big-button' value='Create' />
	<?php _e('It seems you haven&#039;t use this page template in any pages yet. Do you want to make a sample page now?', 'wpcitadel'); ?>
<?php endif; ?>
</div>

<p><?php _e('Target date and time to unlock the content', 'wpcitadel'); ?></p>
<input type='text' name='yy' class='small-text code' value='<?php echo $cnt_time['yy']; ?>' /> -
<input type='text' name='mm' class='small-text code' value='<?php echo $cnt_time['mm']; ?>' /> -
<input type='text' name='dd' class='small-text code' value='<?php echo $cnt_time['dd']; ?>' />

<input type='text' name='hr' class='small-text code' value='<?php echo $cnt_time['hr']; ?>' /> :
<input type='text' name='min' class='small-text code' value='<?php echo $cnt_time['min']; ?>' /> :
<input type='text' name='ss' class='small-text code' value='<?php echo $cnt_time['ss']; ?>' />

(YYYY-MM-DD hh:mm:ss)

<p><?php _e('...until then, input your email address to stay up-to-date', 'wpcitadel'); ?></p>
<textarea cols='20' rows='10' class='large-text code' name='cnt_form'><?php echo $cnt_form; ?></textarea>

<p class='submit'>
	<input name="update" type="submit" class="button-primary big-button" value="<?php _e('Update', 'wpcitadel'); ?>" />
</p>

</form>
</div>
