<?php

/*
Header Style 4
*/
global $finoptis_option;
$sticky = $finoptis_option['off_sticky']; 
$sticky_menu = ($sticky == 1) ? ' menu-sticky' : '';

$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{
    $header_width = $finoptis_option['header-grid'];
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}
?>

<header id="rs-header" class="header-style-4">
    <div class="header-inner<?php echo esc_attr($sticky_menu);?>">
       <!-- Toolbar Start -->
       <?php          
          get_template_part('inc/header/top-head/top-head-one');
        ?>
      <!-- Toolbar End -->

      <!-- Logo Area Start -->
      <div class="logo-section">
        <div class="<?php echo esc_attr($header_width);?>">
            <div class="row-table">        
                <div class="col-cell">
                    <?php  get_template_part('inc/header/logo'); ?>
                </div>
                <?php if(!empty($finoptis_option['phone']) || !empty($finoptis_option['top-email']) || !empty($finoptis_option['top-location'])){?>
                <div class="col-cell col-xs-12">
                    <div class="toolbar-contact-style4">
                      <ul class="rs-contact-info">
                        <?php if(!empty($finoptis_option['phone'])) { ?>
                        <li class="rs-contact-phone">
                            <i class="fa flaticon-call"></i>
                            <span class="contact-inf">
                              <span><?php if(!empty($finoptis_option['phone-pretext'])): echo esc_html($finoptis_option['phone-pretext']); endif;?> </span>
                              <a href="tel:+<?php echo esc_attr(str_replace(" ","",($finoptis_option['phone'])))?>"> <?php echo esc_html($finoptis_option['phone']); ?></a> 
                            </span>
                        </li>
                        <?php } ?>

                        <?php if(!empty($finoptis_option['top-email'])) { ?>
                        <li class="rs-contact-email">
                            <i class="glyph-icon flaticon-email"></i>
                            
                              <span class="contact-inf">
                                <span><?php if(!empty($finoptis_option['email-pretext'])): echo esc_html($finoptis_option['email-pretext']); endif;?> </span>
                                  <a href="mailto:<?php echo esc_attr($finoptis_option['top-email'])?>"><?php echo esc_html($finoptis_option['top-email'])?></a> 
                              </span>
                        </li>
                        <?php } ?>
                        <?php if(!empty($finoptis_option['location-pretext'])) { ?>              
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
            <?php } ?>
          </div>
        </div>
      </div>

      <!-- Header Menu Start -->  
      <?php
        $menu_bg = '';
        //check individual header 
        if(is_page() || is_single()){
            $menu_bg = get_post_meta(get_the_ID(), 'menu-type-bg', true);
        } elseif(is_home() && !is_front_page() || is_home() && is_front_page()){
            $menu_bg= get_post_meta(get_queried_object_id(), 'menu-type-bg', true);
        }
        $menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
        ?>
      <div class="menu-area" <?php echo wp_kses_post($menu_bg_color);?>>
            <div class="<?php echo esc_attr($header_width);?>">
                <div class="menu_one">
                        <div class="row-table">               
                        <div class="col-cell menu-responsive">  
                            <?php                     

                                if(is_page_template('page-single.php')){
                                    require get_parent_theme_file_path('inc/header/menu-single.php'); 
                                }else{
                                    require get_parent_theme_file_path('inc/header/menu.php'); 
                                } 

                            ?>
                        </div>            
                        <?php
                        if(!empty($finoptis_option['quote'])):   
                          $quote_menu = $finoptis_option['quote'];                        
                        endif;        
                        ?>

                        <div class="col-cell header-quote">                         
                            
                            <?php
                                //include Cart here
                            if(!empty($finoptis_option['wc_cart_icon'])) { ?>
                            <?php  get_template_part('inc/header/cart'); ?>
                            <?php } ?> 

                            
                            <?php if(!empty($finoptis_option['off_search'])): ?>
                            <div class="sidebarmenu-search">
                                  <?php 
                                    //include sticky search here
                                    get_template_part('inc/header/search');
                                  ?> 
                            </div>
                            <?php endif; ?>                            

                            <?php if(!empty($finoptis_option['off_canvas'])): ?>
                            <div class="sidebarmenu-area text-right <?php echo esc_attr($offborder); ?>">
                              <?php 
                                //off convas here
                                get_template_part('inc/header/off-canvas');
                              ?> 
                            </div>
                            <?php endif; ?>

                            <?php
                            if(!empty($finoptis_option['quote'])){?>
                                <div class="btn_quote"><a href="<?php echo esc_url($finoptis_option['quote_link']); ?>" class="quote-button"><?php  echo esc_html($finoptis_option['quote']); ?></a></div>
                            <?php }  ?> 

                        </div> 
                    </div>
                </div>
            </div>    
        </div>
      <!-- Header Menu End --> 
    </div>
  <?php 
      get_template_part( 'inc/breadcrumbs' );
  ?>
    <!-- Slider Start Here -->
    <?php  get_template_part('inc/header/slider/slider'); ?>
</header>
