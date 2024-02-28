//////////////////////////////////////////////////////////// DOCUMENT READY ////////////////////////////////////////////////////////////


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
        $fluid_split_section_overflow_width = ($(window).width() - $fluid_split_section_skeleton_width) / 2;
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
        $(this).find($('.fluid-content-wrapper')).css('width', $fluid_split_section_calc_col_width - $padding + 12);
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

});
