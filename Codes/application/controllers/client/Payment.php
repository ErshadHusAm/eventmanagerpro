<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("client_model");
        $this->load->model("notification_model");
        $this->load->model("booking_service_model");
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_client();
        $data = array();
        $user_id = $this->session->userdata("user_id");
        $data["client_details"] = $this->client_model->select_by_user_id($user_id);
        $data["payment_details"] = $this->booking_service_model->select_payment_by_client_id($data["client_details"]->client_id);
        // d($data["payment_details"]);
        $data["scripts"] = array(
            "scripts/client/payment.js"
        );
        $data["main_content"] = $this->load->view("client/payment", $data, true);
        $this->load->view("client/master", $data);
    }

    public function make_payment(){
        //Authentication
        auth_client();
        $data['payment_method'] = $this->input->post("payment_method", TRUE);
        $data['booking_service_id'] = $this->input->post("booking_service_id", TRUE);
        $data['payment_status'] = "1";
        $client_id = $this->input->post("client_id", TRUE);
        $vendor_id = $this->input->post("vendor_id", TRUE);
        $event_id = $this->input->post("event_id", TRUE);

        if ($data["payment_method"] == "") {
            $data_error["payment_method"] = "Payment Method required";
        }

        if(!filter_var($data['booking_service_id'], FILTER_VALIDATE_INT)){
            dump_json(["result"=>401, "reason"=>"Invalid parameter"]);
        }


        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please verify your input", "error_list"=>$data_error);
        } else {
            $service_id = $this->booking_service_model->update($data);
            if (!$service_id) {
                $result = array("status"=>401, "reason"=>'Failed to Update');
            } else {
                $data_notification['client_id'] = $client_id;
                $data_notification['vendor_id'] = $vendor_id;
                $data_notification['event_id'] = $event_id;
                $data_notification['booking_service_id'] = $data['booking_service_id'];
                $data_notification['message'] = "Vendor Service Payment Done";
                $data_notification['flag'] = "4";
                $data_notification['view'] = "1";
                $notification_id = $this->notification_model->save($data_notification);
                $result = array("status"=>200, "message"=>'Payment successfully done');

            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

}
