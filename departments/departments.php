<?php
/*
@packagae Hospital CMS
This creats the departmemnts of hospital
data is extracred from hopital setting
*/ 

$cur_post_type      = "departments";
$cur_menu_name      = "Departments";
$cur_singular       = "Department";

$cur_post_type = new create_custom_post_type($cur_post_type, $cur_menu_name, $cur_singular);
$cur_post_type->set_args('query_var', true);
$cur_post_type->set_args("show_ui", true);
$cur_post_type->set_args("show_in_menu", false);

$cur_post_type-> set_args('supports', array( 'title','editor', 'thumbnail'));
add_action( "init", array($cur_post_type, 'register_custom_post_type' ));
