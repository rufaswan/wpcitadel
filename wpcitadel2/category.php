<?php
include (TEMPLATEPATH . '/div-title.php');
include (TEMPLATEPATH . '/div-header.php');
?>

<div id='main-wrapper' class='multipost'>
	<section id='content'>
	<?php if ( have_posts() ) : ?>
	<ul>
		<?php while ( have_posts() ) : the_post(); ?>
		<li><?php $citadel->multipost(); ?></li>
		<?php endwhile; ?>
	<?php endif; ?>
	</ul>
	</section>
</div>

<?php
include (TEMPLATEPATH . '/div-footer.php');
?>