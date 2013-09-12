<?php
/*
 * Highthemes.com Admin Framework
 * Twitter ID: theHighThemes
 */

// Getting Wordpress pages list
$ht_pages = array();
$ht_pages_obj = get_pages();    
foreach ($ht_pages_obj as $ht_page) {
    	$ht_pages[$ht_page->ID] = $ht_page->post_title;
}

// Getting Wordpress categoris list
$categories = array();  
$categories_obj = get_categories('hide_empty=0');
foreach ($categories_obj as $highcat) {
		$categories[$highcat->cat_ID] = $highcat->cat_name;
}
$hight_options = array();

/*
 * Defining meta boxes
*/
$hight_options['general'][] = array(	"name" => __("General",'highthemes'),
					"id" => "ht_general_settings",
					"context" => "normal",
					"type" => "heading");

$hight_options['homepage_general'][] = array(	"name" => __("Homepage",'highthemes'),
					"id" => "ht_homepagegeneral_settings",
					"context" => "normal",
					"type" => "heading");
					
$hight_options['seo_settings'][] = array(	"name" => __("SEO",'highthemes'),
					"id" => "ht_seo_settings",
					"context" => "normal",
					"type" => "heading");					

$hight_options['sliders'][] = array(	"name" => __("Slideshow",'highthemes'),
					"id" => "ht_slideshow_settings",
					"context" => "normal",
					"type" => "heading");

$hight_options['subheading'][] = array(	"name" => __("Subheader",'highthemes'),
					"id" => "ht_subheading_settings",
					"context" => "normal",
					"type" => "heading");

$hight_options['blog'][] = array(	"name" => __("Blog",'highthemes'),
					"id" => "ht_blog_settings",
					"context" => "normal",
					"type" => "heading");

$hight_options['contact'][] = array(	"name" => __("Contact Page",'highthemes'),
					"id" => "ht_contact_settings",
					"context" => "normal",
					"type" => "heading");

$hight_options['accounts'][] = array(	"name" => __("Accounts",'highthemes'),
					"id" => "ht_accounts_settings",
					"context" => "side",
					"type" => "heading");
/*
 * Accounts Options
 */
$hight_options['accounts'][] = array(	"name" => __("Feedburner:",'highthemes'),
					"desc" => __("Enter your Feedburner URL here. (Feedburner or other)",'highthemes'),
					"id" => $shortname."_feedburner_url",
					"std" => "",
					"type" => "text","options" => array("class" => ""));		
					
$hight_options['accounts'][] = array(	"name" => __("Twitter ID:",'highthemes'),
					"desc" => __("Enter your <strong>Twitter ID </strong>here.",'highthemes'),
					"id" => $shortname."_twitter_id",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));		
													
$hight_options['accounts'][] = array(	"name" => __("Facebook:",'highthemes'),
					"desc" => __("Enter your Facebook page URL here.",'highthemes'),
					"id" => $shortname."_facebook_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));		
													
$hight_options['accounts'][] = array(	"name" => __("LinkedIn:",'highthemes'),
					"desc" => __("Enter your LinkedIn Profile URL here.",'highthemes'),
					"id" => $shortname."_linkedin_profile_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$hight_options['accounts'][] = array(	"name" => __("Flickr:",'highthemes'),
					"desc" => __("Enter your Flickr Profile URL here.",'highthemes'),
					"id" => $shortname."_flickr_profile_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	


$hight_options['accounts'][] = array(	"name" => __("Digg:",'highthemes'),
					"desc" => __("Enter your Digg Profile URL here.",'highthemes'),
					"id" => $shortname."_digg_profile_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$hight_options['accounts'][] = array(	"name" => __("Delicious:",'highthemes'),
					"desc" => __("Enter your Delicious Profile URL here.",'highthemes'),
					"id" => $shortname."_delicious_profile_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


/*
 * General Options
 */
$hight_options['general'][] = array(	"name" => __("Logo",'highthemes'),
					"desc" => __("Specify the image address of your online logo. (http://yoursite.com/logo.png)",'highthemes'),
					"id" => $shortname."_logo_url",
					"std" => "",
					"type" => "upload");


$hight_options['general'][] = array(	"name" => __("Header Height",'highthemes'),
					"desc" => __("You can change the height of header, if you need more space for your logo here.",'highthemes'),
					"id" => $shortname."_header_height",
					"std" => "100px",
					"type" => "text");

$hight_options['general'][] = array(	"name" => __("Favicon",'highthemes'),
					"desc" => __("16px x 16px image that will represent your website's favicon.",'highthemes'),
					"id" => $shortname."_favicon_url",
					"std" => "",
					"type" => "text");
				
$hight_options['general'][] = array(	"name" => __("Tracking Code",'highthemes'),
					"desc" => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",'highthemes'),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));	
							

$hight_options['general'][] = array(	"name" => __("Copyright Text",'highthemes'),
					"desc" => __("Enter your copyright text here.",'highthemes'),
					"id" => $shortname."_copyright_text",
					"std" => "",
					"type" => "text");	


$hight_options['general'][] = array(	"name" => __("Disable post image (also for pages)?",'highthemes'),
					"desc" => __("You can add an image to each post or page. If you want to not show them in their pages, check this box.",'highthemes'),
					"id" => $shortname."_post_image",
					"std" => "false",
					"type" => "checkbox");	

$hight_options['general'][] = array(	"name" => __("Disable Breadcrumb?",'highthemes'),
					"desc" => __("If you want to disable breadcrumb, check this box.",'highthemes'),
					"id" => $shortname."_breadcrumb_inner",
					"std" => "false",
					"type" => "checkbox");	

$hight_options['general'][] = array(	"name" => __("Disable Cufon?",'highthemes'),
					"desc" => __("If you want to disable Cufon font replacement, check this box.",'highthemes'),
					"id" => $shortname."_cufon_status",
					"std" => "false",
					"type" => "checkbox");	

$hight_options['general'][] = array(	"name" => __("Cufon Headings Font",'highthemes'),
					"desc" => __("Select your headings font here.",'highthemes'),
					"id" => $shortname."_cufon_font",
					"std" => "",
					"type" => "select", "options" => array("Vegur","PT Serif","Cantarell","Cardo","Comfortaa","Droid Sans","Josefin Sans","Molengo","Oswald","Reenie Beanie","Sansation","UnifrakturCook"));

$hight_options['general'][] = array(	"name" => __("Footer Columns",'highthemes'),
					"desc" => __("Specify the number of footer blocks.",'highthemes'),
					"id" => $shortname."_footer_blocks",
					"std" => "5",
					"type" => "select", "options" => array("2", "3", "4", "5"));

 $hight_options['general'][] = array(	"name" => __("Theme Styles",'highthemes'),
					"desc" => __("Background And Patterns",'highthemes'),
					"std" => "",
					"type" => "sub_heading");	
					
					$hight_options['general'][] = array(	"name" => __("Background Color",'highthemes'),
					"desc" => __("Choose a background color for the theme.",'highthemes'),
					"id" => $shortname."_bg_color",
					"std" => "eeeeee",
					"type" => "text");
					
$hight_options['general'][] = array(	"name" => __("Background Pattern",'highthemes'),
					"desc" => __("Choose one available background patterns.",'highthemes'),
					"id" => $shortname."_bg_pattern",
					"std" => "",
					"type" => "select", "options" => array("No Pattern", 
					"1.png", "2.png", "3.png", "4.png", "5.png",
					"6.png", "7.png", "8.png", "9.png", "10.png",
					"11.png", "12.png", "13.png", "14.png", "15.png",
					"16.png", "17.png", "18.png", "19.png","20.png"
					));					

$hight_options['general'][] = array(	"name" => __("Custom CSS Code",'highthemes'),
					"desc" => __("You can override any of theme's CSS codes by writing your own CSS codes here in this text area",'highthemes'),
					"id" => $shortname."_custom_css",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));	
										
 $hight_options['general'][] = array(	"name" => __("Top Bar Elements",'highthemes'),
					"desc" => __("Top Navigatin Search / Icons",'highthemes'),
					"std" => "",
					"type" => "sub_heading");	

$hight_options['general'][] = array(	"name" => __("Disable Top Search?",'highthemes'),
					"desc" => __("If you want to disable the search form of header, check this box."),
					"id" => $shortname."_disable_top_search",
					"std" => "false",
					"type" => "checkbox");						

$hight_options['general'][] = array(	"name" => __("Disable Top Social Icons?",'highthemes'),
					"desc" => __("If you want to disable the social icons of the header, check this box."),
					"id" => $shortname."_disable_top_icons",
					"std" => "false",
					"type" => "checkbox");	
					

					
$hight_options['general'][] = array(	"name" => __("Custom 404",'highthemes'),
					"desc" => __("Write your own 404 Error Message.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");

$hight_options['general'][] = array(	"name" => __("Custom 404",'highthemes'),
					"desc" => __("Here you can enter your own message for 404 error page.",'highthemes'),
					"id" => $shortname."_custom_404",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));	

$hight_options['general'][] = array(	"name" => __("Coming Soon Details",'highthemes'),
					"desc" => __("Here you can enter the date you will publish your website."),
					"std" => "",
					"type" => "sub_heading");

$hight_options['general'][] = array(	"name" => __("Publish Year",'highthemes'),
					"desc" => __("For example: 2010",'highthemes'),
					"id" => $shortname."_timer_year",
					"std" => "",
					"type" => "text");	

$hight_options['general'][] = array(	"name" => __("Publish Month",'highthemes'),
					"desc" => __("For example: 10 \ between 1-12",'highthemes'),
					"id" => $shortname."_timer_month",
					"std" => "",
					"type" => "text");	

$hight_options['general'][] = array(	"name" => __("Publish Day",'highthemes'),
					"desc" => __("For example: 22 \ between 1-31",'highthemes'),
					"id" => $shortname."_timer_day",
					"std" => "",
					"type" => "text");	

$hight_options['general'][] = array(	"name" => __("Publish Hour",'highthemes'),
					"desc" => __("For example: 18 \ between 1-24",'highthemes'),
					"id" => $shortname."_timer_hour",
					"std" => "",
					"type" => "text");	

$hight_options['general'][] = array(	"name" => __("Publish Minute",'highthemes'),
					"desc" => __("For example: 30 \ between 1-59",'highthemes'),
					"id" => $shortname."_timer_minute",
					"std" => "",
					"type" => "text");	
					
$hight_options['general'][] = array(	"name" => __("Expiry Text",'highthemes'),
					"desc" => __("This message will be shown when the timer expires.",'highthemes'),
					"id" => $shortname."_timer_text",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));	
					
$hight_options['general'][] = array(	"name" => __("Portfolio Options",'highthemes'),
					"desc" => __("Portfolio general options can be set here."),
					"std" => "",
					"type" => "sub_heading");	
					
$hight_options['general'][] = array(	"name" => __("Disable Related Items?",'highthemes'),
					"desc" => __("If you want to disable related items, check this box.",'highthemes'),
					"id" => $shortname."_folio_related",
					"std" => "false",
					"type" => "checkbox");									
/*
 * Homepage Options
 */

					
$hight_options['homepage_general'][] = array(	"name" => __("Call-To-Action",'highthemes'),
					"desc" => __("Here you can enter your call-to-action text.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");	

$hight_options['homepage_general'][] = array(	"name" => __("Disable Call-to-action?",'highthemes'),
					"desc" => __("If you want to disable call-to-action box, check this box.",'highthemes'),
					"id" => $shortname."_cta_status",
					"std" => "false",
					"type" => "checkbox");	

$hight_options['homepage_general'][] = array(	"name" => __("<abbr title=\"Call to action\">CTA</abbr> Text",'highthemes'),
					"desc" => __("Enter your desired text for call to action button.",'highthemes'),
					"id" => $shortname."_cta_text",
					"std" => "",
					"type" => "text");

$hight_options['homepage_general'][] = array(	"name" => __("<abbr title=\"Call to action\">CTA</abbr> Button Title",'highthemes'),
					"desc" => __("Enter a title for <abbr title=\"Call to action\">CTA</abbr> button.",'highthemes'),
					"id" => $shortname."_cta_button",
					"std" => "",
					"type" => "text");

$hight_options['homepage_general'][] = array(	"name" => __("<abbr title=\"Call to action\">CTA</abbr> Button Link)",'highthemes'),
					"desc" => __("Enter a link address for the call-to-action button.",'highthemes'),
					"id" => $shortname."_cta_link",
					"std" => "",
					"type" => "text");

$hight_options['homepage_general'][] = array(	"name" => __("Feature Boxes",'highthemes'),
					"desc" => __("Here you can have three different feature boxes. You can edit the HTML provided here.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");

$hight_options['homepage_general'][] = array(	"name" => __("Disable Feature Boxes?",'highthemes'),
					"desc" => __("If you want to disable these three boxes, check this box.",'highthemes'),
					"id" => $shortname."_mini_features_status",
					"std" => "false",
					"type" => "checkbox");
					
$hight_options['homepage_general'][] = array(	"name" => __("First Feature Box",'highthemes'),
					"desc" => __("Edit the HTML provided here.",'highthemes'),
					"id" => $shortname."_first_mini_feature",
					"std" =>'
<h3>Lorem Ipsom</h3>
<a href="#"><img alt="" src="'.get_template_directory_uri().'/images/277x121.jpg" class="frame" /></a>
<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. </p>
<a href="#" class="arrow-link">More Info</a>',
							
					"type" => "textarea", "options" => array("rows" => "9","cols" => "80"));

$hight_options['homepage_general'][] = array(	"name" => __("Second Feature Box",'highthemes'),
					"desc" => __("Edit the HTML provided here.",'highthemes'),
					"id" => $shortname."_second_mini_feature",
					"std" =>'
<h3>Lorem Ipsom</h3>
<a href="#"><img alt="" src="'.get_template_directory_uri().'/images/277x121.jpg" class="frame" /></a>
<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. </p>
<a href="#" class="arrow-link">More Info</a>',

							
					"type" => "textarea", "options" => array("rows" => "9","cols" => "80"));		

$hight_options['homepage_general'][] = array(	"name" => __("Third Feature Box",'highthemes'),
					"desc" => __("Edit the HTML provided here.",'highthemes'),
					"id" => $shortname."_third_mini_feature",
					"std" =>'
<h3>Lorem Ipsom</h3>
<a href="#"><img alt="" src="'.get_template_directory_uri().'/images/277x121.jpg" class="frame" /></a>
<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. </p>
<a href="#" class="arrow-link">More Info</a>',

							
					"type" => "textarea", "options" => array("rows" => "9","cols" => "80"));
					
					
$hight_options['homepage_general'][] = array(	"name" => __("Homepage Featured Items",'highthemes'),
					"desc" => __("You can select any number of your portfolio/gallery items and sisplay theme as a small slider in homepage. ",'highthemes'),
					"std" => "",
					"type" => "sub_heading");
							
$hight_options['homepage_general'][] = array(	"name" => __("Disable Homepage Featured Items?",'highthemes'),
					"desc" => __("If you want to disable homepage featured items, check this box.",'highthemes'),
					"id" => $shortname."_home_featured_items_status",
					"std" => "false",
					"type" => "checkbox");

$hight_options['homepage_general'][] = array(	"name" => __("Featured Items",'highthemes'),
					"desc" => __("Please enter a comma-separated list of posts<a href=\"http://support.wordpress.com/pages/8/\" >ID's</a> that you'd like 
								 to be shown in homepage featured items' slider. (e.g. 1,13,42,4)",'highthemes'),
					"id" => $shortname."_home_featured_items",
					"std" => "",
					"type" => "text");	
											
$hight_options['homepage_general'][] = array(	"name" => __("Homepage Testimonial",'highthemes'),
					"desc" => __("You can have your clients testimonial here.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");
					
$hight_options['homepage_general'][] = array(	"name" => __("Disable Homepage Testimonial?",'highthemes'),
					"desc" => __("If you want to disable homepage testimonial section, check this box.",'highthemes'),
					"id" => $shortname."_home_testimonial_status",
					"std" => "false",
					"type" => "checkbox");	
									
					$hight_options['homepage_general'][] = array(	"name" => __("Testimonial",'highthemes'),
					"desc" => __("We have used the theme's testimonial shortcode. ",'highthemes'),
					"id" => $shortname."_testimonial_text",
					"std" => '
[testimonials height="120px"]

[testimonial name="John Smith" website_url="http://www.johnsmith.com"]
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. e.
[/testimonial]

[testimonial name="Lorem Ipsum" website_url="http://www.lorem.com"]
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. 
[/testimonial]

[testimonial name="" website_url=""]
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.
[/testimonial]

[/testimonials] 					
					',
					"type" => "textarea", "options" => array("rows" => "20","cols" => "64"));										

$hight_options['homepage_general'][] = array(	"name" => __("Tab-Based Homepage",'highthemes'),
					"desc" => __("If you chose Tab-Based Homepage template while creating your homepage, here you can select the pages.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");

$hight_options['homepage_general'][] = array(	"name" => __("Featured Pages on Tabs",'highthemes'),
					"desc" => __("Enter a comma-separated list of <a href=\"http://support.wordpress.com/pages/8/\" >ID's</a> that you'd like 
								 to be shown in Tab-Based homepage. (e.g. 1,13,42,4)",'highthemes'),
					"id" => $shortname."_featured_tabs_ids",
					"std" => "",
					"type" => "text");
					
				

/*
 * SEO Options
 */
 $hight_options['seo_settings'][] = array(	"name" => __("Disable SEO?",'highthemes'),
					"desc" => __("If you want to disable SEO Options, check this box.",'highthemes'),
					"id" => $shortname."_seo_status",
					"std" => "false",
					"type" => "checkbox");
 
$hight_options['seo_settings'][] = array(	"name" => __("Homepage SEO Options",'highthemes'),
					"desc" => __("You can have custom title, keywords, and description for homepage.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");	

$hight_options['seo_settings'][] = array(	"name" => __("HomePage Title",'highthemes'),
					"desc" => __("Enter your HomePage title.",'highthemes'),
					"id" => $shortname."_homepage_title",
					"std" => "",
					"type" => "text");

$hight_options['seo_settings'][] = array(	"name" => __("Keywords",'highthemes'),
					"desc" => __("Enter some keywords about your website for search engines. Use comma \", \" as saparator. It will be used only in homepage.",'highthemes'),
					"id" => $shortname."_homepage_keywords",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));

$hight_options['seo_settings'][] = array(	"name" => __("Description",'highthemes'),
					"desc" => __("Enter a short description for searh engines. It will be used only in homepage.",'highthemes'),
					"id" => $shortname."_homepage_description",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));		


$hight_options['seo_settings'][] = array(	"name" => __("General Pages SEO Options",'highthemes'),
					"desc" => __("Here you can enter keywords and description for other pages.",'highthemes'),
					"std" => "",
					"type" => "sub_heading");	

$hight_options['seo_settings'][] = array(	"name" => __("Keywords",'highthemes'),
					"desc" => __("Enter some keywords about your website for search engines. Use comma \", \" as saparator.",'highthemes'),
					"id" => $shortname."_keywords",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));

$hight_options['seo_settings'][] = array(	"name" => __("Description",'highthemes'),
					"desc" => __("Enter a short description for searh engines.",'highthemes'),
					"id" => $shortname."_description",
					"std" => "",
					"type" => "textarea", "options" => array("rows" => "5","cols" => "64"));


/*
 * Subheader Options
 */
$hight_options['subheading'][] = array(	"name" => __("Subheader Content",'highthemes'),
					"desc" => __("Select default subheader content",'highthemes'),
					"id" => $shortname."_subheading_content",
					"std" => "Twitter",
					"type" => "select", "options" => array("Twitter", "Button", "Posts", "disabled"));

$hight_options['subheading'][] = array(	"name" => __("Subheader Posts (With Thumbnails)",'highthemes'),
					"desc" => __("(if you selected posts from the list above)Enter a comma-separated list of post/page/portfolio's ID's that you'd like to be shown as subheader featured posts on inner pages. (e.g. 1,13,42,4)",'highthemes'),
					"id" => $shortname."_subheading_posts_ids",
					"std" => "",
					"type" => "text");

$hight_options['subheading'][] = array(	"name" => __("Default Button Title",'highthemes'),
					"desc" => __("(if you selected button from the list above) Enter a default title for subheader button. You can overwrite it in pages/posts later.",'highthemes'),
					"id" => $shortname."_subheading_button_title",
					"std" => "",
					"type" => "text");

$hight_options['subheading'][] = array(	"name" => __("Default Button Link",'highthemes'),
					"desc" => __("(if you selected button from the list above) Enter a default link for subheader button. You can overwrite it in pages/posts later.",'highthemes'),
					"id" => $shortname."_subheading_button_link",
					"std" => "",
					"type" => "text");

/*
 * Slideshow Options
 */
$hight_options['sliders'][] = array(	"name" => __("Disable Slideshow?",'highthemes'),
					"desc" => __("If you want to disable slideshow, check this box.",'highthemes'),
					"id" => $shortname."_disable_slideshow",
					"std" => "false",
					"type" => "checkbox");	
$hight_options['sliders'][] = array(	"name" => __("Slider Transition Speed:",'highthemes'),
					"desc" => __("Enter transition speed in miliseconds.",'highthemes'),
					"id" => $shortname."_slideshow_speed",
					"std" => "",
					"type" => "text");
$hight_options['sliders'][] = array(	"name" => "Slider Transition Effect:",
					"desc" => "Select Slideshow Effect.",
					"id" => $shortname."_slideshow_effect",
					"std" => "fade",
					"type" => "select", "options" => array("scrollRight", "fade", "scrollLeft", "curtainX", "scrollUp", "scrollDown", "wipe", "blindX", "blindY","uncover", "shuffle"));


/*
 * Blog Options
 */
$hight_options['blog'][] = array(	"name" => __("Disable About Author?",'highthemes'),	
					"desc" => __("If you want to disable about author, check this box.",'highthemes'),
					"id" => $shortname."_authorbox_status",
					"std" => "false",
					"type" => "checkbox");	

$hight_options['blog'][] = array(	"name" => __("Disable Related Posts?",'highthemes'),
					"desc" => __("If you want to disable related posts, check this box.",'highthemes'),
					"id" => $shortname."_relatedposts_status",
					"std" => "false",
					"type" => "checkbox");	

$hight_options['blog'][] = array(	"name" => __("Exclude Categroies",'highthemes'),
					"desc" => __("Enter a comma-separated list of <a href=\"http://www.wprecipes.com/how-to-find-wordpress-category-id\" >ID's</a> that you'd like to be excluded from blog. (e.g. 1,13,42,4)",'highthemes'),
					"id" => $shortname."_excluded_cats",
					"std" => "",
					"type" => "text");


/*
 * Contact Page Options
 */

$hight_options['contact'][] = array(	"name" => __("Your email address",'highthemes'),
					"desc" => __("Enter your E-mail address to use on the Contact Page Template.",'highthemes'),
					"id" => $shortname."_email_address",
					"std" => "",
					"type" => "text");	


?>