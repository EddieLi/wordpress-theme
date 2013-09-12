<?php
/*
 * Portfolio Custom Post Type
 */
 
add_action('init', 'ht_portfolio_type');

function ht_portfolio_type() {
  $labels = array(
    'name' => __('Portfolio','highthemes'),
    'singular_name' => __('Portfolio Item','highthemes'),
    'add_new' => __('Add New','highthemes'),
    'add_new_item' => __('Add New Item','highthemes'),
    'edit_item' => __('Edit Item','highthemes'),
    'new_item' => __('New Item','highthemes'),
    'view_item' => __('View Portfolio Item','highthemes'),
    'search_items' => __('Search Portfolio Items','highthemes'),
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
    'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
  ); 
  register_post_type( 'portfolio' , $args );
}

add_filter('post_updated_messages', 'portfolio_updated_messages');
function portfolio_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['portfolio'] = array(
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

//add thumbnail col to portfolio list
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
	
	// for portfolio
	add_filter( 'manage_portfolio_columns', 'ht_add_thumb_col' );
	add_action( 'manage_portfolio_custom_column', 'fb_add_thumb_value', 10, 2 );	
}

// register custom taxonomy for portfolio
register_taxonomy('portfolio-category',array('portfolio'), array(
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
  ));
  
  

/*
 * Portfolio Custom Fields
 */
add_action('admin_menu', 'ht_portfolio_item_box');

function ht_portfolio_item_box() {
	global $theme_name;

	add_meta_box('ht_portfolio_item', "Highthemes" . __(' - Posts Options','highthemes'), 'ht_portfolio_item_custom_box', 'portfolio', 'normal', 'high');
}

function ht_portfolio_item_custom_box() {
	global $post;

	$ht_portfolio_vlink = get_post_meta($post->ID,'_ht_portfolio_vlink',true);
	$ht_portfolio_post_layout = get_post_meta($post->ID,'_ht_portfolio_post_layout',true);
	$ht_image_lightbox	= get_post_meta($post->ID,'_ht_image_lightbox',true);
	
	if($ht_portfolio_post_layout =="true") $ht_portfolio_post_layout = 'checked="checked"';
	if($ht_image_lightbox =="true") $ht_image_lightbox = 'checked="checked"';


	echo '<input type="hidden" name="ht_portfolio_noncename" id="ht_portfolio_noncename"
	 	  value="'.wp_create_nonce('ht-portfolio-item').'" />';

	echo '<p class="separate">
	 	  <strong>'.__('Disable Lightbox Effect?','highthemes').'</strong><span class="ht_desc"> '.__('/ On blog and portfolio, images have lightbox effect by default. Check this box if you want to disable it.','highthemes').'</span><br /><br />

	 	  <label for="ht_image_lightbox" class="">'.__('Disable Lightbox Effect?','highthemes').' </label>
		  <input '. $ht_image_lightbox .' type="checkbox" name="ht_image_lightbox" value="true" id="ht_image_lightbox" />
	 	  </p>';

	echo '<p class="separate">
	 	  <strong>'.__('Disable Full-Width Post Layout?','highthemes').'</strong><span class="ht_desc"> '.__('/ Default posts layout is without sidebar. If you like to have the sidebar, check this box.','highthemes').'</span><br /><br />

	 	  <label for="ht_portfolio_post_layout" class="">'.__('Sidebar?','highthemes').' </label>
		  <input '. $ht_portfolio_post_layout .' type="checkbox" name="ht_portfolio_post_layout" value="true" id="ht_portfolio_post_layout" />
	 	  </p>';


	echo '<p class="separate">
		  <strong>'.__('Portfolio Video Link','highthemes').'</strong><span class="ht_desc"> '.__('/ To embed a video into them portfolio you can paste its link here.  what type? (http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/)','highthemes').'</span><br />
		  <label for="ht_portfolio_vlink" class="screen-reader-text">'.__('Portfolio Video Link?','highthemes').'</label>
		  <input value="'.$ht_portfolio_vlink  .'" type="text" class="full_text" name="ht_portfolio_vlink" id="ht_portfolio_vlink"/>
		  </p>';		
}

add_action('save_post', 'ht_portfolio_item_save_postdata');

function ht_portfolio_item_save_postdata($post_id) {
	if (isset($_POST['ht_portfolio_noncename']) && !wp_verify_nonce($_POST['ht_portfolio_noncename'], 'ht-portfolio-item')) return $post_id;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

	$ht_portfolio_vlink = $_POST['ht_portfolio_vlink'];
	$ht_portfolio_post_layout = $_POST['ht_portfolio_post_layout'];
	$ht_image_lightbox = $_POST['ht_image_lightbox'];

	update_post_meta($post_id, '_ht_image_lightbox', $ht_image_lightbox);
	update_post_meta($post_id, '_ht_portfolio_vlink', $ht_portfolio_vlink);
	update_post_meta($post_id, '_ht_portfolio_post_layout', $ht_portfolio_post_layout);


}

?>