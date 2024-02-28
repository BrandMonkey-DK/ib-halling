<?php

// #################### SPACING ####################
$spacing = ' ';

// #################### SECTION SETTINGS ####################

// Background color
$section_background = get_field('section_background');
if ($section_background) {
  echo $spacing;
  echo $section_background;
}

// Padding
$section_padding_array = [
  'all' => [],
  'xl' => [],
  'lg' => [],
  'md' => [],
  'sm' => [],
];

$section_paddings = get_field('section_paddings_all');
$section_paddings_xl = get_field('section_paddings_xl');
$section_paddings_lg = get_field('section_paddings_lg');
$section_paddings_md = get_field('section_paddings_md');
$section_paddings_sm = get_field('section_paddings_sm');

if($section_paddings) {
  array_push($section_padding_array['all'], $section_paddings);
}

if($section_paddings_xl) {
  array_push($section_padding_array['xl'], $section_paddings_xl);
}

if($section_paddings_lg) {
  array_push($section_padding_array['lg'], $section_paddings_lg);
}

if($section_paddings_md) {
  array_push($section_padding_array['md'], $section_paddings_md);
}

if($section_paddings_sm) {
  array_push($section_padding_array['sm'], $section_paddings_sm);
}

foreach($section_padding_array as $key => $value) {
  if ($value) {
    if ($value[0] == 'none') {
      echo $spacing;
      echo $key.'-p-';
      echo $value[0];
    } else if ($value[0] == 'various') {
      echo $spacing;
      echo $key.'-p-top-';
      echo get_field('section_padding_top_'.$key);
      echo $spacing;
      echo $key.'-p-bottom-';
      echo get_field('section_padding_bottom_'.$key);
    } else if ($value[0] == 'inherit') {

    } else {
      echo $spacing;
      echo $key.'-p-y-';
      echo $value[0];
    }
  }
}