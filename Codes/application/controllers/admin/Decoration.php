<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Decoration extends CI_Controller
{
    private $pic_path = "./uploads/decoration/";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("decoration_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_admin();
        $data = array();

        $decoration_list = $this->decoration_model->select();
        $data["decoration_list"] = $decoration_list;
        $data["scripts"] = array(
            "scripts/admin/decoration.js"
        );
        $data["main_content"] = $this->load->view("admin/decoration", $data, true);
        $this->load->view("admin/master", $data);
    }

    public function get_deatils()
    {
        $decoration_id= $this->input->post("decoration_id", true);
        $data = $this->decoration_model->select_by_id($decoration_id);
        $result = array("status"=>200, "data"=>$data);
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }


    public function save()
    {
        $data = array();
        $data_error = array();

        $data['decoration_name'] = $this->input->post("decoration_name", TRUE);
        $data['decoration_price'] = $this->input->post("decoration_price", TRUE);
        $data['decoration_description'] = $this->input->post("decoration_description", TRUE);
        $image_upload_result = upload_image_file("decoration_img", $this->pic_path, 512);
        $data["decoration_img"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";

        //check validation
        if ($data["decoration_name"] == "") {
            $data_error["decoration_name"] = "Decoration Title required";
        }
        if ($data["decoration_img"] == "") {
            $data_error["decoration_img"] = "Decoration Image required";
        }
        if ($data["decoration_price"] == "") {
            $data_error["decoration_price"] = "Decoration Price required";
        }
        if ($image_upload_result["status"] != 200) {
            $data_error["decoration_img"] = $image_upload_result["reason"];
        }

        if (!empty($data["decoration_price"])) {
            if(strlen($data["decoration_price"]) < 2 || strlen($data["decoration_price"]) > 8){
                $data_error["decoration_price"] = "Price number length invalid";
            }else if(!preg_match('/^[0-9-]+$/D', $data["decoration_price"])) {
                $data_error["decoration_price"] = "Invalid Price";
            }
        }
        if ($data["decoration_description"] == "") {
            $data_error["decoration_description"] = "Decoration Description required";
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $existing_data = $this->decoration_model->check_exist($data["decoration_name"]);
            if (!empty($existing_data)) {
                $result = array("status"=>403, "reason"=>"Same Decoration information already exist");
            } else {
                $decoration_id = $this->decoration_model->save($data);
                if (!$decoration_id) {
                    $result = array("status"=>401, "reason"=>'Failed to Update');
                } else {
                    $result = array("status"=>200, "message"=>'Decoration info Save successfully');
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function update()
    {
        $data = array();
        $data_error = array();

        $data['decoration_id'] = $this->input->post("decoration_id", TRUE);
        $data['decoration_name'] = $this->input->post("decoration_name", TRUE);
        $data['decoration_price'] = $this->input->post("decoration_price", TRUE);
        $data['decoration_description'] = $this->input->post("decoration_description", TRUE);
        $chk_img = $this->input->post("chk_img", true);

        //check validation
        if ($data["decoration_name"] == "") {
            $data_error["upd_decoration_name"] = "Decoration Title required";
        }

        if(strlen($data["decoration_price"]) < 2 || strlen($data["decoration_price"]) > 8){
            $data_error["upd_decoration_price"] = "Price number length invalid";
        }else if(!preg_match('/^[0-9-]+$/D', $data["decoration_price"])) {
            $data_error["upd_decoration_price"] = "Invalid Price";
        }

        if ($data["decoration_description"] == "") {
            $data_error["upd_decoration_description"] = "Decoration Description required";
        }

        if ($chk_img == 1) {
            $image_upload_result = upload_image_file("decoration_img", $this->pic_path, 512);
            $data["decoration_img"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";
            if ($image_upload_result["status"] != 200) {
                $data_error["upd_decoration_img"] = $image_upload_result["reason"];
            }
        }else{
            $data_image = $this->decoration_model->select_by_id($data['decoration_id']);
            $data["decoration_img"] = $data_image->decoration_img;
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $existing_data = $this->decoration_model->check_upd_exist($data["decoration_name"],$data['decoration_id']);
            if (!empty($existing_data)) {
                $result = array("status"=>403, "reason"=>"Same Decoration information already exist");
            } else {
                $decoration_id = $this->decoration_model->update($data);
                if (!$decoration_id) {
                    $result = array("status"=>401, "reason"=>'Failed to Update');
                } else {
                    $result = array("status"=>200, "message"=>'Decoration info Update successfully');
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function delete()
    {
        $decoration_id = $this->input->post("decoration_id", true);

        //To check if business doc count only one, then restrict delete
        // $count_employer_business_doc_by_business_doc = $this->employer_business_doc_model->count_employer_business_doc_by_business_doc($decoration_id);

        //Checking data inconsistency
        if (empty($decoration_id)) {
            $result = array("status"=>401, "reason"=>"You are trying illegal to delete");
        } else {
            if ($this->decoration_model->delete_by_id($decoration_id)) {
                $result = array("status"=>200, "message"=>"Decoration info successfully deleted");
            } else {
                $result = array("status"=>401, "reason"=>"Deletion failed due to internal problem");
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }
}
