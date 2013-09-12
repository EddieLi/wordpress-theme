<?php get_header(); 
require( HT_INCLUDES_PATH . '/get_options.php' );
?>
  <div class="intro page-title">
        <h1><?php _e('404 Error - Not Found!','highthemes'); ?></h1>
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
          <li id="post" class="postitem">
            <div class="entry">
			<?php if( trim($ht_custom_404)!='' ) {?><p><?php echo stripslashes($ht_custom_404); ?></p><?php }?>
              <h4><?php _e('Search for:','highthemes'); ?></h4>
              <?php get_search_form(); ?>
              <div class="divider top"><a href="#"><?php _e('Top','highthemes'); ?></a></div>
              <?php require(TEMPLATEPATH . "/includes/sitemap_content.php"); ?>
              <div class="fix"></div>
            </div>
          </li>
        </ul>
      </div>
      <?php get_sidebar();?>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();?>