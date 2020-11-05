var URI_UPLOAD_EMAIL_FILE = BASE_URL + "client/invite/upload_email";
var URI_SEND_CODE = BASE_URL + "client/invite/sendqr";

$(document).on("click", ".btn_send_guest", function() {
	var event_id = $(this).attr("data-event-id");
    var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("event_id", event_id);
	sendData.url = URI_SEND_CODE;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			var result = jsonProcess(callback.data);
            loader.hide();
			if(result.status == 200){
                alertify.success(result.message);
                setTimeout(function(){
					location.reload();
				}, 2000);
			}else if(result.status == 401){
				alertify.error(result.reason);
			}else if(result.status == 402){
				alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
			}
		}
	});
});

$("#btn_upload_guest").click(function() {
    var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
    var sendData = {};
    var formData = new FormData($("#frm_invitation")[0]);
    sendData.url = URI_UPLOAD_EMAIL_FILE;
    sendData.content = formData;
    formDataSend(sendData, function(callback){
        loader.hide();
        if (callback.data != null) {
            var result = jsonProcess(callback.data);
            if (result.status == 200) {
                alertify.success(result.message);
                location.reload();
            } else if (result.status == 402) {
                alertify.error(result.reason);
                placeFormErrorMessages(result.error_list);
            } else {
                alertify.error(result.reason);
            }
        }
    });
});
