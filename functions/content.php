<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for content
/*-----------------------------------------------------------------------------------*/
class jelli_content
{
	public function jelli_content()
	{
		// No more jumping for read more link
		add_filter('excerpt_more', array(&$this, 'read_more_without_jump'));
		
		// Define number of articles by type of page
		//add_filter('pre_get_posts', array(&$this,'per_page'));
		
		// Add exerpt to pages
		add_post_type_support( 'page', 'excerpt' );
	}
	
	
	
		
	function read_more_without_jump($post) 
	{
		return '<a href="'.get_permalink($post->ID).'" class="read-more">'.__('lire la suite','jelli').'</a>';
    }
    
    function per_page($query) 
    {
		if ( $query->is_paged )
			$query->query_vars['posts_per_page'] = 10;
		if ( $query->is_search )
			$query->query_vars['posts_per_page'] = 10;
		if ( $query->is_archive )
			$query->query_vars['posts_per_page'] = 10;
		if ( $query->is_category )
			$query->query_vars['posts_per_page'] = 10;
		if ( $query->is_tag )
			$query->query_vars['posts_per_page'] = 10;
			
		
		return $query;
	}

    
}// end class
$jelli_content = new jelli_content();
?>