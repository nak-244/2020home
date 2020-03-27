<?php

class Careerup_Widget_Employer_Contact_Form extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_employer_contact_form',
            esc_html__('Employer Detail:: Contact Form', 'careerup'),
            array( 'description' => esc_html__( 'Show employer contact form', 'careerup' ), )
        );
        $this->widgetName = 'employer_contact_form';
    }

    public function getTemplate() {
        $this->template = 'employer-contact-form.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Contact %1s',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'careerup' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            <span class="desc"><?php esc_html_e('Enter %1s for employer name', 'careerup'); ?></span>
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;

    }
}
if ( function_exists('apus_framework_reg_widget') ) {
    apus_framework_reg_widget('Careerup_Widget_Employer_Contact_Form');
}