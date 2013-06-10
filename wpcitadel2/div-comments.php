<?php defined('ABSPATH') or die('No direct script access.'); ?>

<div id="comments">

<?php if ( post_password_required() ) : ?>
	<p class="nopassword">
		<?php _e( 'This post is password protected. Enter the password to view any comments.', 'wpcitadel' ); ?>
	</p></div><!-- #comments -->
	<?php return; ?>
<?php endif; ?>



<?php if ( have_comments() ) : ?>

<<<<<<< HEAD
	<?php if ( !empty($comments_by_type['comment']) ) : ?>
	<h3 id="comments"><?php _e('Comments', 'wpcitadel' ); ?></h3>
		<ol class="commentlist">
			<?php wp_list_comments('type=comment'); ?>
		</ol>
	<?php endif; ?>

	<?php if ( !empty($comments_by_type['pingback']) ) : ?>
	<h3 id="pingbacks"><?php _e('Pingbacks', 'wpcitadel' ); ?></h3>
		<ol class="pingbacklist">
			<?php wp_list_comments('type=pingback'); ?>
		</ol>
	<?php endif; ?>

	<?php if ( !empty($comments_by_type['trackback']) ) : ?>
	<h3 id="trackbacks"><?php _e('Trackbacks', 'wpcitadel' ); ?></h3>
		<ol class="trackbacklist">
			<?php wp_list_comments('type=trackback'); ?>
		</ol>
	<?php endif; ?>
=======
	<h3 id="comments-title"><?php
		printf(
			_n( 'One Response to %2$s', '%1$s Responses to %2$s',
				get_comments_number(),
				'wpcitadel'
			),
			number_format_i18n(
				get_comments_number() ),
				'<em>' . get_the_title() . '</em>'
		);
	?></h3>

	<?php // show comments in an ordered list ?>
	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<?php
	// show comment navigation if avilable
	if ( get_comment_pages_count() > 1
		&& get_option( 'page_comments' )
		) :
	?>
	<div class="navigation">
		<div class="nav-previous">
			<?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'wpcitadel' ) ); ?>
		</div>
		<div class="nav-next">
			<?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'wpcitadel' ) ); ?>
		</div>
	</div><!-- .navigation -->
	<?php endif; // check for comment navigation ?>
>>>>>>> 9ab6f9fcb4a24f6c08df046ecf0b17715cd3ac2d

<?php else : // for have_comments() loop ?>

	<?php if ( ! comments_open() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'wpcitadel' ); ?></p>
	<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
