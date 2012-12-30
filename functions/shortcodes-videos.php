<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for shorcode videos
/*-----------------------------------------------------------------------------------*/
class jelli_shortcodes_videos
{
	public function jelli_shortcodes_images()
	{
		// Snapshot of a website using wordpress.com
		add_shortcode("vimeo", array(&$this,'vimeo'));
		add_shortcode("youtube", array(&$this,'youtube'));
	}
	

	function vimeo( $atts, $content = null ) {
		extract( shortcode_atts( array( 
	    "id" => '', 
	    "height" => '280',
	    "width" => '500'
	    ), $atts ) );
	    return '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>';
	}

	
	function youtube_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array( 
	    "id" => '', 
	    "height" => '280',
	    "width" => '500'
	    ), $atts ) );
	    return '<iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?rel=0" frameborder="0" allowfullscreen></iframe>';
	}	


}// end class
$jelli_shortcodes_videos = new jelli_shortcodes_videos();
?>