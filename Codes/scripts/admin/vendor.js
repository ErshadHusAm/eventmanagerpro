var URI_UPDATE_VENDOR_STATUS = BASE_URL + "admin/manage_vendor/update_status";
var CURRENT_EDITED_ID = null;

$(document).on("click", ".btn_vendor_update_status", function() {
	var status = $(this).attr("data-status-id");
	var user_id = $(this).attr("data-user-id");
	var sendData = {};
	var formData = new FormData();
	formData.append("status", status);
	formData.append("user_id", user_id);
	sendData.url = URI_UPDATE_VENDOR_STATUS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			var result = jsonProcess(callback.data);
			if(result.status == 200){
                alertify.success(result.message);
                setTimeout(function(){
					location.reload();
				}, 1400);
			}else if(result.status == 401){
				alertify.error(result.reason);
			}else if(result.status == 402){
				alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
			}
		}
	});
});

$(document).on("click", ".eventmodal", function() {
    var vendor_id = $(this).attr("data-user-id");
    CURRENT_EDITED_ID = vendor_id;
});
