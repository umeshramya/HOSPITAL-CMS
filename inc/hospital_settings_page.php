<?php
/*
@package Hopsital CMS
This file creates hospital settimgs  page in admin area
*/ 

?>
<!-- <h1>Hospital Settings</h1> -->

<form method = 'POST'action="">
<?php settings_fields( "Hospital-setting-group" ); ?>
<?php do_settings_sections( "hospital_slug" );?>



</form>




