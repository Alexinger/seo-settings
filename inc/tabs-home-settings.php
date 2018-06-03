<!--<ul>-->
<?php
//
//global $post;
//
//$args = array( 'post_type' => array('product', 'attachment'), 'numberposts' => -1, 'nopaging' => true, 'post_mine_type' => 'image/png', 'post_status'=>'any, post');
//$myposts = get_posts( $args );
//
//?>
<!--	<li></li>-->
<!---->
<!--	--><?php
//		foreach( $myposts as $post ){
//		setup_postdata($post);
//	?>
<!--			--><?php //echo "<br>Date: "; the_date(); ?>
<!--			--><?php //echo "<br>ID: " . $post->ID; ?>
<!--			--><?php //echo "<br>Post excerpt: " . $post->post_excerpt; ?>
<!--			--><?php //echo "<br>Post status: " . $post->post_status; ?>
<!--			--><?php //echo "<br>Post name: " . $post->post_name; ?>
<!--			--><?php //echo "<br>Guid: " . $post->guid; ?>
<!--			--><?php //echo wp_get_attachment_image($post->ID, array(20,20)); ?>
<!--		<li class="card-header"><a href="--><?php //the_permalink(); ?><!--" class="text-white">--><?php //the_title(); ?><!--</a></li>-->
<!--		<li class="card-body" style="max-height: 100px; overflow-y: scroll">--><?php //the_content(); ?><!--</li>-->
<!--	--><?php
//}
//wp_reset_postdata();
//
//?>
<!--</ul>-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
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
