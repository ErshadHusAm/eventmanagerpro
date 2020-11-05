<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Todolist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("client_model");
        $this->load->model("notification_model");
        $this->load->model("booking_service_model");
        $this->load->model("event_model");
        $this->load->model("event_invitation_model");
        $this->load->model("event_to_do_model");
    }


    //All UI level functions
    public function index()
    {
        //Authentication
        auth_client();
        $data = array();
        $user_id = $this->session->userdata("user_id");
        $client_id =  $this->session->userdata("client_id");
        $data["event_list"] = $this->event_model->select_by_client_id($client_id);
        $data["event_list"] = $this->event_model->select_by_client_id($client_id);
        foreach ($data["event_list"] as $key => $event) {
          $event->emails = $this->event_to_do_model->select_by_event_id($event->event_id);
        }
        $data["scripts"] = array(
            "scripts/client/todolist.js"
        );
        $data["main_content"] = $this->load->view("client/todolist", $data, true);
        $this->load->view("client/master", $data);
    }

    public function save()
    {
        $data = array();
        $data_error = array();

        $data['client_id'] =  $this->session->userdata("client_id");
        $data['event_id'] = $this->input->post("event_category", TRUE);
        $data['todo_desc'] = $this->input->post("todo_desc", TRUE);


        //check validation
        if ($data["event_id"] == "") {
            $data_error["event_category"] = "Event required";
        }
        if ($data["todo_desc"] == "") {
            $data_error["todo_desc"] = "Note Desc required";
        }


        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $to_do_id = $this->event_to_do_model->save($data);
            if (!$to_do_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $result = array("status"=>200, "message"=>'Successfully Add');
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }


    public function delete()
    {
        $client_id =  $this->session->userdata("client_id");
        $todo_list_id = $this->input->post("todo_list_id", TRUE);


        if($todo_list_id == "" && $todo_list_id == null){
			echo error_page("404", "Page not found");exit();
		}

		if(!filter_var($client_id, FILTER_VALIDATE_INT)){
			echo error_page("401", "Invalid attempt to access Event To do list");exit();
        }



            $to_do_id = $this->event_to_do_model->delete_by_id($todo_list_id);
            if (!$to_do_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $result = array("status"=>200, "message"=>'Successfully Delete');
            }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function update_status()
    {
        $data = array();
        $valid_statuses = [0,1];
        $data['status'] = $this->input->post("status", TRUE);
        $data['todo_list_id'] = $this->input->post("todo_list_id", TRUE);


        //checking authorization
        if(!filter_var($data['todo_list_id'], FILTER_VALIDATE_INT)){
            dump_json(["result"=>401, "reason"=>"Invalid parameter"]);
        }
        if(!in_array($data['status'], $valid_statuses)){
            dump_json(["status"=>401, "reason"=>"Invalid status"]);
        }

        $id = $this->event_to_do_model->update($data);
        if (!$id) {
            $result = array("status"=>401, "reason"=>'Failed to update');
        } else {
            $result = array("status"=>200, "message"=>'Event Status Update Successfully');
        }
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }

}
