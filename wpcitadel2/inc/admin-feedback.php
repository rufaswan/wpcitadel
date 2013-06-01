<?php defined('ABSPATH') or die('No direct script access.');

global $user_identity, $user_email;

//----------------------------------------------------------------
?>
<div id='cdlmenu' class='wrap cdlpage'>
<h2><?php _e('Send Feedback', 'wpcitadel'); ?></h2>
<form method="post" action="<?php echo $this->ccache['base_url'].'/file/default-feedback.php'; ?>" >
<input name='wp-nonce' type='hidden' value='<?php echo wp_create_nonce(); ?>' />

<p><?php _e('Subject', 'wpcitadel'); ?></p>
<input type='text' name='subject' class='large-text code' value='' required='required' />

<p><?php _e('Message', 'wpcitadel'); ?></p>
<textarea name='message' class='large-text code' cols='20' rows='10' required='required'></textarea>

<p class='submit'>
	<input type='hidden' name='user_email' value='<?php echo $user_email; ?>' />
	<input type='hidden' name='user_identity' value='<?php echo $user_identity; ?>' />
	<input type='hidden' name='siteurl' value='<?php echo $this->ccache['siteurl']; ?>' />

	<button type='submit' name="sendcdl" class="img-button">
		<img src='<?php echo $this->ccache['base_url'].'/file/send-feedback.png'; ?>' alt='Send Feedback &amp; Donate' />
	</button>
</p>

</form>

<?php $this->subscribe_form($user_identity, $user_email); ?>
</div>
