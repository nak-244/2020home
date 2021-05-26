<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  return;}
?>
<div class="col-md-3">
  <aside id="secondary" class="widget-area">
    <div class="bs-sidebar dynamic-sidebar">
      <?php
        dynamic_sidebar( 'sidebar-1' );
      ?>
    </div>
  </aside>
  <!-- #secondary --> 
</div>
<?php
?>
