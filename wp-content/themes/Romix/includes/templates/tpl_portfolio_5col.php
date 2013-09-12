<?php 
$ht_teaser_text = get_post_meta($post->ID, '_ht_teaser_text', true);
if( trim($ht_teaser_text) != "" ) {
	$teaser = $ht_teaser_text;
} else {
	$teaser = get_the_title();
}
?>
<div class="intro page-title">
   <h1><?php echo $teaser; ?></h1>
    <?php include TEMPLATEPATH . "/includes/subheader_content.php"?>       
</div>

 <?php if($ht_breadcrumb_inner=="false"): ?>
    <div id="breadcrumb">
      <?php if (class_exists('simple_breadcrumb')) { $bc = new simple_breadcrumb; }?>
    </div>
<?php endif;?>
<div id="wrapper" class="no-sidebar">
  <div id="content-wrapper" >
    <div id="inner">

      <div id="main">
       <?php if (have_posts()) : ?>
          <?php while (have_posts()) :the_post(); ?>
<ul id="entries">
    <li style="margin-bottom:10px;" class="page postitem">
        <div class="entry">
        <?php the_content();?>
        	<div class="fix"></div>
        </div>
    </li>
</ul>
<?php endwhile; endif;?>      
		<?php
        $posts_per_page = (int) $ht_item_number;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;        
		
		$args = array(
			'paged'	 			  => $paged,
			'posts_per_page'		  => $posts_per_page,
			'post_type'			  => 'portfolio',
			'order_by'			  => 'date',
			'tax_query' => array(
			array(				'taxonomy' => 'portfolio-category',
				'field' => 'slug',
				'terms' => $ht_page_type_category
       			 )
      		  )
        );
		
		global $wp_version;
		if (version_compare($wp_version, '3.1', '<')) {
			$args = array(
				'paged'	 			  => $paged,
				'posts_per_page'		  => $posts_per_page,
				'post_type'			  => 'portfolio',
				'order_by'			  => 'date',
				'portfolio-category' =>$ht_page_type_category[0]
			);
			
		}	
		
        $temp = $wp_query;
       // $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
        
        ?>
        <div id="folio">
        <?php
        $i=1;
        while   ($wp_query->have_posts()) : $wp_query->the_post();
        $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
        $ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
        	
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(147,147,$image_url);
        	
        if(trim($ht_portfolio_vlink) <> ''){
        	$video_status = 'video';
        	$image_url = $ht_portfolio_vlink;
        }else{$video_status = '';}
        	
        ?>
          <div id="post-<?php the_ID(); ?>" <?php if(($i%5)==0 && $i<>0){ post_class("gallery one_fifth last $video_status");} else {post_class("gallery one_fifth $video_status");} ?>> <a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> class="img_link" href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a></div>
          <?php if(($i%5)==0 && $i<>0){echo '<div class="fixbox"></div>';}?>
          <?php 
		  $i++;
		  endwhile;?>
        </div>
        <?php else: ?>
        	<div class="warning-box"><p><?php _e("There's no item here yet!",'highthemes'); ?></p></div>
        <?php endif;?>
        <?php  
			wp_pagenavi();
			$wp_query = null; $wp_query = $temp; 
		 ?>
      </div>
      <div class="fix"></div>
    </div>
  </div>
  </div>
<?php get_footer();?>