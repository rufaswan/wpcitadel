<?php defined('ABSPATH') or die('No direct script access.');

$ccache = array(
	'home'			=> get_option('home') . '/',
	'siteurl'		=> get_option('siteurl'),
	'permalink'		=> get_option('permalink_structure'),
	'blogname'		=> esc_attr( get_bloginfo( 'name', 'display' ) ),
	'blogtag'		=> get_bloginfo( 'description', 'display' ),
	'base_path'		=> get_template_directory(),
	'base_url'		=> get_template_directory_uri(),
	'child_path'	=> get_stylesheet_directory(),
	'child_url'		=> get_stylesheet_directory_uri(),
	'rss2_url'		=> get_bloginfo('rss2_url'),
	''				=> ''
);

// collection of smaller functions to be used within bigger functions
include($ccache['base_path'] . '/inc/misc.php');

//===============================================================
// one class to control them all
class citadel_admin
{
	// !!important!! it is the option_name in database
	private $opt_name;		private $options;
	private $code_name;		private $phpcodes;
	private $sass_name;		private $sass;
	private $pages;			private $ccache;

	// constructor, also act as initiliazer
	function citadel_admin()
	{
		global $ccache;
		$this->ccache = $ccache;
		$this->opt_name		= "citadel_options";
		$this->code_name	= "citadel_phpcodes";
		$this->sass_name	= "citadel_sass";
		$this->init();
		add_action('admin_menu', array($this, 'admin_menu') );
	}
	//------------------------------------------------------------
	// update defaults with options from database
	private function init()		{	include($this->ccache['base_path'] . '/inc/admin-init.php');	}

	// create page shortcut
	private function create_page($title, $slug, $template, $content = 'null')
	{
		global $user_ID;
		$post = array(
			'post_author'    => $user_ID,		'post_name'      => $slug,
			'post_title'     => $title,			'comment_status' => 'closed',
			'ping_status'    => 'closed',		'post_content'   => $content,
			'post_excerpt'   => 'null',			'post_status'    => 'publish',
			'post_type'      => 'page'
		);
		$pageid = wp_insert_post( $post, false );
		update_post_meta($pageid, "_wp_page_template", $template);
	}

	// paypal donate button
	private function donate( $img )
	{
		//https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TTB56UFR7WPMW
		?><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="TTB56UFR7WPMW">
			<input type="image" src="<?php echo $img; ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form><?php
	}

	// mailchimp subscribe form
	private function subscribe_form($user_identity = '', $user_email = '')
	{
		?><!-- Begin MailChimp Signup Form -->
		<form action="http://wpcitadel.us4.list-manage.com/subscribe/post" method="post" name="mc-embedded-subscribe-form" target="_blank">
			<input type='hidden' name='u' value='fdcee7d07721c23022dcdfb6f' />
			<input type='hidden' name='id' value='3f88a7f02b' />
		<h2>Subscribe to our mailing list</h2>
		<table>
		<tr>
			<td rowspan='2'><input type="submit" value="Subscribe" name="subscribe" class="button-primary big-button" /></td>
			<td><label for="mce-FNAME">Name</label></td>
			<td><input type="text" value="<?php echo $user_identity;?>" name="FNAME" class='regular-text code' /></td>
		</tr>
		<tr>
			<td><label for="mce-EMAIL">Email</label></td>
			<td><input type="email" value="<?php echo $user_email;?>" name="EMAIL" class='regular-text code' /></td>
		</tr>
		</table>
		</form>
		</div>
		<!--End mc_embed_signup--><?php
	}
	//------------------------------------------------------------
	function totime($yy, $mm, $dd, $hr = 0, $min = 0, $ss = 0)
	{	return mktime($hr, $min, $ss, $mm, $dd, $yy); }
	function todate($time = 0)
	{	return array(
			'yy'  => date("Y", $time),		'mm'  => date("n", $time),
			'dd'  => date("j", $time),		'hr'  => date("H", $time),
			'min' => date("i", $time),		'ss'  => date("s", $time) );
	}

	function relative_time( $time = 0)
	{
		$rel = ( $time > 0 ) ? "ahead" : "ago";
		$time = ( $time > 0 ) ? $time : $time * -1;
		$week = 60 * 60 * 24 * 7;
		$day  = 60 * 60 * 24;
		$hour = 60 * 60;
		$min  = 60;

		if ( $time > $week )	return (int)($time / $week) ." weeks "  . $rel;
		if ( $time > $day  )	return (int)($time / $day ) ." days "   . $rel;
		if ( $time > $hour )	return (int)($time / $hour) ." hours "  . $rel;
		if ( $time > $min  )	return (int)($time / $min ) ." minutes ". $rel;
		return (int)($time) ." seconds ". $rel;
	}

	// post thumbnail
	function featured_img()
	{
		if ( has_post_thumbnail() )
			the_post_thumbnail( array(200,200) );
		else
			echo "<img src='".$this->ccache['base_url']."/img/featured-200.jpg' width='200' height='200' alt='featured' />";
	}

	function multipost()
	{
		?><article>
			<?php $this->featured_img(); ?>
			<div><h1><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h1>
			<?php the_excerpt(); ?></div>
		</article><?php
	}
	//------------------------------------------------------------

	function html_encode( $str )		{ return htmlspecialchars($str, ENT_QUOTES); }
	function html_decode( $str )		{ return htmlspecialchars_decode($str, ENT_QUOTES); }
	function save( $str )				{ return $this->html_encode( stripslashes($str) ); }
	function get_options($name)			{ return $this->$name; }

	// return array unless $str is empty
	function explode($sep, $str)		{ $arr = explode($sep, $str); return ( empty($arr) ) ? array($str) : $arr; }
	// sort array by length
	function len_sort( $array )			{ uasort($array, create_function('$a,$b','return strlen($b) - strlen($a);')); return $array; }
	//------------------------------------------------------------

	// wp-admin related
	function admin_init()		{	include($this->ccache['base_path'] . '/inc/admin-dash-init.php'); }
	function admin_menu()		{	include($this->ccache['base_path'] . '/inc/admin-dash-menu.php'); }
	function general()			{	include($this->ccache['base_path'] . '/inc/admin-general.php'); }
	function countdown()		{	include($this->ccache['base_path'] . '/inc/admin-countdown.php'); }
	function sass()				{	include($this->ccache['base_path'] . '/inc/admin-sass.php'); }

	// page template related
	function page_contactform()	{	include($this->ccache['base_path'] . '/inc/admin-page-contactform.php'); }
	function page_aboutus()		{	include($this->ccache['base_path'] . '/inc/admin-page-aboutus.php'); }
	function page_sitemap()		{	include($this->ccache['base_path'] . '/inc/admin-page-sitemap.php'); }

	// misc menu page
	function phpcode()			{	include($this->ccache['base_path'] . '/inc/admin-phpcode.php'); }
	function maintenance()		{	include($this->ccache['base_path'] . '/inc/admin-maintenance.php'); }
	function brokenlinks()		{	include($this->ccache['base_path'] . '/inc/admin-brokenlinks.php'); }
	function feedback()			{	include($this->ccache['base_path'] . '/inc/admin-feedback.php');	}
	function license()			{	include($this->ccache['base_path'] . '/inc/admin-license.php'); }
}
//===============================================================
$citadel = new citadel_admin;
$citadel_options	= $citadel->get_options('options');
$citadel_phpcodes	= $citadel->get_options('phpcodes');
//===============================================================
include($ccache['base_path'] . '/inc/class-sharebtn.php');
include($ccache['base_path'] . '/inc/class-recursive.php');
include($ccache['base_path'] . '/inc/misc2.php');
