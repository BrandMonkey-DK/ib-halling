  <?php
  $block_background_image = get_sub_field('block_background_image');
  if ($block_background_image) {
    $block_background_thumb = $block_background_image['sizes']['medium-image-square'];
  }
  ?>
  <div class="content-block editor-block col-lg<?php get_template_part('template-parts/block-settings'); ?>" <?php if ($block_background_image) : ?>style="background-image:url(<?php echo esc_url($block_background_thumb); ?>)" <?php endif; ?>>
    <?php the_sub_field('block_content'); ?>
  </div>