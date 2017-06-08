<?php
/**
 * @package Bizgrowth
 */
?>
 <div class="blog_lists">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">           
            <h3><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            <?php if ( 'post' == get_post_type() ) : ?>
                <div class="postmeta">
                    <div class="post-date"><?php echo get_the_date(); ?></div><!-- post-date -->
                    <div class="post-comment"> &nbsp;|&nbsp; <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
                    <div class="post-categories"> &nbsp;|&nbsp; <?php esc_attr_e('Category:','bizgrowth'); ?> <?php the_category( esc_attr__( ', ', 'bizgrowth' )); ?></div>                  
                </div><!-- postmeta -->
            <?php endif; ?>
        </header><!-- .entry-header -->
         <?php if (has_post_thumbnail() ){ ?>
			<div class="post-thumb">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php }  ?>   
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
           	<?php the_excerpt(); ?>
            <a class="ReadMore" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e('Read More &raquo;','bizgrowth'); ?></a>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( esc_attr__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bizgrowth' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_attr__( 'Pages:', 'bizgrowth' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
        <div class="clear"></div>
    </article><!-- #post-## -->
</div><!-- blog-post-repeat -->