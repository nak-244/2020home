<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
global $finoptis_option;
?>


<?php
    $post_date_day=get_the_date('d'); 
    $post_date_month=get_the_date('M');  
    $full_date=get_the_date();  
?>



<?php if(has_post_thumbnail()){
?>
<?php //header style; ?>
<div class="bs-img">
  <?php the_post_thumbnail()?>

  <?php if(!empty($finoptis_option['blog-date'])):?>
  <div class="blog-date">
      <span class="date"><?php echo esc_html($post_date_day);?></span>
      <span class="month"><?php echo esc_html($post_date_month);?></span> 
  </div>
  <?php endif; ?>

</div>
<?php
 }?>

<?php if(!has_post_thumbnail()){
  if(!empty($finoptis_option['blog-date'])):?>
    <div class="full-date"><?php echo esc_html($full_date);?></div>
  <?php endif;
}?>

<div class="single-content-full">
<div class="bs-info single-page-info">
    <ul class="bs-meta">

        <?php if(get_the_author()){?>
        <li>
            <span class="p-user">
                <span class="author-name"><?php echo esc_html__('By', 'finoptis')." ".get_the_author(); ?></span>
            </span>
        </li>
        <?php }?>

        <?php if(empty($finoptis_option['blog-date'])):?>
        <li>
            <span class="seperator">/</span>
            <span class="p-date">
                <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
            </span>
        </li>
        <?php endif; ?>


        <?php if(get_the_category()){?>
          <li class="category-name">
              <span class="seperator">/</span>
              <span class="p-cname">
                  <?php the_category(', '); ?>            
              </span>
          </li>
        <?php } ?>


        <li>
         <?php 
              if(has_tag()){
                //tag add
                $seperator = ', '; // blank instead of comma
                $after = '';
                echo '<div class="tag-line"> <span class="seperator">/ </span>';
                echo esc_html( 'Tags: ', 'finoptis' );
                the_tags( '', $seperator, $after );
                echo '</div>';
              }
            ?> 
        </li>
    </ul>  
</div>

<div class="bs-desc">
<?php
      the_content( sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'finoptis' ),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        get_the_title()
      ) );

      wp_link_pages( array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'finoptis' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
      ) );
    ?>
</div>
</div>
