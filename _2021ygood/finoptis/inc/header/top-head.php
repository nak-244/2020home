<?php
/* Top Header part for grassy template
*/
global $finoptis_option;
?>
<?php if(!empty($finoptis_option['show-top'])){ 
  if(is_page()){
     $rs_top_bar = get_post_meta($post->ID, 'top_bar', true);
     if($rs_top_bar == 'Show' || $rs_top_bar == ''){
     ?> 
    <div class="toolbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-7 col-xs-12">
            <div class="toolbar-contact">
              <ul>
                <?php if(!empty($finoptis_option['welcome-text'])) { ?>
                <li> <i class="fa fa-handshake-o"></i> <?php echo esc_html($finoptis_option['welcome-text']); ?> </li>
                <?php } ?>
                <?php if(!empty($finoptis_option['top-email'])) { ?>
                <li> <i class="fa fa-envelope-o"></i><a href="mailto:<?php echo esc_attr($finoptis_option['top-email'])?>"><?php echo esc_html($finoptis_option['top-email'])?></a> </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-sm-5 col-xs-12">
            <div class="toolbar-sl-share">
              <ul>
                <?php
                if(!empty($finoptis_option['show-social'])){
                  $top_social = $finoptis_option['show-social']; 
              
                    if($top_social == '1'){              
                      if(!empty($finoptis_option['facebook'])) { ?>
                      <li> <a href="<?php echo esc_url($finoptis_option['facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                      <?php } ?>
                      <?php if(!empty($finoptis_option['twitter'])) { ?>
                      <li> <a href="<?php echo esc_url($finoptis_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> </li>
                      <?php } ?>
                      <?php if(!empty($finoptis_option['rss'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['pinterest'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['linkedin'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['google'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['instagram'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> </li>
                      <?php } ?>
                      <?php if(!empty($finoptis_option['vimeo'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['tumblr'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['youtube'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['youtube']);?> " target="_blank"><i class="fa fa-youtube"></i></a> </li>
                      <?php } 
                      }
                  }
                 ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php 
  }
 }
 else{
  ?>
  <div class="toolbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-7 col-xs-12">
            <div class="toolbar-contact">
              <ul>
                <?php if(!empty($finoptis_option['welcome-text'])) { ?>
                <li> <i class="fa fa-handshake-o"></i> <?php echo esc_html($finoptis_option['welcome-text']); ?> </li>
                <?php } ?>                
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-sm-5 col-xs-12">
            <div class="toolbar-sl-share">
              <ul>
                <?php
                if(!empty($finoptis_option['show-social'])){
                  $top_social = $finoptis_option['show-social']; 
              
                    if($top_social == '1'){              
                      if(!empty($finoptis_option['facebook'])) { ?>
                      <li> <a href="<?php echo esc_url($finoptis_option['facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                      <?php } ?>
                      <?php if(!empty($finoptis_option['twitter'])) { ?>
                      <li> <a href="<?php echo esc_url($finoptis_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> </li>
                      <?php } ?>
                      <?php if(!empty($finoptis_option['rss'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['pinterest'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['linkedin'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['google'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['instagram'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> </li>
                      <?php } ?>
                      <?php if(!empty($finoptis_option['vimeo'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['tumblr'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr"></i></a> </li>
                      <?php } ?>
                      <?php if (!empty($finoptis_option['youtube'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['youtube']);?> " target="_blank"><i class="fa fa-youtube"></i></a> </li>
                      <?php } 
                      }
                  }
                 ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
 }
} ?>
