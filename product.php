<?php
/**
 * Plugin Name: Product slider
 * Plugin URI: #
 * Description: Display product info by using shortcode
 * Author: Hannan
 * Author URI: #
 * Version: 1.0
 * Text Domain: product
 */


 /* add assets here*/

 function assets(){
    wp_enqueue_style('slick-css','//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',null,'1.0','all');
    wp_enqueue_style('slider-main-css',plugin_dir_url(__FILE__).'/assets/css/slider-main.css',null,'1.0','all');
    wp_enqueue_script('slick-js','//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',null,'1.0',true);
    wp_enqueue_script('main-js',plugin_dir_url( __FILE__ ).'/assets/js/main.js',array('jquery'),'1.0',true);
 }
add_action('wp_enqueue_scripts','assets');




function product_new_slider(){
ob_start();

echo'<div id="wrap">';
echo'<div class="product-slider">';
$args = array(
    'post_type'=>'product',
    'posts_per_page'=> -1
);
$query = new WP_Query($args);


while( $query->have_posts() ): $query->the_post();
    global $product;

    ?>
    <div class="main">
        
        <div class="thumbnail"> <?php echo the_post_thumbnail( 'medium' ); ?></div>
        <div class="title"> <?php echo $product->name; ?></div>
        <div class="quantity">
            <?php if(!empty($product->get_stock_quantity())): ?>
          <span> Quantity:</span> <?php echo $product->get_stock_quantity(); ?>
          <?php endif ?>
    
        </div>
        <div class="price"> <?php echo $product->get_price_html(); ?></div>
    </div>
    <?php
endwhile;

wp_reset_query();
echo'</div>';
echo'</div>';

return ob_get_clean();

}
add_shortcode('product_slider','product_new_slider');



