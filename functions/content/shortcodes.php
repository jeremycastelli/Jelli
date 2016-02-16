<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for menus
/*-----------------------------------------------------------------------------------*/
class jelli_shortcodes
{
	public function jelli_shortcodes()
	{
		// Shortcode_empty_paragraph_fix
		add_filter('the_content', array(&$this,'shortcode_empty_paragraph_fix'));
	
		
		add_shortcode("col1", array(&$this,'col1'));
		add_shortcode("col2", array(&$this,'col2'));


		add_shortcode( 'new_shortcode', array(&$this,'new_shortcode'));

	}
	
	
    function shortcode_empty_paragraph_fix($content)
    {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );

        $content = strtr($content, $array);

		return $content;
    } 
    function col1( $atts, $content = null ) {
        return '<div class="col1">'.$content.'</div>';
    }
    function col2( $atts, $content = null ) {
        return '<div class="col2">'.$content.'</div>';
    }
	
	
    function new_shortcode( $atts, $content ){
    	extract( shortcode_atts( array( 
    		"key" => 'value'
    		
    	), $atts ) );
    	return '<div class="new_shortcode">'.$content.'</div>';
    }


	
}// end class
?>