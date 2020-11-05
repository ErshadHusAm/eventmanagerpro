<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("client_model");
        $this->load->model("vendor_model");
        $this->load->model("event_model");
        $this->load->model("service_model");
        $this->load->model("staff_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_admin();
        $data = array();
        $data["count_staff"] = $this->staff_model->count_by_staff();
        $data["count_event"] = $this->event_model->count_by_event();
        $data["count_vendor_service"] = $this->service_model->count_by_service();
        $data["count_client"] = $this->client_model->count_by_client();
        $data["count_vendor"] = $this->vendor_model->count_by_vendor();
        $data["active_users"] = $this->app_user_model->get_active_users();
        $data["count_event_category"] = $this->event_model->get_event_category_count();
        $data["count_event_type"] = $this->event_model->get_event_type_count();
        $data["scripts"] = array(
            "scripts/admin/home.js"
        );
        $data["main_content"] = $this->load->view("admin/home", $data, true);
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
