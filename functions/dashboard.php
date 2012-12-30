<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for dashboard
/*-----------------------------------------------------------------------------------*/
class jelli_dashboard
{
	public function jelli_dashboard()
	{
		// Remove various items from dashboard.
		add_action('wp_dashboard_setup', array(&$this,'my_custom_dashboard_widgets'));
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
	
}

$jelli_dashboard = new jelli_dashboard();
?>