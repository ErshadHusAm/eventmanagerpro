var URI_MAKE_VENDOR_PAYMENT = BASE_URL + "client/payment/make_payment";

$(document).on("click", ".btn_make_paymet", function() {
    var event_id = $(this).attr("data-event-id");
    var vendor_id = $(this).attr("data-vendor-id");
    var client_id = $(this).attr("data-client-id");
    var booking_service_id = $(this).attr("data-booking-service-id");
    if(booking_service_id == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children(".loader_icon");
	if (loader.is(":visible")) {
		return false;
	}
	loader.show();
	var formData = new FormData($("#frm_payment_service_" + booking_service_id)[0]);
	formData.append('booking_service_id', booking_service_id);
	formData.append('event_id', event_id);
	formData.append('vendor_id', vendor_id);
	formData.append('client_id', client_id);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_MAKE_VENDOR_PAYMENT;
	formDataSend(sendData, function(callback){
		if (callback.data != null) {
			loader.hide();
			var result = jsonProcess(callback.data);
			if (result.status == 200) {
                alertify.success(result.message);
				location.reload();
			} else if (result.status == 402) {
                alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
				focusTopError(result.error_list);
			} else {
				alertify.error(result.reason);
			}
		}
	});
});
