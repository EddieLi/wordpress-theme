<?php

/*
 * Slideshow Manager
 */

require_once('slideshow.php');

/*
 * Portfolio 
 */

require_once('portfolio.php');

/*
 * Subheading Options
 */
 
require_once('subheading.php');

/*
 * Scripts
 */
 
function ht_enqueue_scripts() {
	if(!is_admin()){
		wp_enqueue_script('jquery.easing' , HT_JS_PATH . '/jquery.easing.1.3.js', array('jquery'), '1.3');
		wp_enqueue_script( 'jquery.tools', HT_JS_PATH .'/jquery.tools.min.js', array('jquery'));
		wp_enqueue_script( 'cycle-js', HT_JS_PATH .'/jquery.cycle.all.min.js', array('jquery'));
		wp_enqueue_script( 'prettyPhoto', HT_JS_PATH .'/jquery.prettyPhoto.js', array('jquery'));
		wp_enqueue_script( 'twitter.min', HT_JS_PATH .'/twitter.min.js', array('jquery'));
		wp_enqueue_script( 'innerfade', HT_JS_PATH .'/jquery.innerfade.js', array('jquery'));
		wp_enqueue_script( 'flowplayer', HT_JS_PATH .'/flowplayer-3.2.6.min.js', array('jquery'));	
		wp_enqueue_script( 'custom-js', HT_JS_PATH .'/custom.js', array('jquery'));
		
		
	}
}

add_action('wp_print_scripts', 'ht_enqueue_scripts');

/*
 * Additional featured images
 */

if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(array(
		'label' => 'Second Featured Image',
		'id' => 'second-featured-image',
		'post_type' => 'portfolio'
		)
	);
	
	new MultiPostThumbnails(array(
		'label' => 'Third Featured Image',
		'id' => 'third-featured-image',
		'post_type' => 'portfolio'
		)
	);
	
	new MultiPostThumbnails(array(
		'label' => 'Fourth Featured Image',
		'id' => 'fourth-featured-image',
		'post_type' => 'portfolio'
		)
	);
	
	new MultiPostThumbnails(array(
		'label' => 'Fifth Featured Image',
		'id' => 'fifth-featured-image',
		'post_type' => 'portfolio'
		)
	);
								
}

function ht_get_featured_images($post_id){
	$featured_images = array();
	
	if( ht_get_featured_image_url($post_id) != '' ) 
		$featured_images[] = ht_get_featured_image_url($post_id);
	
	if( ht_get_featured_image_url($post_id, 'second-featured-image') != '' ) 
		$featured_images[] = ht_get_featured_image_url($post_id, 'second-featured-image');
	
	if( ht_get_featured_image_url($post_id, 'third-featured-image') != '' ) 
		$featured_images[] = ht_get_featured_image_url($post_id, 'third-featured-image');
	
	if( ht_get_featured_image_url($post_id, 'fourth-featured-image') != '' ) 
		$featured_images[] = ht_get_featured_image_url($post_id, 'fourth-featured-image');
	
	if( ht_get_featured_image_url($post_id, 'fifth-featured-image') != '' ) 
		$featured_images[] = ht_get_featured_image_url($post_id, 'fifth-featured-image');
		
	return $featured_images;
	
}

function ht_get_featured_image_url($post_id, $image_id = ''){
	
	if($image_id =='') {
		$id = get_post_meta($post_id, "_thumbnail_id", true);
	} else {
		$id = get_post_meta($post_id, "portfolio_{$image_id}_thumbnail_id", true);
	}
	$image = wp_get_attachment_image_src($id,'large');
		
	return $image[0];
	
}

/*
 * Image Resizer
 */

function ht_image_resize($height,$width,$img_url) {
	
	if($img_url =='') return '';

	$image['url'] = $img_url;
	$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
	$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
	$image_info = @getimagesize($image_path);

	if (!$image_info)
	$image_info = @getimagesize($image['url']);

	$image['width'] = $image_info[0];
	$image['height'] = $image_info[1];
	if($img_url != "" && ($image['width'] > $width || $image['height'] > $height || !isset($image['width']))){
		$img_url = HT_JS_PATH."/thumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=100";
	}

	return $img_url;
}

/*
 * Getting portfolio terms list
 */

function ht_create_terms_list($taxonomy)
{
	global $wpdb;
	
	$sql = "SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy = '$taxonomy'";	
	$res = $wpdb->get_results($sql,'ARRAY_A');
	
	foreach ( $res as $col=>$value ){
		$term_ids .= $value['term_id'] . ",";	
	}
	
	$term_ids = substr($term_ids, 0, strlen($term_ids)-1);
	$term_res = $wpdb->get_results("SELECT * from $wpdb->terms WHERE term_id IN ($term_ids)",'ARRAY_A');
	
	return $term_res;

}

/*
 * Formatting description of menu items
 */

class description_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args)
	{
	   global $wp_query;
	   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	   $class_names = $value = '';
	
	   $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
	   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	   $class_names = ' class="'. esc_attr( $class_names ) . '"';
	
	   $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	
	   $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	   $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
	   $prepend = '<strong>';
	   $append = '</strong>';
	   $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
	
	   if($depth != 0)
	   {
				 $description = $append = $prepend = "";
	   }
	
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
}

/*
 * Uploader helpers
 */

// check wheter a custom post exists
function wp_exist_page_by_title($title_str) {
	global $wpdb;
	return $wpdb->get_row("SELECT ID FROM wp_posts WHERE post_title = '" . $title_str . "' && post_status = 'private' && post_type = 'highthemes'", 'ARRAY_N');
}

// get the option page id used for uploader
function get_option_page_ID( $page_title = '' ) {
	global $wpdb;
	return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '{$page_title}' AND post_type = 'highthemes' AND post_status != 'trash'");
}

// creating a private post for media uploader
function create_option_post() {
	if(!post_type_exists('highthemes')) {
		register_post_type( 'highthemes', array(
			'labels' => array(
			'name' => __( 'Options' ),
		),
			'public' => true,
			'show_ui' => false,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array( 'title', 'editor' ),
			'can_export' => true,
			'show_in_nav_menus' => false,)
		);

	$post_existance = wp_exist_page_by_title('media');

	if($post_existance[0] != '' ) {
		 $page_id = get_option_page_ID( 'media' );
	} else {
		// create post object
		$_p = array();
		$_p['post_title'] = 'Media';
		$_p['post_status'] = 'private';
		$_p['post_type'] = 'highthemes';
		$_p['comment_status'] = 'closed';
		$_p['ping_status'] = 'closed';
	
		// insert the post into the database
		$page_id = wp_insert_post( $_p );		
	}
		
	return $page_id;
	}

}

/*
 * Page Options metabox
 */

add_action('admin_menu', 'ht_page_add_custom_box');
function ht_page_add_custom_box() {
	global $theme_name;
	add_meta_box('ht_page_options', "Highthemes" . __(' - Page Options','highthemes'), 'ht_page_custom_box', 'page', 'normal', 'core');
}

function ht_page_custom_box() {
	global $post, $categories;
	$ht_page_type_category = unserialize(get_post_meta($post->ID,'_ht_page_type_category',true));
	$ht_page_type_news_category = get_post_meta($post->ID,'_ht_page_type_news_category',true);
	
	$ht_item_number = get_post_meta($post->ID,'_ht_item_number',true);
	$ht_page_type = get_post_meta($post->ID,'_ht_page_type',true);
	$ht_portfolio_layout = get_post_meta($post->ID,'_ht_portfolio_layout',true);

	/* array custom page types */
	$ht_page_types = array(
		"page" => __("Page",'highthemes'),
		"contact" => __("Contact",'highthemes'),		
		"blog" => __("Blog",'highthemes'),
		"news" => __("News",'highthemes'),		
		"portfolio" => __("Portfolio",'highthemes')
		
	);

	/* array of portfolio layouts */
	$portfolio_templates = array(
		"1c" => __("1 Column",'highthemes'),
		"2c" => __("2 Columns",'highthemes'),
		"3c" => __("3 Columns",'highthemes'),
		"4c" => __("4 Columns",'highthemes'),
		"5c" => __("5 Columns",'highthemes')
		);

	/* for security */
	echo '<input type="hidden" name="ht_page_noncename" id="ht_portfolio_noncename"
	 	  value="'.wp_create_nonce('ht-page-options').'" />';

	/* page type form element */
	echo '<p class="separate"><strong>'.__('Select the page type','highthemes').'</strong>
	 	  <label for="ht_page_type" class="screen-reader-text">'.__('Page Type','highthemes').'</label>';
			
	echo '<select name="ht_page_type" id="ht_page_type" size="1">';
	foreach ($ht_page_types as $type_id=>$type_name) {
		echo '<option value="'.$type_id.'"';
		if ($ht_page_type == $type_id) echo ' selected="selected"';
		echo '>'.$type_name.'</option>';
	}
	
		echo '</select></p>';
	

	$terms = ht_create_terms_list('portfolio-category');
	/* Portfolio Category */
	echo '<p class="separate"><strong>'.__('Portfolio Category','highthemes').'</strong><br />';
		foreach ($terms as $id=>$term) {
		echo '<br /><label style="font-size: 12px; line-height: 25px;">'.$term['name'].': </label><input type="checkbox" name="ht_page_type_category[]" value="'.$term['slug'].'"';
		if(is_array($ht_page_type_category)){ if (in_array($term['slug'], $ht_page_type_category ) ) echo ' checked="checked"';}
		echo '>';
	}

	echo "</p>";
	
	
		/* News | Sub-blog Category */
	echo '<p class="separate"><strong>'.__('News/Sub-blog Category','highthemes').'</strong>
	 	  <label for="ht_page_type_news_category" class="screen-reader-text">'.__('Category','highthemes').'</label>';

	echo '<select name="ht_page_type_news_category" id="ht_page_type_news_category" size="1">';
	foreach ($categories as $id=>$category) {
		echo '<option value="'.$id.'"';
		if ($ht_page_type_news_category == $id) echo ' selected="selected"';
		echo '>'.$category.'</option>';
	}
	echo "</select></p>";

	/* Number of items per pages */
	echo '<p class="separate"><strong>'.__('Items per page?','highthemes').'</strong>
		  <label for="ht_item_number" class="screen-reader-text">'.__('Image per page?','highthemes').'</label>
		  <input value="'.$ht_item_number  .'" type="text" name="ht_item_number" id="ht_item_number"/>
		  </p>';

	/* portfolio layouts */
	
 	echo '<p class="separate"><strong>'.__('Select the Portfolio Layout','highthemes').'</strong>
	 	  <label for="ht_portfolio_layout" class="screen-reader-text">'.__('Portfolio Layout','highthemes').'</label>';
	
	echo '<select name="ht_portfolio_layout" id="ht_portfolio_layout" size="1">';
	foreach ($portfolio_templates as $template_id=>$template_name) {
		echo '<option value="'.$template_id.'"';
		if ($ht_portfolio_layout == $template_id) echo ' selected="selected"';
		echo '>'.$template_name.'</option>';
	}
		echo "</select></p>";
}

add_action('save_post', 'ht_page_save_postdata');

function ht_page_save_postdata($post_id) {
	if (isset($_POST['ht_page_noncename']) && !wp_verify_nonce($_POST['ht_page_noncename'], 'ht-page-options')) return $post_id;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

	$ht_page_type_category = serialize($_POST['ht_page_type_category']);
	$ht_page_type_news_category = $_POST['ht_page_type_news_category'];
	$ht_item_number = $_POST['ht_item_number'];
	$ht_page_type = $_POST['ht_page_type'];
	$ht_portfolio_layout = $_POST['ht_portfolio_layout'];

	update_post_meta($post_id, '_ht_page_type_category', $ht_page_type_category);
	update_post_meta($post_id, '_ht_page_type_news_category', $ht_page_type_news_category);	
	update_post_meta($post_id, '_ht_item_number', $ht_item_number);
	update_post_meta($post_id, '_ht_page_type', $ht_page_type);
	update_post_meta($post_id, '_ht_portfolio_layout', $ht_portfolio_layout);
	
}


/*
 * Posts Options 
 */
add_action('admin_menu', 'ht_post_metabox');

function ht_post_metabox() {
	global $theme_name;

	add_meta_box('ht_post_metabox', "Highthemes" . __(' - Posts Options','highthemes'), 'ht_post_custom_metabox', 'post', 'normal', 'high');
}

function ht_post_custom_metabox() {
	global $post;

	$ht_post_layout = get_post_meta($post->ID,'_ht_post_layout',true);
	$ht_post_image = get_post_meta($post->ID,'_ht_post_image',true);
	$ht_portfolio_vlink = get_post_meta($post->ID,'_ht_portfolio_vlink',true);
	
	if($ht_post_layout =="true") $ht_post_layout = 'checked="checked"';
	if($ht_post_image =="true") $ht_post_image = 'checked="checked"';

	echo '<input type="hidden" name="ht_post_noncename" id="ht_post_noncename"
	 	  value="'.wp_create_nonce('ht-post-item').'" />';

	echo '<p class="separate">
	 	  <strong>'.__('Disable Post Image?','highthemes').'</strong><span class="ht_desc"> '.__('/ Check this box in order to hide the post image in detail page.','highthemes').'</span><br /><br />

	 	  <label for="ht_post_image" class="">'.__('Disable Post Image?','highthemes').' </label>
		  <input '. $ht_post_image .' type="checkbox" name="ht_post_image" value="true" id="ht_post_image" />
	 	  </p>';
		  
	echo '<p class="separate">
	 	  <strong>'.__('Enable Full-Width Post Layout?','highthemes').'</strong><span class="ht_desc"> '.__('/ Default posts layout is with sidebar. If you like to remove the sidebar, check this box.','highthemes').'</span><br /><br />

	 	  <label for="ht_post_layout" class="">'.__('Full-Width?','highthemes').' </label>
		  <input '. $ht_post_layout .' type="checkbox" name="ht_post_layout" value="true" id="ht_post_layout" />
	 	  </p>';

	echo '<p class="separate">
		  <strong>'.__('Video Link','highthemes').'</strong><span class="ht_desc"> '.__('/ To show video in the lightbox you can paste its link here. what type? (http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/)','highthemes').'</span><br />
		  <label for="ht_portfolio_vlink" class="screen-reader-text">'.__('Video Link?','highthemes').'</label>
		  <input value="'.$ht_portfolio_vlink  .'" type="text" class="full_text" name="ht_portfolio_vlink" id="ht_portfolio_vlink"/>
		  </p>';	
}

add_action('save_post', 'ht_post_metabox_save_postdata');

function ht_post_metabox_save_postdata($post_id) {
	if (!wp_verify_nonce($_POST['ht_post_noncename'], 'ht-post-item')) return $post_id;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

	$ht_post_layout = $_POST['ht_post_layout'];
	$ht_post_image = $_POST['ht_post_image'];
	$ht_portfolio_vlink = $_POST['ht_portfolio_vlink'];
	
	update_post_meta($post_id, '_ht_post_layout', $ht_post_layout);
	update_post_meta($post_id, '_ht_post_image', $ht_post_image);
	update_post_meta($post_id, '_ht_portfolio_vlink', $ht_portfolio_vlink);
}

/*
 * Enable Threaded Comments
 */
function enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
		wp_enqueue_script('comment-reply');
	}
}
add_action('get_header', 'enable_threaded_comments');

/*
 * Custom Comments
 */
function custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
<div <?php comment_class(); ?> id="div-comment-<?php comment_ID() ?>">
<div class="comment-entry" id="comment-<?php comment_ID(); ?>">
 <span class="reply">
  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </span>
 <div><span class="frame"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?></span>
    
    <div class="body">
    <cite><?php comment_author_link(); ?></cite> &raquo; <span class="meta">
      <?php comment_date('d. M, Y'); ?>
      </span>
      <?php if ($comment->comment_approved == '0') : ?>
      <em>
      <?php _e('Your comment is awaiting moderation.','highthemes') ?>
      </em> <br />
      <?php endif; ?>
      <div class="commenttext">
        <?php comment_text() ?>
      </div>
    </div>
    <div class="fix"></div>
    </div>

</div>
<!-- END section -->
<?php
}

/*
 * Related Posts
 */
function ht_related_post() {
?>
<?php
	global $post, $wpdb;
	$backup = $post;  // backup the current object
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
		$tagcount = count($tags);
		for ($i = 0; $i < $tagcount; $i++) {
			$tagIDs[$i] = $tags[$i]->term_id;
		}
		$args=array(
	    'tag__in' => $tagIDs,
	    'post__not_in' => array($post->ID),
	    'showposts'=>4,
	    'caller_get_posts'=>1
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) { $related_post_found = true; ?>
 <div class="related-posts">

  <h3><?php _e('Related Posts','highthemes'); ?></h3>
  <ul class="thumb-list">
	<?php
	$i=1;
	while ($my_query->have_posts()) : $my_query->the_post(); 
    
	$post_id = get_the_ID();
	$post_thumbnail = get_the_post_thumbnail($post_id, array(60, 60), array("class" => "post_thumbnail frame"));

	if(!$post_thumbnail){
		$post_thumbnail = '<img class="frame" alt="image" src="'.get_template_directory_uri() .'/images/empty_thumb.gif" />';
	}
?>
    <li class="one_half <?php if(($i%2)==0 && $i<>0){ echo ' last';}?>">
    <a class="fl" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
    <?php echo $post_thumbnail;?></a>
      <p><a class="thumb-title" href="<?php the_permalink() ?>"	rel="bookmark"> <?php the_title(); ?></a><br />
        <span class="date">
        <?php the_date(); ?>
        </span>
      <br class="fix" />
      </p>
    </li>
    <?php   
	$i++; 
	endwhile; 
	?>
  </ul>
  </div>

  <?php 
  }
	}

wp_reset_query();

?>

<?php

}

/*
 * Register Widgets
 */
function the_widgets_init() {
	if ( !function_exists('register_sidebars') )
	return;
	
	register_sidebars(1,array('name' => __('Default Sidebar','highthemes'), 'id'=>'default-sidebar', 'before_widget' => 
	'<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));

	register_sidebar(array(	'name'=>'Footer-1',	'id'=> 'footer-1','before_widget' => 
	'<div id="footer%1$s" class="%2$s">','after_widget'  => '</div>','before_title'  => '<h3>','after_title' => '</h3>' ));
	
	register_sidebar(array(	'name'=>'Footer-2',	'id'=> 'footer-2','before_widget' => 
	'<div id="footer%1$s" class="%2$s">','after_widget'  => '</div>','before_title'  => '<h3>','after_title' => '</h3>' ));
	
	register_sidebar(array(	'name'=>'Footer-3',	'id'=> 'footer-3','before_widget' => 
	'<div id="footer%1$s" class="%2$s">','after_widget'  => '</div>','before_title'  => '<h3>','after_title' => '</h3>' ));
	
	register_sidebar(array(	'name'=>'Footer-4',	'id'=> 'footer-4','before_widget' => 
	'<div id="footer%1$s" class="%2$s">','after_widget'  => '</div>','before_title'  => '<h3>','after_title' => '</h3>' ));
	
	register_sidebar(array(	'name'=>'Footer-5',	'id'=> 'footer-5','before_widget' => 
	'<div id="footer%1$s" class="%2$s">','after_widget'  => '</div>','before_title'  => '<h3>','after_title' => '</h3>' ));	
	 
}

add_action( 'init', 'the_widgets_init' );

/* 
 * Embed any video!
 */
 
function embed_video($url, $width=550, $height=400) {
	$youtube = "/http:\/\/(.*youtube\.com\/watch.*|.*\.youtube\.com\/v\/.*|youtu";
	$youtube .="\.be\/.*|.*\.youtube\.com\/user\/.*#.*|.*\.youtube\.com\/.*#.*\/.*)/i";
	$dailymotion = "/http:\/\/(.*\.dailymotion\.com\/video\/.*|.*\.dailymotion\.com\/.*\/video\/.*)/i";
	$vimeo ="/http:\/\/(www\.vimeo\.com\/groups\/.*\/videos\/.*|www\.vimeo\.com\/.*|vimeo\.com\/groups\/.*\/videos\/.*|vimeo\.com\/.*)/i";
	
	if( preg_match($vimeo, $url) ) {
		$video_flag = 'vimeo';	
	}
	elseif ( preg_match($youtube, $url) ) {
		$video_flag = 'youtube';	
	}
	elseif ( preg_match($dailymotion, $url) ) {
		$video_flag = 'dailymotion';	
	}
	else {
	$video_flag = 'flow';	
	}
	
	switch ($video_flag) {
		case 'vimeo':
			$path = 'http://vimeo.com/moogaloop.swf?clip_id=';
		break;	
	
		case 'youtube':
			$path = 'http://www.youtube.com/v/';
		break;
	
		case 'dailymotion':
			$path = 'http://www.dailymotion.com/swf/video/';
		break;
	}
	
	switch ($video_flag) {
		case 'vimeo':
			preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches );
			$video_id = $matches[3];
		break;
	
		case 'youtube':
			preg_match('#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i',$url, $matches);
			$video_id = $matches[3];
			break;
	
		case 'dailymotion':
			preg_match('#http://(www.dailymotion|dailymotion)\.com/(.+)/([0-9a-zA-Z]+)\_(.*?)#i',$url, $matches);
			$video_id = $matches[3];
		break;
	
	}	
	
	switch ($video_flag) {
		case 'vimeo':
			$param = '&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1';
		break;	
	
		case 'youtube':
			$param = '&amp;fs=1&amp;rel=0&amp;hd=1&amp;showsearch=0&amp;showinfo=1';
		break;
	
		case 'dailymotion':
			$param = '?additionalInfos=0';
		break;

}
	
	if($video_flag == 'vimeo' || $video_flag =='youtube' || $video_flag == 'dailymotion') {
		$embedstring= '<object type="application/x-shockwave-flash" width="' . 
		$width .'" height="' . $height . '" data="'. $path . $video_id . $param.'">'.
					 '<param name="movie" value="' . $path . $video_id . $param . '" />' .
					 '<param name="allowFullScreen" value="true" />' .
					 '<param name="wmode" value="transparent" />' .
					 '<param name="allowscriptaccess" value="always" />' .
					 '<param name="flashvars" value="autoplay=false" />' .
					 '</object>';
					 
		return $embedstring;
								 
	} else {
		
		$output = '	<a  
				 href="'.$url.'"
				 style="display:block;width:'.$width.'px;height:'.$height.'px"  
				 id="player"> 
			</a> 
		
			<!-- this will install flowplayer inside previous A- tag. -->
			<script type="text/javascript">
				flowplayer("player", { src: \''.HT_JS_PATH.'/flowplayer-3.2.7.swf\', wmode: \'transparent\'},{ clip: { autoPlay: false },  canvas: {backgroundColor:\'#eeeeee\' }});
			</script>';
			return $output;
	}

}
 
/*
 * Misc
 */
 
add_theme_support('automatic-feed-links');
// register navs
register_nav_menu( 'nav', __('Primary Navigation of Romix','highthemes') );
register_nav_menu( 'footer_nav', __('Footer Navigation of Romix','highthemes') );

// tweak wp_title
function ht_filter_wp_title( $title, $separator ) {
	if ( is_feed() )
	return $title;

	global $paged, $page;

	if ( is_search() ) {
		$title = sprintf( __( 'Search results for %s','highthemes'), '"' . get_search_query() . '"' );
		if ( $paged >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s','highthemes' ), $paged );
		$title .= " $separator " . get_bloginfo( 'name', 'highthemes' );
		return $title;
	}

	$title .= get_bloginfo( 'name', 'highthemes' );

	$site_description = get_bloginfo( 'description', 'highthemes' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2 )
	$title .= " $separator " . sprintf( __( 'Page %s','highthemes' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'ht_filter_wp_title', 10, 2 );

// add excertp to pages
add_post_type_support( 'page', 'excerpt' );

// enable shortcodes on widgets
add_filter('widget_text', 'do_shortcode');

// enable post thumbnail
if ( function_exists('add_theme_support') ) {
	add_theme_support('post-thumbnails');
}

// register post formats for wp 3.1
add_theme_support('post-formats', array('image', 'link', 'quote', 'status', 'video')); 

// create a few thumb sizes
set_post_thumbnail_size( 64, 44, true );
add_image_size( 'small-thumb', 60, 60, true ); 
add_image_size( 'featured-item', 141, 100, true ); 

// new excerpt
function ht_excerpt($length, $ellipsis) {
	$text = get_the_content();
	$text = preg_replace('`\[[^\]]*\]`','',$text);
	$text = strip_tags($text);
	if(strlen($text) <= $length) {
		
		return $text;
	}
	else {
		$text = substr($text, 0, $length);
		$text = substr($text, 0, strripos($text, " "));
		$text = $text.$ellipsis;
		return $text;
	}
}
// change more sign
function new_excerpt_more($more) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// add admin options to admin bar
function ht_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
		'id' => 'highthemes', // link ID, defaults to a sanitized title value
		'title' => __('HighThemes Admin Options'), // link title
		'href' => admin_url( 'admin.php?page=functions.php'), // name of file
		'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
}
add_action( 'wp_before_admin_bar_render', 'ht_admin_bar_render' );

/*
 * Author Bio
 */

function ht_author_bio() { ?>
<div id="author-info" class="gradient-box">
  <div class="border-style">
    <div class="inner"><span class="frame fl"><?php echo get_avatar( get_the_author_meta('email'), '60' ); ?></span>
      <p><strong>
        <?php the_author_link(); ?>
        </strong> <br />
        <?php if(get_the_author_meta('description') == '') {
			  	 	echo 'The author didn\'t add any Information to his profile yet. ';
			   } else {
				 	the_author_meta('description');
			   } ?>
      </p>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php
}
?>