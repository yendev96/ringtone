<div class="detail-audio" style="margin-top: 40px;">
					<div class="row">
						<div class="col-md-12">
							<div class="title-detail-audio all-title">
								<p><i class="fas fa-music icon-title"></i> Ringtone details</p>
							</div>
						</div>
					</div>
				</div>
				<div class="table-detail-audio">
					<table class="table table-bordered">

						<tr>
							<th><b>Title</b></th>
							<td><?php the_title(); ?></td>
						</tr>
						<tr>
							<th>Created By</th>
							<td><?php echo get_author(); ?></td>
						</tr>
						<tr>
							<th>Downloaded</th>
							<td><?php if($post->download_count == NULL){echo "0";}else{echo $post->download_count;} ?></td>
						</tr>
						<tr>
							<th>Views</th>
							<td><?php echo getPostViews(get_the_ID()); ?></td>
						</tr>
						<tr>
							<th>Added</th>
							<td>
								<?php
								$date = new DateTime($post->post_date);
								echo date_format( $date, "Y-m-d"); 
								?>

							</td>
						</tr>
						<tr>
							<th>Category</th>
							<td><?php echo the_category(); ?></td>
						</tr>
						<tr>
							<th>File Size</th>
							<td id="size"></td>
						</tr>
						<tr>
							<th>Duration</th>
							<td id="duration"></td>
						</tr>

						<tr>
							<th>Tags</th>
							<td id="tags"><?php the_tag(); ?></td>
						</tr>

					</table>
				</div>