<?php
  global $finoptis_option;
  $header_trans = '';
    if(!empty($finoptis_option['header_layout'])){  
               
        $header_style = $finoptis_option['header_layout'];               
        if($header_style == 'style2'){       
            $header_trans = 'heads_trans';    
        }
    }

?>

<div class="rs-breadcrumbs  porfolio-details <?php echo esc_attr($header_trans);?>">
  <?php
  if(!empty($finoptis_option['blog_banner_main']['url'])) { ?>
  <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($finoptis_option['blog_banner_main']['url']);?>')">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="breadcrumbs-inner">
               <h1 class="page-title"><?php
                        if(!empty($finoptis_option['title_404'])){
                          echo esc_html($finoptis_option['title_404']);
                        }
                        else{
                        esc_html_e( '404.', 'finoptis' ); }
                        ?></h1>
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
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">
            <h1 class="page-title"><?php
                     if(!empty($finoptis_option['title_404'])){
                       echo esc_html($finoptis_option['title_404']);
                     }
                     else{
                     esc_html_e( '404.', 'finoptis' ); }
                     ?></h1>
          <?php if(function_exists('breadcrumb_trail')) {
             breadcrumb_trail();
           }
         ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
?>  
</div>