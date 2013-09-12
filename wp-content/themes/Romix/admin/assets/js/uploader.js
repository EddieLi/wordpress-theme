jQuery(document).ready(function() {
	
jQuery('.upload_image_button').click(function() {
 uploadId = jQuery(this).attr('id');		
 mainId = uploadId.substr(2); 
 post_id = jQuery(this).attr('rel');
 formfield = jQuery('#'+ uploadId).attr('name');
 tb_show('', 'media-upload.php?post_id='+post_id+'&type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#'+ mainId).val(imgurl);
 tb_remove();
}

});
