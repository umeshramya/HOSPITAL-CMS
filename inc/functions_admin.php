<?php
/*
@package Hospital CMS
this file gerates admin page for hospital admin menu
*/ 


add_action( "admin_menu","create_admin_menu" );
function create_admin_menu(){
    // This creates the admin menu
    $capability = "manage_options";
    add_menu_page( 'Hospital Settings', "Hospital", $capability, __FILE__, "create_hospital_setting" );

    // add sub menu page
    add_submenu_page( __FILE__, "Hospital Settings", "Settings", $capability, __FILE__, "create_hospital_setting" );
    add_submenu_page( __FILE__, "Departments", "Departments", $capability, "edit.php?post_type=departments", NULL );
    add_submenu_page( __FILE__, "Facilities", "Facilities", $capability, "edit.php?post_type=facilities", NULL );
    add_submenu_page( __FILE__, "Private Insurances", "Private Insurances", $capability, "edit.php?post_type=private_insurances", NULL );
    add_submenu_page( __FILE__, "Goverment Schemes", "Goverment Schemes", $capability, "edit.php?post_type=goverment_schemes", NULL );
    
    
    
    add_action( 'admin_init', 'hospital_custom_setting' );
}


function create_hospital_setting(){

    ?>
    <?php //settings_errors() ;?>
    <form  action="options.php" method = "post" enctype="multipart/form-data" >
    <?php settings_fields( "Hospital-setting-group" ); ?>
    <?php do_settings_sections( __FILE__ );?>
    <?php submit_button(); ?>


    </form>
    
    
    <?php

}



function hospital_custom_setting(){
    // gets the page for laoding fields and sextions
    register_setting( 'Hospital-setting-group', 'hospital_name' );
    register_setting( 'Hospital-setting-group', 'hospital_address' );
    register_setting( 'Hospital-setting-group', 'hospital_google_map_link' );

    register_setting( 'Hospital-setting-group', 'emergency_phone' );
    register_setting( 'Hospital-setting-group', 'ambulance_phone' );
    register_setting( 'Hospital-setting-group', 'help_desk_phone' );
    
    register_setting( 'Hospital-setting-group', 'office_phone');


    
    register_setting( 'Hospital-setting-group', 'hospital_email');
    register_setting( 'Hospital-setting-group', 'activate_contact' );
    

    
    register_setting( 'Hospital-setting-group', 'departments' );
    register_setting( 'Hospital-setting-group', 'facilities' );
    register_setting( 'Hospital-setting-group', 'private_insurances' );
    register_setting( 'Hospital-setting-group', 'goverment_schemes' );
    register_setting( 'Hospital-setting-group', 'management_hierarchy');
    register_setting( 'Hospital-setting-group', 'faculty_hierarchy');
    
    

    add_settings_section( "hospital_setting_option", "Hospital Setting Options", function(){}, __FILE__ );


    add_settings_field( 'hospital-name', 'Hospital Name', 'hospital_setting_name', __FILE__, 'hospital_setting_option'  );
    add_settings_field( 'hospital-address', 'Hospital Address', 'hospital_setting_address', __FILE__, 'hospital_setting_option' );
    add_settings_field( 'hospital-google-map-link', 'Hospital Google Map Link', 'hospital_setting_google_map_link', __FILE__, 'hospital_setting_option' );
    add_settings_field( 'setting-phones', 'Hospital Phones', 'hospital_setting_phone', __FILE__, 'hospital_setting_option');
    
    
    add_settings_field( 'hospital_email', 'Hospital email', 'hospital_contact_email', __FILE__, 'hospital_setting_option');
    add_settings_field( 'Activate-contact-form', 'Activate Built In Contact Form', 'activate_hospital_contact_form', __FILE__, 'hospital_setting_option');
    
    
    

    add_settings_field( 'hospital-department', 'Departments', 'hospital_setting_departments', __FILE__,'hospital_setting_option');
    add_settings_field( 'hospital-facilities', 'Facilities', 'hospital_setting_facilities', __FILE__, 'hospital_setting_option' );
    add_settings_field( 'hospital-private-insurance', 'Private insurance', 'hospital_setting_priavte_insurance', __FILE__, 'hospital_setting_option' );
    add_settings_field( 'hospita_goverment-schemes', 'Goverment Schemes', 'hospital_goverment_schemes', __FILE__, 'hospital_setting_option' );
    add_settings_field( 'hospital-management-hierarchy', 'Management Hierarchy', 'hospital_management_hierarchy', __FILE__, 'hospital_setting_option');
    add_settings_field( 'hospital-faculty-hierarchy', 'Faculty Hierarchy', 'hospital_faculty_hierarchy', __FILE__, 'hospital_setting_option');
    



    
}

function hospital_setting_name(){
    $hospital_name = esc_attr( get_option( 'hospital_name' ) );
    echo '<span style="color:red">*</span><br><input type="text" name="hospital_name" value="' . $hospital_name . '" placeholder="Hospital Name"  style="width:50%; min-width:250px;" required/>';
}


function hospital_setting_address(){
    $hospital_address= esc_attr( get_option( 'hospital_address' ) );
    
    echo '<span style="color:red">*</span><br><textarea name="hospital_address" placeholder="Hospital Address"  rows="5" cols="40" required>'. $hospital_address .'</textarea>';


}

function hospital_setting_google_map_link(){
    $hospital_google_map_link = esc_attr( get_option( 'hospital_google_map_link' ) );
    echo '<input type="text" name="hospital_google_map_link" value="' . $hospital_google_map_link . '" placeholder="Hospital Google Map Link"  style="width:90%; min-width:250px;" />';

}

function hospital_setting_phone(){
    $emergency_phone = esc_attr( get_option( 'emergency_phone' ) );
    $ambulance_phone = esc_attr( get_option( 'ambulance_phone' ) );
    $help_desk_phone = esc_attr( get_option( 'help_desk_phone' ) );
    $office_phone = esc_attr( get_option( 'office_phone' ) );
  echo '<span style="color:red">*</span><br><input type="text" name="emergency_phone" value="' . $emergency_phone . '" placeholder="Emergency Phone" required/>';
  echo '<input type="text" name="ambulance_phone" value="' . $ambulance_phone . '" placeholder="Ambulance Phone" />';
  echo '<input type="text" name="help_desk_phone" value="' . $help_desk_phone . '" placeholder="Help Desk Phone" />';  
  echo '<input type="text" name="office_phone" value="' . $office_phone . '" placeholder="Office Phone" />';
}




function hospital_contact_email(){
    $contact_email = sanitize_email( get_option( 'hospital_email' ) );
    echo '<span style="color:red">*</span><br><input type="text" name="hospital_email" value="' . $contact_email . '" placeholder="Hospital email" required/>';    
}


function activate_hospital_contact_form(){
    $option_checked = get_option( 'activate_contact' );
    $checked = (@$option_checked==1 ? 'checked':'');
   echo '<label> <input type="checkbox"  name="activate_contact"  value="1" '. $checked .' /></label> </br>
   Use SMTP for sending email. plugin like Gmail SMTP is helpfull. <br> Eihter google suite previously named as google apps (paid service)
   or free Gmail account is OK<br>';
}


function hospital_setting_departments(){
    $departments = esc_attr( get_option( 'departments' ) );
    echo '<input type="text" name="departments" value="' . $departments . '" placeholder="Departments" style="width:80%";/>';
    echo '<p>Enter each department by coma separtation </p>';
    echo '<p>Example :- Cardiology, Onco Surgery, Internal Medicine, OBG</p>';
    echo '<p> Use approprite caps and small letters</p>';
  
}

function hospital_setting_facilities(){
    $facilities = esc_attr( get_option( 'facilities' ) );
    echo '<input type="text" name="facilities" value="' . $facilities . '" placeholder="Facilities" style="width:80%";/>';
    echo '<p>Enter each facility by coma separtation </p>';
    echo '<p>Example :- Echo, Ultrasound, CT Scan, MRI</p>';
    echo '<p> Use approprite caps and small letters</p>';
}

function hospital_setting_priavte_insurance(){
    $private_insurances = esc_attr( get_option( 'private_insurances' ) );
    echo '<input type="text" name="private_insurances" value="' . $private_insurances . '" placeholder="Private insurance" style="width:80%";/>';
    echo '<p>Enter each insurance by coma separtation </p>';
    echo '<p>Example :- Vidal health care, Medi asst, Star Health</p>';
    echo '<p> Use approprite caps and small letters</p>';
}


function hospital_goverment_schemes(){
    $goverment_schemes = esc_attr( get_option( 'goverment_schemes' ) );
    echo '<input type="text" name="goverment_schemes" value="' . $goverment_schemes . '" placeholder="Goverment Schemes" style="width:80%";/>';
    echo '<p>Enter each scheme by coma separtation </p>';
    echo '<p>Example :- Yesheswini, Vajapay Yojana, RSBY</p>';
    echo '<p> Use approprite caps and small letters</p>';
}

function hospital_management_hierarchy(){
    $management_hierarchy= esc_attr( get_option( 'management_hierarchy' ) );
    echo '<input type="text" name="management_hierarchy" value="' . $management_hierarchy . '" placeholder="management hierarchy" style="width:80%";/>';
    echo '<p>Enter each postion by coma separtation </p>';
    echo '<p>Example :- Chairperson, Vice Chairpersons, Managing Directoraties, Techanical Directorats</p>';
    echo '<p> Use approprite caps and small letters</p>';
  
  }
  
  function hospital_faculty_hierarchy(){
    $faculty_hierarchy= esc_attr( get_option( 'faculty_hierarchy' ) );
    echo '<input type="text" name="faculty_hierarchy" value="' . $faculty_hierarchy . '" placeholder="Faculty hierarchy" style="width:80%";/>';
    echo '<p>Enter each postion by coma separtation </p>';
    echo '<p>Example :- HODs, Senior Consultants, Consultants, Residents, Techanicians, Nurses, Ward boys</p>';
    echo '<p> Use approprite caps and small letters</p>';
  
  }