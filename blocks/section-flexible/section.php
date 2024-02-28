<?php
$post_object = get_field('post_content');
if($post_object):
	// override $post
	$post = $post_object;
  setup_postdata($post); 

  $id = $post->ID;

$section_background_image = get_field('section_background_image', $id);
if ($section_background_image) {
  $section_background_thumb = $section_background_image['sizes']['large-image-square'];
}
$section_id = get_field('section_id', $id);
$layout = get_field('layout', $id);
?>

<?php if($layout == 'container-fluid-grid') : ?>
<section class="fluid-split-section-skeleton">
  <div class="container"></div>
</section>
<?php endif; ?>

<section class="content<?php get_template_part('template-parts/section-flexible-settings'); ?>" <?php if ($section_background_image) : ?>style="background-image:url(<?php echo esc_url($section_background_thumb); ?>)" <?php endif; ?> data-flexible-id="">
  <div class="<?php if (get_field('layout', $id)) : ?><?php echo get_field('layout', $id); ?><?php else : ?>container<?php endif; ?>">
    <div class="row<?php if (get_field('vertical_alignment', $id) && get_field('vertical_alignment', $id) != 'default') : ?> <?php echo get_field('vertical_alignment', $id); ?><?php endif; ?><?php if (get_field('horizontal_alignment', $id) && get_field('horizontal_alignment', $id) != 'default') : ?> <?php echo get_field('horizontal_alignment', $id); ?><?php endif; ?>">
    <?php get_blocks_flexible('content', $id); ?>
    </div>
  </div>
</section>
<?php endif; ?>