
<?php
    global $finoptis_option;    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if  ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
      $header_width = $finoptis_option['header-grid'];
      $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
  if($post_meta_data == ''){
    if(!empty($finoptis_option['header_banner']['url'])):
      $post_meta_data = $finoptis_option['header_banner']['url'];
    endif;
  }  

  $banner_hide = get_post_meta(get_the_ID(), 'banner_hide', true);

  if( 'show' == $banner_hide ||  $banner_hide == '' ){  
    $post_meta_data = $post_meta_data;
  }else{
    $post_meta_data = '';
  }
?>

<?php $post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true); ?>

<?php if($post_meta_data !=''){   
?>

<div class="rs-breadcrumbs">
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($post_meta_data); ?>')">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
              <?php 
                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
              <?php if($post_meta_title == 'show'){             
              ?>
              <h1 class="page-title">
                <?php the_title();?>
              </h1>
              <?php } 
              $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
              if($rs_breadcrumbs == 'show'):        
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
</div>
<?php }
else{   
$post_meta_bread = get_post_meta(get_the_ID(), 'select-bread', true);?>
<?php if($post_meta_bread =='show' || $post_meta_bread ==''){?>
<div class="rs-breadcrumbs  porfolio-details">
  <div class="rs-breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
    <div class="<?php echo esc_attr($header_width);?>">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">
            <h1 class="page-title">
              <?php the_title();?>
            </h1>
             <?php if(function_exists('breadcrumb_trail')) {
                breadcrumb_trail();
                }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  }
  else{
    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
    <?php if($post_meta_title == 'hide'){
      }
    else{
      ?>
      <div class="<?php echo esc_attr($header_width);?> inner-page-title">
        <h1>
          <?php the_title();?>
        </h1>
      </div>
  <?php } 
      }
  }
?>