<?php
    global $finoptis_option;    
    $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = $finoptis_option['header-grid'];
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php
    $post_menu_type = get_post_meta(get_queried_object_id(), 'menu-type', true);
    $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true); 
 ?>

<div class="rs-breadcrumbs  porfolio-details">
<?php if($post_meta_data !='') { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $post_meta_data );?>')">
        <div class="<?php echo esc_attr($header_width);?>">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                    <h1 class="page-title">
                        <?php the_title();?>
                    </h1>
                    <?php } 
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if( $rs_breadcrumbs != 'hide' ):        
                    if(function_exists('breadcrumb_trail')) {
                    breadcrumb_trail();
                    }
                    endif;
                ?>    
              </div>
            </div>
          </div>
        </div>
    </div>
<?php }

elseif (!empty($finoptis_option['blog_banner']['url'])) {?>
<div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $finoptis_option['blog_banner']['url'] );?>')">
    <div class="<?php echo esc_attr($header_width);?>">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
            <?php 
                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                <?php if( $post_meta_title != 'hide' ){             
                ?>
                <h1 class="page-title">
                    <?php the_title();?>
                </h1>
                <?php } 
                $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                if($rs_breadcrumbs != 'hide' ):        
                if(function_exists('breadcrumb_trail')) {
                breadcrumb_trail();
                }
                endif;
            ?>
          </div>
        </div>
      </div>
    </div>
</div>
    
<?php }else{?>
    <div class="rs-breadcrumbs-inner">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                        <h1 class="page-title">
                            <?php the_title();?>
                        </h1>
                    <?php } 
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if($rs_breadcrumbs != 'hide' && function_exists('breadcrumb_trail') ): 
                        
                        breadcrumb_trail();
                   
                    endif;
                ?>             
                </div>
              </div>
            </div>
          </div>
    </div>
<?php } ?>
</div>