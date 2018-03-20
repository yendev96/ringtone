<div class="info-post">
	<div class="left-info-post">
		<h1><?php the_title(); ?></h1>
		<p class="view-size">
			<i class="fas fa-eye"> <?php echo getPostViews(get_the_ID()); ?></i>
			<i class="fas fa-download"> <?php if($post->download_count == NULL){echo "0";}else{echo $post->download_count;} ?></i>
			<i class="fas fa-file"> <span id="size2"></span></i>
		</p>
		<p>

			<a href="<?php echo get_domain('/dowload?id='.$post->ID.'&type=mp3');?>"  rel="nofollow" title="Dowload <?php echo $post->post_title;?>">
				<button type="button" class="buton-download"><i class="fas fa-download"></i> Dowload MP3</button>
			</a>
			<a href="<?php echo get_domain('/dowload?id='.$post->ID.'&type=m4r');?>" rel="nofollow" title="Dowload <?php echo $post->post_title;?>">
				<button type="button" class="buton-download" ><i class="fas fa-download"></i> Dowload M4R</button>
			</a>

		</p>
	</div>
	<div class="post_qrcode" style="float: left; position: absolute; right: 0; bottom: 0;">
		<img class="pull-right" src="https://chart.googleapis.com/chart?chs=130x130&amp;cht=qr&amp;chl=<?php echo get_domain('/dowload?id='.$post->ID);?>&amp;t=mp3" title="qr code link" alt="scan qr code to download">
	</div>
</div>
<div id="my_jquery_jplayer_<?php echo $post->ID;?>" class="jp-jplayer"></div>
<div id="my_jp_container_<?php echo $post->ID;?>" class="jp-audio" role="application" aria-label="media player" style="width: 100%;">
	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
			<div class="jp-controls" style="width: 140px;">
				<button class="jp-play" role="button" tabindex="0">play</button>
				<button class="jp-stop" role="button" tabindex="0">stop</button>
			</div>
			<div class="jp-progress">
				<div class="jp-seek-bar" style="width: 100%;">
					<div class="jp-play-bar" style="width: 0%;"></div>
				</div>
			</div>
			<div class="jp-volume-controls">
				<button class="jp-mute" role="button" tabindex="0">mute</button>
				<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value" style="width: 80%;"></div>
				</div>
			</div>
			<div class="jp-time-holder">
				<div class="jp-current-time" role="timer" aria-label="time">00:00</div>
				<div class="jp-duration time-audio" role="timer" aria-label="duration">-03:29</div>
				<div class="jp-toggles">
					<button class="jp-repeat" role="button" tabindex="0">repeat</button>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
<div class="post-content">
	<?php echo $post->post_content; ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		if("<?php echo get_audio_mp3($post->ID)?>"){
			getDuration("<?php echo get_audio_mp3($post->ID)?>", function(length) {
				if(length){
					document.getElementById("duration").textContent = length + ' s';
				}
			});
		}else{
			document.getElementById("duration").textContent = '0s';
		}
		

		get_filesize("<?php echo get_audio_mp3($post->ID)?>", function(size) {
			if(size){
				var size_audio = bytesToSize(size)
				document.getElementById("size").textContent = size_audio;
				document.getElementById("size2").textContent = size_audio;
			}else{
				document.getElementById("size").textContent = "0KB";
				document.getElementById("size2").textContent = "0KB";
			}
			

		});


	});
</script>
<script type="text/javascript">
	$(document).ready(function(){

		$("#my_jquery_jplayer_<?php echo $post->ID;?>").jPlayer({
			ready: function () {
				$(this).jPlayer("setMedia", {
					mp3: "<?php echo get_audio_mp3($post->ID);?>"
				});
			},
			cssSelectorAncestor: "#my_jp_container_<?php echo $post->ID;?>",
			swfPath: "/js",
			supplied: "mp3",
			useStateClassSkin: true,
			autoBlur: false,
			smoothPlayBar: true,
			keyEnabled: true,
			remainingDuration: true,
			toggleDuration: true
		});
	});

</script>