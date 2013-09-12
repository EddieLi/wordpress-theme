<?php
/*
 * HighThemes.com Custom Shortcodes Functions
 */


/**
 * Disable Automatic Formatting on Posts
 *
 * @param string $content
 * @return string
 */
function ht_formatter($content) {

	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');

add_filter('the_content', 'ht_formatter', 99);
add_filter('widget_text', 'ht_formatter', 99);


/*
 * Lists
 */
function ht_list( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'type'	=> 'bulletlist'
	), $atts));
	
	return str_replace('<ul>', '<ul class="'.$type.'">', do_shortcode($content));
}
add_shortcode("list", "ht_list");

/*
 * Buttons
 */
function ht_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '#',
		'size' 		=> 'small', // small, medium. large
		'color'		=> 'white' // magenta, rosy, pink, orange, yellow, red, green, blue, grey, black, purple, teal
	), $atts));

	return '<a class="fade button '.$size.' '.$color.'" href="'.$link.'"><span>'.$content.'</span></a>';
}
add_shortcode('button', 'ht_button');

function ht_icon_link( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '#',
		'icon'      => 'rss-icon'
	), $atts));

	return '[raw]<a class="icon-link" href="'.$link.'"><span class="'.$icon.'">'.$content.'</span></a>[/raw]';
}
add_shortcode('icon_link', 'ht_icon_link');

/*
 * Special Boxes
 */

function ht_simple_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
	   'gradient' 		=> 'false',
	   'border_size'	=> '1px',
	   'border_color'	=> '#000'
	), $atts));
	
	if($gradient == 'true') {
		return '<div style="border:'.$border_size.' solid '.$border_color.'" class="simple-box gradient-box">'. do_shortcode($content) .'</div>'; 
	} else {
		return '<div style="border:'.$border_size.' solid '.$border_color.'" class="simple-box">'. do_shortcode($content) .'</div>'; 
	}
}
add_shortcode('simple_box', 'ht_simple_box');


function ht_titled_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
       'title'      => 'title',
	   'color'		=> 'white',
	   'gradient' 	=> 'false'
	), $atts));
	$out = '';	
	if($gradient == 'true') {
		$out .= '<h6 class="titled-box-header '.$color.'"><span>'.$title.'</span></h6>';
		$out .= '<div class="titled-box gradient-box">'. do_shortcode($content) .'</div>';		
	} else {
		$out .= '<h6 class="titled-box-header '.$color.'"><span>'.$title.'</span></h6>';
		$out .= '<div class="titled-box">'. do_shortcode($content) .'</div>';		
	}
	
	return $out;
}
add_shortcode('titled_box', 'ht_titled_box');

function ht_info_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'type' => 'titled',
		'title' => 'title',
		'color' => 'green',
		'icon' => 'download'
	), $atts));
	$out = '';
	if($type == 'titled') {
		$out .= '<div class="info-box-wrapper">';
		if($icon == 'noicon') {
			$out .= '<div class="info-box-'.$color.'-header"><div class="info-content-box">'.$title.'</div></div>';
		} else {
			$out .= '<div class="info-box-'.$color.'-header info-box-'.$icon.'"><div class="info-content-box-icon">'.$title.'</div></div>';
		}
		$out .= '</div>';
	} else {
		$out .= '<div class="info-box-wrapper">';
		if($icon == 'noicon') {
			$out .= '<div class="info-box-'.$color.'-header"><div class="info-content-box">'.$title.'</div></div>';
		} else {
			$out .= '<div class="info-box-'.$color.'-header info-box-'.$icon.'"><div class="info-content-box-icon">'.$title.'</div></div>';
		}
		$out .= '<div class="info-box-'.$color.'-body"><div class="info-content-box">'. do_shortcode($content) .'</div></div>';
		$out .= '</div>';
	}

	return $out;
}
add_shortcode('info_box', 'ht_info_box');

/*
 * Call to action 
 */

function ht_cta_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
	), $atts));
	
	return '[raw]<div class="cta-box">'. do_shortcode($content) .'</div>[/raw]'; 

}
add_shortcode('cta_box', 'ht_cta_box');

/*
 * Tooltip
 */
function ht_tooltip( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'trigger'      => '',
	), $atts));
		$out = '';
		$out .= '[raw]<span class="tooltip_sc">'.$trigger.'</span>';
		$out .= '<div class="tool_tip">';
		$out .= '<div class="tooltip_body">'.$content.'</div>';
		$out .= '<div class="tooltip_tip"></div>';
		$out .= '</div>[/raw]';
		
		return $out;
}
add_shortcode('tooltip', 'ht_tooltip');

/*
 * Embed Video
 */
 
 function ht_embed_video( $atts) {
	extract(shortcode_atts(array(
       'url'      => 'videmo, youtube, daily motion or flv, mp4, and swf',
	   'width'		=> '550',
	   'height' 	=> '400'
	), $atts));
	
	
	
	return "[raw]". embed_video($url, $width, $height). "[/raw]";
}
add_shortcode('video', 'ht_embed_video');

/*
 * Code & Pre
 */
function ht_code( $atts, $content = null ) {
	return '<code class="code">'.$content.'</code>';
}
add_shortcode('code_sc', 'ht_code');

function ht_pre( $atts, $content = null ) {
	return '<pre class="pre">'.$content.'</pre>';
}
add_shortcode('pre', 'ht_pre');

/*
 * Dividers
 */
function ht_divider( $atts, $content = null ) {
	return '<div class="divider"></div>';
}
add_shortcode('hr', 'ht_divider');

function ht_divider_top( $atts, $content = null ) {
	return '<div class="divider top"><a href="#header">'.__('Top','highthemes').'</a></div>';
}
add_shortcode('hr_top', 'ht_divider_top');

/*
 * Drop-Caps
 */
function ht_drop_cap( $atts, $content = null ) {
	extract(shortcode_atts(array(
       'type'      => 'dropcap1'
	), $atts));
	
	return '<span class="'.$type.'">'.$content.'</span>';
}
add_shortcode('dropcap', 'ht_drop_cap');


/*
 * Pullquote
 */
function ht_callout_right( $atts, $content = null ) {
	return '<blockquote class="pullquote-right"><p>'. do_shortcode($content) .'</p></blockquote>';
}
add_shortcode('callout_right', 'ht_callout_right');

function ht_callout_left( $atts, $content = null ) {
	return '<blockquote class="pullquote-left"><p>' . do_shortcode($content) . '</p></blockquote>';
}
add_shortcode('callout_left', 'ht_callout_left');

function ht_pullquote( $atts, $content = null ) {
	extract(shortcode_atts(array(
       'cite'      => ''
	), $atts));
	$out = '';	
	$out .= '<blockquote class="pullquote gradient-box">';
	$out .= 	'<div class="quote-mark"><img alt="" src="'.get_template_directory_uri().'/images/openquote_2.png" /></div>';
	$out .= 	'<p>'. do_shortcode($content) .'<cite>'.$cite.'</cite></p>';
	$out .= '</blockquote>';
	
	return $out;
}
add_shortcode('pullquote', 'ht_pullquote');

/*
 * Toggle
 */
function ht_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'		=> '',
		'type'		=> 'simple' //simple, framed					
	), $atts));
	$out = '';
	if($type == 'simple') {
		$out .= '<div class="toggle-item">';
		$out .= 	'<div class="toggle-head"><h3>'.$title.'</h3></div>';
		$out .= 	'<div class="toggle-body"><p>'.do_shortcode($content).'</p></div>';
		$out .= '</div>';
	} else {
		$out .= '<div class="framed-toggle-item">';
		$out .= 	'<div class="toggle-head"><h3>'.$title.'</h3></div>';
		$out .= 	'<div class="toggle-body"><p>'.do_shortcode($content).'</p></div>';
		$out .= '</div>';
	}

	return $out;
}
add_shortcode('toggle', 'ht_toggle');

/*
 * Text Highlight
 */
function ht_highlight ($atts, $content = null) {
	extract(shortcode_atts(array(
        'color'      => 'yellow' //red, black
	), $atts));
	
	return '<span class="highlight-'.$color.'">'. do_shortcode($content) .'</span>';
}
add_shortcode('highlight', 'ht_highlight');

/*
 * Image Frames
 */
function ht_lightbox_image ($atts, $content = null) {
	extract(shortcode_atts(array(
        'big_image_url'      => '',
		'title'      => '',
	), $atts));
	$out = '';
	$out .= '<a href="'.$big_image_url.'" title="'.$title.'" rel="prettyPhoto[gallery]" class="img_link zoom"><img class="frame" src="'.$content.'" alt="" /></a>';
	return $out;
}
add_shortcode('lightbox_image', 'ht_lightbox_image');


function ht_frame_left( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '',
	), $atts));	
	$out = '';	
	if(trim($link) !='') {
		$out .= '<a href="'.$link.'"><span class="alignleft"><img class="frame" src="' . $content . '" title="" alt="" /></span></a>';
	} else {
		$out .= '<span class="alignleft"><img class="frame" src="' . $content . '" title="" alt="" /></span>';
	}	
	return $out;
}
add_shortcode('frame_left', 'ht_frame_left');

function ht_frame_right( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '',
	), $atts));	
	$out = '';	
	if(trim($link) !='') {
		$out .= '<a href="'.$link.'"><span class="alignright"><img class="frame" src="' . $content . '" title="" alt="" /></span></a>';
	} else {
		$out .= '<span class="alignright"><img class="frame" src="' . $content . '" title="" alt="" /></span>';
	}	
	
	return $out;
}
add_shortcode('frame_right', 'ht_frame_right');

function ht_frame( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '',
	), $atts));	
	$out = '';	
	if(trim($link) !='') {
		$out .= '<a href="'.$link.'"><img class="frame" src="' . $content . '" title="" alt="" /></a>';
	} else {
		$out .= '<img class="frame" src="' . $content . '" title="" alt="" />';
	}
	
	return $out;
}
add_shortcode('frame', 'ht_frame');

function ht_frame_center( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '',
	), $atts));	
	$out = '';	
	if(trim($link) !='') {
		$out .= '<p class="aligncenter"><a href="'.$link.'"><span class="aligncenter"><img class="frame aligncenter" src="' . $content . '" title="" alt="" /></span></a></p>';
	} else {
		$out .= '<p class="aligncenter"><span class="aligncenter"><img class="frame aligncenter" src="' . $content . '" title="" alt="" /></span></p>';
	}
	
	return $out;
}
add_shortcode('frame_center', 'ht_frame_center');

/*
* Tabs
*/
function ht_tabs_sc( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	$out = '';
	$out .= '[raw]<div class="tab-set">[/raw]';
	$out .= '<ul class="tabs-titles">';
		foreach ($atts as $tab) {
			$out .= '<li><a href="#">' .$tab. '</a></li>';
		}
	$out .= '</ul>';
	$out .= do_shortcode($content) .'[raw]</div>[/raw]';
	
	return $out;
}
add_shortcode('tabs', 'ht_tabs_sc');

function custom_tabs_sc( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	return '[raw]<div class="tab-content">[/raw]' . do_shortcode($content) .'</div>';
}
add_shortcode('tab', 'custom_tabs_sc');

/* 
* Accordions
*/
function ht_accordions_sc( $atts, $content = null ) {
	extract(shortcode_atts(array(
	), $atts));
	$out = '';	
	$out .= '[raw]<div class="accordion">[/raw]';
	$out .= 	do_shortcode($content);
	$out .= '[raw]</div>[/raw]';
	
	return $out;
}
add_shortcode('accordions', 'ht_accordions_sc');

function ht_accordion_sc( $atts, $content = null ) {
	extract(shortcode_atts(array('title'=>'',
	), $atts));
	$out = '';	
	$out .= '[raw]<div class="acc-item"><h4><a href="#">' .$title. '</a></h4>[/raw]';
	$out .= 	'[raw]<div class="acc-content">'.$content.'</div>';
	$out .= '</div>[/raw]';
	
	return $out;
}
add_shortcode('accordion', 'ht_accordion_sc');

/* 
* Slideshow
*/
function ht_slideshow( $atts, $content = null ) {
	extract(shortcode_atts(array(
	), $atts));
	$out = '';	
	$out .= '<div class="slideshow"><div class="slides">';
	$out .= 	do_shortcode($content);
	$out .= '</div></div>';
	
	return $out;
}
add_shortcode('slideshow', 'ht_slideshow');

function ht_slide( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link'		=> '#',
		'title'		=> '',
		'width' => '',
		'height' =>'',
		'resize' =>'true'
	), $atts));
		$out = '';
	if($resize == 'true'){
		
		$image_size = ht_image_resize($height, $width, $content);
		
		if($link == '') {
			$out .= '<div class="slide"><img width="'.$width.'" height="'.$height.'" class="frame" src="'.$image_size.'" alt="" />';
			if($title != '') { $out .= 	'<div class="slideshow-caption">'.$title.'</div>'; }
			$out .= '</div>';
		} else {
			$out .= '<div class="slide"><a href="'.$link.'"><img width="'.$width.'" height="'.$height.'" class="frame" src="'.$image_size.'" alt="" /></a>';
			if($title != '') { $out .= 	'<div class="slideshow-caption">'.$title.'</div>'; }
			$out .= '</div>';
		}
	}
	else {
		if($link == '') {
			$out .= '<div class="slide"><img width="'.$width.'" height="'.$height.'" class="frame" src="'.$content.'" alt="" />';
			if($title != '') { $out .= 	'<div class="slideshow-caption">'.$title.'</div>'; }
			$out .= '</div>';
		} else {
			$out .= '<div class="slide"><a href="'.$link.'"><img width="'.$width.'" height="'.$height.'" class="frame" src="'.$content.'" alt="" /></a>';
			if($title != '') { $out .= 	'<div class="slideshow-caption">'.$title.'</div>'; }
			$out .= '</div>';
		}	}
	
	return $out;
}
add_shortcode('slide', 'ht_slide');

/* 
* Testimonial
*/
function ht_testimonials( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'height'		=>	'100px'
	), $atts));
	$out="";
	$out .= '<div style="height:'.$height.'" class="testimonials">';
	$out .= 	do_shortcode($content);
	$out .= '</div>';
	
	return $out;
}
add_shortcode('testimonials', 'ht_testimonials');

function ht_testimonial( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'name'			=> 'John Smith',
		'website_url'	=> 'http://www.site.com'
	), $atts));
	
	if($name == '' && $website_url !='') {
		return '<blockquote class="testimonial"><p>'.$content.'<cite>'.$website_url.'</cite></p></blockquote>';
	} elseif($name != '' && $website_url =='') {
		return '<blockquote class="testimonial"><p>'.$content.'<cite>- '.$name.'</cite></p></blockquote>';
	} elseif($name == '' && $website_url =='') {
		return '<blockquote class="testimonial"><p>'.$content.'</p></blockquote>';
	} else {
		return '<blockquote class="testimonial"><p>'.$content.'<cite>- '.$name.', '.$website_url.'</cite></p></blockquote>';
	}
}
add_shortcode('testimonial', 'ht_testimonial');

/* 
* Pricing Table
*/
function ht_pricing_table( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'cols'	=> '4'
	), $atts));
	$out = '';	
	$out .= '<div class="pricing-tables pricing-table-'.$cols.'col">';
	$out .= 	do_shortcode($content);
	$out .= 	'<div class="fixbox"></div>';
	$out .= '</div>';
	
	return $out;
}
add_shortcode('pricing_table', 'ht_pricing_table');

function ht_pricing_col( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title'		=> 'standard',
		'desc'		=> 'Lorem ipsum dolor sit',
		'color'		=> 'teal',
		'special'	=> 'false'
	), $atts));
	$out = '';	
	if($special == 'false') {
		$out .= '[raw]<div class="pricing-table ">';
	} else {
		$out .= '[raw]<div class="pricing-table pricing-special">';
	}
		$out .=		'<div class="pricing-heading '.$color.'">';
		$out .= 		'<h2 class="pricing-title">'.$title.'</h2><p>'.$desc.'</p>';
		$out .=		'</div>';
		$out .= 	'<div class="pricing-content">';
		$out .= 		'<div class="pricing-body">';
		$out .= 			''.do_shortcode($content).'';
		$out .= 		'</div>';
		$out .= 	'</div>';
		$out .= '</div>[/raw]';

	return $out; 
}
add_shortcode('col', 'ht_pricing_col');

/*
 * Grid Columns
 */
function ht_one_third( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'ht_one_third');


function ht_one_third_last( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);		
	return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('one_third_last', 'ht_one_third_last');


function ht_two_third( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'ht_two_third');


function ht_two_third_last( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('two_third_last', 'ht_two_third_last');


function ht_one_half( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'ht_one_half');


function ht_one_half_last( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('one_half_last', 'ht_one_half_last');


function ht_one_fourth( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'ht_one_fourth');


function ht_one_fourth_last( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('one_fourth_last', 'ht_one_fourth_last');


function ht_three_fourth( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'ht_three_fourth');


function ht_three_fourth_last( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('three_fourth_last', 'ht_three_fourth_last');

function ht_one_fifth( $atts, $content = null ) {
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
	return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'ht_one_fifth');


function ht_one_fifth_last( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('one_fifth_last', 'ht_one_fifth_last');


function ht_two_fifth( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'ht_two_fifth');


function ht_two_fifth_last( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('two_fifth_last', 'ht_two_fifth_last');

function ht_three_fifth( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'ht_three_fifth');


function ht_three_fifth_last( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('three_fifth_last', 'ht_three_fifth_last');

function ht_four_fifth( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'ht_four_fifth');


function ht_four_fifth_last( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('four_fifth_last', 'ht_four_fifth_last');

function ht_one_sixth( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'ht_one_sixth');


function ht_one_sixth_last( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('one_sixth_last', 'ht_one_sixth_last');


function ht_five_sixth( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'ht_five_sixth');


function ht_five_sixth_last( $atts, $content = null ) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="fixbox"></div>';
}
add_shortcode('five_sixth_last', 'ht_five_sixth_last');

/*
 * Misc
 */
function ht_p_sc( $atts, $content = null ) {
	return '<p class="shortcode">' . do_shortcode($content) . '</p>';
}
add_shortcode('p', 'ht_p_sc');

function ht_h4_sc( $atts, $content = null ) {
	return '<h4>' . $content . '</h4>';
}
add_shortcode('h4', 'ht_h4_sc');

function ht_price( $atts, $content = null ) {
	return '<span class="price">' . $content . '</span>';
}
add_shortcode('price', 'ht_price');

?>