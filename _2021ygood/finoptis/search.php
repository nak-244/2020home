<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header(); ?>
<?php get_template_part( 'inc/page-header/breadcrumbs-search'); ?> 
<div class="container">
    
    <div id="content">
        <div class="row">
            <section id="primary" class="content-area col-lg-9 col-md-9 col-sm-12">
            	<main id="main" class="site-main">
            		<?php
            			if ( have_posts() ) :
            				
            				/* Start the Loop */
            				while ( have_posts() ) : the_post();
            					/**
            					 * Run the loop for the search to output the results.
            					 * If you want to overload this in a child theme then include a file
            					 * called content-search.php and that will be used instead.
            					 */
            					get_template_part( 'template-parts/content', 'search' );
            				endwhile;?>			
            				<div class="pagination-area">
            			      <?php
            			          the_posts_pagination();
            			        ?>
            			    </div>
            				<?php else :
            					get_template_part( 'template-parts/content', 'none' );
            			endif;
            		?>
            	</main><!-- #main -->
            </section><!-- #primary -->
            <?php 
                get_sidebar();
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php
//get_sidebar();
get_footer();