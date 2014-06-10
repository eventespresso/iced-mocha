<?php
// Callback functions

// General suboptions description idly idling doing nothing
function espresso_theme_section_layout_fn() { };
function espresso_theme_section_presentation_fn() { };
function espresso_theme_section_header_fn() { };
function espresso_theme_section_text_fn() { };
function espresso_theme_section_graphics_fn() { };
function espresso_theme_section_post_fn() { };
function espresso_theme_section_excerpt_fn() { };
function espresso_theme_section_appereance_fn() { };
function espresso_theme_section_featured_fn() { };
function espresso_theme_section_social_fn() { };
function espresso_theme_section_misc_fn() { };
// nothing at all


////////////////////////////////
//// LAYOUT SETTINGS ///////////
////////////////////////////////


// RADIO-BUTTON - Name: iced_mocha_settings[side]
function espresso_theme_setting_side_fn() {
global $iced_mochas;
	$items = array("1c", "2cSr", "2cSl", "3cSr" , "3cSl", "3cSs");
	$layout_text["1c"] = __("One column (no sidebars)","iced_mocha");
	$layout_text["2cSr"] = __("Two columns, sidebar on the right","iced_mocha");
	$layout_text["2cSl"] = __("Two columns, sidebar on the left","iced_mocha");
	$layout_text["3cSr"] = __("Three columns, sidebars on the right","iced_mocha");
	$layout_text["3cSl"] = __("Three columns, sidebars on the left","iced_mocha");
	$layout_text["3cSs"] = __("Three columns, one sidebar on each side","iced_mocha");

	foreach($items as $item) {
		$checkedClass = ($iced_mochas['iced_mocha_side']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='layouts $checkedClass'><input ";
		checked($iced_mochas['iced_mocha_side'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','layouts');\" name='iced_mocha_settings[iced_mocha_side]' type='radio' /><img title='$layout_text[$item]' src='".get_template_directory_uri()."/admin/images/".$item.".png'/></label>";
	}
	echo "<div><small>".__("Choose your layout. Possible options are: <br> No sidebar, a single sidebar on either left of right, two sidebars on either left or right and two sidebars on each side.<br>This can be overriden in pages by using Page Templates.","iced_mocha")."</small></div>";
}

 //SLIDER - Name: iced_mocha_settings[sidewidth]
function espresso_theme_setting_sidewidth_fn() {
     global $iced_mochas; ?>
     <script type="text/javascript">

	jQuery(function() {

		jQuery( "#slider-range" ).slider({
			range: true,
			step:10,
			min: 0,
			max: 1920,
			values: [ <?php echo $iced_mochas['iced_mocha_sidewidth'] ?>, <?php echo ($iced_mochas['iced_mocha_sidewidth']+$iced_mochas['iced_mocha_sidebar']); ?> ],
			slide: function( event, ui ) {
          			range=ui.values[ 1 ] - ui.values[ 0 ];

           			if (ui.values[ 0 ]<500) {ui.values[ 0 ]=500; return false;};
          			if (	range<220 || range>800 ) { ui.values[ 1 ] = <?php echo $iced_mochas['iced_mocha_sidebar']+$iced_mochas['iced_mocha_sidewidth'];?>; return false; };

          			jQuery( "#iced_mocha_sidewidth" ).val( ui.values[ 0 ] );
          			jQuery( "#iced_mocha_sidebar" ).val( ui.values[ 1 ] - ui.values[ 0 ] );
          			jQuery( "#totalsize" ).html( ui.values[ 1 ]);
          			jQuery( "#contentsize" ).html( ui.values[ 0 ]);jQuery( "#barsize" ).html( ui.values[ 1 ]-ui.values[ 0 ]);

          			var percentage = parseInt( jQuery( "#slider-range .ui-slider-range" ).css('width') );
          			var leftwidth = parseInt( jQuery( "#slider-range .ui-slider-range" ).position().left );
          			jQuery( "#barb" ).css('left',-80+leftwidth+percentage/2+"px");
          			jQuery( "#contentb" ).css('left',-50+leftwidth/2+"px");
          			jQuery( "#totalb" ).css('width',(percentage+leftwidth)+"px");
               }
		});

		jQuery( "#iced_mocha_sidewidth" ).val( <?php echo $iced_mochas['iced_mocha_sidewidth'];?> );
		jQuery( "#iced_mocha_sidebar" ).val( <?php echo $iced_mochas['iced_mocha_sidebar'];?> );
		var percentage = <?php echo ($iced_mochas['iced_mocha_sidebar']/1920)*100;?> ;
		var leftwidth = <?php echo ($iced_mochas['iced_mocha_sidewidth']/1920)*100;?> ;

		jQuery( "#barb" ).css('left',(-18+leftwidth+percentage/2)+"%");
		jQuery( "#contentb" ).css('left',(-8+leftwidth/2)+"%");
		jQuery( "#totalb" ).css('width',(-2+percentage+leftwidth)+"%");
	});

     </script>

     <div id="absolutedim">

     	<b id="contentb"><?php _e("Content =","iced_mocha");?> <span id="contentsize"><?php echo $iced_mochas['iced_mocha_sidewidth'];?></span>px</b>
     	<b id="barb"><?php _e("Sidebar(s) =","iced_mocha");?> <span id="barsize"><?php echo $iced_mochas['iced_mocha_sidebar'];?></span>px</b>
     	<b id="totalb"> <?php _e("Total width =","iced_mocha");?> <span id="totalsize"><?php echo $iced_mochas['iced_mocha_sidewidth']+ $iced_mochas['iced_mocha_sidebar'];?></span>px</b>

     <p> <?php
     echo "<input type='hidden' name='iced_mocha_settings[iced_mocha_sidewidth]' id='iced_mocha_sidewidth' />";
	echo "<input type='hidden' name='iced_mocha_settings[iced_mocha_sidebar]' id='iced_mocha_sidebar' />"; ?>
     </p>
     <div id="slider-range"></div>
     <?php echo "<div><small>".__("Select the width of your <b>content</b> and <b>sidebar(s)</b>. When using a 3 columns layout (with 2 sidebars) they will each have half the configured width.","iced_mocha")."</small></div>"; ?>
     </div><!-- End absolutedim -->

<?php } // espresso_theme_setting_sidewidth_fn()

//CHECKBOX - Name: ma_options[mobile]
function espresso_theme_setting_mobile_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<span class='espresso_theme_select'><select id='iced_mocha_mobile' name='iced_mocha_settings[iced_mocha_mobile]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_mobile'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select></span>";
	$checkedClass = ($iced_mochas['iced_mocha_hcontain']=='1') ? ' checkedClass' : '';
	echo "<div><small>".__("Enable to make Iced Mocha Theme fully responsive. The layout and general sizes of your blog will adjust depending on what device and what resolution it is viewed in.<br> Do not disable unless you have a good reason to.","iced_mocha")."</small></div>";
} // espresso_theme_setting_mobile_fn()


//////////////////////////////
/////HEADER SETTINGS//////////
/////////////////////////////

 //SELECT - Name: iced_mocha_settings[hheight]
function espresso_theme_setting_hheight_fn() {
	global $iced_mochas; $totally = $iced_mochas['iced_mocha_sidebar']+$iced_mochas['iced_mocha_sidewidth'];
	espresso_theme_proto_field( $iced_mochas, "input4", "iced_mocha_hheight", $iced_mochas['iced_mocha_hheight'], " px");
	echo "<div><small>".__("Select the header's height. After saving the settings go and upload your new header image. The header's width will be ","iced_mocha")."<strong>".$totally."px</strong>.</small></div>";
}

function espresso_theme_setting_himage_fn() {
	global $iced_mochas;
	//$checkedClass = ($iced_mochas['iced_mocha_hcenter']=='1') ? ' checkedClass' : '';
	echo "<a href=\"?page=custom-header\" class=\"button\" target=\"_blank\">".__('Define header image','iced_mocha')."</a><br>";
	espresso_theme_proto_field( $iced_mochas, "checkbox", "iced_mocha_hcenter", $iced_mochas['iced_mocha_hcenter'], __('Center the header image horizontally','iced_mocha'));
	espresso_theme_proto_field( $iced_mochas, "checkbox", "iced_mocha_hratio", $iced_mochas['iced_mocha_hratio'], __('Keep header image aspect ratio.', 'iced_mocha'));
	echo "<div><small>".__("By default the header has a minimum height set. This option removes that and the header becomes fully responsive, scalling to any size.<br> Only enable this if you're <b>not</b> using a logo or site title and description in the header. ","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[linkheader]
function espresso_theme_setting_siteheader_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_siteheader",
			array("Site Title and Description" , "Custom Logo" , "Clickable header image" , "Empty"),
			array( __("Site Title and Description","iced_mocha"), __("Custom Logo","iced_mocha"), __("Clickable header image","iced_mocha"), __("Empty","iced_mocha"))
	);
	echo "<div><small>".__("Choose what to display inside your header area.","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[favicon]
function espresso_theme_setting_logoupload_fn() {
	global $iced_mochas; ?>
	<div><img  src='<?php echo  ($iced_mochas['iced_mocha_logoupload']!='')? esc_url($iced_mochas['iced_mocha_logoupload']):get_template_directory_uri().'/admin/images/placeholder.gif'; ?>' class="imagebox" style="max-height:60px" /><br> <?php
	espresso_theme_proto_field( $iced_mochas, "input40url", "iced_mocha_logoupload", $iced_mochas['iced_mocha_logoupload'], '','slideimages');
	echo "<div><small>".__("Custom Logo upload. The logo will appear over the header image if you have used one.","iced_mocha")."</small></div>"; ?>
	<span class="description"><br><a href="#" class="upload_image_button button"><?php _e( 'Select / Upload Image', 'iced_mocha' );?></a> </span> <?php
}

function  espresso_theme_setting_headermargin_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "input4str", "iced_mocha_headermargintop", $iced_mochas['iced_mocha_headermargintop'], ' px '.__("top","iced_mocha")."&nbsp; &nbsp;" );
	espresso_theme_proto_field( $iced_mochas, "input4str", "iced_mocha_headermarginleft", $iced_mochas['iced_mocha_headermarginleft'], ' px '.__("left","iced_mocha") );
	echo "<div><small>".__("Select the top and left spacing for the header content. Use it to better position your site title and description or custom logo inside the header. ","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[favicon]
function espresso_theme_setting_favicon_fn() {
	global $iced_mochas;?>
	<div><img src='<?php echo  ($iced_mochas['iced_mocha_favicon']!='')? esc_url($iced_mochas['iced_mocha_favicon']):get_template_directory_uri().'/admin/images/placeholder.gif'; ?>' class="imagebox" width="64" height="64"/><br> <?php
	espresso_theme_proto_field( $iced_mochas, "input40url", "iced_mocha_favicon", $iced_mochas['iced_mocha_favicon'], '','slideimages');
	//espresso_theme_proto_field( $iced_mochas, "", "", $iced_mochas[''], '');
	echo "<div><small>".__("Limitations: It has to be an image. It should be max 64x64 pixels in dimensions. Recommended file extensions .ico and .png. <br> <strong>Note that some browsers do not display the changed favicon instantly.</strong>","iced_mocha")."</small></div>"; ?>
	<span class="description"><br><a href="#" class="upload_image_button button"><?php _e( 'Select / Upload Image', 'iced_mocha' );?></a> </span>
</div>

<?php
}

////////////////////////////////
//// PRESENTATION SETTINGS /////////////
////////////////////////////////


//CHECKBOX - Name: iced_mocha_settings[frontpage]
function espresso_theme_setting_frontpage_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_frontpage",
		array("Enable" , "Disable"),
		array( __("Enable","iced_mocha"), __("Disable","iced_mocha"))
	);
	echo "<div><small>".__("Enable the presentation front-page. This will become your new home page. <br> If you want another page to hold your latest blog posts, choose 'Blog Template (Posts Page)' from Page Templates while creating or editing that page.","iced_mocha")."</small></div>";
} // espresso_theme_setting_frontpage_fn()

function espresso_theme_setting_frontposts_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_frontposts",
		array("Enable" , "Disable"),
		array( __("Enable","iced_mocha"), __("Disable","iced_mocha"))
	);
	echo "<input type='text' id='iced_mocha_frontpostscount' name='iced_mocha_settings[iced_mocha_frontpostscount]' size='3' value='";
 	echo $iced_mochas['iced_mocha_frontpostscount']."'> ".__('posts','iced_mocha');
 	echo "<div><small>".__("Enable to display latest posts on the presentation page, below the columns. Sticky posts are always displayed and not counted.","iced_mocha")."</small></div>";
} // espresso_theme_setting_frontpage_fn()

function espresso_theme_setting_frontevents_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_frontevents",
		array("Enable" , "Disable"),
		array( __("Enable","iced_mocha"), __("Disable","iced_mocha"))
	);
	echo "<input type='text' id='iced_mocha_fronteventscount' name='iced_mocha_settings[iced_mocha_fronteventscount]' size='3' value='";
 	echo $iced_mochas['iced_mocha_frontpostscount']."'> ".__('posts','iced_mocha');
 	echo "<div><small>".__("Enable to display latest events on the presentation page, below the columns.","iced_mocha")."</small></div>";
} // espresso_theme_setting_frontpage_fn()


//CHECKBOX - Name: iced_mocha_settings[frontslider]
function espresso_theme_setting_frontslider_fn() {
	global $iced_mochas;

	echo "<div class='slmini'><b>".__("Slider Dimensions:","iced_mocha")."</b> ";
	echo "<input id='iced_mocha_fpsliderwidth' name='iced_mocha_settings[iced_mocha_fpsliderwidth]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fpsliderwidth'] )."' /> px (".__("width","iced_mocha").") <strong>X</strong> ";
	echo "<input id='iced_mocha_fpsliderheight' name='iced_mocha_settings[iced_mocha_fpsliderheight]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fpsliderheight'] )."' /> px (".__("height","iced_mocha").")";
	echo "<small>".__("The dimensions of your slider. Make sure your images are of the same size.","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Animation:","iced_mocha")."</b> ";
	$items = array ("random" , "fold", "fade", "slideInRight", "slideInLeft", "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown" , "sliceUpDownLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow" , "boxRainGrowReverse");
	$itemsare = array( __("Random","iced_mocha"), __("Fold","iced_mocha"), __("Fade","iced_mocha"), __("SlideInRight","iced_mocha"), __("SlideInLeft","iced_mocha"), __("SliceDown","iced_mocha"), __("SliceDownLeft","iced_mocha"), __("SliceUp","iced_mocha"), __("SliceUpLeft","iced_mocha"), __("SliceUpDown","iced_mocha"), __("SliceUpDownLeft","iced_mocha"), __("BoxRandom","iced_mocha"), __("BoxRain","iced_mocha"), __("BoxRainReverse","iced_mocha"), __("BoxRainGrow","iced_mocha"), __("BoxRainGrowReverse","iced_mocha"));
	echo "<select id='iced_mocha_fpslideranim' name='iced_mocha_settings[iced_mocha_fpslideranim]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_fpslideranim'],$item);
		echo ">$itemsare[$id]</option>";
	}

	echo "</select>";
	echo "<small>".__("The transition effect of your slides.","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Animation Time:","iced_mocha")."</b> ";
	echo "<input id='iced_mocha_fpslidertime' name='iced_mocha_settings[iced_mocha_fpslidertime]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fpslidertime'] )."' /> ".__("milliseconds","iced_mocha");
	echo "<small>".__("The time in which the transition animation will take place.","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Pause Time:","iced_mocha")."</b> ";
	echo "<input id='iced_mocha_fpsliderpause' name='iced_mocha_settings[iced_mocha_fpsliderpause]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fpsliderpause'] )."' /> ".__("milliseconds","iced_mocha");
	echo "<small>".__("The time in which a slide will be still and visible.","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider navigation:","iced_mocha")."</b> ";
	$items = array ("Numbers" , "Bullets" ,"None");
	$itemsare = array( __("Numbers","iced_mocha"), __("Bullets","iced_mocha"), __("None","iced_mocha"));
	echo "<select id='iced_mocha_fpslidernav' name='iced_mocha_settings[iced_mocha_fpslidernav]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_fpslidernav'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select>";
	echo "<small>".__("Your slider navigation type. Shown under the slider.","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider arrows:","iced_mocha")."</b> ";
	$items = array ("Always Visible" , "Visible on Hover" ,"Hidden");
	$itemsare = array( __("Always Visible","iced_mocha"), __("Visible on Hover","iced_mocha"), __("Hidden","iced_mocha"));
	echo "<select id='iced_mocha_fpsliderarrows' name='iced_mocha_settings[iced_mocha_fpsliderarrows]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_fpsliderarrows'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select>";
	echo "<small>".__("The Left and Right arrows on your slider","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider Border Width:","iced_mocha")."</b> ";
	echo "<input id='iced_mocha_fpslider_bordersize' name='iced_mocha_settings[iced_mocha_fpslider_bordersize]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fpslider_bordersize'] )."' /> ".__("px","iced_mocha");
	echo "<small>".__("The slider's border width. You can also edit its color from the Color Settings. Use a border width when your slider is smaller than the total site width.","iced_mocha")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider Top Margin:","iced_mocha")."</b> ";
	echo "<input id='iced_mocha_fpslider_topmargin' name='iced_mocha_settings[iced_mocha_fpslider_topmargin]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fpslider_topmargin'] )."' /> ".__("px","iced_mocha");
	echo "<small>".__("Add a top margin for the slider. By default this margin is 0 and you will want to increase this value when the width of the slider is smaller than the total width of the site.","iced_mocha")."</small></div>";

?>

<?php /*
// reserved for future use
<script type="text/javascript">
var $categoryName;

jQuery(document).ready(function(){
	jQuery('#categ-dropdown').change(function(){
			$categoryName=this.options[this.selectedIndex].value.replace(/\/category\/archives\//i,"");
			doAjaxRequest();
	});

});
function doAjaxRequest(){
// here is where the request will happen
	jQuery.ajax({
          url: ajaxurl,
          data:{
               'action':'do_ajax',
               'fn':'get_latest_posts',
               'count':10,
				'categName':$categoryName
               },
          dataType: 'JSON',
          success:function(data){
		 jQuery('#post-dropdown').html(data);


                             },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }

     });

}
</script>
<!--
<select name="categ-dropdown" id="categ-dropdown" multiple='multiple' >
 <option value=""><?php echo esc_attr(__('Select Category','iced_mocha')); ?></option>
 <?php
  $categories=  get_categories();
  foreach ($categories as $category) {
  	$option = '<option value="/category/archives/'.$category->category_nicename.'">';
	$option .= $category->cat_name;
	$option .= ' ('.$category->category_count.')';
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>
<select name="post-dropdown" id="post-dropdown">
</select>
--> */ ?>

<?php
} // espresso_theme_setting_frontslider_fn()

//CHECKBOX - Name: iced_mocha_settings[frontslider2]
function espresso_theme_setting_frontslider2_fn() {
	global $iced_mochas;

     $items = array("Custom Slides", "Latest Posts", "Random Posts", "Sticky Posts", "Latest Posts from Category" , "Random Posts from Category", "Specific Posts", "Disabled");
	$itemsare = array( __("Custom Slides","iced_mocha"), __("Latest Posts","iced_mocha"), __("Random Posts","iced_mocha"),__("Sticky Posts","iced_mocha"), __("Latest Posts from Category","iced_mocha"), __("Random Posts from Category","iced_mocha"), __("Specific Posts","iced_mocha"), __("Disabled","iced_mocha"));
	echo "<strong> Slides content: </strong> ";
	echo "<select id='iced_mocha_slideType' name='iced_mocha_settings[iced_mocha_slideType]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_slideType'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Only the slides with a defined image will become active and visible in the live slider.<br>When using slides from posts, make sure the selected posts have featured images.<br>Read the FAQs for more info.","iced_mocha")."</small></div>";
     ?>

     <div class="underSelector">
          <div id="sliderLatestPosts" class="slideDivs">
               <span><?php _e('Latest posts will be loaded into the slider.','iced_mocha'); ?> </span>
          </div>

          <div id="sliderRandomPosts" class="slideDivs">
               <span><?php _e('Random posts will be loaded into the slider.','iced_mocha'); ?> </span>
          </div>

          <div id="sliderLatestCateg" class="slideDivs">
               <span><?php _e('Latest posts from the category you choose will be loaded in the slider.','iced_mocha'); ?> </span>
          </div>

          <div id="sliderRandomCateg" class="slideDivs">
               <span><?php _e('Random posts from the category you choose will be loaded into the slider.','iced_mocha'); ?> </span>
          </div>

          <div id="sliderStickyPosts" class="slideDivs">
               <span><?php _e('Only sticky posts will be loaded into the slider.','iced_mocha'); ?> </span>
          </div>

          <div id="sliderSpecificPosts" class="slideDivs">
               <span><?php _e('List the post IDs you want to display (separated by a comma): ','iced_mocha'); ?> </span>
               <input id='iced_mocha_slideSpecific' name='iced_mocha_settings[iced_mocha_slideSpecific]' size='44' type='text' value='<?php echo esc_attr( $iced_mochas['iced_mocha_slideSpecific'] ) ?>' />
          </div>

          <div id="slider-category">
               <span><?php _e('<br> Choose the category: ','iced_mocha'); ?> </span>
               <select id="iced_mocha_slideCateg" name='iced_mocha_settings[iced_mocha_slideCateg]'>
               <option value=""><?php echo esc_attr(__('Select Category','iced_mocha')); ?></option>
               <?php echo $iced_mochas["iced_mocha_slideCateg"];
               $categories = get_categories();
               foreach ($categories as $category) {
                 	$option = '<option value="'.$category->category_nicename.'" ';
               	$option .= selected($iced_mochas["iced_mocha_slideCateg"], $category->category_nicename, false).' >';
               	$option .= $category->cat_name;
               	$option .= ' ('.$category->category_count.')';
               	$option .= '</option>';
               	echo $option;
               } ?>
               </select>
          </div>

          <span id="slider-post-number"><?php _e('Number of posts to show:','iced_mocha'); ?>
               <input id='iced_mocha_slideNumber' name='iced_mocha_settings[iced_mocha_slideNumber]' size='3' type='text' value='<?php echo esc_attr( $iced_mochas['iced_mocha_slideNumber'] ) ?>' />
          </span>

          <div id="sliderCustomSlides" class="slideDivs">

          <?php
          for ($i=1;$i<=5;$i++):
          // let's generate the slides
          ?>
               <div class="slidebox">
               <h4 class="slidetitle" ><?php _e("Slide","iced_mocha");?> <?php echo $i; ?></h4>
               <div class="slidercontent">
                    <h5><?php _e("Image","iced_mocha");?></h5>
                    <input type="text" value="<?php echo esc_url($iced_mochas['iced_mocha_sliderimg'.$i]); ?>" name="iced_mocha_settings[iced_mocha_sliderimg<?php echo $i; ?>]"
                         id="iced_mocha_sliderimg<?php echo $i; ?>" class="slideimages" />
                    <span class="description"><a href="#" class="upload_image_button button"><?php _e( 'Select / Upload Image', 'iced_mocha' );?></a> </span>
                    <h5> <?php _e("Title","iced_mocha");?> </h5>
                    <input id='iced_mocha_slidertitle<?php echo $i; ?>' name='iced_mocha_settings[iced_mocha_slidertitle<?php echo $i; ?>]' size='50' type='text'
                         value='<?php echo esc_attr( $iced_mochas['iced_mocha_slidertitle'.$i] ) ?>' />
                    <h5> <?php _e("Text","iced_mocha");?> </h5>
                    <textarea id='iced_mocha_slidertext<?php echo $i; ?>' name='iced_mocha_settings[iced_mocha_slidertext<?php echo $i; ?>]' rows='3' cols='50'
                         type='textarea'><?php echo esc_attr($iced_mochas['iced_mocha_slidertext'.$i]) ?></textarea>
                    <h5> <?php _e("Link","iced_mocha");?> </h5>
                    <input id='iced_mocha_sliderlink<?php echo $i; ?>' name='iced_mocha_settings[iced_mocha_sliderlink<?php echo $i; ?>]' size='50' type='text'
                         value='<?php echo esc_url( $iced_mochas['iced_mocha_sliderlink'.$i] ) ?>' />
               </div>
               </div>

          <?php endfor; ?>
          </div> <!-- customSlides -->
     </div>
<?php
} // espresso_theme_setting_frontslider2_fn()

//CHECKBOX - Name: iced_mocha_settings[frontcolumns]
function espresso_theme_setting_frontcolumns_fn() {
	global $iced_mochas;

	echo '<div class="slmini">';
	$items = array("Widget Columns", "Latest Posts", "Random Posts", "Sticky Posts", "Latest Posts from Category" , "Random Posts from Category", "Specific Posts", "Disabled");
	$itemsare = array( __("Widget Columns","iced_mocha"), __("Latest Posts","iced_mocha"), __("Random Posts","iced_mocha"),__("Sticky Posts","iced_mocha"), __("Latest Posts from Category","iced_mocha"), __("Random Posts from Category","iced_mocha"), __("Specific Posts","iced_mocha"), __("Disabled","iced_mocha"));
	echo "<strong> Columns content: </strong> ";
	echo "<select id='iced_mocha_columnType' name='iced_mocha_settings[iced_mocha_columnType]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_columnType'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Only the columns with a defined image will become active and visible on the presentation page.<br>When using columns from posts, make sure the selected posts have featured images.<br>Read the FAQs for more info.","iced_mocha")."</small></div>";
     ?>

     <div class="underSelector">
          <div id="columnLatestPosts" class="columnDivs">
               <span><?php _e('Latest posts will be loaded into the columns.','iced_mocha'); ?> </span>
          </div>

          <div id="columnRandomPosts" class="columnDivs">
               <span><?php _e('Random posts will be loaded into the columns.','iced_mocha'); ?> </span>
          </div>

          <div id="columnLatestCateg" class="columnDivs">
               <span><?php _e('Latest posts from the category you choose will be loaded in the columns.','iced_mocha'); ?> </span>
          </div>

          <div id="columnRandomCateg" class="columnDivs">
               <span><?php _e('Random posts from the category you choose will be loaded into the columns.','iced_mocha'); ?> </span>
          </div>

          <div id="columnStickyPosts" class="columnDivs">
               <span><?php _e('Only sticky posts will be loaded into the columns.','iced_mocha'); ?> </span>
          </div>

          <div id="columnSpecificPosts" class="columnDivs">
               <span><?php _e('List the post IDs you want to display (separated by a comma): ','iced_mocha'); ?> </span>
               <input id='iced_mocha_columnSpecific' name='iced_mocha_settings[iced_mocha_columnSpecific]' size='44' type='text' value='<?php echo esc_attr( $iced_mochas['iced_mocha_columnSpecific'] ) ?>' />
          </div>

		  <div id="columnWidgets" class="columnDivs">
			  <span><?php _e('Load your custom Widgets as columns. Go to <a>Appearance >> Widgets</a> and create your custom columns using the Columns widget. You can use as many as you want.','iced_mocha'); ?> </span>
          </div>
		  <script>jQuery('#columnWidgets span a').attr('href','<?php echo esc_url(get_admin_url());?>widgets.php');</script>

          <div id="column-category">
               <span><?php _e('<br> Choose the category: ','iced_mocha'); ?> </span>
               <select id="iced_mocha_columnCateg" name='iced_mocha_settings[iced_mocha_columnCateg]'>
               <option value=""><?php echo esc_attr(__('Select Category','iced_mocha')); ?></option>
               <?php echo $iced_mochas["iced_mocha_columnCateg"];
               $categories = get_categories();
               foreach ($categories as $category) {
                 	$option = '<option value="'.$category->category_nicename.'" ';
               	$option .= selected($iced_mochas["iced_mocha_columnCateg"], $category->category_nicename, false).' >';
               	$option .= $category->cat_name;
               	$option .= ' ('.$category->category_count.')';
               	$option .= '</option>';
               	echo $option;
               } ?>
               </select>
          </div>

          <span id="column-post-number"><?php _e('Number of posts to show:','iced_mocha'); ?>
               <input id='iced_mocha_columnNumber' name='iced_mocha_settings[iced_mocha_columnNumber]' size='3' type='text' value='<?php echo esc_attr( $iced_mochas['iced_mocha_columnNumber'] ) ?>' />
          </span>

     </div>
</div>

<?php	echo "<div class='slmini'><b>".__("Columns per row:","iced_mocha")."</b> ";
	$items = array ("1", "2" , "3" , "4");
	echo "<select id='iced_mocha_nrcolumns' name='iced_mocha_settings[iced_mocha_nrcolumns]'>";
	foreach($items as $item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_nrcolumns'],$item);
		echo ">$item</option>";
	}
	echo "</select></div>";

	echo "<div class='slmini'><b>".__("Image Size:","iced_mocha")."</b> ";
	echo __("Height: ","iced_mocha")."<input id='iced_mocha_colimageheight' name='iced_mocha_settings[iced_mocha_colimageheight]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_colimageheight'] )."' /> px &nbsp;&nbsp;";
	echo __("Width: ","iced_mocha")."<span id='iced_mocha_colimagewidth_show'></span> px"."<input id='iced_mocha_colimagewidth' type='hidden' name='iced_mocha_settings[iced_mocha_colimagewidth]' value='".esc_attr( $iced_mochas['iced_mocha_colimagewidth'] )."' />";
	echo "<small>".__("The sizes for your column images. The width is dependent on total site width and not configurable.","iced_mocha")."</small></div>";
     ?>
     <div class='slmini'><b><?php _e("Read more text:","iced_mocha");?></b>
     <input id='iced_mocha_columnreadmore' name='iced_mocha_settings[iced_mocha_columnreadmore]' size='30' type='text' value='<?php echo esc_attr( $iced_mochas['iced_mocha_columnreadmore'] ) ?>' />
     <?php
	echo "<small>".__("The linked text that appears at the bottom of each column. Leave empty to hide the link.","iced_mocha")."</small></div>";

} // espresso_theme_setting_frontcolumns_fn()


//CHECKBOX - Name: iced_mocha_settings[fronttext]
function espresso_theme_setting_fronttext_fn() {
	global $iced_mochas;

     echo "<div class='slidebox'><h4 class='slidetitle'> ".__("Extra Text","iced_mocha")." </h4><div class='slidercontent'>";

     echo "<div style='width:100%;'><span>".__("Text for the Presentation Page","iced_mocha")."</span><small>".
          __("More text for the Presentation Page. The top title is just below the slider, the second title is below the columns. A text area supporting HTML tags and shortcodes below each title<br>".
     	   "It's all optional so leave any input field empty to not dispaly it.","iced_mocha")."</small></div>";

	echo "<h5>".__("Top Title","iced_mocha")."</h5><br>";
     echo "<input id='iced_mocha_fronttext1' name='iced_mocha_settings[iced_mocha_fronttext1]' size='50' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fronttext1'] )."' />";
	   echo "<h5>".__("Top Text","iced_mocha")."</h5> ";
	echo "<textarea id='iced_mocha_fronttext3' name='iced_mocha_settings[iced_mocha_fronttext3]' rows='3' cols='50' type='textarea' >".esc_attr($iced_mochas['iced_mocha_fronttext3'])." </textarea>";

     echo "<h5>".__("Second Title","iced_mocha")."</h5> ";
	echo "<input id='iced_mocha_fronttext2' name='iced_mocha_settings[iced_mocha_fronttext2]' size='50' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fronttext2'] )."' />";
     echo "<h5>".__("Second text","iced_mocha")." </h5> ";
	echo "<textarea id='iced_mocha_fronttext4' name='iced_mocha_settings[iced_mocha_fronttext4]' rows='3' cols='50' type='textarea' >".esc_attr($iced_mochas['iced_mocha_fronttext4'])." </textarea></div></div>";

     echo "<div class='slidebox'><h4 class='slidetitle'>".__("Hide areas","iced_mocha")." </h4><div  class='slidercontent'>";

     echo "<div style='width:100%;'>".__("Choose the areas to hide on the first page.","iced_mocha")."</div>";

		$items = array( "FrontHeader", "FrontMenu", "FrontWidget" , "FrontFooter","FrontBack");

		$checkedClass0 = ($iced_mochas['iced_mocha_fronthideheader']=='1') ? ' checkedClass0' : '';
		$checkedClass1 = ($iced_mochas['iced_mocha_fronthidemenu']=='1') ? ' checkedClass1' : '';
		$checkedClass2 = ($iced_mochas['iced_mocha_fronthidewidget']=='1') ? ' checkedClass2' : '';
		$checkedClass3 = ($iced_mochas['iced_mocha_fronthidefooter']=='1') ? ' checkedClass3' : '';
		$checkedClass4 = ($iced_mochas['iced_mocha_fronthideback']=='1') ? ' checkedClass4' : '';

	echo " <label id='$items[0]' for='$items[0]$items[0]' class='hideareas $checkedClass0'><input "; checked($iced_mochas['iced_mocha_fronthideheader'],'1');
	echo " value='1' id='$items[0]$items[0]'  name='iced_mocha_settings[iced_mocha_fronthideheader]' type='checkbox' /> ".__("Hide the header area (logo/title and/or image/empty area).","iced_mocha")." </label>";

	echo " <label id='$items[1]' for='$items[1]$items[1]' class='hideareas $checkedClass1'><input "; checked($iced_mochas['iced_mocha_fronthidemenu'],'1');
	echo " value='1' id='$items[1]$items[1]'  name='iced_mocha_settings[iced_mocha_fronthidemenu]' type='checkbox' /> ".__("Hide the main menu and the top menu.","iced_mocha")." </label>";

	echo " <label id='$items[2]' for='$items[2]$items[2]' class='hideareas $checkedClass2'><input "; checked($iced_mochas['iced_mocha_fronthidewidget'],'1');
	echo " value='1' id='$items[2]$items[2]'  name='iced_mocha_settings[iced_mocha_fronthidewidget]' type='checkbox' /> ".__("Hide the footer widgets. ","iced_mocha")." </label>";

	echo " <label id='$items[3]' for='$items[3]$items[3]' class='hideareas $checkedClass3'><input "; checked($iced_mochas['iced_mocha_fronthidefooter'],'1');
	echo " value='1' id='$items[3]$items[3]'  name='iced_mocha_settings[iced_mocha_fronthidefooter]' type='checkbox' /> ".__("Hide the footer (copyright area).","iced_mocha")." </label>";

     echo "</div></div>";
}


////////////////////////////////
//// TEXT SETTINGS /////////////
////////////////////////////////

//SELECT - Name: iced_mocha_settings[fontfamily]
function  espresso_theme_setting_fontfamily_fn() {
	global $iced_mochas;
	global $fonts;
	$sizes = array ("12px", "13px" , "14px" , "15px" , "16px", "17px", "18px", "19px", "20px");
	espresso_theme_proto_font(
		$fonts,
		$sizes,
		$iced_mochas['iced_mocha_fontsize'],
		$iced_mochas['iced_mocha_fontfamily'],
		$iced_mochas['iced_mocha_googlefont'],
		'iced_mocha_fontsize',
		'iced_mocha_fontfamily',
		'iced_mocha_googlefont'
	);
	echo "<div><small>".__("Select the general font family and size or insert the Google Font name you'll use in your blog. This will affect all text except the one controlled by the options below. ","iced_mocha")."</small></div><br>";
}

//SELECT - Name: iced_mocha_settings[fonttitle]
function  espresso_theme_setting_fonttitle_fn() {
	global $iced_mochas;
	global $fonts;
	$sizes = array ( "14px" , "16px" , "18px" , "20px", "22px" , "24px" , "26px" , "28px" , "30px" , "32px" , "34px" , "36px", "38px" , "40px");
	espresso_theme_proto_font(
		$fonts,
		$sizes,
		$iced_mochas['iced_mocha_headfontsize'],
		$iced_mochas['iced_mocha_fonttitle'],
		$iced_mochas['iced_mocha_googlefonttitle'],
		'iced_mocha_headfontsize',
		'iced_mocha_fonttitle',
		'iced_mocha_googlefonttitle',
		__('General Font','iced_mocha')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want for your titles. It will affect post titles and page titles. Leave 'General Font' and the general font values you selected will be used.","iced_mocha")."</small></div><br>";
}

//SELECT - Name: iced_mocha_settings[fontside]
function  espresso_theme_setting_fontside_fn() {
	global $iced_mochas;
	global $fonts;
	for ($i=14;$i<31;$i+=2): $sizes[] = "${i}px"; endfor;
	espresso_theme_proto_font(
		$fonts,
		$sizes,
		$iced_mochas['iced_mocha_sidefontsize'],
		$iced_mochas['iced_mocha_fontside'],
		$iced_mochas['iced_mocha_googlefontside'],
		'iced_mocha_sidefontsize',
		'iced_mocha_fontside',
		'iced_mocha_googlefontside',
		__('General Font','iced_mocha')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your widget titles to have. Leave 'General Font' and the general font values you selected will be used.","iced_mocha")."</small></div><br>";
}

function  espresso_theme_setting_sitetitlefont_fn() {
	global $iced_mochas;
	global $fonts;
	for ($i=30;$i<51;$i+=2): $sizes[] = "${i}px"; endfor;
	espresso_theme_proto_font(
		$fonts,
		$sizes,
		$iced_mochas['iced_mocha_sitetitlesize'],
		$iced_mochas['iced_mocha_sitetitlefont'],
		$iced_mochas['iced_mocha_sitetitlegooglefont'],
		'iced_mocha_sitetitlesize',
		'iced_mocha_sitetitlefont',
		'iced_mocha_sitetitlegooglefont',
		__('General Font','iced_mocha')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your site title and tagline to use. Leave 'General Font' and the general font values you selected will be used.","iced_mocha")."</small></div><br>";
}

function  espresso_theme_setting_menufont_fn() {
	global $iced_mochas;
	global $fonts;
	$sizes = array ( "8px" , "9px" , "10px" , "11px", "12px" , "13px" , "14px" , "15px" , "16px" , "17px" , "18px", "19px", "20px");
	espresso_theme_proto_font(
		$fonts,
		$sizes,
		$iced_mochas['iced_mocha_menufontsize'],
		$iced_mochas['iced_mocha_menufont'],
		$iced_mochas['iced_mocha_menugooglefont'],
		'iced_mocha_menufontsize',
		'iced_mocha_menufont',
		'iced_mocha_menugooglefont',
		__('General Font','iced_mocha')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your main menu to use. Leave 'General Font' and the general font values you selected will be used.","iced_mocha")."</small></div><br>";
}


//SELECT - Name: iced_mocha_settings[fontsubheader]
function  espresso_theme_setting_fontheadings_fn() {
	global $iced_mochas;
	global $fonts;
	//$sizes = array ( "0.8em", "0.9em","1em","1.1em","1.2em","1.3em","1.4em","1.5em","1.6em","1.7em","1.8em","1.9em","2em");
	$sizes = array("60%","70%","80%","90%","100%","110%","120%","130%","140%","150%");
	espresso_theme_proto_font(
		$fonts,
		$sizes,
		$iced_mochas['iced_mocha_headingsfontsize'],
		$iced_mochas['iced_mocha_headingsfont'],
		$iced_mochas['iced_mocha_headingsgooglefont'],
		'iced_mocha_headingsfontsize',
		'iced_mocha_headingsfont',
		'iced_mocha_headingsgooglefont',
		__('General Font','iced_mocha')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your headings to have (h1 - h6 tags will be affected). Leave 'General Font' and the general font values you selected will be used.","iced_mocha")."</small></div><br>";
}

//SELECT - Name: iced_mocha_settings[textalign]
function  espresso_theme_setting_textalign_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_textalign",
		array("Default" , "Left" , "Right" , "Justify" , "Center"),
		array( __("Default","iced_mocha"), __("Left","iced_mocha"), __("Right","iced_mocha"), __("Justify","iced_mocha"), __("Center","iced_mocha"))
	);
	echo "<div><small>".__("This overwrites the text alignment in posts and pages. Leave 'Default' for normal settings (alignment will remain as declared in posts, comments etc.).","iced_mocha")."</small></div>";
}

//SELECT - Name: iced_mocha_settings[parindent]
function  espresso_theme_setting_parindent_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_parindent",
		array("0px" , "5px" , "10px" , "15px" , "20px"),
		array("0px" , "5px" , "10px" , "15px" , "20px")
	);
	echo "<div><small>".__("Choose the indent for your paragraphs.","iced_mocha")."</small></div>";
}


//CHECKBOX - Name: iced_mocha_settings[headerindent]
function espresso_theme_setting_headingsindent_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_headingsindent",
		array("Enable" , "Disable"),
		array( __("Enable","iced_mocha"), __("Disable","iced_mocha"))
	);
	echo "<div><small>".__("Disable the default headings indent (left margin).","iced_mocha")."</small></div>";
}

//SELECT - Name: iced_mocha_settings[lineheight]
function  espresso_theme_setting_lineheight_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_lineheight",
		array("0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em"),
		array( "0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em")
	);
	echo "<div><small>".__("Text line height. The height between 2 rows of text.","iced_mocha")."</small></div>";
}

//SELECT - Name: iced_mocha_settings[wordspace]
function  espresso_theme_setting_wordspace_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_wordspace",
		array("Default" ,"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px"),
		array( __("Default","iced_mocha"),"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px")
	);
	echo "<div><small>".__("The space between <i>words</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","iced_mocha")."</small></div>";
}

//SELECT - Name: iced_mocha_settings[letterspace]
function  espresso_theme_setting_letterspace_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_letterspace",
		array("Default" ,"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em"),
		array( __("Default","iced_mocha"),"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em")
	);
	echo "<div><small>".__("The space between <i>letters</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[textshadow]
function espresso_theme_setting_paragraphspace_fn() {
	global $iced_mochas;
	$items[]="0.0em"; for ($i=0.5;$i<=1.5;$i+=0.1) {  $items[] = number_format($i,1)."em";  }
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_paragraphspace", $items, $items );
	echo "<div><small>".__("Select the spacing between the paragraphs.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[headerindent]
function espresso_theme_setting_uppercasetext_fn() {
	global $iced_mochas;
	espresso_theme_proto_field( $iced_mochas, "select", "iced_mocha_uppercasetext", array(0, 1),
		array( __("Default (disabled)","iced_mocha"), __("Enable","iced_mocha"))
	);
	echo "<div><small>".__("Enable uppercase text styling. All text in the site will be uppercase.","iced_mocha")."</small></div>";
}

////////////////////////////////
//// APPEREANCE SETTINGS ///////
////////////////////////////////

function espresso_theme_setting_sitebackground_fn() {
     echo "<a href=\"?page=custom-background\" class=\"button\" target=\"_blank\">".__('Define background image','iced_mocha')."</a>";
} // espresso_theme_setting_sitebackground_fn()

function  espresso_theme_setting_generalcolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('Background:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_backcolorheader',__('Header Background','iced_mocha'),$iced_mochas['iced_mocha_backcolorheader']);
	espresso_theme_color_field('iced_mocha_backcolormain',__('Main Site Background','iced_mocha'),$iced_mochas['iced_mocha_backcolormain']);
	espresso_theme_color_field('iced_mocha_backcolorfooterw',__('Footer Widgets Area Background','iced_mocha'),$iced_mochas['iced_mocha_backcolorfooterw']);
	espresso_theme_color_field('iced_mocha_backcolorfooter',__('Footer Background','iced_mocha'),$iced_mochas['iced_mocha_backcolorfooter']);
	echo '<br class="colors-br" /><h4>'.__('Text:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_contentcolortxt',__('General Text','iced_mocha'),$iced_mochas['iced_mocha_contentcolortxt']);
	espresso_theme_color_field('iced_mocha_contentcolortxtlight',__('General Lighter Text','iced_mocha'),$iced_mochas['iced_mocha_contentcolortxtlight']);
	espresso_theme_color_field('iced_mocha_footercolortxt',__('Footer Text','iced_mocha'),$iced_mochas['iced_mocha_footercolortxt']);
	echo "<div><small>".__("The site background features 4 separately coloured areas.<br />The general text colour applies to all text on the website that is not controlled by any other option.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_accentcolors_fn() {
	global $iced_mochas;
	espresso_theme_color_field('iced_mocha_accentcolora',__('Accent Color #1','iced_mocha'),$iced_mochas['iced_mocha_accentcolora']);
	espresso_theme_color_field('iced_mocha_accentcolorb',__('Accent Color #2','iced_mocha'),$iced_mochas['iced_mocha_accentcolorb']);
	espresso_theme_color_field('iced_mocha_accentcolorc',__('Accent Color #3','iced_mocha'),$iced_mochas['iced_mocha_accentcolorc']);
	espresso_theme_color_field('iced_mocha_accentcolord',__('Accent Color #4','iced_mocha'),$iced_mochas['iced_mocha_accentcolord']);
	espresso_theme_color_field('iced_mocha_accentcolore',__('Accent Color #5','iced_mocha'),$iced_mochas['iced_mocha_accentcolore']);
	echo "<div><small>".__("Accents #1 and #2 should either be the same as the link colours or be separate from all other colours on the site.<br />
     Accent #5 is used for input fields and buttons backgrounds, borders and lines.<br />
     Accents #3 and #4 should be the lighter/darker than the content background colour, being used as borders/shades on elements where accent #5 is background colour.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_titlecolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('Background:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_descriptionbg',__('Site Description Background','iced_mocha'),$iced_mochas['iced_mocha_descriptionbg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_titlecolor',__('Site Title','iced_mocha'),$iced_mochas['iced_mocha_titlecolor']);
	espresso_theme_color_field('iced_mocha_descriptioncolor',__('Site Description','iced_mocha'),$iced_mochas['iced_mocha_descriptioncolor']);
//	echo "<div><small>".."</small></div>";
}

function  espresso_theme_setting_menucolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('Menu:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_menucolorbgdefault',__('Menu Background','iced_mocha'),$iced_mochas['iced_mocha_menucolorbgdefault']);
	espresso_theme_color_field('iced_mocha_menucolortxtdefault',__('Menu Text','iced_mocha'),$iced_mochas['iced_mocha_menucolortxtdefault']);
	//espresso_theme_color_field('iced_mocha_menucolorbghover',__('Menu Item Background on Hover','iced_mocha'),$iced_mochas['iced_mocha_menucolorbghover']);
	//espresso_theme_color_field('iced_mocha_menucolorbgactive',__('Active Menu Item Background','iced_mocha'),$iced_mochas['iced_mocha_menucolorbgactive']);
	echo '<br class="colors-br" /><h4>'.__('Submenu:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_submenucolorbgdefault',__('Submenu Background','iced_mocha'),$iced_mochas['iced_mocha_submenucolorbgdefault']);
	espresso_theme_color_field('iced_mocha_submenucolortxtdefault',__('Submenu Text','iced_mocha'),$iced_mochas['iced_mocha_submenucolortxtdefault']);
	espresso_theme_color_field('iced_mocha_submenucolorshadow',__('Submenu Shadow','iced_mocha'),$iced_mochas['iced_mocha_submenucolorshadow']);
	//espresso_theme_color_field('',__('','iced_mocha'),$iced_mochas[''],__("","iced_mocha"));
	echo "<div><small>".__("These colours apply to the main site menu (and dropdown elements).","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_topmenucolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('Background:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_topbarcolorbg',__('Top Bar Background','iced_mocha'),$iced_mochas['iced_mocha_topbarcolorbg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_topmenucolortxt',__('Top Bar Menu Link','iced_mocha'),$iced_mochas['iced_mocha_topmenucolortxt']);
	espresso_theme_color_field('iced_mocha_topmenucolortxthover',__('Top Bar Menu Link Hover','iced_mocha'),$iced_mochas['iced_mocha_topmenucolortxthover']);
	echo "<div><small>".__("These colours apply to the top bar menu.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_contentcolors_fn() {
	global $iced_mochas;
	espresso_theme_color_field('iced_mocha_contentcolorbg',__('Content Background','iced_mocha'),$iced_mochas['iced_mocha_contentcolorbg']);
	espresso_theme_color_field('iced_mocha_contentcolortxttitle',__('Page/Post Title','iced_mocha'),$iced_mochas['iced_mocha_contentcolortxttitle']);
	espresso_theme_color_field('iced_mocha_contentcolortxttitlehover',__('Page/Post Title Hover','iced_mocha'),$iced_mochas['iced_mocha_contentcolortxttitlehover']);
	espresso_theme_color_field('iced_mocha_contentcolortxtheadings',__('Content Headings','iced_mocha'),$iced_mochas['iced_mocha_contentcolortxtheadings']);
	echo "<div><small>".__("Content colours apply to post and page areas of the site.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_frontpagecolors_fn(){
	global $iced_mochas;
    espresso_theme_color_field('iced_mocha_fronttitlecolor',__('Titles Color','iced_mocha'),$iced_mochas['iced_mocha_fronttitlecolor']);
	espresso_theme_color_field('iced_mocha_fpsliderbordercolor',__('Slider Border Color','iced_mocha'),$iced_mochas['iced_mocha_fpsliderbordercolor']);
	espresso_theme_color_field('iced_mocha_fpslidercaptioncolor',__('Slider Caption Text Color','iced_mocha'),$iced_mochas['iced_mocha_fpslidercaptioncolor']);
	espresso_theme_color_field('iced_mocha_fpslidercaptionbg',__('Slider Caption Background','iced_mocha'),$iced_mochas['iced_mocha_fpslidercaptionbg']);
    echo "<div><small>".__("These colours apply to specific areas of the presentation page.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_sidecolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('Background:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_sidebg',__('Sidebars Background','iced_mocha'),$iced_mochas['iced_mocha_sidebg']);
	espresso_theme_color_field('iced_mocha_sidetitlebg',__('Sidebars Widget Title Background','iced_mocha'),$iced_mochas['iced_mocha_sidetitlebg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_sidetxt',__('Sidebars Text','iced_mocha'),$iced_mochas['iced_mocha_sidetxt']);
	espresso_theme_color_field('iced_mocha_sidetitletxt',__('Sidebars Widget Title Text','iced_mocha'),$iced_mochas['iced_mocha_sidetitletxt']);
	echo "<div><small>".__("These colours apply to the widgets placed in either sidebar.","iced_mocha")."</small></div>";
}


function  espresso_theme_setting_widgetcolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('Background:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_widgetbg',__('Footer Widgets Background','iced_mocha'),$iced_mochas['iced_mocha_widgetbg']);
	espresso_theme_color_field('iced_mocha_widgettitlebg',__('Footer Widgets Title Background','iced_mocha'),$iced_mochas['iced_mocha_widgettitlebg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_widgettxt',__('Footer Widget Text','iced_mocha'),$iced_mochas['iced_mocha_widgettxt']);
	espresso_theme_color_field('iced_mocha_widgettitletxt',__('Footer Widgets Title Text','iced_mocha'),$iced_mochas['iced_mocha_widgettitletxt']);
	echo "<div><small>".__("These colours apply to the widgets in the footer area.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_linkcolors_fn() {
	global $iced_mochas;
	echo '<h4>'.__('General:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_linkcolortext',__('General Links','iced_mocha'),$iced_mochas['iced_mocha_linkcolortext']);
	espresso_theme_color_field('iced_mocha_linkcolorhover',__('General Links Hover','iced_mocha'),$iced_mochas['iced_mocha_linkcolorhover']);
	echo '<br class="colors-br" /><h4>'.__('Sidebar Widgets:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_linkcolorside',__('Sidebar Widgets Links','iced_mocha'),$iced_mochas['iced_mocha_linkcolorside']);
	espresso_theme_color_field('iced_mocha_linkcolorsidehover',__('Sidebar Widgets Links Hover','iced_mocha'),$iced_mochas['iced_mocha_linkcolorsidehover']);
	echo '<br class="colors-br" /><h4>'.__('Footer Widgets:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_linkcolorwooter',__('Footer Widgets Links','iced_mocha'),$iced_mochas['iced_mocha_linkcolorwooter']);
	espresso_theme_color_field('iced_mocha_linkcolorwooterhover',__('Footer Widgets Links Hover','iced_mocha'),$iced_mochas['iced_mocha_linkcolorwooterhover']);
	echo '<br class="colors-br" /><h4>'.__('Footer:','iced_mocha').'</h4>';
	espresso_theme_color_field('iced_mocha_linkcolorfooter',__('Footer Links','iced_mocha'),$iced_mochas['iced_mocha_linkcolorfooter']);
	espresso_theme_color_field('iced_mocha_linkcolorfooterhover',__('Footer Links Hover','iced_mocha'),$iced_mochas['iced_mocha_linkcolorfooterhover']);
	echo "<div><small>".__("Footer colours include the footer menu colours.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_metacolors_fn() {
	global $iced_mochas;
	espresso_theme_color_field('iced_mocha_metacoloricons',__('Meta Icons','iced_mocha'),$iced_mochas['iced_mocha_metacoloricons']);
	espresso_theme_color_field('iced_mocha_metacolorlinks',__('Meta Links','iced_mocha'),$iced_mochas['iced_mocha_metacolorlinks']);
	espresso_theme_color_field('iced_mocha_metacolorlinkshover',__('Meta Links Hover','iced_mocha'),$iced_mochas['iced_mocha_metacolorlinkshover']);
	echo "<div><small>".__("Colours for your meta area (post information).","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_socialcolors_fn() {
	global $iced_mochas;
	espresso_theme_color_field('iced_mocha_socialcolorbg',__('Social Icons Background','iced_mocha'),$iced_mochas['iced_mocha_socialcolorbg']);
	espresso_theme_color_field('iced_mocha_socialcolorbghover',__('Social Icons Background Hover','iced_mocha'),$iced_mochas['iced_mocha_socialcolorbghover']);
	echo "<div><small>".__("Background colours for your social icons.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_caption_fn() {
     global $iced_mochas;
	$items = array ( "caption-light", "caption-dark","caption-simple" ,);
	$itemsare = array( __("Light","iced_mocha"), __("Dark","iced_mocha"),__("Simple","iced_mocha"));
	echo "<select id='iced_mocha_caption' name='iced_mocha_settings[iced_mocha_caption]'>";
     foreach($items as $id=>$item):
     	echo "<option value='$item'";
     	selected($iced_mochas['iced_mocha_caption'],$item);
     	echo ">$itemsare[$id]</option>";
     endforeach;
	echo "</select>";
	echo "<div><small>".__("This setting changes the look of your captions. Images that are not inserted through captions will not be affected.","iced_mocha")."</small></div>";
}



////////////////////////////////
//// GRAPHICS SETTINGS /////////
////////////////////////////////

//CHECKBOX - Name: iced_mocha_settings[breadcrumbs]
function espresso_theme_setting_topbar_fn() {
	global $iced_mochas;
	$items = array ("Normal" , "Fixed", "Hide");
	$itemsare = array( __("Normal","iced_mocha"), __("Fixed","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_topbar' name='iced_mocha_settings[iced_mocha_topbar]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_topbar'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";

	$items2 = array ("Site width" , "Full width");
	$itemsare2 = array( __("Site width","iced_mocha"), __("Full width","iced_mocha"));
	echo " - <select id='iced_mocha_topbarwidth' name='iced_mocha_settings[iced_mocha_topbarwidth]'>";
foreach($items2 as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_topbarwidth'],$item);
	echo ">$itemsare2[$id]</option>";
}
	echo "</select>";

	echo "<div><small>".__("Show the topbar that can include social icons and the top menu.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[breadcrumbs]
function espresso_theme_setting_breadcrumbs_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_breadcrumbs' name='iced_mocha_settings[iced_mocha_breadcrumbs]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_breadcrumbs'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show breadcrumbs at the top of the content area. Breadcrumbs are a form of navigation that keeps track of your location withtin the site.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[pagination]
function espresso_theme_setting_pagination_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_pagination' name='iced_mocha_settings[iced_mocha_pagination]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_pagination'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show numbered pagination. Where there is more than one page, instead of the bottom <b>Older Posts</b> and <b>Newer posts</b> links you have a numbered pagination. ","iced_mocha")."</small></div>";
}

function espresso_theme_setting_menualign_fn() {
	global $iced_mochas;
	$items = array ("left" , "center", "right");
	$itemsare = array( __("Left","iced_mocha"), __("Center","iced_mocha"), __("Right", "iced_mocha"));
	echo "<select id='iced_mocha_menualign' name='iced_mocha_settings[iced_mocha_menualign]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_menualign'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Sets the desired menu items alignment.","iced_mocha")."</small></div>";
}

function  espresso_theme_setting_contentmargins_fn() {
	global $iced_mochas;
	echo __('Margin top: ','iced_mocha');espresso_theme_proto_field( $iced_mochas, "input4str", "iced_mocha_contentmargintop", $iced_mochas['iced_mocha_contentmargintop'], ' px ' );
	echo "<div><small>".__("The margin between the content and the menu. It can be set to 0px if you want the content area and menu to join.","iced_mocha")."</small></div><br><br>";
	
	echo __('Padding left/right: ','iced_mocha');espresso_theme_proto_field( $iced_mochas, "input4str", "iced_mocha_contentpadding", $iced_mochas['iced_mocha_contentpadding'], ' px' );
	echo "<div><small>".__("The left/right padding around the content. Should be set to 10px or less for designs without a content color.","iced_mocha")."</small></div>";
}

// RADIO-BUTTON - Name: iced_mocha_settings[image]
function espresso_theme_setting_image_fn() {
	global $iced_mochas;
	$items = array("iced_mocha-image-none", "iced_mocha-image-one", "iced_mocha-image-two", "iced_mocha-image-three", "iced_mocha-image-four","iced_mocha-image-five");
	echo "<div>";
	foreach($items as $item) {
		$checkedClass = ($iced_mochas['iced_mocha_image_style']==$item) ? ' checkedClass' : '';
		echo " <label id='$item' for='$item$item' class='images $checkedClass'><input ";
			checked($iced_mochas['iced_mocha_image_style'],$item);
		echo " value='$item' id='$item$item' onClick=\"changeBorder('$item','images');\" name='iced_mocha_settings[iced_mocha_image_style]' type='radio' /><img class='$item'  src='".get_template_directory_uri()."/admin/images/testimg.jpg'/></label>";
	}
	echo "</div>";
	echo "<div><small>".__("The border style for your images. Only images inserted in your posts and pages will be affected. ","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[contentlist]
function espresso_theme_setting_contentlist_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_contentlist' name='iced_mocha_settings[iced_mocha_contentlist]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_contentlist'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show bullets next to lists in your content area (posts, pages etc.).","iced_mocha")."</small></div>";

}


//CHECKBOX - Name: iced_mocha_settings[pagetitle]
function espresso_theme_setting_pagetitle_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_pagetitle' name='iced_mocha_settings[iced_mocha_pagetitle]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_pagetitle'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show titles on pages.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[categtitle]
function espresso_theme_setting_categtitle_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_categtitle' name='iced_mocha_settings[iced_mocha_categtitle]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_categtitle'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show titles on Categories and Archives.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[tables]
function espresso_theme_setting_tables_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_tables' name='iced_mocha_settings[iced_mocha_tables]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_tables'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide table borders and background color.","iced_mocha")."</small></div>";
}


//CHECKBOX - Name: iced_mocha_settings[backtop]
function espresso_theme_setting_backtop_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_backtop' name='iced_mocha_settings[iced_mocha_backtop]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_backtop'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the Back to Top button. The button appears after scrolling the page down.","iced_mocha")."</small></div>";
}


////////////////////////////////
//// POST SETTINGS /////////////
////////////////////////////////

function espresso_theme_setting_metapos_fn() {
	global $iced_mochas;
	$items = array ("Top","Bottom","Hide" );
	$itemsare = array(__("Top","iced_mocha"), __("Bottom","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_metapos' name='iced_mocha_settings[iced_mocha_metapos]'>";
     foreach($items as $id=>$item):
     	echo "<option value='$item'";
     	selected($iced_mochas['iced_mocha_metapos'],$item);
     	echo ">$itemsare[$id]</option>";
     endforeach;
	echo "</select>";
	echo "<div><small>".__("The position of your meta bar (author, date, category, tags and edit button).","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[socialsdisplay]
function espresso_theme_setting_metashowblog_fn() {
global $iced_mochas;
$items = array( "author", "date", "time" , "category" ,"tag", "comments");
$itemsare = array( __("Author","iced_mocha"), __("Date","iced_mocha"),__("Time","iced_mocha") , __("Category","iced_mocha") ,__("Tag","iced_mocha"), __("Comments","iced_mocha"));
$i=0;
	foreach($items as $item):
		echo " <label id='$item' for='blog$item' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_blog_show'][$item],'1');
		echo " value='1' id='blog$item' name='iced_mocha_settings[iced_mocha_blog_show][$item]' type='checkbox' /> ".$itemsare[$i]."</label>";
	$i++;
	endforeach;

	echo "<div><small>".__("Choose the post metas you want to show on multiple post pages (home, blog, category, archive etc.)","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[socialsdisplay]
function espresso_theme_setting_metashowsingle_fn() {
global $iced_mochas;
$items = array( "author", "date", "time" , "category" ,"tag", "bookmark");
$itemsare = array( __("Author","iced_mocha"), __("Date","iced_mocha"),__("Time","iced_mocha") , __("Category","iced_mocha") ,__("Tag","iced_mocha"), __("Bookmark","iced_mocha"));
$i=0;
foreach($items as $item):
		echo " <label id='$item' for='single$item' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_single_show'][$item],'1');
		echo " value='1' id='single$item' name='iced_mocha_settings[iced_mocha_single_show][$item]' type='checkbox' /> ".$itemsare[$i]."</label>";
	$i++;
	endforeach;

	echo "<div><small>".__("Choose the post metas you want to show on sigle post pages.","iced_mocha")."</small></div>";
}



//CHECKBOX - Name: iced_mocha_settings[comtext]
function espresso_theme_setting_comtext_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_comtext' name='iced_mocha_settings[iced_mocha_comtext]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_comtext'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the explanatory text under the comments form (starts with  <i>You may use these HTML tags and attributes:...</i>).","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[comclosed]
function espresso_theme_setting_comclosed_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide in posts", "Hide in pages", "Hide everywhere");
	$itemsare = array( __("Show","iced_mocha"), __("Hide in posts","iced_mocha"), __("Hide in pages","iced_mocha"), __("Hide everywhere","iced_mocha"));
	echo "<select id='iced_mocha_comclosed' name='iced_mocha_settings[iced_mocha_comclosed]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_comclosed'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the <b>Comments are closed</b> text that by default shows up on pages or posts with comments disabled.","iced_mocha")."</small></div>";
}


//CHECKBOX - Name: iced_mocha_settings[comoff]
function espresso_theme_setting_comoff_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_comoff' name='iced_mocha_settings[iced_mocha_comoff]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_comoff'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the <b>Comments off</b> text next to posts that have comments disabled.","iced_mocha")."</small></div>";
}
/*
//CHECKBOX - Name: iced_mocha_settings[postdate]
function espresso_theme_setting_postcomlink_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_postcomlink' name='iced_mocha_settings[iced_mocha_postcomlink]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_postcomlink'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the <strong>Leave a comment</strong> or <strong>x Comments</strong> next to posts or post excerpts.","iced_mocha")."</small></div>";
}

function espresso_theme_setting_postdatetime_fn() {
	global $iced_mochas;
	$items = array ("datetime", "date", "time", "hide");
	$itemsare = array( __("Date and time","iced_mocha"), __("Date only","iced_mocha"), __("Time only","iced_mocha"), __("Hide both","iced_mocha"));
	echo "<select id='iced_mocha_postdatetime' name='iced_mocha_settings[iced_mocha_postdatetime]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_postdatetime'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the post date and time.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[postauthor]
function espresso_theme_setting_postauthor_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_postauthor' name='iced_mocha_settings[iced_mocha_postauthor]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_postauthor'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the post author.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[postcateg]
function espresso_theme_setting_postcateg_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_postcateg' name='iced_mocha_settings[iced_mocha_postcateg]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_postcateg'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the post category.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[posttag]
function espresso_theme_setting_posttag_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_posttag' name='iced_mocha_settings[iced_mocha_posttag]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_posttag'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the post tags.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[postbook]
function espresso_theme_setting_postbook_fn() {
	global $iced_mochas;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","iced_mocha"), __("Hide","iced_mocha"));
	echo "<select id='iced_mocha_postbook' name='iced_mocha_settings[iced_mocha_postbook]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_postbook'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the 'Bookmark permalink'.","iced_mocha")."</small></div>";
}

*/
////////////////////////////////
//// EXCERPT SETTINGS /////////////
////////////////////////////////


//CHECKBOX - Name: iced_mocha_settings[excerpthome]
function espresso_theme_setting_excerpthome_fn() {
	global $iced_mochas;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","iced_mocha"), __("Full Post","iced_mocha"));
	echo "<select id='iced_mocha_excerpthome' name='iced_mocha_settings[iced_mocha_excerpthome]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_excerpthome'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Excerpts on the main page. Only standard posts will be affected. All other post formats (aside, image, chat, quote etc.) have their specific formating.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[excerptsticky]
function espresso_theme_setting_excerptsticky_fn() {
	global $iced_mochas;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","iced_mocha"), __("Full Post","iced_mocha"));
	echo "<select id='iced_mocha_excerptsticky' name='iced_mocha_settings[iced_mocha_excerptsticky]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_excerptsticky'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Choose if you want the sticky posts on your home page to be visible in full or just the excerpts. ","iced_mocha")."</small></div>";
}


//CHECKBOX - Name: iced_mocha_settings[excerptarchive]
function espresso_theme_setting_excerptarchive_fn() {
	global $iced_mochas;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","iced_mocha"), __("Full Post","iced_mocha"));
	echo "<select id='iced_mocha_excerptarchive' name='iced_mocha_settings[iced_mocha_excerptarchive]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_excerptarchive'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Excerpts on archive, categroy and search pages. Same as above, only standard posts will be affected.","iced_mocha")."</small></div>";
}


// TEXTBOX - Name: iced_mocha_settings[excerptwords]
function espresso_theme_setting_excerptwords_fn() {
	global $iced_mochas;
	echo "<input id='iced_mocha_excerptwords' name='iced_mocha_settings[iced_mocha_excerptwords]' size='6' type='text' value='".esc_attr( $iced_mochas['iced_mocha_excerptwords'] )."'  />";
	echo "<div><small>".__("The number of words for excerpts. When that number is reached the post will be interrupted by a <i>Continue reading</i> link that will take the reader to the full post page.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[magazinelayout]
function espresso_theme_setting_magazinelayout_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_magazinelayout' name='iced_mocha_settings[iced_mocha_magazinelayout]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_magazinelayout'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the Magazine Layout. This layout applies to pages with posts and shows 2 posts per row.","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[excerptdots]
function espresso_theme_setting_excerptdots_fn() {
	global $iced_mochas;
	echo "<input id='iced_mocha_excerptdots' name='iced_mocha_settings[iced_mocha_excerptdots]' size='40' type='text' value='".esc_attr( $iced_mochas['iced_mocha_excerptdots'] )."'  />";
	echo "<div><small>".__("Replaces the three dots ('[...])' that are appended automatically to excerpts.","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[excerptcont]
function espresso_theme_setting_excerptcont_fn() {
	global $iced_mochas;
	echo "<input id='iced_mocha_excerptcont' name='iced_mocha_settings[iced_mocha_excerptcont]' size='40' type='text' value='".esc_attr( $iced_mochas['iced_mocha_excerptcont'] )."'  />";
	echo "<div><small>".__("Edit the 'Continue Reading' link added to your post excerpts.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[excerpttags]
function espresso_theme_setting_excerpttags_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_excerpttags' name='iced_mocha_settings[iced_mocha_excerpttags]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_excerpttags'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("By default WordPress excerpts remove all HTML tags (&lt;pre&gt;, &lt;a&gt;, &lt;b&gt and all others) and only clean text is left in the excerpt.
Enabling this option allows HTML tags to remain in excerpts so all your default formating will be kept.<br /> <b>Just a warning: </b>If HTML tags are enabled, you have to make sure
they are not left open. So if within your post you have an opened HTML tag but the except ends before that tag closes, the rest of the site will be contained in that HTML tag. -- Leave 'Disable' if unsure -- ","iced_mocha")."</small></div>";
}


////////////////////////////////
/// FEATURED IMAGE SETTINGS ////
////////////////////////////////


//CHECKBOX - Name: iced_mocha_settings[fpost]
function espresso_theme_setting_fpost_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_fpost' name='iced_mocha_settings[iced_mocha_fpost]'>";
	foreach($items as $id=>$item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_fpost'],$item);
		echo ">$itemsare[$id]</option>";
	}
	echo "</select>";
	$checkedClass = ($iced_mochas['iced_mocha_fpostlink']=='1') ? ' checkedClass' : '';
	echo " <label style='border:none;margin-left:10px;' id='$items[0]' for='$items[0]$items[0]' class='socialsdisplay $checkedClass'><input type='hidden' name='iced_mocha_settings[iced_mocha_fpostlink]' value='0' /><input ";
		 checked($iced_mochas['iced_mocha_fpostlink'],'1');
	echo " value='1' id='$items[0]$items[0]'  name='iced_mocha_settings[iced_mocha_fpostlink]' type='checkbox' /> ".__("Link the thumbnail to the post","iced_mocha")."</label>";
	echo "<div><small>".__("Show featured images as thumbnails on posts. The images must be selected for each post in the Featured Image section.","iced_mocha")."</small></div>";
}

//CHECKBOX - Name: iced_mocha_settings[fauto]
function espresso_theme_setting_fauto_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_fauto' name='iced_mocha_settings[iced_mocha_fauto]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_fauto'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show the first image that you inserted in a post as a thumbnail. If there is a Featured Image selected for that post, it will have priority.","iced_mocha")."</small></div>";
}


//CHECKBOX - Name: iced_mocha_settings[falign]
function espresso_theme_setting_falign_fn() {
	global $iced_mochas;
	$items = array ("Left" , "Center", "Right");
	$itemsare = array( __("Left","iced_mocha"), __("Center","iced_mocha"), __("Right","iced_mocha"));
	echo "<select id='iced_mocha_falign' name='iced_mocha_settings[iced_mocha_falign]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_falign'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Thumbnail alignment.","iced_mocha")."</small></div>";
}


// TEXTBOX - Name: iced_mocha_settings[fwidth]
function espresso_theme_setting_fsize_fn() {
	global $iced_mochas;
	echo "<input id='iced_mocha_fwidth' name='iced_mocha_settings[iced_mocha_fwidth]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fwidth'] )."'  />px ".__("(width)","iced_mocha")." <b> X </b> ";
	echo "<input id='iced_mocha_fheight' name='iced_mocha_settings[iced_mocha_fheight]' size='4' type='text' value='".esc_attr( $iced_mochas['iced_mocha_fheight'] )."'  />px ".__("(height)","iced_mocha")."";

	$checkedClass = ($iced_mochas['iced_mocha_fcrop']=='1') ? ' checkedClass' : '';

		echo " <label id='fcrop' for='iced_mocha_fcrop' class='socialsdisplay $checkedClass'><input  ";
		 checked($iced_mochas['iced_mocha_fcrop'],'1');
	echo "value='1' id='iced_mocha_fcrop'  name='iced_mocha_settings[iced_mocha_fcrop]' type='checkbox' /> ".__("Crop images to exact size.","iced_mocha")." </label>";


	echo "<div><small>".__("The size (in pixels) for your thumbnails. By default imges will be scaled with aspect ratio kept. Choose to crop the images if you want the exact size.","iced_mocha")."</small></div>";
}


//CHECKBOX - Name: iced_mocha_settings[fheader]
function espresso_theme_setting_fheader_fn() {
	global $iced_mochas;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_fheader' name='iced_mocha_settings[iced_mocha_fheader]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_fheader'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show featured images on headers. The header will be replaced with a featured image if you selected it as a Featured Image in the post and if it is bigger or at least equal to the current header size.","iced_mocha")."</small></div>";
}


////////////////////////
/// SOCIAL SETTINGS ////
////////////////////////

function espresso_theme_setting_social_master($i) {
	$espresso_theme_special_keys = array('Mail', 'Skype');
	$espresso_theme_social_small = array (
		'',__('Select your desired Social network from the left dropdown menu and insert your corresponding address in the right input field. (ex: <i>http://www.facebook.com/yourname</i> )','iced_mocha'),
		'',__("You can also choose if you want the link to open in a new window and what title to dispaly while hovering over the icon.",'iced_mocha'),
		'',__("You can show up to 5 different social icons from over 35 social networks.",'iced_mocha'),
		'',__("You can leave any number of inputs empty.",'iced_mocha'),
		'',__("You can change the background for your social colors from the colors settings section.",'iced_mocha')
		);
	$j=$i+1;
	global $iced_mochas, $socialNetworks;
	echo "<select id='iced_mocha_social$i' name='iced_mocha_settings[iced_mocha_social$i]'>";
	foreach($socialNetworks as $item) {
		echo "<option value='$item'";
		selected($iced_mochas['iced_mocha_social'.$i],$item);
		echo ">$item</option>";
	}
	echo "</select><span class='address_span'> &raquo; </span>";

	if (in_array($iced_mochas['iced_mocha_social'.$i],$espresso_theme_special_keys)) :
		$espresso_theme_current_social = esc_html( $iced_mochas['iced_mocha_social'.$j] );
	else :
		$espresso_theme_current_social = esc_url( $iced_mochas['iced_mocha_social'.$j] );
	endif;
	// Social Link
	echo "<input id='iced_mocha_social$j' placeholder='".__("Social Network Link","iced_mocha")."' name='iced_mocha_settings[iced_mocha_social$j]' size='32' type='text'  value='$espresso_theme_current_social' />";
	// Social Open in new window
	$checkedClass = ($iced_mochas['iced_mocha_social_target'.$i]=='1') ? ' checkedClass' : '';
	echo " <label id='iced_mocha_social_target$i' for='iced_mocha_social_target$i$i' class='$checkedClass'><input ";
	 checked($iced_mochas['iced_mocha_social_target'.$i],'1');
	echo " value='1' id='iced_mocha_social_target$i$i' name='iced_mocha_settings[iced_mocha_social_target$i]' type='checkbox' /> ".__("Open in new window","iced_mocha")." </label>";
	// Social Title
	echo "<input id='iced_mocha_social_title$i$i' name='iced_mocha_settings[iced_mocha_social_title$i]' size='32' type='text' placeholder='".__("Social Network Title","iced_mocha")."' value='".$iced_mochas['iced_mocha_social_title'.$i]."' />";

	echo "<div><small>".$espresso_theme_social_small[$i]."</small></div>";
} // espresso_theme_setting_social_master()


// TEXTBOX - Name: iced_mocha_settings[socialX]
function espresso_theme_setting_socials1_fn() {
	espresso_theme_setting_social_master(1);
}

function espresso_theme_setting_socials2_fn() {
	espresso_theme_setting_social_master(3);
}

// TEXTBOX - Name: iced_mocha_settings[social3]
function espresso_theme_setting_socials3_fn() {
	espresso_theme_setting_social_master(5);
}

// TEXTBOX - Name: iced_mocha_settings[social4]
function espresso_theme_setting_socials4_fn() {
	espresso_theme_setting_social_master(7);
}

// TEXTBOX - Name: iced_mocha_settings[social5]
function espresso_theme_setting_socials5_fn() {
	espresso_theme_setting_social_master(9);
}


// TEXTBOX - Name: iced_mocha_settings[socialsdisplay]
function espresso_theme_setting_socialsdisplay_fn() {
global $iced_mochas;
		$items = array( "Header", "CLeft", "CRight" , "Footer" ,"SLeft", "SRight");


	echo " <label id='$items[0]' for='$items[0]$items[0]' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_socialsdisplay0'],'1');
	echo " value='1' id='$items[0]$items[0]' name='iced_mocha_settings[iced_mocha_socialsdisplay0]' type='checkbox' /> ".__("Top Bar","iced_mocha")."</label>";

	echo " <label id='$items[3]' for='$items[3]$items[3]' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_socialsdisplay3'],'1');
	echo " value='1' id='$items[3]$items[3]' name='iced_mocha_settings[iced_mocha_socialsdisplay3]' type='checkbox' /> ".__("Footer","iced_mocha")." </label>";

	echo " <label id='$items[4]' for='$items[4]$items[4]' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_socialsdisplay4'],'1');
	echo " value='1' id='$items[4]$items[4]' name='iced_mocha_settings[iced_mocha_socialsdisplay4]' type='checkbox' /> ".__("Left side","iced_mocha")." </label>";

	echo " <label id='$items[5]' for='$items[5]$items[5]' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_socialsdisplay5'],'1');
	echo " value='1' id='$items[5]$items[5]' name='iced_mocha_settings[iced_mocha_socialsdisplay5]' type='checkbox' /> ".__("Right side","iced_mocha")." </label>";

	echo "<br/>";

	echo " <label id='$items[1]' for='$items[1]$items[1]' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_socialsdisplay1'],'1');
	echo " value='1' id='$items[1]$items[1]' name='iced_mocha_settings[iced_mocha_socialsdisplay1]' type='checkbox' /> ".__("Left Sidebar","iced_mocha")." </label>";

	echo " <label id='$items[2]' for='$items[2]$items[2]' class='socialsdisplay'><input ";
		 checked($iced_mochas['iced_mocha_socialsdisplay2'],'1');
	echo " value='1' id='$items[2]$items[2]' name='iced_mocha_settings[iced_mocha_socialsdisplay2]' type='checkbox' /> ".__("Right Sidebar","iced_mocha")." </label>";

	echo "<div><small>".__("Choose the <b>areas</b> where to display the social icons.","iced_mocha")."</small></div>";
}


////////////////////////
/// MISC SETTINGS ////
////////////////////////


// TEXTBOX - Name: iced_mocha_settings[copyright]
function espresso_theme_setting_copyright_fn() {
	global $iced_mochas;
	echo "<textarea id='iced_mocha_copyright' name='iced_mocha_settings[iced_mocha_copyright]' rows='3' cols='70' type='textarea' >".esc_textarea($iced_mochas['iced_mocha_copyright'])." </textarea>";
	echo "<div><small>".__("Insert custom text or HTML code that will appear in you footer. <br /> You can use HTML to insert links, images and special characters like &copy;.","iced_mocha")."</small></div>";
}


// TEXTBOX - Name: iced_mocha_settings[customcss]
function espresso_theme_setting_customcss_fn() {
	global $iced_mochas;
	echo "<textarea id='iced_mocha_customcss' name='iced_mocha_settings[iced_mocha_customcss]' rows='8' cols='70' type='textarea' >".esc_textarea(htmlspecialchars_decode($iced_mochas['iced_mocha_customcss'], ENT_QUOTES))." </textarea>";
	echo "<div><small>".__("Insert your custom CSS here. Any CSS declarations made here will overwrite Iced Mocha Theme's (even the custom options specified right here in the Iced Mocha Theme Settings page). <br /> Your custom CSS will be preserved when updating the theme.","iced_mocha")."</small></div>";
}

// TEXTBOX - Name: iced_mocha_settings[customjs]
function espresso_theme_setting_customjs_fn() {
	global $iced_mochas;
	echo "<textarea id='iced_mocha_customjs' name='iced_mocha_settings[iced_mocha_customjs]' rows='8' cols='70' type='textarea' >".esc_textarea(htmlspecialchars_decode($iced_mochas['iced_mocha_customjs']))." </textarea>";
	echo "<div><small>".__("Insert your custom Javascript code here. (Google Analytics and any other forms of Analytic software).","iced_mocha")."</small></div>";
}
function espresso_theme_setting_iecompat_fn() {
	global $iced_mochas;
	$items = array (1, 0);
	$itemsare = array( __("Enable","iced_mocha"), __("Disable","iced_mocha"));
	echo "<select id='iced_mocha_iecompat' name='iced_mocha_settings[iced_mocha_iecompat]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($iced_mochas['iced_mocha_iecompat'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<input type='hidden' name='iced_mocha_settings[iced_mocha_postboxes]' id='iced_mocha-postboxes' value='". $iced_mochas['iced_mocha_postboxes']."'>";
	echo "<div><small>".__("Enable extra compatibility tag for older Internet Explorer versions. Turning this option on will trigger W3C validation errors.","iced_mocha")."</small></div>";
} // espresso_theme_setting_iecompat_fn()

?>
