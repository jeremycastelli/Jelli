<?php get_header(); ?>
			
			<div id="main" class="main" role="main">
				
				<section id="content" class="content">
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="article-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
						
						<header class="article-header">
							
							<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
							<p class="meta"><?php _e('Ecrit le','jelli') ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('j F Y'); ?> </time><?php _e('par','jelli') ?> <?php the_author_posts_link(); ?> | <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<div class="article-header">
							<?php the_content(__('lire la suite','jelli')); ?>
					
						</div> <!-- end article section -->
						
						<footer class="article-footer">
			
							<p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if experimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="prev-next">		
							<div class="prev-link"><?php next_posts_link(_e('&laquo; precedent', 'jelli')) ?></div>
							<div class="next-link"><?php previous_posts_link(_e('suivant &raquo;', 'jelli')) ?></div>
						</nav>
					<?php } ?>		
					
					<?php endif; ?>
					
					
				</section><!-- end #content -->
				<?php get_sidebar("side");?>
				
			</div> <!-- end #main -->
    
				
    
			

<?php get_footer(); ?>