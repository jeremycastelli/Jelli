<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for admin
/*-----------------------------------------------------------------------------------*/
class jelli_admin
{
	public function jelli_admin()
	{
	
		// Remove notifications for non admins
		$this->remove_notifications();
		
		// Add custom post types pages to the dropdown menus in options > read > front page
		add_filter( 'get_pages', array(&$this, 'add_cpt_to_dropdown'));
		
		// Change the message in the admin footer
		add_filter( 'admin_footer_text',  array(&$this, 'change_admin_footer'));
		
		// Remove the link menu
		add_action( 'admin_menu', array(&$this,'remove_link_menu') );
		
		// No self ping
		add_action( 'pre_ping', array(&$this, 'no_self_ping' ));
	
		// Enable more buttons in tinyMCE
		add_filter('mce_buttons',  array(&$this, 'enable_more_buttons'));
	}
	
	
	function remove_notifications()
	{
		global $user_login;
		get_currentuserinfo();
		if ($user_login !== "admin") 
		{
			add_action( 'init', array( &$this,'remove_wp_check' ) );
			add_filter( 'pre_option_update_core', array( &$this,'return null' ) );
		}
	}
	function remove_wp_check()
	{
		remove_action( 'init', 'wp_version_check' );
	}
	function return_null()
	{
		return null;
	}


	function add_cpt_to_dropdown( $pages)
	{
		$cpt = get_posts(array('post_type' => 'portfolio'));
		$pages = array_merge($pages, $cpt);
	    return $pages;
	}


	function change_admin_footer() 
	{
     	echo 'Créé par <a href="http://www.jelli.com">Jeremy Castelli</a>';
	}
	
	
	function remove_link_menu() 
	{
	     remove_menu_page('link-manager.php');
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
	
}
$jelli_admin = new jelli_admin();
?>