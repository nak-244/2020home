<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "finoptis_option";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'finoptis/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Finoptis Options', 'finoptis' ),
        'page_title'           => esc_html__( 'Finoptis Options', 'finoptis' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        'forced_dev_mode_off' => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        'compiler' => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        'force_output' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_html__( 'Finoptis Theme', 'finoptis' ), $v );
    } else {
        $args['intro_text'] = esc_html__( 'Finoptis Theme', 'finoptis' );
    }

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTSfinoptis
     */
    /*
     *
     * ---> START SECTIONS
     *
     */     
   // -> START General Settings
   Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General Sections', 'finoptis' ),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(
             array(
                'id'       => 'container_size',
                'type'     => 'text',
                'title'    => esc_html__( 'Set Your Container Size', 'finoptis' ),  
                'subtitle' => esc_html__( 'Example(1170px)', 'finoptis' ),              
                'default'=> '1170px'                
            ),

            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Default Logo', 'finoptis' ),
                'subtitle' => esc_html__( 'Upload your logo', 'finoptis' ),
                'url'=> true
                
            ),

            array(
                'id'       => 'logo_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Your Light', 'finoptis' ),
                'subtitle' => esc_html__( 'Upload your light logo', 'finoptis' ),
                'url'=> true
                
            ),

            array(
                    'id'       => 'logo-height',                               
                    'title'    => esc_html__( 'Logo Height', 'finoptis' ),
                    'subtitle' => esc_html__( 'Logo max height example(50px)', 'finoptis' ),
                    'type'     => 'text',
                    'default'  => '25px'
                    
            ),

            array(
                'id'       => 'rswplogo_sticky',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Your Sticky Logo', 'finoptis' ),
                'subtitle' => esc_html__( 'Upload your sticky logo', 'finoptis' ),
                'url'=> true                
            ),

             array(
                    'id'       => 'sticky-logo-height',                               
                    'title'    => esc_html__( 'Sticky Logo Height', 'finoptis' ),
                    'subtitle' => esc_html__( 'Sticky Logo max height example(20px)', 'finoptis' ),
                    'type'     => 'text',
                    'default'  => '20px'
                    
            ),
            
            array(
            'id'       => 'rs_favicon',
            'type'     => 'media',
            'title'    => esc_html__( 'Upload Favicon', 'finoptis' ),
            'subtitle' => esc_html__( 'Upload your faviocn here', 'finoptis' ),
            'url'=> true            
            ),
            
            array(
                'id'       => 'off_sticky',
                'type'     => 'switch', 
                'title'    => esc_html__('Sticky Menu', 'finoptis'),
                'subtitle' => esc_html__('You can show or hide sticky menu here', 'finoptis'),
                'default'  => false,
            ),
               
             array(
                'id'       => 'off_search',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Search', 'finoptis'),
                'subtitle' => esc_html__('You can show or hide search icon at menu area', 'finoptis'),
                'default'  => false,
            ),
            
            array(
                'id'       => 'off_canvas',
                'type'     => 'switch', 
                'title'    => esc_html__('Show off Canvas', 'finoptis'),
                'subtitle' => esc_html__('You can show or hide off canvas here', 'finoptis'),
                'default'  => false,
            ),           
               
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => esc_html__('Go to Top', 'finoptis'),
                'subtitle' => esc_html__('You can show or hide here', 'finoptis'),
                'default'  => false,
            ),            
        )
    ) );
    
    
    // -> START Header Section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'finoptis' ),
        'id'               => 'header',
        'customizer_width' => '450px',
        'icon' => 'el el-certificate',       
         
        'fields'           => array(
       
        array(
            'id'     => 'notice_critical',
            'type'   => 'info',
            'notice' => true,
            'style'  => 'success',
            'title'  => esc_html__('Header Top Area', 'finoptis')            
        ),
        
        array(
                'id'       => 'show-top',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Top Bar', 'finoptis'),
                'subtitle' => esc_html__('You can select top bar show or hide', 'finoptis'),
                'default'  => false,
            ), 

         array(
                    'id'       => 'welcome-text',                               
                    'title'    => esc_html__( 'Top Bar Welcome Text', 'finoptis' ),
                    'subtitle' => esc_html__( 'Top Bar Welcome Text Add Here', 'finoptis' ),
                    'type'     => 'text',
                    
            ),

         
      
        array(
                'id'       => 'show-social',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Social Icons at Header', 'finoptis'),
                'subtitle' => esc_html__('You can select Social Icons show or hide', 'finoptis'),
                'default'  => true,
            ),  
                    
          array(
            'id'     => 'notice_critical2',
            'type'   => 'info',
            'notice' => true,
            'style'  => 'success',
            'title'  => esc_html__('Header Area', 'finoptis')            
        ),

        array(
                'id'               => 'header-grid',
                'type'             => 'select',
                'title'            => esc_html__('Header Area Width', 'finoptis'),                  
               
                //Must provide key => value pairs for select options
                'options'          => array(                                     
                
                    'container'       => 'Container',
                    'full'          => 'Container Fluid',
                ),

                'default'          => 'container',            
            ),

          array(
                    'id'       => 'phone-pretext',                               
                    'title'    => esc_html__( ' Phone Number Pre Text', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Phone Number Pre Text', 'finoptis' ),
                    'type'     => 'text',
                    
            ),
        
         array(
                    'id'       => 'phone',                               
                    'title'    => esc_html__( ' Phone Number', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Phone Number', 'finoptis' ),
                    'type'     => 'text',
                    
            ),

           array(
                    'id'       => 'email-pretext',                               
                    'title'    => esc_html__( ' E-mail Pre Text', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter E-mail Pre Text', 'finoptis' ),
                    'type'     => 'text',
                    
            ),
       
        array(
                    'id'       => 'top-email',                               
                    'title'    => esc_html__( 'Email Address', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Email Address', 'finoptis' ),
                    'type'     => 'text',
                    'validate' => 'email',
                    'msg'      => 'Email Address Not Valid',
                    
            ),  

         array(
                    'id'       => 'location-pretext',                               
                    'title'    => esc_html__( 'Location Title', 'finoptis' ),
                    'subtitle' => esc_html__( 'Pre Text', 'finoptis' ),
                    'type'     => 'text',
                    
            ),
       
        array(
                    'id'       => 'top-location',                               
                    'title'    => esc_html__( 'Add Location', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Address Here', 'finoptis' ),
                    'type'     => 'text',                   
                    
            ),   

        array(
                'id'       => 'top-opening',                               
                'title'    => esc_html__( 'Opening Hours', 'finoptis' ),
                'subtitle' => esc_html__( 'Enter Opening Hours Here', 'finoptis' ),
                'type'     => 'text',                          
            ),  
            
        array(
                'id'       => 'quote',                               
                'title'    => esc_html__( 'Quote Button Text', 'finoptis' ),                  
                'type'     => 'text',
                
        ),  
        
        array(
                'id'       => 'quote_link',                               
                'title'    => esc_html__( 'Quote Button Link', 'finoptis' ),
                'subtitle' => esc_html__( 'Enter Quote Button Link Here', 'finoptis' ),
                'type'     => 'text',
                
            ),      
        )
    ) 

);  
   

Redux::setSection( $opt_name, array(
'title'            => esc_html__( 'Header Layout', 'finoptis' ),
'id'               => 'header-style',
'customizer_width' => '450px',
'subsection' =>'true',      
'fields'           => array(    
                    
                    array(
                            'id'       => 'header_layout',
                            'type'     => 'image_select',
                            'title'    => esc_html__('Header Layout', 'finoptis'), 
                            'subtitle' => esc_html__('Select header layout. Choose between 1, 2 ,3 or 4 layout.', 'finoptis'),
                            'options'  => array(
                            'style1'   => array(
                            'alt'      => 'Header Style 1', 
                            'img'      => get_template_directory_uri().'/libs/img/style_1.png'
                            
                            ),
                            'style2' => array(
                            'alt'    => 'Header Style 2', 
                            'img'    => get_template_directory_uri().'/libs/img/style_2.png'
                            ),
                            'style3' => array(
                            'alt'    => 'Header Style 3', 
                            'img'    => get_template_directory_uri().'/libs/img/style_3.png'
                            ),
                            'style4' => array(
                            'alt'    => 'Header Style 4', 
                            'img'    => get_template_directory_uri().'/libs/img/style_4.png'
                            ),

                            'style5'  => array(
                            'alt'     => 'Header Style 5', 
                            'img'     => get_template_directory_uri().'/libs/img/style_5.png'
                            ),
                            'style6' => array(
                            'alt'    => 'Header Style 6', 
                            'img'    => get_template_directory_uri().'/libs/img/style_2.png'
                            ),
                            
                            ),
                            'default' => 'style1'
                    ),                           
                    
            )
        ) 
);
                                   
//Topbar settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Toolbar area', 'finoptis' ),
        'desc'   => esc_html__( 'Toolbar area Style Here', 'finoptis' ),        
        'subsection' =>'true',  
        'fields' => array( 
                        
                array(
                    'id'        => 'toolbar_bg_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar background Color','finoptis'),
                    'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                    'default'   => '#28406d',                        
                    'validate'  => 'color',                        
                ),    

                array(
                    'id'        => 'toolbar_text_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Text Color','finoptis'),
                    'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'toolbar_link_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Link Color','finoptis'),
                    'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'toolbar_link_hover_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Link Hover Color','finoptis'),
                    'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                    'default'   => '#e2c60c',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'toolbar_text_size',
                    'type'      => 'text',                       
                    'title'     => esc_html__('Toolbar Font Size','finoptis'),
                    'subtitle'  => esc_html__('Font Size', 'finoptis'),    
                    'default'   => '14px',                                            
                ), 
                
        )
    )
);
    // -> START Style Section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Style', 'finoptis' ),
        'id'               => 'stle',
        'customizer_width' => '450px',
        'icon' => 'el el-brush',
        ));
    
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Global Style', 'finoptis' ),
        'desc'   => esc_html__( 'Style your theme', 'finoptis' ),        
        'subsection' =>'true',  
        'fields' => array( 
                        
                        array(
                            'id'        => 'body_bg_color',
                            'type'      => 'color',                           
                            'title'     => esc_html__('Body Backgroud Color','finoptis'),
                            'subtitle'  => esc_html__('Pick body background color', 'finoptis'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'body_text_color',
                            'type'      => 'color',            
                            'title'     => esc_html__('Text Color','finoptis'),
                            'subtitle'  => esc_html__('Pick text color', 'finoptis'),
                            'default'   => '#666666',
                            'validate'  => 'color',                        
                        ),     
        
                        array(
                        'id'        => 'primary_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Primary Color','finoptis'),
                        'subtitle'  => esc_html__('Select Primary Color.', 'finoptis'),
                        'default'   => '#e1c50d',
                        'validate'  => 'color',                        
                        ), 

                        array(
                        'id'        => 'secondary_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Secondary Color','finoptis'),
                        'subtitle'  => esc_html__('Select Secondary Color.', 'finoptis'),
                        'default'   => '#28406d',
                        'validate'  => 'color',                        
                        ),

                        array(
                            'id'        => 'link_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Link Color','finoptis'),
                            'subtitle'  => esc_html__('Pick Link color', 'finoptis'),
                            'default'   => '#5866b5',
                            'validate'  => 'color',                        
                        ),
                        
                        array(
                            'id'        => 'link_hover_text_color',
                            'type'      => 'color',                 
                            'title'     => esc_html__('Link Hover Color','finoptis'),
                            'subtitle'  => esc_html__('Pick link hover color', 'finoptis'),
                            'default'   => '#e2c60c',
                            'validate'  => 'color',                        
                        ),    
                       
                 ) 
            ) 
    ); 

       
    
    //Menu settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Main Menu', 'finoptis' ),
        'desc'   => esc_html__( 'Main Menu Style Here', 'finoptis' ),        
        'subsection' =>'true',  
        'fields' => array( 

                        array(
                            'id'        => 'menu_area_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Background Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                            'default'   => '',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                            'default'   => '#28406d',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'transparent_menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Tranparent Menu Text Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'transparent_menu_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Tranparent Menu Hover Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                            'default'   => '#e2c60c',                        
                            'validate'  => 'color',                        
                        ),  

                        array(
                            'id'        => 'transparent_menu_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Tranparent Menu Active Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                            'default'   => '#e2c60c',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'menu_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Hover Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),           
                            'default'   => '#e2c60c',                 
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'menu_text_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Active Color','finoptis'),
                            'subtitle'  => esc_html__('Pick color', 'finoptis'),
                            'default'   => '#e2c60c',
                            'validate'  => 'color',                        
                        ),
                                               
                        array(
                            'id'        => 'drop_down_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Background Color','finoptis'),
                            'subtitle'  => esc_html__('Pick bg color', 'finoptis'),
                            'default'   => '#28406d',
                            'validate'  => 'color',                        
                        ), 
                            
                        
                        array(
                            'id'        => 'drop_text_color',
                            'type'      => 'color',                     
                            'title'     => esc_html__('Dropdown Menu Text Color','finoptis'),
                            'subtitle'  => esc_html__('Pick text color', 'finoptis'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'drop_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Text Color','finoptis'),
                            'subtitle'  => esc_html__('Pick text color', 'finoptis'),
                            'default'   => '#e2c60c',
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'       => 'menu_text_gap',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Menu Item Gap', 'finoptis' ),                           
                            'default'  => '14px',
                        ),

                        array(
                            'id'       => 'menu_border_style',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Navigation Text Bracket Style', 'finoptis' ),
                            'on'       => esc_html__( 'Enabled', 'finoptis' ),
                            'off'      => esc_html__( 'Disabled', 'finoptis' ),
                            'default'  => true,
                        ),    
                                
                        array(
                            'id'       => 'menu_text_trasform',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Menu Text Uppercase', 'finoptis' ),
                            'on'       => esc_html__( 'Enabled', 'finoptis' ),
                            'off'      => esc_html__( 'Disabled', 'finoptis' ),
                            'default'  => false,
                        ), 
                        
                )
            )
        ); 


    //Breadcrumb settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Breadcrumb Style', 'finoptis' ),      
        'subsection' =>'true',  
        'fields' => array(

        			 array(
		                'id'       => 'header_banner',
		                'type'     => 'media',
		                'title'    => esc_html__( 'Upload Your Page Banner', 'finoptis' ),
		                'subtitle' => esc_html__( 'Upload your Page Banner', 'finoptis' ),
		                'url'=> true
		                
		            ),
                    array(
                        'id'        => 'breadcrumb_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Background Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#212121',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'breadcrumb_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Text Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#fff',                        
                        'validate'  => 'color',                        
                    ), 
                    
                  
                    array(
                        'id'        => 'breadcrumb_gap',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Top Bottom Gap','finoptis'),                          
                        'default'   => '75px',                        
                                            
                    ),     
                        
                )
            )
        );

    //Menu settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Button Style', 'finoptis' ),
        'desc'   => esc_html__( 'Button Style Here', 'finoptis' ),        
        'subsection' =>'true',  
        'fields' => array( 

                    array(
                        'id'        => 'btn_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Background Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#28406d',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'btn_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Text Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#fff',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'btn_txt_hover_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Hover Text Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#28406d',                        
                        'validate'  => 'color',                        
                    ), 

                    array(
                        'id'        => 'btn_bg_hover_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Hover Border Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#28406d',                        
                        'validate'  => 'color',                        
                    ),     
                        
                )
            )
        );
    
     //Preloader settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Preloader Style', 'finoptis' ),
        'desc'   => esc_html__( 'Preloader Style Here', 'finoptis' ),        
        'subsection' =>'true',  
        'fields' => array( 
                    array(
                        'id'       => 'show_preloader',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Show Preloader', 'finoptis'),
                        'subtitle' => esc_html__('You can show or hide preloader', 'finoptis'),
                        'default'  => false,
                    ), 

                    array(
                        'id'        => 'preloader_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Preloader Background Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#28406d',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'preloader_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Preloader Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#e1c50d',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'preloader_circle_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Preloader Circle Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color', 'finoptis'),    
                        'default'   => '#fff',                        
                        'validate'  => 'color',                        
                    ),

                    array(
                        'id'               => 'preloader_img', 
                        'url'              => true,     
                        'title'            => esc_html__( 'Preloader Image', 'finoptis' ),                 
                        'type'             => 'media',                                  
                    ),       
                )
            )
        );
    
    //-> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'finoptis' ),
        'id'     => 'typography',
        'desc'   => esc_html__( 'You can specify your body and heading font here','finoptis'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font', 'finoptis' ),
                'subtitle' => esc_html__( 'Specify the body font properties.', 'finoptis' ),
                'google'   => true, 
                'font-style' =>false,           
                'default'  => array(                    
                    'font-size'   => '14px',
                    'font-family' => 'Muli',
                    'font-weight' => '400',
                ),
            ),
             array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => esc_html__( 'Navigation Font', 'finoptis' ),
                'subtitle' => esc_html__( 'Specify the menu font properties.', 'finoptis' ),
                'google'   => true,
                'font-backup' => true,                
                'all_styles'  => true,              
                'default'  => array(
                    'color'       => '#303745',                    
                    'font-family' => 'Muli',
                    'google'      => true,
                    'font-size'   => '15px',                    
                    'font-weight' => 'Normal',                    
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H1', 'finoptis' ),
                'font-backup' => true,                
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'finoptis' ),
                'default'     => array(
                    'color'       => '#303745',
                    'font-style'  => '700',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '40px',
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H2', 'finoptis' ),
                'font-backup' => true,                
                'all_styles'  => true,                 
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'finoptis' ),
                'default'     => array(
                    'color'       => '#303745',
                    'font-style'  => '700',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '32px',
                    
                ),
                ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H3', 'finoptis' ),             
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'finoptis' ),
                'default'     => array(
                    'color'       => '#303745',
                    'font-style'  => '600',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '24px',
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H4', 'finoptis' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false,                
                'all_styles'  => true,               
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'finoptis' ),
                'default'     => array(
                    'color'       => '#303745',
                    'font-style'  => '500',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '20px',
                    'line-height' => '28px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H5', 'finoptis' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'finoptis' ),
                'default'     => array(
                    'color'       => '#303745',
                    'font-style'  => '500',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '27px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H6', 'finoptis' ),
             
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'finoptis' ),
                'default'     => array(
                    'color'       => '#303745',
                    'font-style'  => '500',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '16x',
                    'line-height' => '20px'
                ),
                ),
                
                )
            )
                    
   
    );

    /*Blog Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog', 'finoptis' ),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
        )
        );
        
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog Settings', 'finoptis' ),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(
        
                                array(
                                    'id'               => 'blog_banner_main', 
                                    'url'              => true,     
                                    'title'            => esc_html__( 'Blog Page Banner', 'finoptis' ),                 
                                    'type'             => 'media',                                  
                                ),  
                                
                                array(
                                    'id'               => 'blog_title',                               
                                    'title'            => esc_html__( 'Blog  Title', 'finoptis' ),
                                    'subtitle'         => esc_html__( 'Enter Blog  Title Here', 'finoptis' ),
                                    'type'             => 'text',                                   
                                ),
                                
                                array(
                                    'id'               => 'blog-layout',
                                    'type'             => 'image_select',
                                    'title'            => esc_html__('Select Blog Layout', 'finoptis'), 
                                    'subtitle'         => esc_html__('Select your blog layout', 'finoptis'),
                                    'options'          => array(
                                    'full'             => array(
                                    'alt'              => 'Blog Style 1', 
                                    'img'              => get_template_directory_uri().'/libs/img/1c.png'                                      
                                ),
                                    '2right'           => array(
                                    'alt'              => 'Blog Style 2', 
                                    'img'              => get_template_directory_uri().'/libs/img/2cr.png'
                                ),
                                '2left'            => array(
                                'alt'              => 'Blog Style 3', 
                                'img'              => get_template_directory_uri().'/libs/img/2cl.png'
                                ),                                  
                                ),
                                'default'          => '2right'
                                ),                      
                                
                                array(
                                    'id'               => 'blog-grid',
                                    'type'             => 'select',
                                    'title'            => esc_html__('Select Blog Gird', 'finoptis'),                   
                                    'desc'             => esc_html__('Select your blog gird layout', 'finoptis'),
                                //Must provide key => value pairs for select options
                                'options'          => array(
                                    '12'               =>'1 Column',                                   
                                    '6'                => '2 Column',                                          
                                    '4'                => '3 Column',
                                    '3'                => '4 Column'
                                    ),
                                    'default'          => '12',                                  
                                ),  
                                
                                array(
                                    'id'               => 'blog-author-post',
                                    'type'             => 'select',
                                    'title'            => esc_html__('Show Author Info', 'finoptis'),                   
                                    'desc'             => esc_html__('Select author info show or hide', 'finoptis'),
                                    //Must provide key => value pairs for select options
                                    'options'          => array(                                            
                                    'show'             => 'Show',
                                    'hide'             => 'Hide'
                                    ),
                                    'default'          => 'show',
                                
                                ), 
                                
                                array(
                                    'id'               => 'blog-date',
                                    'type'             => 'switch',
                                    'title'            => esc_html__('Show Date', 'finoptis'),                   
                                    'desc'             => esc_html__('You can show/hide date at blog page', 'finoptis'),
                                    
                                    'default'          => true,
                                ), 
                                array(
                                    'id'               => 'blog_readmore',                               
                                    'title'            => esc_html__( 'Blog  ReadMore Text', 'finoptis' ),
                                    'subtitle'         => esc_html__( 'Enter Blog  ReadMore Here', 'finoptis' ),
                                    'type'             => 'text',                                   
                                ),
                                
                            )
                        ) 
                                
                    );
    
    
    /*Single Post Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single Post', 'finoptis' ),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(                            
        
                            array(
                                    'id'       => 'blog_banner', 
                                    'url'      => true,     
                                    'title'    => esc_html__( 'Blog Single page banner', 'finoptis' ),                  
                                    'type'     => 'media',
                                    
                            ),  
                           
                            array(
                                    'id'       => 'blog-comments',
                                    'type'     => 'select',
                                    'title'    => esc_html__('Show Comment', 'finoptis'),                   
                                    'desc'     => esc_html__('Select comments show or hide', 'finoptis'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show' => 'Show',
                                            'hide' => 'Hide'
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                            
                            array(
                                    'id'       => 'blog-author',
                                    'type'     => 'select',
                                    'title'    => esc_html__('Show Ahthor Info', 'finoptis'),                   
                                    'desc'     => esc_html__('Select author info show or hide', 'finoptis'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show' => 'Show',
                                            'hide' => 'Hide'
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                            
                            array(
                                    'id'       => 'blog-post',
                                    'type'     => 'select',
                                    'title'    => esc_html__('Show Related Post', 'finoptis'),                  
                                    'desc'     => esc_html__('Choose related product show or hide', 'finoptis'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show' => 'Show',
                                            'hide' => 'Hide'
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                        )
                ) 
    
    
    );

    
    /*Portfolio Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Portfolio Section', 'finoptis' ),
        'id'               => 'portfolio',
        'customizer_width' => '450px',
        'icon' => 'el el-camera',
        'fields'           => array(
        
            array(
                    'id'       => 'portfolio_single_image', 
                    'url'      => true,     
                    'title'    => esc_html__( 'Portfolio Single page banner image', 'finoptis' ),                   
                    'type'     => 'media',
                    
            ),  
            
            array(
                    'id'       => 'portfolio_slug',                               
                    'title'    => esc_html__( 'Portfolio Slug', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Portfolio Slug Here', 'finoptis' ),
                    'type'     => 'text',
                    'default'  => 'portfolios'
                ),      
             )
         ) 
    );


        /*Team Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Team Section', 'finoptis' ),
        'id'               => 'team',
        'customizer_width' => '450px',
        'icon' => 'el el-user',
        'fields'           => array(
        
            array(
                    'id'       => 'team_single_image', 
                    'url'      => true,     
                    'title'    => esc_html__( 'Team Single page banner image', 'finoptis' ),                    
                    'type'     => 'media',
                    
            ),  
            
            array(
                    'id'       => 'team_slug',                               
                    'title'    => esc_html__( 'Team Slug', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Team Slug Here', 'finoptis' ),
                    'type'     => 'text',
                    'default'  => 'teams',
                    
                ),      
             )
         ) 
    );

    

    /*Service Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Service Section', 'finoptis' ),
        'id'               => 'service',
        'customizer_width' => '450px',
        'icon' => 'el el-asterisk',
        'fields'           => array(
        
            array(
                    'id'       => 'service_single_image', 
                    'url'      => true,     
                    'title'    => esc_html__( 'Service Single page banner image', 'finoptis' ),                    
                    'type'     => 'media',
                    
            ),  
            
            array(
                    'id'       => 'service_slug',                               
                    'title'    => esc_html__( 'Service Slug', 'finoptis' ),
                    'subtitle' => esc_html__( 'Enter Service Slug Here', 'finoptis' ),
                    'type'     => 'text',
                    'default'  => 'service',
                    
                ),      
             )
         ) 
    );



    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Icons', 'finoptis' ),
        'desc'   => esc_html__( 'Add your social icon here', 'finoptis' ),
        'icon'   => 'el el-share',
         'submenu' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields' => array(
                    array(
                        'id'       => 'facebook',                               
                        'title'    => esc_html__( 'Facebook Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Facebook Link', 'finoptis' ),
                        'type'     => 'text',                     
                    ),
                        
                     array(
                        'id'       => 'twitter',                               
                        'title'    => esc_html__( 'Twitter Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Twitter Link', 'finoptis' ),
                        'type'     => 'text'
                    ),
                    
                        array(
                        'id'       => 'rss',                               
                        'title'    => esc_html__( 'Rss Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Rss Link', 'finoptis' ),
                        'type'     => 'text'
                    ),
                    
                     array(
                        'id'       => 'pinterest',                               
                        'title'    => esc_html__( 'Pinterest Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Pinterest Link', 'finoptis' ),
                        'type'     => 'text'
                    ),
                     array(
                        'id'       => 'linkedin',                               
                        'title'    => esc_html__( 'Linkedin Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Linkedin Link', 'finoptis' ),
                        'type'     => 'text',
                        
                    ),

                      array(
                        'id'       => 'vk',                               
                        'title'    => esc_html__( 'VK Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Vk Link', 'finoptis' ),
                        'type'     => 'text',
                        
                    ), 
                     array(
                        'id'       => 'google',                               
                        'title'    => esc_html__( 'Google Plus Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Google Plus  Link', 'finoptis' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'instagram',                               
                        'title'    => esc_html__( 'Instagram Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Instagram Link', 'finoptis' ),
                        'type'     => 'text',                       
                    ),

                     array(
                        'id'       => 'youtube',                               
                        'title'    => esc_html__( 'Youtube Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Youtube Link', 'finoptis' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'tumblr',                               
                        'title'    => esc_html__( 'Tumblr Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Tumblr Link', 'finoptis' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'vimeo',                               
                        'title'    => esc_html__( 'Vimeo Link', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter Vimeo Link', 'finoptis' ),
                        'type'     => 'text',                       
                    ),         
            ) 
        ) 
    );
    
    
   
    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer Option', 'finoptis' ),
    'desc'   => esc_html__( 'Footer style here', 'finoptis' ),
    'icon'   => 'el el-th-large',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(


                array(
                        'id'       => 'footer_bg_image', 
                        'url'      => true,     
                        'title'    => esc_html__( 'Footer Background Image', 'finoptis' ),                 
                        'type'     => 'media',                                  
                ),

                array(
                        'id'        => 'footer_bg_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Bg Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                        'default'   => '#21202e',
                        'validate'  => 'color',                        
                    ),  

                 array(
                    'id'               => 'header_grid2',
                    'type'             => 'select',
                    'title'            => esc_html__('Footer Area Width', 'finoptis'),                  
               
                    //Must provide key => value pairs for select options
                    'options'          => array(                                     
                    
                        'container'       => 'Container',
                        'full'          => 'Container Fluid',
                    ),

                    'default'          => 'container',            
                ),

                array(
                        'id'       => 'footer_logo',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Footer Logo', 'finoptis' ),
                        'subtitle' => esc_html__( 'Upload your footer logo', 'finoptis' ),                  
                    ),     

                array(
                        'id'        => 'footer_text_size',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Footer Font Size','finoptis'),
                        'subtitle'  => esc_html__('Font Size', 'finoptis'),    
                        'default'   => '14px',                                            
                    ),  

                array(
                        'id'        => 'footer_h3_size',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Footer Title Font Size','finoptis'),
                        'subtitle'  => esc_html__('Font Size', 'finoptis'),    
                        'default'   => '22px',                                            
                    ),  

                array(
                        'id'        => 'footer_link_size',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Footer Link Font Size','finoptis'),
                        'subtitle'  => esc_html__('Font Size', 'finoptis'),    
                        'default'   => '14px',                                            
                    ),  

                array(
                        'id'        => 'footer_text_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Text Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                        'default'   => '#fff',
                        'validate'  => 'color',                        
                    ),  

                array(
                        'id'        => 'footer_link_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Link Hover Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                        'default'   => '#e2c60c',
                        'validate'  => 'color',                        
                    ),   

                array(
                        'id'        => 'footer_input_bg_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Button Background Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                        'default'   => '#28406d',
                        'validate'  => 'color',                        
                    ), 

                array(
                        'id'        => 'footer_input_hover_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Button Hover Background Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                        'default'   => '#e2c60c',
                        'validate'  => 'color',                        
                    ),

                array(
                        'id'        => 'footer_input_border_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer input Border Color','finoptis'),
                        'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                        'default'   => '#28406d',
                        'validate'  => 'color',                        
                    ),  

                array(
                    'id'        => 'footer_input_text_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Button Text Color','finoptis'),
                    'subtitle'  => esc_html__('Pick color.', 'finoptis'),
                    'default'   => '#fff',
                    'validate'  => 'color',                        
                ),                  
                       
                
                array(
                    'id'       => 'copyright',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Footer CopyRight', 'finoptis' ),
                    'subtitle' => esc_html__( 'Change your footer copyright text ?', 'finoptis' ),
                    'default'  => '&copy; 2018 All Rights Reserved',
                ),  

                array(
                    'id'       => 'copyright_bg',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Copyright Background', 'finoptis' ),
                    'subtitle' => esc_html__( 'Copyright Background Color', 'finoptis' ),      
                    'default'  => '#21202e',            
                ),

                array(
                    'id'       => 'copyright_bg_border',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Copyright Border', 'finoptis' ),
                    'subtitle' => esc_html__( 'Copyright Border Color', 'finoptis' ),      
                    'default'  => '#35353ecc',            
                ),                        

              
            ) 
        ) 
    ); 


Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Woocommerce', 'finoptis' ),    
    'icon'   => 'el el-shopping-cart',    
        ) 
    ); 

    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Shop', 'finoptis' ),
    'id'               => 'shop_layout',
    'customizer_width' => '450px',
    'subsection' =>'true',      
    'fields'           => array(                      
            array(
                'id'       => 'shop_banner', 
                'url'      => true,     
                'title'    => esc_html__( 'Shop page banner', 'finoptis' ),                    
                'type'     => 'media',
            ), 
            array(
                    'id'       => 'shop-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Select Shop Layout', 'finoptis'), 
                    'subtitle' => esc_html__('Select your shop layout', 'finoptis'),
                    'options'  => array(
                        'full'      => array(
                            'alt'   => 'Shop Style 1', 
                            'img'   => get_template_directory_uri().'/libs/img/1c.png'                                      
                        ),
                        'right-col'      => array(
                            'alt'   => 'Shop Style 2', 
                            'img'   => get_template_directory_uri().'/libs/img/2cr.png'
                        ),
                        'left-col'      => array(
                            'alt'   => 'Shop Style 3', 
                            'img'  => get_template_directory_uri().'/libs/img/2cl.png'
                        ),                                  
                    ),
                    'default' => 'full'
                ),

                array(
                    'id'       => 'wc_num_product',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of Products Per Page', 'finoptis' ),
                    'default'  => '9',
                ),

                array(
                    'id'       => 'wc_num_product_per_row',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of Products Per Row', 'finoptis' ),
                    'default'  => '3',
                ),

                array(
                    'id'       => 'wc_cart_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Cart Icon Show At Menu Area', 'finoptis' ),
                    'on'       => esc_html__( 'Enabled', 'finoptis' ),
                    'off'      => esc_html__( 'Disabled', 'finoptis' ),
                    'default'  => true,
                ), 

                 array(
                'id'       => 'disable-sidebar',
                'type'     => 'switch', 
                'title'    => esc_html__('Sidebar Disable For Single Product Page', 'finoptis'),                
                'default'  => true,
            ), 
               
            )
        ) 
    );
    
    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( '404 Error Page', 'finoptis' ),
    'desc'   => esc_html__( '404 details  here', 'finoptis' ),
    'icon'   => 'el el-error-alt',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(

                array(
                        'id'       => 'title_404',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Title', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter title for 404 page', 'finoptis' ), 
                        'default'  => '404',                
                    ),  
                
                array(
                        'id'       => 'text_404',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Text', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter text for 404 page', 'finoptis' ),  
                        'default'  => 'Page Not Found',             
                    ),                      
                       
                
                array(
                        'id'       => 'back_home',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Back to Home Button Label', 'finoptis' ),
                        'subtitle' => esc_html__( 'Enter label for "Back to Home" button', 'finoptis' ),
                        'default'  => 'Back to Homepage',   
                                    
                    ),                
            
                                  
            ) 
        ) 
    ); 
    


    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );
    
    //add_filter('redux/options/' . $this->args['opt_name'] . '/compiler', array( $this, 'compiler_action' ), 10, 3);

    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri()() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'finoptis' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'finoptis' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_action( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

