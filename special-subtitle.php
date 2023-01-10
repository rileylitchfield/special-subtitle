<?php
/*
Plugin Name: Special Post
Description: A custom plugin to add functionality to posts
Version: 1.0.7
Author: Riley Litchfield
Author URI: https://rileylitchfield.com
License: GPL2
*/

// Return the special subtitle as a string
function display_subtitle()
{
  $special_subtitle = get_field('special_subtitle');
  $special_font_size = get_field('special_font_size');
  return '<h2 style="font-style:italic;font-size:' . $special_font_size . 'px;">' . $special_subtitle . '</h2>';
}

// Create shortcode
add_shortcode('display_subtitle', 'display_subtitle');