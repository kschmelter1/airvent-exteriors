<?php
$phone = get_field('phone','options');
$hours = get_field('hours','options');
if ($phone || $hours) :
?>
<div class="main-phone">
  <?= ($phone ? '<i class="fal fa-phone-alt"></i>' : ''); ?>
  <div>
    <?= ($hours ? '<div class="hours">'.$hours.'</div>' : ''); ?>
    <?= ($phone ? clean_phone($phone, true) : ''); ?>
  </div>
</div>
<?php endif; ?>
