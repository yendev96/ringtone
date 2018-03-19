<div class="aside-post">
	<div class="row">
		<div class="col-md-12">
			<div class="title-aside all-title">
				<h3><i class="fas fa-music icon-title"></i> TOP VIEW</h3>
			</div>
			<?php get_top_view(5); ?>
			<div class="view-more">
				<a href="<?php echo get_category_link(14); ?>" title="">View more</a>
			</div>
		</div>
	</div>
	
</div>


<div class="aside-post">
	<div class="row">
		<div class="col-md-12">
			<div class="title-aside all-title">
				<h3><i class="fas fa-music icon-title"></i> TOP DOWLOAD</h3>
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