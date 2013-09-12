<?php get_header();
require( HT_INCLUDES_PATH . '/get_options.php' );

//getting ht page type
$ht_page_type = get_post_meta($post->ID, '_ht_page_type', true);
$ht_page_type_category = unserialize(get_post_meta($post->ID, '_ht_page_type_category', true));
$ht_blog_news_category = get_post_meta($post->ID, '_ht_page_type_news_category', true);
$ht_item_number = get_post_meta($post->ID, '_ht_item_number', true);

//sub heading settings
$selected_subheading = get_post_meta($post->ID, '_selected_subheading', true);
if($selected_subheading=="" || !isset($selected_subheading))
{
	$selected_subheading = "Default";	
}
$ht_post_subheading_posts_ids =  get_post_meta($post->ID, '_ht_post_subheading_posts_ids', true);
$ht_post_subheading_button_title =  get_post_meta($post->ID, '_ht_post_subheading_button_title', true);
$ht_post_subheading_button_link =  get_post_meta($post->ID, '_ht_post_subheading_button_link', true);


if($ht_page_type == 'contact') {

		include (HT_TEMPLATES_PATH . "/tpl_contact.php");
		exit;		
}


elseif($ht_page_type == 'blog') {

		include (HT_TEMPLATES_PATH . "/tpl_subblog.php");
		exit;		
}
elseif($ht_page_type == 'news') {

		include (HT_TEMPLATES_PATH . "/tpl_news.php");
		exit;		
}
elseif ($ht_page_type == 'portfolio') {
	//select portfolio layout
	$ht_portfolio_layout = get_post_meta($post->ID, '_ht_portfolio_layout', true);
	
	if(!is_numeric($ht_item_number) || !isset($ht_item_number)) {
		$ht_item_number = 9;
	}

	
	if($ht_portfolio_layout == '1c') {
		
		include (HT_TEMPLATES_PATH . "/tpl_portfolio_1col.php");
		exit;
		
	}
	elseif($ht_portfolio_layout == '2c') {

		include (HT_TEMPLATES_PATH . "/tpl_portfolio_2col.php");
		exit;

	}
	elseif($ht_portfolio_layout == '3c') {

		include (HT_TEMPLATES_PATH . "/tpl_portfolio_3col.php");
		exit;

	}
	elseif($ht_portfolio_layout == '4c' ) {

		include (HT_TEMPLATES_PATH . "/tpl_portfolio_4col.php");
		exit;

	}
	elseif($ht_portfolio_layout == '5c') {

		include (HT_TEMPLATES_PATH . "/tpl_portfolio_5col.php");
		exit;

	}
	
	else {
		
		include (HT_TEMPLATES_PATH . "/tpl-portfolio-3col.php");
		exit;		
		
	}

}
else {
	// show general page

?>
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

<?php  $sidebar_align = get_post_meta($post->ID,'_sidebar_alignment',true); ?>
<div id="wrapper" class="has-<?php if($sidebar_align=="Left") echo 'left'; ?>sidebar">
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
            	<a href="<?php echo $image_url;?>" title="" rel="prettyPhoto[gallery]" class="zoom"> 
                <span class="preload post-image"><img class="frame" src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" /></span>
                 </a>
            <?php }?>  

            <div class="entry">

              <?php the_content();?>
              <div class="fix"></div>
              <?php wp_link_pages();?>
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
      <?php get_sidebar();?>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();
}
?>