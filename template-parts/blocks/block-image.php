<?php $image = get_sub_field('image'); ?>
<?php if ($image) : ?>
  <?php $image_alt = $image['alt']; ?>
  <?php $image_thumb = $image['sizes']['medium-image-square']; ?>
  <div class="content-block image-block col-lg<?php get_template_part('template-parts/block-settings'); ?>">
    <img src="<?php echo esc_url($image_thumb); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
  </div>
<?php endif; ?>