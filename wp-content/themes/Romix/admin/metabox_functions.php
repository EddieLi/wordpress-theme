<?php
// General settings
function ht_general_settings()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['general']);

}
// Homepage settings
function ht_homepagegeneral_settings()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['homepage_general']);
}
// SEO settings
function ht_seo_settings()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['seo_settings']);
}
// Subheading settings
function ht_subheading_settings(){
    global $hight_options;
    echo highthemes_generate_fields($hight_options['subheading']);
}
// Slideshow settings
function ht_slideshow_settings(){
	global $hight_options;
	echo highthemes_generate_fields($hight_options['sliders']);
}
// Blog settings
function ht_blog_settings()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['blog']);

}

// Contact settings
function ht_contact_settings()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['contact']);

}

// Social accounts
function ht_accounts_settings()
{
	global $hight_options;
	echo highthemes_generate_fields($hight_options['accounts']);

}
// Additional Save Button
function save_form_box()
{
?><p>
<input type="submit" value="Save Changes" class="button-primary"
name="Submit" />
</p>
<?php
}
?>