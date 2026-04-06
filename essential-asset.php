<?php
require_once('temp/backend/edit-product.php');
require_once('temp/backend/dashboard.php');
require_once('temp/frontend/single-product.php');
require_once('temp/frontend/shop-loop.php');
require_once('inc/save_label.php');
// require_once('temp/backend/accepted_app.php');
// require_once('temp/backend/rejected_app.php');
require_once('inc/ajaxHandler.php');


function jittechbh_ADDING_MENU()
{
	add_menu_page('Dashboard - Tigon Watermark Plugin', 'Watermarks', 'manage_options', 'tigonwm_dashboard', 'tigonwm_dashboard_temp','dashicons-tag', 5);
	// add_submenu_page( 'jittechbh_dashboard', 'All Pending Appointment', 'Dashboard', 'manage_options', 'jittechbh_dashboard', 'jittechbh_dashboard_temp');
	// add_submenu_page( 'jittechbh_dashboard', 'All Accepted Appointment', 'Accepted', 'manage_options', 'jittechbh_accepted','temp_accepted_appointment_func');
 //    add_submenu_page( 'jittechbh_dashboard', 'All Rejected Appointment', 'Rejected', 'manage_options', 'jittechbh_rejected','temp_rejected_appointment_func');
}
add_action('admin_menu','jittechbh_ADDING_MENU');


function tigonwm_ENQUEUE_SCRIPTS() 
{
    wp_enqueue_style('tigonwm_MAIN_CSS', plugin_dir_url( __FILE__ ). '/assets/css/main.css');
}
add_action( 'admin_enqueue_scripts', 'tigonwm_ENQUEUE_SCRIPTS' );
add_action( 'wp_enqueue_scripts', 'tigonwm_ENQUEUE_SCRIPTS' );


global $pagenow;
if ( $pagenow == 'admin.php' ) {
    if ( $_GET['page'] == 'tigonwm_dashboard' )
    {
        function VHWCH_BOOTSTRAP()
        {
        	wp_enqueue_style('tigonwm_MAIN_CSS_2', 'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css');
		    wp_enqueue_script('tigonwm_MAIN_JS_2', 'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js');

            wp_enqueue_style('VHWCH_BSCSS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' );
            wp_enqueue_script('VHWCH_BSJS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');

            wp_enqueue_script('jquery');
            wp_enqueue_script('tigonwm_MAIN_JS', plugin_dir_url( __FILE__ ). '/assets/js/main.js');
            wp_localize_script( 'tigonwm_MAIN_JS', 'olm_ajax_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
        }
        add_action( 'admin_enqueue_scripts', 'VHWCH_BOOTSTRAP' );
    }
}
