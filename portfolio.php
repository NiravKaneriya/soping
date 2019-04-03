<?php
/*
* Template Name: PortFolio
*
* */

 get_header(); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800');
        body{
            font-family: 'Open Sans',sans-serif;
        }
        .portfolio_head
        {
            text-align: center;
            display: block;
            width:100%;
            margin:20px 0px;
        }
        .portfolio_head a
        {
            color:#888;
            display: inline-block;
            border:2px solid #fff;
            padding:10px 20px;
        }
        .portfolio_head a:hover,.portfolio_head a.active
        {
            color:#15314e;
            border:2px solid #ff8a3d;
            border-radius: 20px;
            text-decoration: none;
        }

        .portfolio_body
        {
            display:flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
			margin-bottom:50px;
        }

        .portfolio_box
        {
            width:325px;
            max-width: 100%;
            margin:15px;
            position: relative;

        }
        .modal {
            z-index: 10501111;
        }
        .portfolio_box .portfolio_img
        {
            width:100%;
            height:350px;
            object-fit:cover;
            border:2px solid #15314e;

        }

        .portfolio_box .portfolio_content
        {
            background:#15314e;
            color:#fff;
            padding:20px;
            padding-left: 60px;
            position: relative;
            margin-left: 25px;
            margin-top:-25px;


        }
        .portfolio_box .portfolio_content h2, .portfolio_box .portfolio_content h4
        {
            margin:10px 0px;;
        }
        .portfolio_box .portfolio_content h2
        {
            font-size:20px;
            color: #fff;
        }
        .portfolio_box .portfolio_content h4
        {
            font-size:14px;
            opacity: 0.6;
            font-weight: 700;
        }
        .portfolio_box .portfolio_content  a
        {
            position: absolute;
            top:0px;
            bottom:0px;
            margin:auto;
            width:50px;
            left:-25px;
            height: 50px;
            background:#fff;
            color:#15314e;
            font-size:20px;
            text-align: center;
            line-height: 50px;
            transition: all 2s ease-in-out;
        }
		.portfolio_box img
		{
			width:100%;
			height:325px;
			object-fit:cover;
		}
        .portfolio_box:hover
        {
            cursor: pointer;
        }
        .portfolio_box:hover .portfolio_content  a
        {
            left:0px;
            transition: all 0.5s ease-in-out;
        }
        .portfolio_box:hover .portfolio_content
        {
            background:#ff8a3d;
            color:#333;
        }
        .portfolio_box:hover img
        {
            border-color:#ff8a3d;
        }

        .portfolio_modal .modal-dialog
        {
            width:1170px;
            max-width: 100%;
        }
        .portfolio_modal .modal-content
        {
            background:#15314e;
            border-radius: 0;
            color:#fff;
        }
        .portfolio_titlee.text-left
        {

            text-align: left;

        }
        .portfolio_titlee.text-left:before
        {
            right: auto;
        }
        .portfolio_titlee
        {
            font-weight: 300;
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
        }
        .portfolio_titlee:before
        {
            content:"";
            background:#ffa727;
            height:2px;
            width:50px;
            position: absolute;
            left:0px;
            right:0px;
            bottom:0px;
            margin:auto;
        }
        .portfolio_starting_details
        {
            display:flex;
            padding:10px;
            justify-content: space-around;
            text-align: center;
        }
        .portfolio_starting_details p
        {
            opacity: 0.6;
        }

        .about_project
        {

            text-align: justify;
            padding:50px;
        }
        .bottom_details
        {
            display:flex;
            justify-content: space-around;
            align-content: center;
            padding:0px 50px;
        }
        .slider_images
        {
            min-width:500px;
            max-width: 100%;padding:50px;
        }
        .slider_images  img
        {
            max-width: 100%;
            width:400px;
        }
        .flex-control-thumbs li img.flex-active
        {
            border:2px solid #d3d3d3;
        }
        .flexslider .slides img
        {
            min-height:300px;
        }

        .close_button
        {
            position: absolute;
            top:20px;
            right:20px;
            z-index: 99;transition: all 1s ease-in-out;
        }
        .close_button:hover
        {
            transform:rotate(180deg);
            transition: all 1s ease-in-out;
        }
        .portfolio_box a {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
        #top-menu .menu-item-has-children > a:first-child::after {
            top: auto;
        }
        .nav > li > a:focus, .nav > li > a:hover {
            background-color: transparent;
        }
        .portfolio_box:hover .portfolio_content h2 {
            color: #333;
        }
    </style>
    <?php while (have_posts()) : the_post();
    the_content();
    endwhile; wp_reset_query(); ?>
    <div class="container">
        <div class="row">
            <div class="portfolio_head">
                <?php
                $category = get_categories();
                $coutcate = count($category)-1;
                $ccc = 0;
                for ($i = 0; $i<=$coutcate; $i++) {
                    $category = get_categories(); ?>
                    <a href="javascript:void(0);" <?php if ($ccc === 0) : ?> class="active" <?php endif; ?> data-val="<?php echo $category[$i]->slug; ?>"><?php echo $category[$i]->cat_name; ?></a>
                    <?php $ccc++;
                }
                ?>
            </div>
            <div class="portfolio_body">
                <?php
                $args = array(
                    'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC',
                    'tax_query' => array( array( 'taxonomy' => 'category', 'terms' => 'category' ) )
                );
                $loop = new WP_Query( $args );
                ?>
                <?php
                $portFolio = 0;
                if( $loop->have_posts() ): ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); $portFolio++; ?>
                        <div class="portfolio_box
                        <?php $categories = get_the_category();
                        $coutcates = count($categories)-1;
                        for ($j = 0; $j<=$coutcates; $j++) {
                            echo esc_html( $categories[$j]->slug )." ";
                        } ?>">
                            <?php the_post_thumbnail(); ?>
                            <div class="portfolio_content">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_portfolio<?= $portFolio ?>"><i class="fa fa-search-plus"></i></a>
                                <h2><?php the_title(); ?></h2>
                                <h4><?php the_field('technology'); ?></h4>
                            </div>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_portfolio<?= $portFolio ?>"></a>
                        </div>
                        <div id="myModal_portfolio<?= $portFolio ?>" class="portfolio_modal modal fade" role="dialog" style="display: none;">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <a href="javascript:void(0);" class="close_button" data-dismiss="modal"><img src="<?= get_template_directory_uri(); ?>/portfolio/close.png"></a>
                                        <h2 class="portfolio_titlee"><?php the_title(); ?></h2>
                                        <div class="portfolio_starting_details">
                                            <div class="header_data">
                                                <h3>Technology</h3>
                                                <p><?php the_field('technology'); ?></p>
                                            </div>
                                            <div class="header_data">
                                                <h3>Start-End Date</h3>
                                                <p><?php the_field('start-date'); ?> - <?php the_field('end_date'); ?></p>
                                            </div>
                                        </div>
                                        <div class="bottom_details">
                                            <div class="about_project">
                                                <h3 class="portfolio_titlee text-left">About Project</h3>
                                                <?php the_content();
                                                ?>
                                            </div>
                                            <div class="slider_images">
                                                <h3 class="portfolio_titlee text-left">Gallary</h3>
                                                <div class="flexslider">
                                                    <ul class="slides">
                                                        <?php
                                                        if( have_rows('gallary') ):
                                                            while ( have_rows('gallary') ) : the_row(); ?>
                                                                <?php $gellaryI = get_sub_field('re_image'); ?>
                                                                <li data-thumb="<?= $gellaryI['url']; ?>">
                                                                    <img src="<?= $gellaryI['url']; ?>" />
                                                                </li>
                                                            <?php endwhile;
                                                        endif;
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; wp_reset_query(); ?>
            </div>
        </div>
    </div>
<!---->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/portfolio/jquery.flexslider.js"></script>
    <script>
        jQuery(".portfolio_head a").click(function(){
            var value = jQuery(this).attr("data-val");
            jQuery(".portfolio_head a").removeClass('active');
            jQuery(this).addClass("active");
            if(value == "all")
            {

                jQuery('.portfolio_box').addClass('active');
                jQuery('.portfolio_box').show('1000');
            }
            else
            {

                jQuery(".portfolio_box").not('.'+value).removeClass('active');
                jQuery(".portfolio_box").not('.'+value).hide('3000');
                jQuery('.portfolio_box').filter('.'+value).addClass('active');
                jQuery('.portfolio_box').filter('.'+value).show('3000');

            }
        });
    </script>

<?php
 get_footer();