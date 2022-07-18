<?php
/*
 * Plugin Name: Amazing Call To Action Button
 * Plugin URI: https://cta.stancelewski.pl/
 * Description: Create fully customizable Call To Action buttons on your website. Simple to use - advanced in possibilities.
 * Version: 0.1
 * Author: Michał Stancelewski
 * Author URI: https://stancelewski.pl/
 * Text Domain: amazing-call-to-action-button
 * Domain Path: /lang
 */

function plugin_init() {
    load_plugin_textdomain('amazing-call-to-action-button', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'plugin_init', 0);