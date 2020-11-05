var URI_UPDATE_CLIENT_STATUS = BASE_URL + "admin/manage_client/update_status";

$(document).on("click", ".btn_client_update_status", function() {
	var status = $(this).attr("data-status-id");
	var user_id = $(this).attr("data-user-id");
	var sendData = {};
	var formData = new FormData();
	formData.append("status", status);
	formData.append("user_id", user_id);
	sendData.url = URI_UPDATE_CLIENT_STATUS;
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
