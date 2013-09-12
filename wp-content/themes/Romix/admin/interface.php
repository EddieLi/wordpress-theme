<?php
/*
 * Highthemes.com Admin Framework
 * Twitter ID: theHighThemes
 */
 
add_action('init', 'create_option_post');

function highthemes_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/admin/assets/js/uploader.js', array('jquery','media-upload','thickbox'));
	wp_register_script('custom', get_template_directory_uri().'/admin/assets/js/custom.js', array('jquery'));
	wp_enqueue_script('my-upload');
	wp_enqueue_script( 'jpicker', HT_JS_PATH .'/jpicker/jpicker-1.1.6.min.js', array('jquery'));	
	wp_enqueue_script('custom');

	
}

function highthemes_admin_styles() {
	wp_enqueue_style('thickbox');
	wp_register_style('admin-style', get_template_directory_uri().'/admin/assets/css/style.css');
	wp_enqueue_style( 'admin-style' );
	wp_enqueue_style( 'jpicker' , get_template_directory_uri() .'/scripts/jpicker/css/jPicker-1.1.6.css' );
	
}

if (isset($_GET['page']) && $_GET['page'] == 'functions.php') {
	add_action('admin_print_scripts', 'highthemes_admin_scripts');
     
}
	add_action('admin_print_styles', 'highthemes_admin_styles');

function highthemes_theme_options(){
	global $pagehook, $theme_name, $sidehook;
	
	add_filter('screen_layout_columns', 'on_screen_layout_columns', 10, 2);
	$icon = get_template_directory_uri() .'/images/1616.png';
	
	$pagehook =  add_menu_page ($theme_name . ' Options', $theme_name, 'edit_themes','functions.php', 'hight_show_page', $icon, 3);
	add_submenu_page('functions.php', $theme_name, 'Theme Options', 'edit_themes', 'functions.php','hight_show_page');
	add_action('load-'.$pagehook, 'hight_load_page');
	// Sidebars Metabox
	$sidehook = add_submenu_page('functions.php', 'Sidebars', 'Sidebars', 'edit_themes', 'sidebars','hight_sidebars');
	add_action('load-'.$sidehook, 'ht_sidebars_page');
}

/*
 * Screen Settings
 */
function on_screen_layout_columns($columns, $screen) {
	global $pagehook, $sidehook;
	if ($screen == $pagehook) {
		$columns[$pagehook] = 2;
	}
		if ($screen == $sidehook) {
		$columns[$sidehook] = 2;
	}
	return $columns;
}

require_once (HT_ADMIN_PATH . '/options.php');


/*
 * Load sidebars page
 */
 
require_once ("sidebars.php");

/*
 * Main Options
 */

function hight_load_page(){
	global $pagehook, $hight_options;

	if(isset($_POST['Submit'])){
		foreach ($hight_options as $value) {
			foreach( $value as $array)
			{
				if($array['type'] == 'text')
				{
					$id = $array['id'];
					update_option( $id, $_REQUEST[ $id ]);
				}// end text if
				
				elseif($array['type'] == 'upload')
				{
					$id = $array['id'];
					update_option( $id, $_REQUEST[ $id ]);
				}
				elseif($array['type'] == 'textarea')
				{
					$id = $array['id'];
					update_option( $id, $_REQUEST[ $id ]);
				}//
				elseif($array['type'] == 'checkbox'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else

					{
						update_option( $array['id'] , 'false' );
					}

				}// end checkbox

				elseif($array['type'] == 'radio'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else
					{
						delete_option( $array['id'] );
					}

				}// end checkbox
				elseif($array['type'] == 'select'){
					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					}
					else {
						delete_option( $array['id']);
					}
				}
				elseif($array['type'] == 'select_page'){
					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					}
					else {
						delete_option( $array['id'] );
					}
				}
			}
		}
		header("Location: themes.php?page=functions.php&saved=true");
		die;
	}
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	add_meta_box('save_form_box', 'Save Settings', 'save_form_box', $pagehook, 'side', 'high');

	//now let's register our meta boxes
	highthemes_register_metaboxes($hight_options);

}
function hight_show_page() {
	global $screen_layout_columns, $pagehook, $theme_name, $ht_ver;
?>
<div class="wrap">
<div class="icon32" id="hight-icon"><br />
</div>
<h2>HighThemes <?php echo $theme_name;?> Settings (ver <?php echo "$ht_ver";?>)</h2>
<?php if(isset($_REQUEST['saved']) && $_REQUEST['saved']=='true'){ ?>
<div class="updated fade" id="message"
	style="background-color: rgb(255, 251, 204);">
<p><strong><?php _e('Settings saved.','highthemes'); ?></strong></p>
</div>
<?php }?>

<?php 
global $hight_options;
$j=0;
foreach($hight_options as $field){
	if(isset($field[0]['id']) && isset($field[0]['name'])){
	
		if($field[0]['id']=='') continue;
		echo '<a class="handlediv" href="#'.$field[0]['id'].'" >'.$field[0]['name'].'</a>';
		if($j != count($hight_options)-2) echo ' | ';
		$j++;
	}
}
?>
<script type="text/javascript">        
  jQuery(document).ready(
    function()
    {
      jQuery('#ht_bg_color').jPicker(   {
          window:
          {
            expandable: true
          },
	  
    images:
			{
    clientPath: '<?php echo HT_JS_PATH . "/jpicker/images/";?>'
			}// Path to image files
        });
    });
</script>
<form method="post" action="">


<div id="fixed-submit-button">
<input type="submit" value="Save Changes" class="button-primary"
name="Submit" />
</div>
<?php
?> <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
<input type="hidden" name="action" value="ht_save_options" />
<div id="poststuff"
	class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
<div id="side-info-column" class="inner-sidebar"><?php do_meta_boxes($pagehook, 'side', NULL); ?>
</div>
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content"><?php do_meta_boxes($pagehook, 'normal', NULL); ?>
<p><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></p>
</div>
</div>
<br class="clear" />
</div>
</form>
</div>
<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			// postboxes setup
			postboxes.add_postbox_toggles('<?php echo $pagehook; ?>');
		});
		//]]>
	</script>
<?php
}

// registering metaboxes to admin page
function highthemes_register_metaboxes($array)
{
	global $pagehook;
	foreach($array as $field){
		if(isset($field[0]['id']) && isset($field[0]['name']) && isset($field[0]['context'])){
			add_meta_box($field[0]['id'], $field[0]['name'], $field[0]['id'], $pagehook, $field[0]['context'], 'core');
		}
	}
	
}
function highthemes_generate_fields($arr_data){

	array_shift($arr_data);
	$output = '<table class="form-table">
<tbody>';

	foreach($arr_data as $index=>$field)
	{
		switch ( $field['type'] ) {
			case 'text':
				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = stripslashes(htmlspecialchars(get_option($field['id']))); }

				if(isset($field['options'])){
					$t_options = $field['options'];
					$output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
					<td>
					<input class="'.$t_options['class'].'" name="'. $field['id'] .'" id="'. $field['id'] .
					'" type="'. $field['type'] .'" value="'. $val .'" />
			
					<span class="description">'.$field['desc'].'</span>
					</td>
					</tr>
							';
				}
					else
				{
				$output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
					<td><input class="regular-text" name="'. $field['id'] .'" id="'. $field['id'] .
					'" type="'. $field['type'] .'" value="'. $val .'" />
			
					<br />
					<span class="description">'.$field['desc'].'</span>
					</td>
					</tr>
						';
				}
				break;


			case 'sub_heading':
				$val = stripslashes($field['std']);
				$output .= '
				<tr valign="top" style="background:#eee;border-bottom:1px solid #999">
					<th scope="row"><strong>
			'.$field['name'].'</strong></th>
			
			<td>
			<span class="description">'.$field['desc'].'</span>
			</td>
			</tr>
			';
				break;


			case 'delimiter':
				$val = stripslashes($field['std']);
				$output .= '
				<tr valign="top" style="">
					<th scope="row">
			&nbsp;</th>
			
			<td>
			<span >&nbsp;</span>
			</td>
			</tr>
			';
			break;
			
			case 'select':

				$output .= '<tr valign="top">
					<th scope="row">
			<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
			<td>
			<select name="'. $field['id'] .'" id="'. $field['id'] .'">';

				$select_value = get_option( $field['id']);

				foreach ($field['options'] as $option) {

					$selected = '';

					if($select_value != '') {
						if ( $select_value == $option) { $selected = ' selected="selected"';}
					} else {
						if ($field['std'] == $option) { $selected = ' selected="selected"'; }
					}

					$output .= '<option'. $selected .'>';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span>
			</td>
			</tr>';

				break;
				
				
			case 'upload':
   			$post_id = get_option_page_ID( 'media' );

			$output .= '<tr valign="top">
					    <th scope="row">
					    <label for="'.$field['id'].'">'.$field['name'].'</label></th>
				  		<td>
						';

			$output .= '<input id="'.$field['id'].'" type="text" size="36" name="'.$field['id'].'" value="'.get_option( $field['id']).'" />
<input class="upload_image_button" id="u-'.$field['id'].'" rel="'.$post_id.'" type="button" value="Upload Image" />
<br />Enter an URL or upload an image for the banner.
				
			</td>
			</tr>';
				break;				
			case 'select_page':

				$output .= '<tr valign="top">
					<th scope="row">
			<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
			<td>
			<select name="'. $field['id'] .'" id="'. $field['id'] .'">';

				$select_value = get_option( $field['id']);

				foreach ($field['options'] as $value=>$option) {

					$selected = '';

					if($select_value != '') {
						if ( $select_value == $value) { $selected = ' selected="selected"';}
					} else {
						if ($field['std'] == $option) { $selected = ' selected="selected"'; }
					}

					$output .= '<option'. $selected .' value="'.$value.'">';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span>
			</td>
			</tr>';


				break;

			case 'textarea':
				$ta_options = $field['options'];
				$ta_value = $field['std'];
				if( get_option($field['id']) != "") { $ta_value = stripslashes(htmlspecialchars(get_option($field['id']))); }
				$output .= '<tr valign="top">
					<th scope="row">
			<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
			<td>
			<textarea name="'. $field['id'] .'" id="'. $field['id'] .'" cols="'. $ta_options['cols'] .'" rows="'.$ta_options['rows'].'">'.$ta_value.'</textarea>
			<p class="description">'.$field['desc'].'</p>
			</td>
			</tr>';

				break;
			case "radio":

				$select_value = get_option( $field['id']);
				$output .= '<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
					<td>'; 
				foreach ($field['options'] as $key => $option)
				{

					$checked = '';
					if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked="checked"'; }
					} else {
						if ($field['std'] == $key) { $checked = ' checked="checked"'; }
					}
					$output .= '<input type="radio" name="'. $field['id'] .'"  value="'. $key .'" '. $checked .' />' . $option .'<br />';

				}

				$output .= '<br /><span class="description">'.$field['desc'].'</span></td></tr>'; 
				break;

			case "checkbox":

				$std = $field['std'];

				$saved_std = get_option($field['id']);

				$checked = '';

				if(!empty($saved_std)) {
					if($saved_std == 'true') {
						$checked = 'checked="checked"';
					}
					else{
						$checked = '';
					}
				}
				elseif( $std == 'true') {
					$checked = 'checked="checked"';
				}
				else {
					$checked = '';
				}

				$output .= '<tr valign="top">
					<th scope="row">
			<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			<td>
			<input type="checkbox" class="checkbox" name="'.  $field['id'] .'" id="'. $field['id'] .'" value="true" '. $checked .' /> 
			<span class="description">'.$field['desc'].'</span></td></tr>';

			break;
}
}

$output .= '</tbody></table>';
return $output;
}
?>