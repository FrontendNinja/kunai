<?php get_header(); ?>

	<?php if (have_posts()) : ?> 
		<?php while (have_posts()) : the_post(); ?>

			<article>
				<header>
					<h3><?php the_title(); ?></a></h3>
				</header>

				<section>
						<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'NuevaWeb' ) . '</span>' ); ?>
				</section>

				<footer></footer>
			</article>
		<?php endwhile; ?>

		<?php if (function_exists('nw_paginate_links')) { ?>
			<?php nw_paginate_links(); ?>
		<?php } else { ?>
			<nav class="wp-prev-next">
				<ul class="clearfix">
					<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'NuevaWeb' )) ?></li>
					<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'NuevaWeb' )) ?></li>
				</ul>
			</nav>
		<?php } ?>

	<?php else : ?>

		<?php // A 404 answer goes here ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
