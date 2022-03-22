// function recaptchaDataCallbackRegister(response) {
//     $('#hiddenRecaptchaRegister').val(response);
// };

// function recaptchaExpireCallbackRegister() {
//     $('#hiddenRecaptchaRegister').val('');
// };

// $('#registration_form').validate({
//     rules:{
//         first_name:{
//             required:true,
//             minlength:2,
//             maxlength:100
//         }
//     },
//     messages:{
//         first_name:{
//             required:'Please enter your first name'
//         }
//     }
// })

var formData = new FormData(form);
$.ajax({
    url: baseUrl+"/auth/ajax-login",
    type: "POST",
    data:formData,
    cache: false,
    contentType: false,
    success: function (data) { --
    },
    error: function(jqXHR, textstatus, errorThrown) {
        --
    }
});
