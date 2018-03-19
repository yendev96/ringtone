
<?php get_header(); ?>

<section id="sec-ringtones" style="padding-bottom: 100px;">
    <?php 
    $search_query = new WP_Query( 's='.$s.'&showposts=-1' );
    $search_keyword = wp_specialchars( $s, 1);
    $search_count = $search_query->post_count;
    ?>
    <div class="container-fluid my-container-fluid">
        <div class="row">
            <div class="title">
                <i class="fas fa-headphones"></i><h3 style="color: #fff; margin-top: 4px;">SEARCH : <?php echo $search_keyword; ?></h3>
            </div>
        </div>
        <div class="row">
            

            <?php
                if( $wp_query->have_posts() ) { // Nếu phương thức have_posts() trả về TRUE thì mới chạy code bên trong
                    while( $wp_query->have_posts() ) { // Nếu have_posts() == TRUE thì nó mới lặp, không thì ngừng
                        $wp_query->the_post(); // Thiết lập số thứ tự bài viết trong chỉ mục của query

                        get_template_part('content','post' );

                    }
                }
                ?>




            </div>
        </div>
    </section>
    <?php get_footer() ?>
</div>
</body>


</html>