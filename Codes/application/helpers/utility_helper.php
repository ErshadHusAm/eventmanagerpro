<?php

function password_generator($length) {
    $chars = "asdfghjklASDFGHJKLqwertyuiopQWERTYUIOP1234567890";
    $concated = "";
    for ($i = 1; $i <= $length; $i++) {
        $random_index = rand(0, 46);
        $concated .= $chars[$random_index];
    }
    return $concated;
}

function send_mail($to_email, $message, $subject){
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: contact@techtalents.website" . "\r\n" .
    "CC: ershadhusam124@gmail.com";

    return mail($to_email, $subject, $message, $headers);
}

function send_attachment_mail($from, $name, $to, $subject, $body, $file)
{

    $fromName = $name;

// Email body content
    $htmlContent = $body;

// Header for sender info
    $headers = "From: $fromName" . " <" . $from . ">";

// Boundary
    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// Headers for attachment
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

// Multipart boundary
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

        // Preparing attachment
    if (!empty($file) > 0) {
        if (is_file($file)) {
            $message .= "--{$mime_boundary}\n";
            $fp = @fopen($file, "rb");
            $data = @fread($fp, filesize($file));

            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
                "Content-Description: " . basename($file) . "\n" .
                "Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }
    }
    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $from;

// Send email
    $mail = @mail($to, $subject, $message, $headers, $returnpath);
    return $mail;
}

function d($data){
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function dd($data){
    d($data); die();
}

function dump_json($data){
	echo json_encode($data, JSON_PRETTY_PRINT);exit();
}


/**
* Description: This function will return trim value of given associated
*              array
* Params: $data = Associative array
* Used By/ Dependency: N/A
**/
function trim_array($data){
    foreach($data as $key=>$single){
        if(gettype($single) == "string"){
            $data[$key] = trim($data[$key]);
        }
    }
    return $data;
}

function error_page($error_code="404", $error_message="404 Page not found"){
    $CI = &get_instance();
    $data = array(
        "error_code" => $error_code,
        "error_message" => $error_message
    );
    return $CI->load->view("errors/custom_error", $data, TRUE);
}


function strong_password_check($password = ''){
	$password = trim($password);
	$regex_lowercase = '/[a-z]/';
	$regex_uppercase = '/[A-Z]/';
	$regex_number = '/[0-9]/';
	$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';
    $result = array("status"=>200, "message"=>"Okay");

	if (empty($password)){
		$result = array("status"=>401, "reason"=>"Password is required.");
	}

	if (preg_match_all($regex_lowercase, $password) < 1){
        $result = array("status"=>401, "reason"=>"Password must have at least one lowercase letter.");
	}

	if (preg_match_all($regex_uppercase, $password) < 1){
        $result = array("status"=>401, "reason"=>"Password must have at least one upper letter.");
	}

	if (preg_match_all($regex_number, $password) < 1){
        $result = array("status"=>401, "reason"=>"Password must have at least one number.");
	}

    //Following checks are disabled
    /*
	if (preg_match_all($regex_special, $password) < 1){
		$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));
		return FALSE;
	}*/

	if (strlen($password) < 6){
        $result = array("status"=>401, "reason"=>"Password must be 6 characters in length.");
	}

	if (strlen($password) > 32){
        $result = array("status"=>401, "reason"=>"Password can't exceed 32 characters.");
	}
	return $result;
}

//Database operation related
/**
* Description: This function will return table fields except fields which are
*              passed in second ($excepts) parameters
* Params: $fields = All fields
*		  $excepts = Fields which should not in query
* Used By/ Dependency: Maximum models can use this fields
**/
function fields_except($fields, $excepts){
    $current_fields = array_diff($fields, $excepts);
    return implode(", ", $current_fields);
}

function get_remote_file_size($file_url, $formatSize = true){

    $head = array_change_key_case(get_headers($file_url, 1));
    // content-length of download (in bytes), read from Content-Length: field
    $clen = isset($head['content-length']) ? $head['content-length'] : 0;

    // cannot retrieve file size, return "-1"
    if (!$clen) {
        return -1;
    }

    if (!$formatSize) {
        return $clen;
		// return size in bytes
    }

    $size = $clen;
    $size = round($clen / 1024, 2);
    return $size;
	// return formatted size
}

function upload_image_file($field_name, $path, $size){
    $new_size = $size * 1024;
    $result = array("status"=>402, "reason"=>"File not uploaded");
    $allowed_types = array(
        "image/png",
		"image/jpeg"
    );
    //d($_FILES[$field_name]);
    if(isset($_FILES[$field_name])){
        $file = $_FILES[$field_name];
        if(isset($file["name"]) && $file["name"] != ""){
            $file_name = $file["name"];
            $file_size = $file["size"];
            $file_type = $file["type"];
            $tmp_path = $file["tmp_name"];

            if($file_size > $new_size){
                $result = array("status"=>401, "reason"=>"Image size exceeds limit $size KB");
            }else if(!in_array($file_type, $allowed_types)){
                $result = array("status"=>401, "reason"=>"Only image are allowed");
            }else{
                $sort_name = substr($file_name, -5);
                $file_name_with_path = $path.time().$sort_name;
                //if(@file_put_contents($file_name_with_path, $tmp_path)){
                if(move_uploaded_file($tmp_path, $file_name_with_path)){
                    $result = array("status"=>200, "file_path"=>$file_name_with_path);
                }else{
                    $result = array("status"=>401, "reason"=>"File upload failed");
                }
            }
        }else{
            $result = array("status"=>402, "reason"=>"File not uploaded");
        }
    }else{
        $result = array("status"=>402, "reason"=>"File not uploaded");
    }
    return $result;
}


function upload_file($field_name, $path, $size){
    $new_size = $size * 1024;
    $result = array("status"=>402, "reason"=>"File not uploaded");
    $allowed_types = array(
        "application/pdf",
		"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
		"application/vnd.ms-excel",
		"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
		"application/msword",
		"image/png",
        "image/jpeg"
    );
    //d($_FILES[$field_name]);
    if(isset($_FILES[$field_name])){
        $file = $_FILES[$field_name];
        if(isset($file["name"]) && $file["name"] != ""){
            $file_name = $file["name"];
            $file_size = $file["size"];
            $file_type = $file["type"];
            $tmp_path = $file["tmp_name"];

            if($file_size > $new_size){
                $result = array("status"=>401, "reason"=>"Image size exceeds limit $size KB");
            }else if(!in_array($file_type, $allowed_types)){
                $result = array("status"=>401, "reason"=>"Only document/image files are allowed");
            }else{
                $sort_name = substr($file_name, -8);
                $file_name_with_path = $path.time().$sort_name;
                //if(@file_put_contents($file_name_with_path, $tmp_path)){
                if(move_uploaded_file($tmp_path, $file_name_with_path)){
                    $result = array("status"=>200, "file_path"=>$file_name_with_path);
                }else{
                    $result = array("status"=>401, "reason"=>"File upload failed");
                }
            }
        }else{
            $result = array("status"=>402, "reason"=>"File not uploaded");
        }
    }else{
        $result = array("status"=>402, "reason"=>"File not uploaded");
    }
    return $result;
}

function upload_image($field_name, $path, $size){
    $new_size = $size * 1024;
    $result = array("status"=>402, "reason"=>"Picture not uploaded");
    if(isset($_FILES[$field_name])){
        $file = $_FILES[$field_name];
        //dd($file);
        if(isset($file["name"]) && $file["name"] != ""){
            $file_name = $file["name"];
            $file_size = $file["size"];
            $file_type = $file["type"];
            $tmp_path = $file["tmp_name"];

            if($file_size > $new_size){
                $result = array("status"=>401, "reason"=>"Image size exceeds limit $size KB");
            }else if($file_type != "image/png" && $file_type != "image/jpeg" && $file_type != "image/jpg"){
                $result = array("status"=>401, "reason"=>"Only JPG and PNG images are allowed");
            }else{
                $sort_name = substr($file_name, -8);
                $file_name_with_path = $path.time().$sort_name;
                //if(@file_put_contents($file_name_with_path, $tmp_path)){
                if(move_uploaded_file($tmp_path, $file_name_with_path)){
                    $result = array("status"=>200, "file_path"=>$file_name_with_path);
                }else{
                    $result = array("status"=>401, "reason"=>"Picture upload failed");
                }
            }
        }else{
            $result = array("status"=>402, "reason"=>"Picture not uploaded");
        }
    }else{
        $result = array("status"=>402, "reason"=>"Picture not uploaded");
    }
    return $result;
}


//Validation Functions
function is_valid_date($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

//Only alpha numeric allowed
function is_normal_string($string){
    // return !preg_match('/[^.()a-z0-9 ]+/i', $string) ? TRUE : FALSE;
    $nonMatchingCharacters = preg_replace('/[(),&.a-z0-9 _-]+/i', '', $string);
    if($nonMatchingCharacters != ""){
        $splited = str_split($nonMatchingCharacters);
        $nonMatchingCharactersArray = array_unique(str_split($nonMatchingCharacters));
        $nonMatchingCharacters = implode(",", $nonMatchingCharactersArray);
        // $result = array("status"=>401, "reason"=>"Special characters $nonMatchingCharacters are not allowed");
        $result = FALSE;
    }else{
        // $result = array("status"=>200, "message"=>"Okay");
        $result = TRUE;
    }
    return $result;
}

//Allow alpha numeric with ,-_ except other special chars.
function is_normal_string2($string){
    global $nonMatchingCharacters;
    $nonMatchingCharacters = preg_replace('/[\r\n(),&.a-z0-9 _-]+/i', '', $string);
    if($nonMatchingCharacters != ""){
        $splited = str_split($nonMatchingCharacters);
        $nonMatchingCharactersArray = array_unique(str_split($nonMatchingCharacters));
        $nonMatchingCharacters = implode(",", $nonMatchingCharactersArray);
        // $result = array("status"=>401, "reason"=>"Special characters $nonMatchingCharacters are not allowed");
        $result = FALSE;
    }else{
        // $result = array("status"=>200, "message"=>"Okay");
        $result = TRUE;
    }
    return $result;
    //return !preg_match('/[^\r\n(),&.a-z0-9 _-]+/i', $string) ? TRUE : FALSE;
}


//Feature Specific
function contract_status($status){
    $statuses = array(
        "1"=>"Running", "2"=>"Renewed", "3"=>"Cancelled", "4"=>"Finished", "5"=>"Created", "6"=>"Payment done", "7"=>"Holding", "8"=>"Rejected"
    );
    return isset($statuses[$status]) ? $statuses[$status] : "";
}

function get_all_months($start, $end){
    $current = $start;
    $next = @date('Y-M-01', $current);
    $ret = array();
    while( strtotime($next) <$end ){
        $current = @strtotime($next);
        $next = @date('Y-M-01', $current) . "+1 month";
        $ret[] = date("Y-m", $current);
    }
    return array_reverse($ret);
}

function get_month_numbers($start, $end){
    $current = $start;
    $next = @date('Y-M-01', $current);
    $ret = array();
    $i = 1;
    while( strtotime($next) <$end ){
        $current = @strtotime($next);
        $next = @date('Y-M-01', $current) . "+1 month";
        $ret[date("Y-m", $current)] = $i;
        $i++;
    }
    return $ret;
}

function get_icon($path="", $size="", $title=""){
    $height_width = $size != "" ? " width='$size' height='$size' " : "";
    $actual_path = base_url()."assets/core/$path";
    return "<img src='$actual_path' $height_width title='$title' />";
}

//Caching for UI
function apply_ui_cache($minutes=2){
    $CI = &get_instance();
    $CI->output->cache($minutes);
}
