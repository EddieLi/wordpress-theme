<?php
/*
**************** CHECK PAGE TYPE	
*/

/* IF CONTACT */
if($ht_page_type == 'contact') {?>
<!-- [Entries] -->  
<div id="contacttab" <?php if($ht_breadcrumb_inner!="false") echo 'class="padding-top"';?>>

          
          <div id="post-<?php the_ID(); ?>" style="padding-right:0;" class="post last">
            <div class="entry">
              <?php the_content();?>
                         <div class="log"></div>
              <form action="<?php the_permalink();?>" class="horizform" method="post" id="contactform">
                <div class="personal-data">
                  <p>
                    <label for="fullname">Full name</label>
                    <input type="text" name="fullname" id="fullname" tabindex="1" class="txt required" value="" />
                  </p>
                  <p>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" tabindex="2" value="" class="txt required" />
                  </p>
                  <p>
                    <label for="url">Website URL</label>
                    <input type="text" name="url" id="url" tabindex="3" value="" class="txt" />
                  </p>
                </div>
                <div class="form-data">
                  <p>
                    <label for="form_message">Comment</label>
                    <textarea rows="9" cols="10" id="form_message" class="required" name="form_message" tabindex="4" ></textarea>
                  </p>
                </div>
                <p>
                  <input type="hidden" id="sendContac" name="sendContact" value="send" />
                  <input type="submit" id="submit" class="ibutton" name="submit" value="Send Message" />
                </p>
              </form>
              <div class="loading"><img src="<?php bloginfo("template_directory"); ?>/images/ajax-loader.gif" alt="loading..." /></div>
              <div class="fix"></div>
              
            </div>
          </div>

          <!-- [/Post] -->
        </div>
        <!-- [/Entries] -->
<?php
}

/* IF BLOG */
elseif($ht_page_type == 'blog') {?>
<!-- [Entries] -->  
        <ul id="entries">

<?php
$temp_query = $wp_query; 
$posts_per_page = (int) $ht_item_number;            
query_posts("post_type=post&cat=$ht_page_type_category&posts_per_page=$posts_per_page&orderby=ID&order=DESC");

if ( have_posts() ) : while ( have_posts() ) : the_post();

	global $more;
	$more = 0;
	$ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
	$ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
	$image_url = ht_get_featured_image_url($post->ID);
	$thumb_url = ht_image_resize(240,894,$image_url);
  
	if( trim($ht_portfolio_vlink) <> '' ) {
		$video_status = 'video';
		$image_url = $ht_portfolio_vlink;
	} 
	else {
		$video_status = 'zoom';
	}
?>
<!-- [Post] -->
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
			 ?>

               <?php if(has_post_thumbnail() && $ht_post_image=="false"){?>
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
            
            <?php //end else of general post 
		 		 }
		  	?>

          </li>
          <?php endwhile;?>
        <?php else: ?>
        	<li class="postitem">
	            <div class="warning-box"><p>There's no post here yet!</p></div>
            </li>
        <?php endif;
$wp_query = $temp_query;					
?>        
</ul>
<!-- [/Entries] -->	
<?php
}


/* IF NEWS */
elseif($ht_page_type == 'news') {?>
<!-- [Entries] -->  
<div id="news">
<?php
$temp_query = $wp_query; 
$posts_per_page = (int) $ht_item_number;   
$wp_query = new WP_Query("post_type=post&cat=$ht_blog_news_category&posts_per_page=$posts_per_page&orderby=date&order=DESC");         
if ( $wp_query->have_posts() ) : 
?>
<?php 
while ( $wp_query->have_posts() ) : $wp_query->the_post();

?>
         <div id="post-<?php the_ID(); ?>" <?php post_class('three_fourth'); ?>>
            	<h2 class="news-title"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
                <div class="entry">
					<p><?php echo ht_excerpt(350, '...');?></p>
                </div>
            </div>
            <div class="one_fourth news-details last">
            
                <span class="news-date"><?php the_time('d'); ?><span><?php the_time('M'); ?></span><?php the_time('Y'); ?></span> 
				<span class="news-comm"><span>0</span> Comments</span>
                
            </div>
            <div class="fixbox"></div>
          <?php endwhile;?>
        <?php else: ?>
        <?php endif;
$wp_query = $temp_query;					
?>        
</div>
<!-- [/Entries] -->	
<?php
}
/* IF PORTFOLIO */			
elseif ($ht_page_type == 'portfolio') {
	$ht_portfolio_layout = get_post_meta($post->ID, '_ht_portfolio_layout', true);
	if(!is_numeric($ht_item_number) || !isset($ht_item_number)) {
		$ht_item_number = 9;
	}
	
	
	/* IF 1 COLUMN */
	if($ht_portfolio_layout == '1c') {
		
        $posts_per_page = (int) $ht_item_number;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;       
		
		 $args = array(
			'paged'	 			  => $paged,
			'posts_per_page'		  => $posts_per_page,
			'post_type'			  => 'portfolio',
			'order_by'			  => 'date',
			'tax_query' => array(
				array('taxonomy' => 'portfolio-category',
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
        //$wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
        
        ?>
		<!-- [Folio] -->
		<div id="folio">
		<?php
        $i=1;
        while   ($wp_query->have_posts()) : $wp_query->the_post();

        
        $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
        $ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
		
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(500,661,$image_url);
        	
        if(trim($ht_portfolio_vlink) <> ''){
        	$video_status = 'video';
        	$image_url = $ht_portfolio_vlink;
        }else{$video_status = '';}
        	
        ?>
        
            <div class="one_fourth portfolio">
            <h2><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
            <p><?php echo ht_excerpt(260, '...');?></p>
            <a class="arrow-link" href="<?php the_permalink();?>"><?php _e('More Info','highthemes'); ?></a>
            
          </div>
        
          <div id="post-<?php the_ID(); ?>" <?php post_class("three_fourth portfolio last"); ?>> <a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a></div>
   
          <div class="fix"></div>
          <?php 
		  $i++;
		  endwhile;?>
        </div>
        <?php else: ?>
        	<div class="warning-box"><p><?php _e("There's no item here yet!",'highthemes'); ?></p></div>
        <?php endif;?>
        <?php  
			$wp_query = null; $wp_query = $temp; 
		 
	}
	/* IF 2 COLUMN */				
	elseif($ht_portfolio_layout == '2c') {
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
        //$wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
        
        ?>
		<!-- [Folio] -->
		<div id="folio">
		<?php 
        $i=1;
        while   ($wp_query->have_posts()) : $wp_query->the_post();

        
        $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
        $ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);

		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(236,426,$image_url);
        	
        if(trim($ht_portfolio_vlink) <> ''){
        	$video_status = 'video';
        	$image_url = $ht_portfolio_vlink;
        }else{$video_status = '';}
        	
        ?>
          <div id="post-<?php the_ID(); ?>" <?php if(($i%2)==0 && $i<>0){ post_class("one_half last portfolio");} else {post_class("one_half portfolio");} ?>> <a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a>
            <h2><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
            <p><?php echo ht_excerpt(180, '...');?></p>
            <a class="arrow-link" href="<?php the_permalink();?>"><?php _e('More Info','highthemes'); ?></a>
            
          </div>
          <?php if(($i%2)==0 && $i<>0){echo '<div class="fix"></div>';}?>
          <?php 
		  $i++;
		  endwhile;?>
        </div>
        <?php else: ?>
        	<div class="warning-box"><p><?php _e("There's no item here yet!",'highthemes'); ?></p></div>
        <?php endif;?>
        <?php  
			$wp_query = null; $wp_query = $temp; 
	}
	/* IF 3 COLUMN */				
	elseif($ht_portfolio_layout == '3c') {
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
		<!-- [Folio] -->
		<div id="folio">
		<?php 
        $i=1;
        while   ($wp_query->have_posts()) : $wp_query->the_post();
		
		$terms = get_the_terms( $post->ID, 'portfolio-category' );

		foreach($terms as $term)
		{
			$term_name = $term->name;	
		}
		
		
        
        $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
        $ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
        	
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(190,271,$image_url);
        	
        if(trim($ht_portfolio_vlink) <> ''){
        	$video_status = 'video';
        	$image_url = $ht_portfolio_vlink;
        }else{$video_status = '';}
        	
        ?>
          <div id="post-<?php the_ID(); ?>" <?php if(($i%3)==0 && $i<>0){ post_class("one_third last $video_status portfolio");} else {post_class("portfolio one_third $video_status");} ?>> <a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a>
            <h2><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
            <p><?php echo ht_excerpt(180, '...');?></p>
            <a class="arrow-link" href="<?php the_permalink();?>"><?php _e('More Info','highthemes'); ?></a>
            
          </div>
          <?php if(($i%3)==0 && $i<>0){echo '<div class="fix"></div>';}?>
          <?php 
		  $i++;
		  endwhile;?>
        </div>
        <?php else: ?>
        	<div class="warning-box"><p><?php _e("There's no item here yet!",'highthemes'); ?></p></div>
        <?php endif;?>
        <?php  
			$wp_query = null; $wp_query = $temp; 
			}
			
			
	/* IF 4 COLUMN */						
	elseif($ht_portfolio_layout == '4c' ) {
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
        //$wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
        
        ?>
		<!-- [Folio] -->
		<div id="folio">
		<?php 
        $i=1;
        while   ($wp_query->have_posts()) : $wp_query->the_post();
		
        
        $ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
        $ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
        	
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(145,194,$image_url);
        	
        if(trim($ht_portfolio_vlink) <> ''){
        	$video_status = 'video';
        	$image_url = $ht_portfolio_vlink;
        }else{$video_status = '';}
        	
        ?>
<div id="post-<?php the_ID(); ?>" <?php if(($i%4)==0 && $i<>0){ post_class("one_fourth last portfolio");} else {post_class("one_fourth portfolio");} ?>><a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a>
            <h2><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
            <p><?php echo ht_excerpt(150, '...');?></p>
            <a class="arrow-link" href="<?php the_permalink();?>"><?php _e('More Info','highthemes'); ?></a>
            
          </div>
          <?php if(($i%4)==0 && $i<>0){echo '<div class="fix"></div>';}?>
          <?php 
		  $i++;
		  endwhile;?>
        </div>
        <?php else: ?>
        	<div class="warning-box"><p><?php _e("There's no item here yet!",'highthemes'); ?></p></div>
        <?php endif;?>
        <?php  
			$wp_query = null; $wp_query = $temp; 
	}
	/* IF 5 COLUMN */				
	elseif($ht_portfolio_layout == '5c') {
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
        //$wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
        
        ?>
		<!-- [Folio] -->
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
          <div id="post-<?php the_ID(); ?>" <?php if(($i%5)==0 && $i<>0){ post_class("gallery one_fifth last $video_status");} else {post_class("gallery one_fifth $video_status");} ?>> <a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a></div>
          <?php if(($i%5)==0 && $i<>0){echo '<div class="fixbox"></div>';}?>
          <?php 
		  $i++;
		  endwhile;?>
        </div>
        <?php else: ?>
        	<div class="warning-box"><p><?php _e("There's no item here yet!",'highthemes'); ?></p></div>
        <?php endif;?>
        <?php  
			$wp_query = null; $wp_query = $temp; 
	}
	else {
		$temp_query = $wp_query; 
		$posts_per_page = (int) $ht_item_number;
		query_posts("post_type=post&cat=$ht_page_type_category&posts_per_page=$posts_per_page&orderby=ID&order=DESC");
		if (have_posts()) :
	  ?>
		<!-- [Folio] -->
		<div id="folio">
		<?php 
		$i=1;
		while   (have_posts()) : the_post();
		
		$ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
		$ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
		
		  $image_url = ht_get_featured_image_url($post->ID);
		  $thumb_url = ht_image_resize(147,147,$image_url);
		  
		if(trim($ht_portfolio_vlink) <> ''){
			$video_status = 'video';
			$image_url = $ht_portfolio_vlink;
		}else{$video_status = '';}
		?>
		  <div id="post-<?php the_ID(); ?>" <?php if(($i%5)==0 && $i<>0){ echo 'class="gallery one_fifth last"';} else 
		  {echo 'class="gallery one_fifth"';} ?>> 
		  <a <?php if($ht_image_lightbox!='true'){?> href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" class="img_link zoom <?php echo $video_status; ?>" <?php }else{ ?> href="<?php the_permalink();?>" title="<?php the_title();?>" <?php }?>> <span class="post-image preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a>
		  </div>
		  <?php if(($i%5)==0 && $i<>0){echo '<div class="fix"></div>';}?>
		  <?php 
		  $i++;
		  endwhile;?>
		</div>
		<?php else: ?>
			<div class="warning-box"><p>There's no item here yet!</p></div>
		<?php endif;?>
		<?php 
			$wp_query = $temp_query;					
	}

}else{
	echo '<div class="entry">';
the_content('<span>Read More &raquo;</span>');		
echo '   <div class="fix"></div>
            </div> ';
}
?>