<?php 

	// ====================== LẤY BÀI VIẾT XEM NHIỀU  NHẤT ================

function get_chart_aside($number_post){

	$get_top_view = new WP_Query(array(
		'posts_per_page' => $number_post, 
		'meta_key' => 'post_views_count', 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC'
	));

	if($get_top_view -> have_posts()){
		while($get_top_view -> have_posts()){
			$get_top_view -> the_post();
			get_template_part('content','aside');

		}
	}
}



// Lấy bài viết nhiều view nhất


function get_chart(){

	$posts = get_posts( array(
		'posts_per_page' => $number_post, 
		'meta_key' => 'post_views_count', 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC'
	) );

	

	return $posts;
}

// Lấy những post mới nhất

function get_post_new($count){
	$get_new = new WP_Query(array(
		'posts_per_page' => $count, 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC',
	));

	if($get_new -> have_posts()){
		while ($get_new -> have_posts()){
			$get_new -> the_post();
			get_template_part('content','aside');
		}
	}
	

}


function get_post_new_home($count){
	$get_new = new WP_Query(array(
		'posts_per_page' => $count, 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC',
	));
	
	if($get_new -> have_posts()){
		while ($get_new -> have_posts()){
			$get_new -> the_post();
			get_template_part('content','post');
		}
	}
	

}

// ======================= LẤY NHỮNG BÀI VIẾT XEM NHIỀU NHẤT CỦA MỘT DANH MỤC ===========
function get_post_category($count,$cat_id){
	$query_top_view_category = new WP_Query(array(
		'posts_per_page' => $count, 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC',
		'cat'   => $cat_id,
	));
	if($query_top_view_category -> have_posts()){
		while ($query_top_view_category -> have_posts()){ 
			$query_top_view_category -> the_post();
			get_template_part('content','post');
		}
	}
	

}




// ========================== LẤY BÀI VIẾT XEM NGẪU NHIÊN TÙY BIẾN =================

function get_post_random($number_post){

	$posts = get_posts( array(
		'posts_per_page' => $number_post,
		'orderby' => 'rand',
	) );

	return $posts;

}




// ============= HIỂN THỊ BÀI VIẾT CÙNG CHUYÊN MỤC ===========================

function get_post_same_category($number_post){
	$cat = get_the_category($post->ID);
	if ($cat) {
		$t = $cat[0];
		$r = new WP_Query(array(
			'posts_per_page'=> $number_post, 
			'post__not_in'=> array($post->ID), 
			'cat'=> $t->term_id 
		));
	}
	while ($r -> have_posts()) {
		$r -> the_post();
		get_template_part('content','same' );
	}
}



function get_author(){
	global $wp_query;
	$post = $wp_query->post;
	$author_id = $post->post_author; // author ID
	$author_name = get_the_author_meta( 'display_name', $author_id);
	return $author_name;
}

function the_tag( $before = null, $sep = ', ', $after = '' ) {
	if ( null === $before )
		$before = __('');

	$the_tags = get_the_tag_list( $before, $sep, $after );

	if ( ! is_wp_error( $the_tags ) ) {
		echo $the_tags;
	}
}





function get_top_dowload($count){
	global $wpdb;
	$posts = $wpdb->get_results( "SELECT * FROM ring_posts WHERE post_type = 'post' and post_parent = 0 and ping_status ='open' and post_status = 'publish' ORDER BY download_count DESC LIMIT $count" );
	if(!empty($posts)){
		return $posts;
	}
	
}



function get_audio_mp3($id){
	global $wpdb;
	$postdata = $wpdb->get_row( "SELECT guid FROM ring_posts WHERE post_parent = $id and post_type = 'attachment' and post_mime_type ='audio/mpeg' ORDER BY ID DESC" );

	return $postdata->guid;
}


function get_audio_m4r($id){
	global $wpdb;
	$postdata = $wpdb->get_row( "SELECT guid FROM ring_posts WHERE post_parent = $id and post_type = 'attachment' and post_mime_type ='audio/aac' ORDER BY ID DESC" );

	return $postdata->guid;
}
// ============= HIỂN THỊ BÀI VIẾT CỦA MỘT CHUYÊN MỤC BẤT KỲ

function get_domain($link){
	return $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]".'/ring'.$link;
}




function dowload_audio(){
	global $wpdb;
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		if(isset($_GET['type'])){
			$type = $_GET['type'];
			if($type == 'm4r'){
				$file = get_audio_m4r($id);
			}else{
				$file = get_audio_mp3($id);
			}
		}else{
			$file = get_audio_mp3($id);
		}


		if($file){

			$filename = basename($file);
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=$filename");
			header("Content-Type: application/mp3");
			header("Content-Transfer-Encoding: binary");

			readfile($file);
			$postdata = $wpdb->get_row( "SELECT download_count FROM ring_posts WHERE ID = $id");
			$count = $postdata->download_count;
			if($count == NULL){
				$count = 0;
			}
			$wpdb->update( 'ring_posts',
				array('download_count' => $count + 1),
				array('ID' => $id)
			);
			exit;
		}else{
			header('Location: 404.php');
		}
	}
	
	
	
}

dowload_audio();

?>