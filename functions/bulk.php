<?php
	require_once (FUNCTIONS_PATH . '/helpers/social.php');
	
	function jelli_ga($value='')
	{
		if($value=='' || $value='UA-XXXXX-XX')
			return;
		echo "<script>
			var _gaq=[['_setAccount','".$value."'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>";
	}
	

?>