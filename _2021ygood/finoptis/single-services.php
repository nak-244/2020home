<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package finoptis
 */

get_header(); ?>
</div>
</div>
<!-- Main content Start -->

<div class="main-content"> 
  
<!-- Portfolio Detail Start -->
<div class="rs-porfolio-details">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
  </div>
</div>
<!-- Portfolio Detail End -->
<?php
get_footer();