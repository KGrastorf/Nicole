<?php
/**
 * @package Oner
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	$single_featured_image = get_theme_mod( 'single_featured_image',true );
	$single_featured_image_size = get_theme_mod ('single_featured_image_size','1');
	if ( $single_featured_image && has_post_thumbnail() ) :
		 if ( $single_featured_image_size == '1' ) :?>
		 		<div class="post-thumb">
		 <?php  if( has_post_thumbnail() && ! post_password_required() ) :   
					the_post_thumbnail('oner-blog-large-width'); 
				
				endif;?>
				</div><?php
			 else: ?>
			 	<div class="post-thumb"><?php
			 	if( has_post_thumbnail() && ! post_password_required() ) :   
						the_post_thumbnail('oner-small-featured-image-width');
				
				endif;?>
				</div><?php
		endif; 
	endif ?>

	<header class="entry-header"> 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
				<span class="date-structure">				
					<span class="dd"><?php the_time('F j, Y'); ?></span>
				
				</span>
				<?php oner_author(); ?>
				<?php oner_edit() ?>
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
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

	<?php oner_post_nav(); ?>
</article><!-- #post-## -->
