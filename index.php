
<?php get_header(); ?>

<br><br>
<section id="sec-ringtones" style="padding-bottom: 100px;margin-top: -50px;">
	<div class="container-fluid my-container-fluid">
		<div class="row">
			<div class="title">
				<i class="fas fa-headphones"></i><h3 style="color: #fff; margin-top: 4px;">NEW RIGTONES</h3>
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
			<div class="row main-pagination">
				<div class="pagination text-center">
				<?php yendev96_pagination(); ?>
			</div>
			</div>
		</div>
		
	</section>
	<?php get_footer() ?>
</div>
</body>


</html>