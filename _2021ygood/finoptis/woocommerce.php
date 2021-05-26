<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $finoptis_option;

// Layout class



if ( $finoptis_option['shop-layout'] == 'full' ) {
	$finoptis_layout_class = 'col-sm-12 col-xs-12';
}
elseif( $finoptis_option['shop-layout'] == 'left-col' || $finoptis_option['shop-layout'] == 'right-col'){
	$finoptis_layout_class = 'col-md-9 col-xs-12';
}
else{
	$finoptis_layout_class = 'col-sm-12 col-xs-12';
}
?>
<div class="container">
	<div id="content" class="site-content">		
		<div class="row">
			<?php
				if(!empty($finoptis_option['disable-sidebar']) && is_product()){
					?>
					<div class="col-sm-12 col-xs-12">
					    <?php					
							woocommerce_content();						
						?>
					</div>
					<?php
				}else{				
					if ( $finoptis_option['shop-layout'] == 'left-col'  ) {
						get_sidebar('woocommerce');
					}
					?>    			
				    <div class="<?php echo esc_attr($finoptis_layout_class);?>">
					    <?php					
							woocommerce_content();						
		   				 ?>
				    </div>
					<?php
					if ( $finoptis_option['shop-layout'] == 'right-col'  ) {
						get_sidebar('woocommerce');
					}	
				}
			?>
		</div>
	</div>
</div>
<?php
get_footer();

