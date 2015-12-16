/*!
 * Admin js
 */

jQuery(document).ready(function() {

var uploadparent = 0;
 function media_upload( button_class) {
    if (!window.wp || !window.wp.media || !window.wp.media.editor || !window.wp.media.editor.send || !window.wp.media.editor.send.attachment) return; 
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
    jQuery('body').on('click',button_class, function(e) {
	uploadparent = jQuery(this).closest('div');
        var button_id ='#'+jQuery(this).attr('id');
        /* console.log(button_id); */
        var self = jQuery(button_id);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(button_id);
       // var id = button.attr('id').replace('_button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media  ) {
              // jQuery('.custom_media_id').val(attachment.id); 		  
               uploadparent.find('.slideimages').val(attachment.url);
			   uploadparent.find('.imagebox').attr('src',attachment.url);
              // jQuery('.custom_media_image').attr('src',attachment.url).css('display','block');   
            } else {
                return _orig_send_attachment.apply( button_id, [props, attachment] );
            }
        }
        wp.media.editor.open(button);
        return false;
    });
}
media_upload( '.upload_image_button');		

// Show/hide postboxes by adding a 'closed' class	
saved_arr = jQuery('#iced_mocha-postboxes').val().split(",");
saved_arr.forEach(function(entry) {
	jQuery('#'+entry).addClass('closed');
});
var values_arr = saved_arr;
jQuery('.postbox .handlediv').click(function() {
	postbox = jQuery(this).parent();
	if (postbox.hasClass('closed')) {
		postbox.removeClass('closed');	
		var i = values_arr.indexOf(postbox.attr('id'));
		if(i != -1) { 
			values_arr.splice(i, 1);
			}	
		}
	else {
		postbox.addClass('closed');
		if (jQuery.inArray(postbox.attr('id'),values_arr) == -1) {
			values_arr.push(postbox.attr('id')); 
			}
		}
	jQuery('#iced_mocha-postboxes').val(values_arr.join()); 
});
			
			
// Show/hide slides
		jQuery('.slidetitle').click(function() {
				jQuery(this).next().toggle("fast");
				});


// Jquery confim window on reset to defaults
jQuery('#iced_mocha_defaults').click (function() {
		if (!confirm(reset_confirmation)) { return false;}
	});

// Jquery confim window on loading a color scheme
jQuery('#load-color-scheme').click (function() {
		if (!confirm(scheme_confirmation)) { return false;}
	});


// Hide or show slider settings
jQuery('#iced_mocha_slideType').change(function() {
	jQuery('.slideDivs').hide();
	switch (jQuery('#iced_mocha_slideType option:selected').val()) {

		case "Custom Slides" :
 		jQuery('#sliderCustomSlides').show("normal");
		break;

		case "Latest Events" :
 		jQuery('#sliderLatestEvents').show("normal");
		break;

		case "Random Events" :
 		jQuery('#sliderRandomEvents').show("normal");
		break;

		case "Latest Posts" :
 		jQuery('#sliderLatestPosts').show("normal");
		break;

		case "Random Posts" :
 		jQuery('#sliderRandomPosts').show("normal");
		break;

		case "Sticky Posts" :
 		jQuery('#sliderStickyPosts').show("normal");
		break;

		case "Latest Posts from Category" :
 		jQuery('#sliderLatestCateg').show("normal");
		break;

		case "Random Posts from Category" :
 		jQuery('#sliderRandomCateg').show("normal");
		break;

		case "Specific Posts" :
 		jQuery('#sliderSpecificPosts').show("normal");
		break;

	}//switch
	
	sliderNr=jQuery('#iced_mocha_slideType').val();
	//Show category if a category type is selected
	if (sliderNr=="Latest Posts from Category" || sliderNr=="Random Posts from Category" )
			jQuery('#slider-category').show();
	else 	jQuery('#slider-category').hide();
	//Show number of slides if that's the case
	if (sliderNr=="Latest Posts" || sliderNr =="Random Posts" || sliderNr =="Sticky Posts" || sliderNr=="Latest Posts from Category" || sliderNr=="Random Posts from Category" )
			jQuery('#slider-post-number').show();
	else 	jQuery('#slider-post-number').hide();
	//Show number of events if that's the case
	if (sliderNr=="Latest Events" || sliderNr =="Random Events" )
			jQuery('#slider-event-number').show();
	else 	jQuery('#slider-event-number').hide();

});//function

jQuery('.slideDivs').hide();
jQuery('#iced_mocha_slideType').trigger('change');



// Hide or show column settings
jQuery('#iced_mocha_columnType').change(function() {
	jQuery('.columnDivs').hide();
	switch (jQuery('#iced_mocha_columnType option:selected').val()) {

		case "Widget Columns" :
 		jQuery('#columnWidgets').show("normal");
		break;

		case "Latest Posts" :
 		jQuery('#columnLatestPosts').show("normal");
		break;

		case "Random Posts" :
 		jQuery('#columnRandomPosts').show("normal");
		break;

		case "Latest Posts" :
 		jQuery('#columnLatestPosts').show("normal");
		break;

		case "Random Posts" :
 		jQuery('#columnRandomPosts').show("normal");
		break;

		case "Sticky Posts" :
 		jQuery('#columnStickyPosts').show("normal");
		break;

		case "Latest Posts from Category" :
 		jQuery('#columnLatestCateg').show("normal");
		break;

		case "Random Posts from Category" :
 		jQuery('#columnRandomCateg').show("normal");
		break;

		case "Specific Posts" :
 		jQuery('#columnSpecificPosts').show("normal");
		break;

	}//switch
	
	columnNr=jQuery('#iced_mocha_columnType').val();
	//Show category if a category type is selected
	if (columnNr=="Latest Posts from Category" || columnNr=="Random Posts from Category" )
			jQuery('#column-category').show();
	else 	jQuery('#column-category').hide();
	//Show number of columns if that's the case
	if (columnNr=="Latest Posts" || columnNr =="Random Posts" || columnNr =="Sticky Posts" || columnNr=="Latest Posts from Category" || columnNr=="Random Posts from Category" )
			jQuery('#column-post-number').show();
	else 	jQuery('#column-post-number').hide();

	//Show number of events if that's the case
	if (columnNr=="Latest Events" || columnNr =="Random Events" )
			jQuery('#column-event-number').show();
	else 	jQuery('#column-event-number').hide();

});//function

jQuery('.columnDivs').hide();
jQuery('#iced_mocha_columnType').trigger('change');

//var iced_mocha_customcss = CodeMirror.fromTextArea(document.getElementById("iced_mocha_customcss"), { lineNumbers: true });
//var iced_mocha_customjs = CodeMirror.fromTextArea(document.getElementById("iced_mocha_customjs"), { lineNumbers: true });

/* Backwards compatibility for the accordion's current slide saving */
var espresso_theme_active_slide = parseInt(jQuery('#iced_mocha_current').val());
if (vercomp(jQuery.ui.version, '1.11.2')) {
	 espresso_theme_active_slide = parseInt((espresso_theme_active_slide-1)/2);
}


// Create accordion from existing settings table
	jQuery('.form-table').wrap('<div>');
	jQuery(function() {
			jQuery( "#accordion" ).accordion({
				header: 'h3',
				autoHeight: false, // for jQueryUI <1.10
				heightStyle: "content", // required in jQueryUI 1.10
				collapsible: true,
				navigation: true,
				active: parseInt(espresso_theme_active_slide)
				});
	});

	jQuery("#iced_mocha_nrcolumns").bind('change', function() {
		column_image_width_hint(jQuery("#totalsize").html(),jQuery("#iced_mocha_nrcolumns").val());
	});										
	jQuery("#iced_mocha_nrcolumns").trigger('change');
	
	googleFontChange('.googlefonts');
	colorThingy();
	
	jQuery('#accordion h3').on('click',function() {
		var clicked = parseInt(jQuery(this).attr('id').replace( /^\D+/g, ''));
		var current = parseInt(jQuery('#iced_mocha_current').val().replace( /^\D+/g, ''));
		if (clicked == current) jQuery('#iced_mocha_current').val('');
		else jQuery('#iced_mocha_current').val(clicked);
	});

	jQuery("#main-options #accordion h2").each(function(){
		jQuery(this).replaceWith("<h3>" + jQuery(this).html() + "</h3>");
	});
		
});// ready

/* Farbtastic colour selector handler */
function startfarb(a,b) {
	jQuery(b).css('display','none');
	jQuery(b).farbtastic(a).addtitle({id: a});

	jQuery(a).click(function() {
			if(jQuery(b).css('display') == 'none')	{
                                        			jQuery(b).parents('div:eq(0)').addClass('ui-accordion-content-overflow');
                                                    jQuery(b).css({'display':'inline-block','position':'absolute',marginLeft:'100px',opacity:0}).animate({opacity:1,marginLeft:'0px'},150);
                                                       }
	});

	jQuery(document).mousedown( function() {
		if(jQuery(b).css('display') != 'none') setTimeout(function () { jQuery(b).css('display','none');},150);
		jQuery(b).animate({opacity:0,marginLeft:'100px'},150, function(){ jQuery(b).parents('div:eq(0)').removeClass('ui-accordion-content-overflow'); });
		/* todo: find a better way to remove class after the fade on IEs */
	});
}

/* Help icon loader */
function tooltip_terain() {
jQuery('#accordion small').parent('div').append('<a class="tooltip"><img src="'+iced_mocha_help_icon+'" /></a>').
	each(function() {
	/*jQuery(this).children('a.tooltip').attr('title',jQuery(this).children('small').html() );*/
	var tooltip_info = jQuery(this).children('small').html();
	jQuery(this).children('.tooltip').tooltip({content : tooltip_info});
     jQuery(this).children('.tooltip').tooltip( "option", "items", "a" );
	/*jQuery(this).children('.tooltip').tooltip( "option", "show", "false");*/
	jQuery(this).children('.tooltip').tooltip( "option", "hide", "false");
	jQuery(this).children('small').remove();
	if (!jQuery(this).hasClass('slmini') && !jQuery(this).hasClass('slidercontent') && !jQuery(this).hasClass('slideDivs')) jQuery(this).addClass('tooltip_div');
	});
}

/* colour selector for old WP */
function coloursel(el){
	var id = "#"+jQuery(el).attr('id');
	jQuery(id+"2").hide();
	var bgcolor = jQuery(id).val();
	if (bgcolor <= "#666666") { jQuery(id).css('color','#ffffff'); } else { jQuery(id).css('color','#000000'); };
	jQuery(id).css('background-color',jQuery(id).val());
}

/* jQuery version comparison helper */
function vercomp(ver, req) {
    var v = ver.split('.');
    var q = req.split('.');
    for (var i = 0; i < v.length; ++i) {
        if (q.length == i) { return true; } /* v is bigger */
        if (parseInt(v[i]) == parseInt(q[i])) { continue; } /* nothing to do here, move along */
        else if (parseInt(v[i]) > parseInt(q[i])) { return true; } /* v is bigger */
        else { return false; } /* q is bigger */
    }
    if (v.length != q.length) { return false; } /* q is bigger */
    return true; /* v = q */
}

/* farbtastic title addon function */
(function($){
        $.fn.extend({
            addtitle: function(options) {
                var defaults = {
                    id: ''
                }
                var options = $.extend(defaults, options);
            return this.each(function() {
                    var o = options;
					var title = jQuery(o.id).attr('title');
                    if (title===undefined) { } else { jQuery(o.id+'2').children('.farbtastic').append('<span class="mytitle">'+title+'</span>'); }
            });
        }
        });
})(jQuery);
  
// Columns image width hint
function column_image_width_hint(total, colcount) {
total=total-90;
if (colcount==0) var size = 0;
else 
	var size = parseInt((total-(total*5*(colcount-1)/100))/colcount );

jQuery('#iced_mocha_colimagewidth_show').html(size);
jQuery('#iced_mocha_colimagewidth').val(size);

}

  // Change border for selecte inputs
function changeBorder (idName, className) {
	jQuery('.'+className).removeClass( 'checkedClass' );
	jQuery('.'+className).removeClass( 'borderful' );
	jQuery('#'+idName).addClass( 'borderful' );

return 0;
}

// Chnage opacity for font selector if google font exisits

function colorThingy() {
jQuery('.colorthingy').click(function() {
if (!jQuery(this).val()) jQuery(this).val(' ');
});

}

function googleFontChange(googleFont) {
jQuery(googleFont).each(function(){
if(jQuery(this).val()) {jQuery(this).prev().css('opacity','0.5');}
});

jQuery(googleFont).blur(function() {
	if(jQuery(this).val()) jQuery(this).prev().animate({'opacity':'0.5'},300);
	else jQuery(this).prev().animate({'opacity':'1'},300);
	});
}
