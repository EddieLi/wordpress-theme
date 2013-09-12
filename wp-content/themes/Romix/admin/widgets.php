<?php
/**
 * HighThemes Recent Posts Widget
 */

class HT_Recent_Posts extends WP_Widget {
	
	function HT_Recent_Posts() {
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_recent_posts',
							'description' => __( 'The most recent posts with thumbnails','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Recent_Posts',"Highthemes -  " . __('Recent Posts','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		
		$exclude_blog_cats = preg_replace('!(\d)+!','-${0}$0', get_option('ht_excluded_cats'));
		$posts_number  = (int) $instance['posts_number'];
		$posts = get_posts("cat=$exclude_blog_cats&numberposts=$posts_number&offset=0");

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		

		if($posts){ ?>

		<ul class="thumb-list">
		<?php foreach($posts as $post){
		
		$post_title = stripslashes($post->post_title);
		$post_date = $post->post_date;
		$post_date = mysql2date('F j, Y', $post_date, false);
		$permalink = get_permalink($post->ID);

		$post_thumbnail = get_the_post_thumbnail($post->ID, array(60, 60), array("class" => "post_thumbnail frame"));

		if(!$post_thumbnail){
			$post_thumbnail = '<img class="frame" alt="image" src="'.get_template_directory_uri() .'/images/empty_thumb.gif" />';
		}
		?>
		<li><a class="fl" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
        <?php echo $post_thumbnail;?></a>
		<a class="thumb-title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a><br />
		<span class="date"><?php echo $post_date; ?></span></li>
		<?php } ?>
		</ul>
		<?php }
		echo $after_widget;
		
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		// replace old with new
		$instance['posts_number'] = (int) strip_tags($new_instance['posts_number']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'posts_number' => 3, 'title'=> __('Recent Posts','highthemes') ) );
	$posts_number = (int) strip_tags($instance['posts_number']);
	$title =  strip_tags($instance['title']);
	
	// print the form fields
?>
	
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>    
        
    <p><label for="<?php echo $this->get_field_id('posts_number'); ?>">
	<?php _e('Number of Posts:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo
		esc_attr($posts_number); ?>" /></p>
	<?php
	}
	}

/**
 * HighThemes 120x120 ads
 */

class HT_Ad_Widget extends WP_Widget {
	
	function HT_Ad_Widget() {
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_ad_widget',
							'description' => __( 'Displays 6 115x115 ads blocks','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Ad_Widget',"Highthemes -  " . __('Custom 115x115 Ads','highthemes'), $widget_ops);

	}
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$ad1 = $instance['ad1'];
		$ad2 = $instance['ad2'];
		$ad3 = $instance['ad3'];
		$ad4 = $instance['ad4'];
		$ad5 = $instance['ad5'];
		$ad6 = $instance['ad6'];
		$link1 = $instance['link1'];
		$link2 = $instance['link2'];
		$link3 = $instance['link3'];
		$link4 = $instance['link4'];
		$link5 = $instance['link5'];
		$link6 = $instance['link6'];
		$randomize = $instance['random'];

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Advertisement','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		//Randomize ads order in a new array
		$ads = array();
			
		/* Display a containing div */
		echo '<div class="ads-125">';
		echo '<ul>';

		/* Display Ad 1. */
		if ( $link1 )
			$ads[] = '<li><a href="' . $link1 . '"><img src="' . $ad1 . '" width="115" height="115" alt="" /></a></li>';
			
		elseif ( $ad1 )
		 	$ads[] = '<li><img src="' . $ad1 . '" width="115" height="115" alt="" /></li>';
		
		/* Display Ad 2. */
		if ( $link2 )
			$ads[] = '<li><a href="' . $link2 . '"><img src="' . $ad2 . '" width="115" height="115" alt="" /></a></li>';
			
		elseif ( $ad2 )
		 	$ads[] = '<li><img src="' . $ad2 . '" width="115" height="115" alt="" /></li>';
			
		/* Display Ad 3. */
		if ( $link3 )
			$ads[] = '<li><a href="' . $link3 . '"><img src="' . $ad3 . '" width="115" height="115" alt="" /></a></li>';
			
		elseif ( $ad3 )
		 	echo '<li><img src="' . $ad3 . '" width="115" height="115" alt="" /></li>';
			
		/* Display Ad 4. */
		if ( $link4 )
			$ads[] = '<li><a href="' . $link4 . '"><img src="' . $ad4 . '" width="115" height="115" alt="" /></a></li>';
			
		elseif ( $ad4 )
		 	$ads[] = '<li><img src="' . $ad4 . '" width="115" height="115" alt="" /></li>';
			
		/* Display Ad 5. */
		if ( $link5 )
			$ads[] = '<li><a href="' . $link5 . '"><img src="' . $ad5 . '" width="115" height="115" alt="" /></a></li>';
			
		elseif ( $ad5 )
		 	$ads[] = '<li><img src="' . $ad5 . '" width="115" height="115" alt="" /></li>';
			
		/* Display Ad 6. */
		if ( $link6 )
			$ads[] = '<li><a href="' . $link6 . '"><img src="' . $ad6 . '" width="115" height="115" alt="" /></a></li>';
			
		elseif ( $ad6 )
		 	$ads[] = '<li><img src="' . $ad6 . '" width="115" height="115" alt="" /></li>';
		
		//Randomize order if user want it
		if ($randomize){
			shuffle($ads);
		}
		
		//Display ads
		foreach($ads as $ad){
			echo $ad;
		}
		
		echo '</ul>';
		echo '</div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['ad1'] = $new_instance['ad1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['ad3'] = $new_instance['ad3'];
		$instance['ad4'] = $new_instance['ad4'];
		$instance['ad5'] = $new_instance['ad5'];
		$instance['ad6'] = $new_instance['ad6'];
		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];
		$instance['link5'] = $new_instance['link5'];
		$instance['link6'] = $new_instance['link6'];
		$instance['random'] = $new_instance['random'];
		
		return $instance;
	}
		
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Advertisement',
		'ad1' => get_template_directory_uri()."/images/banner-ads.jpg",
		'link1' => 'http://www.highthemes.com',
		'ad2' => get_template_directory_uri()."/images/banner-ads.jpg",
		'link2' => 'http://www.highthemes.com',
		'ad3' => '',
		'link3' => '',
		'ad4' => '',
		'link4' => '',
		'ad5' => '',
		'link5' => '',
		'ad6' => '',
		'link6' => '',
		'random' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e('Ad 1 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad 1 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e('Ad 2 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad 2 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e('Ad 3 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad 3 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e('Ad 4 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad 4 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad5' ); ?>"><?php _e('Ad 5 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad5' ); ?>" name="<?php echo $this->get_field_name( 'ad5' ); ?>" value="<?php echo $instance['ad5']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link5' ); ?>"><?php _e('Ad 5 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link5' ); ?>" name="<?php echo $this->get_field_name( 'link5' ); ?>" value="<?php echo $instance['link5']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad6' ); ?>"><?php _e('Ad 6 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad6' ); ?>" name="<?php echo $this->get_field_name( 'ad6' ); ?>" value="<?php echo $instance['ad6']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link6' ); ?>"><?php _e('Ad 6 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link6' ); ?>" name="<?php echo $this->get_field_name( 'link6' ); ?>" value="<?php echo $instance['link6']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'random' ); ?>"><?php _e('Randomize ads order?','highthemes') ?></label>
			<?php if ($instance['random']){ ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>" checked="checked" />
			<?php } else { ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>"  />
			<?php } ?>
		</p>
	<?php
	}
}


/**
 * HighThemes Popular Posts
 */

class HT_Popular_Posts extends WP_Widget {
	
	function HT_Popular_Posts() {
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_popular_posts',
							'description' => __( 'The most popular posts with thumbnails','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Popular_Posts',"Highthemes -  " . __('Popular Posts','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		
	$pop_posts =  (int) strip_tags($instance['posts_number']);
	
	if (empty($pop_posts) || $pop_posts < 1) $pop_posts = 3;
	$now = gmdate("Y-m-d H:i:s",time());
	$lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
	$popularposts = "SELECT ID, post_title, post_date, COUNT($wpdb->comments.comment_post_ID) AS 
					'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' 
					AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'  
					AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT ".$pop_posts;
	
	$posts = $wpdb->get_results($popularposts);
	$popular = '';
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		

		if($posts){ ?>
		<ul class="thumb-list">
		<?php foreach($posts as $post){
			$post_title = stripslashes($post->post_title);
			$post_date = $post->post_date;
			$post_date = mysql2date('F j, Y', $post_date, false);
			$permalink = get_permalink($post->ID);

			$post_thumbnail = get_the_post_thumbnail($post->ID, array(60, 60), array("class" => "post_thumbnail frame"));

			if(!$post_thumbnail){
			$post_thumbnail = '<img class="frame" alt="image" src="'.get_template_directory_uri() .'/images/empty_thumb.gif" />';
		}
		?>
		<li><a class="fl" href="<?php echo $permalink; ?>"	title="<?php echo $post_title; ?>"><?php echo $post_thumbnail;?></a>
		<a class="thumb-title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a><br />
		<span class="date"><?php echo $post_date; ?></span></li>
		<?php } ?>
		</ul>
		<?php }
		echo $after_widget;
		
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		// replace old with new
		$instance['posts_number'] = (int) strip_tags($new_instance['posts_number']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'posts_number' => 3, 'title' => __('Popular Posts','highthemes') ) );
	$posts_number = (int) strip_tags($instance['posts_number']);
	$title =  strip_tags($instance['title']);
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title: ','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
        
	<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">
	<?php _e('Number of Posts:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo
		esc_attr($posts_number); ?>" /></p>
	<?php
	}
	}	

/**
 * HighThemes Recent Tweets
 */

class HT_Recent_Tweets extends WP_Widget {
	
	function HT_Recent_Tweets() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_recent_tweets',
							'description' => __( 'Recent tweets','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Recent_Tweets',"Highthemes -  " . __('Recent Tweets','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb, $tweet_widget_number;
		extract($args);
		
		$tweet_widget_number++;
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

	?>
    <script type="text/javascript">
   //<![CDATA[
		getTwitters('<?php echo $this->id_base . "_" . $tweet_widget_number;?>', {
        id: '<?php echo get_option('ht_twitter_id');?>', 
        clearContents: false, // leave the original message in place
        count: <?php if (isset($instance['tweets_number']) && is_numeric($instance['tweets_number']))echo $instance['tweets_number'];else echo 3;?>, 
        withFriends: true,
        ignoreReplies: true,
        newwindow: true,
		 template: '<span class="twitterStatus">%text%</span> <span class="twitterTime"><a href="http://twitter.com/%user_screen_name%/statuses/%id_str%">%time%</a></span>'
    });
    //]]>
</script>
<div class="recent-tweets" id="<?php echo $this->id_base . "_" . $tweet_widget_number;?>"></div>
    <?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		// replace old with new
		$instance['tweets_number'] = (int) strip_tags($new_instance['tweets_number']);
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'tweets_number' => 3, 'title' => __('Recent Tweets','highthemes') ) );
	$tweets_number = (int) strip_tags($instance['tweets_number']);
	$title = strip_tags($instance['title']);
	
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
    
    
    <p><label for="<?php echo $this->get_field_id('tweets_number'); ?>">
	<?php _e('Number of Tweets:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('tweets_number'); ?>" name="<?php echo $this->get_field_name('tweets_number'); ?>" type="text" value="<?php echo
		esc_attr($tweets_number); ?>" /></p>
	<?php
	}
	}

/**
 * Highthemes Sub Navigation
 */

class HT_Sub_Navigatioin extends WP_Widget {
	
	function HT_Sub_Navigatioin() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_sub_navigation',
							'description' => __( 'Showing subpages on sidebar','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Sub_Navigatioin',"Highthemes -  " . __('Sub Pages','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb, $post;
		extract($args);
		
	 	if ( !is_page() ) return false;

    	if ($post->post_parent != 0)
    	$parent = get_post($post->post_parent);
    	else
    	$parent = false;
	  
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Sub Pages','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;


 		// Default Args for selecting sub pages
    	$page_args = array( 'title_li' => '',
                        'child_of' => $post->ID,
                        'depth'    => 1,
                        'echo'     => false );

      	// Read the subpages again
     	$page_listing = wp_list_pages($page_args);
	    //if ( !$page_listing ) return false;


        echo  '<ul>';
        echo $page_listing;
     	echo '</ul>';
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'title' => __('Sub Pages','highthemes') ) );
	$title = strip_tags($instance['title']);
	
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
    

	<?php
	}
	}
	
	

/**
 * Highthemes Flickr
 */

class HT_Flickr extends WP_Widget {
	
	function HT_Flickr() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_flickr_widget',
							'description' => __( 'Pulls in images from your Flickr account.','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Flickr',"Highthemes -  " . __('Flickr','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
	  	$number = (int) strip_tags($instance['number']);
	  	$id = strip_tags($instance['id']);
		
		echo $before_widget;
		

?>
<div class="flickr">
<h3><?php _e('Photos on ','highthemes'); ?><span>flick<span>r</span></span></h3>
<div class="wrap">
<div class="fix"></div>
<script type="text/javascript"
	src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
<div class="fix"></div>
</div>
</div>
<?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['id'] = strip_tags($new_instance['id']);

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'id' => '', 'number'=>6 ) );
	$id = strip_tags($instance['id']);
	$number = strip_tags($instance['number']);
	
	
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('id'); ?>">
	<?php _e('Flickr ID ','highthemes'); ?>(<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
	<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo
		esc_attr($id); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('number'); ?>">
	<?php _e('Number:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo
		esc_attr($number); ?>" /></p>        
    

	<?php
	}
	}
/**
 * Highthemes Contact Details
 */

class HT_Contact_Details extends WP_Widget {
	
	function HT_Contact_Details() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_contact_details',
							'description' => __( 'Contact Details for Sidebar','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Contact_Details',"Highthemes -  " . __('Contact Details','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
		
		$instance['contact_text'] = stripslashes($instance['contact_text']);
		$instance['contact_details'] = stripslashes($instance['contact_details']);
		$instance['contact_title'] = strip_tags(stripslashes($instance['contact_title']));
		$instance['contact_map'] = strip_tags(stripslashes($instance['contact_map']));
		$instance['contact_map_big'] = strip_tags(stripslashes($instance['contact_map_big']));	
		
		$title = apply_filters('widget_title', empty($instance['contact_title']) ? __('Contact','highthemes') : $instance['contact_title'], $instance, $this->id_base);
		
		echo $before_widget;
				


?>
<div class="contact-details"> 
<?php if($instance['contact_map'] <> ''):?>
<a class="map zoom" rel="prettyPhoto[gallery]" href="<?php echo $instance['contact_map_big'];?>">
<img class="frame" src="<?php echo $instance['contact_map'];?>" alt="" />

</a>
<?php endif;?>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <p><?php echo stripslashes($instance['contact_text']); ;?> </p>
            <ul class="arrowlist">
              <?php echo stripslashes($instance['contact_details']);?>
            </ul>
          </div>

<?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['contact_map'] = strip_tags($new_instance['contact_map']);
		$instance['contact_map_big'] = strip_tags($new_instance['contact_map_big']);
		
		$instance['contact_title'] = strip_tags($new_instance['contact_title']);
		$instance['contact_text'] = $new_instance['contact_text'];
		$instance['contact_details'] = $new_instance['contact_details'];
		$instance['contact_email'] = $new_instance['contact_email'];

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'contact_title' => __('Contact Info','highthemes'), 'contact_text'=>'lorem ipsum dolor sit amet', 'contact_details'=>'<li><span>Address: </span> lorem ipsum dolor sit.</li><li><span>Tel: </span> 111-5252-8568.</li><li><span>Fax: </span> 111-9858-858.</li><li><span>Email: </span> email@gmail.com.</li>' ) );
	$contact_map = strip_tags($instance['contact_map']);
	$contact_map_big = strip_tags($instance['contact_map_big']);

	$contact_title = strip_tags($instance['contact_title']);
	$contact_text = $instance['contact_text'];
	$contact_details = $instance['contact_details'];
	
	
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('contact_map'); ?>">
	<?php _e('Map Image URL (Max width 246 pixels):','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('contact_map'); ?>" name="<?php echo $this->get_field_name('contact_map'); ?>" type="text" value="<?php echo
		esc_attr($contact_map); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('contact_map_big'); ?>">
	<?php _e('Map Image URL (Bigger Image):','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('contact_map_big'); ?>" name="<?php echo $this->get_field_name('contact_map_big'); ?>" type="text" value="<?php echo
		esc_attr($contact_map_big); ?>" /></p>        

	<p><label for="<?php echo $this->get_field_id('contact_title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('contact_title'); ?>" name="<?php echo $this->get_field_name('contact_title'); ?>" type="text" value="<?php echo
		esc_attr($contact_title); ?>" /></p>        

	<p><label for="<?php echo $this->get_field_id('contact_text'); ?>">
	<?php _e('Text:','highthemes'); ?></label>
        <textarea cols="26" rows="5" name="<?php echo $this->get_field_name('contact_text'); ?>" id="<?php echo $this->get_field_id('contact_text'); ?>"><?php echo
		esc_attr($contact_text); ?></textarea>
        </p>      
	<p><label for="<?php echo $this->get_field_id('contact_details'); ?>">
	<?php _e('Contact Details:','highthemes'); ?></label>
        <textarea cols="26" rows="15" name="<?php echo $this->get_field_name('contact_details'); ?>" id="<?php echo $this->get_field_id('contact_details'); ?>"><?php echo
		esc_attr($contact_details); ?></textarea>
        </p>       


	<?php
	}
	}


/**
 * Register all of the Highthemes WordPress widgets on startup.
 *
 * Calls 'widgets_init' action after all of the WordPress widgets have been
 * registered.

 */
function ht_widgets_init() {
	
	global $tweet_widget_number;
	$tweet_widget_number = 0;
	register_widget('HT_Recent_Posts');
	register_widget('HT_Ad_Widget');
	register_widget('HT_Popular_Posts');
	register_widget('HT_Recent_Tweets');
	register_widget('HT_Sub_Navigatioin');
	register_widget('HT_Flickr');
	register_widget('HT_Contact_Details');
	
	do_action('widgets_init');
}

add_action('init', 'ht_widgets_init', 1);	
?>