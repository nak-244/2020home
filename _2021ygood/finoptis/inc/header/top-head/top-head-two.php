<?php
/* Top Header part for finoptis Theme
*/
global $finoptis_option;
$rs_top_bar = get_post_meta(get_the_ID(), 'select-top', true);
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{
    $header_width = $finoptis_option['header-grid'];
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}
?>
<?php if(!empty($finoptis_option['show-top']) || ($rs_top_bar=='show')){
     ?> 
    <div class="toolbar-area">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-lg-7">
            <div class="toolbar-contact">
              <ul class="rs-contact-info">
                <?php if(!empty($finoptis_option['top-email'])) { ?>
                  <li class="rs-contact-email">
                      <i class="glyph-icon flaticon-email"></i>                  
                            <a href="mailto:<?php echo esc_attr($finoptis_option['top-email'])?>"><?php echo esc_html($finoptis_option['top-email'])?></a>                   
                  </li>
                <?php } ?> 

                <?php if(!empty($finoptis_option['phone'])) { ?>
                  <li class="rs-contact-phone">
                    <i class="fa flaticon-call"></i>                                      
                        <a href="tel:+<?php echo esc_attr(str_replace(" ","",($finoptis_option['phone'])))?>"> <?php echo esc_html($finoptis_option['phone']); ?></a>                   
                  </li>
                <?php } ?>

                <?php if(!empty($finoptis_option['top-location'])) { ?>              
                  <li class="rs-contact-location">
                    <i class="fa flaticon-location"></i> 
                    <span class="contact-inf">
                      <span><?php if(!empty($finoptis_option['location-pretext'])): echo esc_html($finoptis_option['location-pretext']); endif;?> </span>
                     <?php echo esc_html($finoptis_option['top-location'])?>
                    </span>
                  </li>
                <?php } ?>
            </ul>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="toolbar-sl-share">
              <ul class="clearfix">
                <?php if (!empty($finoptis_option['top-opening'])) { ?>
                    <li class="opening">
                        <i class="fa flaticon-clock"></i>
                        <?php echo esc_html($finoptis_option['top-opening'])?>                            
                        </li>
                <?php } ?>
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
                      <?php if (!empty($finoptis_option['vk'])) { ?>
                      <li> <a href="<?php  echo esc_url($finoptis_option['vk']);?> " target="_blank"><i class="fa fa-vk"></i></a> </li>
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
} ?>
