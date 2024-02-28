<footer>
  <div class="container">
    <div class="row padding-y-small">
      <div class="col logo">
        <a class="d-block" href="<?php echo get_site_url(); ?>" target="_self">
          <?php
          if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
          } else {
            echo '<div class="site-name">' . get_bloginfo('name') . '</div>';
          }
          ?>
        </a>
      </div>
      <div class="col navigation">
        <div class="nav-menu">
          <?php
          wp_nav_menu(

            array(
              'theme_location' => 'footer',
              'container' => 'ul',
              'menu_class' => 'navbar-nav',
            )
          );
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid bg-color-light-grey">
    <div class="row">
      <div class="col text-center padding-y-mini">
        <span>© <?php echo date("Y"); ?>. <?php echo get_bloginfo('name'); ?>. All Rights Reserved.</span>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
