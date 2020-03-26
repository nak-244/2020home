<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_job_board_before_job_detail', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- heading -->
	<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/header-v4' ); ?>

	<!-- Main content -->
	<div class="row content-job-detail">
		<div class="col-xs-12 col-md-<?php echo esc_attr( is_active_sidebar( 'job-single-sidebar-v4' ) ? 8 : 12); ?>">

			<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
			
			<!-- job description -->
			<div class="job-detail-description">
				<h3 class="title-detail-job"><?php esc_html_e('Job Description', 'careerup'); ?></h3>
				<div class="inner">
					<?php the_content(); ?>
				</div>
			</div>

			<!-- job social -->
			<?php if ( careerup_get_config('show_job_social_share', false) ) { ?>
				<div class="social-job-detail">
        			<?php get_template_part( 'template-parts/sharebox-job' );  ?>
        		</div>
            <?php } ?>

			<!-- job releated -->
			<div class="hidden-xs hidden-sm">
				<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/releated' ); ?>
			</div>

			<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>
		</div>
		
		<?php if ( is_active_sidebar( 'job-single-sidebar-v4' ) ): ?>
			<div class="col-md-4 col-xs-12">
		   		<?php dynamic_sidebar( 'job-single-sidebar-v4' ); ?>
		   	</div>
	   	<?php endif; ?>
	   	<!-- job releated -->
		<div class="hidden-lg hidden-md col-xs-12">
			<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/releated' ); ?>
		</div>
	   	
	</div>

</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_detail', $post->ID ); ?>