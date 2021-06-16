<?php

namespace CareerfyElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;


/**
 * @since 1.1.0
 */
class NewsLetter extends Widget_Base
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
        return 'news-letter';
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
        return __('News Letter', 'careerfy-frame');
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
        return 'fa fa-newspaper-o';
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
        return ['careerfy'];
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
    protected function _register_controls()
    {
        global $careerfy_framework_options;
        $mailchimp_api_key = '';
        if (isset($careerfy_framework_options['careerfy-mailchimp-api-key'])) {
            $mailchimp_api_key = $careerfy_framework_options['careerfy-mailchimp-api-key'];
        }

        $careerfy_mailchimp_list = array();
        $mailchimp_lists = careerfy_framework_mailchimp_list($mailchimp_api_key);

        if (is_array($mailchimp_lists) && isset($mailchimp_lists['data'])) {
            foreach ($mailchimp_lists['data'] as $mc_list) {
                $careerfy_mailchimp_list[$mc_list['id']] = $mc_list['name'] ;
            }
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('News Letter Settings', 'careerfy-frame'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'news_letter_title',
            [
                'label' => __('Title', 'careerfy-frame'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'news_letter_desc',
            [
                'label' => __('Description', 'careerfy-frame'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
            ]
        );

        $this->add_control(
            'news_letter_list',
            [
                'label' => __('List', 'careerfy-frame'),
                'type' => Controls_Manager::SELECT,
                'options' => $careerfy_mailchimp_list
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $atts = $this->get_settings_for_display();

        global $careerfy_framework_options;
        extract(shortcode_atts(array(
            'news_letter_title' => '',
            'news_letter_desc' => '',
            'news_letter_list' => '',
        ), $atts));
        $counter = rand(3333, 322342);
        $mailchimp_list = array();
        if (isset($careerfy_framework_options['careerfy-mailchimp-list'])) {
            $mailchimp_list = $careerfy_framework_options['careerfy-mailchimp-list'];
        }
        ob_start(); ?>
        <div class="careerfy-eighteen-newslatter">
            <form action="javascript:careerfy_mailchimp_submit<?php echo intval($counter); ?>('<?php echo esc_js($counter); ?>','<?php echo admin_url('admin-ajax.php'); ?>')"
                  id="mcform_<?php echo intval($counter); ?>" method="post">
                <div class="careerfy-eighteen-newslatter-left">
                    <?php if (!empty($news_letter_title)) { ?>
                        <label><?php echo $news_letter_title ?></label>
                    <?php }
                    if (!empty($news_letter_desc)) { ?>
                        <span><?php echo $news_letter_desc ?></span>
                    <?php } ?>
                </div>
                <div class="careerfy-eighteen-newslatter-right">
                    <input name="mc_fname" id="mc_fname<?php echo intval($counter); ?>" value="" placeholder="<?php echo esc_html__('First Name', 'careerfy-frame'); ?>" type="hidden">
                    <input name="mc_lname" id="mc_lname<?php echo intval($counter); ?>" value="" placeholder="<?php echo esc_html__('Last Name', 'careerfy-frame'); ?>" type="hidden">
                    <input name="mc_lists[]" id="mc_lists<?php echo intval($counter); ?>" value="<?php echo $news_letter_list ?>" placeholder="<?php echo esc_html__('MC Lists', 'careerfy-frame'); ?>" type="hidden">
                    <input value="<?php echo esc_html__('Please enter your email...', 'careerfy-frame'); ?>" id="mc_email<?php echo intval($counter); ?>"
                           onblur="if(this.value == '') { this.value ='Please enter your email...'; }"
                           onfocus="if(this.value =='Please enter your email...') { this.value = ''; }" type="text">
                    <input type="submit" id="btn_newsletter_<?php echo intval($counter); ?>" value="<?php esc_html_e('Submit', 'careerfy-frame') ?>"><i class="hidden ajax-loader-news-letter fa fa-refresh fa-spin"></i>
                </div>
                <div id="process_<?php echo intval($counter); ?>" class="status status-message" style="display:none"></div>
            </form>
            <div id="newsletter_error_div_<?php echo intval($counter); ?>" style="display:none" class="alert alert-danger">
                <button class="close" type="button" onclick="hide_div('newsletter_error_div_<?php echo intval($counter); ?>')" aria-hidden="true">×</button>
                <p>
                    <i class="icon-warning"></i>
                    <span id="newsletter_mess_error_<?php echo intval($counter); ?>"></span>
                </p>
            </div>
            <div id="newsletter_success_div_<?php echo intval($counter); ?>" style="display:none" class="alert alert-success">
                <button class="close" type="button" onclick="hide_div('newsletter_success_div_<?php echo intval($counter); ?>')" aria-hidden="true">×</button>
                <p><i class="icon-checkmark"></i><span id="newsletter_mess_success_<?php echo intval($counter); ?>"></span></p>
            </div>
        </div>

        <?php
        if (!empty($mailchimp_list)) { ?>
            <script>
                function careerfy_mailchimp_submit<?php echo intval($counter); ?>(counter, admin_url) {
                    'use strict';
                    var $ = jQuery;
                    $('#newsletter_error_div_' + counter).fadeOut();
                    $('#newsletter_success_div_' + counter).fadeOut();
                    $('#process_' + counter).show();
                    $('.ajax-loader-news-letter').removeClass('hidden');
                    $.ajax({
                        type: 'POST',
                        url: admin_url,
                        data: "mc_lists="+ $('#mc_lists'+ counter)+"cp_email=" + $('#mc_email' + counter).val() + "&cp_fname=" + $('#mc_fname' + counter).val() + "&cp_lname=" + $('#mc_lname' + counter).val() + '&' + $('#mcform_' + counter).serialize() + '&action=careerfy_mailchimp',
                        dataType: "json",
                        success: function (response) {
                            $('.ajax-loader-news-letter').addClass('hidden');
                            $('#mcform_' + counter).get(0).reset();
                            if (response.type === 'error') {
                                $('#process_' + counter).hide();
                                $('#newsletter_mess_error_' + counter).html(response.msg);
                                $('#newsletter_error_div_' + counter).fadeIn();
                            } else {
                                $('#process_' + counter).hide();
                                $('#newsletter_mess_success_' + counter).html(response.msg);
                                $('#newsletter_success_div_' + counter).fadeIn();
                            }
                            $('#newsletter_mess_' + counter).fadeIn(600);
                            $('#newsletter_mess_' + counter).html(response);
                            $('#process_' + counter).html('');
                        }
                    });
                }

                function hide_div(div_hide) {
                    jQuery('#' + div_hide).hide();
                }
            </script>
            <?php
        }else {
            echo '<p class="error-api">' . esc_html__('Please contact to administrator to set settings for Newsletter API', 'careerfy-frame') . '</p>';
        }

        $html = ob_get_clean();
        echo $html;
    }

    protected function _content_template()
    {

    }
}