<?php get_header(); ?>
<?php setPostViews(get_the_ID()); ?>
<section id="sec-ringtones" style="margin-top: 80px;padding-bottom: 100px;">
	<div class="container container-single">
		
		<div class="row">
			<div class="left-single">
				


				<div class="breadcrumb-post all-title">
					<?php 
					the_breadcrumb();
					?>
				</div>


				<!-- Get content single -->
				<?php 
				get_template_part('content', 'single');
				?>

				

				<!-- Table detail -->
				<?php include_once('table-detail.php'); ?>

				<!-- Post same -->
				<div class="same-audio">
					<div class="aside-post">
						<div class="row">
							<div class="col-md-12">
								<div class="title-aside title-same-post all-title">
									<p><i class="fas fa-music icon-title"></i> SAME RINGTONES</p>
								</div>
								<?php 
								get_post_same_category(6);
								?>

							</div>
						</div>
					</div>
				</div>

				


			</div>


			<!--  -->
			<div class="right-single">
				<?php get_sidebar(); ?>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="copyright">
					<p>
						Disclaimer &#0038; Copyright: Ringtones are uploaded/submitted by visitors on this site. We are not responsible for the accuracy of the content. Please <a href="" title="">contact us</a> in case of any copyright violation.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
</div>
</body>


</html>