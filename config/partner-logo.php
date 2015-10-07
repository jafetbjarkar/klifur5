<?php include('data.php'); ?>

<?php if($site=='klifur') : ?>
<div class="partner-logo">
  <p style="margin: 0 0 0 53px"><?php _e( 'In partnership with', 'klifur5' ); ?></p>
  <a href="http://isalp.is" target="_blank">
    <img src="<?php bloginfo('template_url'); ?>/images/isalp-logo.png" alt="Site partner" style="width: 260px">
  </a>
</div>

<?php elseif($site=='isalp') :  ?>
<div class="partner-logo">
  <p><?php _e( 'In partnership with', 'klifur5' ); ?></p>
  <a href="http://klifur.is" target="_blank">
    <img src="<?php bloginfo('template_url'); ?>/images/klifur-logo.svg" alt="Site partner">
  </a>
</div>

<?php endif; ?>
