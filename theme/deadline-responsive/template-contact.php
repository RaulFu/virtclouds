<?php

/* --

	Template Name: Contact

-- */

include( TEMPLATEPATH . '/_admin/get-options.php' );
if ($aw_captcha_select == "true") include ( TEMPLATEPATH . '/_includes/recaptchalib.php');
if(isset($_POST['submitted'])) {
	if ($aw_captcha_select == "true") {
		if ($_POST["recaptcha_challenge_field"]) {
			$privatekey = "'.$aw_captcha_private_key.'";
			$resp = recaptcha_check_answer ($privatekey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				$hasError = true;
				$captchaError = $resp->error;
			}
		}
		$contactName = trim($_POST['contact-name']);
		$contactEmail = trim($_POST['contact-email']);
		$contactSubject = stripslashes(trim($_POST['contact-subject']));
		$contactMessage = stripslashes(trim($_POST['contact-message']));
		$emailTo = get_option('aw_email');
		if(!isset($hasError)) {
			if ((!isset($emailTo)) || ($emailTo == '')) $emailTo = get_option('admin_email');
			if ((!isset($contactSubject)) || ($contactSubject == '')) {
				$subject = '[Contact Form]';
			} else {
				$subject = '[Contact Form] ' . $contactSubject;
			}
			$body = 'Name: ' . $contactName . "\n\n" . 'Email: ' . $contactEmail. "\n\n" . 'Message:' . "\n" . $contactMessage;
			$headers = 'From: '.$contactName.' <' . $contactEmail . '>' . "\r\n" . 'Reply-To: ' . $contactEmail;
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	}

}
get_header();
?>

<!-- BEGIN .entry-header -->
<div class="entry-header grid-12">
		
	<h1><?php the_title(); ?></h1>
				
</div>
<!-- BEGIN .entry-header -->

<div class="clear"></div>

<!-- BEGIN .grid-8 -->
<div class="grid-8">

	<?php if ($aw_captcha_select == "true") echo '<script>  var RecaptchaOptions = { theme : "custom", custom_theme_widget: "recaptcha" }; </script>'; ?>
		
	<?php if(isset($emailSent) && $emailSent == true): ?>
			
	<!-- BEGIN .alert -->
	<div class="alert green margin-20">
			
		<?php echo $aw_contact_form_message; ?>
	
	</div>
	<!-- END .alert -->
	
	<?php endif; ?>
	
	<?php if(isset($captchaError)): ?>
	
	<!-- BEGIN .alert -->
	<div class="alert red margin-20">
	
		<?php 
		if($captchaError == "incorrect-captcha-sol") { _e('The CAPTCHA solution was incorrect.','framework'); }
		else if($captchaError == "invalid-request-cookie") { _e('The challenge parameter of the verify script was incorrect.','framework'); }
		else if($captchaError == "invalid-site-private-key") { _e('We weren\'t able to verify the private key.','framework'); }
		else { echo $captchaError; } 
		?>
		
	</div>
	<!-- END .alert -->
	
	<?php endif; ?>
						
	<!-- BEGIN #contact-form -->
	<form action="<?php the_permalink(); ?>" id="contact-form" method="post">
			
		<fieldset>
		
			<legend class="none"><?php _e('Contact form', 'framework'); ?></legend>
			
			<!-- BEGIN .container -->
			<div class="container">
			
				<div class="grid-4 margin-20">
					<label for="contact-name"><?php _e('Name', 'framework'); ?><span class="red">*</span></label>
				</div>
				
				<div class="grid-4 margin-20">
					<div class="input-wrapper"><input type="text" name="contact-name" id="contact-name" value="<?php if(isset($_POST['contact-name'])) echo $_POST['contact-name'];?>" tabindex="1" size="30" class="required" placeholder="<?php _e('Enter your name', 'framework'); ?>" /></div>
				</div>
				<div class="clear"></div>
				
				<div class="grid-4 margin-20">
					<label for="contact-email"><?php _e('Email', 'framework'); ?><span class="red">*</span></label>
				</div>
				
				<div class="grid-4 margin-20">
					<div class="input-wrapper"><input type="email" name="contact-email" id="contact-email" value="<?php if(isset($_POST['contact-email']))  echo $_POST['contact-email'];?>" tabindex="2" size="30" class="required email" placeholder="<?php _e('Enter your email address', 'framework'); ?>" /></div>
				</div>
				<div class="clear"></div>
				
				<div class="grid-4 margin-20">
					<label for="contact-subject"><?php _e('Subject', 'framework'); ?></label>
				</div>
				
				<div class="grid-4 margin-20">
					<div class="input-wrapper"><input type="text" name="contact-subject" id="contact-subject" value="<?php if(isset($_POST['contact-subject']))  echo $_POST['contact-subject'];?>" tabindex="3" size="30" placeholder="<?php _e('Enter your subject', 'framework'); ?>" /></div>
				</div>
				<div class="clear"></div>
				
				<div class="grid-8 margin-20">
					<label for="contact-message" class="none margin-20"><?php _e('Message', 'framework'); ?><span class="red">*</span></label>
					<div class="input-wrapper"><textarea name="contact-message" id="contact-message" rows="20" cols="30" class="required" tabindex="4" placeholder="<?php _e('Enter your message', 'framework'); ?>" ><?php if(isset($_POST['contact-message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['contact-message']); } else { echo $_POST['contact-message']; } } ?></textarea></div>
				</div>
				<div class="clear"></div>
				
				<?php if ($aw_captcha_select == "true"): ?>
		
				<!-- BEGIN #recaptcha -->	
				<div id="recaptcha" style="display:none" class="margin-20">
				
					<div class="grid-4">
						<div id="recaptcha_image"></div>
						<span class="recaptcha_only_if_image"><?php _e('Enter the words above', 'framework'); ?><span class="red">*</span></span>
						<span class="recaptcha_only_if_audio"><?php _e('Enter the numbers you hear', 'framework'); ?><span class="red">*</span></span>
						<div><a href="javascript:Recaptcha.reload()"><?php _e('Get another CAPTCHA', 'framework'); ?></a></div>
						<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><?php _e('Get an audio CAPTCHA', 'framework'); ?></a></div>
						<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><?php _e('Get an image CAPTCHA', 'framework'); ?></a></div>
						<p><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'framework'); ?></a></p>
					</div>
					
					<div class="grid-4">
						<div class="input-wrapper"><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" placeholder="<?php _e('Enter the CAPTCHA', 'framework'); ?>" class="required" /></div>
					</div>
					<div class="clear"></div>
				
				</div>
				<!-- END #recaptcha -->
	
				<script src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $aw_captcha_public_key; ?>"></script>
				
				<?php endif; ?>
			
			</div>
			<!-- END .container -->
						
			<input type="hidden" name="submitted" id="submitted" value="true" />
			<p class="required-fields"><?php printf(__('All fields marked (%1$s*%2$s) are required', 'framework'), '<span class="red">', '</span>'); ?></p>
			<p><div class="submit-wrapper"><a id="contact-form-submit" class="submit"><?php _e('Send message', 'framework'); ?></a></div></p>
			
		</fieldset>
				
	</form>
	<!-- END #contact-form -->
												
</div>
<!-- END .grid-8 -->
		
<!-- BEGIN .grid-4 -->
<div class="grid-4" id="post-<?php the_ID(); ?>">
			
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	<?php edit_post_link(__('Edit this entry.', 'framework'), '<p>', '</p>'); ?>
	<?php endwhile; endif; ?>
		
</div>
<!-- END .grid-4 -->

<div class="clear"></div>

<?php get_footer(); ?>