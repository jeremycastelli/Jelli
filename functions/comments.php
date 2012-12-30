<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for comments
/*-----------------------------------------------------------------------------------*/
class jelli_comments
{
	public function jelli_comments()
	{
		// Enable threaded comments
		add_action('get_header', array(&$this,'enable_threaded_comments'));
	}
		
	
	function enable_threaded_comments()
	{
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
		{
			wp_enqueue_script('comment-reply');
		}
    }
}
$jelli_comments = new jelli_comments();
?>