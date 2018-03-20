<?php get_header(); ?>
<section id="sec-ringtones">
    <div class="container-fluid my-container-fluid">
        <div class="row" style="padding: 0 15px;">
            <div class="left-category">
                <div class="row">
                    <div class="title">
                        <h1 style=""><i class="fas fa-headphones"></i><?php single_cat_title(); ?></h1>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    $cat_id = get_queried_object()->term_id;
                        //Most dowload
                    if($cat_id == 2){
                        $data = get_top_dowload(30);
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
                    <?php 
                    if($cat_id != 4){

                       ?>
                       <div class="aside-post">
                        <div class="row">
                            <div class="title-aside all-title">
                                <h2>
                                    <i class="fas fa-music icon-title"></i> 
                                    NEW RINGTONES
                                </h2>
                            </div>

                            <?php 
                            echo $a;
                            get_post_new(6); 
                            ?>
                            <div class="view-more">
                                <a href="<?php echo get_category_link(14); ?>" title="">View more</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                } 
                ?>
                <div class="aside-post">
                    <div class="row">
                        <div class="title-aside all-title">
                            <h2>
                                <i class="fas fa-music icon-title"></i> 
                                <?php if($cat_id != 2){
                                    echo 'TOP DOWNLOAD';
                                }
                                else{
                                    echo "RANDOM RINGTONES";
                                } 
                                ?>
                            </h2>
                        </div>
                        <?php 
                        if($cat_id != 2){
                            $data = get_top_dowload(6);
                        }else{
                            $data = get_post_random(6);
                        }

                        foreach($data as $post){
                            get_template_part('content','aside' );
                        }
                        ?>

                        <?php if($cat_id != 2){
                            ?>
                            <div class="view-more">
                                <a href="<?php echo get_category_link(13); ?>" title="">View more</a>
                            </div>
                            <?php 
                        }
                        ?>
                    </div>
                    <?php 
                    if($cat_id == 4){


                     ?>
                     <div class="aside-post">
                        <div class="row">
                            <div class="title-aside all-title">
                                <h2>
                                    <i class="fas fa-music icon-title"></i> 
                                    RANDOM RINGTONES
                                </h2>
                            </div>
                            <?php 
                            $data = get_post_random(6);
                            foreach($data as $post){
                                get_template_part('content','aside' );
                            }
                            ?>

                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>
</div>
</body>
</html>