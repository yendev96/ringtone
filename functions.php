<?php 
require_once('walker.php');

// ==========Đường dẫn đến theme====================================================================

function yendev96_theme_style(){
	
}

// ========== Thiết lập cơ bản cho theme=============================================================
if(! function_exists('vanyen96_theme_setup')){
	function vanyen96_theme_setup(){
		$language_folder = yendev96_theme_url . '/languages';
		load_theme_textdomain('yendev96',$languages_foder);
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'link', 'gallery', 'audio',
		) );
		add_theme_support('title-tag');
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support('custom-background');
		add_theme_support('html5',array('search-form'));
	}

	add_action('init','vanyen96_theme_setup' );
}

//==========Tao widget ================================================================================

if(!function_exists ('yendev96_theme_widget')){

	function yendev96_theme_widget(){

		$args = array(
			'name'          => ( 'sidebar'),
			'id'            => 'sidebar-id',
			'description'   => '',
			'class'         => 'sidebar-class',
			'before_widget' => '<div id="%1s" class="row search %2s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		);
		register_sidebar( $args );
	}

	add_action('widgets_init','yendev96_theme_widget');
}

	// ============Tao navication ======================================================================

function wpb_custom_new_menu() {
	
	register_nav_menu(
		'primary',__( 'Primary' ),
		'extra-menu' , __ ('Extra Menu')
	);
}
add_action( 'after_setup_theme', 'wpb_custom_new_menu' );


// ===================== TẠO PHÂN TRANG ========================================

function yendev96_pagination()
{
	global $wp_query;

$big = 999999999; // code Theson.net

echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'prev_text'    => __('«  Previous'),
	'next_text'    => __('Next »'),
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages
) );
}
// =====================Đếm số lướt xem bài viết===========================================================

function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

// function to display number of posts.
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count;
}

// Thêm cột View trong phần quản lý post
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
	$defaults['post_views'] = __('Views');
	return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
		echo getPostViews(get_the_ID());
	}
}

//===================== GET NGÀY ĐĂNG BÀI VIẾT ========================

function get_time() {

	$time_since_posted = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago';

	return $time_since_posted;

}


// ==================== XÓA WP_HEADER TỐI ƯU SEO =====================

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head, 10, 0');

// ======================= LẤY 20 KÝ TỰ ĐẦU TIÊN TRONG PHẦN MÔ TẢ=====

function custom_excerpt_length( $length ) {
	return 40;
} 
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// ======================= HÀM KIỂM TRA THUMBNAIL =====================

function check_thumbnail(){
	if(has_post_thumbnail()){
		the_post_thumbnail();
	}else{
		echo '<img src="http://i.imgur.com/Y2wKOma.jpg">';
	}
}


// ================ LẤY ẢNH ĐẦU TIÊN TRONG BÀI VIẾT LÀM ẢNH ĐẠI DIỆN =================

function yendev96_get_first_img() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "http://i.imgur.com/Y2wKOma.jpg"; //Duong dan anh mac dinh khi khong tim duoc anh dai dien
}
return $first_img;
}


// ============= TẠO BREADCRUMBS CHO WEBSITE ====================

function the_breadcrumb() {
	echo '<ul class="breadcrumb">';
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
		echo "</a></li>";
		echo '<span>'.'>>'.'</span>';
		if (is_category() || is_single()) {
			echo '<li>';
			the_category(' </li><li> ');
			if (is_single()) {

				echo "</li>".'<span>'.'>>'.'</span>'."<li>";
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			echo '<li>';
			echo the_title();
			echo '</li>';
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
}


// ====================== LẤY BÀI VIẾT XEM NHIỀU  NHẤT ================

function get_top_view($number_post){

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


function get_all_top_view(){

	$posts = get_posts( array(
		'posts_per_page' => $number_post, 
		'meta_key' => 'post_views_count', 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC'
	) );

	

	return $posts;
}

// ======================= LẤY NHỮNG BÀI VIẾT XEM NHIỀU NHẤT CỦA MỘT DANH MỤC ===========
function get_top_view_category($number_post,$cat_id){
	$query_top_view_category = new WP_Query(array(
		'posts_per_page' => $number_post, 
		'meta_key' => 'post_views_count', 
		'orderby'=> 'meta_value_num', 
		'order' => 'DESC',
		'cat'   => $cat_id,
	));
	if($query_top_view_category -> have_posts()){
		while ($query_top_view_category -> have_posts()){ 
			$query_top_view_category -> the_post();
			get_template_part('content','item');
		}
	}
	

}

// ========================== LẤY BÀI VIẾT XEM NGẪU NHIÊN Ở TRANG CHỦ =================

function get_post_random_on_home(){
	$query4 = new WP_Query(array(
		'offset' => 10,
		'posts_per_page' => 4,
		'orderby' => 'rand',
	));

	if($query4 -> have_posts()){
		while($query4 -> have_posts()){
			$query4 -> the_post();
			get_template_part('content','post-random');
		}
	}
}


// ========================== LẤY BÀI VIẾT XEM NGẪU NHIÊN TÙY BIẾN =================

function get_post_random($number_post){
	$query4 = new WP_Query(array(
		'posts_per_page' => $number_post,
		'orderby' => 'rand',

	));

	if($query4 -> have_posts()){
		while($query4 -> have_posts()){
			$query4 -> the_post();
			get_template_part('content','item');
		}
	}
}

// ============================= LẤY BÀI VIẾT Ở TRANG CHỦ =======================
function get_post_on_home(){
	$paged = ( get_query_var('paged'))? get_query_var('paged') : 1;
	$query5 = new WP_Query(array(
		'paged' => $paged,
	));
	if ($query5 -> have_posts() ){ 
		while ($query5 -> have_posts() ){
			$query5 -> the_post();
			get_template_part('content','post');

		}
	}
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


function get_author(){
	global $wp_query;
	$post = $wp_query->post;
	$author_id = $post->post_author; // author ID
	$author_name = get_the_author_meta( 'display_name', $author_id);
	return $author_name;
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


function the_tag( $before = null, $sep = ', ', $after = '' ) {
	if ( null === $before )
		$before = __('');

	$the_tags = get_the_tag_list( $before, $sep, $after );

	if ( ! is_wp_error( $the_tags ) ) {
		echo $the_tags;
	}
}

function show_value_search(){
	if(isset($_GET['s'])){
		$value = $_GET['s'];
		return $value;
	}
}


if(isset($_GET['test'])){
	$a = $_GET['test'];
	if($a == 'top'){
		header("Location: footer.php");
	}
}


?>