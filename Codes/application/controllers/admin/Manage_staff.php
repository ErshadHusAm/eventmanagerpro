<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("staff_model");
        $this->load->model("staff_loc_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_admin();
        $data = array();
        // $data["staff_list"] = $this->staff_model->select();
        $data["staff_loc_list"] = $this->staff_loc_model->select();

        $data["search_term"] = $this->input->post("search_term", TRUE);
        $data["staff_loc"] = $this->input->post("staff_loc", TRUE);
        $data["gender"] = $this->input->post("gender", TRUE);
        $data["staff_type"] = $this->input->post("staff_type", TRUE);

        if( $data["search_term"] == "" && $data["staff_loc"] == "" && $data["gender"] == "" && $data["staff_type"] == ""){
            $data["search_result"] = $this->staff_model->select();
        }else{
            $search_data = $this->staff_model->search_staff_by_data($data["search_term"],$data["staff_loc"],$data["gender"]
            ,$data["staff_type"]);
            $data["search_result"] = $search_data;
        }

        $data["scripts"] = array(
            "scripts/admin/staff.js"
        );
        $data["main_content"] = $this->load->view("admin/staff", $data, true);
        $this->load->view("admin/master", $data);
    }

}
