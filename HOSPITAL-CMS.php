<?php
/*
Plugin Name: Hospital-CMS
Plugin URI: http://bilagi.org
Description: This is for patient to book appintment with doctors. This plugin has mobile app to be downloaded from app store. Using this mobile app doctor or his/her secretory can confirm rescedule the patient booked appointment. The data is trasfered is in json format this can inigrated wih any other softwere. There is facilty for chatbox. patient can chat recive instractions.
Author: Dr Umesh R Bilagi
Author URI: http://bilagi.org
Text Domain: Hospital CMS

*/ 

//to prevent unauhorized axis
$name_space= "DoctorAppointment";//this var is used for prefixing  the objects in this plugin to prevent confilcts
                                    //even funcion can be called as be prefixed by this
if(! defined("ABSPATH")){
    die;
}





// ===============================================
// acvtivation and deactivation of plugin
// =============================================
function HOSPITAL_activate(){
    flush_rewrite_rules();
};

function HOSPITAL_deactivate(){

}


require_once (plugin_dir_path( __FILE__ ). "classes/custom_post_type.php");
require_once (plugin_dir_path(__FILE__). "inc/functions_admin.php");
require_once (plugin_dir_path( __FILE__ ). 'departments/departments.php');
require_once (plugin_dir_path( __FILE__ ). 'facilities/facilities.php');

require_once (plugin_dir_path( __FILE__ ). 'private_insurance/private_insurance.php');
require_once (plugin_dir_path( __FILE__ ). 'goverment_schemes/goverment_schemes.php');
require_once (plugin_dir_path( __FILE__ ). 'staff/staff.php');



// =======================================================
// enqueing scripts and styles
// =======================================================

add_action( "admin_enqueue_scripts", 'hospital_enqueue_admin');
function hospital_enqueue_admin(){
    /*
        This enques scripts and styles for admin
    */ 

    wp_enqueue_style( "plugin_style", plugins_url( "assets/styles/table_layout.css", __FILE__ ));
    wp_enqueue_style( 'jquery_ui_style', "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css");

}






// // ========================================
// // Creating Roles
// // ========================================
// register_activation_hook( __FILE__, "Hospital_add_roles");

// function Hospital_add_roles(){
//     add_role( 'receptionist', 'Receptionist', array(
//         'read' => false,
//         'edit_posts' => false,
//         'publish_posts' => false,

//     ));

// }








