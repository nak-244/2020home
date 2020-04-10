<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('select2');
wp_enqueue_style('select2');
?>


<div class="box-employer">
	<div class="top-info-user text-center">
		<h3 class="title"><?php echo esc_html__('Create New Account','careerup') ?></h3>
		<div class="des">&nbsp;</div>
		<!-- <div class="des"><?php echo esc_html__('Choose your Account Type','careerup') ?></div> -->
	</div>
  	<div class="register-form-wrapper">
	  	<div class="container-form">
          	<form name="registerForm" method="post" class="register-form">
          		<div class="form-group space-25">
					<ul class="role-tabs">
						<li class="active"><input id="cadidate" type="radio" name="role" value="wp_job_board_candidate" checked="checked">
							<label for="cadidate"><?php esc_html_e('Candidate', 'careerup'); ?></label>
						</li>
						<!-- <li><input type="radio" id="employer" name="role" value="wp_job_board_employer"><label for="employer"><?php esc_html_e('Employer', 'careerup'); ?></label></li> -->
					</ul>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="username" id="register-username" placeholder="<?php esc_attr_e('Username *','careerup'); ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="email" id="register-email" placeholder="<?php esc_attr_e('Email *','careerup'); ?>">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" id="password" placeholder="<?php esc_attr_e('Password *','careerup'); ?>">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="<?php esc_attr_e('Confirm Password *','careerup'); ?>">
				</div>

				<div class="form-group wp_job_board_employer_show">
					<input type="text" class="form-control" name="company_name" id="register-company-name" placeholder="<?php esc_attr_e('Company Name','careerup'); ?>">
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="phone" id="register-phone" placeholder="<?php esc_attr_e('Phone','careerup'); ?>">
				</div>
				<?php
					$candidate_args = array(
			            'taxonomy' => 'candidate_category',
			            'orderby' => 'name',
			            'order' => 'ASC',
			            'hide_empty' => false,
			            'number' => false,
				    );
				    $terms = get_terms($candidate_args);

				    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				    	?>
				    	<div class="form-group space-25 wp_job_board_candidate_show select2-wrapper">
				    		<div class="flex-middle">
								<span class="text-medium"><?php esc_html_e('Category', 'careerup'); ?></span>
								<select id="register-candidate-category" class="orderby" name="candidate_category">
									<option value=""><?php esc_html_e('Select Category', 'careerup'); ?></option>
									<?php foreach ($terms as $term) { ?>
										<option class="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
				    	<?php
				    }
				?>
				<?php
					$employer_args = array(
			            'taxonomy' => 'employer_category',
			            'orderby' => 'name',
			            'order' => 'ASC',
			            'hide_empty' => false,
			            'number' => false,
				    );
				    $terms = get_terms($employer_args);

				    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				    	?>
				    	<div class="form-group space-25 wp_job_board_employer_show select2-wrapper">
				    		<div class="flex-middle">
								<span class="text-medium"><?php esc_html_e('Category', 'careerup'); ?></span>
								<select id="register-employer-category" class="orderby" name="employer_category">
									<option value=""><?php esc_html_e('Select Category', 'careerup'); ?></option>
									<?php foreach ($terms as $term) { ?>
										<option class="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
				    	<?php
				    }
				?>
				<?php wp_nonce_field('ajax-register-nonce', 'security_register'); ?>

				<?php if ( WP_Job_Board_Recaptcha::is_recaptcha_enabled() ) { ?>
		            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_job_board_get_option( 'recaptcha_site_key' )); ?>"></div>
		      	<?php } ?>

				<div class="form-group">
					<label for="register-terms-and-conditions">
						<input type="checkbox" name="terms_and_conditions" value="on" id="register-terms-and-conditions" required>
						<?php
							$page_id = wp_job_board_get_option('terms_conditions_page_id');
							$page_url = $page_id ? get_permalink($page_id) : home_url('/');
							echo sprintf(__('You accept our <a href="%s">Terms and Conditions and Privacy Policy</a>', 'careerup'), esc_url($page_url));
						?>
					</label>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block" name="submitRegister">
						<?php echo esc_html__('Register now', 'careerup'); ?>
					</button>
				</div>

				<?php do_action('register_form'); ?>
          	</form>
	    </div>

  	</div>
 </div>
