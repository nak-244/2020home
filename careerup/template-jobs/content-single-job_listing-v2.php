<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_job_board_before_job_detail', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-single-v2'); ?>>

	<!-- Main content -->
	<div class="row">
		<div class="col-xs-12 col-md-<?php echo esc_attr( is_active_sidebar( 'job-single-sidebar-v2' ) ? 8 : 12); ?>">

			<!-- heading -->
			<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/header-v2' ); ?>

			<!-- job detail -->
			<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/detail' ); ?>

			<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>

			<!-- カスタムフィールド出力 -->
			<table class="tbl-r02">
				<tbody>
					<tr>
						<th>企業について<br>（社風など）</th>
						<td><?php the_field('cf_001'); ?></td>
					</tr>
					<tr>
						<th>勤務時間</th>
						<td><?php the_field('cf_002'); ?></td>
					</tr>
					<tr>
						<th>応募要件</th>
						<td><?php the_field('cf_003'); ?></td>
					</tr>
					<tr>
						<th>給与</th>
						<td><?php the_field('cf_004'); ?></td>
					</tr>
					<tr>
						<th>休日</th>
						<td><?php the_field('cf_005'); ?></td>
					</tr>
					<tr>
						<th>契約期間</th>
						<td><?php the_field('cf_006'); ?></td>
					</tr>
				</tbody>
			</table>

			<!-- 企業について（社風など） -->
			<div class="job-detail-description">
				<h3 class="title-detail-job">企業について（社風など）</h3>
				<div class="inner">
					<?php the_field('cf_001'); ?>
				</div>
			</div>

			<!-- 勤務時間 -->
			<div class="job-detail-description">
				<h3 class="title-detail-job">勤務時間</h3>
				<div class="inner">
					<?php the_field('cf_002'); ?>
				</div>
			</div>

			<!-- 応募要件 -->
			<div class="job-detail-description">
				<h3 class="title-detail-job">応募要件</h3>
				<div class="inner">
					<?php the_field('cf_003'); ?>
				</div>
			</div>

			<!-- job description -->
			<div class="job-detail-description">
				<h3 class="title-detail-job"><?php esc_html_e('Job Description', 'careerup'); ?></h3>
				<div class="inner">
					<?php the_content(); ?>
				</div>
			</div>

			<!-- job releated -->
			<div class="hidden-xs hidden-sm">
				<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/releated' ); ?>
			</div>

			<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>
		</div>

		<?php if ( is_active_sidebar( 'job-single-sidebar-v2' ) ): ?>
			<div class="col-md-4 col-xs-12">
		   		<?php dynamic_sidebar( 'job-single-sidebar-v2' ); ?>
		   	</div>
	   	<?php endif; ?>
	   	<!-- job releated -->
		<div class="hidden-lg hidden-md col-xs-12">
			<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/releated' ); ?>
		</div>

	</div>

</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_detail', $post->ID ); ?>
