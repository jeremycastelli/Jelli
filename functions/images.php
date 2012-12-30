<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for images
/*-----------------------------------------------------------------------------------*/
class jelli_images
{
	public function jelli_images()
	{
	
		// deactivate image captions  
		add_filter('disable_captions', '__return_true');
	
		// Remove p tags on images
		add_filter('the_content', array(&$this,'filter_ptags_on_images'));
		
		// qualitŽ de compression des images
		//add_filter('jpeg_quality', function($arg){return 100;});
		
		// post thumbnail support
		add_theme_support( 'post-thumbnails' );
		
		// add image size
		add_image_size( "image-block", 270, 181, true );
	}
	
	

	function filter_ptags_on_images($content){
    	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
}
$jelli_images = new jelli_images();
?>