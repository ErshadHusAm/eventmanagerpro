<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_service extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("event_model");
        $this->load->model("booking_service_model");
        $this->load->model("service_model");
        $this->load->model("notification_model");
    }

    public function save()
    {
        $data = array();
        $data_notification = array();
        $data_error = array();

        $client_id =  $this->session->userdata("client_id");
        $vendor_id = $this->input->post("vendor_id", true);
        $vendor_service_id = $this->input->post("vendor_service_id", true);
        $event_id = $this->input->post("event_id", true);
        $event_list = $this->event_model->select_by_event_id($event_id);

        // check validation
        if ($event_id == "") {
            $data_error["event"] = "Event required";
        }

        //Checking data inconsistency
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $existing_data = $this->booking_service_model->check_exist($vendor_id,$event_id,$client_id,$vendor_service_id);
            if (!empty($existing_data)) {
                $result = array("status"=>403, "reason"=>"Same Service Already Booking for this event");
            } else {
                $ammount = $this->booking_service_model->check_budget($event_id);
                $vendor_service = $this->service_model->select_by_id_vendor_id($vendor_service_id,$vendor_id);
                $check_budget = ($ammount->service_amount + ($vendor_service->service_price));
                if ($event_list->event_budget < $check_budget) {
                    $result = array("status"=>403, "reason"=>"This service already over your event budget. Select another service");
                } else {
                    $data['event_id'] = $event_id;
                    $data['vendor_id'] = $vendor_id;
                    $data['client_id'] = $client_id;
                    $data['vendor_service'] = $vendor_service_id;
                    $data['service_amount'] = $vendor_service->service_price;
                    $booking_service_id = $this->booking_service_model->save($data);
                    if (!$booking_service_id) {
                        $result = array("status"=>401, "reason"=>'Failed to Save');
                    } else {
                        $data_notification['client_id'] = $client_id;
                        $data_notification['vendor_id'] = $vendor_id;
                        $data_notification['event_id'] = $event_id;
                        $data_notification['booking_service_id'] = $booking_service_id;
                        $data_notification['message'] = "Your Have a Request of Vendor Service";
                        $data_notification['flag'] = "1";
                        $data_notification['view'] = "1";
                        $notification_id = $this->notification_model->save($data_notification);
                        if (!$notification_id) {
                            $result = array("status"=>200, "message"=>'Event Service Request Send Successfully');
                        } else {
                            $result = array("status"=>200, "message"=>'Event Service Request Send Successfully');
                        }
                    }
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function event_details($event_id=""){
        auth_client();

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

		$data["main_content"] = $this->load->view('client/event_details', $data, TRUE);
		$this->load->view("vendor/master", $data);

	}
}
