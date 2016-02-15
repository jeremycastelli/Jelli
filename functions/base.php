<?php


require_once (FUNCTIONS_PATH . '/admin/metaboxes.php');
require_once (FUNCTIONS_PATH . 'shortcodes.php');
require_once (FUNCTIONS_PATH . 'login.php');
require_once (FUNCTIONS_PATH . '/helpers/blocks.php');

/*-----------------------------------------------------------------------------------*/
/* Functions for images
/*-----------------------------------------------------------------------------------*/
class jelli_base
{
	public function jelli_base(){

		/**
		 *  LANGUAGE & LOCALIZATION
		 */
		//load the text domain for localization
		add_action('after_theme_setup', array(&$this,'load_domain'));

		/*
		 * SCRIPTS
		 */
		add_action( 'wp_enqueue_scripts', array(&$this,'enqueue_scripts'));

		/**
		 *  IMAGES
		 */
		// post thumbnail support
		add_theme_support( 'post-thumbnails' );
		// deactivate image captions  
		add_filter('disable_captions', '__return_true');
		// Remove p tags on images
		add_filter('the_content', array(&$this,'filter_ptags_on_images'));
		// qualité de compression des images
		//add_filter('jpeg_quality', function($arg){return 100;});
		
		
		/**
		 *  WIDGETS		
		 */
		// Unregister default widgets
		add_action('widgets_init', array(&$this,'unregister_default_widgets'));
		// shortcodes in widgets
		if ( !is_admin() )
		{
			add_filter('widget_text', 'do_shortcode', 11);
			add_filter('widget_text', 'shortcode_unautop');
		}


		/**
	     * SIDEBARS
		 */
		if (function_exists('jelly_sidebars')){
			add_action( 'widgets_init', 'jelly_sidebars' );
		}


		/**
		 * CUSTOM POST TYPES 
		 */
		add_post_type_support( 'page', 'excerpt' );
		add_action( 'init', 'jelli_post_types' );
		

		/**
		 *  CUSTOM TAXONOMIES
		 */
		add_action( 'init', 'jelli_taxonomies');
		
		/**
		 * ADMIN TWEAKS
		 */
		// Change the message in the admin footer
		add_filter( 'admin_footer_text',  array(&$this, 'change_admin_footer'));
		// No self ping
		add_action( 'pre_ping', array(&$this, 'no_self_ping' ));
		// Enable more buttons in tinyMCE
		add_filter('mce_buttons',  array(&$this, 'enable_more_buttons'));


		/**
		 * DIVERS
		 */
		//hide version number
		remove_action('wp_head', 'wp_generator');
		// remove windows live writer support
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action ('wp_head', 'rsd_link');
		// Remove notifications for non admins
		$this->remove_notifications();
		// Remove various items from dashboard.
		add_action('wp_dashboard_setup', array(&$this,'my_custom_dashboard_widgets'));
		// Add class 'menu-item-first' to the first element in the menu and class 'menu-item-last' to the last element
		add_filter ('wp_nav_menu', array(&$this,'addFirstLastClass'));

		
	}
	function load_domain() {
		$lang_dir = get_template_directory() . '/lang';
		load_theme_textdomain('jelli', $lang_dir);
	}
	function enqueue_scripts() {
		wp_enqueue_script( 'modernizr' , get_template_directory_uri().'/js/libs/modernizr.js', false, null);
		wp_deregister_script( 'jquery' );
		// on verifie si l'api google est accessible mais sans prendre trop de ressources grace aux transient
		$jquery_url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js';			 
		
		if (get_transient('google_jquery') == false) {
			$resp = wp_remote_head($jquery_url);
			if (!is_wp_error($resp) && 200 == $resp['response']['code']) {
				set_transient('google_jquery', true, 60 * 5);
			} 
			else {
				set_transient('google_jquery', false, 60 * 5);		
				$jquery_url = get_template_directory_uri().'/js/libs/jquery.min.js';
			}
		}	
		wp_enqueue_script( 'jquery' , $jquery_url, false, null, true); // include jQuery
		wp_enqueue_script('script', get_template_directory_uri().'/js/script-ck.js',array( 'jquery' ),null,true);
	}
	function filter_ptags_on_images($content){
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
	function unregister_default_widgets() 
	{
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		//unregister_widget('WP_Widget_Search');
		//unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
	}
	function remove_notifications()
	{
		global $user_login;
		get_currentuserinfo();
		if ($user_login !== "admin") 
		{
			add_action( 'init', array( &$this,'remove_wp_check' ) );
			add_filter( 'pre_option_update_core', '__return_null' );
		}
	}
	function remove_wp_check()
	{
		remove_action( 'init', 'wp_version_check' );
	}
	function change_admin_footer() 
	{
		echo 'Créé par <a href="http://www.jeremycastelli.com">Jeremy Castelli</a>';
	}
	function no_self_ping( &$links ) 
	{
		$home = get_option( 'home' );
		foreach ( $links as $l => $link )
			if ( 0 === strpos( $link, $home ) )
				unset($links[$l]);
	}
	function enable_more_buttons($buttons) {
		$buttons[] = 'hr';
		/* 
		Repeat with any other buttons you want to add, e.g.
		  $buttons[] = 'fontselect';
		  $buttons[] = 'sup';
		*/	
		return $buttons;
	}
	function my_custom_dashboard_widgets() 
	{
		global $wp_meta_boxes;
		
		//Right Now
		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	
		//Recent Comments
		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	
		//Incoming Links
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	
		//Plugins - Popular, New and Recently updated WordPress Plugins
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	
		//Wordpress Development Blog Feed
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	
		//Other WordPress News Feed
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	
		//Quick Press Form
		//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	
		//Recent Drafts List
		//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	}
	function addFirstLastClass($pageList) {  
		// pattern to focus on just lis  
		$allLisPattern = '/<li(.*)<\/li>/s';  
		preg_match($allLisPattern,$pageList,$allLis);  
		$liClassPattern =  "/<li[^>]+class=\"([^\"]+)/i";  

		// first let's break out each li  
		$liArray = explode("\n", $allLis[0]);  

		// count to get last li  
		$liArrayCount = count($liArray);  

		preg_match($liClassPattern, $liArray[0], $firstMatch);  
		$newFirstLi = str_replace($firstMatch[1], $firstMatch[1] . " first-menu-item", $liArray[0]);  

		if($liArrayCount > 1){  
		$lastLiPosition = $liArrayCount - 1;  

		preg_match($liClassPattern, $liArray[$lastLiPosition], $lastMatch);  
		$newFirstLi = str_replace($firstMatch[1], $firstMatch[1] . " first-menu-item", $liArray[0]);  
		$newLastLi = str_replace($lastMatch[1], $lastMatch[1] . " last-menu-item", $liArray[$lastLiPosition]);  
		}  

		// replace first and last of the li array with new lis  
		// rebuild newPageList  
		// set first li  
		$newPageList = $newFirstLi . ''; 
		$i = 1; 
		while ($i < $lastLiPosition) { 
		$newPageList .= $liArray[$i]; 
		$i++; 
		} 
		// set last li 
		$newPageList .= $newLastLi; 

		// lastly, replace old list with new list 
		$pageList = str_replace($allLis[0], $newPageList, $pageList); 
		return $pageList; 
	}
}
?>