<?php

// #################### SPACING ####################
$spacing = ' ';

// #################### BLOCK SETTINGS ####################

// Width
$block_width = get_sub_field('block_width');
if ($block_width) {
  if ($block_width != 'custom') {
    echo '-';
    echo $block_width;
  } else {
    $block_width_extended = get_sub_field('block_width_extended');
    if ($block_width_extended != 'auto') {
      echo '-';
      echo $block_width_extended;
    }
  }
}

// Offset
$block_offset = get_sub_field('block_offset');
if ($block_offset) {
  if ($block_offset == 'custom') {
    $block_offset_extended = get_sub_field('block_offset_extended');
    echo $spacing;
    echo 'offset-lg-';
    echo $block_offset_extended;
  } else if ($block_offset != 'none') {
    echo $spacing;
    echo 'offset-lg-';
    echo $block_offset;
  }
}

// Background
$block_background = get_sub_field('block_background');
if ($block_background) {
  echo $spacing;
  echo $block_background;
}

// Padding
$block_padding_array = [
  'all' => [],
  'xl' => [],
  'lg' => [],
  'md' => [],
  'sm' => [],
];

$block_paddings = get_sub_field('block_paddings_all');
$block_paddings_xl = get_sub_field('block_paddings_xl');
$block_paddings_lg = get_sub_field('block_paddings_lg');
$block_paddings_md = get_sub_field('block_paddings_md');
$block_paddings_sm = get_sub_field('block_paddings_sm');

if($block_paddings) {
  array_push($block_padding_array['all'], $block_paddings);
}

if($block_paddings_xl) {
  array_push($block_padding_array['xl'], $block_paddings_xl);
}

if($block_paddings_lg) {
  array_push($block_padding_array['lg'], $block_paddings_lg);
}

if($block_paddings_md) {
  array_push($block_padding_array['md'], $block_paddings_md);
}

if($block_paddings_sm) {
  array_push($block_padding_array['sm'], $block_paddings_sm);
}


foreach($block_padding_array as $key => $value) {
  if ($value) {
    if ($value[0] == 'none') {
      echo $spacing;
      echo $key.'-p-';
      echo $value[0];
    } else if ($value[0] == 'various') {
      $block_padding_top = get_sub_field('block_padding_top_'.$key);
      echo $spacing;
      echo $key.'-p-top-';
      echo $block_padding_top;
      $block_padding_bottom = get_sub_field('block_padding_bottom_'.$key);
      echo $spacing;
      echo $key.'-p-bottom-';
      echo $block_padding_bottom;
      $block_padding_left = get_sub_field('block_padding_left_'.$key);
      echo $spacing;
      echo $key.'-p-left-';
      echo $block_padding_left;
      $block_padding_right = get_sub_field('block_padding_right_'.$key);
      echo $spacing;
      echo $key.'-p-right-';
      echo $block_padding_right;
    } else if ($value[0] == 'inherit') {
      
    } else {
      echo $spacing;
      echo $key.'-p-y-';
      echo $value[0];
    }
  }
}