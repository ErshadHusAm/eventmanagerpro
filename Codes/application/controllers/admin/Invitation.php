<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invitation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("client_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_admin();
        $data = array();
        $data["scripts"] = array(
            "scripts/admin/home.js"
        );
        $data["main_content"] = $this->load->view("admin/invitation", $data, true);
        $this->load->view("admin/master", $data);
    }


    public function signout()
    {
        $data = array('user_id', 'user_type');
        $this->session->unset_userdata($data);
        $this->load->helper('cookie');
        delete_cookie("logged_in_js_id");
        redirect(base_url());
    }



}
