<?php get_header(); ?>

<?php
$section_background_image = get_field('section_background_image');
if ($section_background_image) {
  $section_background_thumb = $section_background_image['sizes']['large-section-background'];
}

$header_title                                 = get_field('header_title');
$photography_dif_title                        = get_field('photography_dif_title');
$photography_title                            = get_field('photography_title');
$photography_text                             = get_field('photography_text');
$photography_desc_image                       = get_field('photography_desc_image');
$photography_desc_image_thumb                 = $photography_desc_image['sizes']['single-image-section'];
$photography_desc_title                       = get_field('photography_desc_title');
$photography_desc_text                        = get_field('photography_desc_text');
$photography_desc_button_text                 = get_field('photography_desc_button_text');
$photography_desc_button_link                 = get_field('photography_desc_button_link');
$link_target                                  = $photography_desc_button_link['target'] ? $photography_desc_button_link['target'] : '_self';
$photography_image_section_title              = get_field('photography_image_section_title');
$photography_image_section_text               = get_field('photography_image_section_text');
$photography_image_section_image_right        = get_field('photography_image_section_image_right');
$photography_image_section_image_right_thumb  = $photography_image_section_image_right['sizes']['second-image-section'];
$photography_image_section_image_under        = get_field('photography_image_section_image_under');
$photography_image_section_image_under_thumb  = $photography_image_section_image_under['sizes']['large-image-square'];

?>

<section class="photography<?php get_template_part('template-parts/section-settings'); ?>" <?php if ($section_background_image) : ?>style="background-image:url(<?php echo esc_url($section_background_thumb); ?>)" <?php endif; ?>>
  <div class="container header">
    <div class="row">
      <?php if($photography_dif_title == true) : ?>
        <h1 class="title"><?= $photography_title; ?></h1>
      <?php else : ?>
        <h1><?= get_the_title(); ?></h1>
      <?php endif; ?>
      <div class="text">
        <?= $photography_text; ?>
      </div>
      <div class="arrow-down">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icons/angle-down.svg" alt="">
      </div>
    </div>
  </div>

  <div class="container image-section">
    <div class="row">
      <div class="image-section-wrapper">
        <div class="col-6 image">
          <img src="<?= esc_url($photography_desc_image_thumb); ?>" alt="">
        </div>
        <div class="col-6 text">
          <div class="title">
            <?= $photography_desc_title; ?>
          </div>
          <div class="desc">
            <div class="text-desc"><?= $photography_desc_text; ?></div>
          </div>
          <a class="button-link" href="<?= $photography_desc_button_link; ?>" target="<?= $link_target; ?>">
            <?= $photography_desc_button_text; ?>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="container prices-container">
    <div class="row">
      <div class="prices-wrapper">
        <div class="title">
          <h2>Priser</h2>
        </div>
        <div class="prices">
          <?php if( have_rows('photography_prices') ): ?>
            <?php while( have_rows('photography_prices') ) : the_row();

            $photography_prices_title = get_sub_field('photography_prices_title');
            $photography_prices_desc = get_sub_field('photography_prices_desc');
            $photography_prices_price = get_sub_field('photography_prices_price');

            ?>

            <div class="col-4 price">
              <div class="title">
                <?= $photography_prices_title; ?>
              </div>
              <div class="desc">
                <?= $photography_prices_desc; ?>
              </div>
              <div class="single-price">
                <?= $photography_prices_price; ?> kr.
              </div>
            </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container second-image-section">
    <div class="row">
      <div class="wrapper">
          <div class="col-6 desc">
            <h5>
              <?= $photography_image_section_title; ?>
            </h5>
            <div class="text">
              <?= $photography_image_section_text; ?>
            </div>
          </div>
          <div class="col-6 image">
            <img src="<?= esc_url($photography_image_section_image_right_thumb); ?>" alt="">
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 full-size-image">
        <img src="<?= esc_url($photography_image_section_image_under_thumb); ?>" alt="">
      </div>
    </div>
  </div>
</section>

<?php include 'blocks/contact/contact.php'; ?>
<?= get_field('contact_mail'); ?>

<?php get_footer(); ?>