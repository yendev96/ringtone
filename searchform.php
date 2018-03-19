<div class="container container-search">

	<div class="row">
		<div class="col-lg-6 col-md-8 col-sm-10" style="margin: 0 auto;">
			<form action="<?php echo home_url('/');?>" method="get" class="myboxform">
				<input class="form-control mr-sm-2 myinputform" type="text" name="s" placeholder="Search..." value="<?php echo show_value_search(); ?>">
				<button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
			</form>
		</div>
	</div>
</div>
