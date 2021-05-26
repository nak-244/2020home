<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
  <header class="entry-header">
    <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    </header>
    <!-- .entry-header -->
    
    <div class="entry-summary">
      <p><?php the_excerpt(); ?></p>
        <div class="blog-button">
            <a href="<?php the_permalink()?>" class="readon"><?php echo esc_html_e('Read More','finoptis');?></a>
          </div>
      </div>
    <!-- .entry-summary -->
    
   
    <!-- .entry-footer --> 
</article>
