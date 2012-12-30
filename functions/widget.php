<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for widgets and sidebars
/*-----------------------------------------------------------------------------------*/
class jelli_widget
{
	
	public function jelli_widget()
	{
		// Register sidebars
		add_action( 'widgets_init', array(&$this, 'register_sidebars' ));
		
		// Unregister default widgets
		add_action('widgets_init', array(&$this,'unregister_default_widgets'));
		
		// shortcodes in widgets
		if ( !is_admin() )
		{
	        add_filter('widget_text', 'do_shortcode', 11);
			add_filter('widget_text', 'shortcode_unautop');
	    }
	}
	

	function register_sidebars() {
	    register_sidebar(array(
	    	'id' => 'side',
	    	'name' => __('Sidebar','jelli'),
	    	'description' => __('Sidebar zone','jelli'),
	    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    	'after_widget' => '</div>',
	    	'before_title' => '<h4 class="widgettitle">',
	    	'after_title' => '</h4>',
	    ));

		register_sidebar(array(
	    	'id' => 'foot',
	    	'name' => __('Footer','jelli'),
	    	'description' => __('Footer zone','jelli'),
	    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    	'after_widget' => '</div>',
	    	'before_title' => '<h4 class="widgettitle">',
	    	'after_title' => '</h4>',
	    ));
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
	} // end unregister_default_widgets()
	
}// end class
$jelli_widget = new jelli_widget();
?>