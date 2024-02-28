//////////////////////////////////////////////////////////// DOCUMENT READY ////////////////////////////////////////////////////////////

( function( $ ) {

  $(document).ready(function () {

    function fluidResizer() {

      // use a normal container as blueprint for finding the current width of the grid
      $fluid_split_section_skeleton_width = $('.fluid-split-section-skeleton').find($('.container')).outerWidth();

      $('.container-fluid-grid .row').each(function() {
        $counter = 1;
        // only make the resizing if there is 2 col
        if(this.childElementCount != 2) {
          return;
        }
        $($(this).find('[data-fluid-id]')).each(function() {
          if($counter == 1) {
            $(this).addClass('left');
          }
          if($counter == 2) {
            $(this).addClass('right');
          }
          $counter++;
          // calculate the width that extends the blueprint container width
          $fluid_split_section_overflow_width = ($('.is-root-container').width() - $fluid_split_section_skeleton_width) / 2;
          // get the col size of the col
          $fluid_split_section_col_size = $(this).data('col-size');
          // calculate the width of each col
          $fluid_split_section_calc_col_width = ($fluid_split_section_skeleton_width / 12) * $fluid_split_section_col_size;
          // calculate the width of each col including overflow width
          $fluid_split_section_calc_col_width_with_overflow = $fluid_split_section_calc_col_width + $fluid_split_section_overflow_width;
          // set col width
          $(this).css('width', $fluid_split_section_calc_col_width_with_overflow);
          // set col content width (grid alignment)
          $fluid_content_wrapper = $(this).find($('.fluid-content-wrapper'));
          $padding_left = parseInt($(this).css('padding-left'));
          $padding_right = parseInt($(this).css('padding-right'));
          $padding = $padding_left + $padding_right;
          $(this).find($('.fluid-content-wrapper')).css('width', $fluid_split_section_calc_col_width - $padding + 7.5);
        });
      })
    }

    fluidResizer();

    window.onresize = function() {
      fluidResizer();
    };

    // -----------------------------------------------------------------
    // -----------------------------------------------------------------
    // -----------------------------------------------------------------

    $('body').on('click', '.acf-tab-button', function() {
      // show reset view block when clicking a tab
      $('.view-control-reset').css('display', 'flex');

      // behaviour for each tab
      if($(this).is(':contains("Paddings")')) {
        console.log('x');
        $('.is-root-container').css('max-width', '100%');
      }
      if($(this).is(':contains("1200")')) {
        $('.is-root-container').css('max-width', 1199);
        $('.is-root-container').css('margin', 'auto');
      }
      if($(this).is(':contains("992")')) {
        $('.is-root-container').css('max-width', 991);
        $('.is-root-container').css('margin', 'auto');
      }
      if($(this).is(':contains("768")')) {
        $('.is-root-container').css('max-width', 767);
        $('.is-root-container').css('margin', 'auto');
      }
      if($(this).is(':contains("576")')) {
        $('.is-root-container').css('max-width', 575);
        $('.is-root-container').css('margin', 'auto');
      }
    });

    $(window).on('load', function() {
      $('.editor-styles-wrapper').prepend('<div class="view-controls-wrapper"><div class="view-control-zoom-in disabled"></div><div class="view-control-zoom-out"></div><div class="view-control-reset disabled">Reset view</div></div>')
      fluidResizer();
    });

    $('body').on('click', '.view-control-reset', function() {
      $('.is-root-container').css('max-width', '100%');
      $('.is-root-container').css('zoom', 1);
      $('.view-control-zoom-in').addClass('disabled');
      $('.view-control-zoom-out').removeClass('disabled');
      $(this).addClass('disabled');
      fluidResizer();
    });

    $('body').on('click', '.view-control-zoom-in', function() {
      let currentZoom = parseFloat($('.is-root-container').css('zoom'));
      let newZoom = currentZoom + 0.1;
      if(newZoom == 1) {
        $(this).addClass('disabled');
        $('.view-control-reset').addClass('disabled');
      } else {
        $(this).removeClass('.disabled');
      }
      $('.is-root-container').css('zoom', newZoom);
      $('.view-control-zoom-out').removeClass('disabled');
      fluidResizer();
    });

    $('body').on('click', '.view-control-zoom-out', function() {
      let currentZoom = parseFloat($('.is-root-container').css('zoom'));
      let newZoom = currentZoom - 0.1;
      if(newZoom == 0.5) {
        $(this).addClass('disabled');
      } else {
        $(this).removeClass('.disabled');
      }
      $('.is-root-container').css('zoom', newZoom);
      $('.view-control-reset').removeClass('disabled');
      $('.view-control-zoom-in').removeClass('disabled');
      fluidResizer();
    });

  });

} ) ( jQuery );