<?php
/*
@package HOSPITAL CMS
This fiel adds new fields to user profile

/*
====================
USER ADD metabox
====================


*/
// wp_enqueue_style( 'table_layout', );





add_action( 'show_user_profile', 'hospital_user_fields');
add_action( 'edit_user_profile', 'hospital_user_fields');

function hospital_user_fields($user){

echo ("<div class= 'Hospital-meta-box-container'>");
echo("<h3>Hospital Settings</h3>");

// ==============departments options================================
  echo ("<div class ='Hospital-meta-row'>");
    echo ("<div class ='Hospital-meta-th'>");
      $cur_user_department=  esc_attr(get_the_author_meta( 'user_department', $user->ID ));
      $departments_array = explode (',' ,  get_option('departments'));
      echo '<label for="user_department"/> Department </label>';
    echo("</div>");


    echo ("<div class ='Hospital-meta-td'>");
      echo '<select name="user_department" id="user_department"/>';
      echo '<option value="Select Department">Select Department</option>';
      foreach ($departments_array as $department) {
          echo '<option value="'. trim($department) .'"';
          if ($cur_user_department== trim($department) ){echo 'selected="true"';}
        echo  '>'. trim($department) .'</option>';
      }
        echo '</select></br>';
    echo ("</div>");
  echo ("</div>");


// ===================Qulification===================

echo ("<div class ='Hospital-meta-row'>");
  echo ("<div class ='Hospital-meta-th'>");
    $cur_user_quilification=  esc_attr(get_the_author_meta( 'qualification', $user->ID ));
    echo '<label for="qualification">Qualification</label>';
  echo("</div>");

  echo ("<div class ='Hospital-meta-td'>");
    echo '<input type="text" name="qualification" id="qualification" value="'. trim($cur_user_quilification) .'"/></br>';
  echo("</div>");
echo("</div>");

// ===================Registretion Number============

echo ("<div class ='Hospital-meta-row'>");
  echo ("<div class ='Hospital-meta-th'>");
    $cur_user_registration=  esc_attr(get_the_author_meta( 'registration_number', $user->ID ));
    echo '<label for="registration_number">Registration Number</label>';
  echo("</div>");

  echo ("<div class ='Hospital-meta-td'>");
    echo '<input type="text" name="registration_number" id="registration_number" value="'. trim($cur_user_registration) .'"/></br>';
  echo("</div>");
echo("</div>");
// ===================faculty Hirerachy=============

echo ("<div class ='Hospital-meta-row'>");
  echo ("<div class ='Hospital-meta-th'>");
    $cur_user_faculty_hierarchy = esc_attr( get_the_author_meta( "user_faculty_hierarchy" , $user->ID  ) );
    $faculty_hierarchy_array =explode (',' ,  get_option('faculty_hierarchy'));

    echo '<label for="user_faculty_hierarchy"/> Faculty Hierarchy </label>';
  echo("</div>");

  echo ("<div class ='Hospital-meta-td'>");
    echo '<select name="user_faculty_hierarchy" id="user_faculty_hierarchy"/>';
    echo '<option value="Select faculty hierarchy">Select faculty hierarchy</option>';
    foreach ($faculty_hierarchy_array as $faculty_hierarchy) {
        echo '<option value="'. trim($faculty_hierarchy) .'"';
        if ($cur_user_faculty_hierarchy== trim($faculty_hierarchy) ){echo 'selected="true"';}
      echo  '>'. trim($faculty_hierarchy) .'</option>';
    }
      echo '</select></br>';
    echo("</div>");
  echo("</div>");
// ======================= management_hierarchy=================

echo ("<div class ='Hospital-meta-row'>");
  echo ("<div class ='Hospital-meta-th'>");
    $cur_user_management_hierarchy = esc_attr( get_the_author_meta( "user_management_hierarchy" , $user->ID  ) );
    $management_hierarchy_array =explode (',' ,  get_option('management_hierarchy'));

    echo '<label for="user_management_hierarchy"/> Management Hierarchy </label>';
  echo("</div>");

  echo ("<div class ='Hospital-meta-td'>");
    echo '<select name="user_management_hierarchy" id="user_management_hierarchy"/>';
    echo '<option value="Select managamnet hierarchy">Select managamnet hierarchy</option>';
    foreach ($management_hierarchy_array as $managamnet_hierarchy) {
        echo '<option value="'. trim($managamnet_hierarchy) .'"';
        if ($cur_user_management_hierarchy== trim($managamnet_hierarchy) ){echo 'selected="true"';}
      echo  '>'. trim($managamnet_hierarchy) .'</option>';
    }
      echo '</select></br>';
  echo("</div>");
echo("</div>");

//=====================Activate Contact Form per authot=========

echo ("<div class ='Hospital-meta-row'>");
  echo ("<div class ='Hospital-meta-th'>");
    $option_checked=  esc_attr(get_the_author_meta( 'activate_contact_form', $user->ID ));
    $checked = (@$option_checked==1 ? 'checked':'');
    echo '<label for="activate_contact_form">Activate Contact Form </label>';
  echo("</div>");

  echo ("<div class ='Hospital-meta-td'>");
    echo '<input type="checkbox"  name="activate_contact_form"  value="1" '. $checked .' /></br>';
  echo("</div>");
echo("</div>");
// to be added in future versions
// ====================Consulation Time=============

// ====================On leave setting=============

}

echo("</div>");

add_action( 'personal_options_update','hospital_save_user_data' );
add_action( 'edit_user_profile_update', 'hospital_save_user_data' );
function hospital_save_user_data($user){
  if(!current_user_can( 'edit_user',$user )){
    return false;
  }

  update_user_meta( $user, 'user_department', $_POST['user_department']);
  update_user_meta ($user, 'qualification', $_POST['qualification'] );
  update_user_meta ($user, 'registration_number', $_POST['registration_number'] );
  update_user_meta( $user, 'user_faculty_hierarchy', $_POST['user_faculty_hierarchy'] );
  update_user_meta( $user, 'user_management_hierarchy', $_POST['user_management_hierarchy'] );
  update_user_meta( $user, 'activate_contact_form', $_POST['activate_contact_form'] );

}
