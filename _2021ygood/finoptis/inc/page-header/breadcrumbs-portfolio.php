<div class="rs-breadcrumbs  porfolio-details">
<?php   
    global $finoptis_option;   
    $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true); 
 ?>

<?php if($post_meta_data !='') { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $post_meta_data );?>')">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="breadcrumbs-inner"> 
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){
                        $project_title = (!empty($finoptis_option['portfolio_slug'])) ? $finoptis_option['portfolio_slug'] : '' ?>

                    <h1 class="page-title">
                      <?php $title = ucwords($project_title);  echo esc_html($title); ?>
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

elseif (!empty($finoptis_option['portfolio_single_image']['url'])) {?>
<div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $finoptis_option['portfolio_single_image']['url'] );?>')">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner"> 
            <?php 
                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                <?php if( $post_meta_title != 'hide' ){
                        $project_title = (!empty($finoptis_option['portfolio_slug'])) ? $finoptis_option['portfolio_slug'] : '' ?>

                    <h1 class="page-title">
                      <?php $title = ucwords($project_title);  echo esc_html($title); ?>
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
                <div class="breadcrumbs-inner">
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                   <?php if( $post_meta_title != 'hide' ){
                        $project_title = (!empty($finoptis_option['portfolio_slug'])) ? $finoptis_option['portfolio_slug'] : '' ?>

                    <h1 class="page-title">
                        <?php $title = ucwords($project_title);  echo esc_html($title); ?>
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