<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header(); ?>

<div id="rs-blog" class="rs-blog">
   <?php
    //checking blog layout form option  
    $col='';
    $blog_layout=''; 
    $column=''; 
    $blog_grid='';
    if(!empty($finoptis_option['blog-layout']) || !is_active_sidebar( 'sidebar-1' ))
      {
        $blog_layout=($finoptis_option['blog-layout']);
        $blog_grid=$finoptis_option['blog-grid'];
        $blog_grid = !empty($blog_grid) ? $blog_grid : '12';
        if($blog_layout == 'full' || !is_active_sidebar( 'sidebar-1' ))
          {
			$layout ='full-layout';
			$col    = '-full';
			$column = 'sidebar-none';  
          } 
          
        elseif($blog_layout == '2left')
          {
             $layout = 'full-layout-left';  
          }
    
        elseif($blog_layout == '2right')
          {
             $layout = 'full-layout-right'; 
          } 
        else{
			$col         = '';
			$blog_layout = ''; 
        }
      }
      else{
		$col         ='';
		$blog_layout =''; 
		$layout      ='';
		$blog_grid   ='';
      }
    ?>
  <div class="container">
    <div id="content">
      <div class="row">       
        <div class="col-md-9<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>"> 
        	<div class="row">
            	<?php
		            if ( have_posts() ) :           
		            /* Start the Loop */
		            while ( have_posts() ) : the_post();      
		         
		                $no_thumb = "";
		                if ( !has_post_thumbnail() ) {
		                  $no_thumb = "no-thumbs";
		                }
		            ?>
		            
                <div class="col-sm-<?php echo esc_attr($blog_grid);?> col-xs-12">
              	 	<article <?php post_class(); ?>>
	                    <div class="blog-item <?php echo esc_attr($no_thumb); ?>">

	                      <?php if ( has_post_thumbnail() ) {?>
	                        <div class="blog-img">
	                           <a href="<?php the_permalink();?>">
	                            <?php
	                              the_post_thumbnail();
	                            ?>
	                          </a>
	                          <div class="blog-img-content">
	                            <div class="display-table">
	                              <div class="display-table-cell">
	                                <a class="blog-link" href="<?php the_permalink();?>">
	                                  <i class="fa fa-link"></i>
	                                </a>               
	                              </div>
	                            </div>
	                          </div>
	                          <?php if(!empty($finoptis_option['blog-date'])):?>
	                            <div class="get_date_format">
	                                <div class="blog-date">
	                                   <div class="formated_date">
	                                       <span class="date"><?php echo get_the_date( 'd' )?>  </span> 
	                                       <span class="month"><?php echo get_the_date( 'M' )?></span>               
	                                   </div>
	                                </div>                                       
	                            </div>
	                            <?php else:?>
	                              <div class="get_date_format">
	                                <div class="blog-date img-date">
	                                   <div class="formated_date">
	                                       <div class="full-img-date"><?php $post_date = get_the_date(); echo esc_attr($post_date);?></div>             
	                                   </div>
	                                </div>                                       
	                            </div>
	                           <?php endif;?>     
	                        </div><!-- .blog-img -->
	                      <?php
	                        }?> 

	                        <div class="full-blog-content">
	                            <div class="title-wrap">
	                              <?php if(empty($finoptis_option['blog-date']) && !has_post_thumbnail() ): ?>
	                                  <div class="full-date">
	                                    <?php $post_date = get_the_date(); echo esc_attr($post_date);?>  
	                                  </div>
	                              <?php endif; ?>                            
	                              <h3 class="blog-title">
	                                  <a href="<?php the_permalink();?>">
	                                      <?php the_title();?>
	                                  </a>
	                              </h3>
	                              <div class="blog-meta">
	                                  <ul class="btm-cate">
	                                      <li>
	                                          <div class="author"> 
	                                             <?php           
	                                                echo esc_html__('By', 'finoptis')." ".get_the_author();
	                                              ?>
	                                          </div>
	                                      </li>

	                                      <?php if(get_the_category()){?>
	                                      <li>
	                                            <div class="category-name">
	                                              <span class="seperator">/</span>
	                                            <?php the_category(', '); ?>
	                                            </div>
	                                       </li> 
	                                      <?php }?>
	                                      
	                                    

	                                      <?php 
	                                        if(has_tag()): 
	                                      ?>
	                                        <li>
	                                          <?php
	                                            //tag add
	                                            $seperator = ', '; // blank instead of comma
	                                            $after = '';
	                                            $before = '';
	                                            echo '<div class="tag-line"><span class="seperator">/</span>';
	                                            echo esc_html__('Tags: ', 'finoptis');
	                                            the_tags( $before, $seperator, $after );
	                                            echo '</div>';
	                                          ?> 
	                                        </li>
	                                      <?php endif; ?>
	                                  </ul>                                                         
	                              </div>
	                          </div>

	                            <div class="blog-desc">   
	                              <p>
	                                <?php echo finoptis_wpex_get_excerpt ( ); ?>
	              
	                             </p>    
	                            </div>
	                            
	                          <?php if(!empty($finoptis_option['blog_readmore'])):?>
	                              <div class="blog-button">
	                                <a href="<?php the_permalink();?>">
	                                    <?php echo esc_html($finoptis_option['blog_readmore']); ?>
	                                  </a>
	                              </div>
	                          <?php endif; ?>

	                          <?php if(empty($finoptis_option['blog_readmore'])):?>
	                              <div class="blog-button">
	                                <a href="<?php the_permalink();?>"><?php esc_html_e('Continue Reading', 'finoptis');?></a>
	                              </div>
	                          <?php endif; ?>

	                        </div>
	                	</div>
              		</article>
                </div>           
        
      			<?php endwhile; ?>
  			</div>
      <div class="pagination-area">
        <?php
            the_posts_pagination();
          ?>
      </div>
      <?php
      else :
      get_template_part( 'template-parts/content', 'none' );
      endif; ?> 
  </div>
    <?php if( $layout != 'full-layout' ):     
       get_sidebar();    
     endif;
    ?>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();