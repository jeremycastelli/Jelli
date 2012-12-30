<?php
/*-----------------------------------------------------------------------------------*/
/* Functions for menus
/*-----------------------------------------------------------------------------------*/
class jelli_menu
{
	public function jelli_menu()
	{
		register_nav_menu( 'principal', 'Menu Principal' );
		
		
	  	// Add class 'menu-item-first' to the first element in the menu and class 'menu-item-last' to the last element
		add_filter ('wp_nav_menu', array(&$this,'addFirstLastClass'));
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
$jelli_menu = new jelli_menu();
?>