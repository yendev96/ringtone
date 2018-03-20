
<div class="container-item">
    <div class="box-item">
        <div id="jquery_jplayer_<?php echo $post->ID;?>" class="cp-jplayer"></div>
        <div id="cp_container_<?php echo $post->ID;?>" class="cp-container" style="float: left;">
            <div class="cp-buffer-holder">
                <div class="cp-buffer-1"></div>
                <div class="cp-buffer-2"></div>
            </div>
            <div class="cp-progress-holder">
                <div class="cp-progress-1"></div>
                <div class="cp-progress-2"></div>
            </div>
            <div class="cp-circle-control"></div>
            <ul class="cp-controls">
                <li><a class="cp-play cp-play-<?php echo $post->ID;?>" tabindex="1">play</a></li>
                <li><a class="cp-pause cp-pause-<?php echo $post->ID;?>" style="display:none;" tabindex="1">pause</a></li>
            </ul>
        </div>
        <div class="title-audio" style="padding:10px 0 0 10px; float: left;">
            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="link-post"><?php echo $post->post_title; ?></a>
            <p class="view-size">
                <i class="fas fa-eye"> <?php echo getPostViews(get_the_ID()); ?></i>
                <i class="fas fa-download"> <?php if($post->download_count == NULL){echo "0";}else{echo $post->download_count;} ?></i>
                <i class="fas fa-file"> <span class="size-<?php echo $post->ID;?>"></span> </i>
            </p>
        </div>
    </div>
    <a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="btn_dowload" style="right: 0;"><i class="fas fa-arrow-alt-circle-down"></i></a>
</div>
<script type="text/javascript">


    get_filesize("<?php echo get_audio_mp3($post->ID)?>", function(size) {
        if(size){
                var size_audio = bytesToSize(size);
                var value = document.getElementsByClassName("size-<?php echo $post->ID;?>");
                for (var i = 0; i < value.length; i++) {
                  value[i].innerHTML = size_audio;;
              }
          }else{
            var value = document.getElementsByClassName("size-<?php echo $post->ID;?>");
            for (var i = 0; i < value.length; i++) {
                value[i].innerHTML = '0KB';
          }
      }
        

    });


</script>
<script type="text/javascript">

    $(document).ready(function(){


        var myCirclePlayer = new CirclePlayer("#jquery_jplayer_<?php echo $post->ID;?>",
        {
            oga: "<?php echo get_audio_mp3($post->ID);?>"
        }, {
            cssSelectorAncestor: "#cp_container_<?php echo $post->ID;?>",
            cssSelector: {
                play: ".cp-play-<?php echo $post->ID;?>",
                pause: ".cp-pause-<?php echo $post->ID;?>"
            },
            swfPath: "../dist/jplayer",
            wmode: "window",
            keyEnabled: true
        });

    });
</script>