<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
    Module Name: phonepay
    Description: This Custom Module is developed for Your Module Description
    Version: 1.0.0
    Requires at least: 3.0.*
    Author: <a href="https://codecanyon.net/user/corbitaltech" target="_blank">Corbital Technologies<a/>
*/

/*
 * Define module name
 * Module Name Must be in CAPITAL LETTERS
 */
define('PHONEPAY_MODULE', 'phonepay');

// require_once __DIR__.'/vendor/autoload.php';
/*
 * Register language files, must be registered if the module is using languages
 */
register_language_files(PHONEPAY_MODULE, [PHONEPAY_MODULE]);
register_payment_gateway("phonepay_gateway", PHONEPAY_MODULE);  
    
/*
 * Register activation module hook
 */
register_activation_hook(PHONEPAY_MODULE, 'phonepay_module_activate_hook');
function phonepay_module_activate_hook()
{
    require_once __DIR__ . '/install.php';
}

/*
 * Register deactivation module hook
 */
register_deactivation_hook(PHONEPAY_MODULE, 'phonepay_module_deactivate_hook');
function phonepay_module_deactivate_hook()
{
    update_option('phonepay_enabled', 0);
}
 

/*
 * Load module helper file
 */
get_instance()->load->helper(PHONEPAY_MODULE . '/phonepay');


require_once __DIR__ . '/includes/assets.php';
hooks()->add_action('admin_init', function () {
    // $CI = &get_instance();
    // $CI->load->library(PHONEPAY_MODULE . '/phonepay_lang');
});
hooks()->add_action('admin_auth_init', 'phonepay_admin_auth_init');
function phonepay_admin_auth_init()
{

}

hooks()->add_action('pre_activate_module', 'phonepay_pre_activate_module');
function phonepay_pre_activate_module()
{
    // add your logic here

}

hooks()->add_action('module_activated', 'phonepay_module_activated');
function phonepay_module_activated()
{
    // add your logic here

}

hooks()->add_action('module_deactivated', 'phonepay_module_deactivated');
function phonepay_module_deactivated()
{
    // add your logic here

}

hooks()->add_action('module_uninstalled', 'phonepay_module_uninstalled');
function phonepay_module_uninstalled()
{
    // add your logic here

}

hooks()->add_action('activate_module', 'phonepay_activate_module');
function phonepay_activate_module()
{
    // add your logic here

}

hooks()->add_action('uninstall_module', 'phonepay_uninstall_module');
function phonepay_uninstall_module()
{
    // add your logic here

}

hooks()->add_action('pre_deactivate_module', 'phonepay_pre_deactivate_module');
function phonepay_pre_deactivate_module()
{
    // add your logic here

}

