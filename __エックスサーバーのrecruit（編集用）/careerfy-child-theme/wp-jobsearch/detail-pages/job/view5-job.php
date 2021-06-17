<?php
wp_enqueue_style('careerfy-job-detail-five');
wp_enqueue_script('careerfy-countdown');
wp_enqueue_script('jobsearch-addthis');
global $post, $jobsearch_plugin_options;
$job_id = $post->ID;

$job_employer_id = get_post_meta($post->ID, 'jobsearch_field_job_posted_by', true); // get job employer
wp_enqueue_script('jobsearch-job-functions-script');
$employer_cover_image_src_style_str = '';
if ($job_employer_id != '') {
    if (class_exists('JobSearchMultiPostThumbnails')) {
        $employer_cover_image_src = JobSearchMultiPostThumbnails::get_post_thumbnail_url('employer', 'cover-image', $job_employer_id);
        if ($employer_cover_image_src != '') {
            $employer_cover_image_src_style_str = ' style="background:url(' . esc_url($employer_cover_image_src) . ') no-repeat center/cover"';
        }
    }
}

if ($employer_cover_image_src_style_str == '') {
    $emp_def_cvrimg = isset($jobsearch_plugin_options['emp_default_coverimg']['url']) && $jobsearch_plugin_options['emp_default_coverimg']['url'] != '' ? $jobsearch_plugin_options['emp_default_coverimg']['url'] : '';
    $employer_cover_image_src_style_str = ' style="background:url(' . esc_url($emp_def_cvrimg) . ') no-repeat center/cover;"';
}

$all_location_allow = isset($jobsearch_plugin_options['all_location_allow']) ? $jobsearch_plugin_options['all_location_allow'] : '';
$job_views_publish_date = isset($jobsearch_plugin_options['job_views_publish_date']) ? $jobsearch_plugin_options['job_views_publish_date'] : '';


$job_det_full_address_switch = true;

$locations_view_type = isset($jobsearch_plugin_options['job_det_loc_listing']) ? $jobsearch_plugin_options['job_det_loc_listing'] : '';

$loc_view_country = $loc_view_state = $loc_view_city = false;
if (!empty($locations_view_type)) {
    if (is_array($locations_view_type) && in_array('country', $locations_view_type)) {
        $loc_view_country = true;

    }
    if (is_array($locations_view_type) && in_array('state', $locations_view_type)) {
        $loc_view_state = true;
    }
    if (is_array($locations_view_type) && in_array('city', $locations_view_type)) {
        $loc_view_city = true;
    }
}
//
$social_share_allow = isset($jobsearch_plugin_options['job_detail_soc_share']) ? $jobsearch_plugin_options['job_detail_soc_share'] : '';

$job_apps_count_switch = isset($jobsearch_plugin_options['job_detail_apps_count']) ? $jobsearch_plugin_options['job_detail_apps_count'] : '';
$job_views_count_switch = isset($jobsearch_plugin_options['job_detail_views_count']) ? $jobsearch_plugin_options['job_detail_views_count'] : '';
$job_shortlistbtn_switch = isset($jobsearch_plugin_options['job_detail_shrtlist_btn']) ? $jobsearch_plugin_options['job_detail_shrtlist_btn'] : '';

$sectors = wp_get_post_terms($job_id, 'sector');
ob_start();
$html = '';
$page_id = isset($jobsearch_plugin_options['jobsearch_search_list_page']) ? $jobsearch_plugin_options['jobsearch_search_list_page'] : '';
$page_id = jobsearch__get_post_id($page_id, 'page');
$page_id = jobsearch_wpml_lang_page_id($page_id, 'page');
$result_page = get_permalink($page_id);
$subheader_employer_bg_color = isset($jobsearch_plugin_options['careerfy-emp-img-overlay-bg-color']) ? $jobsearch_plugin_options['careerfy-emp-img-overlay-bg-color'] : '';
if (isset($subheader_employer_bg_color['rgba'])) {
    $subheader_bg_color = $subheader_employer_bg_color['rgba'];
}

if (!empty($sectors)) {

    $link_class_str = 'careerfy-right';
    foreach ($sectors as $term) :
        ?>
        <a href="<?php echo add_query_arg(array('sector_cat' => $term->slug), $result_page); ?>"
           class="<?php echo($link_class_str) ?>">
            <?php
            echo sprintf(esc_html__('see more %s jobs', 'careerfy'), $term->name);
            ?>
            <i class="jobsearch-icon jobsearch-arrows22"></i>
        </a>
    <?php
    endforeach;
}
$html .= ob_get_clean();
$sector_str = jobsearch_job_get_all_sectors($job_id, '', '  ', '', '<li>', '</li>');
?>
    <!-- SubHeader -->

    <!-- SubHeader -->


    <!-- Main Content -->
    <div class="careerfy-main-content">

        <!-- Main Section -->
        <div class="careerfy-main-section">
            <div class="container">
                <div class="row">
                    <?php
                    while (have_posts()) : the_post();
                        $post_id = $post->ID;
                        $rand_num = rand(1000000, 99999999);
                        $post_thumbnail_id = jobsearch_job_get_profile_image($post_id);
                        $post_thumbnail_image = wp_get_attachment_image_src($post_thumbnail_id, 'jobsearch-job-medium');
                        $post_thumbnail_src = isset($post_thumbnail_image[0]) && esc_url($post_thumbnail_image[0]) != '' ? $post_thumbnail_image[0] : '';
                        $post_thumbnail_src = $post_thumbnail_src == '' ? jobsearch_no_image_placeholder() : $post_thumbnail_src;
                        $post_thumbnail_src = apply_filters('jobsearch_jobemp_image_src', $post_thumbnail_src, $job_id);
                        $application_deadline = get_post_meta($post_id, 'jobsearch_field_job_application_deadline_date', true);
                        $jobsearch_job_posted = get_post_meta($post_id, 'jobsearch_field_job_publish_date', true);
                        $jobsearch_job_posted_ago = jobsearch_time_elapsed_string($jobsearch_job_posted, ' ' . esc_html__('Posted', 'careerfy') . ' ');


                        $postby_emp_id = get_post_meta($job_id, 'jobsearch_field_job_posted_by', true);

                        $jobsearch_job_posted_formated = '';
                        if ($jobsearch_job_posted != '') {
                            $jobsearch_job_posted_formated = date_i18n(get_option('date_format'), ($jobsearch_job_posted));
                        }
                        $get_job_location = get_post_meta($post_id, 'jobsearch_field_location_address', true);
                        $job_city_title = '';
                        if (function_exists('jobsearch_post_city_contry_txtstr')) {
                            $job_city_title = jobsearch_post_city_contry_txtstr($post_id, $loc_view_country, $loc_view_state, $loc_view_city, $job_det_full_address_switch);
                        }
                        if ($job_city_title != '') {
                            $get_job_location = $job_city_title;
                        }
                        $job_apply_type = get_post_meta($post_id, 'jobsearch_field_job_apply_type', true);
                        $sectors_enable_switch = isset($jobsearch_plugin_options['sectors_onoff_switch']) ? $jobsearch_plugin_options['sectors_onoff_switch'] : '';
                        $job_date = get_post_meta($post_id, 'jobsearch_field_job_date', true);
                        $job_views_count = get_post_meta($post_id, 'jobsearch_job_views_count', true);
                        $job_type_str = jobsearch_job_get_all_jobtypes($post_id, 'careerfy-jobdetail-search-style5-jobtype', '', '', '', '', 'span');
                        $sector_str = jobsearch_job_get_all_sectors($post_id, '', ' ' . esc_html__('in', 'careerfy') . ' ', '', '<small class="post-in-category">', '</small>');
                        $company_name = jobsearch_job_get_company_name($post_id, '');
                        $skills_list = jobsearch_job_get_all_skills($post_id);
                        $job_obj = get_post($post_id);
                        $job_content = isset($job_obj->post_content) ? $job_obj->post_content : '';
                        $jobsearch_job_min_salary = get_post_meta($post_id, 'jobsearch_field_job_salary', true);
                        $jobsearch_job_max_salary = get_post_meta($post_id, 'jobsearch_field_job_max_salary', true);
                        $job_content = apply_filters('the_content', $job_content);
                        $job_salary = jobsearch_job_offered_salary($post_id);
                        $_job_salary_type = get_post_meta($post_id, 'jobsearch_field_job_salary_type', true);

                        $salary_type = '';
                        if ($_job_salary_type == 'type_1') {
                            $salary_type = 'Monthly';
                        } else if ($_job_salary_type == 'type_2') {
                            $salary_type = 'Weekly';
                        } else if ($_job_salary_type == 'type_3') {
                            $salary_type = 'Hourly';
                        } else {
                            $salary_type = 'Negotiable';
                        }

                        $job_applicants_list = get_post_meta($post_id, 'jobsearch_job_applicants_list', true);
                        $job_applicants_list = jobsearch_is_post_ids_array($job_applicants_list, 'candidate');
                        if (empty($job_applicants_list)) {
                            $job_applicants_list = array();
                        }
                        $job_applicants_count = !empty($job_applicants_list) ? count($job_applicants_list) : 0;
                        ?>
                        <!-- Job Detail Content -->
<!--
                        <div class="careerfy-column-12">
                            <div class="careerfy-jobdetail-search-style5">
                                <a href="javascript:history.back(1);" class="careerfy-jobdetail-back-btn"><i
                                            class="fa fa-search"></i> <?php echo esc_html__('Back to Search Result', 'careerfy'); ?>
                                </a>
                                <div class="careerfy-jobdetail-style5-btns">
                                    <a href="#"><i
                                                class="careerfy-icon careerfy-arrow-right-light"></i> <?php echo esc_html__("Previous Job", "careerfy") ?>
                                    </a>
                                    <a href="#"><?php echo esc_html__("Next Job", "careerfy") ?> <i
                                                class="careerfy-icon careerfy-arrow-right-light"></i></a>
                                </div>
                            </div>
                        </div>
-->
                        <div class="careerfy-column-8">
                            <div class="careerfy-typo-wrap">

                                <div class="careerfy-jobdetail-style5-content">
<!--
                                    <div class="careerfy-jobdetail-style5-image">
                                        <?php if ($post_thumbnail_src != '') { ?>
                                            <span><img src="<?php echo esc_url($post_thumbnail_src) ?>" alt=""></span>
                                        <?php } ?>
                                    </div>
-->

<div class="careerfy-column-12">

<div class="careerfy-jobdetail-style5-content-list">

  <?php if(get_post_meta($post->ID, 'cfimg',true)):?>
  <div class="cfimg sp">
  <img src="<?php the_field('cfimg'); ?>" />
  </div>
  <?php endif; ?>

<ul>
  <li>
    <span class="shigotono">仕事№：<?php the_field('cf00'); ?></span>
  </li>
  <?php if(get_post_meta($post->ID, 'cf00',true)):?>
  <li>
    <?php if ($job_type_str != '') { ?><?php echo force_balance_tags($job_type_str); ?><?php } ?>
  </li>
  <?php endif; ?>
</ul>

<h2><?php echo force_balance_tags(get_the_title()); ?></h2>

<?php if(get_post_meta($post->ID, 'cf01_1',true)):?>
<h4><?php the_field('cf01_1'); ?></h4>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf01',true)):?>
<p><?php the_field('cf01'); ?></p>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf02',true)):?>
<p class="floatoff"><?php the_field('cf02'); ?></p>
<?php endif; ?>

</div>


                                        <?php
                                        if ($social_share_allow == 'on') {
                                            wp_enqueue_script('jobsearch-addthis'); ?>
                                            <div class="jobsearch-jobdetail-media-style5">
                                                <a href="javascript:void(0);" data-original-title="facebook" class="careerfy-icon careerfy-facebook addthis_button_facebook"></a>
                                                <a href="javascript:void(0);" data-original-title="twitter" class="careerfy-icon careerfy-twitter addthis_button_twitter"></a>
                                                <a href="javascript:void(0);" data-original-title="linkedin" class="careerfy-icon careerfy-linkedin  addthis_button_linkedin"></a>
                                                <a href="javascript:void(0);" data-original-title="share_more" class="careerfy-icon careerfy-plus-fill-circle  addthis_button_compact"></a>
                                            </div>
                                            <?php
                                        }

                                        if ($job_shortlistbtn_switch == 'on') {
                                            // wrap in this this due to enquire arrange button style.
                                            $before_label = esc_html__('Shortlist', 'careerfy');
                                            $after_label = esc_html__('Shortlisted', 'careerfy');
                                            $book_mark_args = array(
                                                'before_label' => $before_label,
                                                'after_label' => $after_label,
                                                'before_icon' => 'careerfy-icon careerfy-add-list',
                                                'after_icon' => 'careerfy-icon careerfy-add-list',
                                                'anchor_class' => 'careerfy-jobdetail-btn-style5 active',
                                                'view' => 'job_detail_5',
                                                'job_id' => $job_id,
                                            );
                                            do_action('jobsearch_job_shortlist_button_frontend', $book_mark_args);
                                        }

                                        $popup_args = array(
                                            'job_id' => $job_id,
                                            'btn_class' => 'careerfy-jobdetail-style5-email',
                                        );
                                        do_action('jobsearch_job_send_to_email_filter', $popup_args);

                                        ?>
                                    </div>
                                </div>


                                <div class="careerfy-jobdetail-content careerfy-jobdetail-content-style5">
<!--
                                    <?php
                                    ob_start();
                                    $cus_fields = array('content' => '');
                                    $cus_fields = apply_filters('jobsearch_custom_fields_list', 'job', $post_id, $cus_fields, '<li class="careerfy-column-6">', '</li>', '', true, true, true, 'careerfy');
                                    if (isset($cus_fields['content']) && $cus_fields['content'] != '') {
                                        ?>
                                        <div class="careerfy-content-title-style5">
                                            <h2><?php echo esc_html__('Job Detail', 'careerfy') ?></h2></div>
                                        <div class="careerfy-jobdetail-services-style5">
                                            <ul class="careerfy-row">
                                                <?php
                                                // All custom fields with value
                                                echo force_balance_tags($cus_fields['content']);
                                                ?>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    $job_fields_output = ob_get_clean();
                                    echo apply_filters('jobsearch_job_detail_content_fields', $job_fields_output, $job_id);

                                    $ad_args = array(
                                        'post_type' => 'job',
                                        'view' => 'view2',
                                        'position' => 'b4_desc',
                                    );
                                    jobsearch_detail_common_ad_code($ad_args);

                                    if ($job_content != '') {
                                        ob_start();
                                        ?>
                                        <div class="careerfy-content-title">
                                            <h2><?php echo esc_html__('Job Description', 'careerfy') ?></h2></div>
                                        <div class="jobsearch-description">
                                            <?php
                                            echo force_balance_tags($job_content);
                                            ?>
                                        </div>
                                        <?php
                                        $job_det_output = ob_get_clean();
                                        echo apply_filters('jobsearch_job_detail_content_detail', $job_det_output, $job_id);
                                    }
                                    echo apply_filters('jobsearch_job_defdetail_after_detcont_html', '', $job_id, 'filter', 'view1');

                                    $ad_args = array(
                                        'post_type' => 'job',
                                        'view' => 'view2',
                                        'position' => 'aftr_desc',
                                    );
                                    jobsearch_detail_common_ad_code($ad_args);

                                    $job_attachments_switch = isset($jobsearch_plugin_options['job_attachments']) ? $jobsearch_plugin_options['job_attachments'] : '';

                                    if ($job_attachments_switch == 'on') {
                                        $all_attach_files = get_post_meta($job_id, 'jobsearch_field_job_attachment_files', true);
                                        if (!empty($all_attach_files)) {
                                            ?>
                                            <div class="jobsearch-content-title">
                                                <h2><?php esc_html_e('Attached Files', 'careerfy') ?></h2></div>
                                            <div class="jobsearch-file-attach-sec">
                                                <ul class="jobsearch-row">
                                                    <?php
                                                    foreach ($all_attach_files as $_attach_file) {
                                                        $_attach_id = jobsearch_get_attachment_id_from_url($_attach_file);
                                                        $_attach_post = get_post($_attach_id);
                                                        $_attach_mime = isset($_attach_post->post_mime_type) ? $_attach_post->post_mime_type : '';
                                                        $_attach_guide = isset($_attach_post->guid) ? $_attach_post->guid : '';
                                                        $attach_name = basename($_attach_guide);

                                                        $file_icon = 'fa fa-file-text-o';
                                                        if ($_attach_mime == 'image/png' || $_attach_mime == 'image/jpeg') {
                                                            $file_icon = 'fa fa-file-image-o';
                                                        } else if ($_attach_mime == 'application/msword' || $_attach_mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                                                            $file_icon = 'fa fa-file-word-o';
                                                        } else if ($_attach_mime == 'application/vnd.ms-excel' || $_attach_mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                                                            $file_icon = 'fa fa-file-excel-o';
                                                        } else if ($_attach_mime == 'application/pdf') {
                                                            $file_icon = 'fa fa-file-pdf-o';
                                                        }
                                                        ?>
                                                        <li class="jobsearch-column-4">
                                                            <div class="file-container">
                                                                <a href="<?php echo($_attach_file) ?>"
                                                                   download="<?php echo($attach_name) ?>"
                                                                   class="file-download-icon"><i
                                                                            class="<?php echo($file_icon) ?>"></i> <?php echo($attach_name) ?>
                                                                </a>
                                                                <a href="<?php echo($_attach_file) ?>"
                                                                   download="<?php echo($attach_name) ?>"
                                                                   class="file-download-btn"><?php esc_html_e('Download', 'careerfy') ?>
                                                                    <i class="jobsearch-icon jobsearch-download-arrow"></i></a>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="careerfy-content-title">
                                        <h2><?php echo esc_html__('Required skills', 'careerfy') ?></h2></div>
                                    <div class="careerfy-jobdetail-tags">
                                        <?php echo force_balance_tags($skills_list); ?>
                                    </div>
-->

<!-- コンテンツ -->
<?php
$job_feas = get_field('job_fea');
if ($job_feas):
?>
<ul>
    <?php
    foreach ($job_feas as $job_fea) : ?>
        <li class="job_fea_detail"><span class="job_detail_label"><?php echo $job_fea; ?></span></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>


<table class="tbl01">
<tr>
  <th>職種</th>
  <td>
    <?php echo force_balance_tags(get_the_title()); ?>
  </td>
</tr>
<?php if(get_post_meta($post->ID, 'cf08',true)):?>
<tr>
  <th>仕事内容</th>
	<td>
		<?php the_field('cf08'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf03',true)):?>
<tr>
  <th>勤務地</th>
	<td>
		<?php the_field('cf03'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf05_1',true)):?>
<tr>
  <th>最寄り駅</th>
	<td>
		<?php the_field('cf05_1'); ?>
		<?php if(get_post_meta($post->ID, 'cf05_2',true)):?><br /><?php the_field('cf05_2'); ?><?php endif; ?>
		<?php if(get_post_meta($post->ID, 'cf05_3',true)):?><br /><?php the_field('cf05_3'); ?><?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf07',true)):?>
<tr>
  <th>給与</th>
	<td>
		年収
		<?php $cf07 = get_field('cf07');if($cf07){ ?>
			<?php echo number_format($cf07); ?>
		<?php } ?>円〜
		<?php if(get_post_meta($post->ID, 'cf07_1',true)):?><br /><br />【給与備考】<br /><?php the_field('cf07_1'); ?><?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf09_1',true)):?>
<tr>
  <th>勤務時間</th>
	<td>
		<?php the_field('cf09_1'); ?>
		<?php if(get_post_meta($post->ID, 'cf09_0',true)):?><br /><br />【勤務時間備考】<br /><?php the_field('cf09_0'); ?><?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf10',true)):?>
<tr>
  <th>休憩時間</th>
	<td>
		<?php the_field('cf10'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf11_2',true)):?>
<tr>
  <th>休日</th>
	<td>
		<?php the_field('cf11_2'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf701',true)):?>
<tr>
  <th>交通費</th>
	<td>
		<?php the_field('cf701'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf91',true)):?>
<tr>
  <th>転勤</th>
	<td>
		<?php the_field('cf91'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf15',true)):?>
<tr>
  <th>待遇・福利厚生</th>
	<td>
		<?php the_field('cf15'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf90',true)):?>
<tr>
  <th>部署の規模・所属人数</th>
	<td>
		<?php the_field('cf90'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf13',true)):?>
<tr>
  <th>経験など</th>
	<td>
		<?php the_field('cf13'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf13_1',true)):?>
<tr>
  <th>研修</th>
	<td>
		<?php the_field('cf13_1'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf12',true)):?>
<tr>
  <th>備考</th>
	<td>
		<?php the_field('cf12'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'job_kod',true)):?>
<tr>
  <th>特徴</th>
	<td>
    <?php
    $job_kods = get_field('job_kod');
    if ($job_kods):
    ?>
    <ul class="job_detail_job_kod_ul">
        <?php
        foreach ($job_kods as $job_kod) : ?>
            <li class="job_fea_detail"><?php echo $job_kod; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf20',true)):?>
<tr>
  <th>管轄支店</th>
	<td>
		<?php the_field('cf20'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf80',true)):?>
<tr>
  <th>問い合わせ電話番号</th>
	<td>
		<?php the_field('cf80'); ?>
  </td>
</tr>
<?php endif; ?>

<?php if(get_post_meta($post->ID, 'cf81',true)):?>
<tr>
  <th>問い合わせ電話番号</th>
	<td>
		<?php the_field('cf81'); ?>
  </td>
</tr>
<?php endif; ?>

</table>


<!-- //コンテンツ -->


                                </div>
                            </div>
                        </div>
                        <!-- Job Detail SideBar -->
                        <aside class="careerfy-column-4 pc">
                            <div class="careerfy-typo-wrap">
                                <div class="jobsearch_side_box_style5">

<?php if(get_post_meta($post->ID, 'cfimg',true)):?>
<div class="cfimg">
<img src="<?php the_field('cfimg'); ?>" />
</div>
<?php endif; ?>

                                    <?php ob_start(); ?>
                                    <div class="jobsearch_apply_job_style5">
                                        <?php

                                        ob_start();
                                        echo jobsearch_job_det_applybtn_acthtml('', $job_id, 'page', 'view5');
                                        $apply_bbox = ob_get_clean();
                                        echo apply_filters('jobsearch_job_defdet_applybtn_boxhtml', $apply_bbox, $job_id);
                                        $popup_args = array(
                                            'job_employer_id' => $job_employer_id,
                                            'job_id' => $job_id,
                                            'view' => 'job-detail-style5',
                                            'btn_class' => 'jobsearch-sendmessage-popup-btn-style5'
                                        );
                                        $popup_html = apply_filters('jobsearch_job_send_message_html_filter', '', $popup_args);
                                        echo force_balance_tags($popup_html);
                                        ?>
                                    </div>

                                    <?php
                                    $sidebar_apply_output = ob_get_clean();
                                    echo apply_filters('jobsearch_job_detail_sidebar_apply_btns', $sidebar_apply_output, $job_id);
                                    ?>

                                </div>
                            </div>
                        </aside>

<!-- 追加 -->
                        <div class="careerfy-column-4 re_search__width related__width">
                        <div class="jobsearch_apply_job_style5">
                        <a href="<?php echo esc_url( home_url( '/job-list/' ) ); ?>" class="jobsearch-sendmessage-popup-btn-style5">別の条件で検索</a>
                        </div>
                        </div>

                        <div class="careerfy-column-4 related__width">
                            <?php
                            $related_job_html = jobsearch_job_related_post($post_id, esc_html__('Related Jobs', 'careerfy'), 3, 5, '', 'view1');
                            echo $related_job_html;
                            ?>
                        </div>
<!-- //追加 -->

                        <!-- Job Detail SideBar -->
                        <!-- Job Detail Content -->
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    <!-- Job Detail SideBar -->

<!--
                    <div class="careerfy-column-8">
                        <?php
                        $related_job_html = jobsearch_job_related_post($post_id, esc_html__('Related Jobs', 'careerfy'), 5, 5, '', 'view2');
                        echo $related_job_html;
                        ?>
                    </div>
-->
                    <!-- Job's Listing's -->
                </div>
            </div>
        </div>
        <!-- Main Section -->

    </div>
    <!-- Main Content -->
    <script>
        //for login popup
        jQuery(document).on('click', '.jobsearch-sendmessage-popup-btn', function () {
            jobsearch_modal_popup_open('JobSearchModalSendMessage');
        });
        jQuery(document).on('click', '.jobsearch-sendmessage-messsage-popup-btn', function () {
            jobsearch_modal_popup_open('JobSearchModalSendMessageWarning');
        });
        jQuery(document).on('click', '.jobsearch-applyjob-msg-popup-btn', function () {
            jobsearch_modal_popup_open('JobSearchModalApplyJobWarning');
        });



        <?php
        if ($dead_y != '' && $dead_m != '' && $dead_d != '') {
        $dead_time_h = date("H", $application_deadline);
        $dead_time_m = date("i", $application_deadline);
        $dead_time_s = date("s", $application_deadline);
        ?>
        jQuery(document).ready(function ($) {
            if (jQuery('#widget-application-countdown').length > 0) {
                var austDay = new Date(<?php echo $dead_y; ?>, <?php echo $dead_m; ?> -1, <?php echo $dead_d; ?>, <?php echo $dead_time_h; ?>, <?php echo $dead_time_m; ?>, <?php echo $dead_time_s; ?>);
                jQuery('#widget-application-countdown').countdown({
                    until: austDay,
                    layout: '<span class="countdown-row countdown-show4">{y<}<span class="countdown-section"><span class="countdown-amount">{yn}</span> <span class="countdown-period">{yl}</span></span>{y>}{o<}<span class="countdown-section"><span class="countdown-amount">{on}</span> <span class="countdown-period">{ol}</span></span>{o>}' +
                        '{d<}<span class="countdown-section"><span class="countdown-amount">{dn}</span> <span class="countdown-period"><?php echo esc_html_e('Days', 'careerfy') ?></span></span>{d>}{h<}<span class="countdown-section"><span class="countdown-amount">{hn}</span> <span class="countdown-period"><?php echo esc_html_e('Hours', 'careerfy') ?></span></span>{h>}' +
                        '{m<}<span class="countdown-section"><span class="countdown-amount">{mn}</span> <span class="countdown-period"><?php echo esc_html_e('Minutes', 'careerfy') ?></span></span>{m>}{s<}<span class="countdown-section"><span class="countdown-amount">{sn}</span> <span class="countdown-period"><?php echo esc_html_e('Seconds', 'careerfy') ?></span></span>{s>}</span>'
                });
            }
        });
        <?php
        }
        ?>

    </script>
<?php
jobsearch_google_job_posting($job_id);
