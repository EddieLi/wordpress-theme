<?php

/*

HighThemes.com
Twitter: theHighThemes

*/


// uncomment the below functin if you have .mo/.po file ready
//load_theme_textdomain('highthemes');

define("HT_ADMIN_PATH", TEMPLATEPATH . '/admin');
define('HT_JS_PATH', get_template_directory_uri() . '/scripts' );
define('HT_LIB_PATH', TEMPLATEPATH . '/includes/lib' );
define('HT_INCLUDES_PATH', TEMPLATEPATH . '/includes' );
define('HT_TEMPLATES_PATH', TEMPLATEPATH . '/includes/templates' );

add_action('admin_menu', 'highthemes_theme_options');

require_once (HT_LIB_PATH . '/multi-thumb/multi-post-thumbnails.php');
require_once (HT_ADMIN_PATH . '/config.php');
require_once (HT_ADMIN_PATH . '/interface.php');
require_once (HT_ADMIN_PATH . '/options.php');
require_once (HT_ADMIN_PATH . '/metabox_functions.php');
require_once (HT_ADMIN_PATH . '/general_functions.php');
require_once (HT_ADMIN_PATH . '/widgets.php');
require_once (HT_ADMIN_PATH . '/shortcodes.php');
require_once (HT_ADMIN_PATH . '/tinymce/tinymce.php');

if(!function_exists('wp_pagenavi')) {require_once (HT_LIB_PATH . '/wp_pagenavi.php');}
require_once (HT_LIB_PATH . '/sort_query.php');
require_once (HT_LIB_PATH . '/breadcrumb.php');
require_once (HT_LIB_PATH . '/sidebar_generator.php');

if (isset($_GET['activated']) && $_GET['activated']){
wp_redirect(admin_url("admin.php?page=functions.php&upgraded=true"));
}

?>