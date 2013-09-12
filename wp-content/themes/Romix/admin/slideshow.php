<?php
/*
 * Slideshow Custom Post Type
 */
add_action('init', 'ht_slideshow_type');

function ht_slideshow_type() {
  $labels = array(
    'name' => __('Slideshow','highthemes'),
    'singular_name' => __('Slideshow Item','highthemes'),
    'add_new' => __('Add New','highthemes'),
    'add_new_item' => __('Add New Item','highthemes'),
    'edit_item' => __('Edit Item','highthemes'),
    'new_item' => __('New Item','highthemes'),
    'view_item' => __('View Slideshow Item','highthemes'),
    'search_items' => __('Search Slideshow Items','highthemes'),
    'not_found' =>  __('No items found','highthemes'),
    'not_found_in_trash' => __('No items found in Trash','highthemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments')
  ); 


  register_post_type( 'slideshow' , $args );
}

//add filter to insure the text Item, or Item, is displayed when user updates a Item 
add_filter('post_updated_messages', 'slideshow_updated_messages');
function slideshow_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['slideshow'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Item updated. <a href="%s">View Item</a>','highthemes'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.','highthemes'),
    3 => __('Custom field deleted.','highthemes'),
    4 => __('Item updated.','highthemes'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Item restored to revision from %s','highthemes'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Item published. <a href="%s">View Item</a>','highthemes'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Item saved.','highthemes'),
    8 => sprintf( __('Item submitted. <a target="_blank" href="%s">Preview Item</a>','highthemes'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Item</a>','highthemes'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Item draft updated. ','highthemes') . '<a target="_blank" href="%s">Preview Item</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


/*
 * Adding custom metaboxes to slideshow
 */


add_action('admin_menu', 'ht_slideshow_add_custom_box');
function ht_slideshow_add_custom_box() {
	global $theme_name;
	add_meta_box('ht_slideshow', "Highthemes" . __(' - Slideshow Options','highthemes'), 'ht_slideshow_custom_box', 'slideshow', 'normal', 'core');
}

function ht_slideshow_custom_box() {
	global $post;
	 
	$ht_slideshow_type = get_post_meta($post->ID,'_ht_slideshow_type',true);
	$ht_slideshow_caption = get_post_meta($post->ID,'_ht_slideshow_caption',true);
	$ht_slideshow_link = get_post_meta($post->ID,'_ht_slideshow_link',true);
	$ht_slideshow_video = get_post_meta($post->ID,'_ht_slideshow_video',true);
	$ht_slideshow_ex_link = get_post_meta($post->ID,'_ht_slideshow_ex_link',true);

	$ht_slideshow_caption_type = get_post_meta($post->ID,'_ht_slideshow_caption_type',true);

	/* array caption types */
	$ht_slideshow_caption_type_arr = array(
		"cpt-title" => __("Title",'highthemes'),
		"cpt-both" => __("Title & Description",'highthemes'),
		"cpt-desc" => __("Description",'highthemes'),		
	);	
	/* array slideshow types */
	$ht_slideshow_type_arr = array(
		"full" => __("Full",'highthemes'),
		"cropped_left" => __("Cropped Left",'highthemes'),
		"cropped_right" => __("Cropped Right",'highthemes')	
	);

	/* array of slideshow caption */
	$ht_slideshow_caption_arr = array(
		"top" => __("Top",'highthemes'),	
		"right" => __("Right",'highthemes'),
		"bottom" => __("Bottom",'highthemes'),
		"left" => __("Left",'highthemes'),
		
		"topleft" => __("Top/Left",'highthemes'),
		"topright" => __("Top/right",'highthemes'),
		"bottomleft" => __("Bottom/Left",'highthemes'),
		"bottomright" => __("Bottom/right",'highthemes'),
		
		"disable" => __("Disable",'highthemes')
	);

	
	/* for security */
	echo '<input type="hidden" name="ht_slideshow_noncename" id="ht_slideshow_noncename"
	 	  value="'.wp_create_nonce('ht-slideshow').'" />';

	/* slideshow type */
	echo '<p class="separate"><strong>'.__('Select the slideshow type','highthemes').'</strong>
	 	  <label for="ht_slideshow_type" class="screen-reader-text">'.__('Slideshow Type','highthemes').'</label>';
			
	echo '<select name="ht_slideshow_type" id="ht_slideshow_type" size="1">';
	foreach ($ht_slideshow_type_arr as $type_id=>$type_name) {
		echo '<option value="'.$type_id.'"';
		if ($ht_slideshow_type == $type_id) echo ' selected="selected"';
		echo '>'.$type_name.'</option>';
	}
		echo '</select></p>';
	
	/* Caption Type */
	echo '<p class="separate"><strong>'.__('Select caption type','highthemes').'</strong>
	 	  <label for="ht_slideshow_caption_type" class="screen-reader-text">'.__('Select caption type','highthemes').'</label>';

	echo '<select name="ht_slideshow_caption_type" id="ht_slideshow_caption_type" size="1">';
	foreach ($ht_slideshow_caption_type_arr as $id=>$caption) {
		echo '<option value="'.$id.'"';
		if ($ht_slideshow_caption_type == $id) echo ' selected="selected"';
		echo '>'.$caption.'</option>';
	}

	echo "</select></p>";

	/* Caption */
	echo '<p class="separate"><strong>'.__('Select caption alignment','highthemes').'</strong>
	 	  <label for="ht_slideshow_caption" class="screen-reader-text">'.__('Select caption alignment','highthemes').'</label>';

	echo '<select name="ht_slideshow_caption" id="ht_slideshow_caption" size="1">';
	foreach ($ht_slideshow_caption_arr as $id=>$caption) {
		echo '<option value="'.$id.'"';
		if ($ht_slideshow_caption == $id) echo ' selected="selected"';
		echo '>'.$caption.'</option>';
	}

	echo "</select></p>";

	/* Video URL */
	echo '<p class="separate"><strong>'.__('Insert a video URL','highthemes').' <small>'. __('Vimeo, Youtube, Dailymotion, or path to self hosted (mp4, flv, swf) files.','highthemes') . '</small></strong>
		  <label for="ht_slideshow_video" class="screen-reader-text">'.__('Insert a video URL','highthemes').'</label>
		  <input class="widetext" value="'.$ht_slideshow_video  .'" type="text" name="ht_slideshow_video" id="ht_slideshow_video"/>
		  </p>';
		  
	/* External Link */
	echo '<p class="separate"><strong>'.__('Insert an external link ','highthemes').'<small>for example: http://www.site.com</small></strong>
		  <label for="ht_slideshow_ex_link" class="screen-reader-text">'.__('Insert an external link','highthemes').'</label>
		  <input class="widetext" value="'.$ht_slideshow_ex_link  .'" type="text" name="ht_slideshow_ex_link" id="ht_slideshow_ex_link"/>
		  </p>';		  
		  
	/* Disable slideshow link */
	if($ht_slideshow_link =="false") $ht_slideshow_link = 'checked="checked"';
	
	echo '<p class="separate">
	 	  <strong>'.__('Disable slideshow link?','highthemes').'</strong><span class="ht_desc"> '.__('/ If you want this slidshow item has no link, check this box.','highthemes').'</span><br /><br />

	 	  <label for="ht_slideshow_link" class="">'.__('Disable slideshow link?','highthemes').'</label>
		  <input '. $ht_slideshow_link .' type="checkbox" name="ht_slideshow_link" value="false" id="ht_slideshow_link" />
	 	  </p>';	  
		  
}

add_action('save_post', 'ht_slideshow_save_postdata');

function ht_slideshow_save_postdata($post_id) {
	if (isset($_POST['ht_slideshow_noncename']) && !wp_verify_nonce($_POST['ht_slideshow_noncename'], 'ht-slideshow')) return $post_id;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

			
		$ht_slideshow_type = $_POST['ht_slideshow_type'];
		$ht_slideshow_caption = $_POST['ht_slideshow_caption'];
		$ht_slideshow_caption_type = $_POST['ht_slideshow_caption_type'];
		$ht_slideshow_link = $_POST['ht_slideshow_link'];
		$ht_slideshow_video = $_POST['ht_slideshow_video'];
		$ht_slideshow_ex_link = $_POST['ht_slideshow_ex_link'];
	
		update_post_meta($post_id, '_ht_slideshow_type', $ht_slideshow_type);
		update_post_meta($post_id, '_ht_slideshow_caption', $ht_slideshow_caption);
		update_post_meta($post_id, '_ht_slideshow_caption_type', $ht_slideshow_caption_type);
		update_post_meta($post_id, '_ht_slideshow_link', $ht_slideshow_link);
		update_post_meta($post_id, '_ht_slideshow_video', $ht_slideshow_video);
		update_post_meta($post_id, '_ht_slideshow_ex_link', $ht_slideshow_ex_link);
}

if ( !function_exists('ht_add_thumb_col') && function_exists('add_theme_support') ) {

	function ht_add_thumb_col($cols) {

		$cols['thumbnail'] = __('Thumbnail','highthemes');

		return $cols;
	}
	function fb_add_thumb_value($column_name, $post_id) {

			$width = (int) 80;
			$height = (int) 80;

			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				// image from gallery
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None','highthemes');
					}
			}
	}

	// for posts
	add_filter( 'manage_posts_columns', 'ht_add_thumb_col' );
	add_action( 'manage_posts_custom_column', 'fb_add_thumb_value', 10, 2 );

	// for pages
	add_filter( 'manage_pages_columns', 'ht_add_thumb_col' );
	add_action( 'manage_pages_custom_column', 'fb_add_thumb_value', 10, 2 );
	
	// for slideshow
	add_filter( 'manage_slideshow_columns', 'ht_add_thumb_col' );
	add_action( 'manage_slideshow_custom_column', 'fb_add_thumb_value', 10, 2 );	
}


?>