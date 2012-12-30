<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for menus
/*-----------------------------------------------------------------------------------*/
class jelli_social
{
	public function jelli_social()
	{
		add_action( 'wp_head', array(&$this,'opengraph_for_posts' ));
	}
	function opengraph_for_posts() {
		if ( is_singular() ) {
			global $post;
			setup_postdata( $post );
			$output = '<meta property="og:type" content="article" />' . "\n";
			$output .= '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '" />' . "\n";
			$output .= '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
			$output .= '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '" />' . "\n";
			if ( has_post_thumbnail() ) {
				$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				$output .= '<meta property="og:image" content="' . $imgsrc[0] . '" />' . "\n";
			}
			echo $output;
		}
	}
	/**
	 * Display a pinterest button
	 * ajouter <script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script> dans le footer
	 * @return null
	 */
	function pinterest_button()
	{
		global $post;
		setup_postdata( $post );
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
		$output= '<a href="http://pinterest.com/pin/create/button/?url=' . the_permalink() . '&media=' . $thumb['0'] . '&description=' . the_title() .'" class="pin-it-button" count-layout="horizontal">Pin It</a>';
		echo $output;
	}
}
$jelli_social = new jelli_social();
?>