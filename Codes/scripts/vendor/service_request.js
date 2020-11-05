var URI_UPDATE_STATUS = BASE_URL + "vendor/service_request/update_status";

$(document).on("click", ".btn_accepted_request", function() {
	var status = $(this).attr("data-status-id");
	var booking_service_id = $(this).attr("data-booking-id");
	var event_id = $(this).attr("data-event-id");
	var client_id = $(this).attr("data-client-id");
	var sendData = {};
	var formData = new FormData();
	formData.append("status", status);
	formData.append("booking_service_id", booking_service_id);
	formData.append("event_id", event_id);
	formData.append("client_id", client_id);
	sendData.url = URI_UPDATE_STATUS;
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
