<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invite extends CI_Controller
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
    }

    //All UI level functions
    public function index()
    {
        //Authentication
        auth_client();
        $data = array();
        $user_id = $this->session->userdata("user_id");
        $client_id =  $this->session->userdata("client_id");
        $event_id= $this->input->post("event_id", true);
        $data["client_details"] = $this->client_model->select_by_user_id($user_id);
        $data["event_list"] = $this->event_model->select_by_client_id($client_id);
        foreach ($data["event_list"] as $key => $event) {
            $event->emails = $this->event_invitation_model->select_by_event_id($event->event_id);
        }
        // dd($data["event_list"]);
        $data["email_list"] = $this->event_invitation_model->select_by_event_id($client_id);
        $data["scripts"] = array(
            "scripts/client/invite.js"
        );
        $data["main_content"] = $this->load->view("client/invite", $data, true);
        $this->load->view("client/master", $data);
    }

    public function upload_email()
    {

        $client_id =  $this->session->userdata("client_id");
        $event_id = $this->input->post("event_category", TRUE);
        $chk = $this->input->post("chk", TRUE);

        if($event_id == ""){
            dump_json(["result"=>401, "reason"=>"Please Choose  your event"]);
        }
        if($chk == ""){
            dump_json(["result"=>401, "reason"=>"Please accept tearms & condition"]);
        }

        $file = $_FILES;
        if (isset($file["event_email_list_file"])) {
            $csv_file = $file["event_email_list_file"];
            if ($csv_file["error"]==0 && $csv_file["type"] == "application/vnd.ms-excel") {
                $csv_file_path = $csv_file["tmp_name"];
                $contents = file_get_contents($csv_file_path);
                $file_handle = fopen($csv_file_path, 'r');
                $row = 0;
                $has_problem = false;
                while (!feof($file_handle)) {
                    $csv_data = fgetcsv($file_handle, 1024);
                    if ($row==0) {
                        if (!isset($csv_data[0]) || $csv_data[0] != "Email") { //first row should contain email
                            $has_problem = true;
                            break;
                        }
                    } else {
                        $email = isset($csv_data[0]) ? $csv_data[0] : ""; //check blank row
                        if ($email != "") {
                            // $count_existing_data = $this->event_invitation_model->count_by_email($email);
                            // if ($count_existing_data == 0) {
                            //Initialized array
                            $data = array();
                            $data["event_id"] = $event_id;
                            $data["client_id"] = $client_id;
                            $data["email_address"] = $email;
                            $this->event_invitation_model->save($data);
                            // }
                        }
                    }
                    $row++;
                }
                //dd($has_problem);
                fclose($file_handle);
                if ($has_problem == true) {
                    $result = array("status"=>401, "reason"=>"Invalid template");
                } else {
                    $result = array("status"=>200, "message"=>"Successfully Uploaded Data");
                }
            } else {
                $result = array("status"=>401, "reason"=>"File type/format is not supported");
            }
        } else {
            $result = array("status"=>401, "reason"=>"Fail to saved due to internal problem");
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();

    }

    public function sendqr(){
        $this->load->library("qrcode_lib");
        $event_id = $this->input->post("event_id", TRUE);
        $emails = $this->event_invitation_model->select_by_event_id($event_id);
        if (!$event_id) {
            $result = array("status"=>401, "reason"=>'Failed to Send Mail');
        } else {
            foreach ($emails as $key => $email) {
                $id = $email->event_invitation_id;
                $string = "$event_id - $id - $email->email_address - Invited";
                $path = "./uploads/qr_code/$id.png";
                $this->qrcode_lib->generateQRCode($string, $path);
                echo "$email->email_address <br>";
                send_attachment_mail("techtalents.contact@gmail.com", "Event manager $id", $email->email_address, "Invitation subject $id", "You are cordially invited for the event, please save this qr code", $path );
            }

            $result = array("status"=>200, "message"=>"Successfully Send Mail");
        }

    }
}
