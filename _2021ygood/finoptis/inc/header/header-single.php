<?php

/*
Header Style 1
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

<header id="rs-header" class="single-header header-style1">
    <div class="header-inner <?php echo esc_attr($sticky_menu);?>">
        <!-- Toolbar Start -->
        <?php       
           get_template_part('inc/header/top-head/top-head','two');
        ?>
        <!-- Toolbar End -->
        
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
                <div class="row-table">
                    <div class="col-cell header-logo">
                    <?php get_template_part('inc/header/logo');  ?>
                    </div>
                    <div class="col-cell menu-responsive">  
                        <?php 
                        $offborder ="";
                        if(!empty($finoptis_option['off_canvas']) && !empty($finoptis_option['off_search'])):
                             $offborder="off-border-left"; 
                        endif;


                        if(!empty($finoptis_option['off_canvas'])): ?>
                        <div class="sidebarmenu-area text-right <?php echo esc_attr($offborder); ?>">
                          <?php 
                            //off convas here
                            get_template_part('inc/header/off-canvas');
                          ?> 
                        </div>
                        <?php endif; 


                        if(!empty($finoptis_option['off_search'])): ?>
                        <div class="sidebarmenu-search text-right">
                            <?php 
                                //include sticky search here
                                get_template_part('inc/header/search');
                            ?> 
                        </div>                        
                        <?php endif; 


                        //include Cart here
                        if(!empty($finoptis_option['wc_cart_icon'])) { ?>
                          <?php  get_template_part('inc/header/cart'); ?>
                        <?php }


                        if(!empty($finoptis_option['off_canvas']) || !empty($finoptis_option['off_search'])):
                          $menu_right='nav-right-bar';
                        else:
                          $menu_right=''; 
                        endif;
                        get_template_part('inc/header/menu-single'); 
                        ?>                
                    </div>
                </div>
            </div> 
        </div>
        <!-- Header Menu End -->
    </div>
     <!-- End Slider area  -->
   <?php 
    get_template_part( 'inc/breadcrumbs' );
  ?>
</header>


<?php  

    //floating bar section
    $float_bar_pos = get_post_meta(get_the_ID(), 'float_bar_pos', true);
    if( !empty($finoptis_option['show-top']) ){
        if(!empty($float_bar_pos)){
            if( ($float_bar_pos == 'left') || ($float_bar_pos == 'right') ){
                require get_parent_theme_file_path('inc/header/top-head/floating-bar.php');
            }
        }elseif( ($finoptis_option['bar_position'] == 'left') || ($finoptis_option['bar_position'] == 'right') ){
            require get_parent_theme_file_path('inc/header/top-head/floating-bar.php');
        } 
    }

    get_template_part('inc/header/slider/slider');
?>
