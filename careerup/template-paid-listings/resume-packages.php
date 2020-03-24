<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( $packages ) : ?>
	<div class="widget widget-packages">
		<h2 class="widget-title text-center"><?php esc_html_e( 'Packages', 'careerup' ); ?></h2>
		<div class="row">
			<?php foreach ( $packages as $key => $package ) :
				$post_object = get_post($package);
				setup_postdata( $GLOBALS['post'] =& $post_object );
				$product = wc_get_product( $package );
				if ( ! $product->is_type( array( 'resume_package' ) ) || ! $product->is_purchasable() ) {
					continue;
				}
				?>

				<div class="col-sm-4 col-xs-12">
					<div class="subwoo-inner <?php echo esc_attr($product->is_featured()?'highlight':''); ?>">
						<div class="item">
							<div class="header-sub">
								<div class="inner-sub">
									<h3 class="title"><?php echo trim($product->get_title()); ?></h3>
									<div class="price">
										<?php echo (!empty($product->get_price())) ? $product->get_price_html() : esc_html__('Free', 'careerup'); ?>
									</div>
								</div>
							</div>
							<div class="bottom-sub">
								<div class="short-des"><?php echo apply_filters( 'the_excerpt', get_post_field('post_excerpt', $product->get_id()) ) ?></div>
								<div class="button-action"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;
				wp_reset_postdata();
			?>
		</div>
	</div>
<?php endif; ?>