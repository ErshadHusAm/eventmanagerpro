<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $pic_path = "./uploads/staff/";
    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_user_model");
        $this->load->model("client_model");
        $this->load->model("vendor_model");
        $this->load->model("vendor_type_model");
        $this->load->model("staff_model");
        $this->load->model("staff_loc_model");
        $this->load->model("service_model");
        $this->load->model("event_model");
    }

    //All UI level functions
    public function index()
    {
        $data = array();
        $user_id =  $this->session->userdata("user_id");
        $client_id =  $this->session->userdata("client_id");
        $vendor_id =  $this->session->userdata("vendor_id");
        $data["vendor_type_list"] = $this->vendor_type_model->select();
        $data["staff_loc_list"] = $this->staff_loc_model->select();
        $data["vendor_list"] = $this->service_model->select();
        $data["event_list"] = $this->event_model->select_by_client_id($client_id);
        $data["event_list_budget"] = $this->event_model->check_budget_by_client_id($client_id);
        $data["scripts"] = array(
            "scripts/user.js",
            "scripts/client_service.js"
        );
        $this->load->view("index", $data);
    }

    public function admin_login()
    {
        $data_error = array();

        $email = $this->input->post("admin_email", true);
        $password = $this->input->post("admin_password", true);

        if ($email == "") {
            $data_error["admin_email"] = "Email required";
        }
        if ($password == "") {
            $data_error["admin_password"] = "Password required";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data_error["admin_email"] = "Invalid email";
        }

        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please Follow Error Messages", "error_list"=>$data_error);
        } else {
            $account_status = $this->app_user_model->select_status_by_email($email);
            if(empty($account_status)){
                $result = array("status"=>401, "reason"=>"This account  not found in our server. Please Registration First");
            } else if($account_status->user_type != 0){
                $result = array("status"=>401, "reason"=>"This is not event Management pro account");
            } else if($account_status->user_type == 0) {
                $data = $this->app_user_model->select_by_email_password($email,$password);
                if(empty($data)){
                    $result = array("status"=>401, "reason"=>"Email or password not match");
                } else {
                    $data_session = array();
                    $data_session["user_id"] = $data->user_id;
                    $data_session["user_type"] = $data->user_type;
                    //print_r($data_session); exit();

                    $this->session->set_userdata($data_session);
                    $result = array("status"=>200, "message"=>"Successfully Login");
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }


    public function vendor_login()
    {
        $data_error = array();
        $email = $this->input->post("vendor_email", true);
        $password = $this->input->post("vendor_password", true);

        if ($email == "") {
            $data_error["vendor_email"] = "Email required";
        }
        if ($password == "") {
            $data_error["vendor_password"] = "Password required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data_error["vendor_email"] = "Invalid email";
        }
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please Follow Error Messages", "error_list"=>$data_error);
        } else {
            $account_status = $this->app_user_model->select_status_by_email($email);
            if(empty($account_status)){
                $result = array("status"=>401, "reason"=>"This account  not found in our server. Please Registration First");
            } else if($account_status->user_type != 2){
                $result = array("status"=>401, "reason"=>"This is not event Management pro account");
            } else if($account_status->User_status == 0){
                $result = array("status"=>401, "reason"=>"Please wait for your account verfication");
            } else if($account_status->User_status == 2){
                $result = array("status"=>401, "reason"=>"Your account Deactive some reason. Please contact our help desk");
            } else if($account_status->user_type == 2 && $account_status->User_status == 1) {
                $data = $this->app_user_model->select_by_email_password($email,$password);
                if(empty($data)){
                    $result = array("status"=>401, "reason"=>"Email or password not match");
                } else {
                    $data_vendor = $this->vendor_model->select_by_user_id($data->user_id);
                    $data_session = array();
                    $data_session["user_id"] = $data->user_id;
                    $data_session["user_type"] = $data->user_type;
                    $data_session["vendor_id"] = $data_vendor->vendor_id;
                    //print_r($data_session); exit();

                    $this->session->set_userdata($data_session);
                    $result = array("status"=>200, "message"=>"Successfully Login");
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }


    public function client_login()
    {
        $data_error = array();
        $email = $this->input->post("client_email", true);
        $password = $this->input->post("client_password", true);

        if ($email == "") {
            $data_error["client_email"] = "Email required";
        }
        if ($password == "") {
            $data_error["client_password"] = "Password required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data_error["client_email"] = "Invalid email";
        }
        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please Follow Error Messages", "error_list"=>$data_error);
        } else {
            $account_status = $this->app_user_model->select_status_by_email($email);
            if(empty($account_status)){
                $result = array("status"=>401, "reason"=>"This account  not found in our server. Please Registration First");
            } else if($account_status->User_status == 2 ){
                $result = array("status"=>401, "reason"=>"Your account Deactive some reason. Please contact our help desk");
            } else if($account_status->User_status == 0){
                $result = array("status"=>401, "reason"=>"Please wait for account varification");
            } else if($account_status->user_type == 1 && $account_status->User_status == 1){
                $data = $this->app_user_model->select_by_email_password($email,$password);
                if(empty($data)){
                    $result = array("status"=>401, "reason"=>"Email or password not match");
                } else {
                    $data_client = $this->client_model->select_by_user_id($data->user_id);
                    $data_session = array();
                    $data_session["user_id"] = $data->user_id;
                    $data_session["user_type"] = $data->user_type;
                    $data_session["client_id"] = $data_client->client_id;
                    //print_r($data_session); exit();

                    $this->session->set_userdata($data_session);
                    $result = array("status"=>200, "message"=>"Successfully Login");
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function client_register()
    {
        $data_client = array();
        $data_app = array();
        $data_error = array();

        $first_name = $this->input->post("first_name", true);
        $last_name = $this->input->post("last_name", true);
        $phn_number = $this->input->post("phn_number", true);
        $address = $this->input->post("address", true);
        $email = $this->input->post("email", true);
        $password = $this->input->post("password", true);
        $con_password = $this->input->post("con_password", true);
        $policy_agreed = $this->input->post("policy_agreed", true);


        if ($first_name == "") {
            $data_error["first_name"] = "First name required";
        }
        if ($last_name == "") {
            $data_error["last_name"] = "Last name required";
        }
        if (filter_var($first_name, FILTER_VALIDATE_INT)) {
            $data_error["first_name"] = "Number Not allowed in First name";
        }
        if (filter_var($last_name, FILTER_VALIDATE_INT)) {
            $data_error["last_name"] = "Number Not allowed in Last name";
        }
        if ($phn_number == "") {
            $data_error["phn_number"] = "Phone Number required";
        }
        if ($address == "") {
            $data_error["address"] = "Address required";
        }
        if ($email == "") {
            $data_error["email"] = "Email required";
        }
        if ($password == "") {
            $data_error["password"] = "Password required";
        }
        if ($con_password == "") {
            $data_error["con_password"] = "Confirm Password required";
        }
        if ($password != $con_password) {
            $data_error["con_password"] = "Password and retype password does not match";
        }

        if(strlen($password) < 6){
            $data_error["password"] = "Password must be greater than 6 length";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data_error["email"] = "Invalid email";
        }

        if ($policy_agreed != 1) {
            $data_error["policy_agreed"] = "You must accept terms and condition";
        }

        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please Follow Error Messages", "error_list"=>$data_error);
        } else {
            $email_count = $this->app_user_model->count_by_email($email);
            if ($email_count > 0) {
                $result = array("status"=>403, "reason"=>"Account already exist with $email");
            } else {
                $data_app["email"] = $email;
                $data_app["password"] = $password;
                $data_app["user_type"] = "1";
                $user_id = $this->app_user_model->save($data_app);
                if (!$user_id) {
                    $result = array("status"=>401, "reason"=>"Registration failed due to internal error");
                } else {
                    $data_client["first_name"] = $first_name;
                    $data_client["last_name"] = $last_name;
                    $data_client["phn_number"] = $phn_number;
                    $data_client["address"] = $address;
                    $data_client["user_id"] = $user_id;
                    $client_id = $this->client_model->save($data_client);
                    if (!$client_id) {
                        $this->app_user_model->delete_by_id($user_id);
                        $result = array("status"=>401, "reason"=>"Registration failed due to internal error");
                    } else {
                        $result = array("status"=>200, "message"=>"Registration Successfully Complete");
                    }
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function vendor_register()
    {
        $data_vendor = array();
        $data_app = array();
        $data_error = array();

        $vendor_name = $this->input->post("vendor_name", true);
        $vendor_type = $this->input->post("vendor_type", true);
        $vendor_number = $this->input->post("phn_number", true);
        $vendor_address = $this->input->post("vendor_address", true);
        $vendor_area = $this->input->post("vendor_area", true);
        $vendor_email = $this->input->post("email", true);
        $password = $this->input->post("password", true);
        $con_password = $this->input->post("con_password", true);
        $policy_agreed = $this->input->post("policy_agreed", true);


        if ($vendor_name == "") {
            $data_error["vendor_name"] = "Company name required";
        }
        if ($vendor_type == "") {
            $data_error["vendor_type"] = "Company type required";
        }
        if ($vendor_number == "") {
            $data_error["vendor_phn_number"] = "Phone Number required";
        }
        if ($vendor_address == "") {
            $data_error["vendor_address"] = "Address required";
        }
        if ($vendor_area == "") {
            $data_error["vendor_area"] = "Area required";
        }
        if ($vendor_email == "") {
            $data_error["email_vendor"] = "Email required";
        }
        if ($password == "") {
            $data_error["vendor_password"] = "Password required";
        }
        if ($con_password == "") {
            $data_error["vendor_con_password"] = "Confirm Password required";
        }
        if ($password != $con_password) {
            $data_error["vendor_con_password"] = "Password and retype password does not match";
        }

        if(strlen($password) < 6){
            $data_error["vendor_password"] = "Password must be greater than 6 length";
        }

        if (!filter_var($vendor_email, FILTER_VALIDATE_EMAIL)) {
            $data_error["email"] = "Invalid email";
        }

        if ($policy_agreed != 1) {
            $data_error["vendor_policy_agreed"] = "You must accept terms and condition";
        }

        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please Follow Error Messages", "error_list"=>$data_error);
        } else {
            $email_count = $this->app_user_model->count_by_email($vendor_email);
            if ($email_count > 0) {
                $result = array("status"=>403, "reason"=>"Account already exist with $vendor_email");
            } else {
                $data_app["email"] = $vendor_email;
                $data_app["password"] = $password;
                $data_app["user_type"] = "2";
                $user_id = $this->app_user_model->save($data_app);
                if (!$user_id) {
                    $result = array("status"=>401, "reason"=>"Registration failed due to internal error");
                } else {
                    $data_vendor["company_name"] = $vendor_name;
                    $data_vendor["vendor_type"] = $vendor_type;
                    $data_vendor["phn_num"] = $vendor_number;
                    $data_vendor["address"] = $vendor_address;
                    $data_vendor["city"] = $vendor_area;
                    $data_vendor["user_id"] = $user_id;
                    $vendor_id = $this->vendor_model->save($data_vendor);
                    if (!$vendor_id) {
                        $this->app_user_model->delete_by_id($user_id);
                        $result = array("status"=>401, "reason"=>"Registration failed due to internal error");
                    } else {
                        $result = array("status"=>200, "message"=>"Registration Successfully Complete");
                    }
                }
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function staff_register()
    {
        $data_staff = array();
        $data_error = array();

        $data_staff["full_name"] = $this->input->post("full_name", true);
        $data_staff["staff_email"]  = $this->input->post("staff_email", true);
        $data_staff["phn_num"] = $this->input->post("phn_num", true);
        $data_staff["gender"] = $this->input->post("gender", true);
        $data_staff["staff_loc"] = $this->input->post("staff_loc", true);
        $data_staff["staff_type"]= $this->input->post("staff_type", true);
        $data_staff["expected_salary"]= $this->input->post("expected_salary", true);
        $data_staff["experience"] = $this->input->post("experience", true);

        $image_upload_result = upload_image_file("image", $this->pic_path, 512);
        $data_staff["image"] = $image_upload_result["status"] == 200 ? $image_upload_result["file_path"] : "";

        if ($image_upload_result["status"] != 200) {
            $data_error["image"] = $image_upload_result["reason"];
        }

        if ($data_staff["full_name"] == "") {
            $data_error["full_name"] = "Full name required";
        }
        if (filter_var($data_staff["full_name"], FILTER_VALIDATE_INT)) {
            $data_error["full_name"] = "Number Not allowed in name";
        }
        if ($data_staff["staff_email"] == "") {
            $data_error["staff_email"] = "Email required";
        }
        if ($data_staff["phn_num"] == "") {
            $data_error["phn_num"] = "Phone Number required";
        }
        if ($data_staff["gender"] == "") {
            $data_error["gender"] = "Gender required";
        }
        if ($data_staff["staff_loc"] == "") {
            $data_error["staff_loc"] = "Location required";
        }
        if ($data_staff["experience"] == "") {
            $data_error["experience"] = "Please Write Something about yourself";
        }
        if ($data_staff["staff_type"] == "") {
            $data_error["staff_type"] = "Staff type required";
        }
        if (!filter_var($data_staff["staff_email"] , FILTER_VALIDATE_EMAIL)) {
            $data_error["staff_email"] = "Invalid email";
        }
        if(strlen($data_staff["phn_num"]) < 7 || strlen($data_staff["phn_num"] ) > 13){
            $data_error["phn_num"] = "Phone number length invalid";
        }else if(!preg_match('/^[0-9-]+$/D', $data_staff["phn_num"] )) {
            $data_error["phn_num"] = "Invalid phone number";
        }
        if(($data_staff["expected_salary"] ) > 10000){
            $data_error["expected_salary"] = "Expected salary too high";
        }else if(($data_staff["expected_salary"] ) < 0){
            $data_error["expected_salary"] = "Expected salary too low";
        }else if(!preg_match('/^[0-9-]+$/D', $data_staff["expected_salary"] )) {
            $data_error["expected_salary"] = "Invalid expected salary";
        }

        if (!empty($data_error)) {
            $result = array("status"=>402, "reason"=>"Please Follow Error Messages", "error_list"=>$data_error);
        } else {
            $email_count = $this->staff_model->count_by_email($data_staff["staff_email"]);
            if ($email_count > 0) {
                $staff_email = $data_staff["staff_email"];
                $result = array("status"=>403, "reason"=>"You already registered before $staff_email");
            } else {
                $staff_id = $this->staff_model->save($data_staff);
                if (!$staff_id) {
                    $this->staff_model->delete_by_id($staff_id);
                    $result = array("status"=>401, "reason"=>"Registration failed due to internal error");
                } else {
                    $result = array("status"=>200, "message"=>"Registration Successfully Complete");
                }

            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    }

    public function signout()
    {
        $data = array('user_id', 'user_type');
        $this->session->unset_userdata($data);
        $this->load->helper('cookie');
        delete_cookie("logged_in_js_id");
        redirect(base_url());
    }

}
