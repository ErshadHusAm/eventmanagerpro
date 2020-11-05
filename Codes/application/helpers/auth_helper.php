<?php
/**
* Description: This function will find current session of user.
*              It checks if user session is not null. If null,
*              then redirect to homepage. Otherwise, it checks
*              user account is email verified or not. If not, then
*              redirect to email unverified page
* Params: $data = Associative array
* Used By/ Dependency: N/A
**/
function auth_client(){
    $CI = &get_instance();
    $CI->load->library("session");

    //Check Already Logged In
    $user_id = $CI->session->userdata("user_id");
    $user_type = $CI->session->userdata("user_type");
    if($user_id == NULL || $user_type == NULL || $user_type != 1){
        redirect(base_url());
        exit();
    }
}

function auth_vendor(){
    $CI = &get_instance();
    $CI->load->library("session");

    //Check Already Logged In
    $user_id = $CI->session->userdata("user_id");
    $user_type = $CI->session->userdata("user_type");
    if($user_id == NULL || $user_type == NULL || $user_type != 2){
        redirect(base_url());
        exit();
    }
}

function auth_admin(){
    $CI = &get_instance();
    $CI->load->library("session");

    //Check Already Logged In
    $user_id = $CI->session->userdata("user_id");
    $user_type = $CI->session->userdata("user_type");
    if($user_id == NULL || $user_type == NULL || $user_type != 0){
        redirect(base_url());
        exit();
    }
}

?>
