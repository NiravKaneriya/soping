<?php
/**
* The template for displaying search results pages.
*
*/

get_header(); ?>
<div class="search-container">
    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="search-page-form" id="ss-search-page-form"><?php get_search_form(); ?></div>

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <span class="search-page-title"><?php printf( esc_html__( 'Search Results for: %s', stackstar ), '<span>' . get_search_query() . '</span>' ); ?></span>
                </header><!-- .page-header -->

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="result_list">
                    <span class="search-post-title"><?php the_title(); ?></span>
                    <span class="search-post-excerpt"><?php the_excerpt(); ?></span>
                    <span class="search-post-link"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></span>
                </div>
                <?php endwhile; ?>

            <?php else : ?>
                <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
                <div class="alert alert-info">
                    <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                </div>

            <?php endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>