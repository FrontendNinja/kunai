<?php get_header(); ?>

	<?php if (have_posts()) : // Show latest posts as default ?>
		
		<?php while (have_posts()) : the_post(); ?>
			<article>
				<header>
					<?php the_title('<h2>','</h2>'); ?>
				</header>

				<?php the_excerpt(); ?>

				<footer>
					<?php the_tags('',',',''); ?>
				</footer>
			</article>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

	<?php endif;?>


<?php get_footer(); ?>