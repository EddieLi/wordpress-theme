<?php
/*
 * Settigns
 */

add_action('admin_menu', 'ht_sidebar_options');
function ht_sidebar_options() {
	global $theme_name;
	add_meta_box('ht_sidebar_options', "Highthemes" . __(' - Sidebar Options','highthemes'), 'ht_sidebar_options_box', 'page', 'normal', 'high');
		add_meta_box('ht_sidebar_options', "Highthemes" . __(' - Sidebar Options','highthemes'), 'ht_sidebar_options_box', 'post', 'normal', 'high');
}

function ht_sidebar_options_box() {
		global $post;

	$selected_sidebar = get_post_meta($post->ID,'_selected_sidebar',true);
	$sidebar_alignment = get_post_meta($post->ID,'_sidebar_alignment',true);
	
	
	/* for security */
	echo '<input type="hidden" name="ht_sidebar_noncename" id="ht_sidebar_noncename"
	 	  value="'.wp_create_nonce('ht-sidebar').'" />';

	/* page type form element */
	echo '<p class="separate"><strong>'.__('Custom Sidebar','highthemes').'</strong>
	 	  <label for="selected_sidebar" class="screen-reader-text">'.__('Custom Sidebar','highthemes').'</label>';
			
	echo '<select name="selected_sidebar" id="selected_sidebar" size="1">';
	if($selected_sidebar == ''){ $selected= " selected";}
	echo '<option value="" '.$selected.'>'.__('Select A Sidebar','highthemes').'</option>';
	
	$sidebars = ht_sidebar_generator::get_sidebars();
	if(is_array($sidebars) && !empty($sidebars)){
	foreach($sidebars as $sidebar){
		if($selected_sidebar == $sidebar){
			echo "<option value='$sidebar' selected>$sidebar</option>\n";
		}else{
			echo "<option value='$sidebar'>$sidebar</option>\n";
		}
	}

}
	echo '</select></p>';
	
	// Sidebar Alignment
	echo '<p class="separate"><strong>'.__('Sidebar Alignment','highthemes').'</strong>
	 	  <label for="selected_sidebar" class="screen-reader-text">'.__('Sidebar Alignment','highthemes').'</label>';
			
	echo '<select name="sidebar_alignment" id="sidebar_alignment" size="1">';
	if($sidebar_alignment == '' || $sidebar_alignment == 'Right'){ $selected= " selected";}
	echo '<option value="Right" '.$selected.'>'.__('Right Sidebar','highthemes').'</option>';	
	if($sidebar_alignment == 'Left'){ $lselected= " selected";}
	echo '<option value="Left" '.$lselected.'>'.__('Left Sidebar','highthemes').'</option>';		
	
	echo '</select></p>';	


}

add_action('save_post', 'ht_sidebar_options_save');

function ht_sidebar_options_save($post_id) {
	if (isset($_POST['ht_sidebar_noncename']) && !wp_verify_nonce($_POST['ht_sidebar_noncename'], 'ht-sidebar')) return $post_id;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	if(isset($_POST['selected_sidebar']) && isset($_POST['sidebar_alignment'])) {
		$selected_sidebar = $_POST['selected_sidebar'];
		$sidebar_alignment = $_POST['sidebar_alignment'];
	
	update_post_meta($post_id, '_selected_sidebar', $selected_sidebar);
	update_post_meta($post_id, '_sidebar_alignment', $sidebar_alignment);
}
}
 
/*
 * Admin interface
 */
$hight_options['sidebar'][] = array();	
$hight_options['sidebar'][] = array(	"name" => __("Sidebar Name:",'highthemes'),
					"desc" => __("Enter a name for the new sidebar.",'highthemes'),
					"id" => $shortname."_sidebar_name",
					"std" => "",
					"type" => "text");	

function ht_sidebars_page(){
	global $sidehook, $sidebar_options, $shortname, $wpdb;
	
	if(isset($_POST['Submit'])){
		
		$get_sidebar_options = ht_sidebar_generator::get_sidebars();
		$sidebar_name = str_replace(array("\n","\r","\t"),'',$_POST['ht_sidebar_name']);
		$sidebar_id = ht_sidebar_generator::name_to_class($sidebar_name);
		if($sidebar_id == '' ){
			$options_sidebar = $get_sidebar_options;
		}else{
			if(isset($get_sidebar_options[$sidebar_id])){
				header("Location: admin.php?page=sidebars&error=true$hidden_anchor");	
				die;
			}
			if ( is_array($get_sidebar_options) ) {
				$new_sidebar_gen[$sidebar_id] = $sidebar_id;
				$options_sidebar = array_merge($get_sidebar_options, (array) $new_sidebar_gen);	
			}else{
				$options_sidebar[$sidebar_id] = $sidebar_id;
			}		
		 }
		update_option( $shortname.'_sidebar_generator', $options_sidebar);
		header("Location: admin.php?page=sidebars$send&saved=true$hidden_anchor");
		die;	
	}
	
	if(isset($_GET['sn'])){
		$sidebar_id = $_GET['sn'];
		$get_sidebar_options = ht_sidebar_generator::get_sidebars();
		$sidebar_name = str_replace(array("\n","\r","\t"),'',$sidebar_id);
		$sidebar_id = ht_sidebar_generator::name_to_class($sidebar_name);	
		
		if(in_array($sidebar_id, $get_sidebar_options)){
			
			unset($get_sidebar_options[$sidebar_id]);
			update_option( $shortname.'_sidebar_generator', $get_sidebar_options);
			
			
			//
		$get_widgets = wp_get_sidebars_widgets();
		unset( $get_widgets['array_version'] );

		$before_delete = true; $i=0;
		foreach ($get_widgets as $key => $value) {
			if( !preg_match('/ht_sidebar-([0-9]+)/', $key) ) {
				$update_widgets[$key] = $value;			
			}
			if( preg_match('/ht_sidebar-([0-9]+)/', $key) ) {
			if($key == "ht_sidebar-$sidebar_id") {
				$before_delete = false; $inactive_widgets = $value; }
			if( ($key != "ht_sidebar-$sidebar_id") && ($before_delete == true) ) {
				$update_widgets[$key] = $value; }		
			if( ($key != "ht_sidebar-$sidebar_id") && ($before_delete == false) ) {
				$update_widgets['ht_sidebar-'.$i] = $value; }
			$i++;
			}
		}
		
		$update_widgets['wp_inactive_widgets'] = array_merge((array)$inactive_widgets, (array) $update_widgets['wp_inactive_widgets']);
		wp_set_sidebars_widgets($update_widgets);
			//
			
		$sidebar_meta = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$sidebar_id'", ARRAY_A);
		if($sidebar_meta){
		if ( is_array($sidebar_meta) ){
			foreach ($sidebar_meta as $key => $value) {
				delete_post_meta($value['post_id'], '_selected_sidebar');
			}
		}
		}
		else
		{
			header("Location: admin.php?page=sidebars");	
		}
		
		
		}
		
	}
	
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	add_meta_box('ht_add_sidebars', 'Add New Sidebars', 'ht_add_sidebars', $sidehook, 'normal', 'high');
}

function ht_add_sidebars()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['sidebar']);
	?>
<table class="form-table">
<tbody>
<tr valign="top" style="">
					<th scope="row">&nbsp;
			</th>
			
			<td>
			<span >&nbsp;</span>
			</td>
			</tr>

<tr valign="top" style="background:#eee;border-bottom:1px solid #999">
					<th scope="row"><strong>
			Custom Sidebars</strong></th>
			<td>
			<span class="description">Here's the list of available sidebars</span>
			</td>
			</tr>   
            
<?php 
$get_sidebar_options = ht_sidebar_generator::get_sidebars();
$i=0;
if(count($get_sidebar_options)>0 && is_array($get_sidebar_options)){
foreach ($get_sidebar_options as $sidebar_gen) { ?>
			<tr valign="top">
			<th scope="row"><?php echo $sidebar_gen; ?></th>
			<td>
			<span class="description"><input type="button" onClick="window.location='admin.php?page=sidebars&sn=<?php echo $sidebar_gen; ?>';"  class="button" value="Delete" /></span>
			</td>
			</tr>                 
            
 <?php $i++;
 } }?>              
</tbody>
</table>
    <?php
}
function hight_sidebars() {
	global $screen_layout_columns, $sidehook, $theme_name;
	?>

<div class="wrap">
<div class="icon32" id="hight-icon"><br />
</div>
<h2>HighThemes <?php echo $theme_name;?> Sidebars</h2>
<?php if(isset($_REQUEST['saved']) && $_REQUEST['saved']=='true'){ ?>
<div class="updated fade" id="message"
	style="background-color: rgb(255, 251, 204);">
<p><strong>Settings saved.</strong></p>
</div>
<?php }?>
<form method="post" action=""><?php
?> <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
<input type="hidden" name="action" value="ht_save_options" />
<div id="poststuff"	class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
<div id="side-info-column" class="inner-sidebar"><?php do_meta_boxes($sidehook, 'side', NULL); ?>
</div>
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
<?php do_meta_boxes($sidehook, 'normal', NULL); ?>
<p><input type="submit" value="Add New Sidebar" class="button-primary" name="Submit" /></p>
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
			postboxes.add_postbox_toggles('<?php echo $sidehook; ?>');
		});
		//]]>
	</script>
<?php
}

?>