var URI_SAVE_CLIENT_SERVICE = BASE_URL + "client_service/save";

var CURRENTVENDORID = null;
var CURRENTSERVICEID = null;
var CURRENTSERVICEPRICE= null;

$(".single_vendor").click(function(){
	CURRENTVENDORID = $(this).attr("data-vendor-id");
	CURRENTSERVICEID = $(this).attr("data-service-id");
	CURRENTSERVICEPRICE = $(this).attr("data-service-price");
	$("#labelServiceName").html($(this).attr("data-service-name"));
	$("#labelServiceDesc").html($(this).attr("data-service-desc"));
	$("#labelServicePrice").html($(this).attr("data-service-price"));
	$("#labelVendorType").html($(this).attr("data-vendor-type"));
	$("#labelEventType").html($(this).attr("data-event-type"));
});

$(document).on("click", ".btn_add_event_service", function() {
	if(CURRENTVENDORID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	if(CURRENTSERVICEID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	if(CURRENTSERVICEPRICE == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children(".loader_icon");
	if (loader.is(":visible")) {
		return false;
	}
	loader.show();
	var formData = new FormData($('#frm_client_book_service')[0]);
	formData.append('vendor_id', CURRENTVENDORID);
	formData.append('vendor_service_id', CURRENTSERVICEID);
	formData.append('vendor_service_price', CURRENTSERVICEPRICE);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_SAVE_CLIENT_SERVICE;
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

$(document).on('keyup', 'input[name="search_term"]', function(e) {
	//13 input value
	if (e.keyCode == 13) {
		$("#frmFAQSearch").submit();
	}
})

$("#btn_search_vendor_service").click(function(){
	$("#frmVendorServiceSearch").submit(); // Submit the form
});
