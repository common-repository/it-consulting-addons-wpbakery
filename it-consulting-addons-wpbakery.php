<?php
/*
Plugin Name: IT Consulting Addons for WPBakery
Plugin URI: https://codenpy.com/demos/wpbakery-it-consult/
Description: Full featured and modern it consulting business addons for wpbakery page builder.
Version: 1.0.0
Author: codenpy
Author URI: https://codenpy.com
License: GPL v2 or later
Text Domain: cpitwpba
 */

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

include_once ABSPATH . 'wp-admin/includes/plugin.php';
if (is_plugin_active('js_composer/js_composer.php')) {

    /* Constants */
    define('ICAW_URL', rtrim(plugin_dir_url(__FILE__), '/'));
    define('ICAW_DIR', rtrim(plugin_dir_path(__FILE__), '/'));
    if (!function_exists('cpitwpba_WordPressCheckup')) {
        function cpitwpba_WordPressCheckup($version = '5.0')
        {
            global $wp_version;
            if (version_compare($wp_version, $version, '>=')) {
                return "true";
            } else {
                return "false";
            }
        }
    }

    // Admin Style CSS
    function cpitwpba_admin_enqeue()
    {

        wp_enqueue_style('cpitwpba_admin_css', plugins_url('admin/admin.css', __FILE__));
    }

    add_action('admin_enqueue_scripts', 'cpitwpba_admin_enqeue');

    // Enqueue scripts
    function cpitwpba_scripts()
    {
        wp_enqueue_style('cpitwpba_bootstrap_css', plugins_url('assets/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('cpitwpba_font-awesome_css', plugins_url('assets/css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('cpitwpba_magnific-popup_css', plugins_url('assets/css/magnific-popup.css', __FILE__));
        wp_enqueue_style('cpitwpba_owl-carousel_css', plugins_url('assets/css/owl.carousel.css', __FILE__));
        wp_enqueue_style('cpitwpba_slick_css', plugins_url('assets/css/slick.css', __FILE__));
        wp_enqueue_style('cpitwpba_cp-spacing_css', plugins_url('assets/css/cp-spacing.css', __FILE__));
        wp_enqueue_style('cpitwpba_style_css', plugins_url('assets/css/style.css', __FILE__));
        wp_enqueue_style('cpitwpba_responsive_css', plugins_url('assets/css/responsive.css', __FILE__));

        wp_enqueue_script('cpitwpba_bootstrap_js', plugins_url('assets/js/bootstrap.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_counterup_js', plugins_url('assets/js/jquery.counterup.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_easypiechart_js', plugins_url('assets/js/jquery.easypiechart.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_magnific-popup_js', plugins_url('assets/js/jquery.magnific-popup.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_owl-carousel_js', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_skill-bars_js', plugins_url('assets/js/skill.bars.jquery.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_swiper_js', plugins_url('assets/js/swiper.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_time-circle_js', plugins_url('assets/js/time-circle.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cpitwpba_main_js', plugins_url('assets/js/main.js', __FILE__), array('jquery'), '', true);

    }

    add_action('wp_enqueue_scripts', 'cpitwpba_scripts');

    // Load shortcodes
    require_once 'shortcodes/banner.php';
    require_once 'shortcodes/heading.php';
    require_once 'shortcodes/about-us.php';
    require_once 'shortcodes/about-us-2.php';
    require_once 'shortcodes/about-us-3.php';
    require_once 'shortcodes/service.php';
    require_once 'shortcodes/service-2.php';
    require_once 'shortcodes/service-3.php';
    require_once 'shortcodes/call-to-action.php';
    require_once 'shortcodes/call-to-action-2.php';
    require_once 'shortcodes/process.php';
    require_once 'shortcodes/process-2.php';
    require_once 'shortcodes/pricing.php';
    require_once 'shortcodes/testimonial.php';
    require_once 'shortcodes/testimonial-2.php';
    require_once 'shortcodes/testimonial-3.php';
    require_once 'shortcodes/brands.php';
    require_once 'shortcodes/flipbox.php';
    require_once 'shortcodes/team.php';


} // Check If VC is activate
else {
    function cpitwpba_required_plugin()
    {
        if (is_admin() && current_user_can('activate_plugins') && !is_plugin_active('js_composer/js_composer.php')) {
            add_action('admin_notices', 'cpitwpba_required_plugin_notice');

            deactivate_plugins(plugin_basename(__FILE__));

            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }
        }

    }

    add_action('admin_init', 'cpitwpba_required_plugin');

    function cpitwpba_required_plugin_notice()
    {
        ?>
        <div class="error"><p>Error! you need to install or activate the <a target="_blank"
                                                                            href="https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431">WPBakery
                    Page Builder for WordPress</a> plugin to run "<span style="font-weight: bold;">WPBakery IT Consulting Addons</span>"
                plugin.</p></div><?php
}
}
?>