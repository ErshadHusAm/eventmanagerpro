var URI_SAVE_DECORATION_SERVICE = BASE_URL + "admin/decoration/save";
var URI_GET_DECORATION_SERVICE_DETAILS = BASE_URL + "admin/decoration/get_deatils";
var URI_DELETE_DECORATION_INFO = BASE_URL + "admin/decoration/delete";
var URI_UPDATE_DECORATION = BASE_URL + "admin/decoration/update";


$("#btn_save_decoration").click(function() {
	var loader = $(this).children(".loader_icon");
	if (loader.is(":visible")) {
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData($("#frm_decoration")[0]);
	sendData.url = URI_SAVE_DECORATION_SERVICE;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if (callback.data != null) {
			loader.hide();
			var result = jsonProcess(callback.data);
			if (result.status == 200) {
                alertify.success(result.message);
				$('#decoration_name').val('');
				$('#decoration_img').val('');
				$('#decoration_price').val('');
				$('#decoration_description').val('');
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
$(document).on("click", ".edit_decoration_info", function(){
	var decoration_id = $(this).attr("data-doc-id");
	var loader = $(this).children(".loader_icon");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("decoration_id", decoration_id);
	sendData.url = URI_GET_DECORATION_SERVICE_DETAILS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			CURRENT_EDITED_ID = decoration_id;
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				$('#txt_upd_decoration_name').val(data.decoration_name);
				$('#txt_upd_decoration_description').val(data.decoration_description);
				$('#txt_upd_decoration_price').val(data.decoration_price);
				$('#update_decoration_info_modal').modal('show');
			}
		}
	});
});


$('#btn_update_decoration').click(function(){
	if(CURRENT_EDITED_ID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var formData = new FormData($('#frm_upd_decoration')[0]);
	formData.append('decoration_id', CURRENT_EDITED_ID);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_UPDATE_DECORATION;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				CURRENT_EDITED_ID = null;
				alertify.success(result.message);
				$('#txt_upd_decoration_name').val('');
				$('#txt_upd_decoration_description').val('');
				$('#txt_upd_decoration_price').val('');
				setTimeout(function(){
					$("#update_decoration_info_modal").modal("hide");
				}, 1400);
				$('#update_decoration_info_modal').modal('show');
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


$(document).on("click", ".delete_decoration_info", function() {
	var decoration_id = $(this).attr("data-doc-id");
	alertify.confirm(
		'Warning',
		'This decoration info will be deleted permanently. Are you sure',
		function() {
			var sendData = {};
			var formData = new FormData();
			formData.append("decoration_id", decoration_id);
			sendData.url = URI_DELETE_DECORATION_INFO;
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
