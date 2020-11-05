<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edit extends CI_Controller
{
    private $pic_path = "./uploads/client/";
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
        auth_client();
        $data = array();
        $user_id = $this->session->userdata("user_id");
        $data["client_details"] = $this->client_model->select_by_user_id($user_id);
        $data["scripts"] = array(
            "scripts/client/home.js"
        );
        $data["main_content"] = $this->load->view("client/edit", $data, true);
        $this->load->view("client/master", $data);
    }

    public function get_deatils()
    {
        $client_id= $this->input->post("client_id", true);
        $user_id = $this->session->userdata("user_id");
        $data = $this->client_model->select_by_user_id($user_id);
        $result = array("status"=>200, "data"=>$data);
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }

    public function update()
    {
        $user_id = $this->session->userdata("user_id");
        $data_client = array();
        $data_error = array();

        $data_client['client_id'] = $this->input->post("client_id", TRUE);
        $data_client['first_name'] = $this->input->post("first_name", TRUE);
        $data_client['last_name'] = $this->input->post("last_name", TRUE);
        $data_client['phn_number'] = $this->input->post("phn_number", TRUE);
        $data_client['address'] = $this->input->post("address", TRUE);
        $data_client['gender'] = $this->input->post("gender", TRUE);
        $chk_img = $this->input->post("chk_img", true);

        //check validation
        if ($data_client['first_name'] == "") {
            $data_error["upd_first_name"] = "First name required";
        }
        if ($data_client['last_name']  == "") {
            $data_error["upd_last_name"] = "Last name required";
        }
        if (filter_var($data_client['first_name'], FILTER_VALIDATE_INT)) {
            $data_error["upd_first_name"] = "Number Not allowed in First name";
        }
        if (filter_var($data_client['last_name'] , FILTER_VALIDATE_INT)) {
            $data_error["upd_last_name"] = "Number Not allowed in Last name";
        }
        if ($data_client['phn_number'] == "") {
            $data_error["upd_phn_number"] = "Phone Number required";
        }
        if ($data_client['address'] == "") {
            $data_error["upd_address"] = "Address required";
        }
        if ($data_client['gender'] == "") {
            $data_error["upd_gender"] = "Gender required";
        }


        if ($chk_img == 1) {
            $image_upload_result = upload_image_file("image", $this->pic_path, 512);
            $data_client["image"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";
            if ($image_upload_result["status"] != 200) {
                $data_error["upd_img"] = $image_upload_result["reason"];
            }
        }else{
            $data_image = $this->client_model->select_by_user_id($user_id);
            $data_client["image"] = $data_image->image;
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $client_id = $this->client_model->update($data_client);
            if (!$client_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $result = array("status"=>200, "message"=>'Decoration info Update successfully');
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }
}
