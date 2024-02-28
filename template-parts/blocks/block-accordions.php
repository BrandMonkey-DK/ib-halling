  <div class="content-block accordion-block col-lg<?php get_template_part('template-parts/block-settings'); ?>">
    <?php if (have_rows('block_accordion')) : ?>
      <div class="accordions">
        <?php while (have_rows('block_accordion')) : the_row(); ?>
          <div class="accordion">
            <div class="accordion-header">
              <p><?php echo get_sub_field('accordion_title'); ?></p>
              <div class="icon">
                <span class="arrow"></span>
              </div>
            </div>
            <div class="accordion-content">
              <div class="content">
                <p>
                  <?php echo get_sub_field('accordion_content'); ?>
                </p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>