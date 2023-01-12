<?php
/*
Plugin Name: Special Subtitle
Description: A plugin to apply styles to blog post subtitles
Version: 1.5.0
Author: Riley Litchfield
Author URI: https://rileylitchfield.com
License: GPL2
*/

// Load jQuery and custom js file
function add_jquery_script()
{
  wp_enqueue_script('custom-acf-jquery', plugin_dir_url(__FILE__) . 'js/custom-acf-jquery.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'add_jquery_script');


// Get values from ACF fields and set styling variables
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
  return '<div id="special-subtitle">
  <h2 style="' . $styling . '">' . $special_subtitle . '</h2>
  <button id="special-button">Toggle Content</button>
  </div>';
}
add_shortcode('display_subtitle', 'display_subtitle');

// Load custom css for backend
function enqueue_custom_css_backend()
{
  $screen = get_current_screen();
  if ('post' === $screen->base) {
    wp_enqueue_style('custom-acf-backend-styles', plugin_dir_url(__FILE__) . 'styles/backend/custom-acf-backend-styles.css');
  }
}
add_action('admin_head', 'enqueue_custom_css_backend');

// Load custom css for frontend 
function enqueue_custom_css_frontend()
{
  wp_enqueue_style('custom-acf-frontend-styles', plugin_dir_url(__FILE__) . 'styles/frontend/custom-acf-frontend-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_css_frontend');