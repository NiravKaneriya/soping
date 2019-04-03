http://docs.designsandcode.com/search-filter/
<?php
// For Home Url */
    echo esc_url( home_url( '/' ) );
?>

----------------------------------------------------------------
<?php 
// For option  field
    the_field('field_name','options');
?>

----------------------------------------------------------------
<?php
// For template Url */
     bloginfo('template_url');
?>

----------------------------------------------------------------
<?php
// For navigation
    wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false) );
?>

<?php     
// Trip COntent         
$idc = $p->post_content; 
$content = $p->post_content; 
$trimmed_content = wp_trim_words( $content, 25,'...');
?>
-----------------------------------------------------------------
<?php
//For Change Page title
    if(get_field('page_title')){the_field('page_title');}else{ the_title(); }
?>

-----------------------------------------------------------------
<?php
//For shot code
    echo do_shortcode('[contact-form-7 id="50" title="Contact Us"]'); 
?>	

-----------------------------------------------------------------
<?php
// For Page contat
    while ( have_posts() ) : the_post(); 
    
        the_title();
        the_content();

    endwhile;wp_reset_query();
?>
---------------------------
<?php $terms = wp_get_post_terms($post->ID,'familtcat');
 $count = count($terms);
  if ( $count > 0 ){
     
     foreach ( $terms as $term ) {
       echo $term->slug; echo ' ';
		 }		
	 }?>
-----------------------------------------------------------------

 <?php $id = $post->ID;
    $popular = get_field('featured_post',$id);
    // print_r($popular); 
    
    if(($popular[0] != 1) || ($full== "true")){ 
            get_template_part('popup-newsletter');
        }
        else 
        
        {
            get_template_part('popup-newsletter');    
        }
?> 
------------------------------------
<?php
// For Custom post type 
       //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args =  array('post_type' =>'faq',
        //'paged' => $paged,
        'posts_per_page'=>'-1'
        );                      	                        
        query_posts( $args );                        
        $i=1; while ( have_posts() ) : the_post();   
   
    
         while(has_sub_field('slider')):
           $master_attachment_id = get_sub_field('image');     
           $image = wp_get_attachment_image_src($master_attachment_id, 'slider'); //size in function.php 
   
           the_sub_field('answer');
           echo $image[0];        
         endwhile;
?> 

-----------------------------------------------------------------
<!--For append span tag to reponsive menu -->
    <script>
        $('.mobile-menu ul li.menu-item-has-children').prepend('<span class="sub-nav-icon"></span>');
    </script> 
    
-----------------------------------------------------------------
<?php 
//For apply css to post inner page
   if ((is_singular( 'post' ))|| (is_category(''))){
?>
    <style>       
    .menuBox ul#menu-main-navigation li.menu-item-21 a span { background: #80a4c8; }
    .menuBox ul#menu-main-navigation li.menu-item-21 a { background: url(<?php bloginfo('template_url'); ?>/images/arrow1.png) center bottom no-repeat; }
    </style>
 <?php } ?>
 
 -----------------------------------------------------------------
<!-- Add script for equal; hight div -->
     <script>
        function setEqualHeight(columns)
        {
        var tallestcolumn = 0;
        columns.each(
        function()
        {
        currentHeight = jQuery(this).height();
        if(currentHeight > tallestcolumn)
        {
        tallestcolumn = currentHeight;
        }
        }
        );
        columns.height(tallestcolumn);
        } 
    </script>
    
     <script>
       jQuery(document).ready(function() { 
         setEqualHeight(jQuery(".album"));
         });
     </script> 
     
-----------------------------------------------------------------
<?php     
// get page slug only
    echo( basename(get_permalink()) );
?>

-----------------------------------------------------------------  
<?php
// get all term list on textonomy
//list terms in a given taxonomy (useful as a widget for twentyten)

		$taxonomy = 'texonomyname';
		$tax_terms = get_terms($taxonomy);
?>
    <ul class="styledDropdown" id="cont_industries">
         
        <?php
        foreach ($tax_terms as $tax_term) {
        //print_r($tax_term);echo '<pre>' ?>
        <?php $details = get_field('texonomyname_fieldname', 'texonomyname_'. $tax_term->term_id.''); ?>
        <?php if($details == 'offices'){ ?>
        <li><a data-filter=".<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?></a></li>
        <?php } ?>
        <?php }?>
         
    </ul>
    
-----------------------------------------------------------------
<?php
// get selected term for custom post */
     $terms = wp_get_post_terms($post->ID,'texonomyname');
     $count = count($terms);
      if ( $count > 0 ){
         
         foreach ( $terms as $term ) {
           echo $term->slug; echo 'term->name';
        }		
}?>

-----------------------------------------------------------------
<?php    
//apply check box condioton on page

     $id = $post->ID;
        $popular = get_field('featured_post',$id);
       // print_r($popular);         
        if($popular[0] == 1){}else{}
?>

-----------------------------------------------------------------
<?php
// Blank condition to custom filed 
     if(get_field('')!=""){
        echo 'hi...';
}?>

-----------------------------------------------------------------
<?php
// Remove any things from admin side

    function rem() {    
        echo '<style type="text/css">    
                #wp-admin-bar-new-content, #wp-admin-bar-updates { display: none !important; }    
              </style>';    
    }
    
    add_action('admin_head', 'rem');
?>

-----------------------------------------------------------------
<?php
// For thumbhanail
    /* Metho - 1*/
    if ( has_post_thumbnail() ) {
    	the_post_thumbnail();
    }
    else {
    	echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.jpg" />';
    }
    /* Metho - 2*/
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb_img' );
    echo $url = $thumb['0'];
?>

-----------------------------------------------------------------
<?php
//Remove A tag from image
	add_filter( 'the_content', 'attachment_image_link_remove_filter' );
	function attachment_image_link_remove_filter( $content ) {
	 $content =
 	preg_replace(
 	array('{<a(.*?)(wp-att|wp-content/uploads)[^>]*><img}',
 	'{ wp-image-[0-9]*" /></a>}'),
 	array('<img','" />'),
 	$content
 	);
 	return $content;
	 }
?>

-----------------------------------------------------------------
<?php
//Div Short code [ <a class="button" href="http://www.google.com"><span>Google</span></a> ]
    function sButton($atts, $content = null) {
       extract(shortcode_atts(array('link' => '#'), $atts));
       return '<a class="button" href="'.$link.'"><span>' . do_shortcode($content) . '</span></a>';
    }
    add_shortcode('button', 'sButton');
    
    echo '[button link="http://google.com"]Go to Google[/button]';
    // http://diythemes.com/thesis/wordpress-shortcodes
    // http://www.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide
?>

-----------------------------------------------------------------
<?php
// Dynamic sidebar
if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
	<ul id="sidebar">
		<?php dynamic_sidebar( 'left-sidebar' ); ?>
	</ul>
<?php endif; ?>

-----------------------------------------------------------------
<?php
//Adding the First Post Image as the Default Fallback
    /* function to call first uploaded image in functions file */
    function main_image() {
    $files = get_children('post_parent='.get_the_ID().'&post_type=attachment
    &post_mime_type=image&order=desc');
      if($files) :
        $keys = array_reverse(array_keys($files));
        $j=0;
        $num = $keys[$j];
        $image=wp_get_attachment_image($num, 'large', true);
        $imagepieces = explode('"', $image);
        $imagepath = $imagepieces[1];
        $main=wp_get_attachment_url($num);
    		$template=get_template_directory();
    		$the_title=get_the_title();
        print "<img src='$main' alt='$the_title' class='frame' />";
      endif;
    }
    
    /* add below code to get thumb */
    
   if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
      echo get_the_post_thumbnail($post->ID);
    } else {
       echo main_image();
    } 

?>

-----------------------------------------------------------------
<?php
//Code for remove WP upgrade message from wordpress admin
    add_action('admin_menu','wphidenag');
    function wphidenag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
    }
    add_action('admin_menu', 'remove_menus', 102);
    function remove_menus()
    {
    global $submenu;
    remove_submenu_page ( 'index.php', 'update-core.php' );    //Dashboard->Updates
    }
?>

-----------------------------------------------------------------
<?php
//Disable javascript from wordpress
/* http://justintadlock.com/archives/2009/08/06/how-to-disable-scripts-and-styles */
?>

-----------------------------------------------------------------
<?php
// Change the order of check out page form
    add_filter('woocommerce_checkout_fields','reorder_woo_fields');
    
    function reorder_woo_fields($fields) {
    	//move these around in the order you'd like
    	$fields2['billing']['billing_first_name'] = $fields['billing']['billing_first_name'];
    	$fields2['billing']['billing_last_name'] = $fields['billing']['billing_last_name'];
    	$fields2['billing']['billing_company'] = $fields['billing']['billing_company'];
    	$fields2['billing']['billing_address_1'] = $fields['billing']['billing_address_1'];
    	$fields2['billing']['billing_address_2'] = $fields['billing']['billing_address_2'];
    	$fields2['billing']['billing_city'] = $fields['billing']['billing_city'];
    	$fields2['billing']['billing_postcode'] = $fields['billing']['billing_postcode'];
    	$fields2['billing']['billing_country'] = $fields['billing']['billing_country'];
    	$fields2['billing']['billing_state'] = $fields['billing']['billing_state'];
    	$fields2['billing']['billing_email'] = $fields['billing']['billing_email'];
    	$fields2['billing']['billing_phone'] = $fields['billing']['billing_phone'];
    
    	//just copying these (keeps the standard order)
    	$fields2['shipping'] = $fields['shipping'];
    	$fields2['account'] = $fields['account'];
    	$fields2['order'] = $fields['order'];
    
    	return $fields2;
    }
?>

-----------------------------------------------------------------
<?php
// Change shorting order option's title
add_filter( 'gettext', 'theme_sort_change', 20, 3 );
function theme_sort_change( $translated_text, $text, $domain ) {

    if ( is_woocommerce() ) {

        switch ( $translated_text ) {

            case 'Default sorting' :

                $translated_text = __( 'Sort By', 'theme_text_domain' );
                break;
        }

    }

    return $translated_text;
}
?>

-----------------------------------------------------------------
<?php
//Return a new number of maximum columns for shop archives
    add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
    
    function wc_loop_shop_columns( $number_columns ) {
    return 3;
    }
?>

-----------------------------------------------------------------
<?php
// .last class applied to every 4th thumbnail(Product gallery)
    add_filter ( 'woocommerce_product_thumbnails_columns', 'xx_thumb_cols' );
    function xx_thumb_cols() {
    return 4; 
    }
?>

-----------------------------------------------------------------
<?php
//
//Remove A tag from image

	add_filter( 'the_content', 'attachment_image_link_remove_filter' );
	function attachment_image_link_remove_filter( $content ) {
	 $content =
 	preg_replace(
 	array('{<a(.*?)(wp-att|wp-content/uploads)[^>]*><img}',
 	'{ wp-image-[0-9]*" /></a>}'),
 	array('<img','" />'),
 	$content
 	);
 	return $content;
	 }
     
//Remove P tag from image

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');



//  Thumbh Url

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb_img' );
                $url = $thumb['0'];
                
// Get Selected category list

echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) );

// Get Blog Page Id

<?php
$page_for_posts = get_option( 'page_for_posts' );
?>



-----------------------------------------------------------------
<?php
//
?>

-----------------------------------------------------------------
<?php
//
?>

-----------------------------------------------------------------
<?php
//
?>

-----------------------------------------------------------------
<?php
//
?>

-----------------------------------------------------------------
<?php
//
?>

-----------------------------------------------------------------
<?php
// http://pastebin.com/400PDwhf
?>
<?php
// Ajax Scrool
    /* add below code in function.php */
    function load_more(){
         wp_reset_query(); 
    $offset = $_POST['offset'];
    $post_type = $_POST['post_type'];
    $number_of_posts = $_POST['number_of_post'];
    $total_post = $_POST['total_post'];
    
    
    $args = array(
                'post_type'      => $post_type,
                'order'          => 'DESC',
                'hide_empty'     => 1,
                'offset' => $offset,
                'posts_per_page' => $number_of_posts
                );
                query_posts($args);       
      
      $count = $offset+count(query_posts($args));  
      $count_new = 0; 
      if($count < $total_post)      
      {
        $count_new = 1;
      } 
    
     if ( have_posts() ) : $i=1; while (have_posts()) : the_post(); ?>
                    <?php if($i%4==0){$InfoClass = "last";} else{ $InfoClass = "";}?>
        
                <div class="graphics-items <?php echo $InfoClass;?>">
                <a href="<?php the_permalink(); ?>">
                  <div class="image">
                    <?php echo get_the_post_thumbnail( $post->ID,'info_thumb');?>
                  </div>
                  </a>
                    <span class="info_title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span>
                </div>
                 <?php if($i%4 == 0){echo "<div class='clear'></div>"; } ?>
                <?php  $i++; endwhile; endif; wp_reset_query(); 
    
    die();
    }
    
    add_action("wp_ajax_nopriv_load_more","load_more");
    add_action("wp_ajax_load_more","load_more");
    
    if ( function_exists( 'add_image_size' ) ) { 
    	add_image_size( 'info_thumb', 205,263,true ); //300 pixels wide (and unlimited height)
        	add_image_size( 'article_detail', 665,220,true ); //300 pixels wide (and unlimited height)
            	add_image_size( 'podcast_detail', 317,211,true ); //300 pixels wide (and unlimited height)
    	
    }
    
    /* add below code to get excerpt contant */
    
    $post_type = 'infographic';
    $count_posts = wp_count_posts('infographic');
    $per_page_post = 8;
    ?>
    <script>
    var post_offset, increment,loading=0;
     var post_type = '<?php echo $post_type; ?>';
           var total_post = '<?php echo $count_posts->publish; ?>';
           var number_of_post = '<?php echo $per_page_post;?>';
           
    (function($){
    	$(document).ready(function(){
    	   $(".infographics-block").append( '<div id="lastdata"></div>' );
    		$(window).bind('scroll',checkScroll);
            
            
    	});
    	var checkScroll = function (e){
    		var elem = $(e.currentTarget);
             var distanceTop = $('#lastdata').offset().top - $(window).height();
            
    		if($(window).scrollTop() > distanceTop) {
    			if(loading) return true;
    			if(!loading) {
    				loading=1;
                    
                    //alert(post_id_data);
                     var params = {"offset":post_offset,"post_type":post_type,"number_of_post":number_of_post,"total_post":total_post,"action":"load_more"} 
                    
                    document.getElementById('image-ajax').style.display='block';
    				$.post("<?php echo home_url(); ?>/wp-admin/admin-ajax.php",params,function(data){
    				    var data = data;                    
    					if(data){					  
    						post_offset+=increment;
    						loading=0;
    						$(".info_graphic").append(data);
                             $("#lastdata").remove();
                            $(".info_graphic").append('<div id="lastdata"></div>' );
    						document.getElementById('image-ajax').style.display='none';
    					}
                         else{
                            //alert('hi');
                            $("#lastdata").remove();                        
                           $('#image-ajax').html("No more Infographics available.");
                        }
    
    				});
    		//now load more content
    	}
    }
    }
    }(jQuery));
    </script>
    
     <!-- center part html --> 
    <section id="center-area">
      <div class="container">
          <div class="infographics-block cf">
          <div class="info_graphic">
                <?php while (have_posts()) : the_post(); ?>
                  <?php the_content();?>
                 <?php endwhile;  ?>
                <?php $count = query_posts('post_type=infographic&order=DESC&posts_per_page='.$per_page_post);
                if ( have_posts() ) : $i=1; while (have_posts()) : the_post(); ?>
                <?php if($i%4==0){$InfoClass = "last";} else{ $InfoClass = "";}?>
            <div class="graphics-items <?php echo $InfoClass;?>">
            <a href="<?php the_permalink(); ?>">
              <div class="image">
                <?php echo get_the_post_thumbnail( $post->ID,'info_thumb');?>
              </div>
              </a>
                <span class="info_title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span>
            </div>
            <?php if($i%4 == 0){echo "<div class='clear'></div>"; } ?>
            <?php  $i++; endwhile; endif; wp_reset_query();  ?>
            </div>
            <div class="clear"></div>
          <div id="image-ajax" style="display: none;text-align: center;padding: 0 0 10px;"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader_thumb.gif" /></div>
          <div class="clear"></div>
            <div id="lastdata"></div>
          </div>
        
          
        </div>
      
    </section>
    <script type="text/javascript">
                post_offset = increment = 8;
                </script>
    <div class="clear"></div>
<?php    
?>

-----------------------------------------------------------------

<?php

  function target_blnk()
{
    ?>    
    <script type="text/javascript">        
    jQuery(document).ready(function(){
      
  jQuery('#acf-field-slect_all_cat').click(function(){
    //alert(0);
    jQuery("#in-testcat-3,#in-testcat-4").click(); 
     
  })
});
    </script>
    <?php
}
add_action('admin_head', 'target_blnk');
 ?>

