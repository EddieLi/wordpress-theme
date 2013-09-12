jQuery.noConflict();
/*********************
//* jQuery Multi Level CSS Menu #2- By Dynamic Drive: http://www.dynamicdrive.com/
//* Last update: Nov 7th, 08': Limit # of queued animations to minmize animation stuttering
//* Menu avaiable at DD CSS Library: http://www.dynamicdrive.com/style/
*********************/

//Update: April 12th, 10: Fixed compat issue with jquery 1.4x

//Specify full URL to down and right arrow images (23 is padding-right to add to top level LIs with drop downs):
var arrowimages = {
    down: ['', ''],
    right: ['', '']
}
var jqueryslidemenu={
animateduration: {over: 200, out: 100}, //duration of slide in/ out animation, in milliseconds

buildmenu:function(menuid, arrowsvar){
	jQuery(document).ready(function($){
		var $mainmenu=jQuery("#"+menuid+">ul")
		var $headers=$mainmenu.find("ul").parent()
		$headers.each(function(i){
			var $curobj=jQuery(this)
			var $subul=jQuery(this).find('ul:eq(0)')
			this._dimensions={w:this.offsetWidth, h:this.offsetHeight, subulw:$subul.outerWidth(), subulh:$subul.outerHeight()}
			this.istopheader=$curobj.parents("ul").length==1? true : false
			$subul.css({top:this.istopheader? this._dimensions.h+"px" : 0})

			$curobj.hover(
				function(e){
					var $targetul=jQuery(this).children("ul:eq(0)")
					this._offsets={left:jQuery(this).offset().left, top:jQuery(this).offset().top}
					var menuleft=this.istopheader? 0 : this._dimensions.w
					menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>jQuery(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft
					if ($targetul.queue().length<=1) //if 1 or less queued animations
						$targetul.css({left:menuleft+"px", width:this._dimensions.subulw+'px'}).slideDown(jqueryslidemenu.animateduration.over)
				},
				function(e){
					var $targetul=jQuery(this).children("ul:eq(0)")
					$targetul.slideUp(jqueryslidemenu.animateduration.out)
				}
			) //end hover
			$curobj.click(function(){
				jQuery(this).children("ul:eq(0)").hide()
			})
		}) //end $headers.each()
		$mainmenu.find("ul").css({display:'none', visibility:'visible'})
	}) //end document.ready
}
}
jqueryslidemenu.buildmenu("nav", arrowimages)


/***************************************************
     Validate Email
***************************************************/

function isValidEmailAddress(emailAddress){
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

/***************************************************
     Preloader Image
***************************************************/
(function($){
    $.fn.preloadImages = function(options){

        var defaults = {
            showSpeed: 500,
            easing: 'easeOutQuad'
        };

        var options = $.extend(defaults, options);
        return this.each(function(){
            var container = jQuery(this);
            var image = container.find('img');

            $(image).css({ "visibility": "hidden", "opacity": "0" });
            $(image).bind('load error', function(){
                $(this).css({ "visibility": "visible" }).animate({ opacity:"1" }, {duration:options.showSpeed, easing:options.easing}).parent(container).removeClass('preload');
            }).each(function(){
                if(this.complete || ($.browser.msie && parseInt($.browser.version) == 6)) { $(this).trigger('load'); }
            });
        });
    }
})(jQuery);


// START Initiating
jQuery(document).ready(function(){

    /***************************************************
     ZOOM PORTFOLIO HOVER - COLUMN
     ***************************************************/
    jQuery("#folio a, #entries a, #sidebar a").find("img.frame").hover(function(){
        jQuery(this).stop().fadeTo(500, 0.5);
    }, function(){
        jQuery(this).stop().fadeTo(500, 1);
    });
	
    /***************************************************
     TESTIMONIAL
     ***************************************************/	
	jQuery('.testimonials').innerfade({ 
		animationtype: 'fade',
		speed: 'slow',
		timeout: 6000,
		type: 'random'
	}); 	
	
    /***************************************************
     Homepage Gallery
     ***************************************************/
	  var nextButton = jQuery('.nextbutton'), prevButton = jQuery('.prevbutton');
	  //Remove scrollbars
	  jQuery('.sc_menu').css({overflow: 'hidden'});
	
		var galleryNum = jQuery('#gallery li').size();
		var currentItem = 1;
		var temporaryLoc;
		var newLoc;
		
		nextButton.click(function() {
			if(currentItem == galleryNum - 4) {
				currentItem = 1;
				jQuery('#gallery').animate({"left":"0px"});
			} else {
				temporaryLoc = currentItem * 165;
				newLoc = temporaryLoc - temporaryLoc - temporaryLoc;
				jQuery('#gallery').animate({"left":newLoc});
				currentItem++;
			}
				return false;
		});
		
		prevButton.click(function() {
			if(currentItem == 1) {
				currentItem = 1;
				jQuery('#gallery').animate({"left":"0px"});
			} else {
				temporaryLoc = currentItem * 165 - 330;
				newLoc = temporaryLoc - temporaryLoc - temporaryLoc;
				jQuery('#gallery').animate({"left":newLoc});
				currentItem--;
			}
				return false;
		});	
		

    /***************************************************
     JQUERY TOGGLE
     ***************************************************/
    jQuery(".toggle-body").hide();
    jQuery(".toggle-head").click(function(){
        var tb = jQuery(this).next(".toggle-body");
        
        if (tb.is(':hidden')) {
            tb.prev('.toggle-head').children('h3').addClass('minus');
            tb.slideDown('slow');
            
        }
        else {
            tb.slideUp(200, function(){
                 tb.prev('.toggle-head').children('h3').removeClass('minus');
            });
        }
    });

	
    /***************************************************
     Tooltip
     ***************************************************/	
	jQuery(".tooltip_sc ").tooltip({ relative: true, offset: [5, 0], tipClass: 'tool_tip' });		
			
    /***************************************************
     FADE ON HOVER
     ***************************************************/
    function fade(){
        jQuery('.fade').hover(function(){
            jQuery(this).stop().animate({
                opacity: 0.5
            }, 400);
        }, function(){
            jQuery(this).stop().animate({
                opacity: 1
            }, 400);
        });
        
    }
    
    function invers_fade(){
    
        jQuery('.ifade').css({
            'opacity': '0.5'
        });      
        
        jQuery('.ifade').hover(function(){
            jQuery(this).stop().animate({
                opacity: 1
            }, 400);
        }, function(){
            jQuery(this).stop().animate({
                opacity: 0.5
            }, 400);
        });
        
    }

	jQuery('.flickr_badge_image').addClass('fade');

	fade();
    invers_fade();
	
    
    /***************************************************
     PrettyPhoto
     ***************************************************/
    jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
        overlay_gallery: false,
        "theme": 'dark_rounded' /* light_square / dark_rounded / light_square / dark_square */
    });
    
    
    /***************************************************
     Smooth Scrolling
	 http://github.com/kswedberg/jquery-smooth-scroll
     ***************************************************/
   function enable_smooth_scroll() {
    function filterPath(string) {
        return string;
                //.replace(/^\//,'')
               // .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
                //.replace(/\/$/,'');
    }

    var locationPath = filterPath(location.pathname);
    
    var scrollElement = 'html, body';
    jQuery('html, body').each(function () {
        var initScrollTop = jQuery(this).attr('scrollTop');
        jQuery(this).attr('scrollTop', initScrollTop + 1);
        if (jQuery(this).attr('scrollTop') == initScrollTop + 1) {
            scrollElement = this.nodeName.toLowerCase();
            jQuery(this).attr('scrollTop', initScrollTop);
            return false;
        }    
    });
    
    jQuery('a[href*=#header]').each(function() {
        var thisPath = filterPath(this.pathname) || locationPath;
        if  (   locationPath == thisPath
                && (location.hostname == this.hostname || !this.hostname)
                && this.hash.replace(/#/, '')
            ) {
                if (jQuery(this.hash).length) {
                    jQuery(this).click(function(event) {
                        var targetOffset = jQuery(this.hash).offset().top;
                        var target = this.hash;
                        event.preventDefault();
                        jQuery(scrollElement).animate(
                            {scrollTop: targetOffset},
                            500,
                            function() {
                                location.hash = target;
                        });
                    });
                }
        }
    });
}

    enable_smooth_scroll();
    /***************************************************
     Contact Form
     ***************************************************/
    jQuery('form#contactform').submit(function(){
    
        var hasError = false;
		
		
		  var comment = jQuery("#form_message").val();
        if (jQuery.trim(comment) == "") {
            jQuery("#form_message").prev('label').addClass('error');
            jQuery("#form_message").focus();
            hasError = true;
        }
        else {
            jQuery("#form_message").prev('label').removeClass('error');
        }
		
		
		 var email = jQuery("input#email").val();
        if (jQuery.trim(email) == "" || !isValidEmailAddress(email)) {
            jQuery("input#email").prev('label').addClass('error');
            jQuery("input#email").focus();
            hasError = true;
        }
        else {
            jQuery("input#email").prev('label').removeClass('error');
        }
        
		
        var name = jQuery("input#fullname").val();
        if (jQuery.trim(name) == "") {
            jQuery("input#fullname").prev('label').addClass('error');
            jQuery("input#fullname").focus();
            hasError = true;
            
        }
        else {
            jQuery("input#fullname").prev('label').removeClass('error');
        }
        
        if (!hasError) {
            jQuery('form#contactform .ibutton').fadeOut('normal', function(){
                jQuery('.loading').css({
                    display: "block"
                });
                
            });
            
            jQuery.post(jQuery("#contactform").attr('action'), jQuery("#contactform").serialize(), function(data){
                jQuery('.log').html(data);
                jQuery('.loading').remove();
                jQuery('#contactform').slideUp('slow');
            });
            
        }
        
        return false;
        
    });
    /***************************************************
     SlideShow
     ***************************************************/
	 function cyclePause() {
		jQuery('#slideshow, .container').hover(
		function(){
			jQuery('.slides').cycle('pause')
		},
		function(){
			if(jQuery('.videoslider').lenghth < 1){
				jQuery('.slides').cycle('resume')
			}
			
		});
}

	 var $sliderspeed = jQuery("meta[name=slider_speed]").attr('content');
	 var $slider_effect = jQuery("meta[name=slider_effect]").attr('content');
	 if($slider_effect=='') $slider_effect = 'fade';
	 if ($sliderspeed != ""){$duration = $sliderspeed}else{$duration = 5000;}
    jQuery('.slides').cycle({
        fx: '' + $slider_effect + '',
		speed: 700,
		timeout: $sliderspeed,
		cleartypeNoBg: true,
		cleartype: true,		
        pager: '.pagination',
		pauseOnPagerHover: true,
        pagerAnchorBuilder: function(idx, slide){
            // return selector string for existing anchor 
            return '.pagination li:eq(' + idx + ') a';
        }
    });
	
	function pauseSlider() {
		
		jQuery('.videoslider').mousedown(function () {
		jQuery('.slides').cycle('pause')});
		
		cyclePause();
		
	}
	
	
	pauseSlider();
	
	jQuery(".slideshow .slides").each(function() {
			jQuery(this).before('<div class="pagination-post"></div>').cycle({
				fx: 'fade' ,
				timeout: 0,
				cleartypeNoBg: true,
				cleartype: true,
				pager: jQuery(this).prev()	
			});
		});	

    /***************************************************
     TAB
     ***************************************************/
	jQuery("ul.tabs-titles").tabs(".tab-set .tab-content");
	//jQuery(".tab-set ul.tabs").tabs("> .tab_content");
	jQuery(".accordion").tabs(".acc-item .acc-content", {tabs: 'h4', effect: 'slide', initialIndex: null});
	
	jQuery(".tabs").tabs("#tabbed-content > div");
	
	/***************************************************
     Misc
     ***************************************************/
    jQuery('.opacity').css('opacity', '0.8');
	jQuery('#footer-menu li:last-child').css('border-right', 'none'); 
	jQuery('#footer-menu li:last-child a').css('margin-right','0');
	
	//cufon
	 var $cufon_status = jQuery("meta[name=cufon_status]").attr('content');
	if($cufon_status != 'true') {
		
		Cufon.replace('h1, h2, h3, h4, h5, h6');
		Cufon.replace ('.cta-button, .pricing-heading h2 ',{textShadow: '#000 1px 1px'	});
		Cufon.replace ('#sidebar h3,#footer h3, .titled-box h6, .page-title h1 , .intro h2',{textShadow: '#fff 1px 1px'});
	
	}
	
	//preloader
	    jQuery('.preload').preloadImages({
        showSpeed: 500,   // length of fade-in animation, 500 is default
        easing: 'easeOutQuad'   // optional easing, if you don't have any easing scripts - delete this option
    });
	
	//demo style switcher
	function style_switcher(){
		jQuery('#style-switcher .color').click(function(){
			bg_color = jQuery(this).attr('rel');	
			jQuery('body').css("background-color","#"+bg_color+"");	
			return false;
		});
		jQuery('#style-switcher .pattern').click(function(){
			pattern = jQuery(this).attr('rel');	
			jQuery('body').css("background-image",pattern);	
			return false;
		});		
		
		jQuery('#close_btn').click(function(){
			jQuery("#inner-switch").toggle('slide');


		});	
	}

style_switcher();

}); // End Initiating
