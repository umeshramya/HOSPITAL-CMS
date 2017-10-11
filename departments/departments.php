<?php
/*
@packagae Hospital CMS
This creats the departmemnts of hospital
data is extracred from hopital setting
*/ 

$cur_post_type      = "departments";
$cur_menu_name      = "Departments";
$cur_singular       = "Department";

$post_type = new create_custom_post_type($cur_post_type, $cur_menu_name, $cur_singular);
$post_type->set_args('query_var', true);
$post_type->set_args("show_ui", true);
$post_type->set_args("show_in_menu", false);

$post_type-> set_args('supports', array( 'editor', 'thumbnail'));
add_action( "init", array($post_type, 'register_custom_post_type' ));


add_action('init', array($post_type, 'insert_custom_posts'));
add_action("edit_form_after_title", array($post_type, "read_only_title"));
add_action('admin_head', array($post_type, 'hide_add_new_button'));

unset($post_type);

