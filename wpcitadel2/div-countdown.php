<?php defined('ABSPATH') or die('No direct script access.'); ?>

<?php $cnt_time = $citadel->todate( $citadel_options['cnt_time'] ); ?>

<div id='main-wrapper' class='singlephp singlepage'>
<section id='content'>

<article id='countdown'>
	<?php if ( WP_DEBUG ) : ?>
		<p>Current time: <?php echo date('j F Y g:i A', current_time('timestamp') ); ?></p>
	<?php endif; ?>
	<h1 id='defaultCountdown'>&nbsp;</h1>
	<p>Until</p>
	<h2><?php echo date('j F Y g:i A', $citadel_options['cnt_time']); ?></h2>

	<img src='<?php echo $ccache['base_url'].'/file/std_arrow.png'; ?>' alt='arrow' width='235' height='163' />

	<div id='countdownform'><?php echo $citadel->html_decode($citadel_options['cnt_form']); ?></div>

	<script type='text/javascript'>
	jQuery(document).ready(function(){
		jQuery('nav').remove();
		var untilDate = new Date(<?php echo $cnt_time['yy']; ?>, <?php echo $cnt_time['mm']; ?> - 1, <?php echo $cnt_time['dd']; ?>, <?php echo $cnt_time['hr']; ?>, <?php echo $cnt_time['min']; ?>, <?php echo $cnt_time['ss']; ?>);
		$('#defaultCountdown').countdown({
			until:untilDate,
			layout:'<b>{d<}{dn} {dl} and <br />{d>}'+ '{hn} {hl}, {mn} {ml}, {sn} {sl}</b>',
			onExpiry:refreshPage
		});
	});
	function refreshPage() { location.reload(true); }
	</script>
</article>

</section>
</div>
