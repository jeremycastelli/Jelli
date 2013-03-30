<?php
class jelli_fields{

	public static function label($for='',$value=''){
		echo '<label for="'.$for.'">'.$value.'</label>';
	}
	public static function description($value=''){
		echo '<span class="description">'.$value.'</span>';
	}
	




	public static function textfield($id, $value, $size="30"){
		echo '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="'.$size.'" />';
	}
	public static function textarea($id, $value, $cols="60", $rows="4"){
		echo '<textarea name="'.$id.'" id="'.$id.'" cols="60" rows="4">'.$value.'</textarea>';
	}
	public static function tinymce($id, $value, $args=''){
		wp_editor( $value, $id, $args );
	}
	public static function quicktags($id, $value, $args=''){
		wp_editor( $value, $id, $args );
	} 
	public static function checkbox($id, $value){
		echo '<input type="checkbox" name="'.$id.'" id="'.$id.'" ',$value ? ' checked="checked"' : '','/>';  
	}
	public static function select($id, $options, $value){
		echo '<select name="'.$id.'" id="'.$id.'">';  
		foreach ($options as $option) {  
			echo '<option', $value == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
		}  
		echo '</select>';  
	}
	public static function radio($id, $options, $value){
		foreach ( $options as $option ) {  
			echo '<input type="radio" name="'.$id.'" id="'.$option['value'].'" value="'.$option['value'].'" ',$value == $option['value'] ? ' checked="checked"' : '',' /> 
				<label for="'.$option['value'].'">'.$option['label'].'</label><br />';  
		}  
	}
	public static function date($id, $value, $size="20"){
		echo '<input type="text" class="datepicker" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="'.$size.'" />';
	}
	public static function slider($id, $value){
		$value = $value != '' ? $value : '0';  
		echo '<div id="'.$id.'-slider"></div>
			<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="5" />';
	}
	public static function image($id, $value){
		$image = get_template_directory_uri().'/images/admin-value-image.png';  
		echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';  
		if ($value) { 		
			$image = wp_get_attachment_image_src($value, 'medium'); $image = $image[0]; 
		}  
		echo '<input name="'.$id.'" type="hidden" class="custom_upload_image" value="'.$value.'" /> 
		<img src="'.$image.'" class="custom_preview_image" alt="" /><br /> 
		<input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
		<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small> 
		<br clear="all" />';  
	}



	public static function field($field,$value){
		switch($field['type']) {  
			
			case 'textfield':  
				jelli_fields::textfield($field['id'], $value);
			break;  

			case 'textarea':  
				jelli_fields::textarea($field['id'], $value);
			break;  

			case 'tinymce':  
				$args = array ();
				jelli_fields::tinymce($field['id'], $value, $args);
			break; 

			case 'quicktags':  
				$args = array ('tinymce' => false,'quicktags' => true);
				jelli_fields::quicktags($field['id'], $value, $args);
			break;

			case 'checkbox':  
			   jelli_fields::checkbox($field['id'], $value);
			break;

			case 'select':  
			    jelli_fields::select($field['id'], $field['options'], $value);
			break;

			case 'radio':  
				jelli_fields::radio($field['id'], $field['options'], $value);
			break; 
			case 'date':
				jelli_fields::date($field['id'], $value);
			break;
			case 'slider':  
				jelli_fields::slider($field['id'], $value);
			break; 					      
			case 'image':  
			    jelli_fields::image($field['id'], $value);
			break; 


			/*
			// repeatable  
			case 'repeatable':  
			    echo '<a class="repeatable-add button" href="#">+</a> 
			            <ul id="'.$id.'-repeatable" class="custom_repeatable">';  
			    $i = 0;  
			    if ($value) {  
			        foreach($value as $row) {  
			            echo '<li><span class="sort hndle">|||</span> 
			                        <input type="text" name="'.$id.'['.$i.']" id="'.$id.'" value="'.$row.'" size="30" /> 
			                        <a class="repeatable-remove button" href="#">-</a></li>';  
			            $i++;  
			        }  
			    } else {  
			        echo '<li><span class="sort hndle">|||</span> 
			                    <input type="text" name="'.$id.'['.$i.']" id="'.$id.'" value="" size="30" /> 
			                    <a class="repeatable-remove button" href="#">-</a></li>';  
			    }  
			    echo '</ul> 
			        <span class="description">'.$field['desc'].'</span>';  
			break;   
			*/

			} //end switch 


	}
}
?>