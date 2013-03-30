<?php
/**
 * Footer
 */
?>
			<footer class="footer" role="contentinfo">
			
				<?php get_sidebar(); ?>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
		
		<!-- Change UA-XXXXX-X to be your site's ID -->
		  <script>
			/*
			var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
			*/
		  </script>

		 
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>