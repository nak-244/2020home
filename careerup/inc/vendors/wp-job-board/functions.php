<?php

function careerup_get_jobs( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_jobs_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
		'categories' => array(),
		'types' => array(),
		'locations' => array(),
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'job_listing',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_jobs_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_JOB_LISTING_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'urgent':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_JOB_LISTING_PREFIX.'urgent',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
	}

	if ( !empty($post__in) ) {
    	$query_args['post__in'] = $post__in;
    }

    if ( !empty($fields) ) {
    	$query_args['fields'] = $fields;
    }

    if ( !empty($author) ) {
    	$query_args['author'] = $author;
    }

    $tax_query = array();
    if ( !empty($categories) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_category',
            'field'         => 'slug',
            'terms'         => implode(",", $categories ),
            'operator'      => 'IN'
        );
    }
    if ( !empty($types) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_type',
            'field'         => 'slug',
            'terms'         => implode(",", $types ),
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_location',
            'field'         => 'slug',
            'terms'         => implode(",", $locations ),
            'operator'      => 'IN'
        );
    }

    if ( !empty($tax_query) ) {
    	$query_args['tax_query'] = $tax_query;
    }
    
    if ( !empty($meta_query) ) {
    	$query_args['meta_query'] = $meta_query;
    }

	return new WP_Query( $query_args );
}

if ( !function_exists('careerup_job_content_class') ) {
	function careerup_job_content_class( $class ) {
		$prefix = 'jobs';
		if ( is_singular( 'job_listing' ) ) {
            $prefix = 'job';
        }
		if ( careerup_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'careerup_job_content_class', 'careerup_job_content_class', 1 , 1  );

if ( !function_exists('careerup_get_jobs_layout_configs') ) {
	function careerup_get_jobs_layout_configs() {
		$layout_type = careerup_get_jobs_layout_type();
		switch ( $layout_type ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => 'jobs-filter-sidebar', 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => 'jobs-filter-sidebar',  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['right'] = array( 'sidebar' => 'jobs-filter-sidebar',  'class' => 'offcanvas-filter-sidebar' ); 
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		}
		return $configs; 
	}
}

function careerup_get_jobs_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout_type', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = careerup_get_config('jobs_layout_type', 'main-right');
	}
	return apply_filters( 'careerup_get_jobs_layout_type', $layout_type );
}

function careerup_get_jobs_display_mode() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$display_mode = get_post_meta( $post->ID, 'apus_page_display_mode', true );
	}
	if ( empty($display_mode) ) {
		$display_mode = careerup_get_config('jobs_display_mode', 'list');
	}
	return apply_filters( 'careerup_get_jobs_display_mode', $display_mode );
}

function careerup_get_jobs_inner_style() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$inner_style = get_post_meta( $post->ID, 'apus_page_inner_style', true );
	}
	if ( empty($inner_style) ) {
		$inner_style = careerup_get_config('jobs_inner_style', 'list');
	}
	return apply_filters( 'careerup_get_jobs_inner_style', $inner_style );
}

function careerup_get_jobs_columns() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_jobs_columns', true );
	}
	if ( empty($columns) ) {
		$columns = careerup_get_config('jobs_columns', 3);
	}
	return apply_filters( 'careerup_get_jobs_columns', $columns );
}

function careerup_get_jobs_filter_top_sidebar() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$show = get_post_meta( $post->ID, 'apus_page_jobs_show_filter_top_sidebar', true );
	}
	if ( empty($show) ) {
		$show = careerup_get_config('jobs_show_filter_top_sidebar', false);
	} else {
		if ( $show == 'yes' ) {
			$show = true;
		} else {
			$show = false;
		}
	}
	return apply_filters( 'careerup_get_jobs_filter_top_sidebar', $show );
}

function careerup_get_job_layout_type() {
	global $post;
	if ( defined('CAREERUP_DEMO_MODE') && CAREERUP_DEMO_MODE ) {
		$layout_type = get_post_meta($post->ID, WP_JOB_BOARD_JOB_LISTING_PREFIX.'layout_type', true);
	}
	
	if ( empty($layout_type) ) {
		$layout_type = careerup_get_config('job_layout_type', 'v1');
	}
	return apply_filters( 'careerup_get_job_layout_type', $layout_type );
}

function careerup_get_jobs_pagination() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$pagination = get_post_meta( $post->ID, 'apus_page_jobs_pagination', true );
	}
	if ( empty($pagination) ) {
		$pagination = careerup_get_config('jobs_pagination', 'default');
	}
	return apply_filters( 'careerup_get_jobs_pagination', $pagination );
}

function careerup_job_scripts() {
	
	wp_enqueue_style( 'leaflet' );
	wp_enqueue_script( 'jquery-highlight' );
    wp_enqueue_script( 'leaflet' );
    wp_enqueue_script( 'leaflet-GoogleMutant' );
    wp_enqueue_script( 'control-geocoder' );
    wp_enqueue_script( 'esri-leaflet' );
    wp_enqueue_script( 'esri-leaflet-geocoder' );
    wp_enqueue_script( 'leaflet-markercluster' );
    wp_enqueue_script( 'leaflet-HtmlIcon' );


	wp_enqueue_script( 'careerup-job', get_template_directory_uri() . '/js/job.js', array( 'jquery' ), '20150330', true );

	$mapbox_token = '';
	$mapbox_style = '';
	$custom_style = '';
	if ( wp_job_board_get_option('map_service', '') == 'mapbox' ) {
		$mapbox_token = wp_job_board_get_option('mapbox_token', '');
		$mapbox_style = wp_job_board_get_option('mapbox_style', 'mapbox.streets-basic');
	} else {
		$custom_style = wp_job_board_get_option('google_map_style', '');
	}

	wp_register_script( 'careerup-job-map', get_template_directory_uri() . '/js/job-map.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'careerup-job-map', 'careerup_job_map_opts', array(
		'mapbox_token' => $mapbox_token,
		'mapbox_style' => $mapbox_style,
		'custom_style' => $custom_style,
		'default_latitude' => wp_job_board_get_option('default_maps_location_latitude', '43.6568'),
		'default_longitude' => wp_job_board_get_option('default_maps_location_longitude', '-79.4512'),
	));
	wp_enqueue_script( 'careerup-job-map' );
}
add_action( 'wp_enqueue_scripts', 'careerup_job_scripts', 10 );

function careerup_job_create_resume_pdf_styles() {
	return array(
		get_template_directory() . '/css/resume-pdf.css'
	);
}
add_filter( 'wp-job-board-style-pdf', 'careerup_job_create_resume_pdf_styles', 10 );

// add filter sidebar when layout full
function careerup_add_filter_sidebar() {
	echo '<button class="btn btn-dark btn-show-filter"><i class="flaticon-filter pre"></i><span class="hidden-xs">'.esc_html__('Show Filter','careerup').'</span></button>';
}

function careerup_job_metaboxes(array $metaboxes) {
	// jobs
	$prefix = WP_JOB_BOARD_JOB_LISTING_PREFIX;
	if ( isset($metaboxes[ $prefix . 'general' ]) && isset($metaboxes[ $prefix . 'general' ]['fields']) ) {
		$metaboxes[ $prefix . 'general' ]['fields'][] = array(
			'name'              => esc_html__( 'Layout Type', 'careerup' ),
			'id'                => $prefix . 'layout_type',
			'type'              => 'select',
			'options'			=> array(
                '' => esc_html__('Global Settings', 'careerup'),
                'v1' => esc_html__('Version 1', 'careerup'),
                'v2' => esc_html__('Version 2', 'careerup'),
                'v3' => esc_html__('Version 3', 'careerup'),
                'v4' => esc_html__('Version 4', 'careerup'),
                'v5' => esc_html__('Version 5', 'careerup'),
            ),
		);
	}
	// employers
	$prefix = WP_JOB_BOARD_EMPLOYER_PREFIX;
	if ( isset($metaboxes[ $prefix . 'general' ]) && isset($metaboxes[ $prefix . 'general' ]['fields']) ) {
		$metaboxes[ $prefix . 'general' ]['fields'][] = array(
			'name'              => esc_html__( 'Layout Type', 'careerup' ),
			'id'                => $prefix . 'layout_type',
			'type'              => 'select',
			'options'			=> array(
                '' => esc_html__('Global Settings', 'careerup'),
                'v1' => esc_html__('Version 1', 'careerup'),
                'v2' => esc_html__('Version 2', 'careerup'),
                'v3' => esc_html__('Version 3', 'careerup'),
            ),
		);
	}
	// candidate
	$prefix = WP_JOB_BOARD_CANDIDATE_PREFIX;
	if ( isset($metaboxes[ $prefix . 'general' ]) && isset($metaboxes[ $prefix . 'general' ]['fields']) ) {
		$metaboxes[ $prefix . 'general' ]['fields'][] = array(
			'name'              => esc_html__( 'Layout Type', 'careerup' ),
			'id'                => $prefix . 'layout_type',
			'type'              => 'select',
			'options'			=> array(
                '' => esc_html__('Global Settings', 'careerup'),
                'v1' => esc_html__('Version 1', 'careerup'),
                'v2' => esc_html__('Version 2', 'careerup'),
            ),
		);
	}
	return $metaboxes;
}
add_filter( 'cmb2_meta_boxes', 'careerup_job_metaboxes' );

function careerup_job_display_featured_urgent($post) {
	$featured = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'featured', true );
	$urgent = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'urgent', true );
	if ( $featured ) { ?>
        <span class="featured" data-toggle="tooltip" title="<?php esc_attr_e('featured', 'careerup'); ?>"><i class="fa fa-star text-theme"></i></span>
    <?php } ?>
    <?php if ( $urgent ) { ?>
        <span class="urgent"><?php esc_html_e('Urgent', 'careerup'); ?></span>
    <?php }
}

function careerup_job_display_featured_icon($post) {
	$featured = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'featured', true );
	
	if ( $featured ) { ?>
        <span class="featured" data-toggle="tooltip" title="<?php esc_attr_e('featured', 'careerup'); ?>"><i class="fa fa-star text-theme"></i></span>
    <?php }
}

function careerup_job_display_urgent_icon($post) {
	$urgent = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'urgent', true );
	if ( $urgent ) { ?>
        <span class="urgent"><?php esc_html_e('Urgent', 'careerup'); ?></span>
    <?php }
}

function careerup_job_template_folder_name($folder) {
	$folder = 'template-jobs';
	return $folder;
}
add_filter( 'wp-job-board-theme-folder-name', 'careerup_job_template_folder_name', 10 );


function careerup_check_employer_candidate_review($post) {
	if ( (comments_open($post) || get_comments_number($post)) ) {
		if ( method_exists('WP_Job_Board_Employer', 'check_restrict_review') ) {
			if ( WP_Job_Board_Employer::check_restrict_review($post) ) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}
	return false;
}

function careerup_placeholder_img_src( $size = 'thumbnail' ) {
	$src               = get_template_directory_uri() . '/images/placeholder.png';
	$placeholder_image = careerup_get_config('job_placeholder_image');
	if ( !empty($placeholder_image['id']) ) {
        if ( is_numeric( $placeholder_image['id'] ) ) {
			$image = wp_get_attachment_image_src( $placeholder_image['id'], $size );

			if ( ! empty( $image[0] ) ) {
				$src = $image[0];
			}
		} else {
			$src = $placeholder_image;
		}
    }

	return apply_filters( 'careerup_job_placeholder_img_src', $src );
}


function careerup_job_display_employer_logo($post) {
	$author_id = $post->post_author;
	$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);

	if ( has_post_thumbnail($employer_id) ) { ?>
        <div class="employer-logo">
            <a href="<?php echo esc_url( get_permalink($post) ); ?>">
                <?php echo get_the_post_thumbnail( $employer_id, 'thumbnail' ); ?>
            </a>
        </div>
    <?php } else { ?>
    	<div class="employer-logo">
            <a href="<?php echo esc_url( get_permalink($post) ); ?>">
                <img src="<?php echo esc_url(careerup_placeholder_img_src()); ?>" alt="<?php echo esc_attr(get_the_title($employer_id)); ?>">
            </a>
        </div>
    <?php }
}

function careerup_is_jobs_page() {
	if ( is_page() ) {
		$page_name = basename(get_page_template());
		if ( $page_name == 'page-jobs.php' ) {
			return true;
		}
	} elseif( is_post_type_archive('job_listing') || is_tax('job_listing_category') || is_tax('job_listing_type') || is_tax('job_listing_location') || is_tax('job_listing_tag') ) {
		return true;
	}
	return false;
}

// demo function
function careerup_check_demo_account() {
	if ( defined('CAREERUP_DEMO_MODE') && CAREERUP_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( $user_obj->data->user_login == 'candidate' || $user_obj->data->user_login == 'employer' ) {
			$return = array( 'status' => false, 'msg' => esc_html__('Demo users are not allowed to modify information.', 'careerup') );
		   	echo wp_json_encode($return);
		   	exit;
		}
	}
}
add_action('wp-job-board-process-apply-email', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-apply-internal', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-remove-applied', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-add-job-shortlist', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-remove-job-shortlist', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-follow-employer', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-unfollow-employer', 'careerup_check_demo_account', 10);

add_action('wp-job-board-process-add-candidate-shortlist', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-remove-candidate-shortlist', 'careerup_check_demo_account', 10);


add_action('wp-job-board-process-change-password', 'careerup_check_demo_account', 10);
add_action('wp-job-board-before-delete-profile', 'careerup_check_demo_account', 10);
add_action('wp-job-board-process-applicant-reject', 'careerup_check_demo_account', 10);
add_action('wp-job-board-before-change-slug', 'careerup_check_demo_account', 10);


function careerup_check_demo_account2($error) {
	if ( defined('CAREERUP_DEMO_MODE') && CAREERUP_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( $user_obj->data->user_login == 'candidate' || $user_obj->data->user_login == 'employer' ) {
			$error[] = esc_html__('Demo users are not allowed to modify information.', 'careerup');
		}
	}
	return $error;
}
add_filter('wp-job-board-submission-validate', 'careerup_check_demo_account2', 10, 2);
add_filter('wp-job-board-edit-validate', 'careerup_check_demo_account2', 10, 2);

function careerup_check_demo_account3($post_id, $prefix) {
	if ( defined('CAREERUP_DEMO_MODE') && CAREERUP_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( $user_obj->data->user_login == 'candidate' || $user_obj->data->user_login == 'employer' ) {
			$_SESSION['messages'][] = array( 'danger', esc_html__('Demo users are not allowed to modify information.', 'careerup') );
			$redirect_url = get_permalink( wp_job_board_get_option('edit_profile_page_id') );
			WP_Job_Board_Mixes::redirect( $redirect_url );
			exit();
		}
	}
}
add_action('wp-job-board-process-profile-before-change', 'careerup_check_demo_account3', 10, 2);
add_action('wp-job-board-process-resume-before-change', 'careerup_check_demo_account3', 10, 2);

function careerup_check_demo_account4() {
	if ( defined('CAREERUP_DEMO_MODE') && CAREERUP_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( $user_obj->data->user_login == 'candidate' || $user_obj->data->user_login == 'employer' ) {
			$return['msg'] = esc_html__('Demo users are not allowed to modify information.', 'careerup');
			$return['status'] = false;
			echo json_encode($return); exit;
		}
	}
}
add_action('wp-private-message-before-reply-message', 'careerup_check_demo_account4');
add_action('wp-private-message-before-add-message', 'careerup_check_demo_account4');
add_action('wp-private-message-before-delete-message', 'careerup_check_demo_account4');

function careerup_check_demo_account5() {
	if ( defined('CAREERUP_DEMO_MODE') && CAREERUP_DEMO_MODE ) {
		if ( !empty($_POST['user_login']) && ($_POST['user_login'] == 'candidate' || $_POST['user_login'] == 'employer') ) {
			$return['msg'] = esc_html__('Demo users are not allowed to reset password.', 'careerup');
			$return['status'] = false;
			echo json_encode($return); exit;
		}
	}
}
add_action('wp-job-board-process-forgot-password', 'careerup_check_demo_account5', 10);