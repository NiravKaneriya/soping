<?php
/* the_excerp Limit */
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/[.+]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/* USE
excerpt($limit) or content($limit); */

//---------------------------------------------------------------
// Print Value loop

if($counter % 2 == 0) echo '</div><div class="row">';


//---------------------------------------------------------------
// Print Value In Decimal 01


printf("%02d", $cccc);


//---------------------------------------------------------------
// ADMINISTRATOR CHECK


if( !current_user_can('administrator') ) {  ?>
    <a href="<?= site_url().'/documents/' ?>" class="btn btn-primary ">Click Here To View Your Report</a>
<?php }


//---------------------------------------------------------------
// add class <li>


add_filter('nav_menu_css_class','arg_menu_classes',110,3);

function arg_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'header_menu') {
        $classes[] = 'nav-item';
    }
    return $classes;
}

//---------------------------------------------------------------
// add class <a>


function add_specific_menu_location_atts( $atts, $item, $args ) {
    if( $args->theme_location == 'header_menu' ) {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );


//---------------------------------------------------------------
// add Option Page


if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}


//---------------------------------------------------------------
// add custom Menu In dashboard

function register_custom_menu_page() {
    add_menu_page('custom menu title', 'custom menu', 'add_users', 'custompage', '_custom_menu_page', null, 6);
}
add_action('admin_menu', 'register_custom_menu_page');

function _custom_menu_page(){
    echo "Admin Page Test";
}



//---------------------------------------------------------------
// Add Menu Admin Bar


add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'my-item',
        'title' => 'Theme Option',
        'href'  => site_url().'/wp-admin/admin.php?page=acf-options',
        'meta'  => array(
            'title' => __('Theme Option'),
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'my-sub-item',
        'parent' => 'my-item',
        'title' => 'My Sub Menu Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Sub Menu Item'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'my-second-sub-item',
        'parent' => 'my-item',
        'title' => 'My Second Sub Menu Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Second Sub Menu Item'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
        ),
    ));
}


//---------------------------------------------------------------
// allow file type

function wpse_add_nb_mime_type( $allowed_mimes ) {
    $allowed_mimes['ies'] = 'application/mathematica';
    return $allowed_mimes;
}
add_filter( 'mime_types', 'wpse_add_nb_mime_type', 10, 1 );



//---------------------------------------------------------------
// Excerpt add

function custom_excerpt_more( $more ) {
    return '...';
    //you can change this to whatever you want
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

//---------------------------------------------------------------
// IE Only Script

add_action( 'wp_enqueue_scripts', 'load_IE_fallback' );
function load_IE_fallback() {
    wp_register_script( 'ie_html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', '', '3.7.3', false );
    wp_register_script( 'ie_respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', '', '1.4.2', false );

    wp_enqueue_script( 'ie_html5shiv');
    wp_enqueue_script( 'ie_respond');

    wp_script_add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );
    wp_script_add_data( 'ie_respond', 'conditional', 'lt IE 9' );
}

/**
 * Hide WordPress update nag to all but admins
 */

function hide_update_notice_to_all_but_admin() {
    if ( !current_user_can( 'update_core' ) ) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', 'hide_update_notice_to_all_but_admin', 1 );

/**
 * Utilize proper WordPress titles
 */

add_theme_support( 'title-tag' );

/**
 * Create custom WordPress dashboard widget
 */

function dashboard_widget_function() {
    echo '
        <h2>Custom Dashboard Widget</h2>
        <p>Custom content here</p>
    ';
}

function add_dashboard_widgets() {
    wp_add_dashboard_widget( 'custom_dashboard_widget', 'Custom Dashoard Widget', 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );

// Enqueue Styles and Scripts
add_action('wp_enqueue_scripts', 'load_style');
function load_style()
{
    wp_enqueue_style( 'style', get_bloginfo() . '/css/style.css' );
    wp_enqueue_script( 'script', get_bloginfo() . '/js/script.css', 'jquery', '1.0', true );
}

/**
 * Include navigation menus
 */

function register_my_menu() {
    register_nav_menu( 'nav-menu', __( 'Navigation Menu' ) );
}
add_action( 'init', 'register_my_menu' );
/** ******************** */
wp_nav_menu( array( 'theme_location' => 'nav-menu' ) );
/** ******************** */
function register_my_menus() {
    register_nav_menus(
        array(
            'new-menu' => __( 'New Menu' ),
            'another-menu' => __( 'Another Menu' ),
            'an-extra-menu' => __( 'An Extra Menu' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );

/**
 * Insert custom login logo
 */

function custom_login_logo() {
    echo '
        <style>
            .login h1 a {
                background-image: url(image.jpg) !important;
                background-size: 234px 67px;
                width:234px;
                height:67px;
                display:block;
            }
        </style>
    ';
}
add_action( 'login_head', 'custom_login_logo' );

/**
 * Modify jQuery
 */

function modify_jquery() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1' );
    wp_enqueue_script( 'jquery' );
}
if (!is_admin()) add_action('wp_enqueue_scripts', 'modify_jquery');

/**
 * Switch post type
 */

function switch_post_type ( $old_post_type, $new_post_type ) {
    global $wpdb;

    // Run the update query
    $wpdb->update(
        $wpdb->posts,
        // Set
        array( 'post_type' => $new_post_type),
        // Where
        array( 'post_type' => $old_post_type )
    );
}