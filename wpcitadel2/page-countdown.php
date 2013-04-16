<?php
/*
Template Name: Count Down
*/
include (TEMPLATEPATH . '/div-title.php');
include (TEMPLATEPATH . '/div-header.php');

$cnt_time = $citadel->todate( $citadel_options['cnt_time'] );
?>

<div id='main-wrapper' class='singlephp singlepage'>
<section id='content'>

<?php if ( current_time('timestamp') > $citadel_options['cnt_time'] ) : ?>
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article>
			<h1><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h1>
			<div><?php the_content(); ?></div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
<?php else : ?>
	<article id='countdown'>
		<p>It&#039;s</p>
		<h1 id='defaultCountdown'>&nbsp;</h1>
		<p>Until</p>
		<h2><?php echo date('j F Y g:i A', $citadel_options['cnt_time']); ?></h2>

		<img src='<?php echo $ccache['template_url'].'/file/std_arrow.png'; ?>' alt='arrow' width='235' height='163' />

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
<?php endif; ?>

</section>
</div>

<?php
include (TEMPLATEPATH . '/div-footer.php');
?>
