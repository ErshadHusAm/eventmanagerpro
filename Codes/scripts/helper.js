var errorCount = 0;
var DEFAULT_PROFILE_PHOTO = BASE_URL + "assets/core/images/pp.png";
var DEFAULT_BANNER_PHOTO = BASE_URL + "assets/core/images/default_image.png";

//Jquery Enhancement Related Codes
$.fn.hasAttr = function(name) {
	return this.attr(name) !== undefined;
};
//END Jquery Enhancement Codes



function showLoader(loaderId, loaderType) {
	$(loaderId).html("<img src='" + horizontalLoader + "' />");
}

function hideLoader(loaderId) {
	$(loaderId).html("");
}

//To get difference between two dates in year month and day format
function getDateDiff(date1, date2) {
    if(typeof(date1) == 'undefined' || typeof(date2) == 'undefined' || date1 == "" || date2 == ""){
        return "";
    }
	var starts = moment(date1);
	var ends   = moment(date2);

	var duration = moment.duration(ends.diff(starts));

	// with ###moment precise date range plugin###
	// it will tell you the difference in human terms

	var diff = moment.preciseDiff(starts, ends, true);
	var diff_string = diff.years > 0 ? diff.years+" Yr(s)," : "";
	diff_string += diff.months > 0 ? diff.months+" Month(s)," : "";
	diff_string += diff.months > 0 ? diff.days+" Day(s)," : "";
	diff_string = diff_string.slice(0, -1);
	diff_string = diff_string.split(",").join(", ");
	return diff_string;
}

function formDataSend(param, callback) {
	if (typeof(param.url) == 'undefined' || typeof(param.content) == 'undefined') {
		//Doing CSRF in Central Function
		console.log('Error');
		return false;
	}

	if(typeof(CSRF_TOKEN_NAME) != 'undefined' && typeof(CSRF_TOKEN_VALUE) != 'undefined'){
		param.content.append(CSRF_TOKEN_NAME, CSRF_TOKEN_VALUE);
	}

	if (typeof(param.loader) != 'undefined') {
		param.loader.show();
	}

	var callbackReturn = {
		percent: 0,
		data: null
	};

	var headers = {};
	if (typeof(param.apiau) != 'undefined') {
		//"Authorization":
		headers = {
			"Authorization": "Basic " + btoa(param.apiau)
		}
		console.log(headers);
	}

	$.ajax({
		url: param.url,
		headers: headers,
		xhr: function() {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener("progress", function(evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
					if (percentComplete === 100) {}
					callbackReturn.percent = percentComplete;
					callback(callbackReturn);
				}
			}, false);
			return xhr;
		},
		type: 'POST',
		data: param.content,
		success: function(data) {
			callbackReturn.percent = 100;
			callbackReturn.data = data;
			callback(callbackReturn);
			if (typeof(param.loader) != 'undefined') {
				param.loader.hide();
			}
		},
		cache: false,
		contentType: false,
		processData: false,
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			if (typeof(param.loader) != 'undefined') {
				param.loader.hide();
			}
		},
		complete: function() {
			if (typeof(param.loader) != 'undefined') {
				param.loader.hide();
			}
		}
	});
}



function placeFormErrorMessages(messageList) {
	var ids = "";
	$.each(messageList, function(index, item) {
		var id = "#label_error_" + index;
		ids += id + ",";
		//console.log(id);
		$(id).html(item);
	});
	ids = ids.substring(0, (ids.length - 1));
	setTimeout(function() {
		$(ids).html('');
	}, 6000);
}


function jsonProcess(data) {
	var processedResult = null
	try {
		processedResult = typeof(data) == 'object' ? data : JSON.parse(data);
	} catch (error) {

	}
	return processedResult;
}

//Before this function all codes are related to techtalents

function message(text, type, append_type, id) {
	var cl = "alert-success";
	if (type == "e") {
		cl = "alert-danger";
	} else if (type == "w") {
		cl = "alert-warning";
	}
	var message_html = '<div class="alert ' + cl + ' fade in no_border_radius left_bold_border" style="text-align: left">' +
		'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><span style="text-align:left">' +
		text +
		'</span></div>';
	var containerId = typeof(id) != 'undefined' ? id : "#message_container";
	if (append_type) {
		$(containerId).append(message_html);
	} else {
		$(containerId).html(message_html);
	}
	setTimeout(function() {
		$(containerId).html('');
	}, 6000);
}

function messageText(text, type, append_type, id) {
	if (type == "e") {
		cl = "style='color:red'";
	} else if (type == "w") {
		cl = "style='color:yellow'";
	} else {
		cl = "style='color:green'";
	}
	var message_html = '<div ' + cl + '>' + text + '</div>';
	var containerId = typeof(id) != 'undefined' ? id : "#message_container";
	if (append_type) {
		$(containerId).append(message_html);
	} else {
		$(containerId).html(message_html);
	}
	setTimeout(function() {
		$(containerId).html('');
	}, 6000);
}


function messageArray(data, type, append_type, id) {
	for (var i = 0; i < data.length; i++) {
		message(data[i], type, append_type, id);
	}
}

function isUrlExists(url, cb) {
	jQuery.ajax({
		url: url,
		dataType: 'text',
		type: 'GET',
		complete: function(xhr) {
			if (typeof cb === 'function')
				cb.apply(this, [xhr.status]);
		}
	});
}


//Validation Related
function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
	if (pattern.test(emailAddress) && typeof(emailAddress) != 'undefined') {
		return true;
	}
	return false;
};


function validateYoutubeUrl(url) {
	var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var matches = url.match(p);
	if (matches) {
		return matches[1];
	}
	return false;
}

function isInt(value) {
	var x = parseFloat(value);
	return !isNaN(value) && (x | 0) === x;
}

function verifyForm(frm, closest_parent, error_class) {
	var closestParent = closest_parent;
	var formElementsInput = frm + " input[type='text']";
	var formElementsTextarea = frm + " textarea";
	var formElementRadio = frm + " input[type='radio']";
	var formElementCheckbox = frm + " input[type='checkbox']";
	var formElementSelect = frm + " select";
	var errorCount = 0;

	$(formElementsInput).each(function() {
		var value = $(this).val();
		if ($(this).hasAttr("vf-required")) {
			if (value == "") {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Required');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		} else if ($(this).hasAttr("vf-length")) {
			var len = $(this).attr("vf-length");
			if (value.length < len) {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Length must be at least ' + len);
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		} else if ($(this).hasAttr("vf-email")) {
			console.log("Amar value: " + value);
			if (!isValidEmailAddress(value)) {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Invalid email');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		} else if ($(this).hasAttr('vf-youtube-url')) {
			if (!validateYoutubeUrl(value)) {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Invalid youtube URL');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		} else if ($(this).hasAttr('vf-int')) {
			if (!isInt(value)) {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Invalid number');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		}
	});

	$(formElementsTextarea).each(function() {
		var value = $(this).val();
		value = value.trim();

		if ($(this).hasAttr("vf-required")) {
			if (value == "") {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Required');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		} else if ($(this).hasAttr("vf-length")) {
			var len = $(this).attr("vf-length");
			if (value.length < len) {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Length must be at least ' + len);
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		} else if ($(this).hasAttr("vf-email")) {
			if (!isValidEmailAddress(value)) {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Invalid email');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		}

	});


	var radioNames = [];
	console.log(formElementRadio);
	$(formElementRadio).each(function() {
		var radioName = $(this).attr("name");
		if (typeof(radioName) != "undefined" && radioName.trim() != "" && radioNames.indexOf(radioName) == -1) {
			radioNames.push(radioName.trim());
		}
	});

	for (var i = 0; i < radioNames.length; i++) {
		var radioItem = $('input[type=radio][name="' + radioNames[i] + '"]');
		var checkedCheck = 0;
		var isRequired = false;
		var lastElement = null;
		$(radioItem).each(function() {
			if ($(this).prop("checked") == true) {
				checkedCheck++;
			}
			if ($(this).hasAttr("vf-required")) {
				isRequired = true;
			}
			lastElement = $(this);
		})

		if (lastElement != null && checkedCheck == 0 && isRequired) {
			errorCount++;
			lastElement.closest(closestParent).find(error_class).html('Required');
		} else {
			lastElement.closest(closestParent).find(error_class).html('');
		}
	}


	$(formElementSelect).each(function() {
		var value = $(this).val();
		value = value.trim();

		if ($(this).hasAttr("vf-required")) {
			if (value == "") {
				errorCount++;
				$(this).closest(closestParent).find(error_class).html('Required');
			} else {
				$(this).closest(closestParent).find(error_class).html('');
			}
		}
	});

	setTimeout(function() {
		$(error_class).html('');
	}, 6000)
	return errorCount;
}

function placeFormVerifier(frm, verfierList) {
	$.each(verfierList, function(index, item) {
		var element = frm + " " + item.tag_name + "[name='" + item.name + "']";
		if (item.verifier.indexOf("=") >= 0) {
			var verfierSide = item.verifier.split("=");
			$(element).attr(verfierSide[0], verfierSide[1]);
		} else {
			$(element).attr(item.verifier, "");
		}
	});
}

function placeErrorMessage(messageList) {
	var ids = "";
	$.each(messageList, function(index, item) {
		ids += index == (messageList.length - 1) ? "#" + item.id : "#" + item.id + ", "
		$("#" + item.id).html(item.message);
	});
	setTimeout(function() {
		$(ids).html("");
	}, 6000);
}

function placeServersideFormValidation(messageList, closestParent) {
	for (var key in messageList) {
		console.log("input[name='" + key + "']");
		$("input[name='" + key + "']").closest(closestParent).find(".msg_error").html(messageList[key]);
		$("textarea[name='" + key + "']").closest(closestParent).find(".msg_error").html(messageList[key]);
	}
	setTimeout(function() {
		$(".msg_error").html("");
	}, 6000);
}

function placeServerSideFormValidationArray(messageList, closestParent) {
	for (var key in messageList) {
		for (var subkey in messageList[key]) {
			var input = $('input[name="' + subkey + '"]').eq(messageList[key].position);
			if (subkey != "position") {
				if (typeof(input) != 'undefined') {
					input.closest(closestParent).find(".msg_error").html(messageList[key][subkey])
				}
			}
		}
	}
	setTimeout(function() {
		$(".msg_error").html("");
	}, 6000);
}


//To move cursor in list input to element
(function($, undefined) {
	$.fn.getCursorPosition = function() {
		var el = $(this).get(0);
		var pos = 0;
		if ('selectionStart' in el) {
			pos = el.selectionStart;
		} else if ('selection' in document) {
			el.focus();
			var Sel = document.selection.createRange();
			var SelLength = document.selection.createRange().text.length;
			Sel.moveStart('character', -el.value.length);
			pos = Sel.text.length - SelLength;
		}
		return pos;
	}
})(jQuery);

$(document).on("keyup", ".input_movable", function(e) {
	var cursorPosition = $(this).getCursorPosition();
	var valueLength = $(this).val().trim().length;
	var keyCode = e.keyCode;
	var inputName = $(this).prop("name");
	if (keyCode == 39 && valueLength == cursorPosition) {
		$(this).closest('td').next().find("input").focus();
	} else if (keyCode == 37 && cursorPosition == 0) {
		$(this).closest('td').prev().find("input").focus();
	} else if (keyCode == 38) {
		$(this).closest('tr').prev().find("input[name='" + inputName + "']").focus();
	} else if (keyCode == 40) {
		$(this).closest('tr').next().find("input[name='" + inputName + "']").focus();
	}
});

//Validation Section
//General Input Character Validation
/*$(document).on("keypress", "input[text-mode='general']", function(e){
	var k = e.keyCode;
  	$return = ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || k == 38 || k == 40 || k == 41 || k == 45 || k == 95 || (k >= 48 && k <= 57));
    if(!$return) {
		var object = $(this);
		console.log(k+": Error");
		$(this).addClass("red-tooltip");
		$(this).tooltip({
			title: "Special characters are not allowed except ()-&_",
			template: '<div class="red-tooltip tooltip fade bs-tooltip-top " role="tooltip" ><div class="arrow"></div><div class="tooltip-inner"></div></div>',
			//trigger: 'hover'
		});
		$(this).addClass("validation-red-border");
		$(this).focus();
		setTimeout(function(){
			object.tooltip('dispose');
			object.removeClass("validation-red-border");
			//alert(88);
		}, 2000);
      	return false;
    }
});*/

function makeTooltipError(objectName, message){
	objectName.addClass("red-tooltip");
	objectName.tooltip({
		title: message,
		template: '<div class="red-tooltip tooltip fade bs-tooltip-top " role="tooltip" ><div class="arrow"></div><div class="tooltip-inner"></div></div>',
		trigger: 'hover'
	});
	objectName.addClass("validation-red-border");
	objectName.focus();
}

function clearTooltipError(objectName){
	setTimeout(function(){
		objectName.tooltip('dispose');
		objectName.removeClass("validation-red-border");
		//alert(88);
	}, 200);
}

//Custom Icon Loader
function customIcon(name, size){
	var size = typeof(size) != 'undefined' ?  'height="'+size+'"' : '';
	var img = '<img src="'+BASE_URL+'assets/core/icons/'+name+'" '+size+' />';
	return img;
}


/*
//To apply clear button on search box
$(document).on( "keyup", ".searchinput", function(){
	var value = $(this).val();
	if( value.trim() != "" ){
		$( this ).next('.searchclear').show();
	}else{
		$( this ).next('.searchclear').hide();
	}
});

$(document).on( "click", ".searchclear", function(){
	$(this).prev( ".searchinput" ).val( "" );
	$(this).hide();
} );
*/

function getQueryVariable(variable) {
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split("=");
		if (pair[0] == variable) {
			return pair[1];
		}
	}
	return (false);
}

function isImageExists(image_url){

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();
	return http.status != 404;

}

function focusTopError(errorList){
	if(errorList != null && errorList != ""){
		var firstKey = Object.keys(errorList)[0];
		if(typeof(firstKey) != 'undefined'){
			var firstElement = "#label_error_"+firstKey;
			console.log($(firstElement).offset().top);
			var distance = $(firstElement).offset().top - 140;
			$('html, body').animate({
			    scrollTop: distance
			}, 800);
		}
	}

}

function encode_url($file_path){
	$path = $file_path + "@@--@@" + NEXT_FILE_VALID_TIME;
	$path = window.btoa($path);
	$path = BASE_URL + "file_manager/download?file="+encodeURIComponent($path);
	return $path;
}

function generate_image_link($file_path, $default_image=""){
	$file_url = encode_url($file_path);
	if(isImageExists($file_url)){
		return $file_url;
	}
	if($default_image == ""){
		return URI_NO_PICTURE;
	}
	return $default_image;
}
