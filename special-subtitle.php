<?php
/*
Plugin Name: Special Subtitle
Description: A plugin to apply styles to blog post subtitles
Version: 1.1.3
Author: Riley Litchfield
Author URI: https://rileylitchfield.com
License: GPL2
*/

// Display the subtitle using the applied styling
function display_subtitle()
{
  // Loop over the checkbox values and add them to the styling variable if they exist
  $checkbox_values = get_field('text_emphasis');
  $styling = '';
  if ($checkbox_values) {
    if (in_array('bold', $checkbox_values)) {
      $styling .= 'font-weight: bold;';
    }
    if (in_array('italics', $checkbox_values)) {
      $styling .= 'font-style: italic;';
    }
    if (in_array('underline', $checkbox_values)) {
      $styling .= 'text-decoration: underline;';
    }
  }
  // Check if font size exists and add it to styling variable
  $special_font_size = get_field('special_font_size');
  if ($special_font_size) {
    $styling .= 'font-size:' . $special_font_size . 'px;';
  }
  // Get the special subtitle
  $special_subtitle = get_field('special_subtitle');
  // return the formatted subtitle
  return '<h2 style="' . $styling . '">' . $special_subtitle . '</h2>';
}
add_shortcode('display_subtitle', 'display_subtitle');