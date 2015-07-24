<?php global $site; ?>

<?php if($site=='klifur') : ?>
<div class="partner-logo">
  <p>Í samstarfi við</p>
  <a href="http://isalp.is">
    <img src="<?php bloginfo('template_url'); ?>/images/isalp-logo.svg" alt="Site partner">
  </a>
</div>

<?php elseif($site=='isalp') :  ?>
<div class="partner-logo">
  <p>Í samstarfi við</p>
  <a href="http://klifur.is">
    <img src="<?php bloginfo('template_url'); ?>/images/klifur-logo.svg" alt="Site partner">
  </a>
</div>

<?php endif; ?>
