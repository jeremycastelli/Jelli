<?php
require_once (FUNCTIONS_PATH . '/helpers/fields.php');

if (function_exists('jelli_meta_boxes'))
{
	jelli_meta_boxes();
}

function jelli_register_meta_box($meta_box){
	$my_box = new jelli_meta_box($meta_box);
}

class jelli_meta_box
{
	protected $_meta;
	
	public function jelli_meta_box($meta_box){
		$this->_meta=$meta_box;
		$meta_prefix = 'meta_'; 
		for ($i=0; $i<count($this->_meta['fields']); $i++) {
			$this->_meta['fields'][$i]["id"]=$meta_prefix.$this->_meta['fields'][$i]["id"];
		}

		// Add the Meta Box
		add_action('add_meta_boxes', array(&$this, 'add')); 
		// Save the Data
		add_action('save_post', array(&$this, 'save'));  
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
	        echo '<tr><th>';
	        	jelli_fields::label($field['id'],$field['label']);
	        echo '</th><td>';  
				jelli_fields::field($field,$meta);
				echo '<br />';
				jelli_fields::description($field['desc']);  
	        echo '</td></tr>';  
	    } // end foreach  
	    echo '</table>'; // end table
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
}// end class
?>