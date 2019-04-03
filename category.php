<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>


    <div class="banner_inner" style="background:url(<?= get_the_post_thumbnail_url(); ?>) center center / cover no-repeat fixed;">
        <div class="overlay_banner">
            <div class="container">
                <h1><?php echo single_cat_title( '', false ); ?></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row bloglisting">
            <div class="col-md-8">
                <?php
                $cat_name = single_cat_title( '', false );
                $args = array(
                    'category_name' => $cat_name,
                    'posts_per_page' => 5,
                    'paged' => $paged
                );
                $wp_query = new WP_Query(); $wp_query->query($args);
                while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <div class="list_blog">
                        <h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>
                        <ul class="blog-meta">
                            <li><i class="fa fa-user"></i><?php echo esc_html( get_the_author() ); ?></li>
                            <li><i class="fa fa-clock-o"></i><?php echo esc_html ( get_the_date() ); ?></li>
                            <li><i class="fa fa-tags"></i><?php $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo esc_html( $categories[0]->name );
                                } ?></li>
                        </ul>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" title="Read more" class="main-btn">Read More</a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="col-md-4 sidebar_post">
                <?php dynamic_sidebar('post_sidebar'); ?>
            </div>
        </div>
    </div>




    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">


            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
    <style>
        .list_blog h2 {
            font-size: 21px;
        }
        .blog-meta li {
            display: inline-block;
            margin-right: 15px;
        }
        .blog-meta li i {
            margin-right: 10px;
        }
        .list_blog {
            margin-bottom: 30px;
        }
    </style>
<?php get_footer();
