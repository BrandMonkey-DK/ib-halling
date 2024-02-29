<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <nav class="site-navigation">
    <div class="container">
      <div class="row">
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
                'theme_location' => 'primary',
                'container' => 'ul',
                'menu_class' => 'navbar-nav',
              )
            );
            ?>
            <a href="https://www.instagram.com/ib_halling_fotografi/" target="_blank">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
          <div class="modal">
            <div class="row">
              <?php
              wp_nav_menu(
                array(
                  'menu' => 'Fotografering',
                  'container' => 'ul',
                  'menu_class' => 'fotografering-nav',
                )
              );
              ?>
            </div>
          </div>
          <div class="hamburger">
            <span class="toggler">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </nav>