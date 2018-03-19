<?php get_header(); ?>
<section id="sec-ringtones">
	<div class="container-fluid my-container-fluid">
		<div class="row" style="padding: 0 15px;">
			<div class="left-category">
				<div class="row">
					<div class="title">
						<i class="fas fa-headphones"></i>
						<h3 style="color: #fff; margin-top: 4px;"><?php single_cat_title(); ?></h3>
					</div>
				</div>
				<div class="row">
					<?php 
					$cat_id = get_queried_object()->term_id;
					//Most view
					if($cat_id == 13){
						$data = get_top_dowload(30);
						foreach($data as $post){
							get_template_part('content','post-category');
						}
					}

// Most dowload
					if($cat_id == 14){
						$data = get_all_top_view();
						foreach($data as $post){
							get_template_part('content','post-category');
						}

					}
					?>
					

					<?php

                        if( $wp_query->have_posts() ) { // Nếu phương thức have_posts() trả về TRUE thì mới chạy code bên trong
                            while( $wp_query->have_posts() ) { // Nếu have_posts() == TRUE thì nó mới lặp, không thì ngừng
                                $wp_query->the_post(); // Thiết lập số thứ tự bài viết trong chỉ mục của query

                                get_template_part('content','post-category');

                            }
                        }


                        ?>
                        
                    </div>
                    <div class="row main-pagination">
                    	<div class="pagination text-center">
                    		<?php yendev96_pagination(); ?>
                    	</div>
                    </div>
                </div>
                <div class="right-category">
                	<div class="aside-post">
                		<div class="row">
                			<div class="title-aside all-title">
                				<h3 style="color: #fff; font-weight: bold;"><i class="fas fa-music icon-title"></i> TOP VIEW</h3>
                			</div>
                			<?php get_top_view(5); ?>
                			<div class="view-more">
                				<a href="<?php echo get_category_link(14); ?>" title="">View more</a>
                			</div>
                		</div>
                	</div>
                	<div class="aside-post">
                		<div class="row">
                			<div class="title-aside all-title">
                				<h3 style="color: #fff; font-weight: bold;"><i class="fas fa-music icon-title"></i> TOP DOWNLOAD</h3>
                			</div>
                			<?php 
                			$data = get_top_dowload(5);
                			foreach($data as $post){
                				get_template_part('content','aside' );
                			}
                			?>
                			<div class="view-more">
                				<a href="<?php echo get_category_link(13); ?>" title="">View more</a>
                			</div>
                		</div>
                	</div>
                </div>

            </div>
        </div>
    </section>
    <?php get_footer() ?>
</div>
</body>
</html>