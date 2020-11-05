<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_vendor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("vendor_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_admin();
        $data = array();
        $vendor_list = $this->vendor_model->select();
        $data["vendor_list"] = $vendor_list;
        $data["scripts"] = array(
            "scripts/admin/vendor.js"
        );
        $data["main_content"] = $this->load->view("admin/vendor", $data, true);
        $this->load->view("admin/master", $data);
    }

    public function update_status()
    {
        $valid_statuses = [1,2];
        $data['user_id'] = $this->input->post("user_id", TRUE);
        $data['User_status'] = $this->input->post("status", TRUE);

        //checking authorization
        if(!filter_var($data['user_id'], FILTER_VALIDATE_INT)){
            dump_json(["result"=>401, "reason"=>"Invalid parameter"]);
        }
        if(!in_array($data['User_status'], $valid_statuses)){
            dump_json(["status"=>401, "reason"=>"Invalid status"]);
        }

        $id = $this->app_user_model->update($data);
        if (!$id) {
            $result = array("status"=>401, "reason"=>'Failed to update');
        } else {
            $result = array("status"=>200, "message"=>'Vendor Status updated successfully');
        }
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }
}
