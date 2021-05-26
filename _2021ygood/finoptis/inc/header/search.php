<?php
global $finoptis_option;
//search page here
if(!empty($finoptis_option['off_search'])):
     $sticky_search = $finoptis_option['off_search'];
else:
    $sticky_search ='';
endif;

 if($sticky_search == '1'):
 ?>
<div class="sticky_search"> 
  <i class="fa fa-search"></i> 
</div>
<div class="sticky_form">
  <?php get_search_form(); ?>
</div>
<?php endif; ?>

