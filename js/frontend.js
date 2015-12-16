/******************************
    Iced Mocha
    custom scripting
    (c) Event Espresso
	eventespresso.com
*******************************/


jQuery(document).ready(function() {

// standard menu touch support for tablets
	var isTouch = ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch; // check touch support
	jQuery('#access .menu > ul > li a').click(function(e){
		var $link_id = jQuery(this).attr('href');
		if (jQuery(this).parent().data('clicked') == $link_id) { // second touch
			jQuery(this).parent().data('clicked', null);
			return true;
		}
		else { // first touch
			if (isTouch && (jQuery(this).parent().children('.sub-menu').length >0)) e.preventDefault();
			jQuery(this).parent().data('clicked', $link_id);
		}
    });

// Back to top button animation
	var offset = 500;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
			jQuery('#toTop').css({'margin-left':''+espresso_theme_toTop_offset+'px','opacity':1});
			jQuery('#toTop').css({'margin-right':''+espresso_theme_toTop_offset+'px','opacity':1});
			
        } else {

			jQuery('#toTop').css({'margin-left':''+(espresso_theme_toTop_offset+150)+'px','opacity':0});
			jQuery('#toTop').css({'margin-right':''+(espresso_theme_toTop_offset+150)+'px','opacity':0});

        }
    });
    
    jQuery('#toTop').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });


// Menu animation



jQuery("#access ul ul").css({display: "none"}); // Opera Fix

jQuery("#access li").hover(function(){
	jQuery(this).find('ul:first').stop();
	jQuery(this).find('ul:first').css({opacity: "0",marginTop:"50px"}).css({visibility: "visible",display: "block",overflow:"visible"}).animate({"opacity":"1",marginTop:"-=50"},{queue:false});
	},function(){ 
	jQuery(this).find('ul:first').css({visibility: "visible",display: "block",overflow:"visible"}).animate({marginTop:"+=50"}, {queue:false}).fadeOut();
							});

												
// Social Icons Animation
jQuery(".socialicons").append('<div class="socials-hover"></div>');
jQuery(".socialicons").hover(function(){
		jQuery(this).find(".socials-hover").animate({"width":"26px","height":"26px","top":"2px","left":"2px"},{queue:false,duration:250});
	},function() {
		jQuery(this).find(".socials-hover").animate({"width":"0px","height":"0px","top":"50%","left":"50%"},{queue:false,duration:250, complete: function() {
			//jQuery(this).css({bottom:"-30px"});
			}
		});
	} 
);

					
/*! http://tinynav.viljamis.com v1.03 by @viljamis 
    mod 0.1.1 by espresso_theme creations */
(function ($, window, i) {
  $.fn.tinyNav = function (options) {

    // Default settings
    var settings = $.extend({
      'active' : 'selected', // String: Set the "active" class
      'header' : '' // Show header instead of the active item
    }, options);

    return this.each(function () {

      i++; // Used for namespacing

      var $nav = $(this),
        // Namespacing
        namespace = 'tinynav',
        namespace_i = namespace + i,
        l_namespace_i = '.l_' + namespace_i,
        $select = $('<select/>').addClass(namespace + ' ' + namespace_i);

      if ($nav.is('ul,ol')) {

        if (settings.header !== '') {
          $select.append( $('<option/>').text(settings.header) );
        }

        // Build options
        var options = '';
		var indent = 0;
		var indented = ["&nbsp;"];
		for ( var i = 0; i < 10; i++) { indented.push(indented[indented.length-1]+'-&nbsp;'); }
		indented[0] = "";
        $nav
          .addClass('l_' + namespace_i)
          .children('li')
          .each(buildNavTree=function () {
            var a = $(this).children('a').first();

            options += '<option value="' + a.attr('href') + '">' + indented[indent] + a.text() + '</option>';
              indent++;
              $(this).children('ul,ol').children('li').each(buildNavTree);
              indent--;
          });

        // Append options into a select
        $select.append(options);

        // Select the active item
        if (!settings.header) {
          $select
            .find(':eq(' + $(l_namespace_i + ' li')
            .index($(l_namespace_i + ' li.' + settings.active)) + ')')
            .attr('selected', true);
        }

        // Change window location
        $select.change(function () {
		var loc = $(this).val(); loc = loc.replace(/[\s\t]/gi,'');
		var menu = settings.header; menu = menu.replace(/[\s\t]/gi,'');
          if ((loc!==menu)) { window.location.href = $(this).val(); } else return false;
        });

        // Inject select
        $(l_namespace_i).after($select);

      }

	var current_url = location.protocol + '//' + location.host + location.pathname;
	$('option[value="'+current_url+'"]').attr("selected","selected");

    });

  };
})(jQuery, this, 0);
// end tinynav


// detect and apply custom class for safari
if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	jQuery('body').addClass('safari');
}


}); 
// end document.ready

/* Mobile Menu v2 */
function iced_mocha_mobilemenu_init() {
  var state = false;
  jQuery("#nav-toggle").click(function(){
    jQuery("#access").slideToggle(function(){ if (state) {jQuery(this).removeAttr( 'style' )}; state = ! state; } );
  });
}

// Columns equalizer, used if at least one sidebar has a bg color
function equalizeHeights(){
    var h1 = jQuery("#primary").height();
	var h2 = jQuery("#secondary").height();
	var h3 = jQuery("#content").height();
    var max = Math.max(h1,h2,h3);
	if (h1<max) { jQuery("#primary").height(max); };
	if (h2<max) { jQuery("#secondary").height(max); };

}

/* Force footer at bottom of window 
 Should not work on the Presentation Page 
 Disabled for now
 */
/*jQuery(document).ready(function() {
var docHeight = jQuery(window).height();
var footerHeight = jQuery('#footer2').height();
var footerTop = jQuery('#footer2').position().top + footerHeight;
var forbottom = jQuery('#forbottom').height();
if (footerTop < docHeight) {
    jQuery('#forbottom').css('minHeight',(forbottom + docHeight  - footerTop -35) + 'px');
}
});
*/
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {

      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = '&shy;<style> .fluid-width-video-wrapper { width: 100%; position: relative; padding: 0; } .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } </style>';

      ref.parentNode.insertBefore(div,ref);

    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
		if ( width<espresso_theme_global_content_width ) { return; } // hack to not resize small objects 
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})( jQuery );


// Returns the version of Internet Explorer or a -1
// (indicating the use of another browser).
function getInternetExplorerVersion()
{
  var rv = -1; /* assume not IE. */
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}
