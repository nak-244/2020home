<?php
/*
dynamic css file. please don't edit it. it's update automatically when settins changed
*/
add_action('wp_head', 'finoptis_custom_colors', 160);
function finoptis_custom_colors() { 
global $finoptis_option;	
/***styling options
------------------*/
	if(!empty($finoptis_option['body_bg_color']))
	{
	 $body_bg          = $finoptis_option['body_bg_color'];
	}	
	$body_color       = $finoptis_option['body_text_color'];	
	$site_color       = $finoptis_option['primary_color'];
	$secondary_color  = $finoptis_option['secondary_color'];
	$link_hover_color = $finoptis_option['footer_bg_color'];	
	$footer_bgcolor   = $finoptis_option['footer_bg_color'];

	if(!empty($finoptis_option['menu_text_color'])){		
	$menu_text_color         = $finoptis_option['menu_text_color'];
	}
	if(!empty($finoptis_option['menu_text_hover_color'])){		
	$menu_text_hover_color   = $finoptis_option['menu_text_hover_color'];
	}
	if(!empty($finoptis_option['menu_text_active_color'])){		
	$menu_active_color       = $finoptis_option['menu_text_active_color'];
	}
	
	if(!empty($finoptis_option['menu_text_hover_bg'])){		
	$menu_text_hover_bg      = $finoptis_option['menu_text_hover_bg'];
	}
	if(!empty($finoptis_option['menu_text_active_bg'])){		
	$menu_text_active_bg     = $finoptis_option['menu_text_active_bg'];
	}
	
	if(!empty($finoptis_option['drop_text_color'])){		
	$dropdown_text_color     = $finoptis_option['drop_text_color'];
	}
	
	if(!empty($finoptis_option['drop_text_hover_color'])){		
	$drop_text_hover_color   = $finoptis_option['drop_text_hover_color'];
	}			
	
	if(!empty($finoptis_option['drop_text_hoverbg_color'])){		
	$drop_text_hoverbg_color = $finoptis_option['drop_text_hoverbg_color'];
	}
	
	if(!empty($finoptis_option['drop_down_bg_color'])){		
		$drop_down_bg_color = $finoptis_option['drop_down_bg_color'];
	}	
	
	$rs_top_style = get_post_meta(get_the_ID(), 'topbar-color', true);
    if($rs_top_style =='toplight' || $rs_top_style==''){
		$toolbar_bg    = $finoptis_option['toolbar_bg_color'];
		$toolbar_text  = $finoptis_option['toolbar_text_color'];
		$toolbar_link  = $finoptis_option['toolbar_link_color'];
		$toolbar_hover = $finoptis_option['toolbar_link_hover_color'];
	} else{
		$toolbar_bg    = $finoptis_option['toolbar_bg_color2'];
		$toolbar_text  = $finoptis_option['toolbar_text_color2'];
		$toolbar_link  = $finoptis_option['toolbar_link_color2'];
		$toolbar_hover = $finoptis_option['toolbar_link_hover_color2'];
    }

	//typography extract for body
	
	if(!empty($finoptis_option['opt-typography-body']['color']))
	{
		$body_typography_color=$finoptis_option['opt-typography-body']['color'];
	}
	if(!empty($finoptis_option['opt-typography-body']['line-height']))
	{
		$body_typography_lineheight=$finoptis_option['opt-typography-body']['line-height'];
	}
		
	$body_typography_font      =$finoptis_option['opt-typography-body']['font-family'];
	$body_typography_font_size =$finoptis_option['opt-typography-body']['font-size'];

	//typography extract for menu
	$menu_typography_color       =$finoptis_option['opt-typography-menu']['color'];	
	$menu_typography_weight      =$finoptis_option['opt-typography-menu']['font-weight'];	
	$menu_typography_font_family =$finoptis_option['opt-typography-menu']['font-family'];
	$menu_typography_font_fsize  =$finoptis_option['opt-typography-menu']['font-size'];
		
	if(!empty($finoptis_option['opt-typography-menu']['line-height']))
	{
		$menu_typography_line_height=$finoptis_option['opt-typography-menu']['line-height'];
	}
	
	//typography extract for heading
	
	$h1_typography_color=$finoptis_option['opt-typography-h1']['color'];		
	if(!empty($finoptis_option['opt-typography-h1']['font-weight']))
	{
		$h1_typography_weight=$finoptis_option['opt-typography-h1']['font-weight'];
	}
		
	$h1_typography_font_family=$finoptis_option['opt-typography-h1']['font-family'];
	$h1_typography_font_fsize=$finoptis_option['opt-typography-h1']['font-size'];	
	if(!empty($finoptis_option['opt-typography-h1']['line-height']))
	{
		$h1_typography_line_height=$finoptis_option['opt-typography-h1']['line-height'];
	}
	
	$h2_typography_color=$finoptis_option['opt-typography-h2']['color'];	

	$h2_typography_font_fsize=$finoptis_option['opt-typography-h2']['font-size'];	
	if(!empty($finoptis_option['opt-typography-h2']['font-weight']))
	{
		$h2_typography_font_weight=$finoptis_option['opt-typography-h2']['font-weight'];
	}	
	$h2_typography_font_family=$finoptis_option['opt-typography-h2']['font-family'];
	$h2_typography_font_fsize=$finoptis_option['opt-typography-h2']['font-size'];	
	if(!empty($finoptis_option['opt-typography-h2']['line-height']))
	{
		$h2_typography_line_height=$finoptis_option['opt-typography-h2']['line-height'];
	}
	
	$h3_typography_color=$finoptis_option['opt-typography-h3']['color'];	
	if(!empty($finoptis_option['opt-typography-h3']['font-weight']))
	{
		$h3_typography_font_weightt=$finoptis_option['opt-typography-h3']['font-weight'];
	}	
	$h3_typography_font_family=$finoptis_option['opt-typography-h3']['font-family'];
	$h3_typography_font_fsize=$finoptis_option['opt-typography-h3']['font-size'];	
	if(!empty($finoptis_option['opt-typography-h3']['line-height']))
	{
		$h3_typography_line_height=$finoptis_option['opt-typography-h3']['line-height'];
	}

	$h4_typography_color=$finoptis_option['opt-typography-h4']['color'];	
	if(!empty($finoptis_option['opt-typography-h4']['font-weight']))
	{
		$h4_typography_font_weight=$finoptis_option['opt-typography-h4']['font-weight'];
	}	
	$h4_typography_font_family=$finoptis_option['opt-typography-h4']['font-family'];
	$h4_typography_font_fsize=$finoptis_option['opt-typography-h4']['font-size'];	
	if(!empty($finoptis_option['opt-typography-h4']['line-height']))
	{
		$h4_typography_line_height=$finoptis_option['opt-typography-h4']['line-height'];
	}
	
	$h5_typography_color=$finoptis_option['opt-typography-h5']['color'];	
	if(!empty($finoptis_option['opt-typography-h5']['font-weight']))
	{
		$h5_typography_font_weight=$finoptis_option['opt-typography-h5']['font-weight'];
	}	
	$h5_typography_font_family=$finoptis_option['opt-typography-h5']['font-family'];
	$h5_typography_font_fsize=$finoptis_option['opt-typography-h5']['font-size'];	
	if(!empty($finoptis_option['opt-typography-h5']['line-height']))
	{
		$h5_typography_line_height=$finoptis_option['opt-typography-h5']['line-height'];
	}
	
	$h6_typography_color=$finoptis_option['opt-typography-6']['color'];	
	if(!empty($finoptis_option['opt-typography-6']['font-weight']))
	{
		$h6_typography_font_weight=$finoptis_option['opt-typography-6']['font-weight'];
	}
	$h6_typography_font_family=$finoptis_option['opt-typography-6']['font-family'];
	$h6_typography_font_fsize=$finoptis_option['opt-typography-6']['font-size'];	
	if(!empty($finoptis_option['opt-typography-6']['line-height']))
	{
		$h6_typography_line_height=$finoptis_option['opt-typography-6']['line-height'];
	}
	
?>

<!-- Typography -->
<?php if(!empty($body_color)){
	global $finoptis_option;
	$hex = $site_color;
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$site_color_rgb = "$r, $g, $b";
?>



<style>

	<?php if(!empty($finoptis_option['copyright_bg']))
		{
			$copyright_bg = $finoptis_option['copyright_bg'];
		?>
		.footer-bottom{
			background:<?php echo esc_attr($copyright_bg); ?> !important;
		}
	<?php } ?>
	
	body{
		background:<?php echo esc_attr($body_bg); ?> !important;
		color:<?php echo esc_attr($body_color); ?> !important;
		font-family: <?php echo esc_attr($body_typography_font);?> !important;    
	    font-size: <?php echo esc_attr($body_typography_font_size);?> !important;	
	}

	.services-style-5 .services-item{
		box-shadow: 0 0 0 20px rgba(<?php echo esc_attr($site_color_rgb);?>, 0.4), inset 0 0 3px rgba(255, 255, 255, 0.2);
	}


	<?php if(!empty($finoptis_option['breadcrumb_bg_color'])) : ?>
		.rs-breadcrumbs{
			background:<?php echo esc_attr($finoptis_option['breadcrumb_bg_color']); ?>;			
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['breadcrumb_text_color'])) : ?>
		.rs-breadcrumbs .page-title,
		.rs-breadcrumbs ul li *,
		.rs-breadcrumbs ul li.trail-begin a:before,
		.rs-breadcrumbs ul li{
			color:<?php echo esc_attr($finoptis_option['breadcrumb_text_color']); ?> !important;			
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['breadcrumb_gap'])) : ?>
		.rs-breadcrumbs .breadcrumbs-inner{
			padding:<?php echo esc_attr($finoptis_option['breadcrumb_gap']); ?>;			
	}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['menu_text_gap'])) : ?>
		.menu-area .navbar ul li{
			padding-left:<?php echo esc_attr($finoptis_option['menu_text_gap']); ?>;	
			padding-right:<?php echo esc_attr($finoptis_option['menu_text_gap']); ?>;			
	}
	<?php endif; ?>
	
	
		
	h1{
		color:<?php echo esc_attr($h1_typography_color);?> !important;
		font-family:<?php echo esc_attr($h1_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h1_typography_font_fsize);?>!important;
		<?php if(!empty($h1_typography_weight)){
		?>
		font-weight:<?php echo esc_attr($h1_typography_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h1_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h1_typography_line_height);?>!important;
		<?php }?>		
	}
	h2{
		color:<?php echo esc_attr($h2_typography_color);?>; 
		font-family:<?php echo esc_attr($h2_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h2_typography_font_fsize);?>;
		<?php if(!empty($h2_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h2_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h2_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h2_typography_line_height);?>
		<?php }?>
	}
	h3{
		color:<?php echo esc_attr($h3_typography_color);?> ;
		font-family:<?php echo esc_attr($h3_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h3_typography_font_fsize);?>;
		<?php if(!empty($h3_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h3_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h3_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h3_typography_line_height);?>!important;
		<?php }?>
	}
	h4{
		color:<?php echo esc_attr($h4_typography_color);?>;
		font-family:<?php echo esc_attr($h4_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h4_typography_font_fsize);?>;
		<?php if(!empty($h4_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h4_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h4_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h4_typography_line_height);?>!important;
		<?php }?>
		
	}
	h5{
		color:<?php echo esc_attr($h5_typography_color);?>;
		font-family:<?php echo esc_attr($h5_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h5_typography_font_fsize);?>;
		<?php if(!empty($h5_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h5_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h5_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h5_typography_line_height);?>!important;
		<?php }?>
	}
	h6{
		color:<?php echo esc_attr($h6_typography_color);?> ;
		font-family:<?php echo esc_attr($h6_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h6_typography_font_fsize);?>;
		<?php if(!empty($h6_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h6_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h6_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h6_typography_line_height);?>!important;
		<?php }?>
	}


	.menu-area .navbar ul li > a{
		font-weight:<?php echo esc_attr($menu_typography_weight); ?>;
		font-family:<?php echo esc_attr($menu_typography_font_family); ?>;
	}

	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li,
	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li i,
	#rs-header .toolbar-area .toolbar-contact ul li, #rs-header .toolbar-area{
		color:<?php echo esc_attr($toolbar_text); ?>;
	}


	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li a,
	#rs-header .toolbar-area .toolbar-contact ul li a,
	#rs-header .toolbar-area .toolbar-sl-share ul li a i{
		color:<?php echo esc_attr($toolbar_link); ?>;
	}

	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li a:hover,
	#rs-header .toolbar-area .toolbar-contact ul li a:hover, 
	#rs-header .toolbar-area .toolbar-sl-share ul li a i:hover{
		color:<?php echo esc_attr($toolbar_hover); ?>;
	}
	#rs-header .toolbar-area{
		background:<?php echo esc_attr($toolbar_bg); ?>;
	}

	.menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
	.menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a,
	.mobile-menu-container div ul > li.current_page_parent > a,
	#rs-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor a, 
	#rs-header.header-transparent .menu-area .navbar ul li.current_page_item a,
	#rs-header.header-style5 .menu-area .navbar ul > li.current-menu-ancestor > a, 
	#rs-header.header-style5 .menu-area .navbar ul > li.current_page_item > a,
	.menu-area .navbar ul.menu > li.current_page_item > a,
	#rs-header.header-style-4 .menu-sticky.sticky .menu-area .menu > li.current-menu-ancestor > a,
	.menu-area .navbar ul.menu > li.current-menu-ancestor > a,
	#rs-header.header-style5 .header-inner .menu-area .navbar ul > li.current-menu-ancestor > a,
	#rs-header.header-style5 .header-inner.menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
	#rs-header.header-style-4 .menu-area .menu > li.current-menu-ancestor > a
	{
		color: <?php echo esc_attr( $menu_active_color ); ?> !important;
	}
	.menu-area .navbar ul:not(.sub-menu) > li > a{
		font-size: <?php echo esc_attr( $menu_typography_font_fsize ); ?> !important;
	}

	.menu-area .navbar ul li:hover > a,
	#rs-header .menu-sticky.sticky .menu-area .navbar ul li:hover > a,
	#rs-header.header-style1 .menu-sticky.sticky .menu-area .navbar ul li:hover > a,
	.mobile-menu-container div ul li a:hover,
	#rs-header.header-style-4 .menu-sticky.sticky .menu-area .navbar ul li:hover > a,
	#rs-header.header-style5 .header-inner .menu-area .navbar ul li:hover > a,
	#rs-header.header-style5 .header-inner.menu-sticky.sticky .menu-area .navbar ul li:hover > a,
	#rs-header.header-style-4 .menu-area .menu li:hover > a
	{
		color: <?php echo esc_attr( $menu_text_hover_color ); ?>;
	}

	.menu-area .navbar ul li a,
	#rs-header .menu-responsive .sidebarmenu-search .sticky_search,
	#rs-header .menu-sticky.sticky .menu-area .navbar ul li a,
	#rs-header.header-style5 .header-inner.menu-sticky.sticky .menu-area .navbar ul li a,
	.menu-cart-area i, #rs-header.header-transparent .menu-area.dark .menu-cart-area i,
	#rs-header .menu-sticky.sticky .menu-area .navbar ul li a
	{
		color: <?php echo esc_attr( $menu_text_color ); ?>; 
	}

	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li.current_page_item > a::before, 
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li.current_page_item > a::after, 
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li > a::before,
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li > a::after,
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li > a,
	.breadcrumbs-inner.bread-dark h1,
	.rs-breadcrumbs .breadcrumbs-inner.bread-dark .trail-items li::after,
	.rs-breadcrumbs .breadcrumbs-inner.bread-dark ul li.trail-begin a::before,
	.rs-breadcrumbs .breadcrumbs-inner.bread-dark ul li *,
	#rs-header.header-transparent .menu-area.dark .menu-responsive .sidebarmenu-search .sticky_search .fa
	{
		color: <?php echo esc_attr( $menu_text_color ); ?> !important;
	}

	.header-style1 .menu-cart-area span.icon-num, 
	.header-style3 .menu-cart-area span.icon-num
	{
		background: <?php echo esc_attr( $menu_text_color ); ?> !important;
	}


	#rs-header.header-transparent .menu-area.dark ul.offcanvas-icon .nav-link-container .nav-menu-link span{
		background: <?php echo esc_attr( $menu_text_color ); ?> !important;
	}

	#rs-header.header-transparent .menu-area.dark ul.sidenav.offcanvas-icon .nav-link-container .nav-menu-link span{
		background: #fff !important;
	}

	ul.offcanvas-icon .nav-link-container .nav-menu-link span{
		background: <?php echo esc_attr( $menu_text_color ); ?>;
	}
	
	<?php if(!empty($finoptis_option['transparent_menu_text_color'])) : ?>
		#rs-header.header-transparent .menu-area .navbar ul li a, #rs-header.header-transparent .menu-cart-area i,
		#rs-header.header-transparent .menu-responsive .sidebarmenu-search .sticky_search .fa,
		#rs-header.header-transparent .menu-area.dark .navbar ul > li > a,
		#rs-header.header-style5 .header-inner .menu-area .navbar ul li a,
		#rs-header.header-transparent .menu-area .navbar ul li:hover > a,
		#rs-header.header-style5 .menu-responsive .sidebarmenu-search .sticky_search,
		#rs-header.header-style5 .menu-cart-area i{
			color:<?php echo esc_attr($finoptis_option['transparent_menu_text_color']); ?> 
	}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['transparent_menu_text_color'])) : ?>
		.header-transparent .menu-cart-area span.icon-num, 
		.header-style-4 .menu-cart-area span.icon-num, 
		.header-style5 .menu-cart-area span.icon-num
		{
			background: <?php echo esc_attr($finoptis_option['transparent_menu_text_color']); ?> !important;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['transparent_menu_hover_color'])) : ?>
		.header-transparent .sticky .menu-cart-area span.icon-num, 
		.header-style-4 .sticky .menu-cart-area span.icon-num, 
		.header-style5 .sticky .menu-cart-area span.icon-num
		{
			background: <?php echo esc_attr($finoptis_option['transparent_menu_hover_color']); ?> !important;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['menu_area_bg_color'])) : ?>
		#rs-header.header-style5 .header-inner .menu-area, 
		.menu-area{
		background:<?php echo esc_attr($finoptis_option['menu_area_bg_color']); ?> 
	}
	<?php endif; ?>

	

	<?php if(!empty($finoptis_option['transparent_menu_text_color'])) : ?>
		#rs-header.header-transparent .menu-area.dark ul.offcanvas-icon .nav-link-container .nav-menu-link span{
			background:<?php echo esc_attr($finoptis_option['transparent_menu_text_color']); ?> 
		}
	<?php endif; ?>


	<?php if(!empty($finoptis_option['transparent_menu_hover_color'])) : ?>
		#rs-header.header-transparent .menu-area .navbar ul > li > a:hover,
		#rs-header.header-transparent .menu-area .navbar ul li:hover > a,
		#rs-header.header-transparent .menu-area.dark .navbar ul > li:hover > a{
			color:<?php echo esc_attr($finoptis_option['transparent_menu_hover_color']); ?> 
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['transparent_menu_active_color'])) : ?>
		#rs-header.header-transparent .menu-area .navbar ul > li.current_page_item > a,
		#rs-header.header-transparent .menu-area .navbar ul > li.current-menu-ancestor > a,
		#rs-header.header-style-4 .menu-area .menu > li.current_page_item > a{
			color:<?php echo esc_attr($finoptis_option['transparent_menu_active_color']); ?> !important; 
		}
	<?php endif; ?>

	#rs-header.header-transparent .menu-area .navbar ul.menu > li.current_page_item > a::before,
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
	#rs-header.header-transparent .menu-area .navbar ul.menu > li > a::before,
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li.current_page_item > a::before, 
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li > a::before, 
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li.current_page_item > a::after, 
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li > a::after,
	#rs-header.header-transparent .menu-area .navbar ul.menu > li.current_page_item > a::after, 
	#rs-header.header-transparent .menu-area .navbar ul.menu > li > a::after{
		color:<?php echo esc_attr($finoptis_option['transparent_menu_active_color']); ?> !important; 
	}

	<?php if(!empty($finoptis_option['transparent_menu_text_color'])) : ?>		
		#rs-header.header-transparent ul.offcanvas-icon .nav-link-container .nav-menu-link span,
		#rs-header.header-style5 .menu-responsive ul.offcanvas-icon .nav-link-container .nav-menu-link span{
			background:<?php echo esc_attr($finoptis_option['transparent_menu_text_color']); ?> 
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['drop_text_color'])) : ?>
		.menu-area .navbar ul li .sub-menu li a,
		#rs-header .menu-area .navbar ul li.mega ul li a,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a,
		#rs-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor li a{
			color:<?php echo esc_attr($finoptis_option['drop_text_color']); ?> !important;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['drop_text_hover_color'])) : ?>
		.menu-area .navbar ul li ul.sub-menu li.current_page_item > a,
		.menu-area .navbar ul li .sub-menu li a:hover,
		#rs-header .menu-area .navbar ul li.mega ul li a:hover,
		.menu-area .navbar ul li ul.sub-menu li:hover > a,
		#rs-header.header-style5 .header-inner .menu-area .navbar ul li .sub-menu li:hover > a,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li:hover > a,
		#rs-header.header-style-4 .menu-area .menu .sub-menu li:hover > a,
		#rs-header.header-style3 .menu-area .navbar ul li .sub-menu li:hover > a,
		#rs-header .menu-area .navbar ul li.mega ul li.current-menu-item a,
		.menu-sticky.sticky .menu-area .navbar ul li ul li a:hover,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a, #rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current_page_item > a,
		#rs-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor li a:hover{
			color:<?php echo esc_attr($finoptis_option['drop_text_hover_color']); ?> !important;
		}
	<?php endif; ?>



	<?php if(!empty($finoptis_option['drop_down_bg_color'])) : ?>
		.menu-area .navbar ul li .sub-menu{
			background:<?php echo esc_attr($finoptis_option['drop_down_bg_color']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($finoptis_option['toolbar_text_size'])) : ?>
		#rs-header .toolbar-area .toolbar-contact ul li,
		#rs-header .toolbar-area .toolbar-sl-share ul li a i:before{
			font-size:<?php echo esc_attr($finoptis_option['toolbar_text_size']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['menu_text_trasform'])) : ?>
		.menu-area .navbar ul > li > a{
			text-transform:uppercase;
		}
	<?php endif; ?>



	<?php if(!empty($finoptis_option['copyright_bg_border'])) : ?>
		.footer-bottom{
			border-color:<?php echo esc_attr($finoptis_option['copyright_bg_border']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($finoptis_option['footer_text_size'])) : ?>
		.rs-footer, .rs-footer h3, .rs-footer a, 
		.rs-footer .fa-ul li a, 
		.rs-footer .widget.widget_nav_menu ul li a,
		.rs-footer .widget ul li .fa{
			font-size:<?php echo esc_attr($finoptis_option['footer_text_size']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['footer_h3_size'])) : ?>
		.rs-footer h3, .rs-footer .footer-top h3.footer-title{
			font-size:<?php echo esc_attr($finoptis_option['footer_h3_size']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['footer_link_size'])) : ?>
		.rs-footer a{
			font-size:<?php echo esc_attr($finoptis_option['footer_link_size']); ?>;
		}
	<?php endif; ?>	

	<?php if(!empty($finoptis_option['footer_text_color'])) : ?>
		.rs-footer, .rs-footer h3, .rs-footer a, .rs-footer .fa-ul li a, .rs-footer .widget ul li .fa{
			color:<?php echo esc_attr($finoptis_option['footer_text_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['footer_link_color'])) : ?>
		.rs-footer a:hover,.rs-footer .widget a:hover, .rs-footer .widget.widget_nav_menu ul li a:hover,
		.rs-footer .fa-ul li a:hover{
			color:<?php echo esc_attr($finoptis_option['footer_link_color']); ?>;
		}
	<?php endif; ?>



	<?php if(!empty($finoptis_option['footer_input_bg_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]{
			background:<?php echo esc_attr($finoptis_option['footer_input_bg_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['footer_input_hover_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]:hover{
			background:<?php echo esc_attr($finoptis_option['footer_input_hover_color']); ?>;
		}
	<?php endif; ?>
	
	<?php if(!empty($finoptis_option['footer_input_border_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="email"],
		ul.footer_social li a{
			border-color:<?php echo esc_attr($finoptis_option['footer_input_border_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['footer_input_text_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"],
		.rs-footer .footer-top .mc4wp-form-fields i{
			color:<?php echo esc_attr($finoptis_option['footer_input_text_color']); ?>;
		}
	<?php endif; ?>

	a{
		color:<?php echo esc_attr($finoptis_option['link_text_color']); ?>;
	}
	a:hover,  a:focus,  a:active {
		color:<?php echo esc_attr($finoptis_option['link_hover_text_color']); ?>;
	}
	.rs-heading .title-inner .sub-text,
	.team-grid-style1 .team-item .team-content1 h3.team-name a:hover, .team-slider-style1 .team-item .team-content1 h3.team-name a:hover,
	.rs-services-default .services-wrap .services-item .services-icon i,
	.rs-blog .blog-meta .blog-title a:hover,
	.rs-blog .blog-item .blog-slidermeta span.category a:hover,
	.btm-cate li a:hover,
	.ps-navigation ul a:hover span,
	.rs-blog .blog-item .blog-meta .categories a:hover,
	.bs-sidebar ul a:hover,
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-name a:hover,
	.full-blog-content .blog-title a:hover,
	.rs-contact .contact-address .address-item .address-text a:hover,
	.rs-portfolio-style5 .portfolio-item .portfolio-content a,
	.rs-portfolio-style5 .portfolio-item .portfolio-content h4 a:hover,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i:hover,
	.rs-services1.services-right .services-wrap .services-item .services-icon i:hover,
	.rs-portfolio.style2 .portfolio-slider .portfolio-item:hover .portfolio-content h3.p-title a,
	.rs-portfolio.style2 .portfolio-slider .portfolio-item .portfolio-img .portfolio-content .categories a:hover,
	.portfolio-filter button:hover,
	.rs-galleys .galley-img .zoom-icon:hover,
	ul.listingnew li::before,
	.sidenav .fa-ul li a:hover,
	#about-history-tabs ul.tabs-list_content li:before,
	/* new css */
	.rs-latest-news .news-list-block .news-list-item .news-title a:hover, 
	.rs-latest-news .news-list-block .news-list-item .news-title a:focus,
	.rs-latest-news .news-list-block .news-list-item .categories a:hover,
	.rs-latest-news .news-normal-block .news-info a:hover,
	.rs-footer a:hover,  
	.mobile-menu-container div ul > li.current_page_parent > a,
	.rs-footer .widget.widget_nav_menu ul li a:hover, 
	.rs-footer .fa-ul li a:hover,
	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li a:hover, 
	#rs-header .toolbar-area .toolbar-contact ul li a:hover, 
	#rs-header .toolbar-area .toolbar-sl-share ul li a i:hover{
		color:<?php echo esc_attr($site_color); ?>;
	}
	#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a, 
	#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current_page_item > a{
		color:<?php echo esc_attr($site_color); ?>;
	}

	#cl-testimonial .testimonial-slide7 .single-testimonial:after, #cl-testimonial .testimonial-slide7 .single-testimonial:before{
		border-right-color: <?php echo esc_attr($secondary_color); ?>;
		border-right: 30px solid <?php echo esc_attr($secondary_color); ?>;
	}
	#cl-testimonial .testimonial-slide7 .single-testimonial{
		border-left-color: <?php echo esc_attr($secondary_color); ?>;
	}
	#cl-testimonial .testimonial-slide7 ul.slick-dots li button,
	#rs-header.header-style-4 .sticky ul.offcanvas-icon .nav-link-container .nav-menu-link span{
		background:<?php echo esc_attr($secondary_color); ?>;
	}
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec .team-social a:hover i,
	#rs-header.header-style-4 .sticky .sidebarmenu-search .sticky_search i,
	#rs-header.header-style-4 .sticky .menu-cart-area i,
	#rs-header.header-transparent .menu-sticky.sticky .menu-responsive .sidebarmenu-search .sticky_search .fa, 
	#rs-header.header-transparent .menu-sticky.sticky .menu-cart-area i{
		color:<?php echo esc_attr($secondary_color); ?>;
	}

	.ps-navigation ul a:hover span,
	.rs-footer .widget a:hover, 
	.mobile-menu-container div ul li a:hover,
	.woocommerce ul.products li .woocommerce-loop-product__title a:hover{
		color:<?php echo esc_attr($site_color); ?> !important;
	}
	ul.footer_social li a:hover,
	.team-grid-style1 .team-item .social-icons1 a:hover i, .team-slider-style1 .team-item .social-icons1 a:hover i,
	.owl-carousel .owl-nav [class*="owl-"]:hover,
	#cl-testimonial .testimonial-slide7 ul.slick-dots li.slick-active button,
	html input[type="button"]:hover, input[type="reset"]:hover,
	.rs-video-2 .popup-videos:before,
	.rs-footer .footer-top .mc4wp-form-fields #main-form input[type=submit],
	#rs-header.header-transparent.header-style-6 .menu-area .row-table .canvas-sec .btn_quote .quote-button,
	.sidenav .widget-title:before,
	.rs-team-grid.team-style5 .team-item .team-content,
	.rs-team-grid.team-style4 .team-wrapper .team_desc::before,
	.rs-team .team-item .team-social .social-icon,
	.team-grid-style1 .team-item .social-icons1 a:hover i,	
	.rs-portfolio-style2 .portfolio-item .portfolio-img .read_more:hover,
	.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]:hover
	{
		background:<?php echo esc_attr($site_color); ?> !important;
	}

	.rs-services-style3 .bg-img a,
	.rs-services-style3 .bg-img a:hover{
		background:<?php echo esc_attr($secondary_color); ?>;
		border-color: <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-service-grid .service-item .service-content .service-button .readon.rs_button:hover{
		border-color: <?php echo esc_attr($secondary_color); ?>;;
		color: <?php echo esc_attr($secondary_color); ?>;
	}


	.rs-service-grid .service-item .service-content .service-button .readon.rs_button:hover:before,
	.rs-heading.style6 .title-inner .sub-text,
	.rs-blog .blog-item .blog-button a:hover,
	.full-blog-content .blog-title a,
	ul.index li.active a,
	.portfolio-filter button.active,
	.rs-services-style4:hover .services-icon i,
	body.search-results .site-main > article .entry-summary .blog-button a:hover,
	.rs-heading.style7 .title-inner .sub-text{
		color: <?php echo esc_attr($secondary_color); ?>;
	}

	.rs-breadcrumbs-inner.bread-dark h1.page-title,
	.rs-breadcrumbs-inner.bread-dark ul li,
	.rs-breadcrumbs-inner.bread-dark ul li,
	.rs-breadcrumbs-inner.bread-dark ul li.trail-begin a::before,
	.rs-breadcrumbs-inner.bread-dark ul li *{
		color: <?php echo esc_attr($secondary_color); ?> !important;
	}
	.rs-video-2 .popup-videos{
		background:<?php echo esc_attr($site_color); ?>;
	}
	.bs-sidebar .tagcloud a:hover{
		background-color:<?php echo esc_attr($site_color); ?>;
	}
	.rs-footer .footer-top .mc4wp-form-fields input[type=submit],
	.rs-heading.style6 .title-inner .sub-text:after,
	.team-grid-style3 .team-img .team-img-sec:before,
	.sidenav .offcanvas_social li a i,	
	#sidebar-services .bs-search button:hover,
	.bs-sidebar .widget_product_search .woocommerce-product-search:hover::after,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.over-wrap-index .next,
	.over-wrap-index .prev,
	.cd-timeline__container::before,
	 ul.index li.active::after,
	.cd-timeline__img.cd-timeline__img--picture,
	.single-post .full-date,
	.blog-item .blog-img .full-date,
	.rs-blog .blog-item.style3 .blog-img .blog-meta,
	.full-blog-content .full-date,
	.rs-blog-details .bs-img .blog-date, 
	.rs-blog .bs-img .blog-date, .blog .bs-img .blog-date, 
	.rs-blog-details .blog-img .blog-date, 
	.rs-blog .blog-img .blog-date, 
	.blog .blog-img .blog-date,
	.team-slider-style3 .team-img .team-img-sec:before{
		background: <?php echo esc_attr($secondary_color); ?>;
	}
	<?php if(!empty($finoptis_option['preloader_bg_color'])):?>
		#loading{
			background: <?php echo esc_attr($finoptis_option['preloader_bg_color']); ?>;
		}
    <?php endif; ?>	

    <?php if(!empty($finoptis_option['preloader_text_color'])):?>
		.loader__bar{
			background: <?php echo esc_attr($finoptis_option['preloader_text_color']); ?>;
		}
	 <?php endif; ?>

	<?php if(!empty($finoptis_option['preloader_circle_color'])):?>
		.loader__ball{
			background: <?php echo esc_attr($finoptis_option['preloader_circle_color']); ?>;
		}
	<?php endif; ?>	

	.rs-team-grid.team-style5 .team-item .normal-text .social-icons a:hover i{
		background:<?php echo esc_attr($site_color); ?>;
		color: <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-blog-details .blog-item.style2 .blog-img .blog-date:before, 
	.rs-blog .blog-item.style2 .blog-img .blog-date:before, 
	.blog .blog-item.style2 .blog-img .blog-date:before{
		border-bottom-color: <?php echo esc_attr($secondary_color); ?>;
		border-right: 130px solid <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-services3 .slick-arrow:hover,
	#slider-form-area .form-area input[type="submit"],
	.services-style-5 .services-item:hover .services-title,
	#rs-skills .vc_progress_bar .vc_single_bar .vc_bar{
		background:<?php echo esc_attr($site_color); ?>;
	}
	.bs-sidebar .tagcloud a:hover,
	ul.footer_social li a:hover,	
	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial:after,
	#cl-testimonial .testimonial-slide7 ul.slick-dots li.slick-active button,
	.rs-portfolio-style2 .portfolio-item .portfolio-img .read_more:hover{
		border-color:<?php echo esc_attr($site_color); ?> !important;
	}
	.round-shape:before{
		border-top-color: <?php echo esc_attr($site_color); ?>;
		border-left-color: <?php echo esc_attr($site_color); ?>;
	}
	.round-shape:after{
		border-bottom-color: <?php echo esc_attr($site_color); ?>;
		border-right-color: <?php echo esc_attr($site_color); ?>;
	}
	#cl-testimonial .testimonial-slide7 .testimonial-left img,
	#sidebar-services .download-btn,
	ul.index li::after,
	.cd-timeline__content,
	.cd-timeline__content .cd_timeline_desc,
	#sidebar-services .wpb_widgetised_column{
		border-color:<?php echo esc_attr($secondary_color); ?>;
	}
	.rs-video-2 .overly-border{
		border-color:<?php echo esc_attr($site_color); ?>;
	}

	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial:before,	
	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial:after{
		border-right-color: <?php echo esc_attr($site_color); ?> !important;
		border-top-color: transparent !important;
	}

	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial{
		border-left-color:<?php echo esc_attr($secondary_color); ?> !important;
	}
	.rs-team-grid.team-style5 .team-item .normal-text .person-name a:hover,
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-name a:hover,
	.pagination-area .nav-links a:hover,
	.rs-services-style4.rs-services-style9:hover .services-item .read_more a,
	.team-slider-style2 .team-item-wrap .team-img .normal-text .team-name a:hover{
		color: <?php echo esc_attr($site_color); ?>;
	}

	.blog-saas .blog-wrap-box .blog-title a:hover,
	.blog-saas .rs-blog .blog-item .blog-button a
	{
          color: <?php echo esc_attr($site_color); ?> !important;
    }
    .blog-saas .rs-blog .blog-img .blog-date{
        background: <?php echo esc_attr($site_color); ?> !important;
	}

	.rs-heading .title-inner .title,	
	.team-grid-style1 .team-item .team-content1 h3.team-name a, .team-slider-style1 .team-item .team-content1 h3.team-name a,
	#cl-testimonial .testimonial-slide7 .right-content i,
	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial .cl-author-info li:first-child,
	.rs-blog .bs-img .blog-date span.date, .blog .bs-img .blog-date span.date, .rs-blog-details .blog-img .blog-date span.date,
	.rs-contact .contact-address .address-item .address-text a,
	.rs-video-2 .popup-videos i,
	.rs-portfolio-style5 .portfolio-item .portfolio-content a,
	#cl-testimonial.cl-testimonial9 .single-testimonial .cl-author-info li,
	#cl-testimonial.cl-testimonial9 .single-testimonial .image-testimonial p i,
	.rs-video-2 .popup-videos i:before,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i,
	.rs-services1.services-right .services-wrap .services-item .services-icon i,
	#rs-skills .vc_progress_bar h2,
	.bs-sidebar .bs-search button:hover,
	ul.footer_social li a:hover,
	.content-wrap .career-title,
	#rs-skills h3,
	.cd-timeline__content .short-info h3 a,
	.cd-timeline__content .cd_timeline_desc,
	.grouped_form .woocommerce-Price-amount,
	#rs-services-slider .menu-carousel .heading-block h4 a:hover,
	.rs-team-grid.team-style5 .team-item .normal-text .person-name a,
	.comments-area .comment-list li.comment .reply a:hover,
	body .vc_tta-container .tab-style-left .vc_tta-panel-body h3,
	.rs-blog .blog-item.style3 .blog-no-thumb .blog-meta .blog-title a,
	.team-slider-style2 .team-item-wrap .team-img .normal-text .team-name a,
	.rs-blog .blog-slider .style3.no-thumb .blog-img .blog-meta .blog-title a,
	.rs-contact .contact-address .address-item .address-text h3.contact-title,
	#rs-header.header-style-4 .header-inner .logo-section .toolbar-contact-style4 ul li i,
	ul.stylelisting li:before, body .vc_tta-container .tab-style-left .vc_tta-tabs-container .vc_tta-tabs-list li a i
	{
		color: <?php echo esc_attr($secondary_color); ?>;
	}
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-name a,
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-name a,
	body .vc_tta-container .tab-style-left .vc_tta-tabs-container .vc_tta-tabs-list li a,
	body .vc_tta-container .tab-style-left .vc_tta-panel-body h3,
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-title, 
	.team-slider-style2 .team-item-wrap .team-img .normal-text .team-title{
		color: <?php echo esc_attr($secondary_color); ?> !important;
	}
	.testimonial-light #cl-testimonial.architecture-testimonials .slick-dots li button,
	.rs-team-grid.team-style4 .team-wrapper .team_desc:before,
	#rs-header.header-style-4 .menu-sticky.sticky .quote-button,
	.rs-team-grid.team-style5 .team-item .normal-text .team-text:before{
		background: <?php echo esc_attr($secondary_color); ?> !important;
	}
	.rs-services3 .slick-arrow,
	#sidebar-services .download-btn ul li,
	#sidebar-services .widget.widget_nav_menu ul li:hover,
	.single-teams .ps-image .ps-informations{
		background: <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-blog-details .bs-img .blog-date:before, .rs-blog .bs-img .blog-date:before, .blog .bs-img .blog-date:before, .rs-blog-details .blog-img .blog-date:before, .rs-blog .blog-img .blog-date:before, .blog .blog-img .blog-date:before{		
		border-bottom: 0 solid;
    	border-bottom-color: <?php echo esc_attr($secondary_color); ?>;
    	border-top: 80px solid transparent;
    	border-right-color: <?php echo esc_attr($secondary_color); ?>;
    }
    .border-image.small-border .vc_single_image-wrapper:before{
	    border-bottom: 250px solid <?php echo esc_attr($secondary_color); ?>;
	}
	.border-image.small-border .vc_single_image-wrapper:after{
		border-top: 250px solid <?php echo esc_attr($secondary_color); ?>;
	}


	.border-image .vc_single_image-wrapper:before,
	.team-grid-style3 .team-img:before, .team-slider-style3 .team-img:before{
		border-bottom-color: <?php echo esc_attr($secondary_color); ?>;   			
	}
	.border-image .vc_single_image-wrapper:after,
	.team-grid-style3 .team-img:after, .team-slider-style3 .team-img:after{
		border-top-color: <?php echo esc_attr($secondary_color); ?>;   	
	}

	.woocommerce-info,
	#cl-testimonial ul.slick-dots li button,
	body.single-services blockquote,
	.rs-porfolio-details.project-gallery .file-list-image .p-zoom,
	.single-teams .ps-informations ul li.social-icon i{
		border-color: <?php echo esc_attr($secondary_color); ?>;  
	}
	.slidervideo .slider-videos,
	.rs-blog .style4 .full_date,
	.slidervideo .slider-videos:before,
	#sidebar-services .download-btn.inner-services-menu ul li:hover,
	#sidebar-services .inner-services-menu .widget.widget_nav_menu ul li:hover{
		background: <?php echo esc_attr($site_color); ?>;
	}
	
	.slidervideo .slider-videos i,
	.single-teams .ps-informations ul li.social-icon i:hover,
	.rs-blog .blog-meta .blog-title a,
	.list-style li::before,
	.slidervideo .slider-videos i:before{
		color: <?php echo esc_attr($secondary_color); ?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.cd-timeline__img.cd-timeline__img--picture .rs-video-2 .popup-videos{
		background: <?php echo esc_attr($secondary_color); ?>;
	}
	.cd-timeline__img.cd-timeline__img--picture .rs-video-2 .popup-videos i{
		color: #fff !important;
	}
	.readon,
	.rs-heading.style3 .description:after,
	.team-grid-style1 .team-item .social-icons1 a i, .team-slider-style1 .team-item .social-icons1 a i,
	.owl-carousel .owl-nav [class*="owl-"],
	button, html input[type="button"], input[type="reset"],
	.rs-service-grid .service-item .service-img:before,
	.rs-service-grid .service-item .service-img:after,
	#rs-contact .contact-address .address-item .address-icon,
	#rs-contact .contact-address .address-item .address-icon::after,
	#rs-contact .contact-address .address-item .address-icon::before,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i:hover,
	.rs-services1.services-right .services-wrap .services-item .services-icon i:hover,
	.rs-service-grid .service-item .service-content::before,
	.sidenav li.nav-link-container,
	.rs-services-style4 .services-item .services-icon i,
	#rs-services-slider .img_wrap:before,
	#rs-services-slider .img_wrap:after,
	.rs-galleys .galley-img:before,
	.woocommerce-MyAccount-navigation ul li:hover,
	.comments-area .comment-list li.comment .reply a,
	.woocommerce-MyAccount-navigation ul li.is-active,
	.rs-galleys .galley-img .zoom-icon,
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec::before,
	#about-history-tabs .vc_tta-tabs-container ul.vc_tta-tabs-list .vc_tta-tab .vc_active a, #about-history-tabs .vc_tta-tabs-container ul.vc_tta-tabs-list .vc_tta-tab.vc_active a,
	.services-style-5 .services-item .icon_bg,
	#rs-skills .vc_progress_bar .vc_single_bar,
	#scrollUp i,
	#rs-header.header-style5 .header-inner .menu-area,
	#cl-testimonial.cl-testimonial10 .slick-arrow,
	.contact-sec .contact:before, .contact-sec .contact:after,
	.contact-sec .contact2:before,
	.bs-search button:hover,
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec:before,
	.rs-heading.style2::after,
	.rs-porfolio-details.project-gallery .file-list-image:hover .p-zoom:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, 
	.team-slider-style2 .team-item-wrap .team-img .team-img-sec:before,
	.rs-team-grid.team-style5 .team-item .normal-text .social-icons a i
	{
		background: <?php echo esc_attr($secondary_color); ?>;
	}

	#about-history-tabs .vc_tta-tabs-container ul.vc_tta-tabs-list .vc_tta-tab a:hover,
	.woocommerce span.onsale,
	body .vc_tta-container .tab-style-left .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a,
	.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover
	{
		background: <?php echo esc_attr($secondary_color); ?> !important;
	}

	.full-video .rs-services1.services-left .services-wrap .services-item .services-icon i,
	#cl-testimonial.cl-testimonial9 .single-testimonial .testimonial-image img,
	#cl-testimonial ul.slick-dots li button,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i,
	.rs-services1.services-right .services-wrap .services-item .services-icon i,
	#cl-testimonial.cl-testimonial10 .slick-arrow,
	#rs-header.header-style-4 .menu-sticky.sticky .quote-button,
	.team-grid-style2 .team-item-wrap .team-img img, .team-slider-style2 .team-item-wrap .team-img img,
	.contact-sec .wpcf7-form .wpcf7-text, .contact-sec .wpcf7-form .wpcf7-textarea{
		border-color: <?php echo esc_attr($secondary_color); ?> !important;
	}

	.rs-footer{
		<?php 
			if(!empty($finoptis_option['footer_bg_color'])){
				?>
				background: <?php echo esc_attr($finoptis_option['footer_bg_color']); ?> !important;
				<?php
			}
		?>
	}


	<?php if(!empty($finoptis_option['btn_bg_color'])) : ?>
		.rs_button.btn-border{
			border-color:<?php echo esc_attr($finoptis_option['btn_bg_color']); ?>;
			color:<?php echo esc_attr($finoptis_option['btn_bg_color']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($finoptis_option['btn_bg_color'])) : ?>
		.readon,
		.comment-respond .form-submit #submit,
		.comments-area .comment-list li.comment .reply a,
		.woocommerce button.button,
		.woocommerce button.button.alt,  
		.woocommerce ul.products li a.button,
		input[type="submit"],
		.woocommerce .wc-forward,
		.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce .wc-forward, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
		.woocommerce a.button, 
		.submit-btn .wpcf7-submit{
			background:<?php echo esc_attr($finoptis_option['btn_bg_color']); ?>;
			border-color:<?php echo esc_attr($finoptis_option['btn_bg_color']); ?>;
		}
	<?php endif; ?>	

	<?php if(!empty($finoptis_option['btn_text_color'])) : ?>
		.readon,
		.woocommerce button.button,
		.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce .wc-forward, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
		.woocommerce a.button,
		.woocommerce .wc-forward,
		.comments-area .comment-list li.comment .reply a,
		.woocommerce button.button.alt,   
		.woocommerce ul.products li a.button{
			color:<?php echo esc_attr($finoptis_option['btn_text_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['btn_txt_hover_color'])) : ?>
		.readon:hover,
		.comments-area .comment-list li.comment .reply a:hover,
		.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce .wc-forward:hover, .woocommerce button.button:hover, .woocommerce input.button, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
		.woocommerce .wc-forward:hover,
		.woocommerce a.button:hover,
		.woocommerce button.button.alt:hover,  
		.woocommerce button.button:hover,  
		.woocommerce ul.products li:hover a.button,
		.woocommerce button.button:hover, 
		.submit-btn i,
		.comment-respond .form-submit #submit:hover,
		.submit-btn:hover .wpcf7-submit{
			color:<?php echo esc_attr($finoptis_option['btn_txt_hover_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($finoptis_option['btn_bg_hover_color'])) : ?>
		.readon:hover,
		.comments-area .comment-list li.comment .reply a:hover,
		.woocommerce a.button:hover,
		.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce .wc-forward:hover, .woocommerce button.button:hover, .woocommerce input.button, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, 
		.woocommerce button.button.alt:hover, 
		.comment-respond .form-submit #submit:hover, 
		.woocommerce button.button:hover,
		.woocommerce ul.products li:hover a.button,
		.submit-btn:hover .wpcf7-submit{
			border-color:<?php echo esc_attr($finoptis_option['btn_bg_hover_color']); ?>;
			background:#fff;
		}
	<?php endif; ?>


	<?php if(!empty($finoptis_option['container_size'])): 

		?>
		@media (min-width: 1200px){
		.container {
		    width: <?php echo esc_attr($finoptis_option['container_size']); ?> ;
		    max-width:100%;
		}
	}
<?php endif; ?>

</style>

<?php
	} 
  	if(is_page() || is_single()){
  	$padding_top = get_post_meta(get_the_ID(), 'content_top', true);
  	$padding_bottom = get_post_meta(get_the_ID(), 'content_bottom', true);
  	if($padding_top != '' || $padding_bottom != ''){
	  	?>
	  	  <style>
	  	  	.main-contain #content{
	  	  		<?php if(!empty($padding_top)): ?>padding-top:<?php echo esc_attr($padding_top); endif;?> !important;
	  	  		<?php if(!empty($padding_bottom)): ?>padding-bottom:<?php echo esc_attr($padding_bottom); endif;?> !important;
	  	  	}
	  	  </style>	
	  	<?php
	  }
  }

}
?>