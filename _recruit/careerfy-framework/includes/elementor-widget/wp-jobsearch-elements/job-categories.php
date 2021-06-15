<?php

namespace CareerfyElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

/**
 * @since 1.1.0
 */
class JobCategories extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'job-categories';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Job Sectors', 'careerfy-frame');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'fa fa-list-alt';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['wp-jobsearch'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function getChildSectorsJobs($term_sector_slug)
    {
        $job_args_child_cat = array(
            'posts_per_page' => '1',
            'post_type' => 'job',
            'post_status' => 'publish',
            'fields' => 'ids', // only load ids
            'tax_query' => array(
                array(
                    'taxonomy' => 'sector',
                    'field' => 'slug',
                    'terms' => $term_sector_slug
                )
            ),
            'meta_query' => array(
                array(
                    'relation' => 'OR',
                    array(
                        'key' => 'jobsearch_field_job_filled',
                        'compare' => 'NOT EXISTS',
                    ),
                    array(
                        array(
                            'key' => 'jobsearch_field_job_filled',
                            'value' => 'on',
                            'compare' => '!=',
                        ),
                    ),
                ),
                array(
                    'key' => 'jobsearch_field_job_publish_date',
                    'value' => strtotime(current_time('d-m-Y H:i:s')),
                    'compare' => '<=',
                ),
                array(
                    'key' => 'jobsearch_field_job_expiry_date',
                    'value' => strtotime(current_time('d-m-Y H:i:s')),
                    'compare' => '>=',
                ),
                array(
                    'key' => 'jobsearch_field_job_status',
                    'value' => 'approved',
                    'compare' => '=',
                )
            ),
        );
        $jobs_query_child_cat = new \WP_Query($job_args_child_cat);
        return $jobs_query_child_cat->found_posts;
    }

    protected function _register_controls()
    {
        $all_page = array(esc_html__("Select Page", "careerfy-frame") => '');

        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $all_page[$page->ID] = $page->post_title;
            }
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Job Categories Settings', 'careerfy-frame'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cats_view',
            [
                'label' => __('Style', 'careerfy-frame'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'view1',
                'options' => [
                    'view1' => __('Style 1', 'careerfy-frame'),
                    'view2' => __('Style 2', 'careerfy-frame'),
                    'view3' => __('Style 3', 'careerfy-frame'),
                    'view4' => __('Style 4', 'careerfy-frame'),
                    'view5' => __('Style 5', 'careerfy-frame'),
                    'view6' => __('Style 6', 'careerfy-frame'),
                    'view7' => __('Style 7', 'careerfy-frame'),
                    'view8' => __('Style 8', 'careerfy-frame'),
                    'view9' => __('Style 9', 'careerfy-frame'),
                    'view10' => __('Style 10', 'careerfy-frame'),
                    'slider' => __('Slider', 'careerfy-frame'),

                ],
            ]
        );

        $this->add_control(
            'num_cats',
            [
                'label' => __('Number of Sectors', 'careerfy-frame'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__("Set the number of Sectors to show", "careerfy-frame")
            ]
        );
        $this->add_control(
            'num_cats_child',
            [
                'label' => __('Number of sub Sectors', 'careerfy-frame'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__("Set the number of sub Sectors to show", "careerfy-frame"),
                'condition' => [
                    'cats_view' => 'view10',
                ],
            ]
        );

        $this->add_control(
            'sub_cats',
            [
                'label' => __('Include Sub Categories', 'careerfy-frame'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'yes',
                'options' => [
                    'on' => __('Yes', 'careerfy-frame'),
                    'off' => __('No', 'careerfy-frame'),

                ],
            ]
        );
        $this->add_control(
            'result_page',
            [
                'label' => __('Result Page', 'careerfy-frame'),
                'type' => Controls_Manager::SELECT2,
                'options' => $all_page,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order', 'careerfy-frame'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'jobs_count',
                'options' => [
                    'jobs_count' => __('By Jobs Count', 'careerfy-frame'),
                    'id' => __('By Random', 'careerfy-frame'),

                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'careerfy-frame'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'cats_view' => 'view5',
                ],
            ]
        );
        $this->add_control(
            'job_bg_color',
            [
                'label' => __('Jobs Number Background Color', 'careerfy-frame'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'cats_view' => 'view5',
                ],
            ]
        );
        $this->add_control(
            'cat_title',
            [
                'label' => __('Title', 'careerfy-frame'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'cats_view' => 'slider',
                ],
            ]
        );

        $this->add_control(
            'cat_link_text',
            [
                'label' => __('Link text', 'careerfy-frame'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'cats_view' => 'slider',
                ],
            ]
        );

        $this->add_control(
            'cat_link_text_url',
            [
                'label' => __('Link text URL', 'careerfy-frame'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'cats_view' => 'slider',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $wpdb, $jobsearch_plugin_options, $jobsearch_shortcode_jobs_frontend;
        $atts = $this->get_settings_for_display();

        $cats_view = $atts['cats_view'];
        $cat_title = $atts['cat_title'];
        $num_cats = $atts['num_cats'];
        $result_page = $atts['result_page'];
        $cat_link_text = $atts['cat_link_text'];
        $cat_link_text_url = $atts['cat_link_text_url'];
        $icon_color = $atts['icon_color'];
        $job_bg_color = $atts['job_bg_color'];
        $num_cats_child = $atts['num_cats_child'];
        $order_by = $atts['order_by'];
        $sub_cats = $atts['sub_cats'];

        ob_start();
        if (class_exists('JobSearch_plugin')) {

            $to_result_page = $result_page;
            $joptions_search_page = isset($jobsearch_plugin_options['jobsearch_search_list_page']) ? $jobsearch_plugin_options['jobsearch_search_list_page'] : '';
            if ($joptions_search_page != '') {
                $joptions_search_page = careerfy__get_post_id($joptions_search_page, 'page');
            }
            if ($result_page <= 0 && $joptions_search_page > 0) {
                $to_result_page = $joptions_search_page;
            }

            $to_result_page = absint($to_result_page);

            if ($order_by == 'id') {
                $cats_query = "SELECT terms.term_id FROM $wpdb->terms AS terms";
                $cats_query .= " LEFT JOIN $wpdb->term_taxonomy AS term_tax ON(terms.term_id = term_tax.term_id) ";
                $cats_query .= " WHERE term_tax.taxonomy=%s";
                if ($sub_cats == 'yes') {
                    $cats_query .= " AND term_tax.parent=0";
                }
                $cats_query .= " ORDER BY terms.term_id DESC";
                $get_db_terms = $wpdb->get_col($wpdb->prepare($cats_query, 'sector'));
            } else {
                $cats_query = "SELECT terms.term_id FROM $wpdb->terms AS terms";
                $cats_query .= " LEFT JOIN $wpdb->term_taxonomy AS term_tax ON(terms.term_id = term_tax.term_id) ";
                $cats_query .= " LEFT JOIN $wpdb->termmeta AS term_meta ON(terms.term_id = term_meta.term_id) ";
                $cats_query .= " WHERE term_tax.taxonomy=%s AND term_meta.meta_key=%s";
                if ($sub_cats == 'yes') {
                    $cats_query .= " AND term_tax.parent=0";
                }
                $cats_query .= " ORDER BY cast(term_meta.meta_value as unsigned) DESC";
                $get_db_terms = $wpdb->get_col($wpdb->prepare($cats_query, 'sector', 'active_jobs_count'));
            }
            $cats_class = 'categories-list';
            if ($cats_view == 'view2') {
                $cats_class = 'careerfy-categories careerfy-categories-styletwo';
            } else if ($cats_view == 'view3') {
                $cats_class = 'careerfy-categories careerfy-categories-stylethree';
            } else if ($cats_view == 'view4') {
                $cats_class = 'careerfy-categories careerfy-categories-stylefive';
            } else if ($cats_view == 'view5') {
                $cats_class = 'careerfy-categories careerfy-trending-categories';
            } else if ($cats_view == 'view6') {
                $cats_class = 'careerfy-categories careerfy-categories-tenstyle1';
            } else if ($cats_view == 'view7') {
                $cats_class = 'careerfy-categories careerfy-categories-style14';
            } else if ($cats_view == 'view8') {
                $cats_class = 'careerfy-categories careerfy-fifteen-categories';
            } else if ($cats_view == 'view9') {
                $cats_class = 'careerfy-categories-browse-links careerfy-fifteen-browse-links';
            } else if ($cats_view == 'view10') {
                $cats_class = 'careerfy-sector-grid';
            } else if ($cats_view == 'slider') {
                $cats_class = 'careerfy-section-premium-wrap';
                $rand_num = rand(1000000, 9999999);
                $view_all_btn_class = isset($num_cats) && count($get_db_terms) <= 9 ? 'no-slider' : '';

                if ($cat_title != '') {
                    $slider_wrapper = "\n" . '
                <div class="careerfy-section-title-style"><h2>' . $cat_title . '</h2>
                    <a href="' . $cat_link_text_url . '" class="careerfy-section-title-btn ' . $view_all_btn_class . '">' . $cat_link_text . '</a>
                </div>';
                }
            }
            $icon_color = $icon_color != "" ? 'style="color: ' . $icon_color . ' "' : "";
            $job_bg_color = $job_bg_color != "" ? 'style="background-color: ' . $job_bg_color . ' "' : "";
            ?>
            <div class="<?php echo($cats_class) ?>">
                <?php if ($cats_view == 'view10'){ ?>
                <div class="row">
                    <?php } ?>

                    <?php echo ($cats_view == 'slider') ? $slider_wrapper : "";
                    //////// slider style slider wrapper
                    if ($cats_view == 'slider') { ?>
                    <div id="category-slider-<?php echo $rand_num ?>" class="careerfy-top-sectors-category-slider">
                        <div class="careerfy-top-sectors-category-slider-layer">
                            <div class="careerfy-top-sectors-category">
                                <ul>
                                    <?php }
                                    if (!empty($get_db_terms) && !is_wp_error($get_db_terms)) {

                                    if ($cats_view != 'slider' && $cats_view != 'view10') {
                                    $row_class = 'class="row"';
                                    ?>
                                    <ul <?php echo $cats_view != 'view4' ? $row_class : '' ?>>

                                        <?php }
                                        $term_count = 1;
                                        $term_count_child = 0;
                                        //$jobsearch_jobs_listin_sh = new Jobsearch_Shortcode_Jobs_Frontend;

                                        $sh_atts = array();
                                        $post_ids = array();
                                        $all_post_ids = $jobsearch_shortcode_jobs_frontend->job_general_query_filter($post_ids, $sh_atts);

                                        foreach ($get_db_terms as $term_id) {
                                            $term_sector = get_term_by('id', $term_id, 'sector');
                                            $term_sector_child = get_term_children($term_id, 'sector');
                                            if ($num_cats_child != 0 || $num_cats_child != "") {

                                                $term_sector_child = array_slice($term_sector_child, 0, $num_cats_child, true);
                                            }

                                            $job_args = array(
                                                'posts_per_page' => '1',
                                                'post_type' => 'job',
                                                'post_status' => 'publish',
                                                'fields' => 'ids', // only load ids
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'sector',
                                                        'field' => 'slug',
                                                        'terms' => $term_sector->slug
                                                    )
                                                ),
                                                'meta_query' => array(
                                                    array(
                                                        'relation' => 'OR',
                                                        array(
                                                            'key' => 'jobsearch_field_job_filled',
                                                            'compare' => 'NOT EXISTS',
                                                        ),
                                                        array(
                                                            array(
                                                                'key' => 'jobsearch_field_job_filled',
                                                                'value' => 'on',
                                                                'compare' => '!=',
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                            );
                                            if (!empty($all_post_ids)) {
                                                $job_args['post__in'] = $all_post_ids;
                                            } else {
                                                $job_args['post__in'] = array(0);
                                            }
                                            $jobs_query = new \WP_Query($job_args);
                                            $found_jobs = $jobs_query->found_posts;

                                            wp_reset_postdata();
                                            $total_jobs = $found_jobs == 1 ? "Job" : "Jobs";
                                            $term_fields = get_term_meta($term_sector->term_id, 'careerfy_frame_cat_fields', true);

                                            $term_icon = isset($term_fields['icon']) ? $term_fields['icon'] : '';
                                            $term_color = isset($term_fields['color']) ? $term_fields['color'] : '';
                                            $term_image = isset($term_fields['image']) ? $term_fields['image'] : '';

                                            $cat_goto_link = add_query_arg(array('sector_cat' => $term_sector->slug), get_permalink($to_result_page));
                                            $cat_goto_link = apply_filters('jobsearch_job_sector_cat_result_link', $cat_goto_link, $term_sector->slug);

                                            if ($cats_view == 'slider') { ?>
                                                <li class="col-md-4">
                                                    <a href="<?php echo($cat_goto_link) ?>">
                                                        <?php
                                                        if ($term_icon != '') { ?>
                                                            <i class="<?php echo($term_icon) ?>"<?php echo($term_color != '' && $cats_view == 'view4' ? ' style="color: ' . $term_color . ';"' : '') ?>></i>
                                                        <?php } ?>
                                                        <h6><?php echo($term_sector->name) ?></h6>
                                                        <small><?php printf(esc_html__('(%s ' . $total_jobs . ')', 'careerfy-frame'), $found_jobs) ?></small>
                                                    </a>
                                                </li>
                                            <?php } else if ($cats_view == "view10") {

                                                ?>
                                                <div class="col-md-3">
                                                    <a href="<?php echo($cat_goto_link) ?>"><img
                                                                src="<?php echo $term_image ?>" alt=""></a>
                                                    <h2>
                                                        <a href="<?php echo($cat_goto_link) ?>"><?php echo($term_sector->name) ?></a>
                                                    </h2>
                                                    <?php foreach ($term_sector_child as $term_sectors_children) {

                                                        $child_term = get_term_by('id', $term_sectors_children, 'sector');
                                                        $total_found_jobs = $this->getChildSectorsJobs($child_term->slug);
                                                        $cat_child_goto_link = add_query_arg(array('sector_cat' => $child_term->slug), get_permalink($to_result_page));
                                                        ?>
                                                        <span><a href="<?php echo($cat_child_goto_link) ?>"><?php echo $child_term->name; ?></a><small><?php echo($total_found_jobs) ?></small></span>
                                                    <?php } ?>
                                                </div>

                                            <?php } else if ($cats_view == "view9") { ?>

                                                <li>
                                                    <a href="<?php echo($cat_goto_link) ?>">
                                                        <?php echo($term_sector->name) ?>
                                                        <span><?php printf(esc_html__('(%s ' . $total_jobs . ')', 'careerfy-frame'), $found_jobs) ?></span>
                                                    </a>
                                                </li>

                                            <?php } else if ($cats_view == 'view8') { ?>
                                                <li>
                                                    <a href="<?php echo($cat_goto_link) ?>">
                                                        <?php
                                                        if ($term_icon != '') {
                                                            ?>
                                                            <i class="careerfy-icon <?php echo($term_icon) ?>"></i>
                                                        <?php } ?>

                                                        <span><?php echo($term_sector->name) ?>​</span>
                                                    </a>
                                                </li>
                                            <?php } else if ($cats_view == 'view7') { ?>
                                                <li>
                                                    <?php
                                                    if ($term_icon != '') {
                                                        ?>
                                                        <i class="careerfy-icon <?php echo($term_icon) ?>"></i>
                                                    <?php } ?>
                                                    <span><a href="<?php echo($cat_goto_link) ?>"> <?php echo($term_sector->name) ?></a></span>
                                                    <small><?php printf(esc_html__('%s', 'careerfy-frame'), $found_jobs) ?></small>
                                                </li>

                                            <?php } else if ($cats_view == 'view6') { ?>
                                                <li class="col-md-2">
                                                    <a href="<?php echo($cat_goto_link) ?>">
                                                        <?php
                                                        if ($term_image != '') { ?>
                                                            <img src="<?php echo $term_image ?>">
                                                        <?php } else if ($term_icon) {
                                                            if ($term_icon != '') { ?>
                                                                <i class="<?php echo($term_icon) ?>"<?php echo($term_color != '' && $cats_view == 'view4' ? ' style="color: ' . $term_color . ';"' : '') ?>></i>
                                                            <?php }
                                                        } ?>
                                                        <strong><?php echo($term_sector->name) ?></strong>
                                                        <small><?php printf(esc_html__('(%s ' . $total_jobs . ')', 'careerfy-frame'), $found_jobs) ?></small>
                                                    </a>
                                                </li>
                                            <?php } else if ($cats_view == 'view4') { ?>
                                                <li>
                                                    <a href="<?php echo($cat_goto_link) ?>"
                                                       class="careerfy-categories-stylefive-wrap">
                                                        <?php
                                                        if ($term_icon != '') {
                                                            ?>
                                                            <i class="<?php echo($term_icon) ?>"<?php echo($term_color != '' && $cats_view == 'view4' ? ' style="color: ' . $term_color . ';"' : '') ?>></i>
                                                            <?php
                                                        }
                                                        ?>
                                                        <span class="jobcat-title"><?php echo($term_sector->name) ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            } elseif ($cats_view == 'view3') { ?>
                                                <li class="col-md-2">
                                                    <a href="<?php echo($cat_goto_link) ?>"
                                                       class="careerfy-categories-stylethree-wrap" <?php echo($term_image != '' ? 'style="background-image: url(' . $term_image . '); background-size: cover;"' : '') ?>>
                                                        <span></span>
                                                        <div class="careerfy-categories-stylethree-text">
                                                            <p class="jobcat-title">
                                                                <strong <?php echo($term_color != '' ? 'style="color: ' . $term_color . ';"' : '') ?>>#</strong> <?php echo($term_sector->name) ?>
                                                            </p>
                                                            <small><?php printf(esc_html__('(%s Jobs)', 'careerfy-frame'), $found_jobs) ?></small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            } else if ($cats_view == 'view5') { ?>
                                                <li class="col-md-3">
                                                    <a href="<?php echo($cat_goto_link) ?>">
                                                        <?php
                                                        if ($term_icon != '') {
                                                            ?>
                                                            <i <?php echo $icon_color ?>
                                                                    class="<?php echo($term_icon) ?>"></i>
                                                        <?php } ?>
                                                        <h2><?php echo($term_sector->name) ?></h2>
                                                        <span <?php echo $job_bg_color ?>><?php printf(esc_html__('%s', 'careerfy-frame'), $found_jobs) ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            } else {
                                                ob_start();
                                                ?>
                                                <li class="col-md-3">
                                                    <a href="<?php echo($cat_goto_link) ?>">
                                                        <?php
                                                        $term_act_conts = get_term_meta($term_sector->term_id, 'active_jobs_count', true);
                                                        //var_dump($term_act_conts);
                                                        if ($term_icon != '') {
                                                            ?>
                                                            <i class="<?php echo($term_icon) ?>"<?php echo($term_color != '' && $cats_view == 'view2' ? ' style="background-color: ' . $term_color . ';"' : '') ?>></i>
                                                            <?php
                                                        }
                                                        ?>
                                                        <span class="jobcat-title"><?php echo($term_sector->name) ?></span>
                                                        <?php
                                                        ob_start();
                                                        if ($cats_view == 'view2') {
                                                            ?>
                                                            <small><?php printf(esc_html__('(%s Open Vacancies)', 'careerfy-frame'), $found_jobs) ?></small>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span><?php printf(esc_html__('(%s Open Vacancies)', 'careerfy-frame'), $found_jobs) ?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </a>
                                                    <?php
                                                    $vacs_html = ob_get_clean();
                                                    echo apply_filters('careerfy_job_cats_shcode_openvacs_html', $vacs_html, $found_jobs, $cats_view);
                                                    ?>
                                                </li>
                                                <?php
                                                $catitem_html = ob_get_clean();
                                                echo apply_filters('careerfy_job_cats_shcode_citem_html', $catitem_html, $term_sector, $atts, $found_jobs);
                                            }
                                            if ($num_cats > 0 && $term_count >= $num_cats) {
                                                break;
                                            }

                                            if ($term_count % 9 === 0 && $cats_view == 'slider') {

                                                echo '</ul>
                                            </div>
                                        </div>
                                        <div class="careerfy-top-sectors-category-slider-layer">
                                            <div class="careerfy-top-sectors-category">
                                               <ul>';
                                            }
                                            $term_count++;
                                            $term_count_child++;
                                        }
                                        if ($cats_view != 'slider' && $cats_view != 'view10') { ?>
                                    </ul>
                                <?php }
                                if ($cats_view == 'slider') { ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php }
                }
                if ($cats_view == 'view10') { ?>
                </div>
            <?php } ?>
            </div>
            <?php if ($cats_view == 'slider') { ?>
                <script type="text/javascript">
                    var $ = jQuery;
                    $(document).ready(function () {
                        $('#category-slider-<?php echo $rand_num; ?>').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 5000,
                            infinite: true,
                            dots: false,
                            prevArrow: "<span class=\'slick-arrow-left\'><i class=\'careerfy-icon careerfy-next\'></i></span>",
                            nextArrow: "<span class=\'slick-arrow-right\'><i class=\'careerfy-icon careerfy-next\'></i></span>",
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                        infinite: true,
                                    }
                                },
                                {
                                    breakpoint: 800,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: 400,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]
                        });
                    })
                </script>
            <?php }

            if ($result_page > 0 && $cats_view != 'view3' && $cats_view != 'view4' && $cats_view != 'view5' && $cats_view != 'view7') {
                ob_start();
                $btn_class = $cats_view == 'view9' || $cats_view == 'view8' || $cats_view == 'view6' ? 'careerfy-fifteen-browse-btn' : 'careerfy-plain-btn';
                ?>
                <div class="<?php echo $btn_class ?>"><a
                            href="<?php echo get_permalink($result_page) ?>"><?php esc_html_e('Browse All Sectors', 'careerfy-frame') ?></a>
                </div>
                <?php
                $vacsbtn_html = ob_get_clean();
                echo apply_filters('careerfy_job_cats_shcode_vacsbtn_html', $vacsbtn_html, $result_page, $cats_view);
            }

            if ($result_page > 0 && $cats_view == 'view5') {
                ob_start();
                ?>
                <div class="careerfy-browse-ninebtn"><a
                            href="<?php echo get_permalink($result_page) ?>"><?php esc_html_e('Browse All Sectors', 'careerfy-frame') ?></a>
                </div>
                <?php
                $vacsbtn_html = ob_get_clean();
                echo apply_filters('careerfy_job_cats_shcode_vacsbtn_html', $vacsbtn_html, $result_page, $cats_view);
            }
        }
        $html = ob_get_clean();
        echo $html;
    }

    protected function _content_template()
    {
    }
}