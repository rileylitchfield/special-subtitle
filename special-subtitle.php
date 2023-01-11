<?php
/*
Plugin Name: Special Subtitle
Description: A plugin to apply styles to blog post subtitles
Version: 1.3.4
Author: Riley Litchfield
Author URI: https://rileylitchfield.com
License: GPL2
*/

function set_styling()
{
  // Initialize styling variable
  $styling = '';
  // Loop over the checkbox values and add them to the styling variable if they exist
  $checkbox_values = get_field('text_emphasis');
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
  return $styling;
}

// Display the subtitle using the applied styling
function display_subtitle()
{
  $styling = set_styling();
  // Get the special subtitle
  $special_subtitle = get_field('special_subtitle');
  // return the formatted subtitle
  return '<h2 style="' . $styling . '">' . $special_subtitle . '</h2>';
}
add_shortcode('display_subtitle', 'display_subtitle');

// Load custom css file for post editor view
function custom_acf_backend_styles()
{
  $screen = get_current_screen();
  if ('post' === $screen->base) {
    wp_enqueue_style('custom-acf-backend-styles', plugin_dir_url(__FILE__) . 'styles/custom-acf-backend-styles.css');
  }
}
add_action('admin_head', 'custom_acf_backend_styles');