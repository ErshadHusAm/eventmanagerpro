<?php
defined('BASEPATH') or exit('No direct script access allowed');

class More_services extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("event_category_model");
        $this->load->model("event_type_model");
        $this->load->model("app_user_model");
        $this->load->model("client_model");
        $this->load->model("vendor_model");
        $this->load->model("vendor_type_model");
        $this->load->model("staff_model");
        $this->load->model("staff_loc_model");
        $this->load->model("service_model");
        $this->load->model("event_model");
    }
    //All UI level functions
    public function index()
    {
        $data = array();
        $user_id =  $this->session->userdata("user_id");
        $client_id =  $this->session->userdata("client_id");
        $data["vendor_type_list"] = $this->vendor_type_model->select();
        $data["event_category_list"] = $this->event_category_model->select();
        $data["vendor_type_list"] = $this->vendor_type_model->select();
        $data["vendor_list"] = $this->service_model->select();
        $data["event_list"] = $this->event_model->select_by_client_id($client_id);



        $data["search_term"] = $this->input->post("search_term", TRUE);
        $data["event_type"] = $this->input->post("event_type", TRUE);
        $data["service_price_start"] = $this->input->post("service_price_start", TRUE);
        $data["service_price_end"] = $this->input->post("service_price_end", TRUE);
        if( $data["search_term"] == "" && $data["event_type"] == "" && $data["service_price_start"] == "" && $data["service_price_end"] == ""){
            $data["search_result"] = $this->service_model->search_service();

        }else{
            $search_data = $this->service_model->search_service_by_data($data["search_term"],$data["event_type"],$data["service_price_start"]
            ,$data["service_price_end"]);

            $data["search_result"] = $search_data;
            // dd($data["search_result"]);
        }


        $data["scripts"] = array(
            "scripts/client_service.js"
        );
        $data["main_content"] = $this->load->view('services', $data, true);
        $this->load->view("services", $data);
    }
}
