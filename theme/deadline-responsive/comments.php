<?php
include( TEMPLATEPATH . '/_admin/get-options.php' );
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework') ?></p>
<?php
return;	}

if ( have_comments() ) : ?>
	<h3 id="comments" class="widget-title"><?php comments_number(__('No comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></h3>
	
	<!-- BEGIN .commentlist -->
	<ol class="commentlist">
	
		<?php wp_list_comments('type=comment&avatar_size=50'); ?>
	
	</ol>
	<!-- END .commentlist -->

	<?php if(aw_show_comments_nav()) : ?>
	
	<!-- BEGIN .navigation -->
	<div class="navigation margin-20">
	
		<?php paginate_comments_links() ?>
	
	</div>
	<!-- END .navigation -->
	
	<?php endif; ?>
	
 <?php else : ?>

	<?php if ( comments_open() ) : ?>
		<p class="nocomments none"><?php _e('No comments yet.', 'framework'); ?></p>
	 <?php else : ?>
		<p class="commentsclosed none"><?php _e('Comments are closed.', 'framework'); ?></p>
	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<!-- BEGIN #respond -->
<div id="respond">

	<h3 class="widget-title"><?php comment_form_title( __('Leave a comment', 'framework'), __('Leave a comment to %s', 'framework') ); ?></h3>
	
	<!-- BEGIN .cancel-comment-reply -->
	<p class="cancel-comment-reply">
		
		<?php cancel_comment_reply_link(); ?>
		
	</p>
	<!-- END .cancel-comment-reply -->

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	
	<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'framework'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
	
	<?php else : ?>
	
	<!-- BEGIN #comment-form -->
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">
		
		<fieldset>
		
			<legend class="none"><?php _e('Comment form', 'framework'); ?></legend>
			
			<!-- BEGIN .container -->
			<div class="container">
			
				<?php if ( is_user_logged_in() ) : ?>
		
				<p class="grid-12 margin-20"><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'framework'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'framework').'">', '</a>') ?></p>
				<div class="clear"></div>
		
			<?php else : ?>
			
				<div class="grid-4 margin-20">
					<label for="author"><?php _e('Name', 'framework'); ?><span class="red">*</span></label>
				</div>
				
				<div class="grid-4 margin-20">
					<div class="input-wrapper"><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" size="30" class="required" placeholder="<?php _e('Enter your name', 'framework'); ?>" /></div>
				</div>
				<div class="clear"></div>
				
				<div class="grid-4 margin-20">
					<label for="email"><?php _e('Email (will not be published)', 'framework'); ?><span class="red">*</span></label>
				</div>
				
				<div class="grid-4 margin-20">
					<div class="input-wrapper"><input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" size="30" class="required email" placeholder="<?php _e('Enter your email address', 'framework'); ?>" /></div>
				</div>
				<div class="clear"></div>
				
				<div class="grid-4 margin-20">
					<label for="url"><?php _e('Website (including http://)', 'framework'); ?></label>
				</div>
				
				<div class="grid-4 margin-20">
					<div class="input-wrapper"><input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3" size="30" placeholder="<?php _e('Enter your website URL', 'framework'); ?>" /></div>
				</div>
				<div class="clear"></div>
				
			<?php endif; ?>
					
				<div class="grid-8 margin-20">
					<label for="comment" class="none margin-20"><?php _e('Comment', 'framework'); ?><span class="red">*</span></label>
					<div class="input-wrapper"><textarea name="comment" id="comment" rows="20" cols="30" class="required" tabindex="4" placeholder="<?php _e('Enter your comment', 'framework'); ?>" ></textarea></div>
				</div>
				<div class="clear"></div>
				
			</div>
			<!-- END .container -->
			
			<p><?php printf(__('All fields marked (%1$s*%2$s) are required', 'framework'), '<span class="red">', '</span>'); ?></p>
			<p><div class="submit-wrapper"><a id="comment-form-submit" class="submit"><?php _e('Send comment', 'framework'); ?></a></div></p>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID); ?>
			
		</fieldset>
		
	</form>
	<!-- END #comment-form -->

<?php endif; ?>

</div>
<!-- END #respond -->

<?php endif; ?>
