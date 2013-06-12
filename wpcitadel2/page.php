<?php
include ($ccache['base_path'] . '/div-title.php');
include ($ccache['base_path'] . '/div-header.php');
?>

<?php
if ( $citadel_locked ) :
	include ($ccache['base_path'] . '/div-countdown.php');
else :
?>
<div id='main-wrapper' class='singlephp singlepage'>
	<section id='content'>
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<h1><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h1>
				<div><?php the_content(); ?></div>
			</article>
			<?php comments_template('/div-comments.php', 1); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

	<?php if ( is_active_sidebar('page-sidebar') ) : ?>
		<div id="page-sidebar" class="sidebar" >
			<ul><?php dynamic_sidebar( 'page-sidebar' ); ?></ul>
		</div> <!-- end page-sidebar -->
	<?php else : ?>
		<?php if ( is_active_sidebar('global-sidebar') ) : ?>
			<div id="global-sidebar" class="sidebar" >
				<ul><?php dynamic_sidebar( 'global-sidebar' ); ?></ul>
			</div> <!-- end global-sidebar -->
		<?php endif; ?>
	<?php endif; ?>

</div>
<?php endif; ?>

<?php
include ($ccache['base_path'] . '/div-footer.php');
?>
