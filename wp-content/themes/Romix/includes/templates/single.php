<?php 
$category = get_the_category();
$ht_teaser_text = get_post_meta($post->ID, '_ht_teaser_text', true);
$teaser="";
if( trim($ht_teaser_text) != "" ) {
	$teaser = $ht_teaser_text;
} else {
	if(isset($category[0]->cat_name))$teaser = $category[0]->cat_name;
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
<?php  $sidebar_align = get_post_meta($post->ID,'_sidebar_alignment',true);  ?>
<div id="wrapper" class="has-<?php if($sidebar_align=="Left") echo 'left'; ?>sidebar">
  <div id="content-wrapper">
    <div id="inner">
      <div id="main">
        <ul id="entries">
          <?php if ( ! have_posts() ) : ?>
          <li class="post error404 not-found">
            <h2>
              <?php _e( 'Not Found','highthemes' ); ?>
            </h2>
            <div class="entry">
              <p>
                <?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.','highthemes' ); ?>
              </p>
              <?php get_search_form(); ?>
            </div>
          </li>
          <?php endif; ?>
          <?php if (have_posts()) : ?>
          <?php while (have_posts()) :the_post();
          $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
		 
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(240,577,$image_url);

          if(trim($ht_portfolio_vlink) <> ''){
          	$video_status = 'video';
          	$image_url = $ht_portfolio_vlink;
          }else{$video_status = 'zoom';}

          ?>
          <li id="post-<?php the_ID(); ?>" <?php post_class('postitem'); ?>>
			<?php
            if(has_post_format('image')) {
              if(has_post_thumbnail()) {
            ?> 
            	<a class="post-format" title="Photo" href="<?php the_permalink();?>">
                <img class="unitPng" width="120" height="33" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" />
                </a> 
                <a href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom">
                    <span class="preload post-image">
                        <img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                    </span>
                </a>	 
    			<span class="image-caption"><?php the_title();?></span>
                <div class="entry">
					<?php the_content(); ?>
                    <div class="fix"></div>
              <?php wp_link_pages();?>
                    
                </div>			
			<?php
            	}
            }
            elseif(has_post_format('link')) {
            ?> 
            	<a class="post-format" title="Link" href="<?php the_permalink();?>">
                <img class="unitPng" width="120" height="33" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" />
                </a> 
                 <div class="entry">
					<?php the_content(); ?>
                    <div class="fix"></div>
                </div>			
			<?php
            }
			 elseif(has_post_format('video')) {
            ?> 
            	<a class="post-format" title="Link" href="<?php the_permalink();?>">
                <img class="unitPng" width="120" height="33" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" />
                </a> 
                 <div class="entry">
					<?php the_content(); ?>
                    <div class="fix"></div>
                </div>			
			<?php
            }
            elseif(has_post_format('quote')) {
            ?> 
            	<a class="post-format" title="Link" href="<?php the_permalink();?>">
                <img class="unitPng" width="120" height="33" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" />
                </a> 
                 <div class="entry">
					<?php the_content(); ?>
                    <div class="fix"></div>
                </div>			
			<?php
            }
           elseif(has_post_format('status')) {
            ?> 
            	<a class="post-format" title="Link" href="<?php the_permalink();?>">
                <img class="unitPng" width="120" height="33" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" />
                </a> 
                 <div class="entry">
					<?php the_content(); ?>
                    <div class="fix"></div>
                </div>			
			<?php
            }
            else {                
			 ?>          
          <?php if(has_post_thumbnail() && $ht_post_image=="false" && get_post_meta($post->ID, '_ht_post_image', true) != "true"){?>
            		<a href="<?php echo $image_url;?>" title="" rel="prettyPhoto[gallery]" class="<?php echo $video_status; ?>"> 
                    <span class="preload post-image"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span>
                    </a>
            <?php }?> 
            <h2 class="post-title"><?php the_title();?></h2>
            <small class="meta"><?php _e("Posted",'highthemes');?> <?php the_date(); ?> <?php _e("By",'highthemes');?>
            <?php the_author_posts_link();?>
            <?php _e("in",'highthemes');?>
            <?php the_category(", ");?>
            <?php _e("With",'highthemes');?> <span>|</span>
            <?php comments_popup_link(__('No Comments','highthemes'), __('1 Comment','highthemes'), __('% Comments','highthemes')); ?>
            </small>   
            <div class="entry">
              <?php the_content();?>
              <?php the_tags('<div class="tags"><strong>'. __('Tags:','highthemes').' </strong>', ", ", "</div>");?>
              <div class="fix"></div>

            </div> 

            <?php if($ht_authorbox_status=="false"){
            	ht_author_bio();
            }?>
            <?php if($ht_relatedposts_status=="false"){
            	ht_related_post();
            }?>
            
            <?php }?>
          </li>
          <?php endwhile;?>
          <?php endif;?>
        </ul>
      <?php comments_template( '', true ); ?>
      </div>
      <?php get_sidebar();?>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();?>