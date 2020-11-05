<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_request extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("booking_service_model");
        $this->load->model("event_model");
        $this->load->model("notification_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_vendor();
        $data = array();
        $vendor_id =  $this->session->userdata("vendor_id");
        $data["service_request_list"] = $this->booking_service_model->select_by_vendor_id($vendor_id);
        $data["scripts"] = array(
            "scripts/vendor/service_request.js"
        );
        $data["main_content"] = $this->load->view("vendor/service_request", $data, true);
        $this->load->view("vendor/master", $data);
    }


    public function update_status()
    {
        $vendor_id =  $this->session->userdata("vendor_id");
        $data_notification = array();
        $data = array();
        $valid_statuses = [1,2];
        $data['booking_service_id'] = $this->input->post("booking_service_id", TRUE);
        $data['status'] = $this->input->post("status", TRUE);
        $client_id = $this->input->post("client_id", TRUE);
        $event_id = $this->input->post("event_id", TRUE);

        //checking authorization
        if(!filter_var($data['booking_service_id'], FILTER_VALIDATE_INT)){
            dump_json(["result"=>401, "reason"=>"Invalid parameter"]);
        }
        if(!in_array($data['status'], $valid_statuses)){
            dump_json(["status"=>401, "reason"=>"Invalid status"]);
        }

        $id = $this->booking_service_model->update($data);
        if (!$id) {
            $result = array("status"=>401, "reason"=>'Failed to update');
        } else {
            $data_notification['client_id'] = $client_id;
            $data_notification['event_id'] = $event_id;
            $data_notification['vendor_id'] = $vendor_id;
            $data_notification['booking_service_id'] = $data['booking_service_id'];
            $data_notification['view'] = "2";
            if ($data['status'] == 1) {
                $data_notification['message'] = "Your Vendor Service Request Accepted";
                $data_notification['flag'] = "1";
            } else {
                $data_notification['message'] = "Your Vendor Service Request Rejected. Choose another";
                $data_notification['flag'] = "2";
            }
            $this->notification_model->save($data_notification);
            if ($data['status'] == 1) {
                $result = array("status"=>200, "message"=>'Event Request Accepted Successfully');
            } else {
                $result = array("status"=>200, "message"=>'Event Request Rejected Successfully');
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);exit();
    }

    public function event_details($event_id=""){
        auth_vendor();

		if($event_id == "" && $event_id == null){
			echo error_page("404", "Page not found");exit();
		}

		if(!filter_var($event_id, FILTER_VALIDATE_INT)){
			echo error_page("401", "Invalid attempt to access Event Details");exit();
        }

		$data["event_details"] = $this->event_model->select_by_id($event_id);
		if (empty($data["event_details"])) {
			echo error_page("404", "Page not found");exit();
		}

		$data["main_content"] = $this->load->view('vendor/event_details', $data, TRUE);
		$this->load->view("vendor/master", $data);

	}

}
