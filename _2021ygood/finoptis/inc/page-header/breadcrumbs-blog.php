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

<?php $post_menu_type = get_post_meta(get_queried_object_id(), 'menu-type', true); ?>

<div class="rs-breadcrumbs  porfolio-details">
 <?php
  if(!empty($finoptis_option['blog_banner_main']['url'])) { ?>
  <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($finoptis_option['blog_banner_main']['url']);?>')">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
              <h1 class="page-title">
                <?php    
                if(!empty($finoptis_option['blog_title'])) { ?>
                <?php echo esc_html($finoptis_option['blog_title']);?>
                <?php }
                else{
                 esc_html_e('All Blogs','finoptis');
                }
                ?>
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
  <?php }
  else{   
  ?>
  <div class="rs-breadcrumbs-inner">  
    <div class="<?php echo esc_attr($header_width);?>">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
         <?php    
         if(!empty($finoptis_option['blog_title'])) { ?>
            <h1 class="page-title"><?php echo esc_html($finoptis_option['blog_title']);?></h1>
            <?php }
            else{
               ?>
               <h1 class="page-title"> <?php esc_html_e('Blog','finoptis'); ?></h1>
           <?php  
               }?>          
          
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
?>  
</div>