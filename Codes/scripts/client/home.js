var URI_GET_PROFILE_DETAILS = BASE_URL + "client/home/get_deatils";
var URI_UPDATE_PROFILE = BASE_URL + "client/home/update";

//Edit Section
var CURRENT_EDITED_ID = null;
//Do operation when click on edit button/icon
$(document).on("click", ".btn_edit_profile", function(){
	var client_id = $(this).attr("data-client-id");
	var loader = $(this).children(".loader_icon");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("client_id", client_id);
	sendData.url = URI_GET_PROFILE_DETAILS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			CURRENT_EDITED_ID = client_id;
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				$('#txt_upd_first_name').val(data.first_name);
				$('#txt_upd_last_name').val(data.last_name);
				$('#txt_upd_phn_number').val(data.phn_number);
				$('#txt_upd_address').val(data.address);
				$('#ddl_upd_gender option[value="'+ data.gender +'"]').prop("selected", "selected");
				$('#update_profile_info_modal').modal('show');
			}
		}
	});
});


$('#btn_update_profile').click(function(){
	if(CURRENT_EDITED_ID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var formData = new FormData($('#frm_upd_profile')[0]);
	formData.append('client_id', CURRENT_EDITED_ID);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_UPDATE_PROFILE;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				CURRENT_EDITED_ID = null;
				alertify.success(result.message);
				$('#txt_upd_first_name').val('');
				$('#txt_upd_last_name').val('');
				$('#txt_upd_phn_number').val('');
				$('#txt_upd_address').val('');
				$('#ddl_upd_gender').val('');
				setTimeout(function(){
					$("#update_profile_info_modal").modal("hide");
				}, 1400);
				$('#update_profile_info_modal').modal('show');
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
