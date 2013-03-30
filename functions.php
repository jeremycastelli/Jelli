<?php
/**
 * Functions
 */


/**
 * constant
 **/
define('PATH', STYLESHEETPATH);
define('FUNCTIONS_PATH', PATH . '/functions/');

// Requires
require_once (FUNCTIONS_PATH . 'base.php');


// init
$jelli_base = new jelli_base();
$jelli_shortcodes = new jelli_shortcodes();
$jelli_login = new jelli_login();
$jelli_blocks = new jelli_blocks();


/**
 * Menus
 */
register_nav_menu( 'principal', 'Menu Principal' );


/**
 * Define images size
 */
add_image_size( "slider", 980, 518, true );


function jelly_sidebars()
{
	/*
	$args = array(
		'name'          => __( 'Footer sidebar', 'jelli' ),
		'id'            => 'footer-sidebar',
		'description'   => 'footer zone',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' );
	register_sidebar( $args );
	*/
}


/**
 * Define custom post types
 * the call to this function is made when necessary by jelli_base object.
 */
function jelli_post_types()
{
	$args = array(  
		'labels' => array(
			'name' => __( '' ),
			'singular_name' => __( '' )
		),
		'public' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'has_archive' => true,
		'rewrite' => true,  
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
	);
	register_post_type( '' , $args );

	
}

/**
 *  DEfine custom taxonomies
 *  the call to this function is made when necessary by jelli_base object.
 */
function jelli_taxonomies()
{
	$args = array(  
		'labels' => array(
			'name' => __( '' ),
			'singular_name' => __( '' )
		),
		'hierarchical' => true,
		'show_admin_column' => true,
		
	);
	register_taxonomy( '', array('post'), $args );


}

/**
 * Define meta boxes
 * the call to this function is made when necessary by metaboxes.php.
 * use value with meta_{id}
 */
function jelli_meta_boxes()
{
	$args = array(
		'id' => '',
		'title' => 'I',
		'pages' => array('post'), // multiple post types
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(  
			array(  
				'type'  => 'textfield', // textfield, textarea, checkbox, date, slider, image
			    'label'=> '',  
			    'desc'  => '',  
			    'id'    => ''  
			),
			array(  
				'type'  => 'radio', // select, radio
			    'label'=> '',  
			    'desc'  => '',  
			    'id'    => '',  
			    'options' => array (  
			        'one' => array (  
			            'label' => '',  
			            'value' => ''  
			        ),  
			        'two' => array (  
			            'label' => '',  
			            'value' => ''  
			        )
			        
			    )  
			)
    	)
    ); 
    jelli_register_meta_box($args); 

}

?>