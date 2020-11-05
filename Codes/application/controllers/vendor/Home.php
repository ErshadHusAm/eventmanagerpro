<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $pic_path = "./uploads/vendor/";
    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("vendor_model");
        $this->load->model("notification_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_vendor();
        $data = array();
        $user_id = $this->session->userdata("user_id");
        $vendor_id= $this->input->post("vendor_id", true);
        $data["vendor_details"] = $this->vendor_model->select_by_user_id($user_id);
        $data["notification_details"] = $this->notification_model->select_by_vendor_id($data["vendor_details"]->vendor_id);
        $data["scripts"] = array(
            "scripts/vendor/home.js"
        );
        $data["main_content"] = $this->load->view("vendor/home", $data, true);
        $this->load->view("vendor/master", $data);
    }

    public function get_deatils()
    {
        $vendor_id= $this->input->post("vendor_id", true);
        $user_id = $this->session->userdata("user_id");
        $data = $this->vendor_model->select_by_user_id($user_id);
        $result = array("status"=>200, "data"=>$data);
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }

    public function update()
    {
        $user_id = $this->session->userdata("user_id");
        $data_vendor = array();
        $data_error = array();

        $data_vendor['vendor_id'] = $this->input->post("vendor_id", TRUE);
        $data_vendor['company_name'] = $this->input->post("company_name", TRUE);
        $data_vendor['phn_num'] = $this->input->post("phn_num", TRUE);
        $data_vendor['city'] = $this->input->post("city", TRUE);
        $data_vendor['address'] = $this->input->post("address", TRUE);
        $chk_img = $this->input->post("chk_img", true);

        //check validation
        if ($data_vendor['company_name'] == "") {
            $data_error["upd_company_name"] = "Company name required";
        }
        if ($data_vendor['city']  == "") {
            $data_error["upd_city"] = "City name required";
        }
        if (filter_var($data_vendor['city'], FILTER_VALIDATE_INT)) {
            $data_error["upd_city"] = "Number Not allowed in City name";
        }
        if ($data_vendor['phn_num'] == "") {
            $data_error["upd_phn_num"] = "Phone Number required";
        }
        if ($data_vendor['address'] == "") {
            $data_error["upd_address"] = "Address required";
        }


        if ($chk_img == 1) {
            $image_upload_result = upload_image_file("image", $this->pic_path, 512);
            $data_vendor["image"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";
            if ($image_upload_result["status"] != 200) {
                $data_error["upd_img"] = $image_upload_result["reason"];
            }
        }else{
            $data_image = $this->vendor_model->select_by_user_id($user_id);
            $data_vendor["image"] = $data_image->image;
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $vendor_id = $this->vendor_model->update($data_vendor);
            if (!$vendor_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $result = array("status"=>200, "message"=>'Decoration info Update successfully');
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }





}
