<?php

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="help">
    	<p class="nocomments"><?php _e('Cet article est protŽgŽ par un mot de passe.','jelli') ?></p>
  	</div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<div id="comments">
	<?php if ( have_comments() ) : ?>
	
		<h3><?php comments_number(__('pas de commentaire','jelli'), __('1 commentaire','jelli'), __('% commentaires','jelli'));?></h3>	
		<ol class="commentlist">
			<?php wp_list_comments(); ?>
		</ol>
		<?php else : // this is displayed if there are no comments so far ?>
	
		<?php if ( comments_open() ) : ?>
	    	<!-- If comments are open, but there are no comments. -->
			<div><?php _e("Il n'y a pas encore de commentaires",'jelli') ?></div>
		<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Commentaires fermŽs','jelli')?></p>
		
		<?php endif; ?>
	
	<?php endif; ?>
</div>

<?php comment_form(); ?>