<?php 
global $finoptis_option;

if(!empty($finoptis_option['show_preloader']))
	{
    $loading = $finoptis_option['show_preloader'];
		$preloader_img = $finoptis_option['preloader_img'];
		if($loading == 1){
      if(empty($preloader_img['url'])):
	    ?>  
        <div id="loading">
            <div class="loader">
              <div class="loader__bar"></div>
              <div class="loader__bar"></div>
              <div class="loader__bar"></div>
              <div class="loader__bar"></div>
              <div class="loader__bar"></div>
              <div class="loader__ball"></div>
            </div>
        </div>
      <?php else: ?>
        <div id="loading" class="image-preloader"><div class="loader"><img src="<?php echo esc_url($preloader_img['url']);?>" ></div></div>    
      <?php endif; ?>
 	<?php }
}?>

 <?php if(!empty($finoptis_option['off_sticky'])):   
        $sticky = $finoptis_option['off_sticky'];         
        if($sticky == 1):
         $sticky_menu ='menu-sticky';       
        endif;
       else:
       $sticky_menu ='';
      endif;


if( is_page() ){
 $post_meta_header = get_post_meta($post->ID, 'trans_header', true);  

     if($post_meta_header == 'Default Header'){       
        $header_style = 'default_header';             
     }
     else{
        $header_style = 'transparent_header';
    }
 }
 else{
    $header_style = 'transparent_header';
 }

 ?>   