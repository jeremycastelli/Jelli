<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for comments
/*-----------------------------------------------------------------------------------*/
class jelli_login
{
	public function jelli_login()
	{
		// Change logo
		add_action('login_head',  array(&$this,'custom_logo'));
		
		// Change logo link url
		add_action('login_headerurl',  array(&$this,'change_url'));
		
		// Change logo link title
		add_action('login_headertitle',  array(&$this,'change_url_title'));
	}
	function custom_logo()
	{
		echo '<style type="text/css"> h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo_admin.png)  !important; } </style>';
	}
	function change_url()
	{
		return bloginfo('url');
	}
	function change_url_title()
	{
		return get_option('blogname');
	}
}
?>