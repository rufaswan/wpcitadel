<?php
if ( $citadel_options['noautop'] )
	remove_filter('the_content', 'wpautop');
if ( $citadel_options['nosmartq'] )
	remove_filter('the_content', 'wptexturize');
//===============================================================
if ( !empty($citadel_phpcodes) )
{
	foreach ( $citadel_phpcodes as $k => $v )
	{
		$eval = ' ?> ' . $citadel->html_decode($v) . ' <?php ';
		$cmd  = 'ob_start(); eval(\'' .$eval. '\'); $buffer = ob_get_contents(); ob_end_clean(); return $buffer;';
		$func = create_function('$atts, $content = null', $cmd);
		add_shortcode($k, $func);
	}
	unset($eval, $cmd, $k, $v);
}
//===============================================================
function citadel_scripts()
{
	global $ccache, $citadel_options;

	wp_register_style('cdl_css', $ccache['template_url'] . '/extern/extern-css.php?q=' .$citadel_options['load_css']);
	wp_enqueue_style('cdl_css');
	wp_register_script('cdl_js', $ccache['template_url'] . '/extern/extern-js.php?q=' .$citadel_options['load_js']);
	wp_enqueue_script('cdl_js');

	wp_register_style('cdl_child_css', $ccache['child_url'] . '/child.css', array('cdl_css'));
	wp_enqueue_style('cdl_child_css');
	wp_register_script('cdl_child_js', $ccache['child_url'] . '/child.js', array('cdl_js'));
	wp_enqueue_script('cdl_child_js');
}
add_action('wp_enqueue_scripts', 'citadel_scripts');
//===============================================================
function citadel_wphead()
{
	global $ccache, $citadel, $citadel_options;

	echo "<link rel='icon' href='" . $ccache['child_url'] . "/img/favicon.ico' type='image/x-icon' />\n";
	echo "<link rel='shortcut icon' href='" . $ccache['child_url'] . "/img/favicon.ico' type='image/x-icon' />\n";

	echo $citadel->html_decode( $citadel_options['extra_head'] );
}
add_action('wp_head', 'citadel_wphead');
//===============================================================
function citadel_wpfooter()
{
	global $citadel, $citadel_options;
	echo $citadel->html_decode( $citadel_options['extra_foot'] );
}
add_action('wp_footer', 'citadel_wpfooter');
//===============================================================
function citadel_sidebars()
{
	$widgets = array(
		array('Sidebar', 'sidebar')
	);
	foreach ( $widgets as $w )
	{
		register_sidebar( array(
			'name' => $w[0],
			'id' => $w[1],
			'description' => $w[0],
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	}
}
add_action('widgets_init', 'citadel_sidebars');
//===============================================================
function citadel_navmenu()
{
	register_nav_menu('header-menu', 'Header Menu');
}
add_action('init', 'citadel_navmenu');
//===============================================================
//===============================================================
