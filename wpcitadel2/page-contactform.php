<?php
/*
Template Name: Contact Form
*/
$msg = '';
if ( isset($_POST['cformsubmit']) )
{
	if ( !$citadel_options['contact_sentto'] )
		$msg .= "<p>ERROR: No email set by site admin.</p><p><b>Email is NOT sent.</b></p>";
	else
	{
		$emails = $citadel->explode(',', $citadel_options['contact_sentto']);
		foreach ( $emails as $to )
		{
			$sender = sanitize_text_field( $_POST['cname'] ). " <" .sanitize_text_field( $_POST['cemail'] ). ">";

			$header = "From: " . $sender. "\r\n";
			$header.= "Reply-To: " . $sender;
			$sub = sanitize_text_field( $_POST['csubject'] );
			$msg = sanitize_text_field( $_POST['cmessage'] );

			wp_mail($to, $sub, $msg, $header);
			$msg .= "<p>Email sent. Thank you.</p>";
		}
	}
}

include (TEMPLATEPATH . '/div-title.php');
include (TEMPLATEPATH . '/div-header.php');
?>

<div id='main-wrapper' class='singlephp singlepage'>
<section id='content'>
<article id='contactform'>

<?php if ( $msg ) : ?>
	<div id='message'><?php echo $msg; ?></div>
<?php endif; ?>

<form action='' method='post'>
	<label><?php _e('Name', 'wpcitadel'); ?></label>
	<input type='text' name='cname' value='' required='required' />

	<label><?php _e('Email', 'wpcitadel'); ?></label>
	<input type='email' name='cemail' value='' required='required' />

	<label><?php _e('Subject', 'wpcitadel'); ?></label>
	<input type='text' name='csubject' value='' required='required' />

	<label><?php _e('Message', 'wpcitadel'); ?></label>
	<textarea name='cmessage' cols='20' rows='10' required='required'></textarea>

	<input type='submit' name='cformsubmit' class='citadel-btn' value='Submit' />
</form>

</article>
</section>
</div>

<?php
include (TEMPLATEPATH . '/div-footer.php');
?>
