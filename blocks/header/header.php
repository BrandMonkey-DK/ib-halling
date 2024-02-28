<?php
$section_background_image = get_field('section_background_image');
if ($section_background_image) {
  $section_background_thumb = $section_background_image['sizes']['large-section-background'];
}

$header_left_image = get_field('header_left_image');
$header_left_image_url = $header_left_image['url'];

$header_right_image = get_field('header_right_image');
$header_right_image_url = $header_right_image['url'];

$header_title = get_field('header_title');

?>

<section class="header<?php get_template_part('template-parts/section-settings'); ?>" <?php if ($section_background_image) : ?>style="background-image:url(<?php echo esc_url($section_background_thumb); ?>)" <?php endif; ?>>
  <div class="container">
    <div class="row">
      <div class="col-6 left p-0">
        <img src="<?= $header_left_image_url; ?>" alt="">
      </div>
      <div class="col-6 right p-0">
        <img src="<?= $header_right_image_url; ?>" alt="">
      </div>
      <div class="header-title">
        <?= $header_title; ?>
      </div>
    </div>
  </div>
</section>