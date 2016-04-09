<?php get_header(); ?>
	<?php if (have_posts()) : ?> 
		<?php while (have_posts()) : the_post(); ?>

		<article>
			<header>
				<h1><?php the_title(); ?></h1>
			</header>

			<?php the_content(); ?>

			<footer>
				<p><?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>
			</footer>
			<?php comments_template(); ?>
		</article>

		<?php endwhile; ?>
		 
	<?php else : ?>
	<?php endif; ?>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>