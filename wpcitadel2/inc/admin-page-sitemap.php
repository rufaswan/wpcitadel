<?php defined('TEMPLATEPATH') or die('No direct script access.');

// update options for use in this function
$this->init();
global $ccache;
$template = 'page-sitemap.php';

if ( isset($_POST['createpage']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	$this->create_page('Sitemap', 'sitemap', $template);
}

if ( isset($_POST['maplist']) && wp_verify_nonce($_POST['wp-nonce']) )
{
	if ( empty($_POST['sitemap']) )
		$_POST['sitemap'] = 'posts-by-alpha';
	$this->options['sitemap'] = join(',', $_POST['sitemap']);
	update_option($this->opt_name, $this->options);
}
//----------------------------------------------------------------
$sitemap_elements = array (
	'posts-by-alpha',		'posts-by-date',
	'pages',				'categories',
	'tags',					'authors',
	'archives_monthly',		'archives_yearly',
	'archives_daily',		'archives_weekly',
	'bookmarks'
);
$pages = get_pages(array(
	'hierarchical'	=> 0,
	'meta_key'		=> '_wp_page_template',
	'meta_value'	=> $template
));
//----------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('Page Template: Sitemap', 'wpcitadel'); ?></h2>
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

<p class='description'>
	<?php _e('Contol elements for display in sitemap page template.', 'wpcitadel'); ?>
</p>

<div class='checkboxes'><?php
$sitemap = $this->explode(',', $this->options['sitemap']);
foreach ( $sitemap_elements as $el )
{
	echo "<p><label title='" . $el . "'>";
	echo "<input type='checkbox' name='sitemap[]' value='" . $el . "'";

	// empty array gives error to in_array
	if ( $this->options['sitemap'] && in_array($el, $sitemap) )
		echo " checked='checked'";

	echo " /> Show " . $el . "</label></p>\n";

}
?></div>

<p class='submit' style='clear:both;'>
	<input name="maplist" type="submit" class="button-primary big-button" value="<?php _e('Update', 'wpcitadel'); ?>" />
</p>

</form>
</div>
