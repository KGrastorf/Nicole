<form role="search" method="get" class="search-form" action="<?php  echo esc_url(site_url());  ?>"> 
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for: ', 'codepress-corporate'); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'codepress-corporate' ); ?>" value="<?php echo the_search_query(); ?>" name="s">
	</label>
	<span><a class="search_submit"> <i class="fa fa-search"></i></a></span>
</form>
