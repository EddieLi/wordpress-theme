<?php require( HT_INCLUDES_PATH . '/get_options.php' );?>
<!-- [FOOTER] -->
  <div id="footer">
	<?php
$number_of_blocks = $ht_footer_blocks;
if ($number_of_blocks =="") $number_of_blocks = "5";
switch ($number_of_blocks){
	case '2':

?>

   <div class="block one_half">
      <?php 
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-1') ) : ?>
      <h3><?php _e('Categories','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
    <div class="block one_half last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-2') ) : ?>
      <h3><?php _e('Recent','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
    <?php 
	break;
	case '3':
	?>
	<div class="block one_third">
      <?php 
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-1') ) : ?>
      <h3><?php _e('Categories','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
    <div class="block one_third">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-2') ) : ?>
      <h3><?php _e('Recent','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>    
      <div class="block one_third last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-3') ) : ?>
      <h3><?php _e('Archive','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
      <?php 
	break;
	case '4':
	?> 
    	<div class="block one_fourth">
      <?php 
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-1') ) : ?>
      <h3><?php _e('Categories','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
    <div class="block one_fourth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-2') ) : ?>
      <h3><?php _e('Recent','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>    
      <div class="block one_fourth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-3') ) : ?>
      <h3><?php _e('Archive','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
        <div class="block one_fourth last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-4') ) : ?>
      <h3><?php _e('Lorem List','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
      <?php 
	break;
	case '5':
	?> 
    	<div class="block one_fifth">
      <?php 
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-1') ) : ?>
      <h3><?php _e('Categories','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
    <div class="block one_fifth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-2') ) : ?>
      <h3><?php _e('Recent','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>    
      <div class="block one_fifth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-3') ) : ?>
      <h3><?php _e('Archive','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
        <div class="block one_fifth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-4') ) : ?>
      <h3><?php _e('Lorem List','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
 <div class="block one_fifth last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-5') ) : ?>
      <h3><?php _e('Popular Post','highthemes'); ?></h3>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
        <li><a href="#">Dolor sit lorem ispsjum</a></li>
        <li><a href="#">Some post title goes here</a></li>
        <li><a href="#">Vestibulum ligula</a></li>
      </ul>
      <?php endif;?>
    </div>
    <?php break; 
		}	
		?>
     <div class="fix"></div> 
                
  </div>
  
    <!-- [SUB FOOTER] -->
    <div id="subfooter">
        <p><?php echo stripslashes($ht_copyright_text);?></p>
        <div id="footer-menu">
        <?php
		$params = array( 'container'  => 'ul', 'theme_location' =>'footer_nav');
			wp_nav_menu($params);
		?>
        </div>
		  <?php if($ht_cufon_status != 'true') {?>
          <script type="text/javascript">Cufon.now();</script>
          <?php }?>
    </div>
    <!-- [/SUB FOOTER] -->
  
</div>
<!-- [/FOOTER] -->

<!-- [/wrapper-all] -->
<?php wp_footer();?>
<?php echo stripslashes($ht_google_analytics);?>
</body>
</html>