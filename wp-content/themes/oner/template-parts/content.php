<?php
/**
 * @package Oner
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		$featured_image = get_theme_mod( 'featured_image',true );
	    $featured_image_size = get_theme_mod ('featured_image_size','1');
		if( $featured_image && has_post_thumbnail() ) : 
		        if ( $featured_image_size == '1' ) :?>		
						<div class="post-thumb">
						  <?php	if( $featured_image && has_post_thumbnail() ) : 
								    the_post_thumbnail('oner-blog-full-width');
								 
			                     endif;?>
			            </div> <?php
		        else: ?>
		 	            <div class="post-thumb">
		 	                 <?php if( has_post_thumbnail() && ! post_password_required() ) :   
					               the_post_thumbnail('oner-small-featured-image-width');
								
								endif;?>
			             </div>  <?php				
	            endif; 
		endif; ?> 
 
		<header class="entry-header">  
			<div class="title-meta">
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<span class="date-structure">				
						<span class="dd"><?php the_time('F j, Y'); ?></span>			
					</span>
					<?php oner_author(); ?>
					<?php oner_edit() ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</div>
			<br class="clear">
	   </header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Read More', 'oner' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>
		
		</div><!-- .entry-content -->

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'oner' ),
				'after'  => '</div>',
			) );
		?>

		<?php if ( 'post' == get_post_type() ): ?>
			<footer class="entry-footer">
				<?php oner_entry_footer(); ?>
				<?php oner_comments_meta(); ?> 
			</footer><!-- .entry-footer -->
		<?php endif;?>

</article><!-- #post-## -->