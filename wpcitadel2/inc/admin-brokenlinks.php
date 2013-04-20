<?php defined('TEMPLATEPATH') or die('No direct script access.');

global $wpdb;

$domain = parse_url( $_SERVER["REQUEST_URI"] );
parse_str($domain['query'], $queries);

$alpha = array('0-9',
	'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
	'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
	'U', 'V', 'W', 'Z', 'Y', 'Z');
$list = ( isset($_GET['list']) && in_array($_GET['list'], $alpha) ) ? $_GET['list'] : '';
$pageid = ( isset($_GET['pageid']) ) ? (int)$_GET['pageid'] : 0;
?>
<div id='cdlmenu' class='wrap maintenance'>
<h2><?php _e('Check for Broken Links', 'wpcitadel'); ?></h2>

<p style='text-align:center;font-size:2em;'>
<?php
unset( $queries['list'] );
foreach ( $alpha as $a )
	echo "<a href='?page=" .$queries['page']. "&amp;list=" .$a. "'>" .$a. "</a> ";
?>
</p>



<?php if ( !$pageid && $list ) : ?>
<?php
$where = ( $list == '0-9' ) ? "post_title REGEXP '^[0-9].*'" : "post_title LIKE '".$list."%'";
$query = "SELECT id, post_title, post_type
	FROM " .$wpdb->posts. "
	WHERE " .$where. "
	AND ( post_type = 'post'
	OR  post_type = 'page' )
	ORDER BY post_title;";
$post_list = $wpdb->get_results($query);

if ( $post_list )
{
	?><table class='widefat' summary=''>
	<thead><tr><th>Post Title</th><th>Type</th></tr></thead>
	<tbody><?php
	foreach ( $post_list as $p )
	{
		echo "<tr><td><a href='?page=" .$queries['page']. "&amp;pageid=" .$p->id. "'>" .$p->post_title. "</a></td>";
		echo "<td>" .$p->post_type. "</td></tr>";
	}
	?></tbody>
	</table><?php
}
else
	echo "<p>No matches.</p>";
?>
<?php endif; ?>



<?php if ( $pageid ) : ?>
<?php $page_data = ( $pageid ) ? get_post( $pageid ) : ''; ?>
<table class='widefat'>
<tr>
	<td>Title</td>
	<td><?php echo $page_data->post_title; ?></td>
</tr>
<tr>
	<td>Type</td>
	<td><?php echo $page_data->post_type; ?> / <?php echo $page_data->post_status; ?></td>
</tr>
<tr>
	<td>Date</td>
	<td><?php echo $page_data->post_date_gmt; ?> ( Modified : <?php echo $page_data->post_modified_gmt; ?> )</td>
</tr>
<tr>
	<td>GUID</td>
	<td><a href='<?php echo $page_data->guid; ?>'><?php echo $page_data->guid; ?></a></td>
</tr>
<tr>
	<td>Content</td>
	<td><textarea cols='20' rows='5' class='large-text code' readonly='readonly'><?php echo $page_data->post_content; ?></textarea></td>
</tr>
<tr>
	<td>Excerpt</td>
	<td><textarea cols='20' rows='5' class='large-text code' readonly='readonly'><?php echo $page_data->post_excerpt; ?></textarea></td>
</tr>
</table>

<?php
if ( preg_match_all('|href=[\'"]([^\'"]+)[\'"]|', $page_data->post_content, $match) )
{
	echo "<h2>href found</h2><table class='widefat'>";
	foreach ( $match[1] as $m )
	{
		$req = wp_remote_get($m);
		$code = ( is_wp_error($req) ) ? 'ERROR' : $req['response']['code']. ' ' .$req['response']['message'];
		echo "<tr><td><a href='" .$m. "'>" .$m. "</a></td><td>" .$code. "</td></tr>";
	}
	echo "</table>";
}
?>

<?php
if ( preg_match_all('|src=[\'"]([^\'"]+)[\'"]|', $page_data->post_content, $match) )
{
	echo "<h2>src found</h2><table class='widefat'>";
	foreach ( $match[1] as $m )
	{
		$req = wp_remote_get($m);
		$code = ( is_wp_error($req) ) ? 'ERROR' : $req['response']['code']. ' ' .$req['response']['message'];
		echo "<tr><td><a href='" .$m. "'>" .$m. "</a></td><td>" .$code. "</td></tr>";
	}
	echo "</table>";
}
?>
<?php endif; ?>



</div>

<?php
/*

<form method="get" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" >
<select name='' size='10'>
	<option value=''>--- Select a post ---</option>
	<?php echo wp_list_pages(); ?>
</select>
</form>

<?php if ( $page_data ) : ?>

<?php endif; ?>
<tr>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
</tr>

</table>
*/
