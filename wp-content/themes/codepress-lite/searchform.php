<section class="search clearfix">
        <div class="form-wrapper">
             <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_html_e("Search","codepress-lite")?>" class="search-field">
                <button name="submit" class="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
</section>