<?php defined('ABSPATH') or die('No direct script access.');

require( $this->ccache['base_path'] . '/extern/php/scssphp/scss.inc.php' );

// update options for use in this function
$this->init();
$cssfile = $this->getfile('/child.css', 1);
$phpsass = new scssc;
$compcss = $phpsass->compile( $this->sass );

if ( ( isset($_POST['save']) || isset($_POST['publish']) || isset($_POST['reset']) )
	&& wp_verify_nonce($_POST['wp-nonce']) )
{
	if ( isset($_POST['reset']) )
		$this->sass = file_get_contents( $this->getfile('/file/child.scss', 1) );
	else
		$this->sass = str_replace( array("\\'", '\\"'), '', $_POST['sass'] );

	$compcss = $phpsass->compile( $this->sass );
	update_option($this->sass_name, $this->sass);

	if ( isset($_POST['save']) )
		echo "<div id='message' class='updated fade'><p><b>SCSS Saved</b></p></div>";
	if ( isset($_POST['publish']) )
	{
		file_put_contents($cssfile, $compcss);
		echo "<div id='message' class='updated fade'><p><b>SCSS Saved &amp; Updated CSS File</b></p></div>";
	}
	if ( isset($_POST['reset']) )
		echo "<div id='message' class='updated fade'><p><b>SCSS Reset&#039;d</b></p></div>";
}
//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('SASS: Syntactically Awesome Stylesheets', 'wpcitadel'); ?></h2>

<?php if ( ! is_writable( $cssfile ) ) : ?>
	<div id='message' class='updated fade'><p>The CSS file : <b><?php echo $cssfile; ?></b> is not writable.
	Please give the necessary file permission to the CSS file or copy &amp; paste the CSS code to update your site.</p></div>
<?php endif; ?>

<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<table class='widefat'>
<thead><tr>
	<th>SCSS syntax</th>
	<th>CSS (readonly)</th>
</tr></thead>
<tbody><tr>
	<td><textarea cols='20' rows='20' class='large-text code' wrap='off' name='sass'><?php echo $this->sass; ?></textarea></td>
	<td><textarea cols='20' rows='20' class='large-text code' wrap='off' readonly='readonly'><?php echo $compcss; ?></textarea></td>
</tr></tbody>
</table>

<p class='submit'>
	<input type='submit' name='save' class='button-primary big-button' value='Save &amp; Review' />
	<input type='submit' name='publish' class='button-primary big-button' value='Publish Live' />

	<input type='submit' name='reset' style='float:right;' class='button-primary big-button' value='Reset SASS' />
</p>

</form>
</div>
