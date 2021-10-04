<!DOCTYPE html>

<html lang="en">

<head>

	
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	
	<?php $logo = get_field('logo','options'); ?>
	<div id="top" class="main-header">
		<div class="container-fluid narrow">
			<div class="row align-items-center">
				<div class="col-8 col-md-4 col-xl-3">
					<a href="/" class="branding">
					<?= ($logo ? echo_image($logo,'medium') : get_bloginfo('sitename')); ?>
				 	</a>
				</div>
				<div class="d-xl-none col order-lg-last">
					<button class="navbar-toggler" type="button" aria-label="Toggle navigation">
			    	<span>Menu</span> <i class="fas fa-bars"></i>
			  	</button></div>
				<div class="col-lg-auto col-xl-9">
					<div class="d-none d-xl-flex main-header-top">
						<?php get_template_part('templates/global/part','social'); ?>
						<?php get_template_part('templates/global/part','search'); ?>
						<?php get_template_part('templates/global/part','phone'); ?>
					</div>
					<div class="main-header-bottom">
						<?php get_template_part('templates/nav/nav','primary'); ?>
						<?php $btns = get_field('header_buttons','options'); if ($btns) :
							echo '<div class="buttons">';
							foreach ($btns as $btn) {echo echo_link($btn['link'], 'btn btn-primary');}
							echo '</div>';
						endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="#" id="back-to-top" class="back-to-top"><i class="fas fa-arrow-up"></i></a>
	<?php $phone = get_field('phone','options'); if ($phone) : ?>
	<a href="tel:<?= $phone;?>" id="phone-tab"><?= $phone;?> <i class="far fa-phone" aria-hidden="true"></i></a>
<?php endif; ?>
