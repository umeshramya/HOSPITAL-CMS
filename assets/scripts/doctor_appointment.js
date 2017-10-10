

jQuery(document).ready(function($){ 

    $("#DoctorAppointment__appointment_date_1, #DoctorAppointment__appointment_date_2, #DoctorAppointment__appointment_date_3")
    
    .datepicker({
        // write code for fomating date
    }).on("focusout", function(){
        
        
    });
    var doctor_appointment_submit = document.getElementById("DoctorAppointment_submit");

    var DoctorAppoinment_ajax = function(form_data, action){
        $.ajax({
            type        : "POST",
            dataType    : "json",
            url         : doctor_appointment_object.ajax_url,
            data        : {
                            data        : form_data,
                            action      : action,
                            security    : doctor_appointment_object.security,
                            submission  : document.getElementById("xyq").value
            }
            
            

        })
        .always(function(response){//always method is used as it done always in case
                                    //.success, .error and .complete are depreceted from jquery 3.***
             var readyState = response.readyState;
             var status     = response.status;
             var statusText = response.statusText;

             if (readyState == 4 && status == 200 && statusText == "OK"){
                 alert(doctor_appointment_object.success);//these are returned form localized object php
             }else{
                 alert(doctor_appointment_object.fail);//these are returned form localized object php
             
             }

        })
    }

    
    doctor_appointment_submit.addEventListener("click", function(event){
        event.preventDefault();
        var doctor_name ="admin" //get author name is needed here
        var form_data = {
            "author"       :    doctor_name,
            "client_name"  :    document.getElementById("DoctorAppointment_name").value,
            "email"        :    document.getElementById("DoctorAppointment_email").value,
            "mobile"       :    document.getElementById("DoctorAppointment_mobile").value,
            "date_1"       :    document.getElementById("DoctorAppointment__appointment_date_1").value,
            "date_2"       :    document.getElementById("DoctorAppointment__appointment_date_2").value,
            "date_3"       :    document.getElementById("DoctorAppointment__appointment_date_3").value,
            "message"      :    document.getElementById("DoctorAppointment_message").value

        }

        var action         = "DoctorAppoinment_process_user_genareted_post";

        DoctorAppoinment_ajax(form_data, action);


   });   

});