<?php include( TEMPLATEPATH . '/includes/contact_action.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require( HT_INCLUDES_PATH . '/get_options.php' );  ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if(trim($ht_homepage_title) != "" && is_front_page()){?>
<title><?php echo stripslashes($ht_homepage_title);?></title>
<?php } else { ?>
<title><?php wp_title( '|', true, 'right' );?></title>
<?php } ?>
<?php
if($ht_seo_status=="false"){
	if(is_front_page()){
?>
<meta name="keywords" content="<?php echo stripslashes($ht_homepage_keywords);?>" />
<meta name="description" content="<?php echo stripslashes($ht_homepage_description);?>" />
<?php } else { ?>
<meta name="keywords" content="<?php echo stripslashes($ht_keywords);?>" />
<meta name="description" content="<?php echo stripslashes($ht_description);?>" />
<?php
}
	}
?>
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
?>
<!-- REQUIRED CSS FILES -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" href="<?php bloginfo("template_directory");?>/styles/prettyPhoto.css" type="text/css" media="screen" />
<!-- RSS FEED -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if ( $ht_feedburner_url <> "" ) { echo $ht_feedburner_url; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta name="cufon_status" content="<?php echo $ht_cufon_status; ?>" />
<meta name="images_path" content="<?php bloginfo("template_directory"); ?>/images" />
<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $ht_favicon_url;?>" />
<meta name="slider_speed" content="<?php echo $ht_slideshow_speed; ?>" />
<meta name="slider_effect" content="<?php echo $ht_slideshow_effect; ?>" />
<?php wp_head(); ?>
<?php
if($ht_cufon_status!='true'){
?>
<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/cufon-yui.js"></script>
<?php
switch( $ht_cufon_font ) {
	
	case 'Vegur':
	?>
    <script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Vegur.font.js"></script>
    <?php
	break;
	
	case 'PT Serif':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/PT_Serif.font.js"></script>
    <?php
	break;
	
	case 'Cantarell':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Cantarell.font.js"></script>
    <?php
	break;
	
	case 'Cardo':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Cardo.font.js"></script>
    <?php
	break;
	
	case 'Comfortaa':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Comfortaa.font.js"></script>

    <?php
	break;
	
	case 'Droid Sans':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Droid_Sans.font.js"></script>
    <?php
	break;
	
	case 'Josefin Sans':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Josefin_Sans.font.js"></script>
    <?php
	break;
	
	case 'Molengo':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Molengo.font.js"></script>
    <?php
	break;

	case 'Oswald':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Oswald.font.js"></script>
    <?php
	break;

	case 'Reenie Beanie':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Reenie_Beanie.font.js"></script>
    <?php
	break;

	case 'Sansation':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Sansation.font.js"></script>
    <?php
	break;


	case 'UnifrakturCook':
	?>
	<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/UnifrakturCook.font.js"></script>
    <?php
	break;

		
	default:
	?>
		<script type="text/javascript" src="<?php bloginfo("template_directory");?>/scripts/fonts/Droid_Sans.font.js"></script>
	<?php
}
}
?>


<style type="text/css">
<?php if($ht_header_height) {?>
#header {height: <?php echo $ht_header_height;?>;}
<?php }?>
<?php if($ht_bg_color !=''){?>
body {background-color: #<?php echo $ht_bg_color;?>}
<?php } ?>

<?php if($ht_bg_pattern !='' && $ht_bg_pattern !='No Pattern'){?>
body {
	background-image: url(<?php bloginfo('template_directory');?>/images/patterns/<?php echo $ht_bg_pattern;?>);
	background-repeat: repeat;
	}
<?php } ?>
<?php if(trim($ht_custom_css)!=''){
	echo $ht_custom_css . "\n";
}
?>
</style>
<!--[if IE 7]>
<link type="text/css" href="<?php bloginfo("template_directory");?>/styles/ie7.css" rel="stylesheet" media="screen" />
<![endif]-->
</head>
<body <?php body_class(); ?>>

<!-- wrapper-all -->
<div id="wrapper-all">
<!-- [NAV] -->
	<div id="header-top">
    <?php 
	if($ht_disable_top_icons=="false") {
 ?>
  <!-- [SOCIALS] -->
    <div id="social-wrap">
 <ul id="social-icons">
<?php if(get_option('ht_digg_profile_url')<>""){ ?>
<li class="digg"><a title="Digg" href="<?php echo get_option('ht_digg_profile_url'); ?>"> <img class="unitPng" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" width="16" height="16" /></a></li>
<?php }?>
<?php if(get_option('ht_linkedin_profile_url')<>""){ ?>
<li class="in"><a title="LinkedIn" href="<?php echo get_option('ht_linkedin_profile_url'); ?>"> <img class="unitPng" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" width="16" height="16" /></a></li>
<?php }?>
<?php if(get_option('ht_delicious_profile_url')<>""){ ?>
<li class="delicious"><a title="Delicious" href="<?php echo get_option('ht_delicious_profile_url'); ?>"> <img class="unitPng" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" width="16" height="16" /></a></li>
<?php }?>
<?php if(get_option('ht_twitter_id')<>""){ ?>
<li class="ftwitter"><a title="Twitter" href="http://twitter.com/<?php echo get_option('ht_twitter_id'); ?>"> <img src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" class="unitPng" width="16" height="16" /></a></li>
<?php }?>
<li class="frss"><a title="RSS" href="<?php if ( get_option('ht_feedburner_url') <> "" ) { echo get_option('ht_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"> <img class="unitPng" width="16" height="16" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" /></a></li>
<?php if(get_option('ht_facebook_url')<>""){ ?>
<li class="facebook"><a title="Facebook" href="<?php echo get_option('ht_facebook_url'); ?>"> <img class="unitPng" width="16" height="16" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" /></a></li>
<?php }?>
<?php if(get_option('ht_flickr_profile_url')<>""){ ?>
<li class="flickrs"><a title="Flickr" href="<?php echo get_option('ht_flickr_profile_url'); ?>"><img class="unitPng" width="16" height="16" src="<?php bloginfo("template_directory"); ?>/images/transparent.png" alt="" /></a></li>
<?php }?>

    </ul>
    </div>
    <!-- [/SOCIALS] -->
    
    <?php }?>
<?php
if($ht_disable_top_search=="false") {
?>
    <!-- [SEARCH] -->
   <div id="top-search">
      <form method="get" action="<?php bloginfo('url'); ?>/">
        <fieldset>
        <input type="text" size="10" class="search-field" name="s" id="search" value="<?php _e('Search..','highthemes'); ?>" onfocus="if(this.value == '<?php _e('Search..','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search..','highthemes'); ?>';}"/>
        </fieldset>
      </form>
    </div>
    <!-- [/SEARCH] -->
<?php
}
?>    
</div>
<!-- [/NAV] -->


  <!-- [HEADER] -->
  <div id="header">
    <div id="logo">
    <a title="<?php bloginfo("description");?>" href="<?php echo home_url();?>">
    <?php if(trim($ht_logo_url)<>""){ ?>
    <img src="<?php echo $ht_logo_url;?>" alt="<?php bloginfo('description'); ?>" />
    <?php }else {?>
    <img src="<?php bloginfo("template_directory");?>/images/logo.png" alt="Logo" />
    <?php }?>
    </a>
    </div>
    <!-- [NAVIGATION] -->
      <?php $params = array( 'container_class' => 'jqueryslidemenu', 'theme_location' =>'nav', 'container_id'=>'nav','walker' => new description_walker()); 
  		wp_nav_menu($params);
  	  ?>
    <!-- [/NAVIGATION] -->    
   
    
  </div>
  <!-- [/HEADER] -->