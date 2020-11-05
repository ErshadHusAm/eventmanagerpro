var URI_GET_COMPANY_DETAILS = BASE_URL + "vendor/home/get_deatils";
var URI_UPDATE_COMPANY = BASE_URL + "vendor/home/update";

//Edit Section
var CURRENT_EDITED_ID = null;
//Do operation when click on edit button/icon
$(document).on("click", ".btn_edit_company", function(){
	var vendor_id = $(this).attr("data-vendor-id");
	var loader = $(this).children(".loader_icon");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("vendor_id", vendor_id);
	sendData.url = URI_GET_COMPANY_DETAILS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			CURRENT_EDITED_ID = vendor_id;
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				$('#txt_upd_company_name').val(data.company_name);
				$('#txt_upd_phn_num').val(data.phn_num);
				$('#txt_upd_city').val(data.city);
				$('#txt_upd_address').val(data.address);
				$('#update_company_info_modal').modal('show');
			}
		}
	});
});


$('#btn_update_company').click(function(){
	if(CURRENT_EDITED_ID == null){
		alertify.warning("Something wrong. Please try again");
		return false;
	}
	var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var formData = new FormData($('#frm_upd_company')[0]);
	formData.append('vendor_id', CURRENT_EDITED_ID);
	var sendData = {};
	sendData.content = formData;
	sendData.url = URI_UPDATE_COMPANY;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			loader.hide();
			var result = jsonProcess(callback.data);
			if(result.status == 200){
				var data = result.data;
				CURRENT_EDITED_ID = null;
				alertify.success(result.message);
				$('#txt_upd_company_name').val('');
				$('#txt_upd_city').val('');
				$('#txt_upd_phn_num').val('');
				$('#txt_upd_address').val('');
				$('#img').val('');
				setTimeout(function(){
					$("#update_company_info_modal").modal("hide");
				}, 1400);
				$('#update_company_info_modal').modal('show');
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
