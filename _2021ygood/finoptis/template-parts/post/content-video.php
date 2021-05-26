<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<?php if ( '' !== get_the_post_thumbnail() && ! is_single() && empty( $video ) ) : ?>
		<div class="bs-img">
		  <?php the_post_thumbnail()?>
          
        </div>
    <?php endif; ?>    
<div class="single-content-full">   

	<div class="bs-info">
	  <ul class="bs-meta">
  	<li><i class="fa fa-user"></i> <?php the_author(); ?> </li>
    <li><i class="fa fa-calendar"></i><span> <?php $post_date = get_the_date(); echo esc_attr($post_date);?></span></li>
    <?php if(get_the_category()){?>
          <li class="category-name"><i class="fa fa-folder-open-o"></i>
            <?php the_category(', '); 
          ?>
        </li>
      <?php }?>

      <li>
         <?php 
              if(has_tag()){
                //tag add
                $seperator = ', '; // blank instead of comma
                $after = '';
                echo '<div class="tag-line">';
                esc_html( 'Tags: ', 'finoptis' );
                the_tags( '', $seperator, $after );
                echo '</div>';
              }
            ?> 
        </li>
  </ul>
	</div>
 <div class="bs-desc">
	<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$video = false;

		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
	?>

	<?php
	if ( ! is_single() ) {

		// If not a single post, highlight the video file.
		if ( ! empty( $video ) ) {
			foreach ( $video as $video_html ) {
				echo '<div class="entry-video">';
					echo esc_attr($video_html);
				echo '</div>';
			}
		};

	};

	if ( is_single() || empty( $video ) ) {

		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'finoptis' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'finoptis' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
	};
	?>
</div>
</div>