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

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('plugins_loaded', 'plugin_init', 0);
add_action('admin_enqueue_scripts', 'enqueue_color_picker' );
add_action('admin_menu', 'actab_admin_menu');
add_action('admin_enqueue_scripts', 'actab_enqueue_admin_styles_scripts' );
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'add_plugin_page_settings_link');

function plugin_init() {
    load_plugin_textdomain('amazing-call-to-action-button', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}

function add_plugin_page_settings_link( $links ) {
    $links[] = '<a href="' .
        admin_url( 'admin.php?page=amazing-call-to-action-button-settings' ) .
        '">' . __('Settings', 'amazing-call-to-action-button') . '</a>';
    return $links;
}

function actab_admin_menu() {
    $menu_icon = plugins_url() . '/'.  basename(dirname(__FILE__)) . "/img/icon-mini.png";
//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page(  'Amazing Call To Action Button', 'CTA Button', 'manage_options', 'amazing-call-to-action-button', actab_settings_dashboard(), $menu_icon, 26 );

//add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    add_submenu_page( 'amazing-call-to-action-button', __('Settings', 'amazing-call-to-action-button'), __('Settings', 'amazing-call-to-action-button'), 'manage_options', 'admin.php?page=amazing-call-to-action-button-settings', actab_settings_dashboard());
}

function actab_enqueue_admin_styles_scripts()
{

    $adminCSS= plugins_url() . '/'.  basename(dirname(__FILE__)) . "/css/admin_stylesheet.css";
    wp_enqueue_style( 'admin-callme-css', $adminCSS );

}

function enqueue_color_picker( $hook_suffix ) {
    $color_picker = plugins_url() . '/'.  basename(dirname(__FILE__)) . "/js/color-picker.js";
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', $color_picker, array( 'wp-color-picker' ), false, true );
}

function actab_settings_dashboard(){
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.', 'amazing-call-to-action-button') );
    }
    //include plugins_url() . '/'.  basename(dirname(__FILE__)) . '/admin/options-page.php';
}