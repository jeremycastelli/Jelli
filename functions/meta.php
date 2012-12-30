<?php
    // Field Array  
    $prefix = 'custom_';  
    
    $meta_boxes = array();
    
    /*
    $meta_boxes[] = array(
		'id' => 'my-meta-box-1',
		'title' => 'Custom meta box 1',
		'pages' => array('post', 'page'), // multiple post types
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(  
	        array(  
	            'label'=> 'Text Input',  
	            'desc'  => 'A description for the field.',  
	            'id'    => $prefix.'text',  
	            'type'  => 'text'  
	        ),  
	        array(  
	            'label'=> 'Textarea',  
	            'desc'  => 'A description for the field.',  
	            'id'    => $prefix.'textarea',  
	            'type'  => 'textarea'  
	        ),  
	        array(  
	            'label'=> 'Checkbox Input',  
	            'desc'  => 'A description for the field.',  
	            'id'    => $prefix.'checkbox',  
	            'type'  => 'checkbox'  
	        ),  
	        array(  
	            'label'=> 'Select Box',  
	            'desc'  => 'A description for the field.',  
	            'id'    => $prefix.'select',  
	            'type'  => 'select',  
	            'options' => array (  
	                'one' => array (  
	                    'label' => 'Option One',  
	                    'value' => 'one'  
	                ),  
	                'two' => array (  
	                    'label' => 'Option Two',  
	                    'value' => 'two'  
	                ),  
	                'three' => array (  
	                    'label' => 'Option Three',  
	                    'value' => 'three'  
	                )  
	            )  
	        ),
	        array (  
		        'label' => 'Radio Group',  
		        'desc'  => 'A description for the field.',  
		        'id'    => $prefix.'radio',  
		        'type'  => 'radio',  
		        'options' => array (  
		            'one' => array (  
		                'label' => 'Option One',  
		                'value' => 'one'  
		            ),  
		            'two' => array (  
		                'label' => 'Option Two',  
		                'value' => 'two'  
		            ),  
		            'three' => array (  
		                'label' => 'Option Three',  
		                'value' => 'three'  
		            )  
		        )  
		    ),
		    array (  
		        'label' => 'Checkbox Group',  
		        'desc'  => 'A description for the field.',  
		        'id'    => $prefix.'checkbox_group',  
		        'type'  => 'checkbox_group',  
		        'options' => array (  
		            'one' => array (  
		                'label' => 'Option One',  
		                'value' => 'one'  
		            ),  
		            'two' => array (  
		                'label' => 'Option Two',  
		                'value' => 'two'
		            ),  
		            'three' => array (  
		                'label' => 'Option Three',  
		                'value' => 'three'  
		            )  
		        )  
		    ) ,
		    array(  
		        'label' => 'Category',  
		        'id'    => 'category',  
		        'type'  => 'tax_select'  
		    )  ,
		    array(  
		        'label' => 'Post List',  
		        'desc' => 'A description for the field.',  
		        'id'    =>  $prefix.'post_id',  
		        'type' => 'post_list',  
		        'post_type' => array('post','page')  
		    ),
		    array(  
			    'label' => 'Date',  
			    'desc'  => 'A description for the field.',  
			    'id'    => $prefix.'date',  
			    'type'  => 'date'  
			),
		    array(  
		        'label' => 'Slider',  
		        'desc'  => 'A description for the field.',  
		        'id'    => $prefix.'slider',  
		        'type'  => 'slider',  
		        'min'   => '0',  
		        'max'   => '100',  
		        'step'  => '5'  
		    ),
		    array(  
		        'label'  => 'Image',  
		        'desc'  => 'A description for the field.',  
		        'id'    => $prefix.'image',  
		        'type'  => 'image'  
		    ),
		   	array(  
		        'label' => 'Repeatable',  
		        'desc'  => 'A description for the field.',  
		        'id'    => $prefix.'repeatable',  
		        'type'  => 'repeatable'  
		    )
    	)
    );  
    
    $meta_boxes[] = array(
		'id' => 'my-meta-box-2',
		'title' => 'Custom meta box 2',
		'pages' => array('post', 'page'), // multiple post types
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(  
	        array(  
	            'label'=> 'Text Input',  
	            'desc'  => 'A description for the field.',  
	            'id'    => $prefix.'text',  
	            'type'  => 'text'  
	        )  
		)
	);
    
    
   */
   
    foreach ($meta_boxes as $meta_box) {
    	$my_box = new jelli_meta_box($meta_box);
    }   
   
   

class jelli_meta_box
{
	protected $_meta;
	
	public function jelli_meta_box($meta_box)
	{	
		$this->_meta=$meta_box;
	
		// Add the Meta Box
		add_action('add_meta_boxes', array(&$this, 'add')); 
		
		// Save the Data
		add_action('save_post', array(&$this, 'save'));   
		
		// Remove the Default Taxonomy Box
		//add_action( 'admin_menu' , array(&$this, 'remove_taxonomy_boxes'));  
		
				
		  
	}    
	
	function add() {  
		
		global $post;
  
  	 	$id=$post->ID;
		
		foreach ($this->_meta['pages'] as $page) {
			if(isset($this->_meta['page_id']) && $this->_meta['page_id'] != $id)
				continue;

			
			add_meta_box($this->_meta['id'], $this->_meta['title'], array(&$this, 'show'), $page, $this->_meta['context'], $this->_meta['priority']);
		}
		add_action('admin_enqueue_scripts',array(&$this,'enqueue'));
	    add_action('admin_head',array(&$this,'add_custom_scripts')); 

	}  
	
	
	
	// The Callback  
	function show() { 
		add_action('admin_enqueue_scripts',array(&$this,'enqueue'));
	    add_action('admin_head',array(&$this,'add_custom_scripts')); 

	 
		global $custom_meta_fields, $post;  
		
		// Use nonce for verification  
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
		  
	    // Begin the field table and loop  
	    echo '<table class="form-table">';  
	    
	    foreach ($this->_meta['fields'] as $field) {  
	        
	        // get value of this field if it exists for this post  
	        $meta = get_post_meta($post->ID, $field['id'], true);  
	        
	        // begin a table row with  
	        echo '<tr> 
	                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
	                <td>';  
	                switch($field['type']) {  
	                   
	                    // text  
					    case 'text':  
					        echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /> 
					            <br /><span class="description">'.$field['desc'].'</span>';  
					    break;  
					    
					    
					    // textarea  
					    case 'textarea':  
					        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
					            <br /><span class="description">'.$field['desc'].'</span>';  
					    break;  
					    
					    // textarea Tinymce
					    case 'tinymce':  
							$args = array (
     							
							);
							wp_editor( $meta, $field['id'], $args );
					    break; 
					    
					    // textarea Quicktags
					    case 'quicktags':  
							$args = array (
     							'tinymce' => false,
     							'quicktags' => true,
							);
							wp_editor( $meta, $field['id'], $args );
					    break; 
					    
					    // checkbox  
					    case 'checkbox':  
					        echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
					            <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
					    break;  
					    
					    
					    // select  
					    case 'select':  
					        echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  
					        foreach ($field['options'] as $option) {  
					            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
					        }  
					        echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
					    break;  
					    
					    
					    // radio  
						case 'radio':  
						    foreach ( $field['options'] as $option ) {  
						        echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' /> 
						                <label for="'.$option['value'].'">'.$option['label'].'</label><br />';  
						    }  
						break; 


						// checkbox_group  
						case 'checkbox_group':  
						    foreach ($field['options'] as $option) {  
						        echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
						                <label for="'.$option['value'].'">'.$option['label'].'</label><br />';  
						    }  
						    echo '<span class="description">'.$field['desc'].'</span>';  
						break;  


					    // tax_select  
					    case 'tax_select':  
					        echo '<select name="'.$field['id'].'" id="'.$field['id'].'"> 
					                <option value="">Select One</option>'; // Select One  
					        $terms = get_terms($field['id'], 'get=all');  
					        $selected = wp_get_object_terms($post->ID, $field['id']);  
					        foreach ($terms as $term) {  
					            if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug))  
					                echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>';  
					            else  
					                echo '<option value="'.$term->slug.'">'.$term->name.'</option>';  
					        }  
					        $taxonomy = get_taxonomy($field['id']);  
					        echo '</select><br /><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span>';  
					    break;  
					    
					    
				        // post_list  
					    case 'post_list':  
					    $items = get_posts( array (  
					        'post_type' => $field['post_type'],  
					        'posts_per_page' => -1  
					    ));  
					        echo '<select name="'.$field['id'].'" id="'.$field['id'].'"> 
					                <option value="">Select One</option>'; // Select One  
					            foreach($items as $item) {  
					                echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';  
					            } // end foreach  
					        echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
					    break;  
					    
					    
					    // date
					    case 'date':
							echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
									<br /><span class="description">'.$field['desc'].'</span>';
						break;
								
								
						// slider  
						case 'slider':  
						$value = $meta != '' ? $meta : '0';  
						    echo '<div id="'.$field['id'].'-slider"></div> 
						            <input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" /> 
						            <br /><span class="description">'.$field['desc'].'</span>';  
						break; 					      


					    // image  
					    case 'image':  
					        $image = get_template_directory_uri().'/images/admin-meta-image.png';  
					        echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';  
					        if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }  
					        echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" /> 
					                    <img src="'.$image.'" class="custom_preview_image" alt="" /><br /> 
					                        <input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
					                        <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small> 
					                        <br clear="all" /><span class="description">'.$field['desc'].'';  
					    break; 
					    
					    
					    // repeatable  
					    case 'repeatable':  
					        echo '<a class="repeatable-add button" href="#">+</a> 
					                <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
					        $i = 0;  
					        if ($meta) {  
					            foreach($meta as $row) {  
					                echo '<li><span class="sort hndle">|||</span> 
					                            <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" /> 
					                            <a class="repeatable-remove button" href="#">-</a></li>';  
					                $i++;  
					            }  
					        } else {  
					            echo '<li><span class="sort hndle">|||</span> 
					                        <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" /> 
					                        <a class="repeatable-remove button" href="#">-</a></li>';  
					        }  
					        echo '</ul> 
					            <span class="description">'.$field['desc'].'</span>';  
					    break;   


	     
	                } //end switch  
	        echo '</td></tr>';  
	    } // end foreach  
	    echo '</table>'; // end table  
		    
	    //
	    
	}  
	
	function enqueue() {  
		wp_enqueue_script('jquery-ui-datepicker');  
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/css/jquery-ui-custom.css');  
		wp_enqueue_script('admin-meta', get_template_directory_uri().'/js/libs/admin-meta.js');
	}  

	function add_custom_scripts() {  
	    global $custom_meta_fields, $post;  
	  
	    $output = '<script type="text/javascript"> 
	                jQuery(function() {';  
	  
	    foreach ($this->_meta['fields'] as $field) { // loop through the fields looking for certain types  
	        if($field['type'] == 'date')  
	            $output .= 'jQuery(".datepicker").datepicker();';  
	            
	        if ($field['type'] == 'slider') {  
	    		$value = get_post_meta($post->ID, $field['id'], true);  
	    	
	    
		        if ($value == '') $value = $field['min'];  
			        $output .= ' 
			                jQuery( "#'.$field['id'].'-slider" ).slider({ 
			                    value: '.$value.', 
			                    min: '.$field['min'].', 
			                    max: '.$field['max'].', 
			                    step: '.$field['step'].', 
			                    slide: function( event, ui ) { 
			                        jQuery( "#'.$field['id'].'" ).val( ui.value ); 
			                    } 
			                });';  
			    }      
			            
		    }  
	  
	  
	  
	    $output .= '});</script>';  
	  
	    echo $output;  
	}  


	
	function save($post_id) { 
	 
	    global $custom_meta_fields;  
	  
	    // verify nonce  
	    if (!isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))  
	        return $post_id;  
	    // check autosave  
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
	        return $post_id;  
	    // check permissions  
	    if ('page' == $_POST['post_type']) {  
	        if (!current_user_can('edit_page', $post_id))  
	            return $post_id;  
	        } elseif (!current_user_can('edit_post', $post_id)) {  
	            return $post_id;  
	    }  
	  
	    // loop through fields and save the data  
	    foreach ($this->_meta['fields'] as $field) {  
	    
	    	if($field['type'] == 'tax_select'){
	    		$post = get_post($post_id);  
				$category = $_POST['category'];  
				wp_set_object_terms( $post_id, $category, 'category' ); 
	    	
	    	}
	    	else
	    	{
	    		$old = get_post_meta($post_id, $field['id'], true);  
		        $new = (isset($_POST[$field['id']]))?$_POST[$field['id']]:'';  
		        if ($new && $new != $old) {  
		            update_post_meta($post_id, $field['id'], $new);  
		        } elseif ('' == $new && $old) {  
		            delete_post_meta($post_id, $field['id'], $old);  
		        } 
	    	}
	         
	    } // end foreach  
	}  
	
	function remove_taxonomy_boxes() {  
    	remove_meta_box('categorydiv', 'post', 'side');  
	}  

	
	
}// end class


   
    

?>