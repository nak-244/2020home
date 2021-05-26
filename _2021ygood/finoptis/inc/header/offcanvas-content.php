<?php 

global $finoptis_option;
if(!empty($finoptis_option['facebook']) || !empty($finoptis_option['twitter']) || !empty($finoptis_option['rss']) || !empty($finoptis_option['pinterest']) || !empty($finoptis_option['google']) || !empty($finoptis_option['instagram']) || !empty($finoptis_option['vimeo']) || !empty($finoptis_option['tumblr']) ||  !empty($finoptis_option['youtube'])){
?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($finoptis_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($finoptis_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($finoptis_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($finoptis_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($finoptis_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['vk'])) { ?>
          <li> <a href="<?php  echo esc_url($finoptis_option['vk']);?> " target="_blank"><i class="fa fa-vk"></i></a> </li>
          <?php } ?>
        <?php if(!empty($finoptis_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($finoptis_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($finoptis_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }

