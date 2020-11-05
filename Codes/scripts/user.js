var URI_REGISTER_CLIENT = BASE_URL + "home/client_register";
var URI_REGISTER_VENDOR = BASE_URL + "home/vendor_register";
var URI_REGISTER_STAFF = BASE_URL + "home/staff_register";

var URI_CLIENT_LOGIN = BASE_URL + "home/client_login";
var URI_ADMIN_LOGIN = BASE_URL + "home/admin_login";
var URI_VENDOR_LOGIN = BASE_URL + "home/vendor_login";

var URI_CLIENT_HOMEPAGE = BASE_URL + "client/home";
var URI_ADMIN_HOMEPAGE = BASE_URL + "admin/home";
var URI_VENDOR_HOMEPAGE = BASE_URL + "vendor/home";


$("#btn_admin_login").click(function(){
    var loaderElement = $(this).children(".loader_signup");
    if(loaderElement.is(":visible")){
        return false;
    }
    var sendData = {};
    var formData = new FormData($("#frm_admin_login")[0]);
    sendData.url = URI_ADMIN_LOGIN;
    sendData.content = formData;

    //Visible Loader
    loaderElement.show();
    formDataSend(sendData, function(callback){
        if(callback.data != null){
            loaderElement.hide();
            var result = jsonProcess(callback.data);
            if(result.status == 200){
                alertify.success(result.message);
                setTimeout(function() {
					window.location = URI_ADMIN_HOMEPAGE;
				}, 1200);
            }else if(result.status == 402){
                alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
				focusTopError(result.error_list);
            }else if(result.status == 401){
                alertify.error(result.reason);
            }
        }
    });

});


$("#btn_vendor_login").click(function(){
    var loaderElement = $(this).children(".loader_signup");
    if(loaderElement.is(":visible")){
        return false;
    }
    var sendData = {};
    var formData = new FormData($("#frm_vendor_login")[0]);
    sendData.url = URI_VENDOR_LOGIN;
    sendData.content = formData;

    //Visible Loader
    loaderElement.show();
    formDataSend(sendData, function(callback){
        if(callback.data != null){
            loaderElement.hide();
            var result = jsonProcess(callback.data);
            if(result.status == 200){
                alertify.success(result.message);
                setTimeout(function() {
					window.location = URI_VENDOR_HOMEPAGE;
				}, 1200);
            }else if(result.status == 402){
                alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
				focusTopError(result.error_list);
            }else if(result.status == 401){
                alertify.error(result.reason);
            }
        }
    });

});


$("#btn_user_login").click(function(){
    var loaderElement = $(this).children(".loader_signup");
    if(loaderElement.is(":visible")){
        return false;
    }
    var sendData = {};
    var formData = new FormData($("#frm_client_login")[0]);
    sendData.url = URI_CLIENT_LOGIN;
    sendData.content = formData;

    //Visible Loader
    loaderElement.show();
    formDataSend(sendData, function(callback){
        if(callback.data != null){
            loaderElement.hide();
            var result = jsonProcess(callback.data);
            if(result.status == 200){
                alertify.success(result.message);
                setTimeout(function() {
					// if(result.redirect_url != ""){
					// 	window.location = BASE_URL+result.redirect_url;
					// }else{
						window.location = URI_CLIENT_HOMEPAGE;
					// }
				}, 1200);
            }else if(result.status == 402){
                alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
				focusTopError(result.error_list);
            }else if(result.status == 401){
                alertify.error(result.reason);
            }
        }
    });

});


$("#btn_user_register").click(function(){
    var loaderElement = $(this).children(".loader_signup");
    if(loaderElement.is(":visible")){
        return false;
    }
    var sendData = {};
    var formData = new FormData($("#frm_client_registration")[0]);
    sendData.url = URI_REGISTER_CLIENT;
    sendData.content = formData;

    //Visible Loader
    loaderElement.show();
    formDataSend(sendData, function(callback){
        if(callback.data != null){
            loaderElement.hide();
            var result = jsonProcess(callback.data);
            if(result.status == 200){
                alertify.success(result.message);
                formClearClient();
            }else if(result.status == 402){
                alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
				focusTopError(result.error_list);
            }else if(result.status == 401){
                alertify.error(result.reason);
            }else if(result.status == 403){
                alertify.error(result.reason);
                $("#label_error_email").html(result.reason);
                setTimeout(function(){
                    $("#label_error_email").html("");
                }, 6000);
            }
        }
    });

});


$("#btn_vendor_register").click(function(){
    var loaderElement = $(this).children(".loader_signup");
    if(loaderElement.is(":visible")){
        return false;
    }
    var sendData = {};
    var formData = new FormData($("#frm_vendor_registration")[0]);
    sendData.url = URI_REGISTER_VENDOR;
    sendData.content = formData;

    //Visible Loader
    loaderElement.show();
    formDataSend(sendData, function(callback){
        if(callback.data != null){
            loaderElement.hide();
            var result = jsonProcess(callback.data);
            if(result.status == 200){
                alertify.success(result.message);
                formClearVendor();
            }else if(result.status == 402){
                alertify.error(result.reason);
                placeFormErrorMessages(result.error_list);
                focusTopError(result.error_list);
            }else if(result.status == 401){
                alertify.error(result.reason);
            }else if(result.status == 403){
                alertify.error(result.reason);
                $("#label_error_email").html(result.reason);
                setTimeout(function(){
                    $("#label_error_email").html("");
                }, 6000);
            }
        }
    });

});


$("#btn_staff_register").click(function(){
    var loaderElement = $(this).children(".loader_signup");
    if(loaderElement.is(":visible")){
        return false;
    }
    var sendData = {};
    var formData = new FormData($("#frm_staff_registration")[0]);
    sendData.url = URI_REGISTER_STAFF;
    sendData.content = formData;

    //Visible Loader
    loaderElement.show();
    formDataSend(sendData, function(callback){
        if(callback.data != null){
            loaderElement.hide();
            var result = jsonProcess(callback.data);
            if(result.status == 200){
                alertify.success(result.message);
                formClearStaff();
            }else if(result.status == 402){
                alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
				focusTopError(result.error_list);
            }else if(result.status == 401){
                alertify.error(result.reason);
            }else if(result.status == 403){
                alertify.error(result.reason);
                $("#label_error_email").html(result.reason);
                setTimeout(function(){
                    $("#label_error_email").html("");
                }, 6000);
            }
        }
    });

});


function formClearClient() {
  $("#first_name").val("");
  $("#last_name").val("");
  $("#phn_number").val("");
  $("#address").val("");
  $("#email").val("");
  $("#password").val("");
  $("#con_password").val("");
}

function formClearVendor() {
  $("#vendor_name").val("");
  $("#vendor_type").val("");
  $("#phn_number").val("");
  $("#email").val("");
  $("#vendor_address").val("");
  $("#vendor_area").val("");
  $("#password").val("");
  $("#con_password").val("");
}

function formClearStaff() {
  $("#fullname").val("");
  $("#staff_email").val("");
  $("#phn_num").val("");
  $("#gender").val("");
  $("#staff_loc").val("");
  $("#staff_type").val("");
  $("#salary").val("");
  $("#experience").val("");
  $("#image").val("");
}
