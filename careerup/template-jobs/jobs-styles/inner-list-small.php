<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

$author_id = $post->post_author;
$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
$types = get_the_terms( $post->ID, 'job_listing_type' );
$address = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'address', true );
$salary = WP_Job_Board_Job_Listing::get_salary_html($post->ID);

?>
<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('job-list job-list-small'); ?>>
    <div class="flex-sm">
        <div class="employer-logo flex-middle hidden-xs">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php if ( has_post_thumbnail($employer_id) ) { ?>
                    <?php echo get_the_post_thumbnail( $employer_id, 'thumbnail' ); ?>
                <?php } else { ?>
                    <img src="<?php echo esc_url(careerup_placeholder_img_src()); ?>" alt="<?php echo esc_attr(get_the_title($employer_id)); ?>">
                <?php } ?>
            </a>
        </div>
        <div class="job-information flex-middle">
            <div class="inner">
                <?php if ( $types ) { ?>
                    <?php foreach ($types as $term) { ?>
                        <a class="text-theme type-job" href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php } ?>
                <?php } ?>

                <div class="job-title-wrapper">
                    <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </div>

                <div class="job-metas">
                    <?php if ( $address ) { ?>
                        <div class="job-location"><i class="flaticon-location-pin"></i><?php echo wp_kses_post($address); ?></div>
                    <?php } ?>
                    <?php if ( $salary ) { ?>
                        <div class="job-salary"><i class="flaticon-price"></i><?php echo wp_kses_post($salary); ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php careerup_job_display_urgent_icon($post); ?>
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>