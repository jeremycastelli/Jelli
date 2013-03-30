<?php
/**
* jelli_social
*/
class jelli_social
{
	/* Display a pinterest button
	 * ajouter <script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script> dans le footer
	 * @return null
	 */
	public static function pinterest_button()
	{
		global $post;
		setup_postdata( $post );
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
		$output= '<a href="http://pinterest.com/pin/create/button/?url=' . the_permalink() . '&media=' . $thumb['0'] . '&description=' . the_title() .'" class="pin-it-button" count-layout="horizontal">Pin It</a>';
		echo $output;
	}
}

?>