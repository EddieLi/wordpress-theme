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
              <div class="log"></div>
              <form action="<?php the_permalink();?>" class="horizform" method="post" id="contactform">
                <div class="personal-data">
                  <p>
                    <label for="fullname"><?php _e('Full name','highthemes'); ?></label>
                    <input type="text" name="fullname" id="fullname" tabindex="1" class="txt required" value="" />
                  </p>
                  <p>
                    <label for="email"><?php _e('Email','highthemes'); ?></label>
                    <input type="text" name="email" id="email" tabindex="2" value="" class="txt required" />
                  </p>
                  <p>
                    <label for="url"><?php _e('Website URL','highthemes'); ?></label>
                    <input type="text" name="url" id="url" tabindex="3" value="" class="txt" />
                  </p>
                </div>
                <div class="form-data">
                  <p>
                    <label for="form_message"><?php _e('Comment','highthemes'); ?></label>
                    <textarea rows="9" cols="10" id="form_message" class="required" name="form_message" tabindex="4" ></textarea>
                  </p>
                </div>
                <p>
                  <input type="hidden" id="sendContac" name="sendContact" value="<?php _e('send','highthemes'); ?>" />
                  <input type="submit" id="submit" class="ibutton" name="submit" value="<?php _e('Send Message','highthemes'); ?>" />
                </p>
              </form>
              <div class="loading"><img src="<?php bloginfo("template_directory"); ?>/images/ajax-loader.gif" alt="loading..." /></div>
              <div class="fix"></div>
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