<?php get_header();
require( HT_INCLUDES_PATH . '/get_options.php' );
?>
  <div class="intro page-title">
        <h1>
		<?php 
				if ( is_page() || is_single() ) the_title(); 
				else if ( is_category() ) _e("Category : ",'highthemes'). single_cat_title('', true);
				else if ( is_tag() ) _e("Tag : ",'highthemes').single_tag_title('', true);
				else if ( is_year() ) the_time('Y');
				else if ( is_month() ) the_time('F, Y');
				else if ( is_day() ) the_time('F jS, Y');
				else if ( is_author() ) {
					$userdata = get_userdatabylogin(get_query_var('author_name'));
					_e("Author : ",'highthemes'). $userdata->nickname;
				}

				?>
                </h1>
    <?php include TEMPLATEPATH . "/includes/subheader_content.php"?>
</div>
 <?php if($ht_breadcrumb_inner=="false"): ?>
    <div id="breadcrumb">
      <?php if (class_exists('simple_breadcrumb')) { $bc = new simple_breadcrumb; }?>
    </div>
<?php endif;?>

<div id="wrapper" class="has-sidebar">
  <div id="content-wrapper">
    <div id="inner">

      <div id="main">
        <ul id="entries">
      
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
		$ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
		
        	
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
			 ?>               <?php if(has_post_thumbnail() && $ht_post_image=="false"){?>
<a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload post-image"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a>
            <?php }?>  
            <h2 class="post-title"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
           
           <small class="meta"><?php _e("Posted",'highthemes');?> <?php the_date(); ?> <?php _e("By",'highthemes');?>
            <?php the_author_posts_link();?>
            <?php _e("in",'highthemes');?>
            <?php the_category(", ");?>
            <?php _e("With",'highthemes');?> <span>|</span> <?php comments_popup_link(__('No Comments','highthemes'), __('1 Comment','highthemes'), __('% Comments','highthemes')); ?>
            </small>
                        
            <div class="entry">
              <?php //the_content('<span>Read More &raquo;</span>');
			  the_excerpt();
			  ?>
              <p>
              <a href="<?php the_permalink();?>" class="icon-link"><span class="arrow1-icon">Read More...</span></a>
              </p>
              <div class="fix"></div>
              
            </div>
            <?php }?>
          </li>
          <?php endwhile;?>
        <?php else: ?>
        	<li class="postitem">
	            <div class="warning-box"><p><?php _e("There's no post here yet!",'highthemes'); ?></p></div>
            </li>
        <?php endif;?>
          <li><?php wp_pagenavi();?> </li>
        </ul>
      </div>
      <?php get_sidebar();?>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();?>
