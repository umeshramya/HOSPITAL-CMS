<?php
/*
Plugin Name: Hospital-CMS
Plugin URI: http://bilagi.org
Description: This is WordPress plugin for managing website of hospital, like Departments, Facilities, Staff, Management, Appointment booking and show Casing Private insurances and Government Schemes.
Author: Dr Umesh R Bilagi
Author URI: http://bilagi.org
Text Domain: Hospital CMS




we need to creat the folder by name medsites inside theme directory in case we need to modify the defult presentation of template on front end.

1. all archive custom post i.e departments, facilities, private_insurences and goverment_schemes create file archive-medsites.php 
2. to handle only perperticular custom post create for example :-archive-departments.php

simliarly for single post
1. all sinlge custom post i.e departments, facilities, private_insurences and goverment_schemes create file single-medsites.php 
2. to handle only perperticular custom post create for example :-single-departments.php.


to modify css 
create a file inside styles/front.css





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
// require_once (plugin_dir_path(__FILE__) ."templates/archive.php");



// =======================================================
// enqueing scripts and styles
// =======================================================

add_action( "admin_enqueue_scripts", 'hospital_enqueue_admin');
function hospital_enqueue_admin(){
    /*
        This enques scripts and styles for admin
    */ 

    wp_enqueue_style( "plugin_table_layout_style", plugins_url( "assets/styles/table_layout.css", __FILE__ ));
    wp_enqueue_style( 'jquery_ui_style', "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css");

}

add_action('wp_enqueue_scripts', 'hospital_enqueue_front');
function hospital_enqueue_front(){
     /*
        This enques scripts and styles for front
    */ 
    wp_enqueue_style( "plugin_table_layout_style", plugins_url( "assets/styles/table_layout.css", __FILE__ ));
    

    // as few themes need defferent style they have to put be  in theme folder only
    // echo("gfgfggfgfffffffffffffffffffffffffffffffffffffffffffffffff  ".get_template_directory_uri());
    if(file_exists(get_stylesheet_directory(). "/medsites/styles/front.css")){
        wp_enqueue_style( "theme_front_style", get_stylesheet_directory_uri()."/medsites/styles/front.css" );
    }else{
        // if theme does not have plugin styles then it will use defult plugin styles
        wp_enqueue_style( "plugin_front_style", plugins_url( "assets/styles/front.css", __FILE__ ));

    }
  


    // /var/www/html/wordpress/wp-content/plugins/HOSPITAL-CMS/assets/styles/front.css
    wp_enqueue_style( 'jquery_ui_style', "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css");

}


// ======================================================
// loading template by checking the template  for  each post_type
// =====================================================
add_action( "template_include", "Hospital_load_template");
function Hospital_load_template($original_template){   


    $cur_post_type = get_post_type();//setting curpost type

    //checking for current post type i.e. departments, facilities, private_insurances and goverment_schemes
    if ($cur_post_type =="departments" || $cur_post_type =="facilities" ||
        $cur_post_type =="private_insurances" || $cur_post_type =="goverment_schemes"){

            // find out is it archive or is_search
        if (is_archive() || is_search()){

            // looking for concerned template inside as per the custom post
            if (file_exists(get_stylesheet_directory()."/medsites/archive-" . $cur_post_type ."\.php")){ 
                //return if theme template  if true
                return get_stylesheet_directory() ."/medsites/archive-" . $cur_post_type ."\.php";

            }elseif(file_exists(get_stylesheet_directory()."/medsites/archive-medsites.php")){
                // check for themplate for all cpt of hospital
                return get_stylesheet_directory()."/medsites/archive-medsites.php";               
            }else{
                // if not use plugin template
                return plugin_dir_path(__FILE__) ."templates/archive.php";
                
            }


        }elseif (is_single()){
            
            
            if (file_exists(get_stylesheet_directory(). "/medsites/single-".$cur_post_type.".php")){

                return get_stylesheet_directory(). "/medsites/single-".$cur_post_type.".php";

            }elseif (file_exists(get_stylesheet_directory(). "/medsites/single-medsites.php")){
                return get_stylesheet_directory(). "/medsites/single-medsites.php";//this file has to created by to return custmized single.php as per as themes
            }else{
                return  get_stylesheet_directory(). "/single.php";

            }
           
        }//end of ?post_type if
    }
    else{
        //if not the case fall back on the original tamplate with which wordpress had decided
        return $original_template; //if no match found then it fall back on $original_template
    }
    
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








