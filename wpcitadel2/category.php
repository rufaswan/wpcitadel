<?php
include ($ccache['base_path'] . '/div-title.php');
include ($ccache['base_path'] . '/div-header.php');
?>

<div id='main-wrapper' class='multipost'>
	<section id='content'>
	<?php
	if ( $citadel_locked ) :
		include ($ccache['base_path'] . '/div-countdown.php');
	else :
	?>
		<?php if ( have_posts() ) : ?>
		<ul>
			<?php while ( have_posts() ) : the_post(); ?>
			<li><?php $citadel->multipost(); ?></li>
			<?php endwhile; ?>
		<?php endif; ?>
		</ul>
	<?php endif; ?>
	</section>
</div>

<?php
include ($ccache['base_path'] . '/div-footer.php');
?>
