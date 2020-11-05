var URI_SAVE_EVENT = BASE_URL + "client/event/save";
var URI_UPDATE_STATUS = BASE_URL + "client/event/update_status";
var URI_GET_EVENT_DETAILS = BASE_URL + "client/event/get_deatils";
var URI_UPDATE_EVENT = BASE_URL + "client/event/update";


$("#btn_save_event").click(function() {
	var loader = $(this).children(".loader_icon");
	if (loader.is(":visible")) {
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData($("#frm_event")[0]);
	sendData.url = URI_SAVE_EVENT;
	sendData.content = formData;
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

$(document).on("click", ".btn_change_status", function() {
	var status = $(this).attr("data-status-id");
	var event_id = $(this).attr("data-event-id");
	var client_id = $(this).attr("data-client-id");
	var sendData = {};
	var formData = new FormData();
	formData.append("status", status);
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



//Edit Section
var CURRENT_EDITED_CLIENT_ID = null;
var CURRENT_EDITED_EVENT_ID = null;
//Do operation when click on edit button/icon
$(document).on("click", ".btn_edit_event", function(){
	var client_id = $(this).attr("data-client-id");
	var event_id = $(this).attr("data-event-id");
	var loader = $(this).children(".loader_icon");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("client_id", client_id);
	formData.append("event_id", event_id);
	sendData.url = URI_GET_EVENT_DETAILS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			CURRENT_EDITED_CLIENT_ID = client_id;
			CURRENT_EDITED_EVENT_ID = event_id;
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				$('#txt_upd_event_name').val(data.event_name);
				$('#ddl_upd_event_category option[value="'+ data.event_category +'"]').prop("selected", "selected");
				$('#ddl_upd_event_type option[value="'+ data.event_type +'"]').prop("selected", "selected");
				$('#ddl_upd_event_loc option[value="'+ data.event_loc +'"]').prop("selected", "selected");
				$('#txt_upd_event_city').val(data.event_city);
				$('#txt_upd_event_budget').val(data.event_budget);
				$('#txt_upd_event_date').val(data.event_date);
				$('#update_event_info_modal').modal('show');
			}
		}
	});
});


$('#btn_update_event_details').click(function(){
	if(CURRENT_EDITED_CLIENT_ID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var formData = new FormData($('#frm_upd_event_details')[0]);
	formData.append('client_id', CURRENT_EDITED_CLIENT_ID);
	formData.append('event_id', CURRENT_EDITED_EVENT_ID);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_UPDATE_EVENT;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				CURRENT_EDITED_CLIENT_ID = null;
				CURRENT_EDITED_EVENT_ID = null;
				alertify.success(result.message);
				$('#txt_upd_event_name').val('');
				$('#ddl_upd_event_category').val('');
				$('#ddl_upd_event_type').val('');
				$('#ddl_upd_event_loc').val('');
				$('#txt_upd_event_city').val('');
				$('#txt_upd_event_budget').val('');
				$('#txt_upd_event_date').val('');
				setTimeout(function(){
					$("#update_event_info_modal").modal("hide");
				}, 1400);
				$('#update_event_info_modal').modal('show');
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
