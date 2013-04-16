<?php
include (TEMPLATEPATH . '/div-title.php');
include (TEMPLATEPATH . '/div-header.php');
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
	<?php endwhile; ?>
	<?php endif; ?>
	</section>
</div>

<?php
include (TEMPLATEPATH . '/div-footer.php');
?>
