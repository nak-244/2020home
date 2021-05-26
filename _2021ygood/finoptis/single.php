<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $finoptis_option;
?>
<div class="container"> 
  <div id="content">
  <?php
      //checking page layout 
      $page_layout = get_post_meta( $post->ID, 'layout', true );
      $col_side ='';
      $col_letf ='';
      if($page_layout == '2left'){
        $col_side = '9';
        $col_letf = 'left-sidebar';}
      else if($page_layout == '2right'){
        $col_side = '9';}
      else{
        $col_side = '12';}
    ?>
  <!-- Blog Detail Start -->
  <div class="rs-blog-details pt-70 pb-70">
    <div class="row padding-<?php echo esc_attr( $col_letf) ?>">
      <div class="col-md-<?php echo esc_attr( $col_side). ' ' .esc_attr( $col_letf) ?>">
        <?php
         while ( have_posts() ) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
              get_template_part( 'template-parts/post/content', get_post_format() );          
             
            ?>
            <div class="clear-fix"></div>              
        </article> 
            
        <?php       
          $author_meta = get_the_author_meta('description'); 
          if( !empty($author_meta) ){
          ?>
            <div class="author-block">
              <div class="author-img"> <?php echo get_avatar(get_the_author_meta( 'ID' ), 200);?> </div>
              <div class="author-desc">
                <h3 class="author-title">
                  <?php the_author();?>
                </h3>
                <p>
                  <?php   
                    echo wpautop( get_the_author_meta( 'description' ) );
                  ?>
                </p>
                <a href="<?php echo esc_url(get_the_author_meta('user_url'))?>" target="_blank">
                  <?php echo esc_url(get_the_author_meta( 'user_url'))?></a> 
                </div>
            </div>
            <!-- .author-block -->
            <?php }
              get_template_part( 'pagination' );        
            ?>
        <?php 
          $blog_author = '';
          if($blog_author == ""){
            if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
          }
          else
          {
            $blog_author = $finoptis_option['blog-comments'];
            if($blog_author == 'show'){     
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
            }
          }
        endwhile; // End of the loop.
        ?>
      </div>
      <?php
        get_sidebar('single');
      ?>      
    </div>
  </div>
  <!-- Blog Detail End --> 
</div>
</div>
<!-- .container -->
<?php
get_footer();