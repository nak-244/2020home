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
			<table>

							<tbody>
								<tr>
								<th>職種</th>
								<td><a href="https://sigotora.jp/index.cfm?fuseaction=job.joblist&amp;srh_jobtype_param=12&amp;srh_jobtype_child_param=94">調理師</a>(病院での調理師　栄養士　100食　リニューアル)</td>
							</tr>

							<tr>
								<th>勤務形態</th>
								<td><a href="https://sigotora.jp/index.cfm?fuseaction=job.joblist&amp;srh_shift_param=1">派遣</a></td>
							</tr>

							<tr>
								<th>勤務地</th>
								<td><a href="https://sigotora.jp/index.cfm?fuseaction=job.joblist&amp;srh_ken_param=11">埼玉県</a> <a href="https://sigotora.jp/index.cfm?fuseaction=job.joblist&amp;srh_city_param=11235">富士見市</a></td>
							</tr>

							<tr>
								<th>最寄駅</th>
								<td>徒歩20分　※車通勤可</td>
							</tr>

							<tr>
								<th>時給</th>
								<td>1,360円～<br></td>
							</tr>

							<tr>
								<th>仕事内容</th>
								<td>☆調理師・栄養士スタッフ募集★☆<br>病院の厨房にて、配膳や盛り付け・仕込み・洗浄などの調理補助業務をお願いします。<br>ご利用になる多くの方に温かい食事を素早く提供できるよう、工夫を凝らした業務をお願いします。<br><br>【業務詳細】<br>・調理師・栄養士業務<br>・配膳や盛り付け・仕込み等をお任せします！<br>・その他、付随する業務（洗浄･清掃等）！</td>
							</tr>

							<tr>
								<th>さらに詳しく</th>
								<td>入職前に細菌検査と健康診断（直近3カ月以内のもの）の提出があります。</td>
							</tr>

							<tr>
								<th>勤務時間</th>
								<td>05時00分 ～ 14時30分<br>10時30分 ～ 20時00分<br></td>
							</tr>

							<tr>
								<th>休憩時間</th>
								<td>90分</td>
							</tr>

							<tr>
								<th>休日</th>
								<td>月,火,水,木,金,土,日</td>
							</tr>

							<tr>
								<th>交通費</th>
								<td>あり</td>
							</tr>

							<tr>
								<th>研修</th>
								<td>有り</td>
							</tr>

							<tr>
								<th>経験など</th>
								<td>【資格】<br>調理師免許<br>栄養士免許</td>
							</tr>

							<tr>
								<th>勤務期間</th>
								<td>３ヶ月以上</td>
							</tr>

							<tr>
								<th>こだわり条件</th>
								<td>日払いOK<br>経験者のみ</td>
							</tr>

							<tr>
								<th>待遇/福利厚生</th>
								<td>◆お給料は、日払い・週払い・月払から自由に選択可能☆ <br>◆残業代支給（時給1.25倍※1日8h以上、週40h以上が対象） <br>◆休日手当支給（時給1.35倍※月曜起算の週7日目が対象） <br>◆昇給有 <br>◆有給休暇 <br>◆社保完備（健康保険、雇用保険、厚生年金) <br>◆関東ITソフトウェア健康保険組合 <br>・社会保険料率が安い※政府管掌健康保険比較 <br>・付加給付が充実！（病気怪我の給付や出産育児付加金等） <br>・提携スポーツクラブの利用割引 <br>・格安の保養施設、旅行パックの割引制度</td>
							</tr>

							<tr>
								<th>応募先企業</th>
								<td>株式会社オープンループパートナーズ （本社）メディカル新宿</td>
							</tr>

							<tr>
								<th>応募連絡先</th>
								<td>採用担当</td>
							</tr>

							<tr>
								<th>お問い合わせ先</th>
								<td>medical_navi@openloop.co.jp</td>
							</tr>

							<tr>
								<th>面接会場</th>
								<td>・メディカル新宿：東京都新宿区新宿4-3-17 FORECAST新宿SOUTH 7階<br><a href="http://yahoo.jp/D-anb0" style="text-indent:0px; height:0px;" target="_blank">【マップ】</a><br></td>
							</tr>

							<tr>
								<th>ホームページ</th>
								<td><a href="https://olp-medical.jp/" target="_blank">https://olp-medical.jp/</a></td>
							</tr>

							<tr>
								<th>勤務条件</th>
								<td>週5日～5日 (土日必須)<br></td>
							</tr>

			</tbody></table>

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
