<?php
include ($ccache['base_path'] . '/div-title.php');
include ($ccache['base_path'] . '/div-header.php');
?>

<section id="search_form">
	<?php get_search_form(); ?>
</section>

<?php
if ( $citadel_locked ) :
	include ($ccache['base_path'] . '/div-countdown.php');
else :
?>
<div id='main-wrapper' class='multipost'>
	<section id='content'>
		<?php if ( have_posts() ) : ?>
		<ul>
			<?php while ( have_posts() ) : the_post(); ?>
			<li><?php $citadel->multipost(); ?></li>
			<?php endwhile; ?>
		</ul>
		<?php else : ?>
			<h1>No result found. Sorry :(</h1>
		<?php endif; ?>
	</section>

	<?php if ( is_active_sidebar('search-sidebar') ) : ?>
		<div id="search-sidebar" class="sidebar" >
			<ul><?php dynamic_sidebar( 'search-sidebar' ); ?></ul>
		</div> <!-- end search-sidebar -->
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
