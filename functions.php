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
register_nav_menu( 'secondaire', 'Menu Secondaire' );
register_nav_menu( 'footer', 'Menu Footer' );


/**
 * Define images size
 */
add_image_size( "slider", 980, 518, true );
add_image_size( "envies", 274, 270, true );
add_image_size( "nouveautes", 180, 165, true );
add_image_size( "liste", 228, 207, true );
add_image_size( "fiche-grand", 594, 338, true );
add_image_size( "fiche-vignette", 47, 47, true );


function jelly_sidebars()
{
	/*
	$args = array(
		'name'          => __( 'Footer sidebar', 'jelli' ),
		'id'            => 'footer-sidebar',
		'description'   => ' zone du footer',
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
			'name' => __( 'Produit' ),
			'singular_name' => __( 'Produits' )
		),
		'public' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'has_archive' => true,
		'rewrite' => true,  
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
	);
	register_post_type( 'produits' , $args );

	
}

/**
 *  DEfine custom taxonomies
 *  the call to this function is made when necessary by jelli_base object.
 */
function jelli_taxonomies()
{
	$args = array(  
		'labels' => array(
			'name' => __( 'Secteur' ),
			'singular_name' => __( 'Secteurs' )
		),
		'hierarchical' => true,
		'show_admin_column' => true,
		
	);
	register_taxonomy( 'secteurs', array('produits'), $args );

	$args = array(  
		'labels' => array(
			'name' => __( 'Type de bien' ),
			'singular_name' => __( 'Types de biens' )
		),
		'hierarchical' => true,
		'show_admin_column' => true,
		
	);
	register_taxonomy( 'types_de_biens', array('produits'), $args );

	$args = array(  
		'labels' => array(
			'name' => __( 'Envie' ),
			'singular_name' => __( 'Envies' )
		),
		'hierarchical' => true,
		'show_admin_column' => true,
		
	);
	register_taxonomy( 'envies', array('produits'), $args );
}

/**
 * Define meta boxes
 * the call to this function is made when necessary by metaboxes.php.
 * use value with meta_{id}
 */
function jelli_meta_boxes()
{
	$args = array(
		'id' => 'infos_produits',
		'title' => 'Informations sur le bien',
		'pages' => array('produits'), // multiple post types
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(  
			array(  
				'type'  => 'textfield', // textfield, textarea, checkbox, date, slider, image
			    'label'=> 'Référence',  
			    'desc'  => '',  
			    'id'    => 'reference'  
			),
			array(  
				'type'  => 'radio', // select, radio
			    'label'=> 'Type de recherche',  
			    'desc'  => '',  
			    'id'    => 'type_recherche',  
			    'options' => array (  
			        'one' => array (  
			            'label' => 'Vente',  
			            'value' => 'vente'  
			        ),  
			        'two' => array (  
			            'label' => 'Location',  
			            'value' => 'location'  
			        )
			        
			    )  
			),

			array(  
				'type'  => 'checkbox', // textfield, textarea, checkbox, date, slider, image
			    'label'=> 'Mise en avant home page',  
			    'desc'  => "Cocher pour mettre le bien en avant sur le slider de la home page",  
			    'id'    => 'slider'  
			),
			array(  
				'type'  => 'checkbox', // textfield, textarea, checkbox, date, slider, image
			    'label'=> 'Mise en avant nouveautés',  
			    'desc'  => 'Cocher pour mettre le bien en avant dans la zone "nouveautés" de la home page',  
			    'id'    => 'nouveaute'  
			),

			array(  
				'type'  => 'textfield', // textfield, textarea, checkbox, date, slider, image
			    'label'=> 'Prix',  
			    'desc'  => "En € FAI, si le prix n'est pas indiqué, 'Nous contacter' sera affiché sur le site",  
			    'id'    => 'prix'  
			),
			array(  
				'type'  => 'textfield', // textfield, textarea, checkbox, date, slider, image
			    'label'=> 'Surface',  
			    'desc'  => 'En metre carré',  
			    'id'    => 'surface'  
			),
			array(  
				'type'  => 'select', // select, radio
			    'label'=> 'Macaron',  
			    'desc'  => '',  
			    'id'    => 'macaron',  
			    'options' => array (  
			        'one' => array (  
			            'label' => 'Aucun',  
			            'value' => ''  
			        ),  
			        'two' => array (  
			            'label' => 'Nouveauté',  
			            'value' => 'new'  
			        ),  
			        'three' => array (  
			            'label' => 'Vendu',  
			            'value' => 'vendu'  
			        )
			    )  
			),
			array(  
				'type'  => 'textfield', // textfield, textarea, checkbox, date, slider, image
			    'label'=> 'Consomation energetique',  
			    'desc'  => "kWhEP/m2.an",  
			    'id'    => 'energie'  
			),
    	)
    ); 
    jelli_register_meta_box($args); 

}

?>