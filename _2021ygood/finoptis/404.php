<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
get_header(); ?>
<?php get_template_part( 'inc/page-header/breadcrumbs-404'); ?>
<div class="page-error">
    <div class="container">
        <div id="content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">    
                    <section class="error-404 not-found">    
                        <div class="page-content">
                            <h3>                        
                                <?php
                                 if(!empty($finoptis_option['text_404'])){
                                     echo esc_html($finoptis_option['text_404']);
                                 }
                                 else{
                                  esc_html_e( 'Page Not Found', 'finoptis' ); }
                                 ?>
                            </h3>

                            <div class="bs-sidebar">
                                <?php get_search_form(); ?>
                            </div><!-- .bs-sidebar -->
                            <a href="<?php echo esc_url( home_url('/') ); ?>">
                                <?php
                                 if(!empty($finoptis_option['back_home'])){
                                     echo esc_html($finoptis_option['back_home']);
                                 }
                                 else{
                                     esc_html_e('OR BACK TO HOMEPAGE', 'finoptis'); 
                                  }
                                ?>
                            </a>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->    
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>   
</div> <!-- .page-error -->
<?php
get_footer();
