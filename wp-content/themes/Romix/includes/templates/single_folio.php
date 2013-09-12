<?php 
$ht_teaser_text = get_post_meta($post->ID, '_ht_teaser_text', true);
if( trim($ht_teaser_text) != "" ) {
	$teaser = $ht_teaser_text;
} else {
	$teaser =get_the_title();
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
           
			// getting the featured images
			$post_images = ht_get_featured_images($post->ID);
			$image_url = $post_images[0];
			$sheight=240;
			$swidth=577;
			$thumb_url = ht_image_resize($sheight,$swidth,$image_url);
			           
          if(trim($ht_portfolio_vlink) <> ''){
          	$video_status = 'video';
          	$image_url = $ht_portfolio_vlink;
          }else{$video_status = 'zoom';}

          ?>
          <li id="post-<?php the_ID(); ?>" <?php post_class('postitem'); ?>>
            <?php 
			if( count($post_images)>1 ){
			?>
                <div class="slideshow">
                	<div class="slides">
                	<?php for( $z=0; $z <count($post_images); $z++){
						$post_image_resized = ht_image_resize(240,577,$post_images[$z]);
						if($z == 0 && trim($ht_portfolio_vlink != '')){ $post_images[$z] = $ht_portfolio_vlink; $video_status='video';}
						else {$video_status = 'zoom';}
						
					?>
                        <div class="slide">
                       <a href="<?php echo $post_images[$z];?>" title="" rel="prettyPhoto[gallery]" class="<?php echo $video_status; ?>">
                        <img width="<?php echo $swidth;?>" height="<?php echo $sheight;?>" class="frame" src="<?php echo $post_image_resized;?>" alt="" /></a></div>
                    <?php }?> 
                   </div>
                </div>
              <?php } else { ?>
					  <?php if(has_post_thumbnail() && $ht_post_image=="false"){?>
                                <a href="<?php echo $image_url;?>" title="" rel="prettyPhoto[gallery]" class="<?php echo $video_status; ?>"> 
                                <span class="preload post-image">
                                <img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span>
                                </a>
                        <?php }?> 
               <?php }?>
   
            <div class="entry">
              <?php the_content();?>
              <?php the_tags('<div class="tags"><strong>'. __('Tags:','highthemes').' </strong>', ", ", "</div>");?>
              <div class="fix"></div>

            </div> 
          </li> 
          
            <!-- [RELATED-ITEMS] -->
			<?php
           if( $ht_folio_related == "false" ) {
            $the_term = wp_get_post_terms( $post->ID, 'portfolio-category' );
            $term_id = $the_term[0]->term_id;
           
		    $args = array(
				'showposts'		  => 3,
				'post_type'			  => 'portfolio',
				'post__not_in'	  => array($post->ID),
				'order_by'			  => 'date',
				'tax_query' => array(
					array(
					'taxonomy' => 'portfolio-category',
					'field' => 'id',
					'terms' => $term_id
					)
				)
            );
            $temp = $wp_query;
           // $wp_query= null;
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) :
            
            ?>          
                <li class="similar">
                <h3>Similar Projects</h3>
					<?php 
                    $i=1;
                    while ($wp_query->have_posts()) : $wp_query->the_post();
					
						$ht_portfolio_vlink = get_post_meta($post->ID, '_ht_portfolio_vlink', true);
						$ht_image_lightbox	= get_post_meta($post->ID, '_ht_image_lightbox', true);
							
						  $image_url = ht_get_featured_image_url($post->ID);
						  $thumb_url = ht_image_resize(147,147,$image_url);
							
						if( trim($ht_portfolio_vlink ) != '') {
							$video_status = 'video';
							$image_url = $ht_portfolio_vlink;
						} else {
							$video_status = '';
						}
							
                    ?>
           				<div id="post-<?php the_ID(); ?>" 
						<?php if( ($i%3)==0 && $i<>0 ) { 
							post_class("one_fourth last portfolio");
						} else {
							post_class("one_fourth portfolio");
						} ?>
                        >
                        
                        <a <?php if( $ht_image_lightbox!='true' ) { ?> 
                                href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]" 
                                class="post-image img_link zoom <?php echo $video_status; ?>" 
							<?php } else { ?> 
                             class="post-image img_link"	href="<?php the_permalink();?>" title="<?php the_title();?>" 
							<?php }?>> 
                         
                        <span class="preload"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span></a>
                        <h4><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h4>
                      </div>
                      <?php if(($i%4)==0 && $i<>0){echo '<div class="fix"></div>';}?>
                      <?php 
                      $i++;
                      endwhile;?>
          
             </li>
             <?php endif;
                   $wp_query = null; $wp_query = $temp; 
				   
		   }
			 ?>
          <!-- [RELATED-ITEMS] -->
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