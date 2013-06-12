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

	<?php if ( is_active_sidebar('category-sidebar') ) : ?>
		<div id="category-sidebar" class="sidebar" >
			<ul><?php dynamic_sidebar( 'category-sidebar' ); ?></ul>
		</div> <!-- end category-sidebar -->
	<?php else : ?>
		<?php if ( is_active_sidebar('global-sidebar') ) : ?>
			<div id="global-sidebar" class="sidebar" >
				<ul><?php dynamic_sidebar( 'global-sidebar' ); ?></ul>
			</div> <!-- end global-sidebar -->
		<?php endif; ?>
	<?php endif; ?>

</div>

<?php
include ($ccache['base_path'] . '/div-footer.php');
?>
