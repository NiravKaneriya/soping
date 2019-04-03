<?php
/*
* Template Name: Blog Page
*
* */
?>

<?php get_header(); ?>
    <div class="banner_inner" style="background:url(<?= get_the_post_thumbnail_url(); ?>) center center / cover no-repeat fixed;">
        <div class="overlay_banner">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row bloglisting">
            <div class="col-md-8">
            <?php
            $temp = $wp_query; $wp_query= null;
            $wp_query = new WP_Query(); $wp_query->query('posts_per_page=5' . '&paged='.$paged);
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

            <?php if ($paged > 1) { ?>

                <nav id="nav-posts">
                    <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
                    <div class="next"><?php previous_posts_link('Newer Posts &raquo;'); ?></div>
                </nav>

            <?php } else { ?>

                <nav id="nav-posts">
                    <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
                </nav>

            <?php } ?>

            <?php wp_reset_postdata(); ?>
            </div>
            <div class="col-md-4 sidebar_post">
                <?php dynamic_sidebar('post_sidebar'); ?>
            </div>
        </div>
    </div>

<?php get_footer();
