<?php

// master function used for displaying font family / gfont / size selectors
function espresso_theme_proto_font($fonts,$sizes,$size,$font,$gfont,$labelsize,$labelfont,$labelgfont,$general=""){ ?>
	<?php if ($size>0): ?>
	<select id='<?php echo $labelsize; ?>' name='iced_mocha_settings[<?php echo $labelsize; ?>]' class='fontsizeselect'>
	<?php foreach($sizes as $item): ?>
		<option value='<?php echo $item; ?>' <?php selected($size,$item); ?>><?php echo $item; ?></option>
	<?php endforeach; ?>
	</select>
	<?php endif; ?>

	<select id='<?php echo $labelfont; ?>' class='admin-fonts fontnameselect' name='iced_mocha_settings[<?php echo $labelfont; ?>]'>";
	<?php if (strlen($general)>0): ?>
		<optgroup>
			<option value="<?php echo $general; ?>"><?php echo $general; ?></option>
		</optgroup>
	<?php endif;
	foreach ($fonts as $fgroup => $fsubs): ?>
		<optgroup label='<?php echo $fgroup; ?>'>
		<?php foreach($fsubs as $item):
			$item_show = explode(',',$item); ?>
			<option style='font-family:<?php echo $item; ?>;' value='<?php echo $item; ?>' <?php selected($font,$item); ?>>
				<?php echo $item_show[0]; ?>
			</option>
		<?php endforeach; // fsubs ?>
		</optgroup>
	<?php endforeach; // fonts ?>
	</select>
	<input class="googlefonts" type="text" size="35" value="<?php echo esc_attr($gfont); ?>"  name="iced_mocha_settings[<?php echo $labelgfont; ?>]" id="<?php echo $labelgfont; ?>" placeholder = "<?php _e("or Google font","iced_mocha"); ?>"/>
<?php
} // espresso_theme_font_selector()


function espresso_theme_color_field($id,$title,$value,$hint=""){
	echo '<input type="text" id="'.$id.'" class="colorthingy" title="'.$title.'" name="iced_mocha_settings['.$id.']" value="'.esc_attr($value).'"  />';
    echo '<div id="'.$id.'2"></div>';
	if (strlen($hint)>0) echo "<div><small>".$hint."</small></div>";
} // espresso_theme_color_field()


function espresso_theme_proto_field($settings,$type,$name,$values,$labels='',$cls='',$echo=true){
	$data = ''; $len = 4; $san = 'str';
	if (preg_match("/input(\d{1,3})([a-z]{3})?/i",$type,$ms)):
		$type = "input";
		$len = $ms[1];
		if (isset($ms[2])): $san = $ms[2]; endif;
	endif;
	switch ($type):
		case "checkbox": 
			$data = "<input value='1' id='$name' name='${settings['id']}[$name]' type='checkbox' ".checked($values,'1'). " class='$cls'/> ".
			$data .= "<label for='$name' class='socialsdisplay'>";
			$data .= $labels." </label>\n";
		break; 
		case "select": 
			$data = "<select id='$name' name='${settings['id']}[$name]' class='$cls'>";
			foreach($values as $id => $val):
				$data .= "<option value='$val'".selected($settings[$name],$val,false).">$labels[$id]</option>";
			endforeach;
			$data .= "</select>\n";	
		break;
		case "textarea": 
		
		break;	
		case "input":
		default:    
			$data = "<input id='$name' name='${settings['id']}[$name]' size='$len' type='text' value='";
			switch ($san): 
				case "url": $data .= esc_url( $settings[$name] ); break; 
				case "int": $data .= intval(esc_attr( $settings[$name] )); break; 
				case "str": $data .= esc_attr( $settings[$name] ); break; 
			endswitch; 
			$data .=  "' class='$cls'/>$labels\n";
		break;
	endswitch;
	if ($echo): echo $data; else: return $data;  endif;
} //espresso_theme_proto_field()

function espresso_theme_proto_css(){


} //espresso_theme_proto_css()

?>