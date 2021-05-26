<?php if ( class_exists( 'WooCommerce' ) ) {?>
	<div class="menu-cart-area">
		<a href="<?php echo esc_url( wc_get_cart_url() );?>"><i class="glyph-icon flaticon-bag"></i><span class="icon-num"><?php echo WC()->cart->get_cart_contents_count();?></span></a>
		<div class="cart-icon-total-products">
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</div>
	</div>
<?php } ?>