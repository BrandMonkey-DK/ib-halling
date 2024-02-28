<?php
$section_background_image = get_field('section_background_image');
if ($section_background_image) {
  $section_background_thumb = $section_background_image['sizes']['large-section-background'];
}

$layout = get_field('layout');
?>

<?php if($layout == 'container-fluid-grid') : ?>
<section class="fluid-split-section-skeleton">
  <div class="container"></div>
</section>
<?php endif; ?>

<section class="content<?php get_template_part('template-parts/section-settings'); ?>" <?php if ($section_background_image) : ?>style="background-image:url(<?php echo esc_url($section_background_thumb); ?>)" <?php endif; ?>>
  <div class="<?php if (get_field('layout')) : ?><?php echo get_field('layout'); ?><?php else : ?>container<?php endif; ?>">
    <div class="row<?php if (get_field('vertical_alignment') && get_field('vertical_alignment') != 'default') : ?> <?php echo get_field('vertical_alignment'); ?><?php endif; ?><?php if (get_field('horizontal_alignment') && get_field('horizontal_alignment') != 'default') : ?> <?php echo get_field('horizontal_alignment'); ?><?php endif; ?>">
      <?php get_blocks(); ?>
    </div>
  </div>
</section>