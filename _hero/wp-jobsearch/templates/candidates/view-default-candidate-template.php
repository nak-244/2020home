<?php
/**
 * Listing search box
 *
 */

use WP_Jobsearch\Candidate_Profile_Restriction;

global $jobsearch_post_candidate_types, $jobsearch_plugin_options;

$user_id = $user_company = '';
if (is_user_logged_in()) {
    $user_id = get_current_user_id();
    $user_company = get_user_meta($user_id, 'jobsearch_company', true);
}

$cand_profile_restrict = new Candidate_Profile_Restriction;
$locations_view_type = isset($atts['candidate_loc_listing']) ? $atts['candidate_loc_listing'] : '';

if (!is_array($locations_view_type)) {

    $loc_types_arr = $locations_view_type != '' ? explode(',', $locations_view_type) : '';
} else {
    $loc_types_arr = $locations_view_type;
}
$loc_view_country = $loc_view_state = $loc_view_city = false;
if (!empty($loc_types_arr)) {
    if (is_array($loc_types_arr) && in_array('country', $loc_types_arr)) {
        $loc_view_country = true;
    }
    if (is_array($loc_types_arr) && in_array('state', $loc_types_arr)) {
        $loc_view_state = true;
    }
    if (is_array($loc_types_arr) && in_array('city', $loc_types_arr)) {
        $loc_view_city = true;
    }
}
$all_location_allow = isset($jobsearch_plugin_options['all_location_allow']) ? $jobsearch_plugin_options['all_location_allow'] : '';
$default_candidate_no_custom_fields = isset($jobsearch_plugin_options['jobsearch_candidate_no_custom_fields']) ? $jobsearch_plugin_options['jobsearch_candidate_no_custom_fields'] : '';
if (false === ($candidate_view = jobsearch_get_transient_obj('jobsearch_candidate_view' . $candidate_short_counter))) {
    $candidate_view = isset($atts['candidate_view']) ? $atts['candidate_view'] : '';
}
$candidates_excerpt_length = isset($atts['candidates_excerpt_length']) ? $atts['candidates_excerpt_length'] : '18';
$jobsearch_split_map_title_limit = '10';

$candidate_no_custom_fields = isset($atts['candidate_no_custom_fields']) ? $atts['candidate_no_custom_fields'] : $default_candidate_no_custom_fields;
if ($candidate_no_custom_fields == '' || !is_numeric($candidate_no_custom_fields)) {
    $candidate_no_custom_fields = 3;
}
$candidate_filters = isset($atts['candidate_filters']) ? $atts['candidate_filters'] : '';

$jobsearch_candidates_title_limit = isset($atts['candidates_title_limit']) ? $atts['candidates_title_limit'] : '5';
// start ads script
$candidate_ads_switch = isset($atts['candidate_ads_switch']) ? $atts['candidate_ads_switch'] : 'no';
if ($candidate_ads_switch == 'yes') {
    $candidate_ads_after_list_series = isset($atts['candidate_ads_after_list_count']) ? $atts['candidate_ads_after_list_count'] : '5';
    if ($candidate_ads_after_list_series != '') {
        $candidate_ads_list_array = explode(",", $candidate_ads_after_list_series);
    }
    $candidate_ads_after_list_array_count = sizeof($candidate_ads_list_array);
    $candidate_ads_after_list_flag = 0;
    $i = 0;
    $array_i = 0;
    $candidate_ads_after_list_array_final = '';
    while ($candidate_ads_after_list_array_count > $array_i) {
        if (isset($candidate_ads_list_array[$array_i]) && $candidate_ads_list_array[$array_i] != '') {
            $candidate_ads_after_list_array[$i] = $candidate_ads_list_array[$array_i];
            $i++;
        }
        $array_i++;
    }
    // new count
    $candidate_ads_after_list_array_count = sizeof($candidate_ads_after_list_array);
}

$candidates_ads_array = array();
if ($candidate_ads_switch == 'yes' && $candidate_ads_after_list_array_count > 0) {
    $list_count = 0;
    for ($i = 0; $i <= $candidate_loop_obj->found_posts; $i++) {
        if ($list_count == $candidate_ads_after_list_array[$candidate_ads_after_list_flag]) {
            $list_count = 1;
            $candidates_ads_array[] = $i;
            $candidate_ads_after_list_flag++;
            if ($candidate_ads_after_list_flag >= $candidate_ads_after_list_array_count) {
                $candidate_ads_after_list_flag = $candidate_ads_after_list_array_count - 1;
            }
        } else {
            $list_count++;
        }
    }
}
$paging_var = 'candidate_page';
$candidate_page = isset($_REQUEST[$paging_var]) && $_REQUEST[$paging_var] != '' ? $_REQUEST[$paging_var] : 1;
$candidate_per_page = isset($atts['candidate_per_page']) ? $atts['candidate_per_page'] : '-1';
$candidate_per_page = isset($_REQUEST['per-page']) ? $_REQUEST['per-page'] : $candidate_per_page;
$counter = 1;
if ($candidate_page >= 2) {
    $counter = (
            ($candidate_page - 1) *
            $candidate_per_page) +
        1;
}
// end ads script
$sectors_enable_switch = isset($jobsearch_plugin_options['sectors_onoff_switch']) ? $jobsearch_plugin_options['sectors_onoff_switch'] : '';
$columns_class = 'jobsearch-column-12';
$http_request = jobsearch_server_protocol();

?>


<div class="jobsearch-candidate jobsearch-candidate-default"
     id="jobsearch-candidate-<?php echo absint($candidate_short_counter) ?>">

    <ul class="jobsearch-row">
        <?php
        if ($candidate_loop_obj->have_posts()) {
            $flag_number = 1;

            while ($candidate_loop_obj->have_posts()) : $candidate_loop_obj->the_post();
                global $post, $jobsearch_member_profile;

                $candidate_id = $post;

                $post_thumbnail_src = jobsearch_candidate_img_url_comn($candidate_id);

                $jobsearch_candidate_approved = get_post_meta($candidate_id, 'jobsearch_field_candidate_approved', true);
                $get_candidate_location = get_post_meta($candidate_id, 'jobsearch_field_location_address', true);
                if (function_exists('jobsearch_post_city_contry_txtstr')) {
                    $get_candidate_location = jobsearch_post_city_contry_txtstr($candidate_id, $loc_view_country, $loc_view_state, $loc_view_city);
                }
                $jobsearch_candidate_jobtitle = get_post_meta($candidate_id, 'jobsearch_field_candidate_jobtitle', true);
                $jobsearch_candidate_company_name = get_post_meta($candidate_id, 'jobsearch_field_candidate_company_name', true);
                $jobsearch_candidate_company_url = get_post_meta($candidate_id, 'jobsearch_field_candidate_company_url', true);
                $candidate_company_str = '';
                if ($jobsearch_candidate_jobtitle != '') {
                    $candidate_company_str .= $jobsearch_candidate_jobtitle;
                }
                $sector_str = jobsearch_candidate_get_all_sectors($candidate_id, '', '', '', '<li><i class="jobsearch-icon jobsearch-filter-tool-black-shape"></i>', '</li>');

                $final_color = '';
                $candidate_skills = isset($jobsearch_plugin_options['jobsearch_candidate_skills']) ? $jobsearch_plugin_options['jobsearch_candidate_skills'] : '';
                if ($candidate_skills == 'on') {

                    $low_skills_clr = isset($jobsearch_plugin_options['skill_low_set_color']) && $jobsearch_plugin_options['skill_low_set_color'] != '' ? $jobsearch_plugin_options['skill_low_set_color'] : '';
                    $med_skills_clr = isset($jobsearch_plugin_options['skill_med_set_color']) && $jobsearch_plugin_options['skill_med_set_color'] != '' ? $jobsearch_plugin_options['skill_med_set_color'] : '';
                    $high_skills_clr = isset($jobsearch_plugin_options['skill_high_set_color']) && $jobsearch_plugin_options['skill_high_set_color'] != '' ? $jobsearch_plugin_options['skill_high_set_color'] : '';
                    $comp_skills_clr = isset($jobsearch_plugin_options['skill_ahigh_set_color']) && $jobsearch_plugin_options['skill_ahigh_set_color'] != '' ? $jobsearch_plugin_options['skill_ahigh_set_color'] : '';

                    $overall_candidate_skills = get_post_meta($candidate_id, 'overall_skills_percentage', true);
                    if ($overall_candidate_skills <= 25 && $low_skills_clr != '') {
                        $final_color = 'style="color: ' . $low_skills_clr . ';"';
                    } else if ($overall_candidate_skills > 25 && $overall_candidate_skills <= 50 && $med_skills_clr != '') {
                        $final_color = 'style="color: ' . $med_skills_clr . ';"';
                    } else if ($overall_candidate_skills > 50 && $overall_candidate_skills <= 75 && $high_skills_clr != '') {
                        $final_color = 'style="color: ' . $high_skills_clr . ';"';
                    } else if ($overall_candidate_skills > 75 && $comp_skills_clr != '') {
                        $final_color = 'style="color: ' . $comp_skills_clr . ';"';
                    }
                }

                ?>

                <li class="<?php echo esc_html($columns_class); ?>">
                    <div class="jobsearch-candidate-default-wrap">
                        <?php echo jobsearch_member_promote_profile_iconlab($candidate_id) ?>
                        <?php echo jobsearch_cand_urgent_pkg_iconlab($candidate_id, 'cand_listv1') ?>
                        <?php
                        if (!$cand_profile_restrict::cand_field_is_locked('profile_fields|profile_img')) {

                            if ($post_thumbnail_src != '') { ?>
                                <figure>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo ($post_thumbnail_src) ?>" alt="">
                                    </a>
                                </figure>
                                <?php
                            }
                        }
                        ?>
                        <div class="jobsearch-candidate-default-text">
                            <div class="jobsearch-candidate-default-left">
                                <h2 class="jobsearch-pst-title">
                                    <a href="<?php echo esc_url(get_permalink($candidate_id)); ?>">
                                        <?php echo apply_filters('jobsearch_candidate_listing_item_title', wp_trim_words(get_the_title($candidate_id), $jobsearch_split_map_title_limit), $candidate_id); ?>
                                    </a>
                                    <i class="jobsearch-icon jobsearch-check-mark" <?php echo($final_color) ?>></i>
                                </h2>
                                <ul>
                                    <?php
                                    if (!$cand_profile_restrict::cand_field_is_locked('profile_fields|job_title')) {
                                        if ($candidate_company_str != '') {
                                            ?>
                                            <li><?php echo force_balance_tags($candidate_company_str); ?></li>
                                            <?php
                                        }
                                    }
                                    if (!$cand_profile_restrict::cand_field_is_locked('address_defields')) {
                                        if (!empty($get_candidate_location) && $all_location_allow == 'on') {
                                            ?>
                                            <li>
                                                <i class="fa fa-map-marker"></i> <?php echo esc_html($get_candidate_location); ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                    if (!$cand_profile_restrict::cand_field_is_locked('profile_fields|sector')) {
                                        if ($sector_str != '' && $sectors_enable_switch == 'on') {

                                            echo force_balance_tags($sector_str);

                                        }
                                    }
                                    echo apply_filters('jobsearch_incand_listin_after_secli', '', $candidate_id);
                                    ?>

                                </ul>
                                <br />
                                <ul>
                                  <!-- カスタムフィールド -->
                                  <?php
                                  $cus_fields = array('content' => '');
                                  $cus_fields = apply_filters('jobsearch_custom_fields_list', 'candidate', $candidate_id, $cus_fields, '<li style="white-space: nowrap;">', '</li>');
                                  if (isset($cus_fields['content']) && $cus_fields['content'] != '') {
                                      echo($cus_fields['content']);
                                  }
                                  ?>
                                  <!-- カスタムフィールド ここまで -->
                                </ul>
<!-- カスタムフィールド用CSS -->
<style type="text/css">
.jobsearch-candidate-default-text ul li {
  font-size: 16px;
  padding: 0px 30px;
  border-left: 0px solid #e0e0e0;
  color: #333333;
}
.jobsearch-services-text small{
  font-size: 16px;
  color: #333333;
}
</style>
<!-- カスタムフィールド用CSS ここまで -->

                            </div>
                            <?php do_action('jobsearch_add_employer_resume_to_list_btn', array('id' => $candidate_id)); ?>
                            <?php do_action('jobsearch_candlist_after_saversm_btn', array('id' => $candidate_id)); ?>
                        </div>
                    </div>
                </li>
                <?php

                do_action('jobsearch_random_ad_banners', $atts, $candidate_loop_obj, $counter, 'candidate_listing');


                $counter++;
                $flag_number++; // number variable for candidate
            endwhile;
        } else {
            echo '
            <li class="' . esc_html($columns_class) . '">
                <div class="no-candidate-match-error">
                    <a href="' . esc_url($page_url) . '">' . esc_html__('Reset Filters', 'wp-jobsearch') . '</a>
                </div>
            </li>';
        }
        ?>
    </ul>
</div>
<?php
