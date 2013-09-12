<?php
require( HT_INCLUDES_PATH . '/get_options.php' );

if( isset($selected_subheading) && $selected_subheading != "Default") {
	$subheading_content = $selected_subheading;
	$subheading_ids = $ht_post_subheading_posts_ids;
	$subheading_title = $ht_post_subheading_button_title;
	$subheading_link = $ht_post_subheading_button_link;
}
else {
	$subheading_content = $ht_subheading_content;
	$subheading_ids = $ht_subheading_posts_ids;
	$subheading_title = $ht_subheading_button_title;
	$subheading_link = $ht_subheading_button_link;
	
}

switch ($subheading_content) {
	
	case 'Twitter':
?>
<!-- [Twitter] -->
        <div class="twitter">
    		
            <script type="text/javascript">
            //<![CDATA[
            getTwitters('teaser-twitter', {
            id: '<?php echo get_option("ht_twitter_id");?>', 
            clearContents: false, // leave the original message in place
            count: 1, 
            withFriends: true,
            ignoreReplies: true,
            newwindow: true,
            template: '%text% <span class="twitterTime"><a href="http://twitter.com/%user_screen_name%/statuses/%id_str%">%time%</a></span> '
            });
            //]]>
            </script>
            
            
          <div id="teaser-twitter">
            <a class="bird" title="Follow" href="http://twitter.com/<?php echo get_option("ht_twitter_id");?>"><img src="<?php bloginfo("template_directory");?>/images/twitter_bird_icon_1.png" alt="" /></a>
          </div>
        </div>

        <!-- [/Twitter] -->
           <!-- [Projects] -->
	<?php
	break;
	
	case 'Post/Page/Portfolio':
			$subheading_ids = explode(',', $subheading_ids);
			$subheading_args=array(
				'post__in' => $subheading_ids,
				'post_type' => array('post', 'page', 'portfolio'),
				'post_status' => 'publish',
				'orderby' => 'post__in',
				'posts_per_page' => count($subheading_ids));
			
			$my_query = null;
			$my_query = new WP_Query($subheading_args);		
			?>
            <div id="projects">
			<?php			
			while($my_query->have_posts()): $my_query->the_post();
				  $image_id = get_post_thumbnail_id();  
				  $image_url = wp_get_attachment_image_src($image_id,'thumbnail');  
				  $image_url = $image_url[0];  
		?>
			<a class="fl fade" href="<?php the_permalink();?>"><?php the_post_thumbnail('small-thumb', array('title'=>'', 'class'=>'frame tooltip_sc'));?></a>   
            <div style="width: 160px" class="tool_tip">
<div class="tooltip_body"><?php the_title_attribute();?></div>
<div class="tooltip_tip"></div>
</div>          
            <?php endwhile;
			wp_reset_query();?>

</div>
        <!-- [/Projects] -->
        <?php break;
		case 'Button':
		?>
        <!-- [Call to Action] -->
        <div id="button-wrap">
        	<a class="cta-button" href="<?php echo $subheading_link; ?>"><span><?php echo $subheading_title; ?></span></a>
        </div>
        <!-- [/Call to Action] -->
        <?php 
		break;
		case 'disabled':
		
		?>
	
<?php }?>