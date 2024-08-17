<?php

/*
 * Inject Javascript file for phonepay module
 */
hooks()->add_action('app_admin_footer', 'phonepay_load_js');
function phonepay_load_js() {
    if (get_instance()->app_modules->is_active('phonepay')) {
        echo '<script src="'.module_dir_url('phonepay', 'assets/js/phonepay.js').'?v='.get_instance()->app_scripts->core_version().'"></script>';
    }
}

