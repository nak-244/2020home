<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function finoptis_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'finoptis_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function finoptis_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'finoptis_pingback_header' );

/*
Register Fonts theme google font
*/
function finoptis_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'finoptis' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Poppins|Muli:300,400,400i,500,600,700,800,900&amp;subset=latin-ext' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function finoptis_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', finoptis_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'finoptis_studio_scripts' );


//Favicon Icon
function finoptis_site_icon() {
 if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {     
    global $finoptis_option;
     
    if(!empty($finoptis_option['rs_favicon']['url']))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($finoptis_option['rs_favicon']['url'])); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'finoptis_site_icon');

function finoptis_add_excerpt_support_for_cpt() {
 add_post_type_support( 'services', 'excerpt' );
}
add_action( 'init', 'finoptis_add_excerpt_support_for_cpt' );

//excerpt for specific section

function finoptis_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'read more', 'finoptis' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'finoptis_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'finoptis_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  // Get post ID
  $post_id = $post->ID;

  // Check for custom excerpt
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  }
  // No custom excerpt...so lets generate one
  else {
    // Readmore link
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';
    // Check for more tag and return content if it exists
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }
    // No more tag defined so generate excerpt using wp_trim_words
    else {
      // Generate excerpt
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
      // Add readmore to excerpt if enabled
      if ( $readmore ) {
        $output .= apply_filters( 'finoptis_wpex_readmore_link', $readmore_link );
      }

    }

  }
  // Apply filters and echo
  return apply_filters( 'finoptis_wpex_get_excerpt', $output );
}


//Demo content file include here

function finoptis_import_files() {
  return array(
    //for business
    array(
      'import_file_name'           => 'Finoptis Business',
      'categories'                 => array( 'Business' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/finoptis/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/finoptis/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/finoptis/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/finoptis/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/',     
      
    ),

    array(
      'import_file_name'           => 'Business 2',
      'categories'                 => array( 'Business' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/business/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/business/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/business/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/business/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/business2',     
      
    ),


    //for medical

     array(
      'import_file_name'           => 'Finoptis Medical',
      'categories'                 => array( 'Medical' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/medical/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/medical/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/medical/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/medical/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/medical',     
      
    ),

     //for construction

     array(
      'import_file_name'           => 'Finoptis Construction',
      'categories'                 => array( 'Construction' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/construction/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/construction/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/construction/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/construction/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/construction',     
      
    ),

     //for architecture
     array(
      'import_file_name'           => 'Finoptis Architecture',
      'categories'                 => array( 'Construction' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/architecture/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/architecture/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/architecture/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/architecture/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/architecture',     
      
    ),
    
    //creative
     array(
      'import_file_name'           => 'Finoptis Creative',
      'categories'                 => array( 'Creative' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/creative/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/creative/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/creative/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/creative/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/creative',     
      
    ),

    //tattoo
     array(
      'import_file_name'           => 'Finoptis Tattoo',
      'categories'                 => array( 'Creative' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/tattoo/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/tattoo/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/tattoo/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/tattoo/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/tattoo',     
      
    ),

     //Gardening
     array(
      'import_file_name'           => 'Finoptis Gardening',
      'categories'                 => array( 'Business' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/gardening/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/gardening/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/gardening/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/gardening/screenshot.png',
      'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/gardening',     
      
    ),

     //Finance
     array(
      'import_file_name'           => 'Finoptis Finance',
      'categories'                 => array( 'Finance' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/finance/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/finance/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/finance/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/finance/screenshot.png',
      'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/finance',     
      
    ),  


    //Personal
     array(
      'import_file_name'           => 'Finoptis Personal',
      'categories'                 => array( 'Personal' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/personal/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/personal/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/personal/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/personal/screenshot.png',
      'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/personal',     
      
    ),  


       //Consulting
     array(
      'import_file_name'           => 'Finoptis Consulting',
      'categories'                 => array( 'Consulting' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/consulting/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/consulting/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/consulting/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/consulting/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/consulting',     
      
    ),

    //Minimal
    array(
      'import_file_name'           => 'Finoptis Minimal',
      'categories'                 => array( 'Minimal' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/minimal/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/minimal/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/minimal/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/minimal/screenshot.jpg',
      'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/minimaldemo',     
      
    ), 

    //SASS
    array(
      'import_file_name'           => 'Finoptis Saas',
      'categories'                 => array( 'Software' ),
      'import_file_url'            => 'https://rstheme.com/products/demo-data/saas/content.xml',
      'import_widget_file_url'     => 'https://rstheme.com/products/demo-data/saas/widgets.wie',      
      'import_redux'               => array(
        array(
          'file_url'    => 'https://rstheme.com/products/demo-data/minimal/redux_options.json',
          'option_name' => 'finoptis_option',
        ),
      ),

      'import_preview_image_url'   => 'https://rstheme.com/products/demo-data/saas/screenshot.png',
      'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'finoptis' ),
      'preview_url'                => 'https://rstheme.com/products/wordpress/finoptis/saas',     
      
    ),  

    
  );
}

add_filter( 'pt-ocdi/import_files', 'finoptis_import_files' );

function finoptis_after_import_setup() {
  	// Assign menus to their locations.
	$main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$left_menu   = get_term_by( 'name', 'Left Menu', 'nav_menu' ); 
	$single_menu = get_term_by( 'name', 'Single Menu', 'nav_menu' ); 

	set_theme_mod( 'nav_menu_locations', array(
      	'menu-1' => $main_menu->term_id,  
       	'menu-2' => $left_menu->term_id, 
      	'menu-3' => $single_menu->term_id       
	)
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );
  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'finoptis_after_import_setup' );