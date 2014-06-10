<?php

// DEFAULT OPTIONS ARRAY

$iced_mocha_defaults = array(

"iced_mocha_db" => "1.0",

"iced_mocha_side"		=> "2cSr",
"iced_mocha_sidewidth"	=> 900,
"iced_mocha_sidebar"	=> 250,
"iced_mocha_mobile"	=> "Enable",
"iced_mocha_hcontain"	=> "",

"iced_mocha_frontpage"		=> "Enable",
"iced_mocha_frontposts"	=> "Disable",
"iced_mocha_frontevents" => "Disable",
"iced_mocha_frontpostscount" 		=> get_option('posts_per_page'), 
"iced_mocha_fpsliderwidth"			=> "1150",
"iced_mocha_fpsliderheight"		=> "400",
"iced_mocha_fpslideranim"	=> "random",
"iced_mocha_fpslidertime"	=> "750",
"iced_mocha_fpsliderpause"	=> "5000",
"iced_mocha_fpslidernav"	=> "Bullets",
"iced_mocha_fpsliderarrows"		=> "Visible on Hover",
"iced_mocha_fpslider_bordersize"	=> "0",
"iced_mocha_fpslider_topmargin"	=> "0",

"iced_mocha_slideType"		=> "Custom Slides",
"iced_mocha_slideCateg"	=> "",
"iced_mocha_slideNumber"	=> "5",
"iced_mocha_slideSpecific"	=> "",

"iced_mocha_sliderimg1"	=> get_template_directory_uri()."/images/slider/iced_mocha-slide1.jpg",
"iced_mocha_slidertitle1"	=> "Easy Event Management!",
"iced_mocha_slidertext1"	=> "Easily manage any type of event using Event Espresso 4. The possibilities are endless.",
"iced_mocha_sliderlink1"	=> "",
"iced_mocha_sliderimg2"	=> get_template_directory_uri()."/images/slider/iced_mocha-slide2.jpg",
"iced_mocha_slidertitle2"	=> "Fully integrated with WordPress",
"iced_mocha_slidertext2"	=> "Using the powerful content management system WordPress and Event Espresso, paperless ticketing has never been easier.",
"iced_mocha_sliderlink2"	=> "",
"iced_mocha_sliderimg3"	=> get_template_directory_uri()."/images/slider/iced_mocha-slide3.jpg",
"iced_mocha_slidertitle3"	=> "Easily Collect Payments",
"iced_mocha_slidertext3"	=> "Easily collects payments for registrations directly on your website. Integration with payment gateways allow you to collect money to cover the cost of organizing events before they start.",
"iced_mocha_sliderlink3"	=> "",
"iced_mocha_sliderimg4"	=>  get_template_directory_uri()."/images/slider/iced_mocha-slide4.jpg",
"iced_mocha_slidertitle4"	=> "Host and Manage Events with WordPress",
"iced_mocha_slidertext4"	=> "Event Espresso works perfectly for classes, workshops, fundraisers, sporting, trainings, conferences, networking, religion, social, non-profit, and nearly any other type of event.",
"iced_mocha_sliderlink4"	=> "",
"iced_mocha_sliderimg5" =>  "",
"iced_mocha_slidertitle5"   => "",
"iced_mocha_slidertext5"    => "",
"iced_mocha_sliderlink5"    => "",

"iced_mocha_nrcolumns"		=> "3",
"iced_mocha_columnNumber"	=> "3",
"iced_mocha_colimageheight"	=> "201",
"iced_mocha_colimagewidth"		=> "318",
"iced_mocha_columnreadmore"	=> "Read more",
"iced_mocha_columnType"	=> "Widget Columns",
"iced_mocha_columnCateg"	=> "",
"iced_mocha_columnSpecific"	=> "",

"iced_mocha_fronttext1"	=> "Use-cases and Examples",
"iced_mocha_fronttext3"	=> "Event registration and ticketing for WordPress with Event Espresso is very flexible.  We can't list all the ways Event Espresso has been used, but here are some use-cases and examples. We'll add more details to these examples as we have time. Let us know if you need additional clarity.<br><br>As you can see, with Event Espresso the sky's the limit. Just remember to have fun!<br><br>
							<div style='text-align:center;'><strong>Here are a few examples of Event Espresso in action:</strong></div>",
"iced_mocha_fronttext2"	=> "Event Espresso is paperless ticketing and event management for WordPress!",						
"iced_mocha_fronttext4"	=> "Our online event registration software can make your organization more profitable and efficient by helping you save money on registration and ticketing fees, reduce the countless hours of time you spend manually processing registrations, create a \"green\" and paperless event registration process and you will be open for business to accept registrations and payment 24/7.<br><br>
If you're doing event registration and ticketing any other way then you're wasting time and money. We offer packages and prices to fit any budget, so get started with your own online event registration and ticketing management system today",

"iced_mocha_fronthideheader"	=> "",
"iced_mocha_fronthidemenu"		=> "",
"iced_mocha_fronthidewidget"	=> "",
"iced_mocha_fronthidefooter"	=> "",
"iced_mocha_fronthideback"		=> "",

"iced_mocha_hheight"	=> "120",
"iced_mocha_hcenter"	=> 0,
"iced_mocha_hratio"	=> 0,

"iced_mocha_logoupload"	=> "",
"iced_mocha_favicon"		=> "",
"iced_mocha_siteheader"	=> "Site Title and Description",
"iced_mocha_headermargintop"	=> "40",
"iced_mocha_headermarginleft"	=> "0",

"iced_mocha_fontfamily"	=> 'Ubuntu',
"iced_mocha_googlefont"	=> '',
"iced_mocha_fontsize"		=> "15px",
"iced_mocha_fonttitle"		=> 'Yanone Kaffeesatz Regular',
"iced_mocha_googlefonttitle"	=> '',
"iced_mocha_headfontsize"	=> "34px",
"iced_mocha_fontside"		=> 'Open Sans Light',
"iced_mocha_googlefontside"	=> '',
"iced_mocha_sidefontsize"		=> "18px",
"iced_mocha_sitetitlefont"	=> 'Yanone Kaffeesatz Regular',
"iced_mocha_sitetitlegooglefont"	=> '',
"iced_mocha_sitetitlesize"	=> "38px",
"iced_mocha_menufont" 		=> 'Droid Sans',
"iced_mocha_menugooglefont"	=> '',
"iced_mocha_menufontsize"	=> "14px",
"iced_mocha_headingsfont"	=> 'Open Sans Light',
"iced_mocha_headingsgooglefont"	=> '',
"iced_mocha_headingsfontsize"	=> '120%',

"iced_mocha_textalign"		=> "Default",
"iced_mocha_paragraphspace"	=> "1.0em",
"iced_mocha_parindent"		=> "0px",
"iced_mocha_headingsindent"	=> "Disable",
"iced_mocha_lineheight"	=> "1.7em",
"iced_mocha_wordspace"		=> "Default",
"iced_mocha_letterspace"	=> "Default",
"iced_mocha_uppercasetext"	=> 0,

"iced_mocha_colorschemes"	=> "Iced Mocha Theme Light",

"iced_mocha_backcolorheader"	=> "",
"iced_mocha_backcolormain"		=> "#171717",
"iced_mocha_backcolorfooterw"	=> "",
"iced_mocha_backcolorfooter"	=> "#F7F7F7",

"iced_mocha_contentcolortxt"	=> "#444444",
"iced_mocha_contentcolortxtlight"	=> "#999999",
"iced_mocha_footercolortxt"	=> "#AAAAAA",

"iced_mocha_titlecolor"	=> "#1693A5",
"iced_mocha_descriptioncolor"	=> "#999999",
"iced_mocha_descriptionbg"	=> "",

"iced_mocha_menucolorbgdefault"	=> "#EAEAEA",
"iced_mocha_menucolortxtdefault"	=> "#333333",
"iced_mocha_submenucolorbgdefault"	=> "#2D2D2D",
"iced_mocha_submenucolortxtdefault"	=> "#BBBBBB",
"iced_mocha_submenucolorshadow"		=> "",

"iced_mocha_topbarcolorbg"	=> "#000000",
"iced_mocha_topmenucolortxt"	=> "#CCCCCC",
"iced_mocha_topmenucolortxthover"	=> "#EEEEEE",

"iced_mocha_contentcolorbg" 	=> "#FFFFFF",
"iced_mocha_contentcolortxttitle"	=> "#444444",
"iced_mocha_contentcolortxttitlehover"	=> "#000000",
"iced_mocha_contentcolortxtheadings"	=> "#444444",

"iced_mocha_sidebg"	=> "",
"iced_mocha_sidetxt"	=> "#333333",
"iced_mocha_sidetitlebg"	=> "#F7F7F7",
"iced_mocha_sidetitletxt"	=> "#666666",

"iced_mocha_widgetbg"		=> "",
"iced_mocha_widgettxt"		=> "#333333",
"iced_mocha_widgettitlebg"		=> "#F7F7F7",
"iced_mocha_widgettitletxt"	=> "#666666",

"iced_mocha_linkcolortext"		=> "#1693A5",
"iced_mocha_linkcolorhover"	=> "#D6341D",
"iced_mocha_linkcolorside"		=> "",
"iced_mocha_linkcolorsidehover"	=> "",
"iced_mocha_linkcolorwooter"	=> "",
"iced_mocha_linkcolorwooterhover"	=> "",
"iced_mocha_linkcolorfooter"	=> "",
"iced_mocha_linkcolorfooterhover"	=> "",

"iced_mocha_socialcolorbg"	=> "#1693A5",
"iced_mocha_socialcolorbghover"	=> "#D6341D",

"iced_mocha_metacoloricons"	=> "#CCCCCC",
"iced_mocha_metacolorlinks"	=> "#666666",
"iced_mocha_metacolorlinkshover"	=> "",

"iced_mocha_accentcolora"	=> "#1693A5",
"iced_mocha_accentcolorb"	=> "#D6341D",
"iced_mocha_accentcolorc"	=> "#EEEEEE",
"iced_mocha_accentcolord"	=> "#CCCCCC",
"iced_mocha_accentcolore"	=> "#F7F7F7",

"iced_mocha_fronttitlecolor"	=> "#444444",
"iced_mocha_fpsliderbordercolor"	=> "#ffffff",
"iced_mocha_fpslidercaptioncolor"	=> "#ffffff",
"iced_mocha_fpslidercaptionbg"	=> "#000000",

"iced_mocha_topbar"		=> "Normal",
"iced_mocha_topbarwidth"	=> "Site width",
"iced_mocha_breadcrumbs"	=> "Enable",
"iced_mocha_pagination"	=> "Enable",
"iced_mocha_menualign"		=> "left",
"iced_mocha_contentmargintop" => "20",
"iced_mocha_contentpadding" => "30",
"iced_mocha_caption"		=> "caption-dark",
"iced_mocha_image_style"	=> "iced_mocha-image-one",
"iced_mocha_contentlist"	=> "Show",
"iced_mocha_title"		=> "Show",
"iced_mocha_pagetitle"	=> "Show",
"iced_mocha_categtitle"	=> "Show",
"iced_mocha_tables"	=> "Disable",
"iced_mocha_backtop"	=> "Enable",
"iced_mocha_comtext"	=> "Show",
"iced_mocha_comclosed"	=> "Hide everywhere",
"iced_mocha_comoff"	=> "Show",

"iced_mocha_metapos"	=> "Bottom",
"iced_mocha_blog_show"	=> array(
	"comments"	=> 1,
	"date"		=> 1,
	"time"		=> 0,
	"author"	=> 1,
	"category"	=> 1,
	"tag"		=> 1,
	),
"iced_mocha_single_show" => array(
	"date"		=> 1,
	"time"		=> 0,
	"author"	=> 1,
	"category"	=> 1,
	"tag"		=> 1,
	"bookmark"	=> 1,
),
"iced_mocha_excerpthome"		=> "Excerpt",
"iced_mocha_excerptsticky"		=> "Full Post",
"iced_mocha_excerptarchive"	=> "Excerpt",
"iced_mocha_excerptwords"		=> "100",
"iced_mocha_magazinelayout"	=> "Disable",
"iced_mocha_excerptdots"		=> " &hellip;",
"iced_mocha_excerptcont"		=> "Continue reading",
"iced_mocha_excerpttags"		=> "Disable",

"iced_mocha_fpost" 	=> "Enable",
"iced_mocha_fpostlink" => "1",
"iced_mocha_fauto" 	=> "Enable",
"iced_mocha_falign" 	=> "Left",
"iced_mocha_fwidth" 	=> "250",
"iced_mocha_fheight" 	=> "150",
"iced_mocha_fcrop" 	=> "",
"iced_mocha_fheader" 	=> "Disable",

"iced_mocha_social1" 			=> "YouTube",
"iced_mocha_social2" 			=> "#",
"iced_mocha_social_title1" 	=> "",
"iced_mocha_social_target1" 	=> "1",
"iced_mocha_social3" 			=> "Twitter",
"iced_mocha_social4" 			=> "#",
"iced_mocha_social_title3" 	=> "",
"iced_mocha_social_target3" 	=> "1",
"iced_mocha_social5" 			=> "RSS",
"iced_mocha_social6"			=> "#",
"iced_mocha_social_title5" 	=> "",
"iced_mocha_social_target5" 	=> "1",
"iced_mocha_social7" 			=> "",
"iced_mocha_social8" 			=> "",
"iced_mocha_social_title7" 	=> "",
"iced_mocha_social_target7" 	=> "1",
"iced_mocha_social9" 			=> "",
"iced_mocha_social10" 			=> "",
"iced_mocha_social_title9" 	=> "",
"iced_mocha_social_target9" 	=> "1",

"iced_mocha_socialsdisplay0" => "1",
"iced_mocha_socialsdisplay1" => "",
"iced_mocha_socialsdisplay2" => "",
"iced_mocha_socialsdisplay3" => "1",
"iced_mocha_socialsdisplay4" => "",
"iced_mocha_socialsdisplay5" => "1",

"iced_mocha_postboxes" => array(),
"iced_mocha_copyright"	=> "This text can be changed from the Miscellaneous section of the settings page. <br />
<b>Lorem ipsum</b> dolor sit amet, <a href='#'>consectetur adipiscing</a> elit, cras ut imperdiet augue. ",
"iced_mocha_customcss"	=> "/* Iced Mocha Theme Custom CSS */  ",
"iced_mocha_customjs"	=> "",
"iced_mocha_iecompat"	=> 0);


// Default column text						 
$iced_mocha_column_defaults= array(
	$iced_mocha_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/iced_mocha-column1.jpg",
        'title'	=> 'Concert Series Demo',
        'text'	=> 'Easily manage and sell tickets for a series of concerts.',
        'link'	=> 'http://eventespresso.com',
        'blank'	=> 1,
    ),
    $iced_mocha_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/iced_mocha-column2.jpg",
        'title'	=> 'Yoga Class Demo',
        'text'	=> "Easily manage yoga class registrations.",
        'link'	=> 'http://eventespresso.com',
        'blank'	=> 1,
    ),
	$iced_mocha_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/iced_mocha-column3.jpg",
        'title'	=> 'Sporting Events',
        'text'	=> "Manage registrations and ticketing for sporting events.",
        'link'	=> 'http://eventespresso.com',
        'blank' => 1,
    ),
    /*$iced_mocha_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/iced_mocha-column4.jpg",
        'title'	=> 'Layouts and Page Templates',
        'text'	=> "Defy confinement! Everything should be where you want it to be, how you want it to be. Resize and rearrange the content and sidebars to your liking. 
							'Magazine' and 'Bog' layouts are also just around the corner.",
        'link'	=> 'http://eventespresso.com',
        'blank'	=> 1,
    ),
    $iced_mocha_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/iced_mocha-column5.jpg",
        'title'	=> 'Presentation Page',
        'text'	=> "It may seem pretty peculiar presenting the Presentation Page while presently peering at the Presentation Page itself. But it's worth mentioning that everything you see: titles, text, slides, animations, columns and more are all editable via the theme settings.",
        'link'	=> 'http://eventespresso.com',
        'blank' => 1,
    ),
    $iced_mocha_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/iced_mocha-column6.jpg",
        'title'	=> 'HTML5, CSS3 and more',
        'text'	=> "Iced Mocha Theme can hold an unlimited amount of columns and we could've filled them all with more perks and features but we choose to leave something to your imagination.",
        'link'	=> 'http://eventespresso.com',
        'blank' => 1,
    ),*/
);
?>