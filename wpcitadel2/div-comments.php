<?php defined('ABSPATH') or die('No direct script access.'); ?>

<div id="comments">

<?php if ( post_password_required() ) : ?>
	<p class="nopassword">
		<?php _e( 'This post is password protected. Enter the password to view any comments.', 'wpcitadel' ); ?>
	</p></div><!-- #comments -->
	<?php return; ?>
<?php endif; ?>



<?php if ( have_comments() ) : ?>

	<?php if ( !empty($comments_by_type['comment']) ) : ?>
	<h3><?php _e('Comments', 'wpcitadel' ); ?></h3>
		<ol class="commentlist">
			<?php wp_list_comments('type=comment&style=ol&avatar_size=88'); ?>
		</ol>
	<?php endif; ?>

	<?php if ( !empty($comments_by_type['pingback']) ) : ?>
	<h3><?php _e('Pingbacks', 'wpcitadel' ); ?></h3>
		<ol class="pingbacklist">
			<?php wp_list_comments('type=pingback&style=ol'); ?>
		</ol>
	<?php endif; ?>

	<?php if ( !empty($comments_by_type['trackback']) ) : ?>
	<h3><?php _e('Trackbacks', 'wpcitadel' ); ?></h3>
		<ol class="trackbacklist">
			<?php wp_list_comments('type=trackback&style=ol'); ?>
		</ol>
	<?php endif; ?>

<?php else : // for have_comments() loop ?>

	<?php if ( ! comments_open() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'wpcitadel' ); ?></p>
	<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
