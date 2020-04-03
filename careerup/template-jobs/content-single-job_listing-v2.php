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
			                <th>会社名</th>
			                <td>株式会社オープンループパートナーズ　Open Loop Partners, Inc.</td>
			              </tr>
			              <tr>
			                <th>設立</th>
			                <td>2005年5月</td>
			              </tr>
			              <tr>
			                <th>事業内容</th>
			                <td>
			                  <ul class="">
			                    <li>ヒューマンリソーシズ事業</li>
			                    <li>BPO事業</li>
			                    <li>ITセキュリティ事業</li>
			                  </ul>
			                </td>
			              </tr>
			              <tr>
			                <th>本社住所</th>
			                <td>〒160-0022 東京都新宿区新宿四丁目3番17号 FORECAST新宿SOUTH7階<br>
			                代表TEL：03-5368-3088　FAX：03-5368-3188</td>
			              </tr>
			              <tr>
			                <th>事業所</th>
			                <td><a class="btn btn-primary" href="/staff/"><i class="fa fa-fw fa-angle-double-right"></i>支店一覧ページへ</a></td>
			              </tr>
			              <tr>
			                <th>役員</th>
			                <td>
			                  <p class="">代表取締役社長：駒井 滋</p>
			                  <p class="">専務取締役：魚山 毅</p>
			                  <p class="">常務取締役：野村 健二郎</p>
			                  <p class="">取締役：斉賀 亮賢</p>
			                  <p class="">取締役：佐藤 弘毅</p>
			                  <p class="">監査役：椎野 毅</p>
			                </td>
			              </tr>
			              <tr>
			                <th>資本金</th>
			                <td>1億円（2018年9月30日現在）</td>
			              </tr>
			              <tr>
			                <th>従業員数</th>
			                <td>329名（2019年9月10日現在、正社員・契約社員数）</td>
			              </tr>
			              <tr>
			                <th>事業許可番号</th>
			                <td>
			                  <p class=""> 労働者派遣事業許可番号　派13-302403</p>
			                  <p class=""> 有料職業紹介事業許可番号　13-ユ-301936</p>
			                </td>
			              </tr>
			              <tr>
			                <th>取引銀行</th>
			                <td>
			                  <ul class="list-inline">
			                    <li class="list-inline-item">三井住友銀行新宿支店</li>
			                    <li class="list-inline-item">みずほ銀行新宿中央支店</li>
			                    <li class="list-inline-item">三菱UFJ銀行西新宿支店</li>
			                    <li class="list-inline-item">北洋銀行東京支店</li>
			                    <li class="list-inline-item">七十七銀行本店</li>
			                    <li class="list-inline-item">福岡銀行東京支店</li>
			                    <li class="list-inline-item">肥後銀行東京支店</li>
			                    <li class="list-inline-item">鹿児島銀行東京支店</li>
			                    <li class="list-inline-item">琉球銀行本店</li>
			                    <li class="list-inline-item">沖縄銀行本店</li>
			                  </ul>
			                </td>
			              </tr>
			            </tbody>
			          </table>

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
