<?php
$section_background_image = get_field('section_background_image');
if ($section_background_image) {
  $section_background_thumb = $section_background_image['sizes']['large-section-background'];
}

$contact_image = get_field('contact_image');
$contact_image_url = $contact_image['url'];

$contact_title = get_field('contact_title');
$contact_address = get_field('contact_address');
$contact_phonenumber = get_field('contact_phonenumber');
$contact_mail = get_field('contact_mail');
$contact_shortcode = get_field('contact_shortcode');

?>

<section class="contact<?php get_template_part('template-parts/section-settings'); ?>" <?php if ($section_background_image) : ?>style="background-image:url(<?php echo esc_url($section_background_thumb); ?>)" <?php endif; ?>>
  <div class="container">
    <div class="row">
      <div class="col-3 p-0 portrait">
        <div class="portrait-img" style="background-image:url(<?= $contact_image_url; ?>);"></div>
      </div>
      <div class="col-2 p-0 contact-info">
        <div class="title">
          <?= $contact_title; ?>
        </div>
        <div class="address">
          <?= $contact_address; ?>
        </div>
        <div class="phone">
          <a href="tel:<?= $contact_phonenumber; ?>">
            <?= $contact_phonenumber; ?>
          </a>
        </div>
        <div class="mail">
          <a href="mailto:<?= $contact_mail; ?>">
            <?= $contact_mail; ?>
          </a>
        </div>
        <div class="socials">
          <?php if( have_rows('contact_social_media') ): ?>
            <?php while( have_rows('contact_social_media') ) : the_row();

            $social_media_icon = get_sub_field('social_media_icon');
            $social_media_link = get_sub_field('social_media_link');
            $social_media_link_url = $social_media_link['url'];
            $social_media_link_target = $social_media_link['target'] ? $social_media_link['target'] : '_self';
            ?>

            <a href="<?= $social_media_link_url; ?>" target="<?= $social_media_link_target; ?>">
              <?= $social_media_icon; ?>
            </a>

            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-3 p-0 contact-formular">
        <div>
          <?php echo do_shortcode($contact_shortcode); ?>
        </div>
      </div>
      <div class="header-title">
        <?= $header_title; ?>
      </div>
    </div>
  </div>
</section>