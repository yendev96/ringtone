<?php 
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
remove_action('wp_head', 'title');
//remove_action( 'wp_head', '_wp_render_title_tag', 1 );

?>