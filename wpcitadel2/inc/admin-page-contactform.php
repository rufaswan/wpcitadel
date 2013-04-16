<?php defined('TEMPLATEPATH') or die('No direct script access.');

// update options for use in this function
$this->init();
global $ccache;
$template = 'page-contactform.php';

if ( isset($_POST['createpage']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->create_page('Contact Us', 'contact-us', $template);
}

if ( isset($_POST['update']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->options['contact_sentto'] = $_POST['sentto'];
	update_option($this->opt_name, $this->options);
}
//----------------------------------------------------------------
$pages = get_pages(array(
	'hierarchical'	=> 0,
	'meta_key'		=> '_wp_page_template',
	'meta_value'	=> $template
));
//----------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('Page Template: Contact Us', 'wpcitadel'); ?></h2>
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

<p><?php _e('Receiver Email(s), seperate by comma', 'wpcitadel'); ?></p>
<input type='text' name='sentto' class='large-text code'
	value="<?php echo ( $this->options['contact_sentto'] ) ? $this->options['contact_sentto'] : '' ; ?>"
	required='required' />

<p class='submit'>
	<input name="update" type="submit" class="button-primary big-button" value="<?php _e('Update', 'wpcitadel'); ?>" />
</p>

</form>
</div>
