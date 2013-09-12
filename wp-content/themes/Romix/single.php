<?php 
get_header();
require( HT_INCLUDES_PATH . '/get_options.php' );

$ht_post_layout = get_post_meta($post->ID, '_ht_post_layout', true);

//sub heading settings
$selected_subheading = get_post_meta($post->ID, '_selected_subheading', true);
if($selected_subheading=="" || !isset($selected_subheading))
{
	$selected_subheading = "Default";	
}
$ht_post_subheading_posts_ids =  get_post_meta($post->ID, '_ht_post_subheading_posts_ids', true);
$ht_post_subheading_button_title =  get_post_meta($post->ID, '_ht_post_subheading_button_title', true);
$ht_post_subheading_button_link =  get_post_meta($post->ID, '_ht_post_subheading_button_link', true);

if($ht_post_layout =='true') {
	include (HT_TEMPLATES_PATH . "/single_full.php");
}
else {
	include (HT_TEMPLATES_PATH . "/single.php");
}
?>