<?php 
// Selecting slider items
$slideshow_args=array(
	'post_type' => 'slideshow',
	'post_status' => 'publish',
	'orderby' => 'date',
	'order'=>'ASC',
	'posts_per_page' => -1
);
$my_query = null;
$my_query = new WP_Query($slideshow_args);


?>
  <!-- [SLIDESHOW] -->
  <div id="slideshow">
    <div class="container">
     
      <!-- [SLIDES] -->
      <div class="slides">
        <?php if($my_query->have_posts()):?>
        <?php 
					$j=0;
					while($my_query->have_posts()): $my_query->the_post();
					
						// Get variables
						$ht_slideshow_type = get_post_meta($post->ID,'_ht_slideshow_type',true);
						$ht_slideshow_caption = get_post_meta($post->ID,'_ht_slideshow_caption',true);
						$ht_slideshow_caption_type = get_post_meta($post->ID,'_ht_slideshow_caption_type',true);
						$ht_slideshow_link = get_post_meta($post->ID,'_ht_slideshow_link',true);
						$ht_slideshow_video = get_post_meta($post->ID,'_ht_slideshow_video',true);
						$ht_slideshow_ex_link = get_post_meta($post->ID,'_ht_slideshow_ex_link',true);
						
						if($ht_slideshow_type != 'cropped_left' &&  $ht_slideshow_type != 'cropped_right' ) $ht_slideshow_type = 'full';
						
						switch ($ht_slideshow_caption) {
							
							case 'left':
								$ht_slideshow_caption = 'caption-left';
								break;

							case 'right':
								$ht_slideshow_caption = 'caption-right';
								break;

							case 'top':
								$ht_slideshow_caption = 'caption-top';
								break;

							case 'bottom':
								$ht_slideshow_caption = 'caption-bottom';
								break;
								
							case 'topleft':
								$ht_slideshow_caption = 'caption-topleft';
								break;

							case 'topright':
								$ht_slideshow_caption = 'caption-topright';
								break;

							case 'bottomleft':
								$ht_slideshow_caption = 'caption-bottomleft';
								break;

							case 'bottomright':
								$ht_slideshow_caption = 'caption-bottomright';
								break;
							
							case 'disable':
								$ht_slideshow_caption = 'caption-disable';
								break;
								
							default:
								$ht_slideshow_caption = 'caption-disable';

						}
						


						?>
        <?php 
			// if slideshow type is full
			if($ht_slideshow_type == 'full'){
        	
		  		$image_url = ht_get_featured_image_url($post->ID);
		  		$thumb_url = ht_image_resize(400,958,$image_url);
								
			  // if there's a video 
			  if($ht_slideshow_video != "") {
			  	$video_output =  '<span class="videoslider" style="display:block;width: 958px;height: 400px;">'.embed_video($ht_slideshow_video, 958, 400).'</span>';
			  }	
			  ?>
        <div class="slide <?php if ($j==0) echo 'first-slide';?>" >
          <div class="opacity slide-caption <?php echo $ht_slideshow_caption; echo ' '.$ht_slideshow_caption_type; ?>">
            <h3>
              <?php the_title(); ?>
            </h3>
            <?php the_excerpt() ?>
          </div>
          <?php 
                    
					 if($ht_slideshow_video != ""){
					 echo $video_output;
					 } else { 
					 ?>
                     
                        <?php 
						// if no link
                        if ($ht_slideshow_link != 'false') { 
                            if ($ht_slideshow_ex_link != "") {
                        ?>	
                                <a title="<?php the_title_attribute();?>" href="<?php echo $ht_slideshow_ex_link; ?>">
                                <img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                                </a>
                            <?php
                            } else {
                            ?>        
                                <a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>">
                                <img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                                </a>
                            <?php } ?>
                        <?php 
                        } else {
                        ?>
                            <img  src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                    <?php } // end no link?>
            
					 <?php } ?>
                    
                    
                    
        </div>
        <?php } 
			// if slideshow type is cropped right
			elseif($ht_slideshow_type == 'cropped_right') {
				
		  		$image_url = ht_get_featured_image_url($post->ID);
		  		$thumb_url = ht_image_resize(400,550,$image_url);
								
			  // if there's a video 
			  if($ht_slideshow_video != "") {
			  	$video_output =  embed_video($ht_slideshow_video, 550, 400);
			  }
		?>
        <div class="slide right-cropped <?php if ($j==0) echo 'first-slide';?>">
          <div class="fl">
            <h3>
              <?php the_title();?>
            </h3>
            <p> <?php echo ht_excerpt(400, '...');?></p>
            <br />
            
			<?php	if ($ht_slideshow_link != 'false') { 
           	  		if ($ht_slideshow_ex_link != "") {
					?>
            <a class="tab-inactive" href="<?php echo $ht_slideshow_ex_link; ?>"><span><?php _e("More Information",'highthemes'); ?></span></a> 
			<?php } else {?>
			            <a class="tab-inactive" href="<?php the_permalink(); ?>"><span><?php _e("More Information",'highthemes'); ?></span></a>
			<?php }
			
			}?>
            
            </div>
          <div class="fr">
            <?php 
			if($ht_slideshow_video != ""){
            	echo $video_output;
            } else{ 
				// if no link
              	if ($ht_slideshow_link != 'false') { 
           	  		if ($ht_slideshow_ex_link != "") {
				?>	
                        <a title="<?php the_title_attribute();?>" href="<?php echo $ht_slideshow_ex_link; ?>">
                       <img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                        </a>
                	<?php
					} else {
					?>        
                        <a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>">
                        <img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                        </a>
                    <?php } ?>
            	<?php 
				} else {
				?>
            		<img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
            <?php } // end no link?>
            			
			<?php }?>
          </div>
        </div>
        <?php 
			// if slideshow type is cropped left
			}
			elseif($ht_slideshow_type == 'cropped_left') {
				
		  		$image_url = ht_get_featured_image_url($post->ID);
		  		$thumb_url = ht_image_resize(400,550,$image_url);				
			  // if there's a video 
			  if($ht_slideshow_video != "") {
			  	$video_output =  embed_video($ht_slideshow_video, 550, 400);
			  }		
			?>
        <div class="slide left-cropped <?php if ($j==0) echo 'first-slide';?>">
          <div class="fl">
            <?php 
			if($ht_slideshow_video != ""){
            	echo $video_output;
            } else{ 
				// if no link
              	if ($ht_slideshow_link != 'false') { 
           	  		if ($ht_slideshow_ex_link != "") {
				?>	
                        <a title="<?php the_title_attribute();?>" href="<?php echo $ht_slideshow_ex_link; ?>">
                        <img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                        </a>
                	<?php
					} else {
					?>        
                        <a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>">
                       <img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                        </a>
                    <?php } ?>
            	<?php 
				} else {
				?>
            		<img src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
            <?php } // end no link?>
            			
			<?php }?>
          </div>
          <div class="fr">
            <h3>
              <?php the_title();?>
            </h3>
            <p> <?php echo ht_excerpt(400, '...');?></p>
            <br />
			<?php	if ($ht_slideshow_link != 'false') { 
           	  		if ($ht_slideshow_ex_link != "") {
					?>
            <a class="tab-inactive" href="<?php echo $ht_slideshow_ex_link; ?>"><span><?php _e("More Information",'highthemes'); ?></span></a> 
			<?php } else {?>
			            <a class="tab-inactive" href="<?php the_permalink(); ?>"><span><?php _e("More Information",'highthemes'); ?></span></a>
			<?php }
			
			}?>
			 </div>
        </div>
        <?php }  ?>
        <?php $j++; endwhile;?>
        <?php endif;?>
      </div>
		<!-- [SLIDES] -->

      </div>
      <!-- [SLIDESHOW BTNS] -->
  <div class="slider-btns">
	<?php if($my_query->have_posts() && $j>1):?>
    <ul class="pagination">
      <?php for($i=0; $i<$j; $i++):?>
      <li> <a href="#"><img src="<?php bloginfo("template_directory"); ?>/images/transparent.png" width="16" height="16" alt="next" /> </a> </li>
      <?php endfor;?>
    </ul>
    <?php endif;?>
  </div>
  <!-- [/SLIDESHOW BTNS] -->      
    </div>
  <!-- [/SLIDESHOW] -->