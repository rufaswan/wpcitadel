<?php
include ($ccache['base_path'] . '/div-title.php');
include ($ccache['base_path'] . '/div-header.php');
?>

<?php
if ( $citadel_locked ) :
	include ($ccache['base_path'] . '/div-countdown.php');
else :
?>
<div id='main-wrapper' class='singlephp singlepost'>
	<section id='content'>
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<h1><a href='<?php the_permalink(); ?>' title='Last modified: <?php the_modified_date(); ?>'><?php the_title(); ?></a></h1>
				<div><?php the_content(); ?></div>
			</article>
			<aside>
				<?php
					$btn = new citadel_share;
					$btn->facebook();
					$btn->googleplus();
					$btn->twitter();
					unset($btn);
				?>
			</aside>
			<?php comments_template('/div-comments.php', 1); ?>
		<?php endwhile; ?>
		<?php endif; ?>
	</section>
</div>
<?php endif; ?>

<?php
include ($ccache['base_path'] . '/div-footer.php');
?>
