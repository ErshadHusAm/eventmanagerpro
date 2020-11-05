<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
    private $pic_path = "./uploads/service/";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("service_model");
        $this->load->model("event_category_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_vendor();
        $data = array();
        $vendor_id =  $this->session->userdata("vendor_id");
        $data["service_list"] = $this->service_model->select_by_id($vendor_id);
        $data["category_list"] = $this->event_category_model->select();
        $data["scripts"] = array(
            "scripts/vendor/service.js"
        );
        $data["main_content"] = $this->load->view("vendor/service", $data, true);
        $this->load->view("vendor/master", $data);
    }

    public function get_deatils()
    {
        $vendor_id =  $this->session->userdata("vendor_id");
        $service_id= $this->input->post("service_id", true);
        $data = $this->service_model->select_by_id_vendor_id($service_id,$vendor_id);
        $result = array("status"=>200, "data"=>$data);
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }


    public function save()
    {
        $data = array();
        $data_error = array();

        $data['vendor_id'] =  $this->session->userdata("vendor_id");
        $data['service_name'] = $this->input->post("service_name", TRUE);
        $data['service_price'] = $this->input->post("service_price", TRUE);
        $data['event_category'] = $this->input->post("event_category", TRUE);
        $data['service_desc'] = $this->input->post("service_desc", TRUE);
        $image_upload_result = upload_image_file("service_img", $this->pic_path, 1024);
        $data["service_img"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";

        //check validation
        if ($data["service_name"] == "") {
            $data_error["service_name"] = "Service Name required";
        }
        if ($data["service_price"] == "") {
            $data_error["service_price"] = "Service Price required";
        }
        if ($data["event_category"] == "") {
            $data_error["event_category"] = "Category required";
        }
        if ($image_upload_result["status"] != 200) {
            $data_error["service_img"] = $image_upload_result["reason"];
        }

        if (!empty($data["service_price"])) {
            if(strlen($data["service_price"]) > 7){
                $data_error["service_price"] = "Too much high Price";
            }else if(strlen($data["service_price"]) < 3){
                $data_error["service_price"] = "Too much low Price";
            }else if(!preg_match('/^[0-9-]+$/D', $data["service_price"])) {
                $data_error["service_price"] = "Invalid Price";
            }
        }
        if ($data["service_desc"] == "") {
            $data_error["service_desc"] = "Service Description required";
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $existing_data = $this->service_model->check_exist($data["service_name"]);
            if (!empty($existing_data)) {
                $result = array("status"=>403, "reason"=>"Same Service information already exist");
            } else {
                $service_id = $this->service_model->save($data);
                if (!$service_id) {
                    $result = array("status"=>401, "reason"=>'Failed to Update');
                } else {
                    $result = array("status"=>200, "message"=>'Service info Save successfully');
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

        $data['service_id'] = $this->input->post("id", TRUE);
        $data['service_name'] = $this->input->post("service_name", TRUE);
        $data['service_price'] = $this->input->post("service_price", TRUE);
        $data['service_desc'] = $this->input->post("service_desc", TRUE);
        $chk_img = $this->input->post("chk_img", true);

        //check validation
        if ($data["service_name"] == "") {
            $data_error["upd_service_name"] = "Service Title required";
        }

        if(strlen($data["service_price"]) < 2 || strlen($data["service_price"]) > 8){
            $data_error["upd_service_price"] = "Price number length invalid";
        }else if(!preg_match('/^[0-9-]+$/D', $data["service_price"])) {
            $data_error["upd_service_price"] = "Invalid Price";
        }

        if ($data["service_desc"] == "") {
            $data_error["upd_service_desc"] = "Service Description required";
        }

        if ($chk_img == 1) {
            $image_upload_result = upload_image_file("service_img", $this->pic_path, 512);
            $data["service_img"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";
            if ($image_upload_result["status"] != 200) {
                $data_error["upd_service_img"] = $image_upload_result["reason"];
            }
        }else{
            $data_image = $this->service_model->select_by_id($data['service_id']);
            $data["service_img"] = $data_image->service_img;
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $existing_data = $this->service_model->check_upd_exist($data["service_name"],$data['service_id']);
            if (!empty($existing_data)) {
                $result = array("status"=>403, "reason"=>"Same service information already exist");
            } else {
                $service_id = $this->service_model->update($data);
                if (!$service_id) {
                    $result = array("status"=>401, "reason"=>'Failed to Update');
                } else {
                    $result = array("status"=>200, "message"=>'Service Updated successfully');
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }


    public function delete()
    {
        $service_id = $this->input->post("service_id", true);

        //To check if business doc count only one, then restrict delete
        // $count_employer_business_doc_by_business_doc = $this->employer_business_doc_model->count_employer_business_doc_by_business_doc($service_id);

        //Checking data inconsistency
        if (empty($service_id)) {
            $result = array("status"=>401, "reason"=>"You are trying illegal to delete");
        } else {
            if ($this->service_model->delete_by_id($service_id)) {
                $result = array("status"=>200, "message"=>"Service info successfully deleted");
            } else {
                $result = array("status"=>401, "reason"=>"Deletion failed due to internal problem");
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }
}
