$(document).on('keyup', 'input[name="search_term"]', function(e) {
	//13 input value
	if (e.keyCode == 13) {
		$("#frmStaffSearch").submit();
	}
})

$("#btn_search_staff").click(function(){
	$("#frmStaffSearch").submit(); // Submit the form
});
