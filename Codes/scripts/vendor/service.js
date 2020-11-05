var URI_SAVE_SERVICE = BASE_URL + "vendor/service/save";
var URI_GET_SERVICE_DETAILS = BASE_URL + "vendor/service/get_deatils";
var URI_DELETE_SERVICE_INFO = BASE_URL + "vendor/service/delete";
var URI_UPDATE_SERVICE = BASE_URL + "vendor/service/update";


$("#btn_save_service").click(function() {
	var loader = $(this).children(".loader_icon");
	if (loader.is(":visible")) {
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData($("#frm_vendor_service")[0]);
	sendData.url = URI_SAVE_SERVICE;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if (callback.data != null) {
			loader.hide();
			var result = jsonProcess(callback.data);
			if (result.status == 200) {
                alertify.success(result.message);
				$('#service_img').val('');
				$('#service_name').val('');
				$('#service_price').val('');
				$('#event_category').val('');
				$('#service_desc').val('');
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

//Edit Section
var CURRENT_EDITED_ID = null;
//Do operation when click on edit button/icon
$(document).on("click", ".edit_service_info", function(){
	var service_id = $(this).attr("data-service-id");
	var loader = $(this).children(".loader_icon");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("service_id", service_id);
	sendData.url = URI_GET_SERVICE_DETAILS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			CURRENT_EDITED_ID = service_id;
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				$('#txt_upd_service_name').val(data.service_name);
				$('#txt_upd_service_desc').val(data.service_desc);
				$('#txt_upd_service_price').val(data.service_price);
				$('#update_service_info_modal').modal('show');
			}
		}
	});
});


$('#btn_update_service').click(function(){
	if(CURRENT_EDITED_ID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var formData = new FormData($('#frm_upd_service')[0]);
	formData.append('id', CURRENT_EDITED_ID);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_UPDATE_SERVICE;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				CURRENT_EDITED_ID = null;
				alertify.success(result.message);
				$('#txt_upd_service_name').val('');
				$('#txt_upd_service_desc').val('');
				$('#txt_upd_service_price').val('');
				setTimeout(function(){
					$("#update_service_info_modal").modal("hide");
				}, 1400);
				$('#update_service_info_modal').modal('show');
				location.reload();
			}else if(result.status == 401){
				alertify.error(result.reason);
			}else if(result.status == 403){
				alertify.error(result.reason);
			}else if(result.status == 402){
				alertify.error(result.reason);
				placeFormErrorMessages(result.error_list);
			}
		}
	});
});


$(document).on("click", ".delete_service_info", function() {
	var service_id = $(this).attr("data-service-id");
	alertify.confirm(
		'Warning',
		'This Service info will be deleted permanently. Are you sure',
		function() {
			var sendData = {};
			var formData = new FormData();
			formData.append("service_id", service_id);
			sendData.url = URI_DELETE_SERVICE_INFO;
			sendData.content = formData;
			formDataSend(sendData, function(callback){
				if (callback.data != null) {
					var result = jsonProcess(callback.data);
					if (result.status == 200) {
						alertify.success(result.message);
						location.reload();
					} else {
						alertify.error(result.reason);
					}
				}
			});
		},
		function() {
			alertify.success('Decoration info now safe')
		}
	);
});
