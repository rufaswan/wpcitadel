<?php defined('ABSPATH') or die('No direct script access.'); ?>

<footer>
	<section id='leftfooter'>
		<?php if ( has_nav_menu('footer-menu') ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
		<?php endif; ?>

		<p>&copy; <?php echo date('Y'); ?> <?php echo $ccache['blogname']; ?>. All rights reserved.</p>
		<p><?php echo $citadel_options['child_theme']; ?> designed by <a href='<?php echo $citadel_options['child_url']; ?>' rel='nofollow'><?php echo $citadel_options['child_author']; ?></a></p>
		<p>Powered by <a href='http://www.wordpress.org/'>WordPress</a> with <a href='http://rufaswan.github.io/wpcitadel/'>WP-Citadel</a></p>

		<?php if ( WP_DEBUG ) : ?>
			<p><?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.
			Usage <?php echo number_format( memory_get_usage() / 1024, 2 ); ?> KB.</p>
		<?php endif; ?>
	</section>

	<section id='rightfooter'>
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
				echo "<img src='".$ccache['base_url']."/img/".$s.".png' alt='".$s."' width='48' height='48' rel='nofollow' /></a>\n";
			}
		}
		unset($social);
	?>
	</section>

</footer>

<!-- to be insert by wordpress and its plugins -->
<?php wp_footer(); ?>

</div> <!-- end body-wrapper -->
</body>
</html>
