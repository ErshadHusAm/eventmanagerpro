<?php


    //Generate URL from path
    function encode_url($file_path){
        $path = $file_path . "@@--@@" . strtotime('+8 hours');
        $path = base64_encode($path);
        $path = urlencode($path);
        return base_url()."file_manager/download?file=$path";
    }

    //Generate URL from path
    function decode_url($url){
        $path = urldecode($url);
        $path = base64_decode($path);
        $splited = explode("@@--@@", $path);
        if(count($splited) != 2){
            $result = array("status"=>401, "reason"=>"Invalid URL");
        }else{
            $path = $splited[0];
            $time = $splited[1];
            if($time < time()){
                $result = array("status"=>401, "reason"=>"URL expired");
            }else{
                $result = array("status"=>200, "path"=>$path);
            }
        }
        return $result;
    }

    function encryption($plaintext, $key){
        $value = openssl_encrypt($plaintext, "rc4-hmac-md5", $key);
        $value = openssl_encrypt($value, "rc4-hmac-md5", $key);
        $value = urlencode($value);
        $value = str_replace("%2F", "___", $value);
        return $value;
    }

    function decryption($encrypted, $key){
        $encrypted = str_replace("___", "%2F", $encrypted);
        $encrypted = urldecode($encrypted);

        $value = openssl_decrypt($encrypted, "rc4-hmac-md5", $key);
        $value = openssl_decrypt($value, "rc4-hmac-md5", $key);
        return $value;
    }


    /**
    * Description: This function will return xss_clean value of given associated
    *              array
    * Params: $data = Associative array
    * Used By/ Dependency: N/A
    **/
    function xss_clean_array($data){
        $CI = &get_instance();
        foreach($data as $key=>$single){
            if(gettype($single) == "string"){
                $data[$key] = $CI->security->xss_clean($data[$key]);
            }
        }
        return $data;
    }


    //To get image links from frontend
	function get_secure_image_link($path, $default_image="", $is_frontend=true){
        if($is_frontend){
            $path = str_replace("../", "", $path);
        }
        if($path == "" || $path == null || !is_file($path)){
			return $default_image;
		}
		return encode_url($path);
	}

    //To get file links from frontend
    function get_secure_file_link($path, $is_frontend=true){
        if($is_frontend){
            $path = str_replace("../", "", $path);
        }
        return encode_url($path);
    }



?>
