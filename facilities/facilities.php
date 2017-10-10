<?php
/*
@packagae Hospital CMS
This creats the Facilities of hospital
data is extracred from hopital setting
*/ 

$cur_post_type      = "facilities";
$cur_menu_name      = "Facilities";
$cur_singular       = "facility";

$post_type = new create_custom_post_type($cur_post_type, $cur_menu_name, $cur_singular);
$post_type->set_args('query_var', true);
$post_type->set_args("show_ui", true);
$post_type->set_args("show_in_menu", false);

$post_type-> set_args('supports', array('editor' , 'thumbnail'));
add_action( "init", array($post_type, 'register_custom_post_type' ));

add_action('init', array($post_type, 'insert_custom_posts'));
add_action("edit_form_after_title", array($post_type, "read_only_title"));
unset($post_type);
