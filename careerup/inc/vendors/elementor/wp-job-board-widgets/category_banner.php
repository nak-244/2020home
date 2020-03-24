<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Careerup_Elementor_Job_Board_Category_Banner extends Elementor\Widget_Base {

	public function get_name() {
        return 'careerup_job_board_category_banner';
    }

	public function get_title() {
        return esc_html__( 'Apus Category Banner', 'careerup' );
    }
    
	public function get_categories() {
        return [ 'careerup-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Category Banner', 'careerup' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'careerup' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'careerup' ),
            ]
        );

        $this->add_control(
            'slug',
            [
                'label' => esc_html__( 'Category Slug', 'careerup' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your Category Slug here', 'careerup' ),
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout Type', 'careerup' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Layout 1', 'careerup'),
                    'style2' => esc_html__('Layout 2', 'careerup'),
                ),
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Category Background Image', 'careerup' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'careerup' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Category Icon', 'careerup' ),
                'type' => Elementor\Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'show_nb_jobs',
            [
                'label' => esc_html__( 'Show Number Jobs', 'careerup' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'careerup' ),
                'label_off' => esc_html__( 'Show', 'careerup' ),
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'careerup' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'careerup' ),
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( empty($slug) ) {
            return;
        }
        ?>
        <div class="widget-job-category-banner <?php echo esc_attr($el_class); ?>">
            
            <?php
            $term = get_term_by( 'slug', $slug, 'job_listing_category' );
            if ($term) {

                $img_src = ( isset( $img_src['id'] ) && $img_src['id'] != 0 ) ? wp_get_attachment_url( $img_src['id'], 'full' ) : '';
                $style_bg = '';
                if ( !empty($img_src) ) {
                    $style_bg = 'style="background-image:url('.esc_url($img_src).')"';
                }

            ?>
                <a href="<?php echo esc_url(get_term_link( $term, 'job_listing_category' )); ?>">
                    <div class="category-banner-inner <?php echo esc_attr($layout_type); ?>" <?php echo trim($style_bg); ?>>
                        <div class="content-inner">
                            <?php if ( !empty($icon) ) { ?>
                                <div class="category-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                            <?php } ?>
                            <div class="inner">
                                <?php if ( !empty($title) ) { ?>
                                    <h4 class="title">
                                        <?php echo trim($title); ?>
                                    </h4>
                                <?php } ?>

                                <?php if ( $show_nb_jobs ) {
                                        $args = array(
                                            'fields' => 'ids',
                                            'categories' => array($term->slug),
                                            'limit' => 1
                                        );
                                        $query = careerup_get_jobs($args);
                                        $number_jobs = $count = $query->found_posts;
                                        $number_jobs = $number_jobs ? WP_Job_Board_Mixes::format_number($number_jobs) : 0;
                                ?>
                                    <div class="number"><?php echo sprintf(_n('<strong>%d</strong> Open Position', '<strong>%d</strong> Open Positions', $count, 'careerup'), $number_jobs); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php

    }

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Careerup_Elementor_Job_Board_Category_Banner );