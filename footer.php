<?php
  $addr = get_field('address','options');
  $phone = get_field('phone','options');
  $hours = get_field('hours','options');
  $logos = get_field('footer_logos','options');

  if ($logos) :
 ?>
 <div class="container-fluid footer-logos">
   <div class="row justify-content-between align-items-center">
     <?php foreach ($logos as $logo) : ?>
       <div class="col-6 col-md-auto">
         <?= ($logo['url'] ? '<a class="logo-wrapper" href="'.$logo['url'].'" target="_blank">' : '<div class="logo-wrapper">'); ?>
         <?= echo_image($logo['image']); ?>
         <?= ($logo['url'] ? '</a>' : '</div>'); ?>
       </div>
     <?php endforeach; ?>
   </div>
 </div>
<?php endif; ?>
<footer class="main-footer">
  <div class="container-fluid narrow">
    <div class="row">
      <div class="d-none d-xl-block col-md-2 nav-col">
        <?php get_template_part('templates/nav/nav','secondary'); ?>
      </div>
      <div class="col-xl-9">
        <div class="row footer-top">
          <div class="col-12 footer-return">
            <a href="#top">Return to top</a>
          </div>
          <div class="col-md">
            <?= ($addr ? '<address class="h3">'.$addr['street'].', '.$addr['city'].', '.$addr['state'].' '.$addr['zip'].'</address>' : ''); ?>
            <div class="main-phone">
            <?= ($hours ? '<div class="hours">'.$hours.'</div>' : ''); ?>
            <?= ($phone ? clean_phone($phone, true) : ''); ?>
            </div>
          </div>
          <?php $newsletter = get_field('newsletter','options'); if ($newsletter['form']) : ?>
            <div class="col-lg-4 text-center newsletter">
              <?= ($newsletter['title'] ? '<div class="h3">'.$newsletter['title'].'</div>' : ''); ?>
              <?= do_shortcode($newsletter['form']); ?>
            </div>
          <?php endif; ?>
          <div class="col-lg text-center">
            <?php get_template_part('templates/global/part','seo'); ?>
          </div>
        </div>
        <div class="row footer-bottom">
          <div class="col-lg">
            <?php get_template_part('templates/nav/nav','footer'); ?>
            <?php get_template_part('templates/global/part','compulse'); ?>
          </div>
          <div class="col-lg">
            <div class="footer-social">
              <div>Follow us on</div>
              <?php get_template_part('templates/global/part','social'); ?>
            </div>
          </div>
        </div>
      </div>
    </div><!-- / row -->

  </div><!-- container fluid -->
</footer>
<?php wp_footer(); ?>
<?php /* if (!is_user_logged_in()) : ?>
<script src="//www.apex.live/scripts/invitation.ashx?company=airventext" async></script>
<?php endif; */ ?>
</body>

</html>
