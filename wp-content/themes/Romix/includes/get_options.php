<?php
//allows the theme to get info from the theme options page
global $hight_options;
foreach ($hight_options as $value) {
	
		foreach ($value as $sub_value) {
			if(isset($sub_value['id']) && isset($sub_value['std'])){
				if (get_option( $sub_value['id'] ) === FALSE) { $$sub_value['id'] = $sub_value['std']; }
				else { $$sub_value['id'] = get_option( $sub_value['id'] ); }
			}
	
	}
}
?>