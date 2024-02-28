<?php
  $col_width = get_sub_field('block_width');
  if($col_width == 'custom') {
    $col_width = get_sub_field('block_width_extended');
  }

  $block_background_image = get_sub_field('block_background_image');
  if ($block_background_image) {
    $block_background_thumb = $block_background_image['sizes']['medium-image-square'];
  }

  // check for parent section ID in case of flexible sections
  if (isset($args['parent_section_id'])) {
    $parent_section_id = $args['parent_section_id'];
    $layout = get_field('layout', $parent_section_id);
  } else {
    $layout = get_field('layout');
  }
  ?>

  <div class="content-block editor-block col-lg<?php get_template_part('template-parts/block-settings'); ?><?= ($layout == 'container-fluid-grid') ? ' fluid-split-section-item' : '' ?>" style="<?php if ($block_background_image) : ?>background-image:url(<?php echo esc_url($block_background_thumb); ?>);<?php endif; ?>"<?= ($layout == 'container-fluid-grid') ? " data-fluid-id='fluid-id-".rand()."'" : '' ?><?= ($layout == 'container-fluid-grid') ? " data-col-size='".$col_width."'" : '' ?>>
    <?php if($layout == 'container-fluid-grid') : ?>
    <div class="fluid-content-wrapper">
    <?php endif; ?>
    <?php the_sub_field('block_content'); ?>
    <?php if($layout == 'container-fluid-grid') : ?>
    </div>
    <?php endif; ?>
  </div>