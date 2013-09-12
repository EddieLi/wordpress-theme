<?php
/*
Template Name: Homepage Default
*/
?>
<?php get_header();
require( HT_INCLUDES_PATH . '/get_options.php' );
if($ht_disable_slideshow=="false"){ include TEMPLATEPATH . "/includes/slideshow_content.php"; }
?>
<?php if($ht_cta_status == "false"){?>
<!-- [CAll TO ACTION] -->
  <div class="intro home-cta">
    <?php if(trim($ht_cta_text) !=""){ ?>
    <a class="cta-button fr" href="<?php echo stripslashes($ht_cta_link);?>"><span><?php if(trim($ht_cta_button) !="") echo stripslashes($ht_cta_button); else _e('Get Started!','highthemes');?></span></a>
       <h2><?php echo stripslashes($ht_cta_text);?></h2>

    <?php }else{ ?>
    <a class="cta-button fr" href="<?php echo stripslashes($ht_cta_link);?>"><span><?php _e('get Started!','highthemes'); ?></span></a>
        <h2><?php _e('Welcome to the ROMIX Wordpress Theme. All-in-one Solution for Your Business!','highthemes'); ?></h2>

    <?php }?>
  </div>
<!-- [/CAll TO ACTION] -->
<?php } ?>

<!-- [WRAPPER] -->
<div id="wrapper" class="no-sidebar">
    
    <!-- [INNER] -->
    <div id="innerhome">
      
      <!-- [MAIN] -->
      <div id="main">
 		<?php
        if ($ht_mini_features_status != 'true' ) {
		?>
        <!-- [FEATURED BOXES] -->
        <div id="featured-boxes">
            
            <!-- [BOX 1] -->
            <div class="one_third">
    			
                <?php echo stripslashes($ht_first_mini_feature); ?>

            </div>
            <!-- [/BOX 1] -->
            
            <!-- [BOX 2] -->
            <div class="one_third">
    			
                <?php echo stripslashes($ht_second_mini_feature); ?>

            </div>
            <!-- [BOX 2] -->
            
            <!-- [BOX 3] -->
            <div class="one_third last">
    			
                <?php echo stripslashes($ht_third_mini_feature); ?>

            </div>
            <!-- [BOX 3] -->
                                 
            <div class="fixbox"></div>
        </div>
        <!-- [/FEATURED BOXES] -->
        <?php }?>
        
        <?php
		$ht_featured_items_arr = explode(',', $ht_home_featured_items);
		 if($ht_home_featured_items_status != 'true' && $ht_home_featured_items != '' ):?>
        <!-- [SLIDER] -->
         <?php
        

        $args=array(
      	'post__in' => $ht_featured_items_arr,
      	'post_type' => array('portfolio','post', 'page'),
      	'post_status' => 'publish',
		'orderby' => 'post__in',
		'order' => 'ASC',
	  	'posts_per_page' => -1);
        
        $my_query = null;
        $my_query = new WP_Query($args);
        ?>  
        <?php if(count($ht_featured_items_arr) > 0) { ?>        
        <div id="slider">
         <?php if(count($ht_featured_items_arr) > 5) { ?>      
            <a class="nextbutton"><img src="<?php bloginfo("template_directory");?>/images/next_button.png" alt="" /></a>
            <a class="prevbutton"><img src="<?php bloginfo("template_directory");?>/images/prev_button.png" alt="" /></a>
            <?php }?>
            <div class="sc_menu">
                <ul id="gallery">
                 <?php if ($my_query->have_posts()) : ?>
        		 <?php $i=1; while ($my_query->have_posts()) : $my_query->the_post();	?>
                    <li>
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('featured-item', array('title'=>get_the_title(), 'class'=>'frame fade'));?></a>
                    </li>
                    <?php endwhile; endif; wp_reset_query();?>
 

                </ul>
            </div>
        </div> 
		<?php }?>
        <!-- [/SLIDER] -->
        <?php endif;?>
       
        <!-- [TESTIMONIAL] -->
 		<?php
        if ($ht_home_testimonial_status != 'true' ) {
			
			echo do_shortcode(stripslashes($ht_testimonial_text)); 
		}
		?>
        <!-- [/TESTIMONIAL] -->
        
      </div>
      <!-- [/MAIN] -->
      
      <div class="fix"></div>
    
    </div>
    <!-- [/INNER] -->
    
</div>
<!-- [/WRAPPER] -->
<?php get_footer();?>
