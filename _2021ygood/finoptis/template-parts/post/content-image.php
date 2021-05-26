<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>

<?php if(has_post_thumbnail()):
?>
	<div class="bs-img">
	  <?php the_post_thumbnail()?>
	</div>
<?php
endif;?>
<div class="single-content-full">
<div class="bs-info">
	 <ul class="bs-meta">
	  	<li><i class="fa fa-user"></i> <?php echo esc_html__('By', 'finoptis')." ".get_the_author(); ?> </li>
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
	<?php if ( is_single() || '' === get_the_post_thumbnail() ) {

		// Only show content if is a single post, or if there's no featured image.
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
		) 
	 );

	};
?>
</div>
</div>