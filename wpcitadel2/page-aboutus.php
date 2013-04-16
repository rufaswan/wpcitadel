<?php
/*
Template Name: About Us
*/
include (TEMPLATEPATH . '/div-title.php');
include (TEMPLATEPATH . '/div-header.php');
?>

<div id='main-wrapper' class='singlephp singlepage'>
<section id='content'>
<article id='aboutus'>

<?php
if ( $citadel_options['about_name'] )
	echo "<h1>" .$citadel_options['about_name']. "</h1>\n";

if ( $citadel_options['about_desc'] )
	echo "<p>" .nl2br( $citadel->html_decode($citadel_options['about_desc']) ). "</p>\n";
?>

<?php
if ( $citadel_options['about_address'] ) :
	$url = "https://maps.google.com/maps?q=" .$citadel_options['about_address']. "&amp;output=embed";
	?><section id='googlemap'>
		<iframe width='425' height='350' frameborder='0' scrolling='no'
			marginheight='0' marginwidth='0'
			src='<?php echo $url; ?>'></iframe>
	</section>
<?php endif; ?>

<?php
if ( $citadel_options['about_address'] )
	echo "<h2>Address</h2><address>" .nl2br($citadel_options['about_address']). "</address>\n";

if ( $citadel_options['about_phone'] )
	echo "<p>Tel: <a href='tel:" .$citadel_options['about_phone']. "'>" .$citadel_options['about_phone']. "</a></p>\n";

if ( $citadel_options['about_hours'] )
	echo "<h2>Business Hours:</h2><p>" .nl2br($citadel_options['about_hours']). "</p>\n";
?>

<section id='subscribe'>
<?php
	$social = array(
		'facebook',
		'twitter',
		'googleplus'
	);
	foreach ( $social as $s )
	{
		if ( $citadel_options['about_'.$s] )
		{
			echo "<a href='".$citadel_options['about_'.$s]."'>";
			echo "<img src='".$ccache['template_url']."/img/".$s.".png' alt='".$s."' width='48' height='48' rel='nofollow' /></a>\n";
		}
	}
	unset($social);
?>
</section>

</article>
</section>
</div>

<?php
include (TEMPLATEPATH . '/div-footer.php');
?>
