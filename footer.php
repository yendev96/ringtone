<div class="genre">
            <?php 
            $categories = get_categories();
            foreach($categories as $category) {
                if($category->term_id != 1){
                ?>
                <div class="item-genre"><a href="<?php echo get_category_link($category->term_id);?>"> <?php echo $category->name.' ('.$category->category_count.')'; ?> </a></div>
                <?php 
            }}
            ?>
            
        </div>
</section>
<footer>
<p>Copyright © 2018 <a href="<?php bloginfo('url'); ?>" title="">Freeringtonesmobile.net</a></p>
<?php wp_footer(); ?>
</footer>

