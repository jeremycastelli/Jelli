<?php 

function get_jelli_block($value='')
{
	$posts = get_posts(array('name' => $value, 'post_type' => 'jelli_block', 'post_status' => 'publish', 'numberposts' => 1));
	//$post_id = $posts[0]->ID;
	$content = $posts[0]->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
function jelli_block($value='')
{
	echo get_jelli_block($value);
}


class jelli_blocks{

	function jelli_blocks(){
		add_action( 'init', array($this,'register_block_type'));
	}

	function register_block_type(){
		$args = array(  
			'labels' => array(
				'name' => __( 'Blocs texte' ),
				'singular_name' => __( 'Bloc texte' )
			),
			'public' => true,
			'show_in_menu' => true,
			'capability_type' => 'page',
			'has_archive' => false,
			'rewrite' => false,  
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
		);
		register_post_type( 'jelli_block' , $args );
	}
}
?>