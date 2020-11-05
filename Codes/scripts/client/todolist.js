var URI_SAVE_TO_DO = BASE_URL + "client/todolist/save";
var URI_DELETE_TODO = BASE_URL + "client/todolist/delete";
var URI_UPDATE_STATUS = BASE_URL + "client/todolist/update_status";

$(document).on("click", ".btn_change_status", function() {
	var status = $(this).attr("data-status-id");
	var todo_list_id = $(this).attr("data-todo-id");
    var loader = $(this).children(".loader_icon");
	if (loader.is(":visible")) {
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData();
	formData.append("status", status);
	formData.append("todo_list_id", todo_list_id);
	sendData.url = URI_UPDATE_STATUS;
	sendData.content = formData;
	formDataSend(sendData, function(callback){
		if(callback.data != null){
			var result = jsonProcess(callback.data);
            loader.hide();
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

$("#btn_add_todo").click(function() {
    var loader = $(this).children("i");
	if(loader.is(":visible")){
		return false;
	}
	loader.show();
	var sendData = {};
	var formData = new FormData($("#frm_to_do")[0]);
	sendData.url = URI_SAVE_TO_DO;
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



$(document).on("click", ".btn_delete_todo", function() {
	var todo_list_id = $(this).attr("data-todo-id");
	alertify.confirm(
		'Warning',
		'This To Do info will be deleted permanently. Are you sure',
		function() {
			var sendData = {};
			var formData = new FormData();
            formData.append("todo_list_id", todo_list_id);
        	sendData.url = URI_DELETE_TODO;
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
			alertify.success('To Do info now safe')
		}
	);
});
