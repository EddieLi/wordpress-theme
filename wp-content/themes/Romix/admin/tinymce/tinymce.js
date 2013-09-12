function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function InsertShortcodes() {
	
	var tagtext;
	
	var style = document.getElementById('shortcodes_panel');
	var button = document.getElementById('button_panel');
	var list = document.getElementById('list_panel');
	var sbox = document.getElementById('sbox_panel');
	var tbox = document.getElementById('tbox_panel');
	var infobox = document.getElementById('box_panel');
	var linkpanel = document.getElementById('link_panel');
	
	/*************** Button Generator ****************/
	if (button.className.indexOf('current') != -1) {
		
		var button_title = document.getElementById('button_title').value;
		var button_color = document.getElementById('button_color').value;
		var button_link = document.getElementById('button_link').value;
		var button_size = document.getElementById('button_size').value;
		
		
		tagtext = "[button link=\"" + button_link + "\" size=\"" + button_size + "\" color=\"" + button_color + "\"]"+ button_title + "[/button]";
		
	}
	/*
	************** Button Generator ****************/
	if (linkpanel.className.indexOf('current') != -1) {
		
		var link_title = document.getElementById('link_title').value;
		var link_icon = document.getElementById('link_icon').value;
		var link_url = document.getElementById('link_url').value;
		
		tagtext = "[icon_link link=\"" + link_url + "\"  icon=\"" + link_icon + "\"]"+ link_title + "[/icon_link]";
		
	}	/*************** List Generator ****************/
	if (list.className.indexOf('current') != -1) {
		
		var list_type = document.getElementById('list_type').value;		
		tagtext = "[list type=\"" + list_type + "\"]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/list]";
		
	}

	/*************** Simple Box Generator ****************/
	if (sbox.className.indexOf('current') != -1) {
		
		var sbox_border = document.getElementById('sbox_border').value;		
		var sbox_gradient = document.getElementById('sbox_gradient').value;		
		var sbox_border_color = document.getElementById('sbox_border_color').value;						
		
		tagtext = "[simple_box border_size=\"" + sbox_border + "\" border_color=\"" + sbox_border_color + "\" gradient=\"" + sbox_gradient + "\"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/simple_box]";
		
	}	
	
	/*************** Titled Box Generator ****************/
	if (tbox.className.indexOf('current') != -1) {
		
		var tbox_color = document.getElementById('tbox_color').value;		
		var tbox_gradient = document.getElementById('tbox_gradient').value;		
		var tbox_title = document.getElementById('tbox_title').value;						
		
		tagtext = "[titled_box title=\"" + tbox_title + "\" color=\"" + tbox_color + "\" gradient=\"" + tbox_gradient + "\"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/titled_box]";
		
	}		

	/*************** Info Box Generator ****************/
	if (infobox.className.indexOf('current') != -1) {
		
		var info_type = document.getElementById('info_type').value;		
		var info_color = document.getElementById('info_color').value;		
		var info_title = document.getElementById('info_title').value;						
		var info_icon = document.getElementById('info_icon').value;	
		
		if(info_type == 'titled'){
			
			tagtext = "[info_box title=\"" + info_title + "\" color=\"" + info_color + "\" type=\"" + info_type + "\" icon=\"" + info_icon + "\"] [/info_box]";
			
		} else {
			
			tagtext = "[info_box title=\"" + info_title + "\" color=\"" + info_color + "\" type=\"" + info_type + "\" icon=\"" + info_icon + "\"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/info_box]";
		
		}
							

		
	}	
	
	/*************** General Style Shortcodes ****************/
	
		if (style.className.indexOf('current') != -1) {
			
		var styleid = document.getElementById('style_shortcode').value;
		
		
		if (styleid != 0 ){
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "]";
		}
		if (styleid != 0 && styleid=='hr' || styleid=='hr_top' ){
			tagtext = "["+ styleid + "]";
		}
		if (styleid != 0 && styleid == 'tooltip'){
			tagtext = '\
[tooltip trigger="Tooltip Text Goes Here..." ]Lorem Ipsum dolor sit[/tooltip]\
';
		}
		if (styleid != 0 && styleid=='hr' || styleid=='hr_top' ){
			tagtext = "["+ styleid + "]";
		}					
		if ( styleid != 0 && styleid=='pricing_3col' ){
			
tagtext = '[pricing_table cols="3"] \
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" special="true" desc="Lorem ipsum dolor sit" color="orange"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[/pricing_table]	\
';		
		}	

		if ( styleid != 0 && styleid=='pricing_4col' ){
			
tagtext = '[pricing_table cols="4"] \
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" special="true" desc="Lorem ipsum dolor sit" color="orange"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[/pricing_table]	\
';		
		}			

		if ( styleid != 0 && styleid=='pricing_5col' ){
			
tagtext = '[pricing_table cols="5"] \
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" special="true" desc="Lorem ipsum dolor sit" color="orange"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[col title="Standard" desc="Lorem ipsum dolor sit" color="teal"]\
<br />\
<ul class="linelist">\
	<li>24/7 Lorem Ipsum</li>\
	<li>Advanced Lorem</li>\
	<li>100GB Dolor</li>\
	<li>1GB sit</li>\
	<li>Something amet</li>\
	<li><a href="#">Another Feature Here &raquo;</a></li>\
</ul>\
<br />\
[price]$19.95[/price]\
<br />\
[button link="#" color="red" size="medium"]Sign up[/button]\
<br />\
[/col]\
<br />\
[/pricing_table]\
';		
		}			


		if (styleid != 0 && styleid == 'testimonial' ){
			tagtext = '\
[testimonials height="150px"]\
<br />\
[testimonial name="John Smith" website_url="http://www.johnsmith.com"]\
<br />\
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, \
posuere a, pede.\
<br />\
[/testimonial]\
<br />\
[testimonial name="Lorem Ipsum" website_url="http://www.lorem.com"]\
<br />\
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, \
posuere a, pede.\
<br />\
[/testimonial]\
<br />\
[testimonial name="" website_url=""]\
<br />\
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, \
posuere a, pede.\
<br />\
[/testimonial]\
<br />\
[/testimonials]\
			';	
		}
	
	
		if (styleid != 0 && styleid == 'slideshow'){
			tagtext = '\
[slideshow]\
<br />\
[slide width="500" height="150" resize="true" title="Lorem ipsum dolor sit amet"]PATH-TO-IMAGE[/slide]\
<br />\
[slide width="500" height="150" resize="true" link="http://highthemes.com" title="With Link"]PATH-TO-IMAGE[/slide]\
<br />\
[slide width="500" height="150" resize="true" link="" title=""]PATH-TO-IMAGE[/slide]\
<br />\
[/slideshow]\
';
		}
		
		if (styleid != 0 && styleid == 'cta'){
			tagtext = '\
[cta_box]\
<br />\
[simple_box border_size="3px" border_color="pink" gradient="true"]<br />\
[button link="#" size="large" color="pink"]Get Started![/button]\
<br />\
[h4]Lorem Ipsum Dolor Sit Amet Goes Here.[/h4]\
<br />\
[/simple_box]<br />\
[/cta_box]\
';
		}		
		
		if (styleid != 0 && styleid == 'video'){
			tagtext = "["+ styleid + " width=\"550\" height=\"400\" url=\"Vimeo, youtube, dailymotion or path to flv, mp4, swf\" /]";	
		}
						
		if (styleid != 0 && styleid == 'simple_toggle'){
			tagtext = '\
[toggle title="Toggle Title" type="simple"]Insert your text here[/toggle]\
';
		}
		
		if (styleid != 0 && styleid == 'framed_toggle'){
			tagtext = '\
[toggle title="Toggle Title" type="framed"]Insert your text here[/toggle]\
';
		}
		if (styleid != 0 && styleid == 'h_red' ){
			tagtext = '\
[highlight color="red"]Lorem ipsum[/highlight]\
';
		}
		if (styleid != 0 && styleid == 'h_yellow' ){
			tagtext = '\
[highlight color="yellow"]Lorem ipsum[/highlight]\
';
		}
		if (styleid != 0 && styleid == 'h_black' ){
			tagtext = '\
[highlight color="black"]Lorem ipsum[/highlight]\
';
		}

		if (styleid != 0 && styleid == 'frame_left' || styleid == 'frame_right' || styleid == 'frame_center' || styleid =='frame' ){
			tagtext = "["+ styleid + " link=\"link address here (optional)\"]Insert the Full URL of the image.[/" + styleid + "]";	
		}
		if (styleid != 0 && styleid == 'lightbox_image'){
			tagtext = "["+ styleid + " title=\"lightbox title\" big_image_url=\"Insert Bigger Image's URL here \"]Insert the Full URL of the thumbnail image.[/" + styleid + "]";	
		}		
		if (styleid != 0 && styleid == 'dropcap1' ){
			tagtext = '\
[dropcap type="dropcap1"]A[/dropcap]\
';
		}
		if (styleid != 0 && styleid == 'dropcap2' ){
			tagtext = '\
[dropcap type="dropcap2"]A[/dropcap]\
';
		}
		if (styleid != 0 && styleid == 'dropcap3' ){
			tagtext = '\
[dropcap type="dropcap3"]A[/dropcap]\
';
		}

		if (styleid != 0 && styleid == 'tabs' ){
			tagtext = "["+ styleid + " tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\"]<br /><br />[tab]Tab content 1[/tab]<br />[tab]Tab content 2[/tab]<br />[tab]Tab content 3[/tab]<br /><br />[/" + styleid + "]";
		}	
		if (styleid != 0 && styleid == 'accordions' ){
			tagtext = "["+ styleid + "]<br /><br />[accordion title=\"Title 1\"]content 1[/accordion]<br />[accordion title=\"Title 2\"]content 2[/accordion]<br />[accordion title=\"Title 3\"]content 3[/accordion]<br /><br />[/" + styleid + "]";
		}
		if (styleid != 0 && styleid == 'pullquote' ){
			tagtext = "["+ styleid + " cite=\"Insert the cite here\"]Insert the quote here.[/" + styleid + "]";
		}		
	
		
		if ( styleid == 0 ){
			tinyMCEPopup.close();
		}
	}

	
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}