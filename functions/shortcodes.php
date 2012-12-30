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
	
		// Snapshot of a website using wordpress.com
		add_shortcode( 'email', array(&$this,'email_encode_'));

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

	
	function email_encode( $atts, $content ){
		return '<a href="'.antispambot("mailto:".$content).'">'.antispambot($content).'</a>';
	}

	
}// end class
$jelli_shortcodes = new jelli_shortcodes();
?>