<?php
/*
* @Package: DoctorAppointment
Trigers this file when user unistall the plugin
*/ 

if(! defined("WP_UNISTALL_PLUGIN")){
    die;
}

// to clear stored data
$appointments = get_posts(array("post_type" => "appointment", "numberposts" => -1));
// delete post type
foreach($appointments as $appointment){
    wp_delete_post( $appointment->iD, true );

}
// delete metadata