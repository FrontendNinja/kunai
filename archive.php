<?php get_header(); ?>

		<div id="main-content" role="main">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<h1>
							<?php if (is_category()) { ?> <span><?php _e( 'Categoría:', 'NuevaWeb' ); ?></span> <?php single_cat_title(); ?>
							<?php } elseif (is_tag()) { ?> <span><?php _e( 'Tag:', 'NuevaWeb' ); ?></span> <?php single_tag_title(); ?>
							<?php } elseif (is_author()) { global $post; $author_id = $post->post_author; ?><span><?php _e( 'Publicado por:', 'NuevaWeb' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>
							<?php } elseif (is_day()) { ?><span><?php _e( 'Archivos por día:', 'NuevaWeb' ); ?></span> <?php the_time('l, F j, Y'); ?>
							<?php } elseif (is_month()) { ?><span><?php _e( 'Archivos por mes:', 'NuevaWeb' ); ?></span> <?php the_time('F Y'); ?>
							<?php } elseif (is_year()) { ?><span><?php _e( 'Archivos por año:', 'NuevaWeb' ); ?></span> <?php the_time('Y'); ?>
							<?php } ?>
						</h1>

						<?php if (have_posts()) : ?> 
							<?php while (have_posts()) : the_post(); ?>

								<article role="article">
									<div class="row">
										<?php if(has_post_thumbnail()): ?>
											<div class="col-sm-4">
												<?php the_post_thumbnail( 'medium' ); ?>
											</div>
										<?php endif; ?>
										<div class="<?php has_post_thumbnail() ? 'col-sm-8':'col-sm-12' ?>">
											<header>
												<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											</header>
											<?php the_excerpt(); ?>

											<?php if(function_exists( 'nw_tags' ) && nw_tags()): ?>
												<footer class="tags">
													<p>Tags: <?php echo nw_tags(); ?></p>
												</footer>
											<?php endif; ?>
										</div><!-- /.col-sm-8 -->
									</div>

								</article>
							<?php endwhile; ?>

							<?php if ( function_exists( 'nw_paginate_links' ) ) { ?>
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
							<p>No se encontró nada.</p>
						<?php endif; ?>
					</div><!-- /.col-sm-10 col-sm-offset-1 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- #main-content -->

<?php get_footer(); ?>
