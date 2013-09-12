<?php
/*
Template Name: Coming Soon Template
*/
wp_enqueue_script('jquery.countdown', HT_JS_PATH . "/jquery.countdown.js",  array('jquery'));
get_header();
require( HT_INCLUDES_PATH . '/get_options.php' );
?>
  <div style="border-top: 1px solid #D8D8D8" class="intro">

<script type="text/javascript">
 //<![CDATA[
var end = new Date(<?php echo (int) $ht_timer_year ?>, <?php echo (int) $ht_timer_month ?>-1, <?php echo (int) $ht_timer_day ?>, <?php echo (int) $ht_timer_hour ?>, <?php echo (int) $ht_timer_minute ?>);/*HERE MUST SET THE DATE  YYYY, M-1, D, H, M formats*/
var end_time=end.getTime();  

// if you have Date objects
jQuery('document').ready(function(){	jQuery('#countdown').countdown({
	until: end, 
	layout: '<span class="days">{dn}</span><span class="dot">:</span><span class="hour">{hn}</span><span class="dot">:</span><span class="minute">{mn}</span><span class="dot">:</span><span class="second">{sn}</span> ',
	expiryText:'<?php echo $ht_timer_text; ?>'});});
 //]]>

</script>  
       <div id="countdown" class="clock_text"></div>
        <div class="timer_text"> 
        <span class="t_day">days</span> <span class="t_hour">hours</span> <span class="t_minute">minutes</span> <span class="t_second">seconds</span> 
        </div>    
  </div>
	<?php if($ht_breadcrumb_inner=="false"): ?>
    <div id="breadcrumb">
    <?php if (class_exists('simple_breadcrumb')) { $bc = new simple_breadcrumb; }?>
    </div>
    <?php endif;?>

<div id="wrapper" class="no-sidebar">
  <div id="content-wrapper">
    <div id="inner">
      <div id="main">
        <ul id="entries">
          <?php if ( ! have_posts() ) : ?>
          <li class="post error404 not-found">
            <h2 class="page-title">
              <?php _e( 'Not Found','highthemes' ); ?>
            </h2>
            <div class="entry">
              <small class="meta">
                <?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.','highthemes' ); ?>
              </small>
              <?php get_search_form(); ?>
            </div>
          </li>
          <?php endif; ?>
          <?php if (have_posts()) : ?>
          <?php while (have_posts()) :the_post(); 
		  
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(240,577,$image_url);


		  ?>
          <li id="post-<?php the_ID(); ?>" <?php post_class('postitem'); ?>>
               <?php if(has_post_thumbnail() && $ht_post_image=="false"){?>
            	<a href="<?php echo $image_url;?>" title="" rel="prettyPhoto[gallery]"> 
                <span class="preload post-image"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span>
                 </a>
            <?php }?>  

            <div class="entry">

              <?php the_content();?>
              <div class="fix"></div>
            </div>
          </li>
          <?php endwhile;?>
        <?php else: ?>
        	<li class="postitem">
	            <div class="warning-box"><p><?php _e("There's no post here yet!",'highthemes'); ?></p></div>
            </li>
        <?php endif;?>
        </ul>
      </div>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();?>