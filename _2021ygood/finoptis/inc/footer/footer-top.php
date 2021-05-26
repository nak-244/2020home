
<?php
    global $finoptis_option; 
    $header_grid2 = "";
    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom2', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = $finoptis_option['header_grid2'];
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php
    /* The footer widget area is triggered if any of the areas
     * have widgets. So let's check that first.
     *
     * If none of the sidebars have widgets, then let's bail early.
     */
    if (   ! is_active_sidebar( 'footer1'  )
        && ! is_active_sidebar( 'footer2' )
        && ! is_active_sidebar( 'footer3'  )
        && ! is_active_sidebar( 'footer4' )
    ){
      
    } 
   global $finoptis_option 
?>

<?php if(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && is_active_sidebar('footer4'))
  {?>
  <div class="footer-top">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-lg-3">                                  
                <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
                <?php } ?>            
              <?php dynamic_sidebar('footer1');?>      
                              
          </div>              
          <div class="col-lg-3">
            <?php dynamic_sidebar('footer2'); 
            
            ?>                             
          </div>
          <div class="col-lg-3">
              <?php dynamic_sidebar('footer3'); ?>
             
          </div>
          <div class="col-lg-3">
             <?php dynamic_sidebar('footer4'); ?>   
          </div>
      </div>
    </div>
  </div>
  <?php }
 elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  {?>
  <div class="footer-top">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-lg-4">                                          
              <div class="about-widget widget">
                <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
                <?php } ?> 
                <?php dynamic_sidebar('footer1');?>                  
                  
              </div>                       
          </div>              
          <div class="col-lg-5">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>
          <div class="col-lg-3">
              <?php dynamic_sidebar('footer3'); 
             ?> 
          </div>         
      </div>
    </div>
  </div>
<?php } 
 elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                </a>
            <?php } ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
  }

elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && !is_active_sidebar('footer3') && is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                </a>
            <?php } ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer4'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
}

elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                </a>
            <?php } ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer3'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
}


elseif(!is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                </a>
            <?php } ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer3'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
}

 elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4')) {
?>
<div class="footer-top"> 
<div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-lg-4-12">                                          
              <div class="about-widget widget">
                 <?php              
                   if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                         <img class="footer-logo" src="<?php echo esc_url( $finoptis_option['footer_logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                      <?php } 
                                 
                   ?>
                  <?php dynamic_sidebar('footer1'); 
                  get_template_part ( 'inc/footer/footer','social' );?>
              </div>                  
          </div>                  
      </div>
  </div>
</div>
<?php } 

 elseif(!is_active_sidebar('footer1') && is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4')) {
?>
<div class="footer-top"> 
<div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-md-12">
            <?php if(!empty($finoptis_option['footer_logo']['url'])) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <img src="<?php  echo esc_url($finoptis_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                </a>
            <?php } ?>                                       
                <?php dynamic_sidebar('footer2'); ?>       
          </div>                  
      </div>
  </div>
</div>
<?php } ?>