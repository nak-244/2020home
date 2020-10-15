<?php
global $jobsearch_plugin_options, $Jobsearch_User_Dashboard_Settings;
$user_id = get_current_user_id();
$user_obj = get_user_by('ID', $user_id);

$page_id = $user_dashboard_page = isset($jobsearch_plugin_options['user-dashboard-template-page']) ? $jobsearch_plugin_options['user-dashboard-template-page'] : '';
$page_id = $user_dashboard_page = jobsearch__get_post_id($user_dashboard_page, 'page');
$page_url = jobsearch_wpml_lang_page_permalink($page_id, 'page'); //get_permalink($page_id);

$is_user_member = false;
if (jobsearch_user_isemp_member($user_id)) {
    $is_user_member = true;
    $employer_id = jobsearch_user_isemp_member($user_id);
    $user_id = jobsearch_get_employer_user_id($employer_id);
} else {
    $employer_id = jobsearch_get_user_employer_id($user_id);
}

$reults_per_page = isset($jobsearch_plugin_options['user-dashboard-per-page']) && $jobsearch_plugin_options['user-dashboard-per-page'] > 0 ? $jobsearch_plugin_options['user-dashboard-per-page'] : 10;

$page_num = isset($_GET['page_num']) ? $_GET['page_num'] : 1;

if ($employer_id > 0) {
    ?>
    <div class="jobsearch-employer-dasboard">
        <div class="jobsearch-employer-box-section">
            <?php
            ob_start();
            ?>
            <div class="jobsearch-profile-title">
                <h2><?php esc_html_e('Packages', 'wp-jobsearch') ?></h2>
            </div>
            <?php
            $hding_html = ob_get_clean();
            echo apply_filters('jobsearch_empdash_pckges_cont_mainhding_html', $hding_html);
            
            $args = array(
                'post_type' => 'shop_order',
                'posts_per_page' => $reults_per_page,
                'paged' => $page_num,
                'post_status' => 'wc-completed',
                'order' => 'DESC',
                'orderby' => 'ID',
                'meta_query' => apply_filters('jobsearch_emp_dash_pkgs_list_tab_mquery', array(
                    array(
                        'key' => 'jobsearch_order_attach_with',
                        'value' => 'package',
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'package_type',
                        'value' => apply_filters('jobsearch_emp_dash_pkg_types_in_query', array('job', 'featured_jobs', 'emp_allin_one', 'cv', 'promote_profile', 'urgent_pkg', 'employer_profile')),
                        'compare' => 'IN',
                    ),
                    array(
                        'key' => 'jobsearch_order_user',
                        'value' => $user_id,
                        'compare' => '=',
                    ),
                )),
            );
            
            $pkgs_query = new WP_Query($args);
            $total_pkgs = $pkgs_query->found_posts;
            if ($pkgs_query->have_posts()) {
                ob_start();
                ?>
                <div class="jobsearch-packages-list-holder">
                    <div class="jobsearch-employer-packages">
                        <div class="jobsearch-table-layer jobsearch-packages-thead">
                            <div class="jobsearch-table-row">
                                <div class="jobsearch-table-cell"><?php esc_html_e('Order ID', 'wp-jobsearch') ?></div>
                                <div class="jobsearch-table-cell"><?php esc_html_e('Package', 'wp-jobsearch') ?></div>
                                <div class="jobsearch-table-cell"><?php echo apply_filters('jobsearch_emp_dash_pkg_job_num_label', esc_html__('Total', 'wp-jobsearch')) ?></div>
                                <div class="jobsearch-table-cell"><?php esc_html_e('Used', 'wp-jobsearch') ?></div>
                                <div class="jobsearch-table-cell"><?php esc_html_e('Remaining', 'wp-jobsearch') ?></div>
                                <div class="jobsearch-table-cell"><?php esc_html_e('Package Expiry', 'wp-jobsearch') ?></div>
                                <div class="jobsearch-table-cell"><?php esc_html_e('Status', 'wp-jobsearch') ?></div>
                            </div>
                        </div>
                        <?php
                        while ($pkgs_query->have_posts()) : $pkgs_query->the_post();
                            $pkg_rand = rand(10000000, 99999999);
                            $pkg_order_id = get_the_ID();
                            $pkg_order_name = get_post_meta($pkg_order_id, 'package_name', true);

                            //
                            $pkg_type = get_post_meta($pkg_order_id, 'package_type', true);
                            
                            $unlimited_pkg = get_post_meta($pkg_order_id, 'unlimited_pkg', true);

                            if ($pkg_type == 'cv') {
                                $total_cvs = get_post_meta($pkg_order_id, 'num_of_cvs', true);
                                $unlimited_numcvs = get_post_meta($pkg_order_id, 'unlimited_numcvs', true);
                                if ($unlimited_numcvs == 'yes') {
                                    $total_cvs = esc_html__('Unlimited', 'wp-jobsearch');
                                }

                                $used_cvs = jobsearch_pckg_order_used_cvs($pkg_order_id);
                                $remaining_cvs = jobsearch_pckg_order_remaining_cvs($pkg_order_id);
                                if ($unlimited_numcvs == 'yes') {
                                    $used_cvs = '-';
                                    $remaining_cvs = '-';
                                }
                            } else if ($pkg_type == 'emp_allin_one') {
                                
                                $total_jobs = get_post_meta($pkg_order_id, 'allin_num_jobs', true);
                                $unlimited_numjobs = get_post_meta($pkg_order_id, 'unlimited_numjobs', true);
                                if ($unlimited_numjobs == 'yes') {
                                    $total_jobs = esc_html__('Unlimited', 'wp-jobsearch');
                                }
                                //
                                $total_fjobs = get_post_meta($pkg_order_id, 'allin_num_fjobs', true);
                                $unlimited_numfjobs = get_post_meta($pkg_order_id, 'unlimited_numfjobs', true);
                                if ($unlimited_numfjobs == 'yes') {
                                    $total_fjobs = esc_html__('Unlimited', 'wp-jobsearch');
                                }
                                //
                                $total_cvs = get_post_meta($pkg_order_id, 'allin_num_cvs', true);
                                $unlimited_numcvs = get_post_meta($pkg_order_id, 'unlimited_numcvs', true);
                                if ($unlimited_numcvs == 'yes') {
                                    $total_cvs = esc_html__('Unlimited', 'wp-jobsearch');
                                }

                                $job_exp_dur = get_post_meta($pkg_order_id, 'allinjob_expiry_time', true);
                                $job_exp_dur_unit = get_post_meta($pkg_order_id, 'allinjob_expiry_time_unit', true);

                                $used_jobs = jobsearch_allinpckg_order_used_jobs($pkg_order_id);
                                $remaining_jobs = jobsearch_allinpckg_order_remaining_jobs($pkg_order_id);
                                if ($unlimited_numjobs == 'yes') {
                                    $used_jobs = '-';
                                    $remaining_jobs = '-';
                                }
                                //
                                $used_fjobs = jobsearch_allinpckg_order_used_fjobs($pkg_order_id);
                                $remaining_fjobs = jobsearch_allinpckg_order_remaining_fjobs($pkg_order_id);
                                if ($unlimited_numfjobs == 'yes') {
                                    $used_fjobs = '-';
                                    $remaining_fjobs = '-';
                                }
                                //
                                $used_cvs = jobsearch_allinpckg_order_used_cvs($pkg_order_id);
                                $remaining_cvs = jobsearch_allinpckg_order_remaining_cvs($pkg_order_id);
                                if ($unlimited_numcvs == 'yes') {
                                    $used_cvs = '-';
                                    $remaining_cvs = '-';
                                }

                            } else if ($pkg_type == 'featured_jobs') {
                                $total_jobs = get_post_meta($pkg_order_id, 'num_of_fjobs', true);
                                
                                $unlimited_numfjobs = get_post_meta($pkg_order_id, 'unlimited_numfjobs', true);
                                if ($unlimited_numfjobs == 'yes') {
                                    $total_jobs = esc_html__('Unlimited', 'wp-jobsearch');
                                }

                                $job_exp_dur = get_post_meta($pkg_order_id, 'fjob_expiry_time', true);
                                $job_exp_dur_unit = get_post_meta($pkg_order_id, 'fjob_expiry_time_unit', true);

                                $used_jobs = jobsearch_pckg_order_used_fjobs($pkg_order_id);
                                $remaining_jobs = jobsearch_pckg_order_remaining_fjobs($pkg_order_id);
                                if ($unlimited_numfjobs == 'yes') {
                                    $used_jobs = '-';
                                    $remaining_jobs = '-';
                                }
                            } else {
                                $total_jobs = get_post_meta($pkg_order_id, 'num_of_jobs', true);
                                
                                $unlimited_numjobs = get_post_meta($pkg_order_id, 'unlimited_numjobs', true);
                                if ($unlimited_numjobs == 'yes') {
                                    $total_jobs = esc_html__('Unlimited', 'wp-jobsearch');
                                }
                                $total_jobs = apply_filters('jobsearch_emp_dash_pkg_total_jobs_count', $total_jobs, $pkg_order_id);

                                $job_exp_dur = get_post_meta($pkg_order_id, 'job_expiry_time', true);
                                $job_exp_dur_unit = get_post_meta($pkg_order_id, 'job_expiry_time_unit', true);

                                $used_jobs = jobsearch_pckg_order_used_jobs($pkg_order_id);
                                if ($unlimited_numjobs == 'yes') {
                                    $used_jobs = '-';
                                }
                                $used_jobs = apply_filters('jobsearch_emp_dash_pkg_used_jobs_count', $used_jobs, $pkg_order_id);
                                $remaining_jobs = jobsearch_pckg_order_remaining_jobs($pkg_order_id);
                                if ($unlimited_numjobs == 'yes') {
                                    $remaining_jobs = '-';
                                }
                                $remaining_jobs = apply_filters('jobsearch_emp_dash_pkg_remain_jobs_count', $remaining_jobs, $pkg_order_id);
                            }
                            $pkg_exp_dur = get_post_meta($pkg_order_id, 'package_expiry_time', true);
                            $pkg_exp_dur_unit = get_post_meta($pkg_order_id, 'package_expiry_time_unit', true);

                            $status_txt = esc_html__('Active', 'wp-jobsearch');
                            $status_class = '';
                            if ($pkg_type == 'cv') {
                                if (jobsearch_cv_pckg_order_is_expired($pkg_order_id)) {
                                    $status_txt = esc_html__('Expired', 'wp-jobsearch');
                                    $status_class = 'jobsearch-packages-pending';
                                }
                            } else if ($pkg_type == 'featured_jobs') {
                                if (jobsearch_fjobs_pckg_order_is_expired($pkg_order_id)) {
                                    $status_txt = esc_html__('Expired', 'wp-jobsearch');
                                    $status_class = 'jobsearch-packages-pending';
                                }
                            } else {
                                if (jobsearch_pckg_order_is_expired($pkg_order_id)) {
                                    $status_txt = esc_html__('Expired', 'wp-jobsearch');
                                    $status_class = 'jobsearch-packages-pending';
                                }
                                $status_txt = apply_filters('jobsearch_emp_dash_jobpkgs_list_status_txt', $status_txt, $pkg_order_id);
                                $status_class = apply_filters('jobsearch_emp_dash_jobpkgs_list_status_class', $status_class, $pkg_order_id);
                            }
                            if ($pkg_type == 'promote_profile') {
                                $status_txt = esc_html__('Active', 'wp-jobsearch');
                                $status_class = '';

                                if (jobsearch_promote_profile_pkg_is_expired($pkg_order_id)) {
                                    $status_txt = esc_html__('Expired', 'wp-jobsearch');
                                    $status_class = 'jobsearch-packages-pending';
                                }
                            }
                            if ($pkg_type == 'urgent_pkg') {
                                $status_txt = esc_html__('Active', 'wp-jobsearch');
                                $status_class = '';

                                if (jobsearch_member_urgent_pkg_is_expired($pkg_order_id)) {
                                    $status_txt = esc_html__('Expired', 'wp-jobsearch');
                                    $status_class = 'jobsearch-packages-pending';
                                }
                            }
                            if ($pkg_type == 'employer_profile') {
                                $status_txt = esc_html__('Active', 'wp-jobsearch');
                                $status_class = '';

                                if (jobsearch_emp_profile_pkg_is_expired($pkg_order_id)) {
                                    $status_txt = esc_html__('Expired', 'wp-jobsearch');
                                    $status_class = 'jobsearch-packages-pending';
                                }
                            }
                            ?>
                            <div class="jobsearch-table-layer jobsearch-packages-tbody">
                                <div class="jobsearch-table-row">
                                    <div class="jobsearch-table-cell">#<?php echo ($pkg_order_id) ?></div>
                                    <div class="jobsearch-table-cell">
                                        <?php
                                        ob_start();
                                        ?>
                                        <span><?php echo ($pkg_order_name) ?></span>
                                        <?php
                                        $pkg_name_html = ob_get_clean();
                                        echo apply_filters('jobsearch_emp_dashboard_pkgs_list_pkg_title', $pkg_name_html, $pkg_order_id);
                                        ?>
                                    </div>
                                    <?php
                                    if ($pkg_type == 'emp_allin_one') {
                                        $allin_jobs_pkgexpire = jobsearch_allinpckg_order_is_expired($pkg_order_id);
                                        $allin_fjobs_pkgexpire = jobsearch_allinpckg_order_is_expired($pkg_order_id, 'fjobs');
                                        $allin_cvs_pkgexpire = jobsearch_allinpckg_order_is_expired($pkg_order_id, 'cvs');
                                        
                                        $allin_jobs_pkgstats = esc_html__('Active', 'wp-jobsearch');
                                        $allin_fjobs_pkgstats = esc_html__('Active', 'wp-jobsearch');
                                        $allin_cvs_pkgstats = esc_html__('Active', 'wp-jobsearch');
                                        $allin_jobs_statsclas = 'pkg-active';
                                        $allin_fjobs_statsclas = 'pkg-active';
                                        $allin_cvs_statsclas = 'pkg-active';
                                        
                                        if ($allin_jobs_pkgexpire) {
                                            $allin_jobs_pkgstats = esc_html__('Expired', 'wp-jobsearch');
                                            $allin_jobs_statsclas = 'pkg-expire';
                                        }
                                        if ($allin_fjobs_pkgexpire) {
                                            $allin_fjobs_pkgstats = esc_html__('Expired', 'wp-jobsearch');
                                            $allin_fjobs_statsclas = 'pkg-expire';
                                        }
                                        if ($allin_cvs_pkgexpire) {
                                            $allin_cvs_pkgstats = esc_html__('Expired', 'wp-jobsearch');
                                            $allin_cvs_statsclas = 'pkg-expire';
                                        }
                                        
                                        $jobs_pkgsts_str = sprintf(__('Status: %s'), '<em class="' . $allin_jobs_statsclas . '">' . $allin_jobs_pkgstats . '</em>');
                                        $fjobs_pkgsts_str = sprintf(__('Status: %s'), '<em class="' . $allin_fjobs_statsclas . '">' . $allin_fjobs_pkgstats . '</em>');
                                        $cvs_pkgsts_str = sprintf(__('Status: %s'), '<em class="' . $allin_cvs_statsclas . '">' . $allin_cvs_pkgstats . '</em>');
                                        ?>
                                        <div class="jobsearch-table-cell jobsearch-detailpkg-celcol">
                                            <div class="pkg-item-detail">
                                                <span class="itm-labl"><?php esc_html_e('Normal Jobs:') ?></span>
                                                <?php
                                                if ($unlimited_numjobs == 'yes') {
                                                    ?>
                                                    <span class="itm-val"><?php printf(__('Total: <strong>%s</strong>'), $total_jobs) ?>, <?php echo ($jobs_pkgsts_str) ?></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="itm-val"><?php printf(__('Total: <strong>%s</strong>'), $total_jobs) ?>, <?php printf(__('Used: <strong>%s</strong>'), $used_jobs) ?>, <?php printf(__('Remaining: <strong>%s</strong>'), $remaining_jobs) ?>, <?php echo ($jobs_pkgsts_str) ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="pkg-item-detail">
                                                <span class="itm-labl"><?php esc_html_e('Featured Jobs:') ?></span>
                                                <?php
                                                if ($unlimited_numfjobs == 'yes') {
                                                    ?>
                                                    <span class="itm-val"><?php printf(__('Total: <strong>%s</strong>'), $total_fjobs) ?>, <?php echo ($fjobs_pkgsts_str) ?></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="itm-val"><?php printf(__('Total: <strong>%s</strong>'), $total_fjobs) ?>, <?php printf(__('Used: <strong>%s</strong>'), $used_fjobs) ?>, <?php printf(__('Remaining: <strong>%s</strong>'), $remaining_fjobs) ?>, <?php echo ($fjobs_pkgsts_str) ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="pkg-item-detail">
                                                <span class="itm-labl"><?php esc_html_e('CVs:') ?></span>
                                                <?php
                                                if ($unlimited_numcvs == 'yes') {
                                                    ?>
                                                    <span class="itm-val"><?php printf(__('Total: <strong>%s</strong>'), $total_cvs) ?>, <?php echo ($cvs_pkgsts_str) ?></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="itm-val"><?php printf(__('Total: <strong>%s</strong>'), $total_cvs) ?>, <?php printf(__('Used: <strong>%s</strong>'), $used_cvs) ?>, <?php printf(__('Remaining: <strong>%s</strong>'), $remaining_cvs) ?>, <?php echo ($cvs_pkgsts_str) ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="pkg-item-expiresin">
                                                <?php
                                                $pkg_expires_in = absint($pkg_exp_dur) . ' ' . jobsearch_get_duration_unit_str($pkg_exp_dur_unit);
                                                if ($unlimited_pkg == 'yes') {
                                                    esc_html_e('Package Expire: Never', 'wp-jobsearch');
                                                } else {
                                                    printf(esc_html__('Package Expire in: %s', 'wp-jobsearch'), $pkg_expires_in);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    } else if ($pkg_type == 'cv') {
                                        ?>
                                        <div class="jobsearch-table-cell"><?php echo ($total_cvs) ?></div>
                                        <div class="jobsearch-table-cell"><?php echo ($used_cvs) ?></div>
                                        <div class="jobsearch-table-cell"><?php echo ($remaining_cvs) ?></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="jobsearch-table-cell"><?php echo apply_filters('jobsearch_emp_dash_pkgs_inlist_ttjobs', $total_jobs, $pkg_order_id) ?></div>
                                        <div class="jobsearch-table-cell"><?php echo apply_filters('jobsearch_emp_dash_pkgs_inlist_uujobs', $used_jobs, $pkg_order_id) ?></div>
                                        <div class="jobsearch-table-cell"><?php echo apply_filters('jobsearch_emp_dash_pkgs_inlist_rrjobs', $remaining_jobs, $pkg_order_id) ?></div>
                                        <?php
                                    }
                                    if ($pkg_type != 'emp_allin_one') {
                                        if ($unlimited_pkg == 'yes') {
                                            ?>
                                            <div class="jobsearch-table-cell"><?php esc_html_e('Never', 'wp-jobsearch'); ?></div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="jobsearch-table-cell"><?php echo absint($pkg_exp_dur) . ' ' . jobsearch_get_duration_unit_str($pkg_exp_dur_unit) ?></div>
                                            <?php
                                        }
                                        ?>
                                        <div class="jobsearch-table-cell">
                                            <i class="fa fa-circle <?php echo apply_filters('jobsearch_emp_dash_pkgs_inlist_pstatus', $status_class, $pkg_order_id) ?>"></i> <?php echo apply_filters('jobsearch_emp_dash_pkgs_inlist_pstatext', $status_txt, $pkg_order_id) ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php
                $total_pages = 1;
                if ($total_pkgs > 0 && $reults_per_page > 0 && $total_pkgs > $reults_per_page) {
                    $total_pages = ceil($total_pkgs / $reults_per_page);
                    ?>
                    <div class="jobsearch-pagination-blog">
                        <?php $Jobsearch_User_Dashboard_Settings->pagination($total_pages, $page_num, $page_url) ?>
                    </div>
                    <?php
                }
                $pkgs_html = ob_get_clean();
                echo apply_filters('jobsearch_empdash_pckges_list_html', $pkgs_html);
            } else {
                ?>
                <p><?php esc_html_e('No record found.', 'wp-jobsearch') ?></p>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}