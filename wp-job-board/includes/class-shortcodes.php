<?php
/**
 * Shortcodes
 *
 * @package    wp-job-board
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class WP_Job_Board_Shortcodes {
	/**
	 * Initialize shortcodes
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
	    add_action( 'wp', array( __CLASS__, 'check_logout' ) );

	    // login | register
		add_shortcode( 'wp_job_board_logout', array( __CLASS__, 'logout' ) );
	    add_shortcode( 'wp_job_board_login', array( __CLASS__, 'login' ) );
	    add_shortcode( 'wp_job_board_register', array( __CLASS__, 'register' ) );

	    // profile
	    add_shortcode( 'wp_job_board_user_dashboard', array( __CLASS__, 'user_dashboard' ) );
	    add_shortcode( 'wp_job_board_change_password', array( __CLASS__, 'change_password' ) );
	    add_shortcode( 'wp_job_board_change_profile', array( __CLASS__, 'change_profile' ) );
	    add_shortcode( 'wp_job_board_change_resume', array( __CLASS__, 'change_resume' ) );
	    add_shortcode( 'wp_job_board_delete_profile', array( __CLASS__, 'delete_profile' ) );
	    add_shortcode( 'wp_job_board_approve_user', array( __CLASS__, 'approve_user' ) );
    	
    	// employer
		add_shortcode( 'wp_job_board_submission', array( __CLASS__, 'submission' ) );
	    add_shortcode( 'wp_job_board_my_jobs', array( __CLASS__, 'my_jobs' ) );

	    add_shortcode( 'wp_job_board_job_applicants', array( __CLASS__, 'job_applicants' ) );
	    add_shortcode( 'wp_job_board_my_candidates_shortlist', array( __CLASS__, 'my_candidates_shortlist' ) );
	    add_shortcode( 'wp_job_board_my_candidates_alerts', array( __CLASS__, 'my_candidates_alerts' ) );

	    // candidate
	    add_shortcode( 'wp_job_board_my_jobs_shortlist', array( __CLASS__, 'my_jobs_shortlist' ) );
	    add_shortcode( 'wp_job_board_my_applied', array( __CLASS__, 'my_applied' ) );
	    add_shortcode( 'wp_job_board_my_jobs_alerts', array( __CLASS__, 'my_jobs_alerts' ) );
	    add_shortcode( 'wp_job_board_my_following_employers', array( __CLASS__, 'my_following_employers' ) );

	    add_shortcode( 'wp_job_board_jobs', array( __CLASS__, 'jobs' ) );
	    add_shortcode( 'wp_job_board_employers', array( __CLASS__, 'employers' ) );
	    add_shortcode( 'wp_job_board_candidates', array( __CLASS__, 'candidates' ) );
	}

	/**
	 * Logout checker
	 *
	 * @access public
	 * @param $wp
	 * @return void
	 */
	public static function check_logout( $wp ) {
		$post = get_post();

		if ( is_page() ) {
			if ( has_shortcode( $post->post_content, 'wp_job_board_logout' ) ) {
				wp_redirect( html_entity_decode( wp_logout_url( home_url( '/' ) ) ) );
				exit();
			} elseif ( has_shortcode( $post->post_content, 'wp_job_board_my_jobs' ) ) {
				self::my_jobs_hanlder();
			}
		}
	}

	/**
	 * Logout
	 *
	 * @access public
	 * @return void
	 */
	public static function logout( $atts ) {}

	/**
	 * Login
	 *
	 * @access public
	 * @return string
	 */
	public static function login( $atts ) {
		if ( is_user_logged_in() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/login' );
	}

	/**
	 * Login
	 *
	 * @access public
	 * @return string
	 */
	public static function register( $atts ) {
		if ( is_user_logged_in() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/register' );
	}

	/**
	 * Submission index
	 *
	 * @access public
	 * @return string|void
	 */
	public static function submission( $atts ) {
	    if ( ! is_user_logged_in() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    } else {
			if ( !WP_Job_Board_User::is_employer() ) {
				return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
			}
	    }
	    
		$form = WP_Job_Board_Submit_Form::get_instance();

		return $form->output();
	}

	public static function edit_form( $atts ) {
	    if ( ! is_user_logged_in() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    } else {
			if ( !WP_Job_Board_User::is_employer() ) {
				return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
			}
	    }
	    
		$form = WP_Job_Board_Edit_Form::get_instance();

		return $form->output();
	}
	
	public static function my_jobs_hanlder() {
		$action = !empty($_REQUEST['action']) ? sanitize_title( $_REQUEST['action'] ) : '';
		$job_id = isset( $_REQUEST['job_id'] ) ? absint( $_REQUEST['job_id'] ) : 0;

		if ( $action == 'relist' || $action == 'continue' ) {
			$submit_form_page_id = wp_job_board_get_option('submit_job_form_page_id');
			if ( $submit_form_page_id ) {
				$submit_page_url = get_permalink($submit_form_page_id);
				wp_safe_redirect( add_query_arg( array( 'job_id' => absint( $job_id ) ), $submit_page_url ) );
				exit;
			}
			
		}
	}

	public static function my_jobs( $atts ) {
		if ( ! is_user_logged_in() ) {
			return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
		} else {
			if ( !WP_Job_Board_User::is_employer() ) {
				return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
			}
		}
		if ( ! empty( $_REQUEST['action'] ) ) {
			$action = sanitize_title( $_REQUEST['action'] );
			
			if ( $action == 'edit' ) {
				return self::edit_form($atts);
			}
		}
		return WP_Job_Board_Template_Loader::get_template_part( 'submission/my-jobs' );
	}
	
	/**
	 * Employer dashboard
	 *
	 * @access public
	 * @param $atts
	 * @return string
	 */
	public static function user_dashboard( $atts ) {
		if ( is_user_logged_in() && ( WP_Job_Board_User::is_employer() || WP_Job_Board_User::is_candidate() ) ) {
			$user_id = get_current_user_id();
		    if ( WP_Job_Board_User::is_employer() ) {
				$employer_id = WP_Job_Board_User::get_employer_by_user_id($user_id);
				return WP_Job_Board_Template_Loader::get_template_part( 'misc/employer-dashboard', array( 'user_id' => $user_id, 'employer_id' => $employer_id ) );
			} else {
				$candidate_id = WP_Job_Board_User::get_candidate_by_user_id($user_id);
				return WP_Job_Board_Template_Loader::get_template_part( 'misc/candidate-dashboard', array( 'user_id' => $user_id, 'candidate_id' => $candidate_id ) );
			}
	    } else {
	    	return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	}

	/**
	 * Change password
	 *
	 * @access public
	 * @param $atts
	 * @return string
	 */
	public static function change_password( $atts ) {
		if ( ! is_user_logged_in() ) {
			return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
		}

		return WP_Job_Board_Template_Loader::get_template_part( 'misc/password-form' );
	}

	/**
	 * Change profile
	 *
	 * @access public
	 * @param $atts
	 * @return void
	 */
	public static function change_profile( $atts ) {
		if ( ! is_user_logged_in() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	    
	    $metaboxes = apply_filters( 'cmb2_meta_boxes', array() );
	    $metaboxes_form = array();
	    $user_id = get_current_user_id();
	    if ( WP_Job_Board_User::is_employer($user_id) ) {
	    	if ( ! isset( $metaboxes[ WP_JOB_BOARD_EMPLOYER_PREFIX . 'front' ] ) ) {
				return __( 'A metabox with the specified \'metabox_id\' doesn\'t exist.', 'wp-job-board' );
			}
			$metaboxes_form = $metaboxes[ WP_JOB_BOARD_EMPLOYER_PREFIX . 'front' ];
			$post_id = WP_Job_Board_User::get_employer_by_user_id($user_id);
	    } elseif( WP_Job_Board_User::is_candidate($user_id) ) {
	    	if ( ! isset( $metaboxes[ WP_JOB_BOARD_CANDIDATE_PREFIX . 'front' ] ) ) {
				return __( 'A metabox with the specified \'metabox_id\' doesn\'t exist.', 'wp-job-board' );
			}
			$metaboxes_form = $metaboxes[ WP_JOB_BOARD_CANDIDATE_PREFIX . 'front' ];
			$post_id = WP_Job_Board_User::get_candidate_by_user_id($user_id);
	    } else {
	    	return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }

		if ( !$post_id ) {
			return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
		}

		wp_enqueue_script('google-maps');
		wp_enqueue_script('select2');
		wp_enqueue_style('select2');
		
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/profile-form', array('post_id' => $post_id, 'metaboxes_form' => $metaboxes_form ) );
	}

	public static function change_resume( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_candidate() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	    
	    $metaboxes = apply_filters( 'cmb2_meta_boxes', array() );
	    $metaboxes_form = array();
	    $user_id = get_current_user_id();
	    
    	if ( ! isset( $metaboxes[ WP_JOB_BOARD_CANDIDATE_PREFIX . 'resume_front' ] ) ) {
			return __( 'A metabox with the specified \'metabox_id\' doesn\'t exist.', 'wp-job-board' );
		}
		$metaboxes_form = $metaboxes[ WP_JOB_BOARD_CANDIDATE_PREFIX . 'resume_front' ];
		$post_id = WP_Job_Board_User::get_candidate_by_user_id($user_id);
		
		if ( !$post_id ) {
			return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
		}

		wp_enqueue_script('google-maps');
		wp_enqueue_script('select2');
		wp_enqueue_style('select2');

		return WP_Job_Board_Template_Loader::get_template_part( 'misc/resume-form', array('post_id' => $post_id, 'metaboxes_form' => $metaboxes_form ) );
	}

	public static function delete_profile($atts) {
		if ( !is_user_logged_in() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	    $user_id = get_current_user_id();
	    return WP_Job_Board_Template_Loader::get_template_part( 'misc/delete-profile-form', array('user_id' => $user_id) );
	}

	public static function approve_user($atts) {
	    return WP_Job_Board_Template_Loader::get_template_part( 'misc/approve-user' );
	}

	public static function job_applicants( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_employer() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	    $user_id = get_current_user_id();
		$jobs_loop = WP_Job_Board_Query::get_posts(array(
			'post_type' => 'job_listing',
			'fields' => 'ids',
			'author' => $user_id,
			'orderby' => 'date',
			'order' => 'DESC',
		));
		$job_ids = array();
		if ( !empty($jobs_loop) && !empty($jobs_loop->posts) ) {
			$job_ids = $jobs_loop->posts;
		}

		return WP_Job_Board_Template_Loader::get_template_part( 'misc/job-applicants', array( 'job_ids' => $job_ids ) );
	}

	public static function my_candidates_shortlist( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_employer() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	    $candidate_ids_list = array();

	    $user_id = get_current_user_id();
		$employer_id = WP_Job_Board_User::get_employer_by_user_id($user_id);
		$employer_ids = WP_Job_Board_WPML::get_all_translations_object_id($employer_id);
		if ( empty($employer_ids) ) {
			$employer_ids = array($employer_id);
		}

		foreach ($employer_ids as $employer_id) {
			$candidate_ids = get_post_meta( $employer_id, WP_JOB_BOARD_EMPLOYER_PREFIX.'shortlist', true );
			if ( !empty($candidate_ids) ) {
				foreach ($candidate_ids as $candidate_id) {
					$ids = WP_Job_Board_WPML::get_all_translations_object_id($candidate_id);
					if ( !empty($ids) ) {
						$candidate_ids_list = array_merge($candidate_ids_list, $ids);
					} else {
						$candidate_ids_list = array_merge($candidate_ids_list, array($candidate_id));
					}
				}
			}
		}
		
	    return WP_Job_Board_Template_Loader::get_template_part( 'misc/candidates-shortlist', array( 'candidate_ids' => $candidate_ids_list ) );
	}

	public static function my_candidates_alerts( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_employer() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }

	    $user_id = get_current_user_id();
	    if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}
		$query_vars = array(
		    'post_type' => 'candidate_alert',
		    'posts_per_page'    => get_option('posts_per_page'),
		    'paged'    			=> $paged,
		    'post_status' => 'publish',
		    'fields' => 'ids',
		    'author' => $user_id,
		);
		if ( isset($_GET['search']) ) {
			$query_vars['s'] = $_GET['search'];
		}
		if ( isset($_GET['orderby']) ) {
			switch ($_GET['orderby']) {
				case 'menu_order':
					$query_vars['orderby'] = array(
						'menu_order' => 'ASC',
						'date'       => 'DESC',
						'ID'         => 'DESC',
					);
					break;
				case 'newest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'DESC';
					break;
				case 'oldest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'ASC';
					break;
			}
		}

		$alerts = WP_Job_Board_Query::get_posts($query_vars);

		return WP_Job_Board_Template_Loader::get_template_part( 'misc/my-candidates-alerts', array( 'alerts' => $alerts ) );
	}

	public static function my_jobs_shortlist( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_candidate() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }
	    $user_id = get_current_user_id();
		$candidate_id = WP_Job_Board_User::get_candidate_by_user_id($user_id);

		$job_ids = get_post_meta( $candidate_id, WP_JOB_BOARD_CANDIDATE_PREFIX.'shortlist', true );

	    return WP_Job_Board_Template_Loader::get_template_part( 'misc/jobs-shortlist', array( 'job_ids' => $job_ids ) );
	}

	public static function my_applied( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_candidate() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }

	    $user_id = get_current_user_id();
		$candidate_id = WP_Job_Board_User::get_candidate_by_user_id($user_id);

		if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}
		$candidate_ids = WP_Job_Board_WPML::get_all_translations_object_id($candidate_id);
		if ( empty($candidate_ids) ) {
			$candidate_ids = array($candidate_id);
		}
		$query_vars = array(
		    'post_type' => 'job_applicant',
		    'posts_per_page'    => get_option('posts_per_page'),
		    'paged'    			=> $paged,
		    'post_status' => 'publish',
		    'fields' => 'ids',
		    'meta_query' => array(
		    	array(
			    	'key' => WP_JOB_BOARD_APPLICANT_PREFIX . 'candidate_id',
			    	'value' => $candidate_ids,
			    	'compare' => 'IN',
			    ),
			    
			)
		);
		if ( isset($_GET['search']) ) {
			$meta_query = $query_vars['meta_query'];
			$meta_query[] = array(
		    	'key' => WP_JOB_BOARD_APPLICANT_PREFIX . 'job_name',
		    	'value' => $_GET['search'],
		    	'compare' => 'LIKE',
		    );
			$query_vars['meta_query'] = $meta_query;
		}
		if ( isset($_GET['orderby']) ) {
			switch ($_GET['orderby']) {
				case 'menu_order':
					$query_vars['orderby'] = array(
						'menu_order' => 'ASC',
						'date'       => 'DESC',
						'ID'         => 'DESC',
					);
					break;
				case 'newest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'DESC';
					break;
				case 'oldest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'ASC';
					break;
			}
		}
		$applicants = WP_Job_Board_Query::get_posts($query_vars);

		return WP_Job_Board_Template_Loader::get_template_part( 'misc/jobs-applied', array( 'applicants' => $applicants ) );
	}

	public static function my_jobs_alerts( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_candidate() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }

	    $user_id = get_current_user_id();
	    if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}

		$query_vars = array(
		    'post_type' => 'job_alert',
		    'posts_per_page'    => get_option('posts_per_page'),
		    'paged'    			=> $paged,
		    'post_status' => 'publish',
		    'fields' => 'ids',
		    'author' => $user_id,
		);
		if ( isset($_GET['search']) ) {
			$query_vars['s'] = $_GET['search'];
		}
		if ( isset($_GET['orderby']) ) {
			switch ($_GET['orderby']) {
				case 'menu_order':
					$query_vars['orderby'] = array(
						'menu_order' => 'ASC',
						'date'       => 'DESC',
						'ID'         => 'DESC',
					);
					break;
				case 'newest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'DESC';
					break;
				case 'oldest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'ASC';
					break;
			}
		}
		$alerts = WP_Job_Board_Query::get_posts($query_vars);

		return WP_Job_Board_Template_Loader::get_template_part( 'misc/my-jobs-alerts', array( 'alerts' => $alerts ) );
	}

	public static function my_following_employers( $atts ) {
		if ( !is_user_logged_in() || !WP_Job_Board_User::is_candidate() ) {
		    return WP_Job_Board_Template_Loader::get_template_part( 'misc/not-allowed' );
	    }

	    $user_id = get_current_user_id();
	    $ids = get_user_meta($user_id, '_following_employer', true);
	    $employers = array();
	    if ( !empty($ids) && is_array($ids) ) {
		    if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
			$query_vars = array(
			    'post_type' => 'employer',
			    'posts_per_page'    => get_option('posts_per_page'),
			    'paged'    			=> $paged,
			    'post_status' => 'publish',
			    'post__in' => $ids,
			);
			if ( isset($_GET['search']) ) {
				$query_vars['s'] = $_GET['search'];
			}
			if ( isset($_GET['orderby']) ) {
				switch ($_GET['orderby']) {
					case 'menu_order':
						$query_vars['orderby'] = array(
							'menu_order' => 'ASC',
							'date'       => 'DESC',
							'ID'         => 'DESC',
						);
						break;
					case 'newest':
						$query_vars['orderby'] = 'date';
						$query_vars['order'] = 'DESC';
						break;
					case 'oldest':
						$query_vars['orderby'] = 'date';
						$query_vars['order'] = 'ASC';
						break;
				}
			}
			$employers = WP_Job_Board_Query::get_posts($query_vars);
		}
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/my-following-employers', array( 'employers' => $employers ) );
	}

	public static function jobs( $atts ) {
		$atts = wp_parse_args( $atts, array(
			'limit' => wp_job_board_get_option('number_jobs_per_page', 10),
			'post__in' => array(),
			'categories' => array(),
			'types' => array(),
			'locations' => array(),
		));

		if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}

		$query_args = array(
			'post_type' => 'job_listing',
		    'post_status' => 'publish',
		    'post_per_page' => $atts['limit'],
		    'paged' => $paged,
		);
		$params = true;
		if ( WP_Job_Board_Job_Filter::has_filter() ) {
			$params = $_GET;
		}
		$jobs = WP_Job_Board_Query::get_posts($query_args, $params);
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/jobs', array( 'jobs' => $jobs, 'atts' => $atts ) );
	}

	public static function employers( $atts ) {
		$atts = wp_parse_args( $atts, array(
			'limit' => wp_job_board_get_option('number_employers_per_page', 10),
			'post__in' => array(),
			'categories' => array(),
			'types' => array(),
			'locations' => array(),
		));

		if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}

		$query_args = array(
			'post_type' => 'employer',
		    'post_status' => 'publish',
		    'post_per_page' => $atts['limit'],
		    'paged' => $paged,
		);
		$params = true;
		if ( WP_Job_Board_Employer_Filter::has_filter() ) {
			$params = $_GET;
		}
		$employers = WP_Job_Board_Query::get_posts($query_args, $params);
		
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/employers', array( 'employers' => $employers, 'atts' => $atts ) );
	}

	public static function candidates( $atts ) {
		$atts = wp_parse_args( $atts, array(
			'limit' => wp_job_board_get_option('number_candidates_per_page', 10),
			'post__in' => array(),
			'categories' => array(),
			'types' => array(),
			'locations' => array(),
		));

		if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}

		$query_args = array(
			'post_type' => 'candidate',
		    'post_status' => 'publish',
		    'post_per_page' => $atts['limit'],
		    'paged' => $paged,
		);
		$params = true;
		if ( WP_Job_Board_Candidate_Filter::has_filter() ) {
			$params = $_GET;
		}
		$candidates = WP_Job_Board_Query::get_posts($query_args, $params);
		return WP_Job_Board_Template_Loader::get_template_part( 'misc/candidates', array( 'candidates' => $candidates, 'atts' => $atts ) );
	}
}

WP_Job_Board_Shortcodes::init();
