<form role="search" method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>">
	<div>
		<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
		<input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="¿Qué estás buscando?" />
		<label class="search-btn">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_x( 'Search', 'submit button' ); ?>" />
			<i class="fa fa-search"></i>
		</label>
	</div>
</form>