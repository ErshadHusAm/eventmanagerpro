<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("event_model");
        $this->load->model("client_model");
        $this->load->model("event_category_model");
        $this->load->model("event_type_model");
        $this->load->model("staff_loc_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_client();
        $data = array();
        $user_id = $this->session->userdata("user_id");
        $client_details = $this->client_model->select_by_user_id($user_id);
        $data["event_category_list"] = $this->event_category_model->select();
        $data["event_type_list"] = $this->event_type_model->select();
        $data["staff_loc_list"] = $this->staff_loc_model->select();
        $data["event_list"] = $this->event_model->select_by_client($client_details->client_id);
        $data["scripts"] = array(
            "scripts/client/event.js"
        );
        $data["main_content"] = $this->load->view("client/event", $data, true);
        $this->load->view("client/master", $data);
    }

    public function get_deatils()
    {
        $client_id= $this->input->post("client_id", true);
        $event_id= $this->input->post("event_id", true);
        $data = $this->event_model->select_by_event_client_id($event_id,$client_id);
        $result = array("status"=>200, "data"=>$data);
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }

    public function save()
    {
        $data = array();
        $data_error = array();

        $data['client_id'] =  $this->session->userdata("client_id");
        $data['event_name'] = $this->input->post("event_name", TRUE);
        $data['event_budget'] = $this->input->post("event_budget", TRUE);
        $data['event_category'] = $this->input->post("event_category", TRUE);
        $data['event_type'] = $this->input->post("event_type", TRUE);
        $data['event_loc'] = $this->input->post("event_loc", TRUE);
        $data['event_city'] = $this->input->post("event_city", TRUE);
        $data['event_date'] = $this->input->post("event_date", TRUE);
        $chk = $this->input->post("chk", TRUE);

        //check validation
        if ($data["event_name"] == "") {
            $data_error["event_name"] = "Event Name required";
        }

            if($data["event_budget"] < 1 || strlen($data["event_budget"]) > 10){
                $data_error["event_budget"] = "Event Budget length invalid";
            }else if(!preg_match('/^[0-9-]+$/D', $data["event_budget"])) {
                $data_error["event_budget"] = "Invalid Budget";
            }

        if ($data["event_category"] == "") {
            $data_error["event_category"] = "Event Category required";
        }
        if ($data["event_type"] == "") {
            $data_error["event_type"] = "Event Type required";
        }
        if ($data["event_loc"] == "") {
            $data_error["event_loc"] = "Event Location required";
        }
        if ($data["event_city"] == "") {
            $data_error["event_city"] = "Event City invalid";
        }else if(preg_match('/^[0-9-]+$/D', $data["event_city"])) {
            $data_error["event_city"] = "Invalid City Name";
        }
        if ($data["event_date"] == "") {
            $data_error["event_date"] = "Event Date invalid";
        }
        if ($chk != 1) {
            $data_error["policy_agreed"] = "You must accept terms and condition";
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $event_id = $this->event_model->save($data);
            if (!$event_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $result = array("status"=>200, "message"=>'Your Event create successfully');

            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function update()
    {
        $data = array();
        $data_error = array();


        $data['event_id'] = $this->input->post("event_id", TRUE);
        $data['client_id'] = $this->input->post("client_id", TRUE);
        $data['event_name'] = $this->input->post("event_name", TRUE);
        $data['event_budget'] = $this->input->post("event_budget", TRUE);
        $data['event_category'] = $this->input->post("event_category", TRUE);
        $data['event_type'] = $this->input->post("event_type", TRUE);
        $data['event_loc'] = $this->input->post("event_loc", TRUE);
        $data['event_city'] = $this->input->post("event_city", TRUE);
        $data['event_date'] = $this->input->post("event_date", TRUE);

        if(!filter_var($data['client_id'], FILTER_VALIDATE_INT)){
            dump_json(["result"=>401, "reason"=>"Invalid parameter"]);
        }
        //check validation
        if ($data["event_name"] == "") {
            $data_error["upd_event_name"] = "Event Name required";
        }

            if($data["event_budget"] < 1 || strlen($data["event_budget"]) > 10){
                $data_error["upd_event_budget"] = "Event Budget length invalid";
            }else if(!preg_match('/^[0-9-]+$/D', $data["event_budget"])) {
                $data_error["upd_event_budget"] = "Invalid Budget";
            }

        if ($data["event_category"] == "") {
            $data_error["upd_event_category"] = "Event Category required";
        }
        if ($data["event_type"] == "") {
            $data_error["upd_event_type"] = "Event Type required";
        }
        if ($data["event_loc"] == "") {
            $data_error["upd_event_loc"] = "Event Location required";
        }
        if ($data["event_city"] == "") {
            $data_error["upd_event_city"] = "Event City invalid";
        }else if(preg_match('/^[0-9-]+$/D', $data["event_city"])) {
            $data_error["upd_event_city"] = "Invalid City Name";
        }
        if ($data["event_date"] == "") {
            $data_error["upd_event_date"] = "Event Date invalid";
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $event_id = $this->event_model->update($data);
            if (!$event_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $result = array("status"=>200, "message"=>'Your Event update successfully');

            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function update_status()
    {
        $data = array();
        $valid_statuses = [0,1,2];
        $data['status'] = $this->input->post("status", TRUE);
        $data['event_id'] = $this->input->post("event_id", TRUE);
        $client_id = $this->input->post("client_id", TRUE);


        //checking authorization
        if(!filter_var($client_id, FILTER_VALIDATE_INT)){
            dump_json(["result"=>401, "reason"=>"Invalid parameter"]);
        }
        if(!in_array($data['status'], $valid_statuses)){
            dump_json(["status"=>401, "reason"=>"Invalid status"]);
        }

        $id = $this->event_model->update($data);
        if (!$id) {
            $result = array("status"=>401, "reason"=>'Failed to update');
        } else {
            $result = array("status"=>200, "message"=>'Event Status Update Successfully');
        }
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }


}
