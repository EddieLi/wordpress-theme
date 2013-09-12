<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','highthemes'); ?></p>
	<?php
		return;
	}
?>

<div id="comments">
<?php if ('open' == $post->comment_status) : ?>

       <div id="respond">
      	
        	 <div class="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
    		</div>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be','highthemes'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in','highthemes'); ?></a> <?php _e('to post a comment.','highthemes'); ?></p>

<?php else : ?>

<h3><?php _e('Leave a Reply','highthemes'); ?></h3>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="horizform" id="commentform" onsubmit="if (url.value == '<?php _e('Website (optional)','highthemes'); ?>') {url.value = '';}">
<fieldset>
<?php if ( is_user_logged_in() ) : ?>

<p><?php _e('Logged in as','highthemes'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','highthemes'); ?>"><?php _e('Log out &raquo;','highthemes') ?></a></p>

<div class="form-data">
<p>
<label for="form_message"><?php _e('Comment','highthemes'); ?></label>
<textarea rows="9" cols="10" id="form_message" name="comment" tabindex="4" onfocus="if (this.value == '<?php _e('Type your comment here...','highthemes'); ?>') {this.value = '';}"  onblur="if (this.value == '') {this.value = '<?php _e('Type your comment here...','highthemes'); ?>';}"><?php _e('Type your comment here...','highthemes'); ?></textarea>
</p>
</div>

 <p>
 <input type="submit" id="submit" class="ibutton" name="submit" value="<?php _e('Comment','highthemes'); ?>" />
 </p>

<?php else : ?>
<div class="personal-data">

<p>
<label for="author"><?php _e('Full name','highthemes'); ?></label>
<input type="text" name="author" id="author" tabindex="1" class="txt" value="<?php if ($req) _e("Name (required)",'highthemes'); ?>" onfocus="if (this.value == '<?php _e('Name (required)','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Name (required)','highthemes'); ?>';}" />
</p>

 <p>
<label for="email"><?php _e('Email','highthemes'); ?></label>
<input type="text" name="email" id="email" tabindex="2" value="<?php if ($req) _e("Email (required)",'highthemes'); ?>" onfocus="if (this.value == '<?php _e('Email (required)','highthemes'); ?>') {this.value = '';}" class="txt" onblur="if (this.value == '') {this.value = '<?php _e('Email (required)','highthemes'); ?>';}" />
</p>  

<p>
<label for="url"><?php _e('Website URL','highthemes'); ?></label>
<input type="text" name="url" id="url" tabindex="3" value="<?php _e('Website (optional)','highthemes'); ?>" onfocus="if (this.value == '<?php _e('Website (optional)','highthemes'); ?>') {this.value = '';}" class="txt" onblur="if (this.value == '') {this.value = '<?php _e('Website (optional)','highthemes'); ?>';}" />
</p>

</div>

<div class="form-data">
<p>
<label for="form_message"><?php _e('Comment','highthemes'); ?></label>
<textarea rows="9" cols="10" id="form_message" name="comment" tabindex="4" onfocus="if (this.value == '<?php _e('Type your comment here...','highthemes'); ?>') {this.value = '';}"  onblur="if (this.value == '') {this.value = '<?php _e('Type your comment here...','highthemes'); ?>';}"><?php _e('Type your comment here...','highthemes'); ?></textarea>
</p>
</div>

 <p>
 <input type="submit" id="submit" class="ibutton" name="submit" value="<?php _e('Comment','highthemes'); ?>" />
 </p>
 <?php endif; // If logged in ?>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</fieldset>
</form>
<?php endif; // If registration required and not logged in ?>
  </div>

<?php endif; // if you delete this the sky will fall on your head ?>

      <br class="fix" />
   
<?php if ( have_comments() ) : ?>
	
<h3><?php _e("Comments","highthemes");?> (<?php print(get_comments_number());?>)</h3>
 <div class="commentlist">
 <?php wp_list_comments('avatar_size=60&callback=custom_comment&style=div'); ?>
  </div>
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
	<p><?php _e("No comments yet. Be the first!",'highthemes'); ?></p>
    
	 <?php else : // comments are closed ?>
		<p class="nocomments"><?php _e('Comments are closed.','highthemes'); ?></p>
	
	<?php endif; ?>
    

<?php endif; ?>   
 </div>