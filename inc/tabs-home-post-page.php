<ul>
<?php

global $post;

$args = array( 'post_type' => array('product', 'attachment'), 'numberposts' => -1, 'nopaging' => true, 'post_mine_type' => 'image/png', 'post_status'=>'any, post');
$myposts = get_posts( $args );

?>
	<li></li>

	<?php
		foreach( $myposts as $post ){
		setup_postdata($post);
	?>
			<?php echo "<br>Date: "; the_date(); ?>
			<?php echo "<br>ID: " . $post->ID; ?>
			<?php echo "<br>Post excerpt: " . $post->post_excerpt; ?>
			<?php echo "<br>Post status: " . $post->post_status; ?>
			<?php echo "<br>Post name: " . $post->post_name; ?>
			<?php echo "<br>Guid: " . $post->guid; ?>
			<?php echo wp_get_attachment_image($post->ID, array(20,20)); ?>
		<li class="card-header"><a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a></li>
		<li class="card-body" style="max-height: 100px; overflow-y: scroll"><?php the_content(); ?></li>
	<?php
}
wp_reset_postdata();

?>
</ul>






<?php
//require_once __DIR__ . '/../inc/data/dbConnect.php';
//
//function get_my_product($id){
//	global $wpdb;
//	$table_name = $wpdb->get_blog_prefix() . 'my_data';
//
//	$my_product = $wpdb->get_var($wpdb->prepare("SELECT name FROM {$table_name} WHERE id = $id", true));
//
//	// echo $my_product;
//}
//
//get_my_product(3);


//if (! is_admin()) {remove_menu_page( 'edit.php' ); }
// echo '<pre>' . print_r( $GLOBALS['menu'], TRUE) . '</pre>';
//
// $screen = get_current_screen();
// echo '<pre>' . print_r($screen, TRUE) . '</pre>';
//echo "test text";
//
///*require __DIR__ . '/../vendor/autoload.php';*/
//// require __DIR__ . '/../vendor/autoload.php';
//
//// use Automattic\WooCommerce\Client;
//
//$woocommerce = new Client(
//    'https://x-ali.ru',
//    'ck_3d0cc3f75674e1dbff100f1bba79f152cefe0998',
//    'cs_a11376ef5c5cf0ae7c08f1150e1166afa71d6e49',
//    [
//        'wp_api' => true,
//        'version' => 'wc/v2',
//    ]
//);
//
//$data = [
//    'regular_price' => '1200'
//];
//
//echo "<pre>";
//print_r($woocommerce->put('products/275', $data));
//// print_r($woocommerce->post('products', $data));
//echo "</pre>";
//
//
//$data = [
//    'name' => 'Premium Quality',
//    'type' => 'simple',
//    'regular_price' => '21.99',
//    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
//    'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
//    'categories' => [
//        [
//            'id' => 9
//        ],
//        [
//            'id' => 14
//        ]
//    ],
//    'images' => [
//        [
//            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg',
//            'position' => 0
//        ],
//        [
//            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg',
//            'position' => 1
//        ]
//    ]
//];


