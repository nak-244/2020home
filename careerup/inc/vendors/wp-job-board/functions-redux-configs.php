<?php

function careerup_wp_job_board_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-pencil',
        'title' => esc_html__('Jobs Settings', 'careerup'),
        'fields' => array(
            
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Job Archives', 'careerup'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'jobs_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'jobs_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'careerup'),
                'default' => false
            ),
            array(
                'id' => 'jobs_layout_type',
                'type' => 'select',
                'title' => esc_html__('Jobs Layout', 'careerup'),
                'subtitle' => esc_html__('Choose a default layout archive job.', 'careerup'),
                'options' => array(
                    'main' => esc_html__('Main Content', 'careerup'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'careerup'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'careerup'),
                    'half-map' => esc_html__('Half Map', 'careerup'),
                ),
                'default' => 'main-right',
            ),
            array(
                'id' => 'jobs_show_filter_top_sidebar',
                'type' => 'switch',
                'title' => esc_html__('Show filter top sidebar', 'careerup'),
                'default' => false,
                'required' => array('jobs_layout_type', '=', array('main', 'left-main', 'main-right'))
            ),
            array(
                'id' => 'jobs_display_mode',
                'type' => 'select',
                'title' => esc_html__('Jobs display mode', 'careerup'),
                'subtitle' => esc_html__('Choose a default display mode for archive job.', 'careerup'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'careerup'),
                    'list' => esc_html__('List', 'careerup'),
                ),
                'default' => 'list'
            ),
            array(
                'id' => 'jobs_inner_style',
                'type' => 'select',
                'title' => esc_html__('Jobs item style', 'careerup'),
                'subtitle' => esc_html__('Choose a job style.', 'careerup'),
                'options' => array(
                    'list' => esc_html__('List Default', 'careerup'),
                    'list-v1' => esc_html__('List V1', 'careerup'),
                    'list-v2' => esc_html__('List V2', 'careerup'),
                    'list-v3' => esc_html__('List V3', 'careerup'),
                ),
                'default' => 'list',
                'required' => array('jobs_display_mode', '=', array('list'))
            ),
            array(
                'id' => 'jobs_columns',
                'type' => 'select',
                'title' => esc_html__('Job Columns', 'careerup'),
                'options' => $columns,
                'default' => 3,
                'required' => array('jobs_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'jobs_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'careerup'),
                'options' => array(
                    'default' => esc_html__('Default', 'careerup'),
                    'loadmore' => esc_html__('Load More Button', 'careerup'),
                    'infinite' => esc_html__('Infinite Scrolling', 'careerup'),
                ),
                'default' => 'default'
            ),
        )
    );
    
    
    // Job Page
    $sections[] = array(
        'title' => esc_html__('Single Job', 'careerup'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'job_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'job_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'careerup'),
                'default' => false
            ),
            array(
                'id' => 'job_layout_type',
                'type' => 'select',
                'title' => esc_html__('Job Layout', 'careerup'),
                'subtitle' => esc_html__('Choose a default layout single job.', 'careerup'),
                'options' => array(
                    'v1' => esc_html__('Version 1', 'careerup'),
                    'v2' => esc_html__('Version 2', 'careerup'),
                    'v3' => esc_html__('Version 3', 'careerup'),
                    'v4' => esc_html__('Version 4', 'careerup'),
                    'v5' => esc_html__('Version 5', 'careerup'),
                ),
                'default' => 'v1',
            ),
            array(
                'id' => 'show_job_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'careerup'),
                'default' => 1
            ),
            array(
                'id' => 'job_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Job Block Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'job_releated_show',
                'type' => 'switch',
                'title' => esc_html__('Show Jobs Related', 'careerup'),
                'default' => 1
            ),
            array(
                'id' => 'job_releated_number',
                'title' => esc_html__('Number of related jobs to show', 'careerup'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '50',
                'type' => 'slider',
                'required' => array('job_releated_show', '=', true)
            ),
            array(
                'id' => 'job_releated_columns',
                'type' => 'select',
                'title' => esc_html__('Related Jobs Columns', 'careerup'),
                'options' => $columns,
                'default' => 4,
                'required' => array('job_releated_show', '=', true)
            ),
            array(
                'id' => 'job_placeholder_image',
                'type' => 'media',
                'title' => esc_html__('Placeholder Image', 'careerup'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your placeholder.', 'careerup'),
            ),
        )
    );
	
    return $sections;
}
add_filter( 'careerup_redux_framwork_configs', 'careerup_wp_job_board_redux_config', 10, 3 );


// employers
function careerup_wp_job_board_employer_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-pencil',
        'title' => esc_html__('Employer Settings', 'careerup'),
        'fields' => array(
            
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Employer Archives', 'careerup'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'employers_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'employers_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'careerup'),
                'default' => false
            ),
            
            array(
                'id' => 'employers_display_mode',
                'type' => 'select',
                'title' => esc_html__('Employers display mode', 'careerup'),
                'subtitle' => esc_html__('Choose a default display mode for archive employer.', 'careerup'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'careerup'),
                    'list' => esc_html__('List', 'careerup'),
                    'simple' => esc_html__('Simple', 'careerup'),
                ),
                'default' => 'list'
            ),
            array(
                'id' => 'employers_columns',
                'type' => 'select',
                'title' => esc_html__('Employer Columns', 'careerup'),
                'options' => $columns,
                'default' => 4,
                'required' => array('employers_display_mode', '=', array('grid', 'simple'))
            ),
            array(
                'id' => 'employers_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'careerup'),
                'options' => array(
                    'default' => esc_html__('Default', 'careerup'),
                    'loadmore' => esc_html__('Load More Button', 'careerup'),
                    'infinite' => esc_html__('Infinite Scrolling', 'careerup'),
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'employers_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'employers_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'careerup'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive employers page.', 'careerup'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'careerup'),
                        'alt' => esc_html__('Main Content', 'careerup'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'careerup'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'careerup'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'careerup'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'careerup'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
        )
    );
    
    
    // Employer Page
    $sections[] = array(
        'title' => esc_html__('Single Employer', 'careerup'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'employer_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'employer_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'careerup'),
                'default' => false
            ),
            array(
                'id' => 'employer_layout_type',
                'type' => 'select',
                'title' => esc_html__('Employer Layout', 'careerup'),
                'subtitle' => esc_html__('Choose a default layout single employer.', 'careerup'),
                'options' => array(
                    'v1' => esc_html__('Version 1', 'careerup'),
                    'v2' => esc_html__('Version 2', 'careerup'),
                    'v3' => esc_html__('Version 3', 'careerup'),
                ),
                'default' => 'v1',
            ),
            array(
                'id' => 'show_employer_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'careerup'),
                'default' => 1
            ),
        )
    );
    
    return $sections;
}
add_filter( 'careerup_redux_framwork_configs', 'careerup_wp_job_board_employer_redux_config', 10, 3 );


// candidates
function careerup_wp_job_board_candidate_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-pencil',
        'title' => esc_html__('Candidate Settings', 'careerup'),
        'fields' => array(
            
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Candidate Archives', 'careerup'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'candidates_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'candidates_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'careerup'),
                'default' => false
            ),
            array(
                'id' => 'candidates_show_filter_top_sidebar',
                'type' => 'switch',
                'title' => esc_html__('Show filter top sidebar', 'careerup'),
                'default' => false,
            ),
            array(
                'id' => 'candidates_display_mode',
                'type' => 'select',
                'title' => esc_html__('Candidates display mode', 'careerup'),
                'subtitle' => esc_html__('Choose a default display mode for archive candidate.', 'careerup'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'careerup'),
                    'list' => esc_html__('List', 'careerup'),
                ),
                'default' => 'list'
            ),
            array(
                'id' => 'candidates_columns',
                'type' => 'select',
                'title' => esc_html__('Candidate Columns', 'careerup'),
                'options' => $columns,
                'default' => 4,
                'required' => array('candidates_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'candidates_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'careerup'),
                'options' => array(
                    'default' => esc_html__('Default', 'careerup'),
                    'loadmore' => esc_html__('Load More Button', 'careerup'),
                    'infinite' => esc_html__('Infinite Scrolling', 'careerup'),
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'candidates_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'candidates_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'careerup'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive candidates page.', 'careerup'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'careerup'),
                        'alt' => esc_html__('Main Content', 'careerup'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'careerup'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'careerup'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'careerup'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'careerup'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
        )
    );
    
    
    // Candidate Page
    $sections[] = array(
        'title' => esc_html__('Single Candidate', 'careerup'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'candidate_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'careerup').'</h3>',
            ),
            array(
                'id' => 'candidate_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'careerup'),
                'default' => false
            ),
            array(
                'id' => 'candidate_layout_type',
                'type' => 'select',
                'title' => esc_html__('Candidate Layout', 'careerup'),
                'subtitle' => esc_html__('Choose a default layout single candidate.', 'careerup'),
                'options' => array(
                    'v1' => esc_html__('Version 1', 'careerup'),
                    'v2' => esc_html__('Version 2', 'careerup'),
                ),
                'default' => 'v1',
            ),
            array(
                'id' => 'show_candidate_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'careerup'),
                'default' => 1
            )
        )
    );
    
    return $sections;
}
add_filter( 'careerup_redux_framwork_configs', 'careerup_wp_job_board_candidate_redux_config', 10, 3 );
