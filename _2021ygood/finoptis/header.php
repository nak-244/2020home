<?php

/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php global $finoptis_option; ?>
<?php wp_head(); ?>
	 <!-- fontawesome CDN -->
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css"> -->
	<link rel = "stylesheet" href = "https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css" >
	 <!-- //fontawesome CDN -->
</head>

<body <?php body_class(); ?>>
  
 <!--Preloader start here-->
   <?php get_template_part( 'inc/header/preloader' ); ?>
 <!--Preloader area end here-->
 <?php
    if(is_page()):
       $page_bg = get_post_meta( $post->ID, 'page_bg', true ); 
       $page_bg_back = ( $page_bg == 'Dark' ) ? 'dark' : '';
       else:
       $page_bg_back = '';
    endif;
    ?>
  <div id="page" class="site <?php echo esc_attr($page_bg_back);?>">
  <?php
   get_template_part('inc/header/header'); 
  ?>
 
  <!-- End Header Menu End -->
  <div class="main-contain">
