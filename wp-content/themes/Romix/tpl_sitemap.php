<?php
/*
Template Name: Sitemap
*/

get_header(); 
//sub heading settings
$selected_subheading = get_post_meta($post->ID, '_selected_subheading', true);
if($selected_subheading=="" || !isset($selected_subheading))
{
	$selected_subheading = "Default";	
}
$ht_post_subheading_posts_ids =  get_post_meta($post->ID, '_ht_post_subheading_posts_ids', true);
$ht_post_subheading_button_title =  get_post_meta($post->ID, '_ht_post_subheading_button_title', true);
$ht_post_subheading_button_link =  get_post_meta($post->ID, '_ht_post_subheading_button_link', true);

require( HT_INCLUDES_PATH . '/get_options.php' );
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
          <?php while (have_posts()) :the_post(); ?>
          <li id="post-<?php the_ID(); ?>" <?php post_class('postitem'); ?>>
            <div class="entry">
              <?php the_content();?>
              <div class="fix"></div>
              <?php include (TEMPLATEPATH . "/includes/sitemap_content.php");?>
            </div>
          </li>
          <?php endwhile;?>
          <?php endif;?>
        </ul>
      </div>
      <?php get_sidebar();?>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();?>