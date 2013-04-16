<footer>
	<section id='leftfooter'>
		<p>&copy; <?php echo date('Y'); ?> <?php echo $ccache['blogname']; ?>. All rights reserved.</p>
		<p>Powered by <a href='http://www.wordpress.org/'>WordPress</a> with <a href='http://www.wpcitadel.com/'>WP-Citadel</a></p>

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
				echo "<img src='".$ccache['template_url']."/img/".$s.".png' alt='".$s."' width='48' height='48' rel='nofollow' /></a>\n";
			}
		}
		unset($social);
	?>
	</section>

</footer>

<!-- to be insert by wordpress and its plugins -->
<?php wp_footer(); ?>

</body>
</html>
