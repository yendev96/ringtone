<div class="aside-post">
	<div class="row">
		<div class="col-md-12">
			<div class="title-aside all-title">
				<h2><i class="fas fa-music icon-title"></i> CHART RINGTONES</h2>
			</div>
			<?php get_chart_aside(6); ?>
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
				<h2><i class="fas fa-music icon-title"></i> TOP DOWLOAD</h2>
			</div>


			<?php 
				$data = get_top_dowload(6);
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