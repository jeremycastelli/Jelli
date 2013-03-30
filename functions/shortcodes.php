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
		add_shortcode( 'email', array(&$this,'email_encode'));

		// Videos
		add_shortcode("vimeo", array(&$this,'vimeo'));
		add_shortcode("youtube", array(&$this,'youtube'));

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
	function vimeo( $atts, $content = null ) {
		extract( shortcode_atts( array( 
	    "id" => '', 
	    "height" => '280',
	    "width" => '500'
	    ), $atts ) );
	    return '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>';
	}
	function youtube( $atts, $content = null ) {
		extract( shortcode_atts( array( 
	    "id" => '', 
	    "height" => '280',
	    "width" => '500'
	    ), $atts ) );
	    return '<iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	
}// end class
?>