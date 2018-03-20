<?php 
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










function show_value_search(){
	if(isset($_GET['s'])){
		$value = $_GET['s'];
		return $value;
	}
}


?>