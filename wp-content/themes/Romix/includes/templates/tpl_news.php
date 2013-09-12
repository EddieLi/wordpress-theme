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
  <div id="content-wrapper">
    <div id="inner">

      <div id="main">
<div id="news">
        <?php
      $posts_per_page = (int) $ht_item_number;
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$wp_query = new WP_Query("post_type=post&paged=$paged&cat=$ht_blog_news_category&posts_per_page=$posts_per_page&orderby=date");
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
        <?php endif;?>
               <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
        </div>
      </div>
      <div class="fix"></div>
    </div>
  </div>
</div>
<?php get_footer();?>
