<?php

    function encryption($plaintext, $key){
        $CI = &get_instance();
        $CI->load->library("cryptor/cryptor", "", "cryptor");
        $value = $CI->cryptor->encrypt($plaintext, $key, TRUE);
        //Remove ==
        $value = str_replace("==", "", $value);
        return $value;
    }

    function decryption($encrypted, $key){
        $encrypted = $encrypted."==";
        $CI = &get_instance();
        $CI->load->library("cryptor/cryptor", "", "cryptor");
        return $CI->cryptor->decrypt($plaintext, $key, TRUE);
    }

?>
