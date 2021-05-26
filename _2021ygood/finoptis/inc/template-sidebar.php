<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function finoptis_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'finoptis' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'finoptis' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Search Sidebar', 'finoptis' ),
		'id'            => 'sidebarsearch-1',
		'description'   => esc_html__( 'Add widgets here.', 'finoptis' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'finoptis' ),
			'id'            => 'sidebar_shop',
			'description'   => esc_html__( 'Sidebar Shop', 'finoptis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Off Canvas Sidebar', 'finoptis' ),
		'id'            => 'sidebarcanvas-1',
		'description'   => esc_html__( 'Add widgets here.', 'finoptis' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer One Widget Area', 'finoptis' ),
			'id' => 'footer1',
			'description' => esc_html__( 'Add Text widgets area', 'finoptis' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 		 				

	 register_sidebar( array(
			'name' => esc_html__( 'Footer Two Widget Area', 'finoptis' ),
			'id' => 'footer2',
			'description' => esc_html__( 'Add text box widgets area', 'finoptis' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 
	 register_sidebar( array(
			'name' => esc_html__( 'Footer Three Widget Area', 'finoptis' ),
			'id' => 'footer3',
			'description' => esc_html__( 'Add text box widgets area', 'finoptis' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer Four Widget Area', 'finoptis' ),
			'id' => 'footer4',
			'description' => esc_html__( 'Add text box widgets area', 'finoptis' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 
			
}
add_action( 'widgets_init', 'finoptis_widgets_init' );