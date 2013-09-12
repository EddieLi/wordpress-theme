<?php

add_action('admin_menu', 'ht_subheading_options');
function ht_subheading_options() {
	global $theme_name;
	add_meta_box('ht_subheading_options', "Highthemes" . __(' - Subheader Options','highthemes'), 'ht_subheading_options_box', 'page', 'normal', 'high');
	add_meta_box('ht_subheading_options', "Highthemes" . __(' - Subheader Options','highthemes'), 'ht_subheading_options_box', 'post', 'normal', 'high');
	add_meta_box('ht_subheading_options', "Highthemes" . __(' - Subheader Options','highthemes'), 'ht_subheading_options_box', 'portfolio', 'normal', 'high');	
}

function ht_subheading_options_box() {
	global $post;

	$selected_subheading = get_post_meta($post->ID,'_selected_subheading',true);
	$ht_post_subheading_button_link = get_post_meta($post->ID,'_ht_post_subheading_button_link',true);
	$ht_post_subheading_button_title = get_post_meta($post->ID,'_ht_post_subheading_button_title',true);
	$ht_post_subheading_posts_ids = get_post_meta($post->ID,'_ht_post_subheading_posts_ids',true);
	$ht_teaser_text = get_post_meta($post->ID,'_ht_teaser_text',true);
	
	/* for security */
	echo '<input type="hidden" name="ht_subheading_noncename" id="ht_subheading_noncename"
	 	  value="'.wp_create_nonce('ht-subheading').'" />';

	echo '<p class="separate">
	 	  <strong>'.__('Override subheader text.','highthemes').'</strong><span class="ht_desc"> '.__('/  You can enter custom subheader text (teaser text) to override the defaults. ','highthemes').'</span><br />
	 	  <label for="ht_teaser_text" class="screen-reader-text">'.__('Sub Header Text?','highthemes').'</label>
	 	  <input class="widetext" value="'.$ht_teaser_text  .'" type="text" class="" name="ht_teaser_text" id="ht_post_subheading_posts_ids"/>
	 	  </p>'; 
			

	/* page type form element */
	echo '<p class="separate"><strong>'.__('Subheader Content','highthemes').'</strong>
	 	  <label for="selected_subheading" class="screen-reader-text">'.__('Subheader Content','highthemes').'</label>';

	echo '<select name="selected_subheading" id="selected_subheading" size="1">';
	if($selected_subheading == ''){ $selected= " selected";}
	echo '<option value="" '.$selected.'>Default</option>';
	
	$subheadings = array("Twitter", "Button", "Post/Page/Portfolio", "disabled");
	
	foreach($subheadings as $subheading){
		if($selected_subheading == $subheading){
			echo "<option value='$subheading' selected>$subheading</option>\n";
		}else{
			echo "<option value='$subheading'>$subheading</option>\n";
		}
	}

	echo '</select></p>';

	echo '<p class="separate">
	 	  <strong>'.__('Subheader featured Posts (With Thumbnails)','highthemes').'</strong><span class="ht_desc"> '.__('/ if you selected post/page/portfolio posts from the list above)Enter a comma-separated list of ID\'s that you\'d like to be shown as subheader featured posts on this page/post. (e.g. 1,13,42,4). ','highthemes').'</span><br />
	 	  <label for="ht_post_subheading_posts_ids" class="screen-reader-text">'.__('Posts IDs?','highthemes').'</label>
	 	  <input value="'.$ht_post_subheading_posts_ids  .'" type="text" class="" name="ht_post_subheading_posts_ids" id="ht_post_subheading_posts_ids"/>
	 	  </p>';

	echo '<p class="separate">
		  <strong>'.__('Button Title','highthemes').'</strong><span class="ht_desc"> '.__('/ if you selected button from the list above) Enter a title for subheading button.','highthemes').'</span><br />
		  <label for="ht_post_subheading_button_title" class="screen-reader-text">'.__('Button Title','highthemes').'</label>
		  <input value="'.$ht_post_subheading_button_title  .'" type="text" class="" name="ht_post_subheading_button_title" id="ht_post_subheading_button_title"/>
		  </p>';

	echo '<p class="separate">
		  <strong>'.__('Button Link','highthemes').'</strong><span class="ht_desc"> '.__('/ if you selected button from the list above) Enter a link for subheader button.','highthemes').'</span><br />
		  <label for="ht_post_subheading_button_link" class="screen-reader-text">'.__('Button Link','highthemes').'</label>
		  <input value="'.$ht_post_subheading_button_link  .'" type="text" class="" name="ht_post_subheading_button_link" id="ht_post_subheading_button_link"/>
		  </p>';


}

add_action('save_post', 'ht_subheading_options_save');

function ht_subheading_options_save($post_id) {
	if (isset($_POST['ht_subheading_noncename']) && !wp_verify_nonce($_POST['ht_subheading_noncename'], 'ht-subheading')) return $post_id;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

	$selected_subheading = $_POST['selected_subheading'];
	$ht_post_subheading_posts_ids = $_POST['ht_post_subheading_posts_ids'];
	$ht_post_subheading_button_title = $_POST['ht_post_subheading_button_title'];
	$ht_post_subheading_button_link = $_POST['ht_post_subheading_button_link'];
	$ht_teaser_text = $_POST['ht_teaser_text'];
	

	update_post_meta($post_id, '_selected_subheading', $selected_subheading);
	update_post_meta($post_id, '_ht_post_subheading_posts_ids', $ht_post_subheading_posts_ids);
	update_post_meta($post_id, '_ht_post_subheading_button_title', $ht_post_subheading_button_title);
	update_post_meta($post_id, '_ht_post_subheading_button_link', $ht_post_subheading_button_link);
	update_post_meta($post_id, '_ht_teaser_text', $ht_teaser_text);

}
?>