<?php
/*
Template Name: Homepage With Tab
*/
?>
<?php get_header();
require( HT_INCLUDES_PATH . '/get_options.php' );
if($ht_disable_slideshow == "false"){ include TEMPLATEPATH . "/includes/slideshow_content.php"; }
?>
<?php if($ht_cta_status == "false"){?>
<!-- [CAll TO ACTION] -->
  <div class="intro home-cta">
    <?php if(trim($ht_cta_text) !=""){ ?>
    <a class="cta-button fr" href="<?php echo stripslashes($ht_cta_link);?>"><span><?php if(trim($ht_cta_button) !="") echo stripslashes($ht_cta_button); else _e('Get Started!', 'highthemes');?></span></a>
       <h2><?php echo stripslashes($ht_cta_text);?></h2>

    <?php }else{ ?>
    <a class="cta-button fr" href="<?php echo stripslashes($ht_cta_link);?>"><span><?php _e('get Started!','highthemes'); ?></span></a>
        <h2><?php _e('Welcome to ROMIX, the  premium wordpress theme for portfolio and business websites','highthemes'); ?></h2>

    <?php }?>
  </div>
<!-- [/CAll TO ACTION] -->
<?php } ?>
<div id="wrapper" class="no-sidebar">
    <div id="inner" class="home<?php if($ht_cta_status!="false" ) echo 'padding-top';?>">
      <div id="main">
 		<!-- [Tab] -->
        <?php
        $ht_featured_tabs_ids = $ht_featured_tabs_ids;
        $ht_featured_tabs_ids = explode(',', $ht_featured_tabs_ids);

        $args=array(
      	'post__in' => $ht_featured_tabs_ids,
      	'post_type' => 'page',
      	'post_status' => 'publish',
		'orderby' => 'post__in',
		'order' => 'ASC',
	  	'posts_per_page' => count($ht_featured_tabs_ids));
        
        $my_query = null;
        $my_query = new WP_Query($args);
        ?>  
        <?php if(count($ht_featured_tabs_ids) > 1) { ?>
  		<div class="tabs">
        <?php if ($my_query->have_posts()) : ?>
        <?php $i=1; while ($my_query->have_posts()) : $my_query->the_post();	?>
        <?php if(count($ht_featured_tabs_ids)==1) { ?>
        <?php } else {?>
         <a class="tab-inactive" rel="#tab<?php echo $i;?>"><span><?php the_title();?></span></a>
        <?php }?>
        <?php 
		$i++;
		endwhile;
		?>
		<?php endif; wp_reset_query(); ?>  
   		</div>
   		<?php }?>
 		<div id="tabbed-content">
 		<?php
        $my_query = null;
        $my_query = new WP_Query($args);
        ?>
        <?php if ($my_query->have_posts()) :  ?>
        <?php $i=1; while ($my_query->have_posts()) : $my_query->the_post();
		global $more; $more = 0;
		
		//getting ht page type
		$ht_page_type = get_post_meta($post->ID, '_ht_page_type', true);
		$ht_page_type_category = unserialize(get_post_meta($post->ID, '_ht_page_type_category', true));
		$ht_blog_news_category = get_post_meta($post->ID, '_ht_page_type_news_category', true);
		$ht_item_number = get_post_meta($post->ID, '_ht_item_number', true);
		?>    
<!-- [Tab 1] -->
    <div id="tab<?php echo $i;?>" class="tab_content">
 			<?php
				require (TEMPLATEPATH . "/includes/tab_content.php");
			?>
     </div>
<?php 
$i++;
endwhile;
?>
<?php endif;?>     
  </div>
  <!-- [/Tab] -->
      </div>
      <div class="fix"></div>
    </div>
</div>
<?php get_footer();?>