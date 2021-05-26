<!-- post_list contents -->
<div class="news_lists">
	<?php
	$args = array( 'posts_per_page' => 5, // ←載せたい投稿記事の数
	// 'category_name' => 'topics',);// ←載せたいカテゴリー名を選択
	'cat=1,40,41,42');// ←載せたいカテゴリー名を選択
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ):
	?>
	<?php
	while ( $the_query->have_posts() ): $the_query->the_post();
	?>

	<?php
	$cat = get_the_category(); // カテゴリー取得
	$catname = $cat[ 0 ]->cat_name;
	$catslug = $cat[ 0 ]->slug;
	$catId = $cat[ 0 ]->cat_ID; // ID取得
	$category = get_the_category();
	$link = get_category_link( $catId ); // リンクURL取得
	?>

	<article class="news_list <?php echo $catslug; ?>">
		<div class="list__body">
			<!--日時-->
			<span class="list__date">
				<?php the_time('Y.m.d'); ?>　
			</span>
			<!--カテゴリー-->
			<span class="list__category list__<?php echo $catslug; ?>">
				<a href="<?php echo esc_url( $link ); ?>">
					<?php echo $catname; ?>
				</a>
			</span>
			<!--記事タイトル-->
			<div class="list__title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</div>
			<!--記事サムネイル-->
			<div class="list__thumb">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('full'); ?>
				</a>
			</div>
		</div>
	</article>
	<?php
	endwhile;
	endif;
	// 投稿データをリセット
	wp_reset_postdata();
	?>
</div>
