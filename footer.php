<?php
/**
 * Footer
 */
?>
			<footer id="footer" class=".footer" role="contentinfo">
			
				<?php get_sidebar( 'foot' ); ?>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>	
		<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
		
		<!-- Change UA-XXXXX-X to be your site's ID -->
		  <script>
		   // window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
		   // Modernizr.load({
		   // load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
		   // });
		  </script>

		  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
		       chromium.org/developers/how-tos/chrome-frame-getting-started -->
		  <!--[if lt IE 7 ]>
		    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		  <![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>