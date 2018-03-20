<?php get_header(); ?>
<br><br>
<section id="sec-ringtones" style="padding-bottom: 100px;margin-top: -50px;">
	<div class="container-fluid my-container-fluid">
		<!-- NEW RINGTONES -->
		<div class="row">
			<div class="title">
				<h1><i class="fas fa-headphones"></i>NEW RIGTONES</h1>
			</div>
		</div>
		<div class="row">
			<?php
                get_post_new_home(12);
                ?>
            </div>

            <!-- POPULAR RINGTONES -->
            <div class="row">
            	<div class="title">
            		<h2><i class="fas fa-headphones"></i>POPULAR RIGTONES</h2>
            	</div>
            </div>
            <div class="row">
            	<?php
            	get_post_category(12,5);
            	?>
            </div>


            <!-- FEATURED RINGTONES -->
            <div class="row">
            	<div class="title">
            		<h2><i class="fas fa-headphones"></i>FEATURED RIGTONES</h2>
            	</div>
            </div>
            <div class="row">
            	<?php
            	get_post_category(12,6);
            	?>
            </div>
        </div>
    </section>
    <?php get_footer() ?>
</div>
</body>
</html>